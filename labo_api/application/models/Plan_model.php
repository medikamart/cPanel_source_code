<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Plan_model extends CI_Model
{
	
	public function __construct() {
        parent::__construct();
        
    }

   public function getPlanList_m()
   {
   		return $this->db->select('*')->from('tbl_plan_master')->where(['status'=>1])->get()->result_array();
   }
   public function getPlanDetails_m($planId)
   {
        return $this->db->select('*')->from('tbl_plan_master')->where(['status'=>1,'plan_id'=>$planId])->get()->result_array();
   }

   public function clinicPlanExist_m($clinic_code)
   {
        return $this->db->select('id,plan_id,amount,days')->from('tbl_plan_subscriptions_details')->where(['status'=>1,'clinic_code'=>$clinic_code])->get()->num_rows();
   }
   public function userPlanExistData_m($clinic_code)
   {
        return $this->db->select('max(end_date) end_date')->from('tbl_plan_subscriptions_details')->where(['status'=>1,'clinic_code'=>$clinic_code])->get()->result_array();
   }

   public function createSubscription_m($data)
   {
        $this->db->insert('tbl_plan_subscriptions_details',$data);
        $id = $this->db->insert_id();
        $str = 'SUBSPLAN01'.date('YmdHis').uniqid();
        return $this->db->update('tbl_plan_subscriptions_details',['subscription_id'=>$str],['id'=>$id]);
   }

   

  

}
?>