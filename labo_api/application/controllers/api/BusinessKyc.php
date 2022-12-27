<?php

require APPPATH . 'libraries/REST_Controller.php';

     

class BusinessKyc extends REST_Controller {

    public function __construct() {

       parent::__construct();

       $this->load->model("BusinessKyc_model");

        

    }





    public function business_kyc_request_post()

    {

        if($this->input->post('business_type')=='')

        {

            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'business_type required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $business_type = $this->input->post('business_type');

            if($business_type==1)

            {

                /*Unregistered*/

                if($this->input->post('clinic_code')=='')

                {

                    $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'clinic_code required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {   



                    $mainData = [];



                    if($this->input->post('address_type')==2)

                    {

                        if($this->input->post('rent_agreement')=='')

                        {

                            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'rent_agreement required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                            return 0;

                        }

                    }

                    if (isset($_POST['shop_with_bill_board']) && !empty($_POST['shop_with_bill_board'])) {

                           $shop_with_bill_board_incoded = $_POST['shop_with_bill_board'];

                           $shop_with_bill_board = str_replace(' ', '+', $shop_with_bill_board_incoded);

                           $shop_with_bill_boardData = base64_decode($shop_with_bill_board);

                           $shop_with_bill_board = uniqid() . '.jpg';

                           $shop_with_bill_board_file = APPPATH.'../all-uploaded-img/businesskyc/' . $shop_with_bill_board;

                           $success = file_put_contents($shop_with_bill_board_file, $shop_with_bill_boardData);

                           $mainData['shop_with_bill_board'] = $shop_with_bill_board;

                    }





                    if (isset($_POST['rent_agreement']) && !empty($_POST['rent_agreement'])) {

                           $rent_agreement_incoded = $_POST['rent_agreement'];

                           $rent_agreement = str_replace(' ', '+', $rent_agreement_incoded);

                           $rent_agreementData = base64_decode($rent_agreement);

                           $rent_agreement = uniqid() . '.pdf';

                           $rent_agreement_file = APPPATH.'../all-uploaded-img/businesskyc/' . $rent_agreement;

                           $success = file_put_contents($rent_agreement_file, $rent_agreementData);

                           $mainData['rent_agreement'] = $rent_agreement;

                    }



                    if (isset($_POST['electricity_bill']) && !empty($_POST['electricity_bill'])) {

                           $electricity_bill_incoded = $_POST['electricity_bill'];

                           $electricity_bill = str_replace(' ', '+', $electricity_bill_incoded);

                           $electricity_billData = base64_decode($electricity_bill);

                           $electricity_bill = uniqid() . '.pdf';

                           $electricity_bill_file = APPPATH.'../all-uploaded-img/businesskyc/' . $electricity_bill;

                           $success = file_put_contents($electricity_bill_file, $electricity_billData);

                           $mainData['electricity_bill'] = $electricity_bill;

                    }



                    if (isset($_POST['adhar_document']) && !empty($_POST['adhar_document'])) {

                           $adhar_document_incoded = $_POST['adhar_document'];

                           $adhar_document = str_replace(' ', '+', $adhar_document_incoded);

                           $adhar_documentData = base64_decode($adhar_document);

                           $adhar_document = uniqid() . '.pdf';

                           $adhar_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $adhar_document;

                           $success = file_put_contents($adhar_document_file, $adhar_documentData);

                           $mainData['adhar_document'] = $adhar_document;

                    }



                    if (isset($_POST['pan_document']) && !empty($_POST['pan_document'])) {

                           $pan_document_incoded = $_POST['pan_document'];

                           $pan_document = str_replace(' ', '+', $pan_document_incoded);

                           $pan_documentData = base64_decode($pan_document);

                           $pan_document = uniqid() . '.pdf';

                           $pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $pan_document;

                           $success = file_put_contents($pan_document_file, $pan_documentData);

                           $mainData['pan_document'] = $pan_document;

                    }

                    $mainData['business_type'] = $this->input->post('business_type',true);

                    $mainData['business_name'] = $this->input->post('business_name',true);

                    $mainData['business_contact'] = $this->input->post('business_contact',true);

                    $mainData['business_email'] = $this->input->post('business_email',true);

                    $mainData['business_address'] = $this->input->post('business_address',true);

                    $mainData['address_type'] = $this->input->post('address_type',true);

                    $mainData['clinic_code'] = $this->input->post('clinic_code',true);

                    $mainData['owner_name'] = $this->input->post('owner_name',true);

                    $mainData['aadhar_no'] = $this->input->post('aadhar_no',true);

                    $mainData['pan_no'] = $this->input->post('pan_no',true);

                    $mainData['current_status'] = 'requested';

                    $mainData['requested_date'] = date('Y-m-d H:i:s');

                    $mainData['c_by'] = $this->input->post('c_by',true);

                    $mainData['c_date'] = date('Y-m-d H:i:s');

                    $this->BusinessKyc_model->businessKycBasic_save($mainData);

                    $this->response(['status'=>true, 'response_data'=>'4', 'Message'=>'Successfully Requested', 'response_code'=>REST_Controller::HTTP_OK]);



                }

            }elseif($business_type==2)

            {

                /*Propritorship*/

                if($this->input->post('clinic_code')=='')

                {

                    $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'clinic_code required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {   



                    $mainData = [];



                    if($this->input->post('address_type')==2)

                    {

                        if($this->input->post('rent_agreement')=='')

                        {

                            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'rent_agreement required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                            return 0;

                        }

                    }

                    if (isset($_POST['shop_with_bill_board']) && !empty($_POST['shop_with_bill_board'])) {

                           $shop_with_bill_board_incoded = $_POST['shop_with_bill_board'];

                           $shop_with_bill_board = str_replace(' ', '+', $shop_with_bill_board_incoded);

                           $shop_with_bill_boardData = base64_decode($shop_with_bill_board);

                           $shop_with_bill_board = uniqid() . '.jpg';

                           $shop_with_bill_board_file = APPPATH.'../all-uploaded-img/businesskyc/' . $shop_with_bill_board;

                           $success = file_put_contents($shop_with_bill_board_file, $shop_with_bill_boardData);

                           $mainData['shop_with_bill_board'] = $shop_with_bill_board;

                    }





                    if (isset($_POST['rent_agreement']) && !empty($_POST['rent_agreement'])) {

                           $rent_agreement_incoded = $_POST['rent_agreement'];

                           $rent_agreement = str_replace(' ', '+', $rent_agreement_incoded);

                           $rent_agreementData = base64_decode($rent_agreement);

                           $rent_agreement = uniqid() . '.pdf';

                           $rent_agreement_file = APPPATH.'../all-uploaded-img/businesskyc/' . $rent_agreement;

                           $success = file_put_contents($rent_agreement_file, $rent_agreementData);

                           $mainData['rent_agreement'] = $rent_agreement;

                    }



                    if (isset($_POST['electricity_bill']) && !empty($_POST['electricity_bill'])) {

                           $electricity_bill_incoded = $_POST['electricity_bill'];

                           $electricity_bill = str_replace(' ', '+', $electricity_bill_incoded);

                           $electricity_billData = base64_decode($electricity_bill);

                           $electricity_bill = uniqid() . '.pdf';

                           $electricity_bill_file = APPPATH.'../all-uploaded-img/businesskyc/' . $electricity_bill;

                           $success = file_put_contents($electricity_bill_file, $electricity_billData);

                           $mainData['electricity_bill'] = $electricity_bill;

                    }



                    if (isset($_POST['adhar_document']) && !empty($_POST['adhar_document'])) {

                           $adhar_document_incoded = $_POST['adhar_document'];

                           $adhar_document = str_replace(' ', '+', $adhar_document_incoded);

                           $adhar_documentData = base64_decode($adhar_document);

                           $adhar_document = uniqid() . '.pdf';

                           $adhar_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $adhar_document;

                           $success = file_put_contents($adhar_document_file, $adhar_documentData);

                           $mainData['adhar_document'] = $adhar_document;

                    }



                    if (isset($_POST['pan_document']) && !empty($_POST['pan_document'])) {

                           $pan_document_incoded = $_POST['pan_document'];

                           $pan_document = str_replace(' ', '+', $pan_document_incoded);

                           $pan_documentData = base64_decode($pan_document);

                           $pan_document = uniqid() . '.pdf';

                           $pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $pan_document;

                           $success = file_put_contents($pan_document_file, $pan_documentData);

                           $mainData['pan_document'] = $pan_document;

                    }



                    if (isset($_POST['gst_certificate']) && !empty($_POST['gst_certificate'])) {

                           $gst_certificate_incoded = $_POST['gst_certificate'];

                           $gst_certificate = str_replace(' ', '+', $gst_certificate_incoded);

                           $gst_certificateData = base64_decode($gst_certificate);

                           $gst_certificate = uniqid() . '.pdf';

                           $gst_certificate_file = APPPATH.'../all-uploaded-img/businesskyc/' . $gst_certificate;

                           $success = file_put_contents($gst_certificate_file, $gst_certificateData);

                           $mainData['gst_certificate'] = $gst_certificate;

                    }



                    $mainData['business_type'] = $this->input->post('business_type',true);

                    $mainData['business_name'] = $this->input->post('business_name',true);

                    $mainData['business_contact'] = $this->input->post('business_contact',true);

                    $mainData['business_email'] = $this->input->post('business_email',true);

                    $mainData['business_address'] = $this->input->post('business_address',true);

                    $mainData['clinic_code'] = $this->input->post('clinic_code',true);

                    $mainData['address_type'] = $this->input->post('address_type',true);

                    $mainData['owner_name'] = $this->input->post('owner_name',true);

                    $mainData['aadhar_no'] = $this->input->post('aadhar_no',true);

                    $mainData['pan_no'] = $this->input->post('pan_no',true);

                    $mainData['current_status'] = 'requested';

                    $mainData['requested_date'] = date('Y-m-d H:i:s');

                    $mainData['c_by'] = $this->input->post('c_by',true);

                    $mainData['c_date'] = date('Y-m-d H:i:s');

                    $mainData['gst_no'] = $this->input->post('gst_no',true);

                    $mainData['registration_no'] = $this->input->post('registration_no',true);



                    $this->BusinessKyc_model->businessKycBasic_save($mainData);

                    $this->response(['status'=>true, 'response_data'=>'4', 'Message'=>'Successfully Requested', 'response_code'=>REST_Controller::HTTP_OK]);



                }

            }elseif($business_type==3)

            {

                /*Propritorship*/

                if($this->input->post('clinic_code')=='')

                {

                    $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'clinic_code required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {   



                    $mainData = [];



                    if($this->input->post('address_type')==2)

                    {

                        if($this->input->post('rent_agreement')=='')

                        {

                            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'rent_agreement required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                            return 0;

                        }

                    }

                    if (isset($_POST['shop_with_bill_board']) && !empty($_POST['shop_with_bill_board'])) {

                           $shop_with_bill_board_incoded = $_POST['shop_with_bill_board'];

                           $shop_with_bill_board = str_replace(' ', '+', $shop_with_bill_board_incoded);

                           $shop_with_bill_boardData = base64_decode($shop_with_bill_board);

                           $shop_with_bill_board = uniqid() . '.jpg';

                           $shop_with_bill_board_file = APPPATH.'../all-uploaded-img/businesskyc/' . $shop_with_bill_board;

                           $success = file_put_contents($shop_with_bill_board_file, $shop_with_bill_boardData);

                           $mainData['shop_with_bill_board'] = $shop_with_bill_board;

                    }





                    if (isset($_POST['rent_agreement']) && !empty($_POST['rent_agreement'])) {

                           $rent_agreement_incoded = $_POST['rent_agreement'];

                           $rent_agreement = str_replace(' ', '+', $rent_agreement_incoded);

                           $rent_agreementData = base64_decode($rent_agreement);

                           $rent_agreement = uniqid() . '.pdf';

                           $rent_agreement_file = APPPATH.'../all-uploaded-img/businesskyc/' . $rent_agreement;

                           $success = file_put_contents($rent_agreement_file, $rent_agreementData);

                           $mainData['rent_agreement'] = $rent_agreement;

                    }



                    if (isset($_POST['electricity_bill']) && !empty($_POST['electricity_bill'])) {

                           $electricity_bill_incoded = $_POST['electricity_bill'];

                           $electricity_bill = str_replace(' ', '+', $electricity_bill_incoded);

                           $electricity_billData = base64_decode($electricity_bill);

                           $electricity_bill = uniqid() . '.pdf';

                           $electricity_bill_file = APPPATH.'../all-uploaded-img/businesskyc/' . $electricity_bill;

                           $success = file_put_contents($electricity_bill_file, $electricity_billData);

                           $mainData['electricity_bill'] = $electricity_bill;

                    }



                    if (isset($_POST['primary_partner_adhar_document']) && !empty($_POST['primary_partner_adhar_document'])) {

                           $primary_partner_adhar_document_incoded = $_POST['primary_partner_adhar_document'];

                           $primary_partner_adhar_document = str_replace(' ', '+', $primary_partner_adhar_document_incoded);

                           $primary_partner_adhar_documentData = base64_decode($primary_partner_adhar_document);

                           $primary_partner_adhar_document = uniqid() . '.pdf';

                           $primary_partner_adhar_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $primary_partner_adhar_document;

                           $success = file_put_contents($primary_partner_adhar_document_file, $primary_partner_adhar_documentData);

                           $mainData['primary_partner_adhar_document'] = $primary_partner_adhar_document;

                    }



                    if (isset($_POST['primary_partner_pan_document']) && !empty($_POST['primary_partner_pan_document'])) {

                           $primary_partner_pan_document_incoded = $_POST['primary_partner_pan_document'];

                           $primary_partner_pan_document = str_replace(' ', '+', $primary_partner_pan_document_incoded);

                           $primary_partner_pan_documentData = base64_decode($primary_partner_pan_document);

                           $primary_partner_pan_document = uniqid() . '.pdf';

                           $primary_partner_pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $primary_partner_pan_document;

                           $success = file_put_contents($primary_partner_pan_document_file, $primary_partner_pan_documentData);

                           $mainData['primary_partner_pan_document'] = $primary_partner_pan_document;

                    }



                    if (isset($_POST['gst_certificate']) && !empty($_POST['gst_certificate'])) {

                           $gst_certificate_incoded = $_POST['gst_certificate'];

                           $gst_certificate = str_replace(' ', '+', $gst_certificate_incoded);

                           $gst_certificateData = base64_decode($gst_certificate);

                           $gst_certificate = uniqid() . '.pdf';

                           $gst_certificate_file = APPPATH.'../all-uploaded-img/businesskyc/' . $gst_certificate;

                           $success = file_put_contents($gst_certificate_file, $gst_certificateData);

                           $mainData['gst_certificate'] = $gst_certificate;

                    }





                    if (isset($_POST['self_declaration_document']) && !empty($_POST['self_declaration_document'])) {

                           $self_declaration_document_incoded = $_POST['self_declaration_document'];

                           $self_declaration_document = str_replace(' ', '+', $self_declaration_document_incoded);

                           $self_declaration_documentData = base64_decode($self_declaration_document);

                           $self_declaration_document = uniqid() . '.pdf';

                           $self_declaration_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $self_declaration_document;

                           $success = file_put_contents($self_declaration_document_file, $self_declaration_documentData);

                           $mainData['self_declaration_document'] = $self_declaration_document;

                    }



                    if (isset($_POST['partnership_deed']) && !empty($_POST['partnership_deed'])) {

                           $partnership_deed_incoded = $_POST['partnership_deed'];

                           $partnership_deed = str_replace(' ', '+', $partnership_deed_incoded);

                           $partnership_deedData = base64_decode($partnership_deed);

                           $partnership_deed = uniqid() . '.pdf';

                           $partnership_deed_file = APPPATH.'../all-uploaded-img/businesskyc/' . $partnership_deed;

                           $success = file_put_contents($partnership_deed_file, $partnership_deedData);

                           $mainData['partnership_deed'] = $partnership_deed;

                    }



                    if (isset($_POST['business_pan_document']) && !empty($_POST['business_pan_document'])) {

                           $business_pan_document_incoded = $_POST['business_pan_document'];

                           $business_pan_document = str_replace(' ', '+', $business_pan_document_incoded);

                           $business_pan_documentData = base64_decode($business_pan_document);

                           $business_pan_document = uniqid() . '.pdf';

                           $business_pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $business_pan_document;

                           $success = file_put_contents($business_pan_document_file, $business_pan_documentData);

                           $mainData['business_pan_document'] = $business_pan_document;

                    }



                    $mainData['business_type'] = $this->input->post('business_type',true);

                    $mainData['business_name'] = $this->input->post('business_name',true);

                    $mainData['business_contact'] = $this->input->post('business_contact',true);

                    $mainData['business_email'] = $this->input->post('business_email',true);

                    $mainData['business_address'] = $this->input->post('business_address',true);

                    $mainData['clinic_code'] = $this->input->post('clinic_code',true);

                    $mainData['address_type'] = $this->input->post('address_type',true);

                    $mainData['owner_name'] = $this->input->post('owner_name',true);

                    $mainData['primary_partner_aadhar_no'] = $this->input->post('primary_partner_aadhar_no',true);

                    $mainData['primary_partner_pan_no'] = $this->input->post('primary_partner_pan_no',true);

                    $mainData['business_pan'] = $this->input->post('business_pan',true);

                    $mainData['current_status'] = 'requested';

                    $mainData['requested_date'] = date('Y-m-d H:i:s');

                    $mainData['c_by'] = $this->input->post('c_by',true);

                    $mainData['c_date'] = date('Y-m-d H:i:s');

                    $mainData['gst_no'] = $this->input->post('gst_no',true);

                    $mainData['registration_no'] = $this->input->post('registration_no',true);

                    

                    $kyc_id = $this->BusinessKyc_model->businessKycBasic_save($mainData);





                    $partners_name = json_decode($this->input->post('partners_name'),true);

                    $partners_contact = json_decode($this->input->post('partners_contact'),true);

                    $partners_email = json_decode($this->input->post('partners_email'),true);



                    if(!empty($partners_name))

                    {

                        foreach ($partners_name as $key => $value) {

                            

                            $mData = [];

                            $mData['name'] = $value;

                            $mData['mobile'] = $partners_contact[$key];

                            $mData['email'] = $partners_email[$key];

                            $mData['clinic_code'] = $this->input->post('clinic_code',true);

                            $mData['kyc_id'] = $kyc_id;

                            $mData['status'] = 1;

                            $this->BusinessKyc_model->businessKycPartners_save($mData);

                        }

                    }



                    $this->response(['status'=>true, 'response_data'=>'4', 'Message'=>'Successfully Requested', 'response_code'=>REST_Controller::HTTP_OK]);



                }

            }elseif($business_type==4)

            {

                /*Propritorship*/

                if($this->input->post('clinic_code')=='')

                {

                    $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'clinic_code required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {   



                    $mainData = [];



                    if($this->input->post('address_type')==2)

                    {

                        if($this->input->post('rent_agreement')=='')

                        {

                            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'rent_agreement required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                            return 0;

                        }

                    }

                    if (isset($_POST['shop_with_bill_board']) && !empty($_POST['shop_with_bill_board'])) {

                           $shop_with_bill_board_incoded = $_POST['shop_with_bill_board'];

                           $shop_with_bill_board = str_replace(' ', '+', $shop_with_bill_board_incoded);

                           $shop_with_bill_boardData = base64_decode($shop_with_bill_board);

                           $shop_with_bill_board = uniqid() . '.jpg';

                           $shop_with_bill_board_file = APPPATH.'../all-uploaded-img/businesskyc/' . $shop_with_bill_board;

                           $success = file_put_contents($shop_with_bill_board_file, $shop_with_bill_boardData);

                           $mainData['shop_with_bill_board'] = $shop_with_bill_board;

                    }





                    if (isset($_POST['rent_agreement']) && !empty($_POST['rent_agreement'])) {

                           $rent_agreement_incoded = $_POST['rent_agreement'];

                           $rent_agreement = str_replace(' ', '+', $rent_agreement_incoded);

                           $rent_agreementData = base64_decode($rent_agreement);

                           $rent_agreement = uniqid() . '.pdf';

                           $rent_agreement_file = APPPATH.'../all-uploaded-img/businesskyc/' . $rent_agreement;

                           $success = file_put_contents($rent_agreement_file, $rent_agreementData);

                           $mainData['rent_agreement'] = $rent_agreement;

                    }



                    if (isset($_POST['electricity_bill']) && !empty($_POST['electricity_bill'])) {

                           $electricity_bill_incoded = $_POST['electricity_bill'];

                           $electricity_bill = str_replace(' ', '+', $electricity_bill_incoded);

                           $electricity_billData = base64_decode($electricity_bill);

                           $electricity_bill = uniqid() . '.pdf';

                           $electricity_bill_file = APPPATH.'../all-uploaded-img/businesskyc/' . $electricity_bill;

                           $success = file_put_contents($electricity_bill_file, $electricity_billData);

                           $mainData['electricity_bill'] = $electricity_bill;

                    }



                    if (isset($_POST['primary_director_aadhar_document']) && !empty($_POST['primary_director_aadhar_document'])) {

                           $primary_director_aadhar_document_incoded = $_POST['primary_director_aadhar_document'];

                           $primary_director_aadhar_document = str_replace(' ', '+', $primary_director_aadhar_document_incoded);

                           $primary_director_aadhar_documentData = base64_decode($primary_director_aadhar_document);

                           $primary_director_aadhar_document = uniqid() . '.pdf';

                           $primary_director_aadhar_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $primary_director_aadhar_document;

                           $success = file_put_contents($primary_director_aadhar_document_file, $primary_director_aadhar_documentData);

                           $mainData['primary_director_aadhar_document'] = $primary_director_aadhar_document;

                    }



                    if (isset($_POST['primary_director_pan_document']) && !empty($_POST['primary_director_pan_document'])) {

                           $primary_director_pan_document_incoded = $_POST['primary_director_pan_document'];

                           $primary_director_pan_document = str_replace(' ', '+', $primary_director_pan_document_incoded);

                           $primary_director_pan_documentData = base64_decode($primary_director_pan_document);

                           $primary_director_pan_document = uniqid() . '.pdf';

                           $primary_director_pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $primary_director_pan_document;

                           $success = file_put_contents($primary_director_pan_document_file, $primary_director_pan_documentData);

                           $mainData['primary_director_pan_document'] = $primary_director_pan_document;

                    }



                    if (isset($_POST['gst_certificate']) && !empty($_POST['gst_certificate'])) {

                           $gst_certificate_incoded = $_POST['gst_certificate'];

                           $gst_certificate = str_replace(' ', '+', $gst_certificate_incoded);

                           $gst_certificateData = base64_decode($gst_certificate);

                           $gst_certificate = uniqid() . '.pdf';

                           $gst_certificate_file = APPPATH.'../all-uploaded-img/businesskyc/' . $gst_certificate;

                           $success = file_put_contents($gst_certificate_file, $gst_certificateData);

                           $mainData['gst_certificate'] = $gst_certificate;

                    }





                    if (isset($_POST['self_declaration_document']) && !empty($_POST['self_declaration_document'])) {

                           $self_declaration_document_incoded = $_POST['self_declaration_document'];

                           $self_declaration_document = str_replace(' ', '+', $self_declaration_document_incoded);

                           $self_declaration_documentData = base64_decode($self_declaration_document);

                           $self_declaration_document = uniqid() . '.pdf';

                           $self_declaration_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $self_declaration_document;

                           $success = file_put_contents($self_declaration_document_file, $self_declaration_documentData);

                           $mainData['self_declaration_document'] = $self_declaration_document;

                    }





                    if (isset($_POST['business_pan_document']) && !empty($_POST['business_pan_document'])) {

                           $business_pan_document_incoded = $_POST['business_pan_document'];

                           $business_pan_document = str_replace(' ', '+', $business_pan_document_incoded);

                           $business_pan_documentData = base64_decode($business_pan_document);

                           $business_pan_document = uniqid() . '.pdf';

                           $business_pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $business_pan_document;

                           $success = file_put_contents($business_pan_document_file, $business_pan_documentData);

                           $mainData['business_pan_document'] = $business_pan_document;

                    }



                    if (isset($_POST['certificate_of_incorporation']) && !empty($_POST['certificate_of_incorporation'])) {

                           $certificate_of_incorporation_incoded = $_POST['certificate_of_incorporation'];

                           $certificate_of_incorporation = str_replace(' ', '+', $certificate_of_incorporation_incoded);

                           $certificate_of_incorporationData = base64_decode($certificate_of_incorporation);

                           $certificate_of_incorporation = uniqid() . '.pdf';

                           $certificate_of_incorporation_file = APPPATH.'../all-uploaded-img/businesskyc/' . $certificate_of_incorporation;

                           $success = file_put_contents($certificate_of_incorporation_file, $certificate_of_incorporationData);

                           $mainData['certificate_of_incorporation'] = $certificate_of_incorporation;

                    }



                    $mainData['business_type'] = $this->input->post('business_type',true);

                    $mainData['business_name'] = $this->input->post('business_name',true);

                    $mainData['business_contact'] = $this->input->post('business_contact',true);

                    $mainData['business_email'] = $this->input->post('business_email',true);

                    $mainData['business_address'] = $this->input->post('business_address',true);

                    $mainData['clinic_code'] = $this->input->post('clinic_code',true);

                    $mainData['address_type'] = $this->input->post('address_type',true);

                    $mainData['primary_director_aadhar'] = $this->input->post('primary_director_aadhar',true);

                    $mainData['primary_director_pan'] = $this->input->post('primary_director_pan',true);

                    $mainData['business_pan'] = $this->input->post('business_pan',true);

                    $mainData['current_status'] = 'requested';

                    $mainData['requested_date'] = date('Y-m-d H:i:s');

                    $mainData['c_by'] = $this->input->post('c_by',true);

                    $mainData['c_date'] = date('Y-m-d H:i:s');

                    $mainData['gst_no'] = $this->input->post('gst_no',true);

                    $mainData['registration_no'] = $this->input->post('registration_no',true);

                    

                    $kyc_id = $this->BusinessKyc_model->businessKycBasic_save($mainData);





                    $directors_name = json_decode($this->input->post('directors_name'),true);

                    $directors_contact = json_decode($this->input->post('directors_contact'),true);

                    $directors_email = json_decode($this->input->post('directors_email'),true);



                    if(!empty($directors_name))

                    {

                        foreach ($directors_name as $key => $value) {

                            

                            $mData = [];

                            $mData['name'] = $value;

                            $mData['mobile'] = $directors_contact[$key];

                            $mData['email'] = $directors_email[$key];

                            $mData['clinic_code'] = $this->input->post('clinic_code',true);

                            $mData['kyc_id'] = $kyc_id;

                            $mData['status'] = 1;

                            $this->BusinessKyc_model->businessKycPartners_save($mData);

                        }

                    }



                    $this->response(['status'=>true, 'response_data'=>'4', 'Message'=>'Successfully Requested', 'response_code'=>REST_Controller::HTTP_OK]);



                }

            }elseif($business_type==5)

            {

                /*Propritorship*/

                if($this->input->post('clinic_code')=='')

                {

                    $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'clinic_code required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {   



                    $mainData = [];



                    if($this->input->post('address_type')==2)

                    {

                        if($this->input->post('rent_agreement')=='')

                        {

                            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'rent_agreement required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                            return 0;

                        }

                    }

                    if (isset($_POST['shop_with_bill_board']) && !empty($_POST['shop_with_bill_board'])) {

                           $shop_with_bill_board_incoded = $_POST['shop_with_bill_board'];

                           $shop_with_bill_board = str_replace(' ', '+', $shop_with_bill_board_incoded);

                           $shop_with_bill_boardData = base64_decode($shop_with_bill_board);

                           $shop_with_bill_board = uniqid() . '.jpg';

                           $shop_with_bill_board_file = APPPATH.'../all-uploaded-img/businesskyc/' . $shop_with_bill_board;

                           $success = file_put_contents($shop_with_bill_board_file, $shop_with_bill_boardData);

                           $mainData['shop_with_bill_board'] = $shop_with_bill_board;

                    }





                    if (isset($_POST['rent_agreement']) && !empty($_POST['rent_agreement'])) {

                           $rent_agreement_incoded = $_POST['rent_agreement'];

                           $rent_agreement = str_replace(' ', '+', $rent_agreement_incoded);

                           $rent_agreementData = base64_decode($rent_agreement);

                           $rent_agreement = uniqid() . '.pdf';

                           $rent_agreement_file = APPPATH.'../all-uploaded-img/businesskyc/' . $rent_agreement;

                           $success = file_put_contents($rent_agreement_file, $rent_agreementData);

                           $mainData['rent_agreement'] = $rent_agreement;

                    }



                    if (isset($_POST['electricity_bill']) && !empty($_POST['electricity_bill'])) {

                           $electricity_bill_incoded = $_POST['electricity_bill'];

                           $electricity_bill = str_replace(' ', '+', $electricity_bill_incoded);

                           $electricity_billData = base64_decode($electricity_bill);

                           $electricity_bill = uniqid() . '.pdf';

                           $electricity_bill_file = APPPATH.'../all-uploaded-img/businesskyc/' . $electricity_bill;

                           $success = file_put_contents($electricity_bill_file, $electricity_billData);

                           $mainData['electricity_bill'] = $electricity_bill;

                    }



                    if (isset($_POST['primary_director_aadhar_document']) && !empty($_POST['primary_director_aadhar_document'])) {

                           $primary_director_aadhar_document_incoded = $_POST['primary_director_aadhar_document'];

                           $primary_director_aadhar_document = str_replace(' ', '+', $primary_director_aadhar_document_incoded);

                           $primary_director_aadhar_documentData = base64_decode($primary_director_aadhar_document);

                           $primary_director_aadhar_document = uniqid() . '.pdf';

                           $primary_director_aadhar_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $primary_director_aadhar_document;

                           $success = file_put_contents($primary_director_aadhar_document_file, $primary_director_aadhar_documentData);

                           $mainData['primary_director_aadhar_document'] = $primary_director_aadhar_document;

                    }



                    if (isset($_POST['primary_director_pan_document']) && !empty($_POST['primary_director_pan_document'])) {

                           $primary_director_pan_document_incoded = $_POST['primary_director_pan_document'];

                           $primary_director_pan_document = str_replace(' ', '+', $primary_director_pan_document_incoded);

                           $primary_director_pan_documentData = base64_decode($primary_director_pan_document);

                           $primary_director_pan_document = uniqid() . '.pdf';

                           $primary_director_pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $primary_director_pan_document;

                           $success = file_put_contents($primary_director_pan_document_file, $primary_director_pan_documentData);

                           $mainData['primary_director_pan_document'] = $primary_director_pan_document;

                    }



                    if (isset($_POST['gst_certificate']) && !empty($_POST['gst_certificate'])) {

                           $gst_certificate_incoded = $_POST['gst_certificate'];

                           $gst_certificate = str_replace(' ', '+', $gst_certificate_incoded);

                           $gst_certificateData = base64_decode($gst_certificate);

                           $gst_certificate = uniqid() . '.pdf';

                           $gst_certificate_file = APPPATH.'../all-uploaded-img/businesskyc/' . $gst_certificate;

                           $success = file_put_contents($gst_certificate_file, $gst_certificateData);

                           $mainData['gst_certificate'] = $gst_certificate;

                    }





                    if (isset($_POST['hdn_br_document']) && !empty($_POST['hdn_br_document'])) {

                           $hdn_br_document_incoded = $_POST['hdn_br_document'];

                           $hdn_br_document = str_replace(' ', '+', $hdn_br_document_incoded);

                           $hdn_br_documentData = base64_decode($hdn_br_document);

                           $hdn_br_document = uniqid() . '.pdf';

                           $hdn_br_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $hdn_br_document;

                           $success = file_put_contents($hdn_br_document_file, $hdn_br_documentData);

                           $mainData['br_document'] = $hdn_br_document;

                    }





                    if (isset($_POST['self_declaration_document']) && !empty($_POST['self_declaration_document'])) {

                           $self_declaration_document_incoded = $_POST['self_declaration_document'];

                           $self_declaration_document = str_replace(' ', '+', $self_declaration_document_incoded);

                           $self_declaration_documentData = base64_decode($self_declaration_document);

                           $self_declaration_document = uniqid() . '.pdf';

                           $self_declaration_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $self_declaration_document;

                           $success = file_put_contents($self_declaration_document_file, $self_declaration_documentData);

                           $mainData['self_declaration_document'] = $self_declaration_document;

                    }





                    if (isset($_POST['business_pan_document']) && !empty($_POST['business_pan_document'])) {

                           $business_pan_document_incoded = $_POST['business_pan_document'];

                           $business_pan_document = str_replace(' ', '+', $business_pan_document_incoded);

                           $business_pan_documentData = base64_decode($business_pan_document);

                           $business_pan_document = uniqid() . '.pdf';

                           $business_pan_document_file = APPPATH.'../all-uploaded-img/businesskyc/' . $business_pan_document;

                           $success = file_put_contents($business_pan_document_file, $business_pan_documentData);

                           $mainData['business_pan_document'] = $business_pan_document;

                    }



                    if (isset($_POST['certificate_of_incorporation']) && !empty($_POST['certificate_of_incorporation'])) {

                           $certificate_of_incorporation_incoded = $_POST['certificate_of_incorporation'];

                           $certificate_of_incorporation = str_replace(' ', '+', $certificate_of_incorporation_incoded);

                           $certificate_of_incorporationData = base64_decode($certificate_of_incorporation);

                           $certificate_of_incorporation = uniqid() . '.pdf';

                           $certificate_of_incorporation_file = APPPATH.'../all-uploaded-img/businesskyc/' . $certificate_of_incorporation;

                           $success = file_put_contents($certificate_of_incorporation_file, $certificate_of_incorporationData);

                           $mainData['certificate_of_incorporation'] = $certificate_of_incorporation;

                    }



                    $mainData['business_type'] = $this->input->post('business_type',true);

                    $mainData['business_name'] = $this->input->post('business_name',true);

                    $mainData['business_contact'] = $this->input->post('business_contact',true);

                    $mainData['clinic_code'] = $this->input->post('clinic_code',true);

                    $mainData['business_email'] = $this->input->post('business_email',true);

                    $mainData['business_address'] = $this->input->post('business_address',true);

                    $mainData['address_type'] = $this->input->post('address_type',true);

                    $mainData['primary_director_aadhar'] = $this->input->post('primary_director_aadhar',true);

                    $mainData['primary_director_pan'] = $this->input->post('primary_director_pan',true);

                    $mainData['business_pan'] = $this->input->post('business_pan',true);

                    $mainData['cin_no'] = $this->input->post('cin_no',true);

                    $mainData['current_status'] = 'requested';

                    $mainData['requested_date'] = date('Y-m-d H:i:s');

                    $mainData['c_by'] = $this->input->post('c_by',true);

                    $mainData['c_date'] = date('Y-m-d H:i:s');

                    $mainData['gst_no'] = $this->input->post('gst_no',true);

                    $mainData['registration_no'] = $this->input->post('registration_no',true);

                    

                    $kyc_id = $this->BusinessKyc_model->businessKycBasic_save($mainData);





                    $directors_name = json_decode($this->input->post('directors_name'),true);

                    $directors_contact = json_decode($this->input->post('directors_contact'),true);

                    $directors_email = json_decode($this->input->post('directors_email'),true);



                    if(!empty($directors_name))

                    {

                        foreach ($directors_name as $key => $value) {

                            

                            $mData = [];

                            $mData['name'] = $value;

                            $mData['mobile'] = $directors_contact[$key];

                            $mData['email'] = $directors_email[$key];

                            $mData['clinic_code'] = $this->input->post('clinic_code',true);

                            $mData['kyc_id'] = $kyc_id;

                            $mData['status'] = 1;

                            $this->BusinessKyc_model->businessKycPartners_save($mData);

                        }

                    }



                    $this->response(['status'=>true, 'response_data'=>'4', 'Message'=>'Successfully Requested', 'response_code'=>REST_Controller::HTTP_OK]);



                }

            }



        }

    }





