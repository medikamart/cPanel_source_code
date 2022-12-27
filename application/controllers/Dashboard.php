<?php



defined('BASEPATH') or exit('No direct script access allowed');





class Dashboard extends MY_Controller

{



	public function __construct()

	{

		parent::__construct();

		if(!$this->session->userdata('logged_in'))

		{

			redirect('/Login');

		}

		$this->load->helper('AccessMiddleware');

	}

	public function index()

	{	

		$d['permissions'] = checkpermissions($this->session->userdata('user_data'));

		$method='POST';

        $api='Property_c/getCinicLogo';

        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method); 
        $d['logo_image']  =  $result['data'];
        $_SESSION['logo_image'] = $d['logo_image'];
        $method='POST';

        $api='User/get_notifications';

        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&user_id='.$this->session->userdata('user_data')['user_id'];

        $result = $this->CallAPI($api, $data, $method);
        $d['total_not'] = $result['response_data']['total'];
        $d['data_not'] = $result['response_data']['data'];
        $d['v'] = 'dashboard';

		$this->load->view('template',$d);

	}



	public function dashboardReport()

	{

		$method='POST';

        $api='Report/get_dashboard_report';

        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

       	echo json_encode($result);

	}


	public function readNotification()
	{
		$method='POST';
        $api='User/update_notifications';
        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&user_id='.$this->session->userdata('user_data')['user_id'].'&id='.$this->input->post('id',true);
        $result = $this->CallAPI($api, $data, $method);  
       	echo json_encode($result);
	}



	public function dashboard7daysReport()

	{

		$method='POST';

        $api='Report/getDashboardearningGraphReport';

        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

       	echo json_encode($result);

	}

	public function dashboardCountReport()

	{

		$method='POST';

        $api='Report/dashboard_report';

        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

       	echo json_encode($result);

	}


	public function profile()

	{	
        $d['v'] = 'profile';

		$this->load->view('template',$d);

	}

	

}

?>

