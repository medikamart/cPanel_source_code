<?php
require APPPATH . 'libraries/REST_Controller.php';
class Tool extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Tool_model");
        
    }

    public function updatePadImage_post()
    {
        if($this->input->post('clinic_code',true)=='')
        {
            $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Clinic Code Required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
           if (isset($_POST['pad_image']) && !empty($_POST['pad_image'])) 
            {
               $pad_image_incoded = $_POST['pad_image'];
               $pad_image = str_replace(' ', '+', $pad_image_incoded);
               $pad_imageData = base64_decode($pad_image);
               $pad_image = uniqid() . '.png';
               $pad_image_file = APPPATH.'../all-uploaded-img/padimage/' . $pad_image;
               $success = file_put_contents($pad_image_file, $pad_imageData);
               $mainData['pad_image'] = $pad_image;
               $this->Tool_model->update_pad_image_m($mainData,['clinic_code'=>$this->input->post('clinic_code',true)]);
               $this->Tool_model->insert_pad_image_m(['clinic_code'=>$this->input->post('clinic_code',true),'pad_image'=>$pad_image,'status'=>1]);
            } 
            $this->response(['status' => TRUE, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
        }
        


    }


    public function get_pad_images_post()
     {
         $result = $this->Tool_model->get_pad_image_m($this->input->post('clinic_code',true));
         $this->response(['status' => TRUE, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
     }

     public function get_pad_image_letest_post()
     {
         $result = $this->Tool_model->get_pad_image_cuurent_m($this->input->post('clinic_code',true));
         $this->response(['status' => TRUE, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
     }

    
     public function updatePadImageSet_post()
    {
        if($this->input->post('clinic_code',true)=='')
        {
            $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Clinic Code Required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }if($this->input->post('pad_image',true)=='')
        {
            $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Pad Image Required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
           $mainData = [];
           $mainData['pad_image'] = $this->input->post('pad_image',true);
           $this->Tool_model->update_pad_image_m($mainData,['clinic_code'=>$this->input->post('clinic_code',true)]);
            $this->response(['status' => TRUE, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
        }
        


    }

    public function deletePadImageSet_post()
    {
        if($this->input->post('clinic_code',true)=='')
        {
            $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Clinic Code Required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }if($this->input->post('pad_image',true)=='')
        {
            $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Pad Image Required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
           $mainData = [];
           $mainData['status'] = 0;
           $this->Tool_model->update_pad_images_m($mainData,['clinic_code'=>$this->input->post('clinic_code',true),'pad_image'=>$this->input->post('pad_image',true)]);
            $this->response(['status' => TRUE, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
        }
        


    }


  
}

?>
