<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Payment_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	    }

	    public function save_payment_gateway_m($data)
	    {
	    	return $this->db->insert('tbl_payment_gateway_history',$data);
	    }

	    public function getSubscriptionNo()
	    {
	        $result = $this->db->query("SELECT subscription_id FROM tbl_plan_subscriptions_details WHERE status=1 order by subscription_id desc limit 1");
	        $data = $result->result_array();
	        if(empty($data))
	        {
	            return $str = "SUBSCRIPTION10001";
	        }else
	        {
	            $id = substr($data[0]['subscription_id'],12,strlen($data[0]['subscription_id']));
	            $id = intval($id);
	            return $str = "SUBSCRIPTION".($id+1);
	        }     
	    } 

	    public function save_subcription_data_m($data)
	    {
	    	return $this->db->insert('tbl_plan_subscriptions_details',$data);
	    }

	    public function update_subcription_data_m($data,$where)
	    {
	    	return $this->db->update('tbl_plan_subscriptions_details',$data,$where);
	    }

	    public function update_clinic_data_m($data,$where)
	    {
	    	return $this->db->update('tbl_clinics_master',$data,$where);
	    }

	    public function getSubscriptionData($subscriptionId,$status,$clinic_code)
	    {
	    	if($subscriptionId!="")
	    			$this->db->where(['subscription_id'=>$subscriptionId]);
	    	if($status!="")
	    			$this->db->where(['current_status'=>$status]);
    		if($clinic_code!="")
	    			$this->db->where(['clinic_code'=>$clinic_code]);
	        return $this->db->select("*")->from('tbl_plan_subscriptions_details')->where(['status'=>1])->order_by('subscription_id','desc')->limit(1)->get()->result_array();     
	    }


	    public function getSubscriptionDataList($clinic_code)
	    {
    		if($clinic_code!="")
	    			$this->db->where(['clinic_code'=>$clinic_code]);
	        return $this->db->select("*")->from('tbl_plan_subscriptions_details')->where(['status'=>1])->order_by('subscription_id','desc')->get()->result_array();     
	    } 

	    public function getPaymentHistory($bill_no)
	    {
	        return $this->db->select("*")->from('tbl_payment_historys')->where(['ref_no'=>$bill_no,'status'=>1])->order_by('id','desc')->get()->result_array();     
	    } 
	   

	   

	  
	
	}
?>