    public function getBusinessKycDetails_post()

    {

        if($this->input->post('kycId',true)=='')

        {

            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'kycId required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $result = $this->BusinessKyc_model->getbusinesskycdetails_m($this->input->post('kycId',true));

            $result2 = $this->BusinessKyc_model->getbusinesskycpersons_m($this->input->post('kycId',true));

            

            $this->response(['status'=>true, 'response_data'=>$result,'persons'=>$result2,'base_url'=>base_url(),'Message'=>'Successfully Fetched !', 'response_code'=>REST_Controller::HTTP_OK]);

        }

        



    }





    public function updateKycStatus_post()

    {

        if($this->input->post('kyc_id',true)=='')

        {

             $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'kycId required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('remarks',true)=='')

        {

             $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Remarks required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('status',true)=='')

        {

             $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'Status required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('clinic_code',true)=='')

        {

             $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $mainData = [];

            $mainData['current_status'] = $this->input->post('status',true);

            $mainData['remarks'] = $this->input->post('remarks',true);

            $mainData['action_by'] = $this->input->post('d_by',true);

            $mainData['action_date'] = date('Y-m-d H:i:s');

            $mainData['d_by'] = $this->input->post('d_by',true);

            $mainData['d_date'] = date('Y-m-d H:i:s');

            $this->BusinessKyc_model->updatebusinesskyc_m($mainData,['id'=>$this->input->post('kyc_id',true),'status'=>1]);



            if($this->input->post('status',true)=='approved')

            {

                $this->BusinessKyc_model->updatebusinesskycclinic_m(['bsiness_kyc'=>1],['clinic_code'=>$this->input->post('clinic_code',true),'status'=>1]);

            }elseif($this->input->post('status',true)=='rejected')

            {

                $this->BusinessKyc_model->updatebusinesskycclinic_m(['bsiness_kyc'=>0],['clinic_code'=>$this->input->post('clinic_code',true),'status'=>1]);

            }   

        

            $this->response(['status'=>true, 'response_data'=>[],'Message'=>'Successfully Updated !', 'response_code'=>REST_Controller::HTTP_OK]);

        }

    }





    public function get_business_kyc_list_post()

    {



        $current_status = $this->input->post('current_status')!=""?$this->input->post('current_status'):"";

        $business_type = $this->input->post('business_type')!=""?$this->input->post('business_type'):"";

        $result = $this->BusinessKyc_model->getbusinesskycdetailslist_m($current_status,$business_type);   

        

        $this->response(['status'=>true, 'response_data'=>$result,'Message'=>'Successfully Fetched !', 'response_code'=>REST_Controller::HTTP_OK]);

    }





    public function get_business_kyc_status_post()

    {



        $clinic_code = $this->input->post('clinic_code')!=""?$this->input->post('clinic_code'):"";

        $result = $this->BusinessKyc_model->getbusinesskycdetailsStatus_m($clinic_code);   

        

        $this->response(['status'=>true, 'response_data'=>$result,'Message'=>'Successfully Fetched !', 'response_code'=>REST_Controller::HTTP_OK]);

    }











    







  

}



?>

