<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Login_m extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function check_username_m($username)
	    {
	    	
	    	$qry = "select role,first_name,last_name,clinic_code,user_id,password,current_status,blocked from tbl_user_master  where (phone = ? or email = ?) and status = 1 limit 1";
	    	return $this->db->query($qry,[$username,$username])->result_array();
	    }

	    public function check_sub_username_m($username)
	    {
	    	
	    	$this->db->select('password,block_status');
	    	$this->db->from('tbl_sub_accounts');
	    	$this->db->where(['user_name'=>$username]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows() > 0)
	    	{
	    		return $result = $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function get_admin_details_m($username)
	    {
	    	
	    	$this->db->select('name,image,user_name,lab_short_name,lab_name,logo_image,user_id as clinic_code,user_id');
	    	$this->db->from('tbl_user_master');
	    	$this->db->where(['user_name'=>$username]);
	    	$this->db->limit(1);
	    	$qry = $this->db->get();
	    	if($qry->num_rows() > 0)
	    	{
	    		return $result = $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function get_sub_account_details_m($username)
	    {
	    	
	    	$this->db->select('s.user_name as name,u.user_name,u.lab_short_name,u.lab_name,u.logo_image,s.user_id,s.clinic_code');
	    	$this->db->from('tbl_sub_accounts s');
	    	$this->db->join('tbl_user_master u','u.user_id=s.clinic_code','left');
	    	$this->db->where(['s.user_name'=>$username]);
	    	$this->db->limit(1);
	    	$qry = $this->db->get();
	    	if($qry->num_rows() > 0)
	    	{
	    		return $result = $qry->result_array();
	    	}else
	    	{
	    		return 105;
	    	}
	    }

    public function check_username_admin_m($username)
	    {
	    	
	    	$qry = "select * from tbl_admin_master  where (mobile = ? or email = ?) and status = 1 limit 1";
	    	return $this->db->query($qry,[$username,$username])->result_array();
	    }
	 
	
	}
?>