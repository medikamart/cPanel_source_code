<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tool extends MY_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$this->load->view('tool/header_tool.php');
	}

	public function toolGallery()
	{
		
		$method='POST';
        $api='Tool/get_pad_images';
        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);
        // print_r($result);die;
        $d['result'] = $result['response_data'];
		$d['v'] = 'tool/tool_images.php';
		$this->load->view('template',$d);
	}
	
	public function submitImage()
	{
		if($_FILES["imagefile"]["size"] !=0)
		{
			$images = base64_encode(file_get_contents($_FILES["imagefile"]["tmp_name"]));
		}
		$method='POST';
        $api='Tool/updatePadImage';
        $data='pad_image='.$images.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);
       redirect('/Tool/toolGallery','refresh');
	}

	public function setImage()
	{
		$images = $this->input->post('images',true);
		$method='POST';
        $api='Tool/updatePadImageSet';
        $data='pad_image='.$images.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);
       echo json_encode($result,true);
	}

	public function deleteImage()
	{
		$images = $this->input->post('images',true);
		$method='POST';
        $api='Tool/deletePadImageSet';
        $data='pad_image='.$images.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);
       echo json_encode($result,true);
	}
	



}
?>
