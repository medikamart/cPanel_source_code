<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Tool_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	   public function update_pad_image_m($data,$where)
	   {
	   		return $this->db->update('tbl_clinics_master',$data,$where);
	   }

	   public function update_pad_images_m($data,$where)
	   {
	   		return $this->db->update('tbl_pad_images',$data,$where);
	   }

	   public function insert_pad_image_m($data)
	   {
	   		return $this->db->insert('tbl_pad_images',$data);
	   }

	   public function get_pad_image_m($clinic_code)
	   {
	   		$path = base_url('all-uploaded-img/padimage/');
	   		return $this->db->select('id,CONCAT("'.$path.'",pad_image) as pad_image')->from('tbl_pad_images')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();
	   }

	   public function get_pad_image_cuurent_m($clinic_code)
	   {
	   		$path = base_url('all-uploaded-img/padimage/');
	   		$result = $this->db->select('id,CONCAT("'.$path.'",pad_image) as pad_image')->from('tbl_clinics_master')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();
	   		return $result[0]['pad_image'];
	   }
	
	}
?>