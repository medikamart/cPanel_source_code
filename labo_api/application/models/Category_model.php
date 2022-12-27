<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Category_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_category_m($data)
	    {
	    	return $this->db->insert('tbl_category_master',$data);
	    }
	    public function veryfy_create_category_m($category_name,$clinic_code)
	    {
	    	$this->db->select('category_name');
	    	$this->db->from('tbl_category_master');
	    	$this->db->where(['status'=>1,'category_name'=>$category_name,'clinic_code'=>$clinic_code]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function veryfy_update_category_m($category_name,$category_id,$clinic_code)
	    {
	    	$this->db->select('category_name');
	    	$this->db->from('tbl_category_master');
	    	$this->db->where(['status'=>1,'category_name'=>$category_name,'id!='=>$category_id,'clinic_code'=>$clinic_code]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function get_category_list_m($category_id,$clinic_code)
	    {
	    	if($category_id!='')
	    			$this->db->where('id',$category_id);
    		$this->db->where('clinic_code',$clinic_code);
	    	$this->db->select('category_name,id,global');
	    	$this->db->from('tbl_category_master');
	    	$this->db->where('status',1);
	    	$this->db->or_where('global',1);
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

	    public function update_category_m($data,$category_id,$clinic_code)
	    {
	    	return $this->db->update('tbl_category_master',$data,['id'=>$category_id,'clinic_code'=>$clinic_code]);
	    }

	  
	
	}
?>