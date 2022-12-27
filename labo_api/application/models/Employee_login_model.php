<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Employee_login_model extends CI_Model
   {
      public function __construct() 
      {
         parent::__construct();
           
      }
      public function verifyMobileExistOrNot($mobile_no)
      {
      	$result = $this->db->select('count(id) as total')
      	->from('tbl_employee_master')
      	->where(['mobile_no'=>$mobile_no,'status'=>1])
      	->get()->result_array();
      	if(!empty($result))
      	{
      		return $result[0]['total'];
      	}else
      	{
      		return 0;
      	}
      }

      public function getEmployeeDetails($mobile_no)
      {
      	$result = $this->db->select('id,name,role,mobile_no,password,block_status')->from('tbl_employee_master')->where(['status'=>1])->get()->result_array();
      	if(!empty($result))
      	{
      		return $result[0];
      	}else{
      		return 0;
      	}
      }


    }
?>