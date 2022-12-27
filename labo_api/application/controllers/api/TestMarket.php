<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class TestMarket extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Test_model");
        
    }

    public function test_market_import_post()
    {   
        if($this->input->post('clinic_code',true)!='' && $this->input->post('test_id',true)!='')
        {   
            
            $testData = $this->Test_model->get_test_market_m($this->input->post('test_id',true));
            $testDetailsData = $this->Test_model->get_test_details_market_m($this->input->post('test_id',true));
            $testArray = [];
            $testArray['clinic_code'] = $this->input->post('clinic_code',true);
            $testArray['category_id'] = $testData[0]['category_id'];
            $testArray['test_name'] = $testData[0]['test_name'];
            $testArray['rate'] = $testData[0]['rate'];
            $testArray['c_by'] = $this->input->post('clinic_code',true);
            $testArray['c_date'] = date('Y-m-d H:i:s');
            $testArray['important'] = 0;
            $testArray['global'] = 0;
            $testArray['status'] = 1;
            $test_id = $this->Test_model->create_test_market_m($testArray);
            if(!empty($testDetailsData))
            {
                foreach($testDetailsData as $key=>$value)
                {
                    $testDetailsArray = [];
                    $testDetailsArray['clinic_code'] = $this->input->post('clinic_code',true);
                    $testDetailsArray['test_id'] = $test_id;
                    $testDetailsArray['sub_test_name'] = $value['sub_test_name'];
                    $testDetailsArray['unit_id'] = $value['unit_id'];
                    $testDetailsArray['test_reference_id'] = $value['test_reference_id'];
                    $testDetailsArray['result_box'] = $value['result_box'];
                    $testDetailsArray['c_by'] = $this->input->post('clinic_code',true);
                    $testDetailsArray['c_date'] = date('Y-m-d H:i:s');
                    $testDetailsArray['global'] = 0;
                    $testDetailsArray['status'] = 1;
                    $this->Test_model->create_test_details_m($testDetailsArray);
                }
                $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else{
                $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }
           
        }else
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }
    }



  
}

?>
