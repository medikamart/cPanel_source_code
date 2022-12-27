

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	
	

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('website/index');
	}

	public function aboutus()
	{
		$this->load->view('website/aboutus');
	}

	public function price()
	{
		$this->load->view('website/subscription');
	}

	public function privacy()
	{
		$this->load->view('website/privacy_policy');
	}

	public function terms()
	{
		$this->load->view('website/terms_service');
	}

	public function contact()
	{
		$this->load->view('website/contact');
	}

	public function blogs()
	{
		$this->load->view('website/blogs');
	}

	public function knowledebase()
	{
		$this->load->view('website/knowledebase');
	}

	public function payment_policy()
	{
		$this->load->view('website/payment_policy');
	}






}
?>
