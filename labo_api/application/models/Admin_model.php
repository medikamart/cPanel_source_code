<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Admin_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function gettotalcliniccount()
	    {
	    	$data = $this->db->query("select count(id) as total from tbl_clinics_master where status = 1 ")->result_array(); 
	    	return $data[0]['total'];
	    }
	    public function gettotalnonactivecliniccount()
	    {
	    	$data = $this->db->query("select count(id) as total from tbl_clinics_master where status = 1 and expiry_date < now() ")->result_array(); 
	    	return $data[0]['total'];
	    }
	    public function gettotalactivecliniccount()
	    {
	    	$data = $this->db->query("select count(id) as total from tbl_clinics_master where status = 1 and expiry_date >= now() ")->result_array(); 
	    	return $data[0]['total'];
	    }

	    public function getclinicsDetails($status)
	    {
	    	if($status!="")
	    	{
	    		if($status=='active')
	    		{
	    			return $this->db->query("select * from tbl_clinics_master c left join tbl_business_kyc_details b on b.clinic_code = c.clinic_code where c.status = 1 and c.expiry_date >= now() ")->result_array(); 
	    		}elseif($status=='inactive')
	    		{
	    			return $this->db->query("select * from tbl_clinics_master c left join tbl_business_kyc_details b on b.clinic_code = c.clinic_code where c.status = 1 and c.expiry_date < now() ")->result_array(); 
	    		}
	    	}else
	    	{
	    		return $this->db->query("select * from tbl_clinics_master c left join tbl_business_kyc_details b on b.clinic_code = c.clinic_code where c.status = 1 ")->result_array(); 
	    	}
	    	
	    }

	
	}
?>