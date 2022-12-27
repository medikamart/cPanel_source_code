<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Kyc_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function saveUserKyc($data)
	    {
	    	return $this->db->insert('tbl_user_kyc',$data);
	    }

	    public function updateUserKycClinic($data,$where)
	    {
	    	return $this->db->update('tbl_clinics_master',$data,$where);
	    }


	    public function get_usersKycRequest_m($current_status)
	    {
	    	if($current_status!="")
	    			$this->db->where(['k.current_status'=>$current_status]);
	    	$base_url = base_url().'all-uploaded-img/userkyc/';
	    	return $this->db->select("u.first_name,u.middle_name,u.last_name,CONCAT('$base_url',k.user_selfi) as user_selfi,k.aadhar_no,CONCAT('$base_url',k.aadhar_front) as aadhar_front,CONCAT('$base_url',k.aadhar_back) as aadhar_back,k.pan_no,CONCAT('$base_url',k.pan_image) as pan_image,k.current_status,k.c_date,k.id,k.clinic_code")->from('tbl_user_kyc k')->join('tbl_user_master u','u.user_id=k.user_id','left')->where(['k.status'=>1])->get()->result_array();
	    }
	  	
	  	public function updateUserKyc($data,$where)
	    {
	    	return $this->db->update('tbl_user_kyc',$data,$where);
	    }


	    public function get_business_types_m()
	    {
	    	return $this->db->select('*')->from('tbl_business_type_master')->where('status',1)->get()->result_array();
	    }
	    public function getKycStatus_m($clinic_code)
	    {
	    	return $this->db->select('user_kyc,bsiness_kyc,lab_name')->from('tbl_clinics_master')->where(['status'=>1,'clinic_code'=>$clinic_code])->get()->result_array();
	    }

	    public function get_usersKycRequestStatus_m($clinic_code)
	    {
	    	if($clinic_code!="")
	    			$this->db->where(['k.clinic_code'=>$clinic_code]);
	    	$base_url = base_url().'all-uploaded-img/userkyc/';
	    	return $this->db->select("u.first_name,u.middle_name,u.last_name,CONCAT('$base_url',k.user_selfi) as user_selfi,k.aadhar_no,CONCAT('$base_url',k.aadhar_front) as aadhar_front,CONCAT('$base_url',k.aadhar_back) as aadhar_back,k.pan_no,CONCAT('$base_url',k.pan_image) as pan_image,k.current_status,k.c_date,k.id,k.clinic_code,k.action_remarks")->from('tbl_user_kyc k')->join('tbl_user_master u','u.user_id=k.user_id','left')->where(['k.status'=>1])->order_by('k.id','desc')->limit(1)->get()->result_array();
	    }
	
	}
?>