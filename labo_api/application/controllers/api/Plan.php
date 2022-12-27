<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Plan extends REST_Controller 
{
    public function __construct() {
       parent::__construct();
       $this->load->model("Plan_model");
        
    }

    public function get_plan_list_post()
    {
        $result = $this->Plan_model->getPlanList_m();
        $this->response(['status'=>true,'msg'=>'Successfully Found !','data'=>$result,'status_code'=>REST_Controller::HTTP_BAD_REQUEST]);
    }

    public function get_plan_details_post()
    {
        if($this->input->post('plan_id',true)=="")
        {
            $this->response(['status'=>false,'msg'=>'Plan Id Required','data'=>[],'status_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $result = $this->Plan_model->getPlanDetails_m($this->input->post('plan_id',true));
            $this->response(['status'=>true,'msg'=>'Successfully Found !','data'=>$result,'status_code'=>REST_Controller::HTTP_OK]);
        }
        
    }


                



  
}

?>
