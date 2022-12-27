<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Test_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_test_m($data)
	    {
	    	return $this->db->insert('tbl_test_master',$data);
	    }

	    public function create_test_market_m($data)
	    {
	    	$this->db->insert('tbl_test_master',$data);
	    	return $this->db->insert_id();
	    }

	    public function create_test_details_m($data)
	    {
	    	return $this->db->insert('tbl_test_details',$data);
	    }

	    public function veryfy_create_test_m($test_name,$category_id)
	    {
	    	$this->db->select('test_name');
	    	$this->db->from('tbl_test_master');
	    	$this->db->where(['status'=>1,'category_id'=>$category_id,'test_name'=>$test_name]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function veryfy_update_test_m($test_name,$category_id,$test_id,$clinic_code)
	    {
	    	$this->db->select('test_name');
	    	$this->db->from('tbl_test_master');
	    	$this->db->where(['status'=>1,'test_name'=>$test_name,'category_id'=>$category_id,'id!='=>$test_id,'clinic_code!='=>$clinic_code]);
	    	$qry = $this->db->get();
	    	// return $this->db->last_query();die;
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }

	    public function get_test_list_m($test_id,$category_id,$clinic_code)
	    {
	    	if($test_id!='')
	    			$this->db->where('t.id',$test_id);
    		if($category_id!='')
	    			$this->db->where('t.category_id',$category_id);
    		$this->db->where('t.clinic_code',$clinic_code);
	    	$this->db->select('t.test_name,t.id,t.category_id,c.category_name,t.rate');
	    	$this->db->from('tbl_test_master t');
	    	$this->db->join('tbl_category_master c','c.id = t.category_id','left');
	    	$this->db->where('t.status',1);
	    	$this->db->where('t.global',0);
	    	$this->db->order_by('t.id','DESC');
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{	$main_array = array(); 
	    		foreach($qry->result_array() as $key=>$value)
	    		{	
	    			$main_array[$key]['id'] = $value['id'];
	    			$main_array[$key]['test_name'] = $value['test_name'];
	    			$main_array[$key]['category_id'] = $value['category_id'];
	    			$main_array[$key]['category_name'] = $value['category_name'];
	    			$main_array[$key]['rate'] = $value['rate'];
	    			
	    		}
	    		return $main_array;
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function get_test_details_list_m($test_id)
	    {
	    	$this->db->select('td.sub_test_name,td.unit_id,td.test_reference_id,td.result_box,im.input_type,im.input_box_name,im.box_details,um.unit');
	    	$this->db->from('tbl_test_details td');
	    	$this->db->join('tbl_unit_master um','um.id = td.unit_id','left');
	    	$this->db->join('tbl_input_box_master im','im.id = td.result_box','left');
	    	$this->db->where(['td.status'=>1,'td.test_id'=>$test_id]);
	    	$this->db->where('td.global',0);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function get_test_list_market_m($test_id,$category_id)
	    {
	    	if($test_id!='')
	    			$this->db->where('t.id',$test_id);
    		if($category_id!='')
	    			$this->db->where('t.category_id',$category_id);
	    	$this->db->select('t.test_name,t.id,t.category_id,c.category_name,t.rate');
	    	$this->db->from('tbl_test_master t');
	    	$this->db->join('tbl_category_master c','c.id = t.category_id','left');
	    	$this->db->where('t.status',1);
	    	$this->db->where('t.global',1);
	    	$this->db->order_by('t.id','DESC');
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{	$main_array = array(); 
	    		foreach($qry->result_array() as $key=>$value)
	    		{	
	    			$main_array[$key]['id'] = $value['id'];
	    			$main_array[$key]['test_name'] = $value['test_name'];
	    			$main_array[$key]['category_id'] = $value['category_id'];
	    			$main_array[$key]['category_name'] = $value['category_name'];
	    			$main_array[$key]['rate'] = $value['rate'];
	    			
	    		}
	    		return $main_array;
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    

	    public function update_test_m($data,$test_id,$clinic_code)
	    {
	    	return $this->db->update('tbl_test_master',$data,['id'=>$test_id,'clinic_code'=>$clinic_code]);
	    }
	    public function update_sub_test_m($test_id,$clinic_code)
	    {
	    	return $this->db->update('tbl_test_details',['status'=>0],['test_id'=>$test_id,'clinic_code'=>$clinic_code]);
	    }

	    public function get_test_details_id_m($test_id,$clinic_code)
	    {
	    	$this->db->select('tm.category_id,tm.rate');
	    	$this->db->from('tbl_test_master tm');
	    	$this->db->where(['tm.status'=>1,'tm.id'=>$test_id,'tm.clinic_code'=>$clinic_code]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    	    $data = $qry->result_array();
	    		return $data[0];
	    	}else
	    	{
	    		return 'failed';
	    	}
	    }

	    public function get_test_market_m($test_id)
	    {
	    	$this->db->select('*');
	    	$this->db->from('tbl_test_master tm');
	    	$this->db->where(['tm.status'=>1,'tm.id'=>$test_id]);
	    	$qry = $this->db->get();
	    	return $data = $qry->result_array();
	    }

	    public function get_test_details_market_m($test_id)
	    {
	    	$this->db->select('*');
	    	$this->db->from('tbl_test_details tm');
	    	$this->db->where(['tm.status'=>1,'tm.test_id'=>$test_id]);
	    	$qry = $this->db->get();
	    	return $data = $qry->result_array();
	    }
	  
	
	}
?>