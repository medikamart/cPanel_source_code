<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require_once APPPATH.'third_party/PHPMailer/Exception.php';

require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';

require_once APPPATH.'third_party/PHPMailer/SMTP.php';

require APPPATH . 'libraries/REST_Controller.php';

require_once APPPATH.'third_party/vendor/autoload.php';


     

class CustomerApi extends REST_Controller {

    public function __construct() {

       parent::__construct();

       $this->load->model("CustomerApi_model");
       $this->load->model("User_model");
       

    }



    public function register_customer_post()

    {

        

        try{

            if($this->input->post('name')=='')

            {

                $this->response(['status'=>false,'msg'=>'name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif($this->input->post('mobile')=='')

            {

                $this->response(['status'=>false,'msg'=>'mobile is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif($this->input->post('dob')=='')

            {

                $this->response(['status'=>false,'msg'=>'dob is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif($this->input->post('email')=='')

            {

                $this->response(['status'=>false,'msg'=>'email is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif($this->input->post('gender')=='')

            {

                $this->response(['status'=>false,'msg'=>'gender is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {

                $mainData = [];

                $mainData['name'] = $this->input->post('name',true);

                $mainData['mobile'] = $this->input->post('mobile',true);

                $mainData['dob'] = date('Y-m-d',strtotime($this->input->post('dob',true)));

                $mainData['email'] = $this->input->post('email',true);

                $mainData['gender'] = $this->input->post('gender',true);

                $mainData['pro_pic'] = '';

                $mainData['c_by'] = 'SELF';

                $mainData['c_date'] = date('Y-m-d H:i:s');

                $mainData['d_by'] = 'SELF';

                $mainData['d_date'] = date('Y-m-d H:i:s');

                $this->CustomerApi_model->createCustomer_m($mainData);

                $this->response(['status'=>true,'msg'=>'success','status_code'=>REST_Controller::HTTP_OK]);

            }   

        }catch(Exception $e)

        {

            $this->response(['status'=>false,'msg'=>'something went wrong !','status_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }

        

    }



    public function propertyList_post()

   {

        try {

            $category = $this->input->post('category',true)!=""?$this->input->post('category',true):"";

            $km = $this->input->post('km',true)!=""?$this->input->post('km',true):"";

            $search = $this->input->post('search',true)!=""?$this->input->post('search',true):"";

            $lng = $this->input->post('lng',true)!=""?$this->input->post('lng',true):"";

            $long = $this->input->post('long',true)!=""?$this->input->post('long',true):"";

            $result = $this->CustomerApi_model->propertyList($category,$km,$search,$lng,$long);

            $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }

   }





   public function getUsersData_post()

   {

        try {

            if($this->input->post('mobile',true)=='')

            {

                $this->response(['status'=>false,'msg'=>'mobile is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {

                $mobile = $this->input->post('mobile',true)!=""?$this->input->post('mobile',true):"";

                $result = $this->CustomerApi_model->get_users_data_m($mobile);

                $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);

            }

            

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }

   }


   public function getInformattionCenterData_post()

   {

        try {

           $pin = $this->input->post('pin',true)!=""?$this->input->post('pin',true):"";
           $search = $this->input->post('search',true)!=""?$this->input->post('search',true):"";
           $limit = $this->input->post('limit',true)!=""?$this->input->post('limit',true):10;
           $page = $this->input->post('page',true)!=""?$this->input->post('page',true):1;

           $verified = $this->input->post('verified',true)!=""?$this->input->post('verified',true):0;
           $rating = $this->input->post('rating',true)!=""?$this->input->post('rating',true):0;

           $state_code = $this->input->post('state_code',true)!=""?$this->input->post('state_code',true):"";
           $district_code = $this->input->post('district_code',true)!=""?$this->input->post('district_code',true):"";
           $total = $this->CustomerApi_model->get_information_center_count_m($pin,$search,$verified,$rating,$state_code,$district_code);
           $pages = 0;
           $intpage = intval($total/$limit);
           if(($total/$limit)>$intpage)
           {
                $pages = $intpage+1;
           }else
           {
                $pages = $intpage;
           }
           $result = $this->CustomerApi_model->get_information_center_data_m($pin,$search,$limit,$page,$verified,$rating,$state_code,$district_code);

           $this->response(['status'=>true,'data'=>['total'=>$total,'pages'=>$pages,'data'=>$result],'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]); 

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }
    }

     public function getState_post()

   {

        try {

           $result = $this->CustomerApi_model->get_state_data_m();
            
           $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]); 

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }
       

   }

    public function getDistrict_post()

   {

        try {

           $state_code = $this->input->post('state_code',true)!=""?$this->input->post('state_code',true):"";
           $result = $this->CustomerApi_model->get_district_data_m($state_code);
            
           $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]); 

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }
       

   }

  


   public function notifyAll_post()
   {

        try {

          $clinic_code = $this->input->post('clinic_code',true)!=""?$this->input->post('clinic_code',true):"";
          $user_id = $this->input->post('user_id',true)!=""?$this->input->post('user_id',true):"";
          $message = $this->input->post('message',true)!=""?$this->input->post('message',true):"";
          $mainData = [];
          $mainData['message'] = $message;
          $mainData['clinic_code'] = $clinic_code;
          $mainData['user_id'] = $user_id;
          $mainData['date_times'] = date('Y-m-d H:i:s');
          $mainData['read_status'] = 0;
          $mainData['status'] = 1;
          $id = $this->CustomerApi_model->saveNotification_m($mainData);

           $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            '6cf5b937d1e20a7e2484',
            '9e4ffc922909c11ad8fc',
            '1515825',
            $options
          );
          $mainData['total'] = $this->User_model->get_notificattions_count_m($user_id,$clinic_code);
          $mainData['id'] = $id;
          $data['message'] = $this->input->post('message',true);
          $pusher->trigger('my-channel', 'my-event', $mainData);

           $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]); 

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }
       

   }


    



}



?>

