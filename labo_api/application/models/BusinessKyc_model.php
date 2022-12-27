<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class BusinessKyc_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function businessKycBasic_save($data)
	    {
	    	$this->db->insert('tbl_business_kyc_details',$data);
	    	return $this->db->insert_id();
	    }

	    public function businessKycPartners_save($data)
	    {
	    	return $this->db->insert('tbl_kyc_persons_details',$data);
	    }

	    public function getbusinesskycdetails_m($kycId)
	    {
	    	return $this->db->select('*')->from('tbl_business_kyc_details')->where(['status'=>1,'id'=>$kycId])->limit(1)->get()->result_array();
	    }

	    public function getbusinesskycpersons_m($kycId)
	    {
	    	return $this->db->select('*')->from('tbl_kyc_persons_details')->where(['status'=>1,'kyc_id'=>$kycId])->get()->result_array();
	    }

	    public function updatebusinesskyc_m($data,$where)
	    {
	    	return $this->db->update('tbl_business_kyc_details',$data,$where);
	    }

	    public function updatebusinesskycclinic_m($data,$where)
	    {
	    	return $this->db->update('tbl_clinics_master',$data,$where);
	    }


	    public function getbusinesskycdetailslist_m($current_status,$kyc_type)
	    {
	    	if($current_status!="")
	    			$this->db->where(['current_status'=>$current_status]);
    		if($kyc_type!="")
	    			$this->db->where(['business_type'=>$kyc_type]);
	    	return $this->db->select('*')->from('tbl_business_kyc_details')->where(['status'=>1])->get()->result_array();
	    }

	    public function getbusinesskycdetailsStatus_m($clinic_code)
	    {
	    	if($clinic_code!="")
	    			$this->db->where(['clinic_code'=>$clinic_code]);
	    	return $this->db->select('*')->from('tbl_business_kyc_details')->where(['status'=>1])->order_by('id','desc')->limit(1)->get()->result_array();
	    }


	
	}
?>