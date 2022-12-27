<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Employee_Login extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Employee_login_model');
   }

   public function login_post()
   {
        if($this->input->post('mobile_no',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'mobile_no required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('password',true)=='')
        {
            $this->response(['status'=>false,'data'=>[],'msg'=>'password required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            try{
                  $verify = $this->Employee_login_model->verifyMobileExistOrNot($this->input->post('mobile_no',true));
                  if($verify>0)
                  {

                     $userData = $this->Employee_login_model->getEmployeeDetails($this->input->post('mobile_no',true));

                           if($userData['password'] == $this->input->post('password',true))
                           {

                                if($userData['block_status'] == 1)
                                {
                                    $this->response(['status'=>false,'data'=>[],'msg'=>'You are blocked !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                                }else{
                                    $userInfo = [];
                                    $userInfo['id'] = $userData['id'];
                                    $userInfo['name'] = $userData['name'];
                                    $userInfo['role'] = $userData['role'];
                                    $userInfo['mobile_no'] = $userData['mobile_no'];

                                    $this->response(['status'=>true,'data'=>['userData'=>$userInfo],'msg'=>'Auth Success !','response_code' => REST_Controller::HTTP_OK]);
                                 }

                           }else{
                              $this->response(['status'=>false,'data'=>[],'msg'=>'Mobile_No Or Password Not Match !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                         }

                  }else{
                      $this->response(['status'=>false,'data'=>[],'msg'=>'Invalid Mobile_No !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                  }

               
               } catch (Exception $e) {
                  
                  $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
               }

            
        }
   }


   
}
?>