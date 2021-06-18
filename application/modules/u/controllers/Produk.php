<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MX_Controller {	
	function __construct(){
        parent::__construct();
        // if ($this->session->userdata('status')!="admin") {
        //     redirect('admin/login');die();
		// }
	}

	function index(){
        $data['side'] = 'produk';
        $data['data'] = $this->db->query("SELECT * FROM v_produk")->result();
        $this->theme($data,'produk');
    }

    private function theme($data,$view){
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar',$data);
        $this->load->view($view,$data);
        $this->load->view('theme/footer');
    }
}