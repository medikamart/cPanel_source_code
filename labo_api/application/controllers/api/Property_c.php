<?php

   

require APPPATH . 'libraries/REST_Controller.php';

     

class Property_c extends REST_Controller 

{

   public function __construct()

   {

       parent::__construct();

     $this->load->model('Property_model');

   }



   public function addProperty_post()

   {

        if($this->input->post('main_category_id',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'main_category_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('property_name',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'property_name required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('contact_no',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'contact_no required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('contact_person',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'contact_person required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('address',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'address required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('start_time',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'start_time required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('end_time',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'end_time required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('days',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'days required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('property_image',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'property_image required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('survey_by',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'survey_by required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('survey_date',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'survey_date required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('latitude',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'latitude required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('longitude',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'longitude required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('d_by',true)==''){

            $this->response(['status'=>false,'data'=>[],'msg'=>'d_by required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            try{



                $image ='';

                        if($this->input->post('property_image',true)!='')

                        {

                            $inside_image_incoded = $this->input->post('property_image',true);

                            $inside_image_incoded = str_replace(' ', '+', $inside_image_incoded);  

                            $imageData = base64_decode($inside_image_incoded);

                            $image = uniqid() . '.jpg';

                            $inside_image_file = '../all-uploaded-img/property_image/' . $image;

                            $success = file_put_contents(APPPATH . $inside_image_file, $imageData);

                        }



                $data = [];

                $data['property_id'] = $this->Property_model->generateProperty_id();

                $data['main_category_id'] = $this->input->post('main_category_id',true);

                $data['property_name'] = $this->input->post('property_name',true);

                $data['contact_no'] = $this->input->post('contact_no',true);

                $data['contact_person'] = $this->input->post('contact_person',true);

                $data['address'] = $this->input->post('address',true);

                $data['start_time'] = $this->input->post('start_time',true);

                $data['end_time'] = $this->input->post('end_time',true);

                $data['days'] = json_decode($this->input->post('days',true));

                $data['property_image'] = $image;

                $data['survey_by'] = $this->input->post('survey_by',true);

                $data['survey_date'] = date('Y-m-d',strtotime($this->input->post('survey_date',true)));

                $data['latitude'] = $this->input->post('latitude',true);

                $data['longitude'] = $this->input->post('longitude',true);

                $data['d_by'] = $this->input->post('d_by',true);

                $data['d_date'] = date('Y-m-d H:i:s');

                $data['status'] = 1;

                $this->Property_model->addPropertDetails($data);

                $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully Saved !','response_code' => REST_Controller::HTTP_OK]);



               

               } catch (Exception $e) {

                  

                  $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

               }



            

        }

   }



   public function propertyList_post()

   {

        try {

            $property_id = $this->input->post('property_id',true)!=""?$this->input->post('property_id',true):"";
            
            $lng = $this->input->post('la',true)!=""?$this->input->post('la',true):0;
            
            $long = $this->input->post('lo',true)!=""?$this->input->post('lo',true):0;

            $result = $this->Property_model->propertyList($property_id,$lng,$long);

            $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }

   }



   public function deleteProperty_post()

        {

            if($this->input->post('property_id',true)=='')

            {

                $this->response(['status'=>false,'data'=>[],'msg'=>'property_id required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {



                try{

                   $data = [];

                   $data['status'] = 0;

                    $this->Property_model->DeleteProperty($data,['property_id'=>$this->input->post('property_id',true)]);

                    $this->response(['status'=>true,'data'=>[],'msg'=>'successfully deleted','response_code' => REST_Controller::HTTP_OK]);

                    

                }catch(Exception $e)

                {

                    $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !','response_code' => REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

                }



            }

        }

    public function mainCategoryList_post()

   {

        try {

            

            $result = $this->Property_model->mainCategoryList();

            $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);

            

        } catch (Exception $e) {

            $this->response(['status'=>false,'data'=>[],'msg'=>'something went wrong !!','response_code'=>REST_Controller::HTTP_INTERNAL_SERVER_ERROR]);

        }

   }

   public function updateCinicLogo_post()
   {
      if($this->input->post('image')=="")
      {
         $this->response(['status'=>false,'data'=>[],'msg'=>'image required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }elseif($this->input->post('clinic_code')=="")
      {
        $this->response(['status'=>false,'data'=>[],'msg'=>'clinic code required !','response_code' => REST_Controller::HTTP_BAD_REQUEST]);
      }else
      {     
            $image ='';
            if($this->input->post('image',true)!='')
            {

                $inside_image_incoded = $this->input->post('image',true);

                $inside_image_incoded = str_replace(' ', '+', $inside_image_incoded);  

                $imageData = base64_decode($inside_image_incoded);

                $image = uniqid() . '.jpg';

                $inside_image_file = '../all-uploaded-img/clinic_logo/' . $image;

                $success = file_put_contents(APPPATH . $inside_image_file, $imageData);
                $result = $this->Property_model->updateClinicLogo_m(['logo_image'=>$image],['clinic_code'=>$this->input->post('clinic_code')]);
            }

            $this->response(['status'=>true,'data'=>[],'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);
      }

   }

   public function getCinicLogo_post()
   {
      $result = $this->Property_model->getClinicLogo_m($this->input->post('clinic_code'));
       $this->response(['status'=>true,'data'=>$result,'msg'=>'Successfully Fetched','response_code'=>REST_Controller::HTTP_OK]);

   }



   

}

?>