<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		
	}

	public function login_verify_m($phone)
	{
		$this->db->select('user_name,password');
		$this->db->from('');
		$this->db->where(['']);
	}


}
