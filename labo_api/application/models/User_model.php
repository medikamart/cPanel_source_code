

<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

	class User_model extends CI_Model

	{

		

		public function __construct() {

	        parent::__construct();

	        

	    }

		public function create_sub_account_m($data)

		{

			$this->db->insert('tbl_sub_accounts',$data);

			$id = $this->db->insert_id();

			$str = uniqid().date('dmYHis').$id;

			return $this->db->update('tbl_sub_accounts',['user_id'=>$str],['id'=>$id]);

		}



		public function get_role_m($clinic_code)

		{

			$qry = "select id,role_name,role_permission,global from tbl_role where (clinic_code = ? and status = 1) or global = 1";

			return $this->db->query($qry,[$clinic_code])->result_array();

		}

		public function delete_role_m($clinic_code,$user_id,$role_id)

		{

			return $this->db->update('tbl_role',['status'=>0,'d_by'=>$user_id,'d_date'=>date('Y-m-d H:i:s')],['clinic_code'=>$clinic_code,'status'=>1,'id'=>$role_id]);

		}



		public function block_status_sub_account_m($clinic_code,$user_id,$status)

		{

			return $this->db->update('tbl_sub_accounts',['block_status'=>$status,'d_by'=>$clinic_code,'d_date'=>date('Y-m-d H:i:s')],['clinic_code'=>$clinic_code,'user_id'=>$user_id]);

		}



		public function role_create_m($data)

		{

			return $this->db->insert('tbl_role',$data);

		}



		public function role_update_m($data,$role_id,$clinic_code)

		{

			return $this->db->update('tbl_role',$data,['id'=>$role_id,'clinic_code'=>$clinic_code]);

		}



		public function verifyExist_role_m($role_name,$clinic_code)

		{

			$res = $this->db->select('count(id) as total')->from('tbl_role')->where(['status'=>1,'role_name'=>$role_name,'clinic_code'=>$clinic_code])->get()->result_array();

			return $res[0]['total'];

		}



		public function get_role_id_details_m($clinic_code,$role_id)

		{

			$qry = "select id,role_name,role_permission,global from tbl_role where (clinic_code = ? and status = 1 and id = ?) or (status = 1 and id = ? and global = 1)";

			return $this->db->query($qry,[$clinic_code,$role_id,$role_id])->result_array();

		}



		public function verifyExistUpdate_role_m($role_name,$clinic_code,$role_id)

		{

			$res = $this->db->select('count(id) as total')->from('tbl_role')->where(['status'=>1,'role_name'=>$role_name,'clinic_code'=>$clinic_code,'id!='=>$role_id])->get()->result_array();

			return $res[0]['total'];

		}



		public function get_sub_users_m($clinic_code)

		{

			return $this->db->select('r.role_name,u.first_name,u.last_name,u.phone,u.email,u.blocked,u.link_status,u.user_id,u.role')->from('tbl_user_master u')->join('tbl_role r','r.id=u.role','left')->where(['u.status'=>1,'u.clinic_code'=>$clinic_code])->get()->result_array();

		}



		public function updateUserInfo_m($data,$where)

		{

			return $this->db->update('tbl_user_master',$data,$where);

		}



		public function saveFeedback_m($data)

		{

			return $this->db->insert('tbl_feedbacks',$data);

		}



		public function get_userDetails_m($user_id)

		{

			return $this->db->select('cl.phone,cl.email,cl.phone,cl.lab_name,cl.user_kyc,cl.bsiness_kyc')->from('tbl_user_master um')->join('tbl_clinics_master cl','cl.clinic_code = um.clinic_code','left')->where(['um.status'=>1,'um.user_id'=>$user_id])->get()->result_array();

		}


		public function get_userDetailsPassword_m($user_id)

		{

			return $this->db->select('um.password')->from('tbl_user_master um')->where(['um.status'=>1,'um.user_id'=>$user_id])->get()->result_array();

		}


		public function get_notificattions_m($user_id,$clinic_code)

		{
			if($user_id!="")
					$this->db->where(['user_id'=>$user_id]);
			if($clinic_code!="")
					$this->db->where(['clinic_code'=>$clinic_code]);
			return $this->db->select('*')->from('tbl_notification_details')->where(['status'=>1,'read_status'=>0])->order_by('id,read_status','desc')->limit(5)->get()->result_array();

		}

		public function get_notificattions_count_m($user_id,$clinic_code)

		{
			if($user_id!="")
					$this->db->where(['user_id'=>$user_id]);
			if($clinic_code!="")
					$this->db->where(['clinic_code'=>$clinic_code]);
			$result = $this->db->select('COUNT(id) as total')->from('tbl_notification_details')->where(['status'=>1,'read_status'=>0])->get()->result_array();
			return $result[0]['total'];

		}

		public function update_notificattions_read_m($user_id,$clinic_code,$id)
		{
			$where = [];
			$where['id'] = $id;
			if($user_id!="")
					$where['user_id'] = $user_id;
			if($clinic_code!="")
					$where['clinic_code'] = $clinic_code;
			return $this->db->update('tbl_notification_details',['read_status'=>1],$where);

		}

	  

	

	}

?>