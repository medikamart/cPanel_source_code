<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Test_reference_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_reference_m($data)
	    {
	    	return $this->db->insert('tbl_test_refrence_master',$data);
	    }
	    public function veryfy_create_reference_m($reference)
	    {
	    	$this->db->select('reference');
	    	$this->db->from('tbl_test_refrence_master');
	    	$this->db->where(['status'=>1,'reference'=>$reference]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function veryfy_update_reference_m($reference,$id)
	    {
	    	$this->db->select('reference');
	    	$this->db->from('tbl_test_refrence_master');
	    	$this->db->where(['status'=>1,'reference'=>$reference,'id!='=>$id]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function get_reference_list_m($id)
	    {
	    	if($id!='')
	    			$this->db->where('id',$id);
	    	$this->db->select('reference,id,');
	    	$this->db->from('tbl_test_refrence_master');
	    	$this->db->where('status',1);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function update_reference_m($data,$id)
	    {
	    	return $this->db->update('tbl_test_refrence_master',$data,['id'=>$id]);
	    }

	  
	
	}
?>