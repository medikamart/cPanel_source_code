<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Master extends MY_Controller

{

	

	public function __construct()

	{

		parent::__construct();

		if(!$this->session->userdata('logged_in'))

		{

			redirect('/Login');

		}

	}

	public function change_password()

	{

	        $d['v'] = 'master/sub_user/change_pwd';

			$this->load->view('template',$d);

	}

	public function update_password()
	{
			$sessionData = $this->session->userdata('user_data');
			$method='POST';
	        $api='User/change_password';
	        $data='user_id='.$this->session->userdata('user_data')['user_id'].'&old_password='.$this->input->post('old_password',true).'&new_password='.$this->input->post('new_password',true);
	        $result = $this->CallAPI($api, $data, $method);  
	        $status = $result['response_code'];
	        if($status==200)
	        {
	        	$this->session->set_flashdata('success',$result['Message']);
	        }else
	        {
	        	$this->session->set_flashdata('error',$result['Message']);
	        }
	        $d['v'] = 'master/sub_user/change_pwd';
			$this->load->view('template',$d);
	}

	

	public function category()

	{

			

			$method='POST';

	        $api='Category/category_master';

	        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/category/category_list';

			$this->load->view('template',$d);

	}

	public function category_master()

	{

		$action = $this->input->post('action');

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	



			$this->input->post('category_name')!=''?$category_name=$this->input->post('category_name'):$category_name='';



			$method='POST';

	        $api='Category/category_master';

	        $data='category_name='.$category_name.'&c_by='.$sessionData['user_id'].'&action=C&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('category_id')!=''?$category_id=$this->input->post('category_id'):$category_id='';

			$method='POST';

	        $api='Category/category_master';

	        $data='category_id='.$category_id.'&d_by='.$sessionData['user_id'].'&action=D&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='R')

		{

			$this->input->post('category_id')!=''?$category_id=$this->input->post('category_id'):$category_id='';

			$method='POST';

	        $api='Category/category_master';

	        $data='category_id='.$category_id.'&d_by='.$sessionData['user_id'].'&action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('category_id')!=''?$category_id=$this->input->post('category_id'):$category_id='';

			$this->input->post('category_name')!=''?$category_name=$this->input->post('category_name'):$category_name='';

			$method='POST';

	        $api='Category/category_master';

	        $data='category_id='.$category_id.'&category_name='.$category_name.'&d_by='.$sessionData['user_id'].'&action=U&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}

		

	}





	public function test()

	{

			$sessionData = $this->session->userdata('user_data');

			$method='POST';

	        $api='Category/category_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['category_list'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/unit_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method); 

	        // print_r($result);die; 

	        $d['unit_list'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/get_result_box_list';

	        $data='clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result_box_list'] = $result['response_data'];

			$method='POST';

	        $api='Test/test_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        // print_r($result);die;

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/test/test_list';

			$this->load->view('template',$d);

	}



	public function test_market()

	{

			$sessionData = $this->session->userdata('user_data');

			$method='POST';

	        $api='Category/category_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['category_list'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/unit_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['unit_list'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/get_result_box_list';

	        $data='clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result_box_list'] = $result['response_data'];

			$method='POST';

	        $api='Test/test_master';

	        $data='action=RM';

	        $result = $this->CallAPI($api, $data, $method);  

	        // print_r($result);die;

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/test/test_market';

			$this->load->view('template',$d);

	}



	public function test_master()

	{

		$action = $this->input->post('action');

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	



			$this->input->post('category_id')!=''?$category_id=$this->input->post('category_id'):$category_id='';

			$this->input->post('test_name')!=''?$test_name=$this->input->post('test_name'):$test_name='';

			$this->input->post('rate')!=''?$rate=$this->input->post('rate'):$rate=0.00;



			$method='POST';

	        $api='Test/test_master';

	        $data='category_id='.$category_id.'&test_name='.$test_name.'&rate='.$rate.'&c_by='.$sessionData['user_id'].'&action=C&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('test_id')!=''?$test_id=$this->input->post('test_id'):$test_id='';

			$method='POST';

	        $api='Test/test_master';

	        $data='test_id='.$test_id.'&d_by='.$sessionData['user_id'].'&action=D&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='R')

		{

			$this->input->post('test_id')!=''?$test_id=$this->input->post('test_id'):$test_id='';

			$method='POST';

	        $api='Test/test_master';

	        $data='test_id='.$test_id.'&action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('category_id')!=''?$category_id=$this->input->post('category_id'):$category_id='';

			$this->input->post('test_name')!=''?$test_name=$this->input->post('test_name'):$test_name='';

			$this->input->post('rate')!=''?$rate=$this->input->post('rate'):$rate=0.00;

			$this->input->post('test_id')!=''?$test_id=$this->input->post('test_id'):$test_id='';

			$method='POST';

	        $api='Test/test_master';

	        $data='category_id='.$category_id.'&test_id='.$test_id.'&test_name='.$test_name.'&rate='.$rate.'&d_by='.$sessionData['user_id'].'&action=U&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method); 

	        // print_r($result);die; 

	        echo json_encode($result,TRUE); 

		}

		

	}



	//  subtest start 



  public function get_sub_test()

	{

			$sessionData = $this->session->userdata('user_data');

			$this->input->post('test_id')!=''?$test_id = $this->input->post('test_id'):$test_id='';

			$method='POST';

	        $api='TestDetails/test_details_master';

	        $data='action=R&test_id='.$test_id.'&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);    

	        $d['result'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/unit_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['unit_list'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/get_result_box_list';

	        $data='clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result_box_list'] = $result['response_data'];

			$this->load->view('ajax/ajax_sub_test',$d);

	}



	public function get_sub_test_market()

	{

			$sessionData = $this->session->userdata('user_data');

			$this->input->post('test_id')!=''?$test_id = $this->input->post('test_id'):$test_id='';

			$method='POST';

	        $api='TestDetails/test_details_master';

	        $data='action=R&test_id='.$test_id.'&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);    

	        $d['result'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/unit_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['unit_list'] = $result['response_data'];

	        $method='POST';

	        $api='Unit/get_result_box_list';

	        $data='clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result_box_list'] = $result['response_data'];

			$this->load->view('ajax/ajax_sub_test_global',$d);

	}



	public function import_test_market()

	{

			$sessionData = $this->session->userdata('user_data');

			$this->input->post('test_id',true)!=''?$test_id = $this->input->post('test_id',true):$test_id='';

			$method='POST';

	        $api='TestMarket/test_market_import';

	        $data='test_id='.$test_id.'&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);    

	        echo json_encode($result,TRUE);

			

	}



	public function update_sub_test()

	{

		$sessionData = $this->session->userdata('user_data');

		$this->input->post('sub_test_name')!=''?$sub_test_name = $this->input->post('sub_test_name'):$sub_test_name=''; 

		$this->input->post('unit_id')!=''?$unit_id = $this->input->post('unit_id'):$unit_id=''; 

		$this->input->post('test_reference_id')!=''?$test_reference_id = $this->input->post('test_reference_id'):$test_reference_id=''; 

		$this->input->post('result_box')!=''?$result_box = $this->input->post('result_box'):$result_box='';

		$this->input->post('id')!=''?$id = $this->input->post('id'):$id='';   

	        $method='POST';

	        $api='TestDetails/test_details_master';

	        $data='action=U&sub_test_name='.$sub_test_name.'&unit_id='.$unit_id.'&test_reference_id='.$test_reference_id.'&result_box='.$result_box.'&d_by='.$sessionData['user_id'].'&sub_test_id='.$id.'&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	       	echo json_encode($result);



	}



	public function delete_sub_test()

	{

		$sessionData = $this->session->userdata('user_data');

		$this->input->post('id')!=''?$id = $this->input->post('id'):$id='';   

	        $method='POST';

	        $api='TestDetails/test_details_master';

	        $data='action=D&d_by='.$sessionData['user_id'].'&sub_test_id='.$id.'&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	       	echo json_encode($result);



	}



	public function create_sub_test()

	{

		$sessionData = $this->session->userdata('user_data');

		$this->input->post('sub_test_name')!=''?$sub_test_name = $this->input->post('sub_test_name'):$sub_test_name=''; 

		$this->input->post('unit_id')!=''?$unit_id = $this->input->post('unit_id'):$unit_id=''; 

		$this->input->post('test_reference_id')!=''?$test_reference_id = $this->input->post('test_reference_id'):$test_reference_id=''; 

		$this->input->post('result_box')!=''?$result_box = $this->input->post('result_box'):$result_box='';

		$this->input->post('test_id')!=''?$test_id = $this->input->post('test_id'):$test_id='';   

	        $method='POST';

	        $api='TestDetails/test_details_master';

	        $data='action=C&sub_test_name='.$sub_test_name.'&unit_id='.$unit_id.'&test_reference_id='.$test_reference_id.'&result_box='.$result_box.'&c_by='.$sessionData['user_id'].'&test_id='.$test_id.'&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	       	echo json_encode($result);



	}



	// sub test end



	// vendor 



	public function vendor()

	{

			$sessionData = $this->session->userdata('user_data');

			$method='POST';

	        $api='Vendor/vendor_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/vendor/vendor';

			$this->load->view('template',$d);

	}



	public function vendor_master()

	{

		$action = $this->input->post('action');

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	

			$this->input->post('vendor_name')!=''?$vendor_name=$this->input->post('vendor_name'):$vendor_name='';

			$this->input->post('vendor_firm')!=''?$vendor_firm=$this->input->post('vendor_firm'):$vendor_firm='';

			$this->input->post('vendor_phone')!=''?$vendor_phone=$this->input->post('vendor_phone'):$vendor_phone='';

			$this->input->post('vendor_email')!=''?$vendor_email=$this->input->post('vendor_email'):$vendor_email='';

			$this->input->post('vendor_telephone')!=''?$vendor_telephone=$this->input->post('vendor_telephone'):$vendor_telephone='';



			$method='POST';

	        $api='Vendor/vendor_master';

	        $data='vendor_name='.$vendor_name.'&vendor_firm='.$vendor_firm.'&vendor_phone='.$vendor_phone.'&vendor_email='.$vendor_email.'&vendor_telephone='.$vendor_telephone.'&c_by='.$sessionData['user_id'].'&action=C&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Vendor/vendor_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=D&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='R')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Vendor/vendor_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('vendor_name')!=''?$vendor_name=$this->input->post('vendor_name'):$vendor_name='';

			$this->input->post('vendor_firm')!=''?$vendor_firm=$this->input->post('vendor_firm'):$vendor_firm='';

			$this->input->post('vendor_phone')!=''?$vendor_phone=$this->input->post('vendor_phone'):$vendor_phone='';

			$this->input->post('vendor_email')!=''?$vendor_email=$this->input->post('vendor_email'):$vendor_email='';

			$this->input->post('vendor_telephone')!=''?$vendor_telephone=$this->input->post('vendor_telephone'):$vendor_telephone='';

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';



			$method='POST';

	        $api='Vendor/vendor_master';

	        $data='vendor_name='.$vendor_name.'&vendor_firm='.$vendor_firm.'&vendor_phone='.$vendor_phone.'&vendor_email='.$vendor_email.'&vendor_telephone='.$vendor_telephone.'&id='.$id.'&d_by='.$sessionData['user_id'].'&action=U&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}

		

	}



	// patient

	public function patient()

	{

			$sessionData = $this->session->userdata('user_data');

			$method='POST';

	        $api='Patient/patient_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method); 

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/patient/patient';

			$this->load->view('template',$d);

	}



	public function patient_master()

	{

		$action = $this->input->post('action');

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	

			$this->input->post('title')!=''?$title=$this->input->post('title'):$title='';

			$this->input->post('full_name')!=''?$full_name=$this->input->post('full_name'):$full_name='';

			$this->input->post('age')!=''?$age=$this->input->post('age'):$age='';

			$this->input->post('sex')!=''?$sex=$this->input->post('sex'):$sex='';

			$this->input->post('month')!=''?$month=$this->input->post('month'):$month='';

			$this->input->post('mobile')!=''?$mobile=$this->input->post('mobile'):$mobile='';

			$this->input->post('email')!=''?$email=$this->input->post('email'):$email='';

			$this->input->post('address')!=''?$address=$this->input->post('address'):$address='';



			$method='POST';

	        $api='Patient/patient_master';

	        $data='title='.$title.'&full_name='.$full_name.'&age='.$age.'&month='.$month.'&sex='.$sex.'&mobile='.$mobile.'&email='.$email.'&address='.$address.'&c_by='.$sessionData['user_id'].'&action=C&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Patient/patient_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=D&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='R')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Patient/patient_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('title')!=''?$title=$this->input->post('title'):$title='';

			$this->input->post('full_name')!=''?$full_name=$this->input->post('full_name'):$full_name='';

			$this->input->post('age')!=''?$age=$this->input->post('age'):$age='';

			$this->input->post('month')!=''?$month=$this->input->post('month'):$month='';

			$this->input->post('sex')!=''?$sex=$this->input->post('sex'):$sex='';

			$this->input->post('mobile')!=''?$mobile=$this->input->post('mobile'):$mobile='';

			$this->input->post('email')!=''?$email=$this->input->post('email'):$email='';

			$this->input->post('address')!=''?$address=$this->input->post('address'):$address='';

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';



			$method='POST';

	        $api='Patient/patient_master';

	        $data='title='.$title.'&full_name='.$full_name.'&age='.$age.'&month='.$month.'&sex='.$sex.'&mobile='.$mobile.'&email='.$email.'&address='.$address.'&id='.$id.'&d_by='.$sessionData['user_id'].'&action=U&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}

		

	}





	// product 

	public function product()

	{

			$method='POST';

	        $api='Product/product_master';

	        $data='action=R';

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/product/product';

			$this->load->view('template',$d);

	}



	public function product_master()

	{

		$action = $this->input->post('action');

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	

			$this->input->post('product_name')!=''?$product_name=$this->input->post('product_name'):$product_name='';

			$this->input->post('product_rate')!=''?$product_rate=$this->input->post('product_rate'):$product_rate=0;

			$this->input->post('hsn_code')!=''?$hsn_code=$this->input->post('hsn_code'):$hsn_code='';

			$this->input->post('tax_rate')!=''?$tax_rate=$this->input->post('tax_rate'):$tax_rate=0;



			$method='POST';

	        $api='Product/product_master';

	        $data='product_name='.$product_name.'&product_rate='.$product_rate.'&hsn_code='.$hsn_code.'&tax_rate='.$tax_rate.'&c_by='.$sessionData['user_id'].'&action=C';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Product/product_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=D';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='R')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Product/product_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=R';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('product_name')!=''?$product_name=$this->input->post('product_name'):$product_name='';

			$this->input->post('product_rate')!=''?$product_rate=$this->input->post('product_rate'):$product_rate='';

			$this->input->post('hsn_code')!=''?$hsn_code=$this->input->post('hsn_code'):$hsn_code='';

			$this->input->post('tax_rate')!=''?$tax_rate=$this->input->post('tax_rate'):$tax_rate='';

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';



			$method='POST';

	        $api='Product/product_master';

	        $data='product_name='.$product_name.'&product_rate='.$product_rate.'&hsn_code='.$hsn_code.'&tax_rate='.$tax_rate.'&id='.$id.'&d_by='.$sessionData['user_id'].'&action=U';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}

		

	}



	// Outing 



	public function outing()

	{

			$method='POST';

	        $api='Vendor/vendor_master';

	        $data='action=R';

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['vendor_list'] = $result['response_data'];



	        $method='POST';

	        $api='Patient/patient_master';

	        $data='action=R';

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['patient_list'] = $result['response_data'];



	        $method='POST';

	        $api='Outing/outing_master';

	        $data='action=R';

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['outing_result'] = $result['response_data'];

	      

	        $d['v'] = 'master/outing/outing';

			$this->load->view('template',$d);

	}



	public function outing_master()

	{

		$action = $this->input->post('action');

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	

			$this->input->post('vendor_id')!=''?$vendor_id=$this->input->post('vendor_id'):$vendor_id='';

			$this->input->post('patient_id')!=''?$patient_id=$this->input->post('patient_id'):$patient_id='';

			$this->input->post('amount')!=''?$amount=$this->input->post('amount'):$amount='';

			$this->input->post('outing_date')!=''?$outing_date=$this->input->post('outing_date'):$outing_date=date('Y-m-d');



			$method='POST';

	        $api='Outing/outing_master';

	        $data='vendor_id='.$vendor_id.'&patient_id='.$patient_id.'&amount='.$amount.'&outing_date='.$outing_date.'&c_by='.$sessionData['user_id'].'&action=C';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Outing/outing_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=D';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='R')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Outing/outing_master';

	        $data='id='.$id.'&d_by='.$sessionData['user_id'].'&action=R';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('vendor_id')!=''?$vendor_id=$this->input->post('vendor_id'):$vendor_id='';

			$this->input->post('patient_id')!=''?$patient_id=$this->input->post('patient_id'):$patient_id='';

			$this->input->post('amount')!=''?$amount=$this->input->post('amount'):$amount='';

			$this->input->post('outing_date')!=''?$outing_date=$this->input->post('outing_date'):$outing_date=date('Y-m-d');



			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';



			$method='POST';

	        $api='Outing/outing_master';

	        $data='vendor_id='.$vendor_id.'&patient_id='.$patient_id.'&amount='.$amount.'&outing_date='.$outing_date.'&id='.$id.'&d_by='.$sessionData['user_id'].'&action=U';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}

		

	}



	// sub account 

	public function role()

	{

			$sessionData = $this->session->userdata('user_data');

			// print_r($sessionData['clinic_code']);

			$method='POST';

	        $api='User/role_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/role/role';

			$this->load->view('template',$d);

	}



	public function role_master()

	{

		

		$action = $this->input->post('action',true);

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	

			$this->input->post('data',true)!=''?$data=json_encode($this->input->post('data',true),true):$data='{}';



			$this->input->post('role_name',true)!=''?$role_name=$this->input->post('role_name',true):$role_name='';



			$method='POST';

	        $api='User/role_master';

	        $data='permission_status='.$data.'&clinic_code='.$sessionData['clinic_code'].'&user_id='.$sessionData['user_id'].'&action=C&role_name='.$role_name;

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('role_id')!=''?$role_id=$this->input->post('role_id'):$role_id='';

			$method='POST';

	        $api='User/role_master';

	        $data='role_id='.$role_id.'&clinic_code='.$sessionData['clinic_code'].'&action=D&user_id='.$sessionData['user_id'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('data',true)!=''?$data=json_encode($this->input->post('data',true),true):$data='{}';



			$this->input->post('role_name',true)!=''?$role_name=$this->input->post('role_name',true):$role_name='';



			$this->input->post('role_id',true)!=''?$role_id=$this->input->post('role_id',true):$role_id='';



			$method='POST';

	        $api='User/role_master';

	        $data='permission_status='.$data.'&clinic_code='.$sessionData['clinic_code'].'&user_id='.$sessionData['user_id'].'&action=U&role_name='.$role_name.'&role_id='.$role_id;

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='RP')

		{

			$this->input->post('clinic_code',true)!=''?$clinic_code=$this->input->post('clinic_code',true):$clinic_code="";

			$this->input->post('role_id')!=''?$role_id=$this->input->post('role_id'):$role_id='';



			$method='POST';

	        $api='User/role_master';

	        $data='clinic_code='.$sessionData['clinic_code'].'&action=RP&role_id='.$role_id;

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}

		

	}





	public function sub_user()

	{

			$sessionData = $this->session->userdata('user_data');

			

			$method='POST';

	        $api='User/role_master';

	        $data='action=R&clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['role_result'] = $result['response_data'];



			$method='POST';

	        $api='User/get_sub_users';

	        $data='clinic_code='.$sessionData['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['user_result'] = $result['response_data'];



	        $d['v'] = 'master/sub_user/sub_user';

			$this->load->view('template',$d);

	}



	public function sub_user_create()

	{



		$sessionData = $this->session->userdata('user_data');

		$method='POST';

        $api='Registration/user_create';

        $data='clinic_code='.$sessionData['clinic_code'].'&user_id='.$sessionData['user_id'].'&email='.$this->input->post('email',true).'&first_name='.$this->input->post('first_name',true).'&last_name='.$this->input->post('last_name',true).'&role_id='.$this->input->post('role_id',true);

        

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,true);

			

	}



	public function sub_user_block_status()

	{



		$sessionData = $this->session->userdata('user_data');

		$method='POST';

        $api='User/update_block_status';

        $data='clinic_code='.$sessionData['clinic_code'].'&d_by='.$sessionData['user_id'].'&user_id='.$this->input->post('user_id',true).'&blocked_status='.$this->input->post('blocked_status',true);

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,true);

			

	}



	public function sub_user_role_status()

	{



		$sessionData = $this->session->userdata('user_data');

		$method='POST';

        $api='User/update_role';

        $data='clinic_code='.$sessionData['clinic_code'].'&d_by='.$sessionData['user_id'].'&user_id='.$this->input->post('user_id',true).'&role_id='.$this->input->post('role_id',true);

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,true);

			

	}



	public function resend_email_invitaions()

	{

		$sessionData = $this->session->userdata('user_data');

		$method='POST';

        $api='Registration/resend_invitaion_email';

        $data='clinic_code='.$sessionData['clinic_code'].'&d_dy='.$sessionData['user_id'].'&user_id='.$this->input->post('user_id',true);

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,true);

			

	}





	public function unit()

	{

			

			$method='POST';

	        $api='Unit/unit_master';

	        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

	        $result = $this->CallAPI($api, $data, $method);  

	        $d['result'] = $result['response_data'];

	        $d['v'] = 'master/unit/unit';

			$this->load->view('template',$d);

	}





	public function unit_master()

	{

		

		$action = $this->input->post('action',true);

		$sessionData = $this->session->userdata('user_data');

		if($action=='C')

		{	



			$this->input->post('unit',true)!=''?$unit=$this->input->post('unit',true):$unit='';

			$method='POST';

	        $api='Unit/unit_master';

	        $data='unit='.$unit.'&clinic_code='.$sessionData['clinic_code'].'&c_by='.$sessionData['user_id'].'&action=C';

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

	       

		}elseif($action=='D')

		{

			$this->input->post('id')!=''?$id=$this->input->post('id'):$id='';

			$method='POST';

	        $api='Unit/unit_master';

	        $data='id='.$id.'&clinic_code='.$sessionData['clinic_code'].'&action=D&d_by='.$sessionData['user_id'];

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='U')

		{

			$this->input->post('unit',true)!=''?$unit=$this->input->post('unit',true):$unit='';



			$this->input->post('id',true)!=''?$id=$this->input->post('id',true):$id='';



			$method='POST';

	        $api='Unit/unit_master';

	        $data='unit='.$unit.'&clinic_code='.$sessionData['clinic_code'].'&d_by='.$sessionData['user_id'].'&action=U&id='.$id;

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}elseif($action=='R')

		{

			$this->input->post('id',true)!=''?$id=$this->input->post('id',true):$id='';

			$method='POST';

	        $api='Unit/unit_master';

	        $data='clinic_code='.$sessionData['clinic_code'].'&action=R&id='.$id;

	        $result = $this->CallAPI($api, $data, $method);  

	        echo json_encode($result,TRUE); 

		}

		

	}



	

}

?>

