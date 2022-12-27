<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class WishList_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_wishlist_m($data)
	    {
	    	return $this->db->insert('tbl_wishlist_master',$data);
	    }
	    public function veryfy_create_wishlist_m($test_id,$patient_id)
	    {
	    	$this->db->select('id');
	    	$this->db->from('tbl_wishlist_master');
	    	$this->db->where(['status'=>1,'test_id'=>$test_id,'patient_id'=>$patient_id]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return 105;
	    	}else
	    	{
	    		return 200;
	    	}
	    }


	    public function get_wishlist_list_m($patient_id)
	    {
	 		$this->db->where('w.patient_id',$patient_id);
	    	$this->db->select('t.test_name,t.id as test_id,w.id as wishlist_id');
	    	$this->db->from('tbl_wishlist_master w');
	    	$this->db->join('tbl_test_master t','t.id = w.test_id','left');
	    	$this->db->where(['w.status'=>1,'t.status'=>1]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{	
	    		return $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	   

	    public function update_wishlist_m($data,$wishlist_id)
	    {
	    	return $this->db->update('tbl_wishlist_master',$data,['id'=>$wishlist_id]);
	    }

	  
	
	}
?>