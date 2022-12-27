<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Vendor_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_vendor_m($data)
	    {
	    	$result = $this->db->insert('tbl_vendor_master',$data);
	    	if($result==TRUE)
	    	{
	    		return 200;
	    	}else
	    	{
	    		return 105;
	    	}
	    }
	   

	    public function get_vendor_list_m($id,$clinic_code)
	    {
	    	if($id!='')
	    	$this->db->where('id',$id);
	    	$this->db->select('
	    		id,
	    		vendor_name,
	    		vendor_firm,
	    		vendor_phone,
	    		vendor_email,
	    		vendor_telephone
	    		');
	    	$this->db->from('tbl_vendor_master');
	    	$this->db->where(['status'=>1,'clinic_code'=>$clinic_code]);
	    	$this->db->order_by('id','DESC');
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function update_vendor_m($data,$id,$clinic_code)
	    {
	    	return $this->db->update('tbl_vendor_master',$data,['id'=>$id,'clinic_code'=>$clinic_code]);
	    }

	  
	
	}
?>