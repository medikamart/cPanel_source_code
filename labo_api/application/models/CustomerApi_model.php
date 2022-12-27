<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

	class CustomerApi_model extends CI_Model

	{

		

		public function __construct() {

	        parent::__construct();

	        

	    }



	   public function createCustomer_m($data)

	   {

	   		$this->db->insert('tbl_customers_master',$data);

	   		$id = $this->db->insert_id();

	   		$str = 'CUST0'.$id;

	   		return $this->db->update('tbl_customers_master',['customer_id'=>$str],['id'=>$id]);

	   }

	  



	  public function propertyList($category,$km,$search,$lng,$long)

      {

        $base_url = base_url().'all-uploaded-img/property_image/';

        $where = " p.status = 1 ";



        if($category!="")

        		$where .= $where!=""?" AND p.main_category_id = '".$category."' ":"  p.main_category_id = '".$category."' ";

    	if($km!="")

        		$where .= $where!=""?" HAVING distance <= '".$km."' ":" HAVING distance <= '".$km."' ";



      if($search!="")

        		$where .= $where!=""?" AND (p.property_name LIKE '%".$search."%') ":" (p.property_name LIKE '%".$search."%') ";

     $sub_query = " SELECT p.property_id,p.property_name,CONCAT('$base_url',p.property_image) as image,CAST((6371 * acos( 

		    cos( radians('$lng,') ) 

		    * cos( radians( p.latitude ) ) 

		    * cos( radians( p.longitude ) - radians('$long') ) 

		    + sin( radians('$lng') ) 

		    * sin( radians( p.latitude ) )

		) ) AS int ) as distance FROM tbl_property_master p ";



		$sub_query .=" WHERE ".$where." ";

		return $this->db->query($sub_query)->result_array();

      

      }



      public function get_users_data_m($mobile)

      {

      	return $this->db->select('*')->from('tbl_customers_master')->where(['mobile'=>$mobile,'status'=>1])->limit(1)->get()->result_array();

      }


      public function get_information_center_data_m($pin,$search,$limit,$page,$verified,$rating,$state_code,$district_code)

      {

      	$offset = $page*$limit - $limit;
      	$where  = " h.status=1 ";
      	if($pin!="")
      					$where .= $where!=""?" AND h.pin_code = '".$pin."' ":" h.pin_code = '".$pin."' ";
      	if($verified!="")
      					$where .= $where!=""?" AND h.verify_status = '".$verified."' ":" h.verify_status = '".$verified."' ";
      	if($rating!="")
      					$where .= $where!=""?" AND h.rating >= '".$pin."' ":" h.rating >= '".$pin."' ";
      	if($district_code!="")
      					$where .= $where!=""?" AND h.district_code = '".$district_code."' ":" h.district_code = '".$district_code."' ";
      	if($state_code!="")
      					$where .= $where!=""?" AND h.state_code = '".$state_code."' ":" h.state_code = '".$state_code."' ";
      	if($search!="")
      	{
      		$where .= $where!=""?" AND ( h.hospital_name LIKE '%".$search."%'
      																 OR h.address_1 LIKE '%".$search."%' 
      																 OR h.address_2 LIKE '%".$search."%' 
      																 OR h.area LIKE '%".$search."%' 
      																 OR h.city LIKE '%".$search."%' 
      																 OR h.contact_no LIKE '%".$search."%'  
      																 ) ":" ( h.hospital_name LIKE '%".$search."%'
      																 OR h.address_1 LIKE '%".$search."%' 
      																 OR h.address_2 LIKE '%".$search."%' 
      																 OR h.area LIKE '%".$search."%' 
      																 OR h.city LIKE '%".$search."%' 
      																 OR h.contact_no LIKE '%".$search."%'   
      																 ) ";
      	}
      	$sub_query = " SELECT h.id,h.hospital_name,
      					h.address_1,
      					h.address_2,
      					h.area,
      					h.city,
      					h.contact_no,
      					dt.district_name,
      					st.state_name,
      					h.std_code,
      					h.rating,
      					h.comments,
      					h.verify_status,
      					h.image,
      					h.pin_code FROM tbl_hospital_master h JOIN tbl_state_master st ON st.state_code = h.state_code JOIN tbl_district_master dt ON dt.district_code = h.district_code ";
	      if($where!="")
	      			$sub_query .= " WHERE ".$where." ";
	      $sub_query .= " LIMIT ".$offset.",".$limit." ";
	      return $this->db->query($sub_query)->result_array();

      }

      public function get_information_center_count_m($pin,$search,$verified,$rating,$state_code,$district_code)

      {

      	
      	$where  = " h.status=1 ";
      	if($pin!="")
      					$where .= $where!=""?" AND h.pin_code = '".$pin."' ":" h.pin_code = '".$pin."' ";
      	if($verified!="")
      					$where .= $where!=""?" AND h.verify_status = '".$verified."' ":" h.verify_status = '".$verified."' ";
      	if($rating!="")
      					$where .= $where!=""?" AND h.rating >= '".$pin."' ":" h.rating >= '".$pin."' ";
      	if($district_code!="")
      					$where .= $where!=""?" AND h.district_code = '".$district_code."' ":" h.district_code = '".$district_code."' ";
      	if($state_code!="")
      					$where .= $where!=""?" AND h.state_code = '".$state_code."' ":" h.state_code = '".$state_code."' ";
      	if($search!="")
      	{
      		$where .= $where!=""?" AND ( h.hospital_name LIKE '%".$search."%'
      																 OR h.address_1 LIKE '%".$search."%' 
      																 OR h.address_2 LIKE '%".$search."%' 
      																 OR h.area LIKE '%".$search."%' 
      																 OR h.city LIKE '%".$search."%' 
      																 OR h.contact_no LIKE '%".$search."%'  
      																 ) ":" ( h.hospital_name LIKE '%".$search."%'
      																 OR h.address_1 LIKE '%".$search."%' 
      																 OR h.address_2 LIKE '%".$search."%' 
      																 OR h.area LIKE '%".$search."%' 
      																 OR h.city LIKE '%".$search."%' 
      																 OR h.contact_no LIKE '%".$search."%'   
      																 ) ";
      	}
      	$sub_query = " SELECT COUNT(h.id) as total FROM tbl_hospital_master h JOIN tbl_state_master st ON st.state_code = h.state_code JOIN tbl_district_master dt ON dt.district_code = h.district_code ";
	      if($where!="")
	      			$sub_query .= " WHERE ".$where." ";
	      $res = $this->db->query($sub_query)->result_array();
	      return $res[0]['total'];

      }



      public function get_state_data_m()

      {

      	return $this->db->select('state_code,state_name')->from('tbl_state_master')->where(['status'=>1])->get()->result_array();

      }

      public function get_district_data_m($state_code)

      {
      	if($state_code!="")
      				$this->db->where(['state_code'=>$state_code]);
      	return $this->db->select('district_code,district_name')->from('tbl_district_master')->where(['status'=>1])->get()->result_array();

      }


      public function saveNotification_m($data)
      {
      	$this->db->insert('tbl_notification_details',$data);
      	return $this->db->insert_id();
      }

      // public function saveNotification($data)
      // {
      // 	return $this->db->insert($data);
      // }


	  

	

	}

?>