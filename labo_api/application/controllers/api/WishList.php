<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class WishList extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("WishList_model");
        
    }

    public function wishlist_master_post()
    {   
        $action = $this->input->post('action');
        if($action=='C')
        {   
            if($this->input->post('patient_id')=='' || $this->input->post('test_id')=='' || $this->input->post('c_by')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   
                $verify = $this->WishList_model->veryfy_create_wishlist_m($this->input->post('test_id'),$this->input->post('patient_id'));
                if($verify==200)
                {
                    $data_array = array();
                    $data_array['patient_id'] = $this->input->post('patient_id');
                    $data_array['test_id'] = $this->input->post('test_id');
                    $data_array['c_by'] = $this->input->post('c_by');
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->WishList_model->create_wishlist_m($data_array);
                    if($result)
                    {
                         $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                    }else
                    {
                        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                    } 
                }else
                {
                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'already exist'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                }
                


            }

        }elseif($action=='R')
        {
           $this->input->post('patient_id')!=''?$patient_id = $this->input->post('patient_id'):$patient_id='';
           $result = $this->WishList_model->get_wishlist_list_m($patient_id);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='D')
        {
            if($this->input->post('d_by')=='' || $this->input->post('wishlist_id')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->WishList_model->update_wishlist_m($data_array,$this->input->post('wishlist_id'));
                if($result)
                {
                     $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                }else
                {
                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                }

            }
        }
        
    }



  
}

?>
