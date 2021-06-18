<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MX_Controller {	
	function __construct(){
        parent::__construct();
        // if ($this->session->userdata('status')!="admin") {
        //     redirect('admin/login');die();
		// }
	}

	function index(){
        $data['side'] = 'transaksi';
        $this->theme($data,'transaksi');
    }

    function history(){
        $data['side'] = 'transaksihistory';
        $data['list'] = $this->db->query("SELECT id_transaksi,DATE_FORMAT(created_at, '%d %M %Y %H:%i') as created_at FROM transaksi")->result();
        $this->theme($data,'transaksihistory');
    }

    function detail($id){
        if(!empty($id)){
            $data['side'] = 'transaksihistorydetail';
            $data['detail'] = $this->db->query("SELECT transaksi_detail.*, produk.nama, harga.nominal FROM transaksi_detail
                join produk on produk.id_produk = transaksi_detail.id_produk
                join harga on harga.id_harga = transaksi_detail.id_harga
                where transaksi_detail.id_transaksi =".$id)->result();
            $this->theme($data,'transaksihistorydetail');
        }else{
            show_404();
        }
    }

    function get_data($barcode = null){
        if(strlen($barcode) > 0){
            $data = $this->db->query("SELECT * FROM produk WHERE barcode = '$barcode'")->result()[0];
            echo json_encode($data);
        }else{
            show_404();
        }
    }

    function get_data_multiple(){
        $barcodes = $this->input->get("data_barcode");
        if(!empty($barcodes)){
            $implode = implode(',', $barcodes);
            $data = $this->db->query("SELECT harga.nominal, produk.barcode, produk.nama, transaksi_detail.*  FROM transaksi_detail 
                JOIN produk on transaksi_detail.id_produk = produk.id_produk
                JOIN harga on harga.id_produk = produk.id_produk
                WHERE produk.barcode IN (".$implode.")")->result();
            echo json_encode($data);
        }else{
            show_404();
        }
    }

    function cek_total()
    {
        $id_produk = $this->input->get("id_produk");
        $total = $this->input->get("total");
        $total_harga = 0;

        foreach ($id_produk as $key=>$id_produk) {
            $harga = $this->db->query("SELECT nominal  FROM harga where id_produk = ".$id_produk)->result()[0]->nominal??0;
            $total_harga = $total_harga + ($harga * $total[$key]??0);
        }

        echo json_encode($total_harga);
    }

    function search(){
        $keyword = $this->input->get("keyword");

        $data = $this->db->query("SELECT id_transaksi,DATE_FORMAT(created_at, '%d %M %Y %H:%i') as created_at  FROM transaksi where id_transaksi like '%".$keyword."%'")->result();
        echo json_encode($data);
    }

    function tambah_transaksi()
    {
        $id_produk = $this->input->get("id_produk");
        $total = $this->input->get("total");

        $create_transaksi = $this->db->insert("transaksi", ['created_at' => date('Y-m-d H:i:s')]);
        $id_transaksi = $this->db->insert_id();
        
        if($create_transaksi){
            foreach ($id_produk as $key=>$id_produk) {
                $harga = $this->db->query("SELECT nominal,id_harga  FROM harga where id_produk = ".$id_produk)->result()[0];
                $total_harga = $harga->nominal * $total[$key]??0;
                $transaksi_detail = [
                    'id_transaksi' => $id_transaksi,
                    'id_produk' => $id_produk,
                    'id_harga' => $harga->id_harga,
                    'jumlah' => $total[$key]??0,
                    'total' => $total_harga    
                ];

                $create_transaksi_detail = $this->db->insert("transaksi_detail", $transaksi_detail);
            }

            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(['status' => 'fail', 'message' => 'Failed tambah transaksi']);
        }
    }

    private function theme($data,$view){
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $data['products'] = $this->db->query("SELECT produk.id_produk,barcode,nama,nominal  FROM produk 
            JOIN harga on harga.id_produk = produk.id_produk")->result();
        $this->load->view('theme/sidebar',$data);
        $this->load->view($view,$data);
        $this->load->view('theme/footer');
    }
}