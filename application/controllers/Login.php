<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
	public function index()
	{
		$this->load->view('login');
	}
	
	public function logout() 
    {
        $this->session->sess_destroy(); 
        redirect('Login', 'refresh');       
    }
    public function login_now() 
    {
        $this->input->post('username',true)!=''?$username=$this->input->post('username',true):$username='';
        $this->input->post('password',true)!=''?$password=$this->input->post('password',true):$password='';
        $method='POST';
        $api='Login/login';
        $data='username='.$username.'&password='.$password;
        $result = $this->CallAPI($api, $data, $method);  
        if($result['response_code']==200)
        {	
        	$logged_in_sess = array(
				'user_data' => $result['response_data']['data'],
	            'logged_in' => TRUE
            );
        	$this->session->set_userdata($logged_in_sess);
            redirect('Dashboard','refresh');
        }else
        {
        	$this->session->set_flashdata('error', $result['Message']);
    			redirect('Login', 'refresh');
        }
    }
}
?>
