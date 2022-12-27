<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

   class Doctor_model extends CI_Model
   {
      public function __construct() 
      {
         parent::__construct();
           
      }

      public function generateDoctor_id()
        {
            $result = $this->db->query("SELECT doctors_id FROM tbl_doctors_master WHERE status=1 order by doctors_id desc limit 1");
            $data = $result->result_array();
            if(empty($data))
            {
                return $str = "DOCTOR1001";
            }else
            {
                $id = substr($data[0]['doctors_id'],9,strlen($data[0]['doctors_id']));
                $id = intval($id);
                return $str = "DOCTOR100".($id+1);
            }
        
        }

      public function addDetails($data)
      {
      	return $this->db->insert('tbl_doctors_master',$data);
      }

      public function doctorList($doctors_id,$property_id)
      {
        if($doctors_id!="")
                  $this->db->where('doctors_id',$doctors_id);
        if($property_id!="")
                  $this->db->where('property_id',$property_id);
         
         return $this->db->select("*")->from('tbl_doctors_master')->where(['status'=>1])->get()->result_array();      
      }

      public function DeleteDoctorList($data,$where)
      {
        return $this->db->update('tbl_doctors_master',$data,$where);
      }


    }
?>