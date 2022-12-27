<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Patient_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_patient_m($data)
	    {
	    	$result = $this->db->insert('tbl_patient_master',$data);
	    	if($result==TRUE)
	    	{
	    		return 200;
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function create_get_patient_m($data)
	    {
	    	$result = $this->db->insert('tbl_patient_master',$data);
	    	return $this->db->insert_id();
	    }
	   

	    public function get_patient_list_m($id,$clinic_code)
	    {
	    	if($id!='')
	    		$this->db->where('id',$id);
	    	$this->db->where('clinic_code',$clinic_code);
	    	$this->db->select('id,title,full_name,age,sex,month,mobile,email,address');
	    	$this->db->from('tbl_patient_master');
	    	$this->db->where('status',1);
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

	    public function update_patient_m($data,$id,$clinic_code)
	    {
	    	return $this->db->update('tbl_patient_master',$data,['id'=>$id,'clinic_code'=>$clinic_code]);
	    }
	    

	  
	
	}
?>