<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Login extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Login_m");
        
    }
    public function login_post()
    {
        // print_r($_POST);die;
    	if($this->input->post('username',true)=='' || $this->input->post('password',true) =='')
    	{
    		$this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
    	}
    	else
    	{
                $login = $this->Login_m->check_username_m($this->input->post('username',true));
                if(count($login)>0) {
                   
                    if($login[0]['current_status']=='completed') {


                        if($login[0]['password']==md5($this->input->post('password',true)))
                        {
                             if($login[0]['blocked']==1)
                            {
                                 $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Account is blocked.'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);

                            }else{

                                $resData['role'] = $login[0]['role'];
                                $resData['first_name'] = $login[0]['first_name'];
                                $resData['last_name'] = $login[0]['last_name'];
                                $resData['clinic_code'] = $login[0]['clinic_code'];
                                $resData['user_id'] = $login[0]['user_id'];
                                $this->response(['status' => TRUE, 'response_data'=>['data'=>$resData], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                            }

                        }else{
                            
                            $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Username Or Password Not Match.'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                        }
                        
                    }else{
                        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Plesae Verify By Registed Email !'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                    }
                }
                else{
                    $this->response(['status' => FALSE, 'response_data'=>'3', 'Message' => 'Username is not match!!', 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                }
    		
    	} 
    }
    
    public function adminlogin_post()
    {
        // print_r($_POST);die;
        if($this->input->post('username',true)=='' || $this->input->post('password',true) =='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }
        else
        {
                $login = $this->Login_m->check_username_admin_m($this->input->post('username',true));
                if(count($login)>0) {
                   
                    if($login[0]['password']==md5($this->input->post('password',true)))
                        {
                            $resData['role'] = 1;
                            $resData['first_name'] = $login[0]['name'];
                            $resData['last_name'] = '';
                            $resData['clinic_code'] = '';
                            $resData['user_id'] = $login[0]['user_id'];
                            $this->response(['status' => TRUE, 'response_data'=>['data'=>$resData], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                        }else{
                            
                            $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Username Or Password Not Match.'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                        }
                }
                else{
                    $this->response(['status' => FALSE, 'response_data'=>'3', 'Message' => 'Username is not match!!', 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                }
            
        } 
    }
}

