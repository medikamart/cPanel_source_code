<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');



   class Property_model extends CI_Model

   {

      public function __construct() 

      {

         parent::__construct();

           

      }



      public function generateProperty_id()

        {

            $result = $this->db->query("SELECT property_id FROM tbl_property_master WHERE status=1 order by property_id desc limit 1");

            $data = $result->result_array();

            if(empty($data))

            {

                return $str = "PROP1001";

            }else

            {

                $id = substr($data[0]['property_id'],7,strlen($data[0]['property_id']));

                $id = intval($id);

                return $str = "PROP100".($id+1);

            }

        

        }



      public function addPropertDetails($data)

      {

      	return $this->db->insert('tbl_property_master',$data);

      }



      public function propertyList($property_id,$lng,$long)

      {

         $base_url = base_url().'all-uploaded-img/property_image/';

         if($property_id!="")

                  $this->db->where('p.property_id',$property_id);

         

         return $this->db->select("p.*,CONCAT('$base_url',p.property_image) as image,c.main_category_name,CAST((6371 * acos( 
		    cos( radians('$lng,') ) 
		    * cos( radians( p.latitude ) ) 
		    * cos( radians( p.longitude ) - radians('$long') ) 
		    + sin( radians('$lng') ) 
		    * sin( radians( p.latitude ) )
		) ) AS int ) as distance")->from('tbl_property_master p')->join('tbl_main_category_master c','p.main_category_id = c.id','left')->where(['p.status'=>1])->get()->result_array();      

      }



      public function DeleteProperty($data,$where)

      {

        return $this->db->update('tbl_property_master',$data,$where);

      }

      

      public function mainCategoryList()

      {

         

         return $this->db->select("*")->from('tbl_main_category_master p')->where(['status'=>1])->get()->result_array();      

      }


      public function updateClinicLogo_m($data,$where)
      {
         return $this->db->update('tbl_clinics_master',$data,$where);
      } 

      public function getClinicLogo_m($clinic_code)
      {
         $base_url = base_url().'all-uploaded-img/clinic_logo/';
         $res = $this->db->select('logo_image')->from('tbl_clinics_master')->where(['clinic_code'=>$clinic_code])->get()->result_array();
         if(empty($res[0]['logo_image']))
         {
            return $base_url.'no_image.jpg';
         }else
         {
            return $base_url.$res[0]['logo_image'];
         }
      } 




    }

?>