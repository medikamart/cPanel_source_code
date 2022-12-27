<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kyc extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function userkyc()
	{
        
        $method='POST';
        $api='Kyc/get_user_kyc_request';
        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method); 
        $d['kyc'] = $result['data'];
        // print_r($result);die; 
        $d['v'] = 'kyc/userkyc';
        $this->load->view('template',$d);
	}

    public function userkycsubmit()
    {
        // print_r($_POST);die;
        $method='POST';
        $api='Kyc/user_kyc_request';
        $data='pan_number='.$this->input->post('pan_number',true).'&aadhar_number='.$this->input->post('aadhar_number',true).'&user_id='.$this->session->userdata('user_data')['user_id'].'&clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&pan_image='.$this->input->post('hdn_pan_image',true).'&aadhar_front='.$this->input->post('hdn_aadhar_front',true).'&aadhar_back='.$this->input->post('hdn_aadhar_back',true).'&user_selfi='.$this->input->post('hdn_user_selfi',true);
        $result = $this->CallAPI($api, $data, $method); 
        echo json_encode($result,true);
        
    }

    public function updateStatusKyc()
    {
        // print_r($_POST);die;
        $method='POST';
        $api='Kyc/update_kyc_status';
        $data='req_id='.$this->input->post('req_id',true).'&d_by='.$this->session->userdata('user_data')['user_id'].'&clinic_code='.$this->input->post('clinic_code',true).'&status='.$this->input->post('status',true);
        $result = $this->CallAPI($api, $data, $method); 
        echo json_encode($result,true);
        
    }

    public function userkycrequest()
    {
        $current_status = $this->uri->segment(3);
        $method='POST';
        $api='Kyc/kyc_request_users';
        $data='current_status='.$current_status;
        $result = $this->CallAPI($api, $data, $method); 
        $d['kyc_request'] = $result['data']; 
        $d['current_status'] = $current_status; 
        $d['v'] = 'kyc/userkycrequest';
        $this->load->view('template',$d);
        
    }





}

?>