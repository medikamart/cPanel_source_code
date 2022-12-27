<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan extends MY_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_plan_list()
	{
		$method='POST';
      $api='Plan/get_plan_list';
      $data='';
      $result = $this->CallAPI($api, $data, $method);
      echo json_encode($result,TRUE);
	}




}
?>
