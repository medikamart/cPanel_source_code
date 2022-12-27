<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Registration extends MY_Controller

{

	public function __construct()

	{

		parent::__construct();

	}



	public function register()

	{

        

        $method='POST';

        $api='Registration/get_org_role_master';

        $data='';

        $result = $this->CallAPI($api, $data, $method);  

        $d['org_role'] = $result['data'];

		$this->load->view('website/registration',$d);

	}


    public function updateLogoClinicImage()
    {

        
        $image = $this->input->post('image');
        $clinic_code = $this->session->userdata('user_data')['clinic_code'];
        $method='POST';
        $api='Property_c/updateCinicLogo';
        $data='image='.$image.'&clinic_code='.$clinic_code;
        $result = $this->CallAPI($api, $data, $method);  
        return redirect('/Dashboard');
    }



	public function register_userinfo()

	{



		$first_name = $this->input->post('first_name',true)!=''?$this->input->post('first_name',true):'';

        $last_name = $this->input->post('last_name',true)!=''?$this->input->post('last_name',true):'';

        $email = $this->input->post('email',true)!=''?$this->input->post('email',true):'';

        $phone = $this->input->post('phone',true)!=''?$this->input->post('phone',true):'';

        $password = $this->input->post('password',true)!=''?$this->input->post('password',true):'';

        $method='POST';

        $api='Registration/register';

        $data='first_name='.$first_name.'&last_name='.$last_name.'&email='.$email.'&phone='.$phone.'&password='.$password;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

	}



	public function register_sendotp()

	{

        $clinic_code = $this->input->post('clinic_code',true)!=''?$this->input->post('clinic_code',true):'';

        $method='POST';

        $api='Registration/register_send_otp';

        $data='clinic_code='.$clinic_code;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

	}



	public function register_otpVerify()

	{

        $clinic_code = $this->input->post('clinic_code',true)!=''?$this->input->post('clinic_code',true):'';

        $phoneOtp = $this->input->post('phoneOtp',true)!=''?$this->input->post('phoneOtp',true):'';

        $emailOtp = $this->input->post('emailOtp',true)!=''?$this->input->post('emailOtp',true):'';

        $method='POST';

        $api='Registration/verifyOtp';

        $data='clinic_code='.$clinic_code.'&phoneOtp='.$phoneOtp.'&emailOtp='.$emailOtp;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

	}



    public function updateLabInfo()

    {

        $clinic_code = $this->input->post('clinic_code',true)!=''?$this->input->post('clinic_code',true):'';

        $lab_full_name = $this->input->post('lab_full_name',true)!=''?$this->input->post('lab_full_name',true):'';

        $lab_short_name = $this->input->post('lab_short_name',true)!=''?$this->input->post('lab_short_name',true):'';

        $method='POST';

        $api='Registration/updateLabInfo';

        $data='clinic_code='.$clinic_code.'&lab_full_name='.$lab_full_name.'&lab_short_name='.$lab_short_name;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

    }



    public function saveSubscription()

    {

        $clinic_code = $this->input->post('clinic_code',true)!=''?$this->input->post('clinic_code',true):'';

        $plan_id = $this->input->post('plan_id',true)!=''?$this->input->post('plan_id',true):'';

        $method='POST';

        $api='Registration/purchasePlan';

        $data='clinic_code='.$clinic_code.'&plan_id='.$plan_id;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

    }



    public function sendOtp()

    {

        $send_type = $this->input->post('send_type',true)!=''?$this->input->post('send_type',true):'';

        $send_to = $this->input->post('send_to',true)!=''?$this->input->post('send_to',true):'';

        $method='POST';

        $api='Registration/send_otp';

        $data='send_to='.$send_to.'&send_type='.$send_type;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

    }



    public function verifyOtp()

    {

        $send_type = $this->input->post('send_type',true)!=''?$this->input->post('send_type',true):'';

        $send_to = $this->input->post('send_to',true)!=''?$this->input->post('send_to',true):'';

        $otp = $this->input->post('otp',true)!=''?$this->input->post('otp',true):'';

        $method='POST';

        $api='Registration/verify_otp';

        $data='send_to='.$send_to.'&send_type='.$send_type.'&otp='.$otp;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

    }



    public function finalRegistration()

    {

        $first_name = $this->input->post('first_name',true)!=''?$this->input->post('first_name',true):'';

        $middle_name = $this->input->post('middle_name',true)!=''?$this->input->post('middle_name',true):'';

        $last_name = $this->input->post('last_name',true)!=''?$this->input->post('last_name',true):'';

        $reg_role_id = $this->input->post('reg_role_id',true)!=''?$this->input->post('reg_role_id',true):'';

        $mobile = $this->input->post('mobile',true)!=''?$this->input->post('mobile',true):'';

        $email = $this->input->post('email',true)!=''?$this->input->post('email',true):'';

        $password = $this->input->post('password',true)!=''?$this->input->post('password',true):'';

        

        $method='POST';

        $api='Registration/register_now';

        $data='first_name='.$first_name.'&middle_name='.$middle_name.'&last_name='.$last_name.'&reg_role_id='.$reg_role_id.'&mobile='.$mobile.'&email='.$email.'&password='.$password;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result,TRUE);

    }







}



?>