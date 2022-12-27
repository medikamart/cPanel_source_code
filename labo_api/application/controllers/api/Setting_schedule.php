<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Setting_schedule extends REST_Controller 
{
   public function __construct()
   {
       parent::__construct();
     $this->load->model('Setting_schedule_model');
   }

   public function addSchedule_post()
   {
        if($this->input->post('doctor_id',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'doctor_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('property_id',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'property_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('start_time',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'start_time required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('end_time',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'end_time required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('days',true)==''){
            $this->response(['status'=>false,'data'=>[],'msg'=>'days required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            try{
                $verify = $this->Setting_schedule_model->verifyScheduleExist($this->input->post('doctor_id',true),$this->input->post('property_id',true),$this->input->post('start_time',true),$this->input->post('end_time',true),$this->input->post('days',true));
                     if($verify>0)
                     {
                        $this->response(['status'=>false,'data'=>[],'msg'=>'doctor_id or property_id already exist !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
                     }else{

                    $data = [];
                    $data['doctor_id'] = $this->input->post('doctor_id',true);
                    $data['property_id'] = $this->input->post('property_id',true);
                    $data['start_time'] = $this->input->post('start_time',true);
                    $data['end_time'] = $this->input->post('end_time',true);
                    $data['days'] = $this->input->post('days',true);
                    $data['status'] = 1;
                    $this->Setting_schedule_model->addSchedule($data);
                    $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully Saved !','response_code' => REST_Controller::HTTP_OK]);
                    }

               
               } catch (Exception $e) {
                  
                  $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
               }

            
        }
   }

   public function Setting_Schedule_post()
   {
        try {
            
            $doctor_id = $this->input->post('doctor_id',true)!=""?$this->input->post('doctor_id',true):"";
            $id = $this->input->post('id',true)!=""?$this->input->post('id',true):"";
            $result = $this->Setting_schedule_model->ScheduleList($doctor_id,$id);
            $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);
            
        } catch (Exception $e) {
            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
        }
   }

   public function deleteSchedule_post()
        {
            if($this->input->post('id',true)=='')
            {
                $this->response(['status'=>false,'data'=>[],'msg'=>'id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {

                try{
                   $data = [];
                   $data['status'] = 0;
                    $this->Setting_schedule_model->DeleteSchedule($data,['id'=>$this->input->post('id',true)]);
                    $this->response(['status'=>true,'data'=>[],'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);
                    
                }catch(Exception $e)
                {
                    $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);
                }

            }
        }


   
}
?>