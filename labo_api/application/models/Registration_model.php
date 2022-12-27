<?php  

if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Registration_model extends CI_Model

	{

		

		public function __construct() {

	        parent::__construct();

	        

	    }



	    public function verifyEmail_m($email)

	    {

	    	return $this->db->select('id')->from('tbl_clinics_master')->where(['email'=>$email,'status'=>1,'current_status'=>'completed'])->get()->num_rows();

	    }

	    public function verifyPhone_m($phone)

	    {

	    	return $this->db->select('id')->from('tbl_clinics_master')->where(['phone'=>$phone,'status'=>1,'current_status'=>'completed'])->get()->num_rows();

	    }

	    public function verifyClinicExist_m($phone,$email)

	    {

	    	$qry = " select id from tbl_clinics_master where (phone = ? or email = ?) and status = 1 and current_status!='completed' ";

	    	return $this->db->query($qry,[$phone,$email])->num_rows();

	    	

	    }

	    public function verifyClinicExistData_m($phone,$email)

	    {

	    	

	    	$qry = "select current_status,clinic_code from tbl_clinics_master where (phone = ? or email = ?) and status = 1 and current_status !='completed' ";

	    	return $this->db->query($qry,[$phone,$email])->result_array();

	    	

	    }

	    public function saveCliicsInfo($data)

	    {

	    	$this->db->insert('tbl_clinics_master',$data);

	    	$id = $this->db->insert_id();

	    	$str = 'LAB0'.$id.date('dmYHis').uniqid();

	    	$this->db->update('tbl_clinics_master',['clinic_code'=>$str,'c_by'=>$str],['id'=>$id,'status'=>1]);

	    	return $str;

	    }

	    public function updateClinicsInfo($data,$clinic_code)

	    {

	    	$this->db->update('tbl_clinics_master',$data,['clinic_code'=>$clinic_code,'status'=>1]);

	    	return $clinic_code;

	    }



	    public function getEmailPhone_m($clinic_code)

	    {

	    	return $this->db->select('phone,email')->from('tbl_clinics_master')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();

	    	

	    }



	    public function verifyExistUser_m($clinic_code)

	    {

	    	return $this->db->select('phone,email')->from('tbl_clinics_master')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->num_rows();

	    	

	    }

	    public function getEmailPhoneOtp_m($clinic_code)

	    {

	    	return $this->db->select('phone_otp_expiry,email_otp_expiry,phone_otp,email_otp')->from('tbl_clinics_master')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();

	    }



	    public function createAdminUsers($data)

	    {

	    	$this->db->insert('tbl_user_master',$data);

	    	$id = $this->db->insert_id();

	    	$str = "USR00".date('dmyHis').$id;

	    	$this->db->update('tbl_user_master',['user_id'=>$str],['id'=>$id]);
	    	return $str;

	    }



	    public function getAdminUsers($clinic_code)

	    {

	    	$qry = " select phone,email,first_name,last_name,tmp_password from tbl_clinics_master where clinic_code = ? and status = 1  and current_status = 'completed' ";

	    	return $this->db->query($qry,[$clinic_code])->result_array();

	    }



	    public function verifyAdminUsers($phone,$email)

	    {

	    	$qry = " select id from tbl_user_master where (phone = ? or email = ?) and status = 1 ";

	    	return $this->db->query($qry,[$phone,$email])->num_rows();

	    }



	    public function verifyUsersEmail($email)

	    {

	    	$qry = " select id from tbl_user_master where email = ? and status = 1 ";

	    	return $this->db->query($qry,[$email])->num_rows();

	    }



	    public function verifyPasscode($passcode)

	    {

	    	$qry = " select id from tbl_user_master where password_link_passwcode = ? and status = 1 and link_status = 1 ";

	    	return $this->db->query($qry,[$passcode])->num_rows();

	    }



	    public function updateUsersData($data,$where)

	    {

	    	return $this->db->update('tbl_user_master',$data,$where);

	    }



	    public function get_emails($userId,$clinic_code)

	    {

	    	$qry = " select email from tbl_user_master where user_id = ? and status = 1 and clinic_code = ? ";

	    	return $this->db->query($qry,[$userId,$clinic_code])->result_array();

	    }



	    public function get_orgnisation_role()

	    {

	    	return $this->db->select('id,role_name')->from('registration_role_master')->where(['status'=>1])->get()->result_array();

	    }



	    public function saveOtp($data)

	    {

	    	return $this->db->insert('tbl_otp_details',$data);

	    }



	    public function getOtpDetails_m($send_to,$send_type)

	    {

	    	return $this->db->select('otp,date_time')->from('tbl_otp_details')

	    			->where(['otp_to'=>$send_to,'type'=>$send_type,'status'=>1])

	    			->order_by('date_time','desc')->get()->result_array();



	    }



	    public function getClinicsDetails_m($clinic_code)

	    {

	    	return $this->db->select('business_name')->from('tbl_business_kyc_details')

	    			->where(['clinic_code'=>$clinic_code,'status'=>1,'current_status'=>'approved'])

	    			->order_by('id','desc')->get()->result_array();



	    }

	    

	

	}

?>