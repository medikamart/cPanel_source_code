<?php

defined('BASEPATH') or exit('No direct script access allowed');

class BusinessKyc extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function business()
	{
        
        $method='POST';
        $api='Kyc/get_business_types';
        $data='';
        $result = $this->CallAPI($api, $data, $method); 
        $d['business_type'] = $result['data']; 

        $method='POST';
        $api='BusinessKyc/get_business_kyc_status';
        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method); 
        $d['kyc'] = $result['response_data']; 

        $d['v'] = 'kyc/business_kyc';
        $this->load->view('template',$d);
	}

	public function get_kyc_form()
	{	
        $form_type = $this->input->post('form_type')!=""?$this->input->post('form_type'):1;
        if($form_type==1)
        {
        	$this->load->view('ajax/unregister_kyc_form');
        }elseif($form_type==2)
        {
        	$this->load->view('ajax/propritorship_kyc_form');
        }elseif($form_type==3)
        {
        	$this->load->view('ajax/partnership_kyc_form');
        }elseif($form_type==4)
        {
        	$this->load->view('ajax/llp_kyc_form');
        }elseif($form_type==5)
        {
        	$this->load->view('ajax/pvt_kyc_form');
        }
        
	}


	public function kyc_form_submission()
	{
        $business_type = $this->input->post('business_type',true);
        if($business_type==1)
        {
        	$business_type = $this->input->post('business_type',true);
        	$business_name = $this->input->post('business_name',true);
        	$business_contact = $this->input->post('business_contact',true);
        	$business_email = $this->input->post('business_email',true);
        	$business_address = $this->input->post('business_address',true);
        	$address_type = $this->input->post('address_type',true);
        	$rent_agreement = $this->input->post('hdn_rent_agreement',true);
        	$owner_name = $this->input->post('owner_name',true);
        	$shop_with_bill_board = $this->input->post('hdn_shop_image_with_billboard',true);
        	$electricity_bill = $this->input->post('hdn_electricity_bill',true);
        	$aadhar_no = $this->input->post('aadhar_no',true);
        	$adhar_document = $this->input->post('hdn_adhar_document',true);
        	$pan_no = $this->input->post('pan_no',true);
        	$pan_document = $this->input->post('hdn_pan_document',true);
        	$c_by = $this->input->post('c_by',true);
        	$method='POST';
	        $api='BusinessKyc/business_kyc_request';
	        $data='business_type='.$business_type.'&business_name='.$business_name.'&business_contact='.$business_contact.'&business_email='.$business_email.'&business_address='.$business_address.'&address_type='.$address_type.'&rent_agreement='.$rent_agreement.'&owner_name='.$owner_name.'&shop_with_bill_board='.$shop_with_bill_board.'&electricity_bill='.$electricity_bill.'&aadhar_no='.$aadhar_no.'&adhar_document='.$adhar_document.'&pan_no='.$pan_no.'&pan_document='.$pan_document.'&c_by='.$this->session->userdata('user_data')['user_id'].'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
	        $result = $this->CallAPI($api, $data, $method);
	        if($result['response_code']==200)
	        {	
	        	$this->session->set_flashdata('success', $result['Message']);
	            redirect('BusinessKyc/business','refresh');
	        }else
	        {
	        	$this->session->set_flashdata('error', $result['Message']);
	    			redirect('BusinessKyc/business', 'refresh');
	        }
        }elseif($business_type==2)
        {
        	$business_type = $this->input->post('business_type',true);
        	$business_name = $this->input->post('business_name',true);
        	$business_contact = $this->input->post('business_contact',true);
        	$business_email = $this->input->post('business_email',true);
        	$business_address = $this->input->post('business_address',true);
        	$address_type = $this->input->post('address_type',true);
        	$rent_agreement = $this->input->post('hdn_rent_agreement',true);
        	$owner_name = $this->input->post('owner_name',true);
        	$shop_with_bill_board = $this->input->post('hdn_shop_image_with_billboard',true);
        	$electricity_bill = $this->input->post('hdn_electricity_bill',true);
        	$aadhar_no = $this->input->post('aadhar_no',true);
        	$adhar_document = $this->input->post('hdn_adhar_document',true);
        	$pan_no = $this->input->post('pan_no',true);
        	$pan_document = $this->input->post('hdn_pan_document',true);
        	$c_by = $this->input->post('c_by',true);

        	$gst_certificate = $this->input->post('hdn_gst_certificate',true);
        	$gst_no = $this->input->post('gst_no',true);
        	$registration_no = $this->input->post('registration_no',true);

        	$method='POST';
	        $api='BusinessKyc/business_kyc_request';
	        $data='business_type='.$business_type.'&business_name='.$business_name.'&business_contact='.$business_contact.'&business_email='.$business_email.'&business_address='.$business_address.'&address_type='.$address_type.'&rent_agreement='.$rent_agreement.'&owner_name='.$owner_name.'&shop_with_bill_board='.$shop_with_bill_board.'&electricity_bill='.$electricity_bill.'&aadhar_no='.$aadhar_no.'&adhar_document='.$adhar_document.'&pan_no='.$pan_no.'&pan_document='.$pan_document.'&c_by='.$this->session->userdata('user_data')['user_id'].'&gst_certificate='.$gst_certificate.'&gst_no='.$gst_no.'&registration_no='.$registration_no.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
	        $result = $this->CallAPI($api, $data, $method);
	        if($result['response_code']==200)
	        {	
	        	$this->session->set_flashdata('success', $result['Message']);
	            redirect('BusinessKyc/business','refresh');
	        }else
	        {
	        	$this->session->set_flashdata('error', $result['Message']);
	    			redirect('BusinessKyc/business', 'refresh');
	        }
        }elseif($business_type==3)
        {
        	// echo '<pre>';
        	// print_r($_POST);die;
        	$business_type = $this->input->post('business_type',true);
        	$business_name = $this->input->post('business_name',true);
        	$business_contact = $this->input->post('business_contact',true);
        	$business_email = $this->input->post('business_email',true);
        	$business_address = $this->input->post('business_address',true);
        	$address_type = $this->input->post('address_type',true);
        	$rent_agreement = $this->input->post('hdn_rent_agreement',true);
        	$shop_with_bill_board = $this->input->post('hdn_shop_image_with_billboard',true);
        	$electricity_bill = $this->input->post('hdn_electricity_bill',true);

        	$primary_partner_aadhar_no = $this->input->post('primary_partner_aadhar_no',true);
        	$primary_partner_pan_no = $this->input->post('primary_partner_pan_no',true);
        	$primary_partner_adhar_document = $this->input->post('hdn_primary_partner_adhar_document',true);
        	$primary_partner_pan_document = $this->input->post('hdn_primary_partner_pan_document',true);
        	$self_declaration_document = $this->input->post('hdn_self_declaration_document',true);
        	$partnership_deed = $this->input->post('hdn_partnership_deed',true);
        	$business_pan = $this->input->post('business_pan',true);
        	$business_pan_document = $this->input->post('hdn_business_pan_document',true);

        	$partners_name = json_encode($this->input->post('partners_name',true),true);
        	$partners_contact = json_encode($this->input->post('partners_contact',true),true);
        	$partners_email = json_encode($this->input->post('partners_email',true),true);

        	$c_by = $this->input->post('c_by',true);

        	$gst_certificate = $this->input->post('hdn_gst_certificate',true);
        	$gst_no = $this->input->post('gst_no',true);
        	$registration_no = $this->input->post('registration_no',true);
        	
        	$method='POST';
	        $api='BusinessKyc/business_kyc_request';
	        $data='business_type='.$business_type.'&business_name='.$business_name.'&business_contact='.$business_contact.'&business_email='.$business_email.'&business_address='.$business_address.'&address_type='.$address_type.'&rent_agreement='.$rent_agreement.'&shop_with_bill_board='.$shop_with_bill_board.'&electricity_bill='.$electricity_bill.'&primary_partner_aadhar_no='.$primary_partner_aadhar_no.'&primary_partner_pan_no='.$primary_partner_pan_no.'&primary_partner_adhar_document='.$primary_partner_adhar_document.'&primary_partner_pan_document='.$primary_partner_pan_document.'&self_declaration_document='.$self_declaration_document.'&partnership_deed='.$partnership_deed.'&business_pan='.$business_pan.'&business_pan_document='.$business_pan_document.'&partners_name='.$partners_name.'&partners_contact='.$partners_contact.'&partners_email='.$partners_email.'&c_by='.$this->session->userdata('user_data')['user_id'].'&gst_certificate='.$gst_certificate.'&gst_no='.$gst_no.'&registration_no='.$registration_no.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
	        $result = $this->CallAPI($api, $data, $method);
	        if($result['response_code']==200)
	        {	
	        	$this->session->set_flashdata('success', $result['Message']);
	            redirect('BusinessKyc/business','refresh');
	        }else
	        {
	        	$this->session->set_flashdata('error', $result['Message']);
	    			redirect('BusinessKyc/business', 'refresh');
	        }
        }elseif($business_type==4)
        {
        	// echo '<pre>';
        	// print_r($_POST);die;
        	$business_type = $this->input->post('business_type',true);
        	$business_name = $this->input->post('business_name',true);
        	$business_contact = $this->input->post('business_contact',true);
        	$business_email = $this->input->post('business_email',true);
        	$business_address = $this->input->post('business_address',true);
        	$address_type = $this->input->post('address_type',true);
        	$rent_agreement = $this->input->post('hdn_rent_agreement',true);
        	$shop_with_bill_board = $this->input->post('hdn_shop_image_with_billboard',true);
        	$electricity_bill = $this->input->post('hdn_electricity_bill',true);

        	$primary_director_aadhar = $this->input->post('primary_director_aadhar',true);
        	$primary_director_pan = $this->input->post('primary_director_pan',true);
        	$hdn_primary_director_aadhar_document = $this->input->post('hdn_primary_director_aadhar_document',true);
        	$hdn_primary_director_pan_document = $this->input->post('hdn_primary_director_pan_document',true);
        	$self_declaration_document = $this->input->post('hdn_self_declaration_document',true);
        	$business_pan = $this->input->post('business_pan',true);
        	$business_pan_document = $this->input->post('hdn_business_pan_document',true);

        	$directors_name = json_encode($this->input->post('directors_name',true),true);
        	$directors_contact = json_encode($this->input->post('directors_contact',true),true);
        	$directors_email = json_encode($this->input->post('directors_email',true),true);

        	$c_by = $this->input->post('c_by',true);

        	$gst_certificate = $this->input->post('hdn_gst_certificate',true);
        	$gst_no = $this->input->post('gst_no',true);
        	$registration_no = $this->input->post('registration_no',true);
        	$certificate_of_incorporation = $this->input->post('hdn_certificate_of_incorporation',true);
        	
        	$method='POST';
	        $api='BusinessKyc/business_kyc_request';
	        $data='business_type='.$business_type.'&business_name='.$business_name.'&business_contact='.$business_contact.'&business_email='.$business_email.'&business_address='.$business_address.'&address_type='.$address_type.'&rent_agreement='.$rent_agreement.'&shop_with_bill_board='.$shop_with_bill_board.'&electricity_bill='.$electricity_bill.'&primary_director_aadhar='.$primary_director_aadhar.'&primary_director_pan='.$primary_director_pan.'&primary_director_aadhar_document='.$hdn_primary_director_aadhar_document.'&primary_director_pan_document='.$hdn_primary_director_pan_document.'&self_declaration_document='.$self_declaration_document.'&business_pan='.$business_pan.'&business_pan_document='.$business_pan_document.'&directors_name='.$directors_name.'&directors_contact='.$directors_contact.'&directors_email='.$directors_email.'&c_by='.$this->session->userdata('user_data')['user_id'].'&gst_certificate='.$gst_certificate.'&gst_no='.$gst_no.'&registration_no='.$registration_no.'&certificate_of_incorporation='.$certificate_of_incorporation.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
	        $result = $this->CallAPI($api, $data, $method);
	        if($result['response_code']==200)
	        {	
	        	$this->session->set_flashdata('success', $result['Message']);
	            redirect('BusinessKyc/business','refresh');
	        }else
	        {
	        	$this->session->set_flashdata('error', $result['Message']);
	    			redirect('BusinessKyc/business', 'refresh');
	        }
        }elseif($business_type==5)
        {
        	// echo '<pre>';
        	// print_r($_POST);die;
        	$business_type = $this->input->post('business_type',true);
        	$business_name = $this->input->post('business_name',true);
        	$business_contact = $this->input->post('business_contact',true);
        	$business_email = $this->input->post('business_email',true);
        	$business_address = $this->input->post('business_address',true);
        	$address_type = $this->input->post('address_type',true);
        	$rent_agreement = $this->input->post('hdn_rent_agreement',true);
        	$shop_with_bill_board = $this->input->post('hdn_shop_image_with_billboard',true);
        	$electricity_bill = $this->input->post('hdn_electricity_bill',true);

        	$primary_director_aadhar = $this->input->post('primary_director_aadhar',true);
        	$primary_director_pan = $this->input->post('primary_director_pan',true);
        	$hdn_primary_director_aadhar_document = $this->input->post('hdn_primary_director_aadhar_document',true);
        	$hdn_primary_director_pan_document = $this->input->post('hdn_primary_director_pan_document',true);
        	$self_declaration_document = $this->input->post('hdn_self_declaration_document',true);
        	$business_pan = $this->input->post('business_pan',true);
        	$business_pan_document = $this->input->post('hdn_business_pan_document',true);

        	$directors_name = json_encode($this->input->post('directors_name',true),true);
        	$directors_contact = json_encode($this->input->post('directors_contact',true),true);
        	$directors_email = json_encode($this->input->post('directors_email',true),true);

        	$c_by = $this->input->post('c_by',true);

        	$gst_certificate = $this->input->post('hdn_gst_certificate',true);
        	$gst_no = $this->input->post('gst_no',true);
        	$registration_no = $this->input->post('registration_no',true);
        	$certificate_of_incorporation = $this->input->post('hdn_certificate_of_incorporation',true);

        	$hdn_br_document = $this->input->post('hdn_br_document',true);
        	$cin_no = $this->input->post('cin_no',true);
        	
        	$method='POST';
	        $api='BusinessKyc/business_kyc_request';
	        $data='business_type='.$business_type.'&business_name='.$business_name.'&business_contact='.$business_contact.'&business_email='.$business_email.'&business_address='.$business_address.'&address_type='.$address_type.'&rent_agreement='.$rent_agreement.'&shop_with_bill_board='.$shop_with_bill_board.'&electricity_bill='.$electricity_bill.'&primary_director_aadhar='.$primary_director_aadhar.'&primary_director_pan='.$primary_director_pan.'&primary_director_aadhar_document='.$hdn_primary_director_aadhar_document.'&primary_director_pan_document='.$hdn_primary_director_pan_document.'&self_declaration_document='.$self_declaration_document.'&business_pan='.$business_pan.'&business_pan_document='.$business_pan_document.'&directors_name='.$directors_name.'&directors_contact='.$directors_contact.'&directors_email='.$directors_email.'&c_by='.$this->session->userdata('user_data')['user_id'].'&gst_certificate='.$gst_certificate.'&gst_no='.$gst_no.'&registration_no='.$registration_no.'&certificate_of_incorporation='.$certificate_of_incorporation.'&hdn_br_document='.$hdn_br_document.'&cin_no='.$cin_no.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
	        $result = $this->CallAPI($api, $data, $method);
	        if($result['response_code']==200)
	        {	
	        	$this->session->set_flashdata('success', $result['Message']);
	            redirect('BusinessKyc/business','refresh');
	        }else
	        {
	        	$this->session->set_flashdata('error', $result['Message']);
	    			redirect('BusinessKyc/business', 'refresh');
	        }
        }
         
        
	}

	public function businesskycrequest()
	{
        $d['v'] = 'kyc/business_kyc_request';
        $this->load->view('template',$d); 
        
	}

	public function getBusinessKycListData()
	{
		$current_status = $this->input->post('current_status')!=""?$this->input->post('current_status'):"";
        $business_type = $this->input->post('business_type')!=""?$this->input->post('business_type'):"";
		$method='POST';
        $api='BusinessKyc/get_business_kyc_list';
        $data='current_status='.$current_status.'&business_type='.$business_type;
        $result = $this->CallAPI($api, $data, $method); 
        echo json_encode($result,true);
	}

	public function businesskycdetails()
	{
		error_reporting(0);
		$kycId = $this->uri->segment(3);
		$method='POST';
        $api='BusinessKyc/getBusinessKycDetails';
        $data='kycId='.$kycId;
        $result = $this->CallAPI($api, $data, $method);
        // print_r($result);die;
        
        $d['businessData'] = $result['response_data']; 
        $d['base_url'] = $result['base_url']; 
        $d['persons'] = $result['persons']; 
        $d['v'] = 'kyc/business_kyc_details';
        $this->load->view('template',$d); 
        
	}



	public function updatekycdetails()
	{
		$kycId = $this->input->post('kyc_id',true);
		$remarks = $this->input->post('remarks',true);
		$status = $this->input->post('status',true);
		$clinic_code = $this->input->post('clinic_code',true);
		$method='POST';
        $api='BusinessKyc/updateKycStatus';
        $data='kyc_id='.$kycId.'&remarks='.$remarks.'&status='.$status.'&clinic_code='.$clinic_code.'&d_by='.$this->session->userdata('user_id');
        $result = $this->CallAPI($api, $data, $method);
        // print_r($result);die;
        if($result['response_code']==200)
        {	
        	$this->session->set_flashdata('success', $result['Message']);
            redirect('BusinessKyc/businesskycdetails/'.$kycId,'refresh');
        }else
        {
        	$this->session->set_flashdata('error', $result['Message']);
    		redirect('BusinessKyc/businesskycdetails/'.$kycId, 'refresh');
        }
       
        
	}





}

?>