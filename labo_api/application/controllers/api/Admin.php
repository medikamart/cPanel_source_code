<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Admin extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Admin_model");
    }

    public function getDashboardDataCount_post()
    {
        $data = [];
        $data['total_clinic'] = $this->Admin_model->gettotalcliniccount();
        $data['total_non_active'] = $this->Admin_model->gettotalnonactivecliniccount();
        $data['total_active'] = $this->Admin_model->gettotalactivecliniccount();
        $this->response(['status'=>false, 'response_data'=>$data, 'Message'=>'Successfully', 'response_code'=>REST_Controller::HTTP_OK]);
    }

    public function getClinicData_post()
    {
        $status = $this->input->post('status',true)!=""?$this->input->post('status',true):"";
        $result = $this->Admin_model->getclinicsDetails($status);
        $this->response(['status'=>false, 'response_data'=>$result, 'Message'=>'Successfully', 'response_code'=>REST_Controller::HTTP_OK]);
    }

    


}

?>
