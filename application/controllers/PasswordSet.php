<?php

defined('BASEPATH') or exit('No direct script access allowed');

class PasswordSet extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        
        $sessionData = $this->session->userdata('user_data');
        if(isset($_GET['passcode']))
        {
            $method='POST';
            $api='Registration/get_passcode_status';
            $data='passcode='.$_GET['passcode'];
            $result = $this->CallAPI($api, $data, $method); 
            if($result['status_code']==200)
            {
                $this->load->view('password');
            }else
            {
                $d['status'] = "LINK_EXPIRED";
                $this->load->view('error',$d);
            }
            
        }
        
	}

    public function setpassword()
    {
        $method='POST';
        $api='Registration/set_passcode_status';
        $data='password='.$this->input->post('password',true).'&passcode='.$this->input->post('passcode',true);
        $result = $this->CallAPI($api, $data, $method);
         if($result['status_code']==200)
         {
             $d['status'] = "SUCCESS";
             $this->load->view('error',$d);
         }else
         {
             $d['status'] = "FAILED";
             $this->load->view('error',$d);
         }
    }



}

?>