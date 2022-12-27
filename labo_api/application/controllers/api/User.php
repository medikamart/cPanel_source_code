<?php



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require_once APPPATH.'third_party/PHPMailer/Exception.php';

require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';

require_once APPPATH.'third_party/PHPMailer/SMTP.php';

require APPPATH . 'libraries/REST_Controller.php';

     

class User extends REST_Controller {

    public function __construct() {

       parent::__construct();

       $this->load->model("User_model");

        

    }



   

   public function role_master_post()

   {

        if($this->input->post('action',true)=="")

        {

             $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'action is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            if($this->input->post('action',true)=="C")

            {



                if($this->input->post('role_name',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'role_name is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }if($this->input->post('clinic_code',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('user_id',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'user_id is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('permission_status',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'permission_status is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {

                     $verify = $this->User_model->verifyExist_role_m($this->input->post('role_name',true),$this->input->post('clinic_code',true));

                    if($verify>0)

                    {

                        $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'role is already exist !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                    }else

                    {

                        $dataArr['clinic_code'] = $this->input->post('clinic_code',true);

                        $dataArr['role_name'] = $this->input->post('role_name',true);

                        $dataArr['role_permission'] = $this->input->post('permission_status',true);

                        $dataArr['c_date'] = date('Y-m-d H:i:s');

                        $dataArr['c_by'] = $this->input->post('user_id',true);

                        $dataArr['status'] = 1;

                        $dataArr['global'] = 0;

                        $result = $this->User_model->role_create_m($dataArr);

                        if($result)

                        {

                            $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'Successfully Saved !', 'response_code'=>REST_Controller::HTTP_OK]);

                        }else{



                            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'something went wrong !', 'response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

                        }

                    }

                }



            }elseif($this->input->post('action',true)=="R")

            {

                if($this->input->post('clinic_code',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {

                    $result = $this->User_model->get_role_m($this->input->post('clinic_code',true));

                    if(!empty($result))

                    {

                        $this->response(['status'=>true, 'response_data'=>$result, 'Message'=>'Successfully Created !', 'response_code'=>REST_Controller::HTTP_OK]);

                    }else{

                        $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'No Record Found!', 'response_code'=>REST_Controller::HTTP_OK]);

                    }

                }

            }elseif($this->input->post('action',true)=="RP")

            {

                if($this->input->post('clinic_code',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('role_id',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'user_id is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {

                    $result = $this->User_model->get_role_id_details_m($this->input->post('clinic_code',true),$this->input->post('role_id',true));

                    if(!empty($result))

                    {

                        $this->response(['status'=>true, 'response_data'=>$result, 'Message'=>'Successfully Created !', 'response_code'=>REST_Controller::HTTP_OK]);

                    }else{

                        $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'No Record Found!', 'response_code'=>REST_Controller::HTTP_OK]);

                    }

                }

            }elseif($this->input->post('action',true)=="U")

            {

                if($this->input->post('role_name',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'role_name is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }if($this->input->post('clinic_code',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('user_id',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'user_id is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('permission_status',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'permission_status is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('role_id',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'role_id is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {

                     $verify = $this->User_model->verifyExistUpdate_role_m($this->input->post('role_name',true),$this->input->post('clinic_code',true),$this->input->post('role_id',true));

                    if($verify>0)

                    {

                        $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'role is already exist !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                    }else

                    {



                        $dataArr['role_name'] = $this->input->post('role_name',true);

                        $dataArr['role_permission'] = $this->input->post('permission_status',true);

                        $dataArr['d_date'] = date('Y-m-d H:i:s');

                        $dataArr['d_by'] = $this->input->post('user_id',true);

                        $result = $this->User_model->role_update_m($dataArr,$this->input->post('role_id',true),$this->input->post('clinic_code',true));

                        if($result)

                        {

                            $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'Successfully Saved !', 'response_code'=>REST_Controller::HTTP_OK]);

                        }else{



                            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'something went wrong !', 'response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

                        }

                    }

                }

                

            }elseif($this->input->post('action',true)=="D")

            {

                if($this->input->post('clinic_code',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('user_id',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'user_id is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }elseif($this->input->post('role_id',true)=="")

                {

                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'role_id is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {

                    $result = $this->User_model->delete_role_m($this->input->post('clinic_code',true),$this->input->post('user_id',true),$this->input->post('role_id',true));

                    if($result)

                    {

                        $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'Successfully Deleted !', 'response_code'=>REST_Controller::HTTP_OK]);

                    }else{

                        

                        $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'something went wrong !', 'response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

                    }

                }

            }else

            {

                 $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'invalid action!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

        }

   }





   public function get_sub_users_post()

   {

        if($this->input->post('clinic_code',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $result = $this->User_model->get_sub_users_m($this->input->post('clinic_code',true));

            $this->response(['status'=>false, 'response_data'=>$result, 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]);

        }

   }



   public function update_block_status_post()

   {

        if($this->input->post('clinic_code',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('user_id',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'user id is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('d_by',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'d_by is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('blocked_status',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'blocked status code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $data = [];

            $data['blocked'] = $this->input->post('blocked_status',true);

            $data['d_by'] = $this->input->post('d_by',true);

            $data['d_date'] = date('Y-m-d H:i:s');

            $where = [];

            $where['user_id'] = $this->input->post('user_id',true);

            $where['clinic_code'] = $this->input->post('clinic_code',true);

            $result = $this->User_model->updateUserInfo_m($data,$where);

            if($result)

            {

                $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]); 

            }else

            {

                $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Failed To Updated Try Again', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

            

        }

   }



   public function update_role_post()

   {

        if($this->input->post('clinic_code',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('user_id',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('d_by',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('role_id',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $data = [];

            $data['role'] = $this->input->post('role_id',true);

            $data['d_by'] = $this->input->post('d_by',true);

            $data['d_date'] = date('Y-m-d H:i:s');

            $where = [];

            $where['user_id'] = $this->input->post('user_id',true);

            $where['clinic_code'] = $this->input->post('clinic_code',true);

            $result = $this->User_model->updateUserInfo_m($data,$where);

            if($result)

            {

                $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]); 

            }else

            {

                $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Failed To Updated Try Again', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

            

        }

   }



   public function feedback_post()

   {

        if($this->input->post('clinic_code',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('user_id',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic code is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('feedback',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'feedback is required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $data = [];

            $data['feedback'] = $this->input->post('feedback',true);

            $data['feedback_date'] = date('Y-m-d H:i:s');

            $data['user_id'] = $this->input->post('user_id',true);

            $data['clinic_code'] = $this->input->post('clinic_code',true);

            $result = $this->User_model->saveFeedback_m($data);

            if($result)

            {

                $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]); 

            }else

            {

                $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Failed Try Again', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

            

        }

   }





   public function get_userDetails_post()

   {

        if($this->input->post('user_id',true)=="")

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'User Id Required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $result = $this->User_model->get_userDetails_m($this->input->post('user_id',true));

            $this->response(['status'=>true, 'response_data'=>$result, 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]); 

        }

   }


   public function change_password_post()

   {

        if($this->input->post('user_id',true)=="")
        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'User Id Required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('old_password',true)=="")
        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Old password Required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('new_password',true)=="")
        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'New Password Required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {
            $result = $this->User_model->get_userDetailsPassword_m($this->input->post('user_id',true));
            if(!empty($result))
            {
                if($result[0]['password'] === md5($this->input->post('old_password',true)))
                {
                    $this->User_model->updateUserInfo_m(['password'=>md5($this->input->post('old_password',true))],['user_id'=>$this->input->post('user_id',true)]);

                    $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]); 
                }else
                {
                    $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Old Password Not Match !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                }
            }else
            {
                $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Session Expired Login First !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }
            

        }

   }



    public function get_notifications_post()

   {

        $user_id = $this->input->post('user_id',true)!=""?$this->input->post('user_id',true):"";
        $clinic_code = $this->input->post('clinic_code',true)!=""?$this->input->post('clinic_code',true):"";
        $result = $this->User_model->get_notificattions_m($user_id,$clinic_code);
        $total = $this->User_model->get_notificattions_count_m($user_id,$clinic_code);

        $this->response(['status'=>true, 'response_data'=>['total'=>$total,'data'=>$result], 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]);

   }

   public function update_notifications_post()

   {

        $user_id = $this->input->post('user_id',true)!=""?$this->input->post('user_id',true):"";
        $clinic_code = $this->input->post('clinic_code',true)!=""?$this->input->post('clinic_code',true):"";
        $id = $this->input->post('id',true)!=""?$this->input->post('id',true):"";
        
        $this->User_model->update_notificattions_read_m($user_id,$clinic_code,$id);
        $total = $this->User_model->get_notificattions_count_m($user_id,$clinic_code);
        $this->response(['status'=>true, 'response_data'=>['total'=>$total], 'Message'=>'Successfully Done', 'response_code'=>REST_Controller::HTTP_OK]);

   }

  

}



?>

