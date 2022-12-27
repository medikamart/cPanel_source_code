<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Outing_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_outing_m($data)
	    {
	    	$result = $this->db->insert('tbl_outing_report',$data);
	    	if($result==TRUE)
	    	{
	    		return 200;
	    	}else
	    	{
	    		return 105;
	    	}
	    }
	   

	    public function get_outing_list_m($id)
	    {
	    	if($id!='')
	    			$this->db->where('o.id',$id);
	    	$this->db->select('
	    		o.id,
	    		v.vendor_name,
	    		o.vendor_id,
	    		o.patient_id,
	    		v.vendor_firm,
	    		p.full_name,
	    		o.amount,
	    		o.outing_date
	    		');
	    	$this->db->from('tbl_outing_report o');
	    	$this->db->join('tbl_patient_master p','p.id=o.patient_id','left');
	    	$this->db->join('tbl_vendor_master v','v.id=o.vendor_id','left');
	    	$this->db->where('o.status',1);
	    	$this->db->order_by('o.id','DESC');
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		return $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function update_outing_m($data,$id)
	    {
	    	return $this->db->update('tbl_outing_report',$data,['id'=>$id]);
	    }

	  
	
	}
?>