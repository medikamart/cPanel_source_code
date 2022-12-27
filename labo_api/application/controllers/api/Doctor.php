<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Doctor extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Doctor_model');
   }

   public function addDoctor_post()
   {
        if($this->input->post('doctor_name',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'doctor_name required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('qualification',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'qualification required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('property_id',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'property_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('room_no',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'room_no required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('floor',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'floor required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('abouts',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'abouts required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('survey_by',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'survey_by required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('survey_date',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'survey_date required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('d_by',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'d_by required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            try{

                $data = [];
                $data['doctors_id'] = $this->Doctor_model->generateDoctor_id();
                $data['doctor_name'] = $this->input->post('doctor_name',true);
                $data['qualification'] = $this->input->post('qualification',true);
                $data['property_id'] = $this->input->post('property_id',true);
                $data['room_no'] = $this->input->post('room_no',true);
                $data['floor'] = $this->input->post('floor',true);
                $data['abouts'] = $this->input->post('abouts',true);
                $data['survey_by'] = $this->input->post('survey_by',true);
                $data['survey_date'] = date('Y-m-d',strtotime($this->input->post('survey_date',true)));
                $data['d_date'] = date('Y-m-d H:i:s');
                $data['d_by'] = $this->input->post('d_by',true);
                $data['status'] = 1;
                $this->Doctor_model->addDetails($data);
                $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully Saved !','response_code' => REST_Controller::HTTP_OK]);

               
               } catch (Exception $e) {
                  
                  $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
               }

            
        }
   }

   public function DoctorList_post()
   {
        try {
            $doctors_id = $this->input->post('doctors_id',true)!=""?$this->input->post('doctors_id',true):"";
            $property_id = $this->input->post('property_id',true)!=""?$this->input->post('property_id',true):"";
            $result = $this->Doctor_model->doctorList($doctors_id,$property_id);
            $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);
            
        } catch (Exception $e) {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
   }

   public function deleteDoctor_post()
        {
            if($this->input->post('doctors_id',true)=='')
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'doctors_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {

                try{
                   $data = [];
                   $data['status'] = 0;
                    $this->Doctor_model->DeleteDoctorList($data,['doctors_id'=>$this->input->post('doctors_id',true)]);
                    $this->response(['status'=>true,'data'=>[],'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                    
                }catch(Exception $e)
                {
                    $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
                }

            }
        }


   
}
?>