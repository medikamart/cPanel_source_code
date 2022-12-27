<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class TestDetails_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_test_details_m($data)
	    {
	    	return $this->db->insert('tbl_test_details',$data);
	    }

	    public function get_sub_test_list_m($test_id)
	    {
	    	$this->db->select('
	    		t.sub_test_name,
	    		t.id,
	    		t.test_id,
	    		t.unit_id,
	    		t.test_reference_id,
	    		t.result_box,
	    		u.unit,
	    		i.input_box_name,
	    		i.box_details
	    		');
	    	$this->db->from('tbl_test_details t');
	    	$this->db->join('tbl_unit_master u','u.id=t.unit_id','left');
	    	$this->db->join('tbl_input_box_master i','i.id=t.result_box','left');
	    	$this->db->where(['t.status'=>1,'t.test_id'=>$test_id]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function update_sub_test_m($data,$sub_test_id,$clinic_code)
	    {
	    	return $this->db->update('tbl_test_details',$data,['id'=>$sub_test_id,'clinic_code'=>$clinic_code]);
	    }

	  
	
	}
?>
