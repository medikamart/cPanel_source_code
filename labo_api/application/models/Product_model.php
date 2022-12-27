<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Product_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_product_m($data)
	    {
	    	$result = $this->db->insert('tbl_product_master',$data);
	    	if($result==TRUE)
	    	{
	    		return 200;
	    	}else
	    	{
	    		return 105;
	    	}
	    }
	   

	    public function get_product_list_m($id)
	    {
	    	if($id!='')
	    	$this->db->where('id',$id);
	    	$this->db->select('
	    		id,
	    		product_name,
	    		product_rate,
	    		hsn_code,
	    		tax_rate,
	    		status
	    		');
	    	$this->db->from('tbl_product_master');
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

	    public function update_product_m($data,$id)
	    {
	    	return $this->db->update('tbl_product_master',$data,['id'=>$id]);
	    }

	  
	
	}
?>