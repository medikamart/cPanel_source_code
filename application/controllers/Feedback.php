
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Feedback extends MY_Controller
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

		$d['v'] = 'feedback/feedback';
		$this->load->view('template',$d);

	}

	public function submitfeedback()
	{
			
			$method='POST';
	        $api='User/feedback';
	        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&user_id='.$this->session->userdata('user_data')['clinic_code'].'&feedback='.$this->input->post('feedback',true);
	        $result = $this->CallAPI($api, $data, $method);  
	       echo json_encode($result,true);
	}





}
?>
