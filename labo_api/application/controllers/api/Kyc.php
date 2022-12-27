<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Kyc extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Kyc_model");
        
    }

    public function user_kyc_request_post()
    {
        if($this->input->post('pan_number')=='')
        {
            $this->response(['status'=>false, 'data'=>[], 'msg'=>'Pan number required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('aadhar_number')=='')
        {
             $this->response(['status'=>false, 'data'=>[], 'msg'=>'Aadhar number required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('user_id')=='')
        {
             $this->response(['status'=>false, 'data'=>[], 'msg'=>'user_id required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('clinic_code')=='')
        {
             $this->response(['status'=>false, 'data'=>[], 'msg'=>'clinic_code required !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
          $pan_number = $this->input->post('pan_number',true);
          $aadhar_number = $this->input->post('aadhar_number',true);
          $pan_image = '';
          $aadhar_front = '';
          $aadhar_back = '';
          $user_selfi = '';
           try{
                if (isset($_POST['pan_image']) && !empty($_POST['pan_image'])) {
                   $pan_image_incoded = $_POST['pan_image'];
                   $pan_image = str_replace(' ', '+', $pan_image_incoded);
                   $pan_imageData = base64_decode($pan_image);
                   $pan_image = uniqid() . '.jpg';
                   $pan_image_file = APPPATH.'../all-uploaded-img/userkyc/' . $pan_image;
                   $success = file_put_contents($pan_image_file, $pan_imageData);
                }

                if (isset($_POST['aadhar_front']) && !empty($_POST['aadhar_front'])) {
                   $aadhar_front_incoded = $_POST['aadhar_front'];
                   $aadhar_front = str_replace(' ', '+', $aadhar_front_incoded);
                   $aadhar_frontData = base64_decode($aadhar_front);
                   $aadhar_front = uniqid() . '.jpg';
                   $aadhar_front_file = APPPATH.'../all-uploaded-img/userkyc/' . $aadhar_front;
                   $success = file_put_contents($aadhar_front_file, $aadhar_frontData);
                   // $sql_query = " pan_image='$pan_image', ";
                }

                if (isset($_POST['aadhar_back']) && !empty($_POST['aadhar_back'])) {
                   $aadhar_back_incoded = $_POST['aadhar_back'];
                   $aadhar_back = str_replace(' ', '+', $aadhar_back_incoded);
                   $aadhar_backData = base64_decode($aadhar_back);
                   $aadhar_back = uniqid() . '.jpg';
                   $aadhar_back_file = APPPATH.'../all-uploaded-img/userkyc/' . $aadhar_back;
                   $success = file_put_contents($aadhar_back_file, $aadhar_backData);
                }

                if (isset($_POST['user_selfi']) && !empty($_POST['user_selfi'])) {
                   $user_selfi_incoded = $_POST['user_selfi'];
                   $user_selfi = str_replace(' ', '+', $user_selfi_incoded);
                   $user_selfiData = base64_decode($user_selfi);
                   $user_selfi = uniqid() . '.jpg';
                   $user_selfi_file = APPPATH.'../all-uploaded-img/userkyc/' . $user_selfi;
                   $success = file_put_contents($user_selfi_file, $user_selfiData);
                }
                $req_date = date('Y-m-d H:i:s');

                $mainData = [];
                $mainData['user_selfi'] =  $user_selfi;
                $mainData['pan_image'] =  $pan_image;
                $mainData['aadhar_front'] =  $aadhar_front;
                $mainData['aadhar_back'] =  $aadhar_back;
                $mainData['user_id'] =  $this->input->post('user_id',true);
                $mainData['clinic_code'] =  $this->input->post('clinic_code',true);
                $mainData['aadhar_no'] =  $this->input->post('pan_number',true);
                $mainData['pan_no'] =  $this->input->post('pan_number',true);
                $mainData['current_status'] =  'requested';
                $mainData['status'] =  1;
                $mainData['c_by'] =  $this->input->post('user_id',true);
                $mainData['c_date'] =  date('Y-m-d H:i:s');
                $this->Kyc_model->saveUserKyc($mainData);
                $this->response(['status'=>true, 'data'=>[], 'msg'=>'Successfully Requested !', 'response_code'=>REST_Controller::HTTP_OK]);
          
           }catch(Exception $e)
           {
                   $this->response(['status'=>false, 'data'=>[], 'msg'=>'Something went wrong', 'response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
           }

        }
    }

    public function kyc_request_users_post()
    {
        $current_status = $this->input->post('current_status')!=""?$this->input->post('current_status'):"";
        $result = $this->Kyc_model->get_usersKycRequest_m($current_status);
        $this->response(['status'=>true, 'data'=>$result, 'msg'=>'Successfully Fetched !', 'response_code'=>REST_Controller::HTTP_OK]);
    }

    public function update_kyc_status_post()
    {
        $req_id = $this->input->post('req_id',true);
        $d_by = $this->input->post('d_by',true);
        $clinic_code = $this->input->post('clinic_code',true);
        if($this->input->post('status')=='completed')
        {
            $uData = [];
            $wData = [];
            $uData['current_status'] = 'completed';
            $uData['action_by'] = $d_by;
            $uData['action_date'] = date('Y-m-d H:i:s');
            $uData['d_by'] = $d_by;
            $uData['d_date'] = date('Y-m-d H:i:s');
            $wData['id'] = $req_id;
            $this->Kyc_model->updateUserKyc($uData,$wData);

            $uData = [];
            $wData = [];
            $uData['user_kyc'] = 1;
            $uData['clinic_code'] = $clinic_code;
            $this->Kyc_model->updateUserKycClinic($uData,$wData);
            $this->response(['status'=>true, 'data'=>[], 'msg'=>'Successfully Updated !', 'response_code'=>REST_Controller::HTTP_OK]);
        }elseif($this->input->post('status')=='rejected')
        {
            $uData = [];
            $wData = [];
            $uData['current_status'] = 'rejected';
            $uData['action_by'] = $d_by;
            $uData['action_date'] = date('Y-m-d H:i:s');
            $uData['d_by'] = $d_by;
            $uData['d_date'] = date('Y-m-d H:i:s');
            $wData['id'] = $req_id;
            $this->Kyc_model->updateUserKyc($uData,$wData);

            $uData = [];
            $wData = [];
            $uData['user_kyc'] = 0;
            $uData['clinic_code'] = $clinic_code;
            $this->Kyc_model->updateUserKycClinic($uData,$wData);
            $this->response(['status'=>true, 'data'=>[], 'msg'=>'Successfully Updated !', 'response_code'=>REST_Controller::HTTP_OK]);
            
        }else
        {
            $this->response(['status'=>false, 'data'=>[], 'msg'=>'Invalid status !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }
    }


    public function get_business_types_post()
    {
        $result = $this->Kyc_model->get_business_types_m();
        $this->response(['status'=>true, 'data'=>$result, 'msg'=>'Successfully Fetched !', 'response_code'=>REST_Controller::HTTP_OK]);
    }

    public function get_kyc_status_post()
    {
        $clinic_code = $this->input->post('clinic_code')!=""?$this->input->post('clinic_code'):"";
        $result = $this->Kyc_model->getKycStatus_m($clinic_code);

        $this->response(['status'=>true, 'data'=>$result, 'msg'=>'Successfully Fetched !', 'response_code'=>REST_Controller::HTTP_OK]);
    }


    public function get_user_kyc_request_post()
    {
        $clinic_code = $this->input->post('clinic_code')!=""?$this->input->post('clinic_code'):"";
        $result = $this->Kyc_model->get_usersKycRequestStatus_m($clinic_code);
        $this->response(['status'=>true, 'data'=>$result, 'msg'=>'Successfully Fetched !', 'response_code'=>REST_Controller::HTTP_OK]);
    }

    



  
}

?>
