<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Dashboard extends MY_Controller
{

	public function __construct()
	{

		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			redirect('/Login');
		}
	}
	public function index()
	{	
		
		$method='POST';
        $api='Admin/getDashboardDataCount';
        $data='';
        $result = $this->CallAPI($api, $data, $method); 
        $d['data'] = $result['response_data']; 

        $d['v'] = 'dashboard';
		$this->load->view('template',$d);
	}

	public function clinics()
	{	
		$status = $this->uri->segment(3);
		$method='POST';
        $api='Admin/getClinicData';
        $data='status='.$status;
        $result = $this->CallAPI($api, $data, $method); 
        $d['result'] = $result['response_data']; 
        $d['status'] = $status;
        $d['v'] = 'clinics';
		$this->load->view('template',$d);
	}



	
}
?>
