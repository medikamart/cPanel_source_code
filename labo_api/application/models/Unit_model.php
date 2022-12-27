<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Unit_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_unit_m($data)
	    {
	    	return $this->db->insert('tbl_unit_master',$data);
	    }
	    public function veryfy_create_unit_m($unit,$clinic_code)
	    {
	    	$this->db->select('unit');
	    	$this->db->from('tbl_unit_master');
	    	$this->db->where(['status'=>1,'unit'=>$unit,'clinic_code'=>$clinic_code]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function veryfy_update_unit_m($unit,$id,$clinic_code)
	    {
	    	$this->db->select('unit');
	    	$this->db->from('tbl_unit_master');
	    	$this->db->where(['status'=>1,'unit'=>$unit,'id!='=>$id,'clinic_code'=>$clinic_code]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function get_unit_list_m($id,$clinic_code)
	    {
	    	if($id!='')
	    			$this->db->where('id',$id);
    		$this->db->where('clinic_code',$clinic_code);
	    	$this->db->select('unit,id,');
	    	$this->db->from('tbl_unit_master');
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

	    public function update_unit_m($data,$id,$clinic_code)
	    {
	    	return $this->db->update('tbl_unit_master',$data,['id'=>$id,'clinic_code'=>$clinic_code]);
	    }

	  	public function get_result_box_list_m($clinic_code)
	    {
	    	$this->db->select('*');
	    	$this->db->from('tbl_input_box_master');
	    	$this->db->where(['status'=>1]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }
	
	}
?>