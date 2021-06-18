<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class U extends MX_Controller {	
	function __construct(){
        parent::__construct();
        // if ($this->session->userdata('status')!="admin") {
        //     redirect('admin/login');die();
		// }
	}

	function index(){
        // $data['instance'] = $this->db->query("SELECT COUNT(id_instance) a FROM instance")->result()[0]->a;
        // $data['recruiter'] = $this->db->query("SELECT COUNT(id_recruiter) a FROM recruiter")->result()[0]->a;
        // $data['employee'] = $this->db->query("SELECT COUNT(id_employee) a FROM employee")->result()[0]->a;
        $data['side'] = 'dashboard';
        $this->theme($data,'dashboard');
    }

    private function theme($data,$view){
        $this->load->view('theme/header');
        $this->load->view('theme/sidebar',$data);
        $this->load->view('theme/topbar');
        $this->load->view($view,$data);
        $this->load->view('theme/footer');
    }
}