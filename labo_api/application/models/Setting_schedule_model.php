<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Setting_schedule_model extends CI_Model
   {
      public function __construct() 
      {
         parent::__construct();
           
      }

    public function verifyScheduleExist($doctor_id,$property_id,$start_time,$end_time,$days)
    {
        return $this->db->select('id')->from('tbl_doctor_setting_schedule')->where(['doctor_id'=>$doctor_id,'property_id'=>$property_id,'start_time'=>$start_time,'end_time'=>$end_time,'days'=>$days])->get()->num_rows();
    }

      
    public function addSchedule($data)
    {
      	return $this->db->insert('tbl_doctor_setting_schedule',$data);
    }

      public function ScheduleList($doctor_id,$id)
      {
        
        if($doctor_id!="")
                  $this->db->where('doctor_id',$doctor_id);
        if($id!="")
                  $this->db->where('id',$id);      
         
         return $this->db->select("*")->from('tbl_doctor_setting_schedule')->where(['status'=>1])->get()->result_array();      
      }

      public function DeleteSchedule($data,$where)
      {
        return $this->db->update('tbl_doctor_setting_schedule',$data,$where);
      }


    }
?>