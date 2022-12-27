<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require_once APPPATH.'third_party/PHPMailer/Exception.php';

require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';

require_once APPPATH.'third_party/PHPMailer/SMTP.php';

require APPPATH . 'libraries/REST_Controller.php';



     

class Registration extends REST_Controller {

    public function __construct() {

       parent::__construct();

       $this->load->model("Registration_model");

       $this->load->model("Plan_model");
       $this->load->model("CustomerApi_model");
       

       

    }



    public function register_post()

    {

        

        if($this->input->post('first_name')=='')

        {

            $this->response(['status'=>false,'msg'=>'First name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('last_name')=='')

        {

            $this->response(['status'=>false,'msg'=>'Last name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('email')=='')

        {

            $this->response(['status'=>false,'msg'=>'Email is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('phone')=='')

        {

            $this->response(['status'=>false,'msg'=>'Phone is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('password')=='')

        {

            $this->response(['status'=>false,'msg'=>'Password is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {



            if($this->Registration_model->verifyEmail_m($this->input->post('email',true))>0)

            {

                $this->response(['status'=>false,'msg'=>'This email already attached please use another.','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif($this->Registration_model->verifyPhone_m($this->input->post('phone',true))>0)

            {

                $this->response(['status'=>false,'msg'=>'This phone already attached please use another.','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {

                if($this->Registration_model->verifyClinicExist_m($this->input->post('phone',true),$this->input->post('email',true))>0)

                {   

                    $uData = $this->Registration_model->verifyClinicExistData_m($this->input->post('phone',true),$this->input->post('email',true));

                    $dataArray = [];

                    $dataArray['first_name'] = $this->input->post('first_name',true);

                    $dataArray['last_name'] = $this->input->post('last_name',true);

                    $dataArray['email'] = $this->input->post('email',true);

                    $dataArray['phone'] = $this->input->post('phone',true);

                    $dataArray['tmp_password'] = md5($this->input->post('password',true));

                    $dataArray['current_status'] = 'userinfo';

                    $dataArray['d_date'] = date('Y-m-d H:i:s');

                    $dataArray['d_by'] = $uData[0]['clinic_code'];

                   $clinic_code = $this->Registration_model->updateClinicsInfo($dataArray,$uData[0]['clinic_code']);




                   $this->response(['status' => true, 'response_data'=>['clinic_code'=>$clinic_code,'current_status'=>$uData[0]['current_status']], 'msg' =>'Success' , 'status_code'=>REST_Controller::HTTP_OK]);

                }else

                {

                    $dataArray = [];

                    $dataArray['first_name'] = $this->input->post('first_name',true);

                    $dataArray['last_name'] = $this->input->post('last_name',true);

                    $dataArray['email'] = $this->input->post('email',true);

                    $dataArray['phone'] = $this->input->post('phone',true);

                    $dataArray['tmp_password'] = md5($this->input->post('password',true));

                    $dataArray['current_status'] = 'userinfo';

                    $dataArray['c_date'] = date('Y-m-d H:i:s');

                    $uId = $this->Registration_model->saveCliicsInfo($dataArray);

                    $this->response(['status' => true, 'response_data'=>['clinic_code'=>$uId,'current_status'=>'userinfo'], 'Message' =>'Success' , 'status_code'=>REST_Controller::HTTP_OK]);



                }



            }

            





        }   

    }









    public function send_otp_post()

    {

        

        if($this->input->post('send_type')=='')

        {

            $this->response(['status'=>false,'msg'=>'send_type is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('send_to')=='')

        {

            $this->response(['status'=>false,'msg'=>'send_to is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

                $phoneOtp = random_int(120000, 979999);

                $data['type'] = $this->input->post('send_type');

                if($this->input->post('send_type')=="E")

                {

                    $this->sendMailOTP($this->input->post('send_to',true),$phoneOtp);

                }elseif($this->input->post('send_type')=="M")

                {

                    $this->sendMessageMobile($this->input->post('send_to',true),$phoneOtp);

                }

                $data['otp'] = md5($phoneOtp);

                $data['date_time'] = date('Y-m-d H:i:s');

                $data['otp_to'] = $this->input->post('send_to',true);

                $data['status'] = 1;

                $this->Registration_model->saveOtp($data);

                $this->response(['status' => true, 'response_data'=>$phoneOtp, 'msg' =>'Success' , 'status_code'=>REST_Controller::HTTP_OK]);

        }   

    }



    public function send_payment_link_post()

    {

        $payment_link = $this->input->post('payment_link',true);

        $bill_no = $this->input->post('bill_no',true);

        $amount = $this->input->post('amount',true);

        $email_id = $this->input->post('email',true);

        $clinic_code = $this->input->post('clinic_code',true);

        $clinic_name = $this->Registration_model->getClinicsDetails_m($clinic_code);

        if(!empty($clinic_name))

        {

            $mail = new PHPMailer();

            $mail->IsSMTP();

            $mail->Mailer = "smtp";

            $mail->SMTPDebug = 0;

            $mail->SMTPAuth = true;

            $mail->SMTPSecure = "tls";

            $mail->Port = 587 ;

            $mail->Host = $this->mailhost;

            $mail->Username = $this->mailuser;

            $mail->Password = $this->mailpassword;

            $mail->IsHTML(true);

            $mail->SetFrom($this->mailsendfromemail, $this->mailsendfromname);

            $mail->AddAddress($email_id);

            $mail->Subject = $clinic_name[0]['business_name'].'_LAB_REPORT_PAYMENT_LINK';

            // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");

            $content = '';

            $content .= '<h3>Pay You Report Bill '.$bill_no.' Of Rs.'.$amount.'</h3>';

            $content .= '<a href="'.$payment_link.'">Pay Now</a>';

            $mail->MsgHTML($content);

            $result = $mail->Send();

            if($result)

            {

                $this->response(['status' => true, 'response_data'=>[], 'msg' =>'Success' , 'status_code'=>REST_Controller::HTTP_OK]);

            }else

            {

                $this->response(['status' => false, 'response_data'=>[], 'msg' =>'Failed To send email' , 'status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }



        }else

        {   

            $this->response(['status' => false, 'response_data'=>[], 'msg' =>'Business Kyc is pending !' , 'status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }

        



    }



    public function sendMailOTP($email,$otp)

    {

        $mail = new PHPMailer();

        $mail->IsSMTP();

        $mail->Mailer = "smtp";

        $mail->SMTPDebug = 0;

        $mail->SMTPAuth = true;

        $mail->SMTPSecure = "tls";

        $mail->Port = 587 ;

        $mail->Host = $this->mailhost;

        $mail->Username = $this->mailuser;

        $mail->Password = $this->mailpassword;

        $mail->IsHTML(true);

        $mail->SetFrom($this->mailsendfromemail, $this->mailsendfromname);

        $mail->AddAddress($email);

        $mail->Subject = 'ONE_TIME_PASSWORD_MEDIKAMART_LABO';

        // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");

        $content = '';

        $content .= '<h3>Secure OTP</h3>';

        $content .= '<p>Your One Time Password is : '.$otp.'</p>';

        $mail->MsgHTML($content);

        return $mail->Send();         

    }

    

     public function signupFoundMailOTP($email,$mobile)

    {

        $mail = new PHPMailer();

        $mail->IsSMTP();

        $mail->Mailer = "smtp";

        $mail->SMTPDebug = 0;

        $mail->SMTPAuth = true;

        $mail->SMTPSecure = "tls";

        $mail->Port = 587 ;

        $mail->Host = $this->mailhost;

        $mail->Username = $this->mailuser;

        $mail->Password = $this->mailpassword;

        $mail->IsHTML(true);

        $mail->SetFrom($this->mailsendfromemail, $this->mailsendfromname);

        $mail->AddAddress("nkkoiri111@gmail.com");

        $mail->AddAddress("Dir@medikamart.in");

        $mail->Subject = 'NEW_SIGNUP';

        // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");

        $content = '';

        $content .= '<h3>New Signup</h3>';

        $content .= '<p>New Signup Found Mobile No : '.$mobile.' On </p>'.date('d-m-Y H:i:s');

        $mail->MsgHTML($content);

        return $mail->Send();         

    }



    public function sendMessageMobile($mobile,$otp)

    {

          $path = 'https://www.fast2sms.com/dev/bulkV2?authorization=eIUREJn9LqovVDxwFhHAtuQZW51Bc80rabkSdG43sKz6ygNlC7LJiCkbSdEaP3KMV4uFwyA9DHq0cNZl&variables_values='.$otp.'&route=otp&numbers='.$mobile;

           $curl = curl_init();

            curl_setopt_array($curl, array(

              CURLOPT_URL => $path,

              CURLOPT_RETURNTRANSFER => true,

              CURLOPT_ENCODING => "",

              CURLOPT_MAXREDIRS => 10,

              CURLOPT_TIMEOUT => 0,

              CURLOPT_FOLLOWLOCATION => true,

              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

              CURLOPT_CUSTOMREQUEST => "GET",

              CURLOPT_POSTFIELDS => '',

              CURLOPT_HTTPHEADER => array(

                "x-api-key: admin@123",

                "Content-Type: application/x-www-form-urlencoded"

                // "Content-Type: multipart/form-data; boundary=--------------------------693781935039997902221478"

              ),

            ));



            $response = curl_exec($curl);

            // echo '<pre>';

            // print_r($response);die;

            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);

            return $response;



    }





    public function verify_otp_post()

    {

        

        if($this->input->post('send_type')=='')

        {

            $this->response(['status'=>false,'msg'=>'send_type is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('send_to')=='')

        {

            $this->response(['status'=>false,'msg'=>'send_to is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('otp')=='')

        {

            $this->response(['status'=>false,'msg'=>'otp is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $result = $this->Registration_model->getOtpDetails_m($this->input->post('send_to',true),$this->input->post('send_type',true));

            if(empty($result))

            {

                $this->response(['status'=>false,'msg'=>'otp details is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {

                if($this->dateDiffMin(date('Y-m-d H:i:s',strtotime($result[0]['date_time'])), date('Y-m-d H:i:s'))>2)

                {

                    $this->response(['status'=>false,'msg'=>'OTP is expired !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {

                    if($result[0]['otp'] == md5($this->input->post('otp',true)))

                    {

                        $this->response(['status' => true, 'response_data'=>[], 'msg' =>'otp matched' , 'status_code'=>REST_Controller::HTTP_OK]);

                    }else

                    {

                        $this->response(['status' => false, 'response_data'=>[], 'msg' =>'Otp not match !' , 'status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                    }

                }

            }

                

        }   

    }



    public function register_now_post()

    {

        

        if($this->input->post('first_name')=='')

        {

            $this->response(['status'=>false,'msg'=>'first_name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('last_name')=='')

        {

            $this->response(['status'=>false,'msg'=>'last_name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('reg_role_id')=='')

        {

            $this->response(['status'=>false,'msg'=>'reg_role_id is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('mobile')=='')

        {

            $this->response(['status'=>false,'msg'=>'mobile is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('email')=='')

        {

            $this->response(['status'=>false,'msg'=>'email is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

                

                

                $exist = $this->Registration_model->verifyAdminUsers($this->input->post('mobile',true),$this->input->post('email',true));

                if($exist>0)

                {

                    $this->response(['status'=>false,'msg'=>'Phone Or Email Already Exist Try Another Or Login !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                }else

                {

                    $datac['first_name'] = $this->input->post('first_name',true);

                    $datac['middle_name'] = $this->input->post('middle_name',true);

                    $datac['last_name'] = $this->input->post('last_name',true);

                    $datac['email'] = $this->input->post('email',true);

                    $datac['phone'] = $this->input->post('mobile',true);

                    $datac['status'] = 1;

                    $datac['c_date'] = date('Y-m-d H:i:s');

                    $clinic_code = $this->Registration_model->saveCliicsInfo($datac);



                    

                    $data['first_name'] = $this->input->post('first_name',true);

                    $data['middle_name'] = $this->input->post('middle_name',true);

                    $data['last_name'] = $this->input->post('last_name',true);

                    $data['email'] = $this->input->post('email',true);

                    $data['phone'] = $this->input->post('mobile',true);

                    $data['password'] = md5($this->input->post('password',true));

                    $data['reg_role_id'] = $this->input->post('reg_role_id',true);

                    $data['role'] = 1;

                    $data['status'] = 1;

                    $data['current_status'] = 'completed';

                    $data['c_date'] = date('Y-m-d H:i:s');

                    $data['clinic_code'] = $clinic_code;

                    // if (isset($_POST['user_selfi']) && !empty($_POST['user_selfi'])) {

                    //     $user_selfi_incoded = $this->input->post('user_selfi');

                    //     $user_selfi = str_replace(' ', '+', $user_selfi_incoded);

                    //     $imageData = base64_decode($user_selfi);

                    //     $user_selfi = uniqid() . '.jpg';

                    //     $data['user_selfi'] = $user_selfi;

                    //     $user_selfi_file = '../all-uploaded-img/' . $user_selfi;

                    //     $success = file_put_contents(APPPATH . $user_selfi_file, $imageData);

                    // }
                    $name = $this->input->post('first_name',true).' '.$this->input->post('middle_name',true).' '.$this->input->post('last_name',true);
                    $user_id = $this->Registration_model->createAdminUsers($data);

                    $this->signupFoundMailOTP($this->input->post('email',true),$this->input->post('mobile',true));

                      $mainData = [];
                      $mainData['message'] = "Hi ".$name." ! Welcome to Medikamart. Here is your  Dr. Labo\'s amazing dashboard.";
                      $mainData['clinic_code'] = $clinic_code;
                      $mainData['user_id'] = $user_id;
                      $mainData['date_times'] = date('Y-m-d H:i:s');
                      $mainData['read_status'] = 0;
                      $mainData['status'] = 1;
                      $this->CustomerApi_model->saveNotification_m($mainData);
                    $this->response(['status' => true, 'response_data'=>[], 'msg' =>'Success' , 'status_code'=>REST_Controller::HTTP_OK]);

                }

                

        }   

    }







    public function register_send_otp_post()

    {

        if($this->input->post('clinic_code')=='')

        {

            $this->response(['status'=>false,'msg'=>'Clinic Code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $num = $this->Registration_model->verifyExistUser_m($this->input->post('clinic_code',true));

            if($num>0)

            {

                $userData = $this->Registration_model->getEmailPhone_m($this->input->post('clinic_code',true));

                $email = $userData[0]['email'];

                $phone = $userData[0]['phone'];

                $this->sendEmailOtp($email);

                $this->sendPhoneOtp($phone);

                $phoneOtp = random_int(120000, 979999);

                $emailOtp = random_int(110000, 989999);

                $phoneOtpHash = md5($phoneOtp);

                $emailOtpHash = md5($emailOtp);

                $uId = $this->Registration_model->updateClinicsInfo(['phone_otp'=>$phoneOtpHash,'email_otp'=>$emailOtpHash,'phone_otp_expiry'=>date('Y-m-d H:i:s'),'email_otp_expiry'=>date('Y-m-d H:i:s')],$this->input->post('clinic_code',true));

                $this->response(['status' => true, 'response_data'=>['user_id'=>$uId,'phone'=>$phone,'email'=>$email,'pOtp'=>$phoneOtp,'eOtp'=>$emailOtp], 'msg' =>'Success' , 'status_code'=>REST_Controller::HTTP_OK]);

            }else

            {

                $this->response(['status'=>false,'msg'=>'Invalid User id !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

            

        }

    }



    public function verifyOtp_post()

    {

        if($this->input->post('clinic_code')=='')

        {

            $this->response(['status'=>false,'msg'=>'clinic_code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('phoneOtp')=='')

        {

            $this->response(['status'=>false,'msg'=>'Phone OTP is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('emailOtp')=='')

        {

            $this->response(['status'=>false,'msg'=>'Email OTP is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $uData = $this->Registration_model->getEmailPhoneOtp_m($this->input->post('clinic_code',true));

            if($this->dateDiffMin(date('Y-m-d H:i:s',strtotime($uData[0]['phone_otp_expiry'])), date('Y-m-d H:i:s'))>2)

            {

                $this->response(['status'=>false,'msg'=>'Phone OTP is expired !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif($this->dateDiffMin(date('Y-m-d H:i:s',strtotime($uData[0]['email_otp_expiry'])), date('Y-m-d H:i:s'))>2)

            {

                $this->response(['status'=>false,'msg'=>'Email OTP is expired !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif(md5($this->input->post('phoneOtp'))!=$uData[0]['phone_otp'])

            {

                $this->response(['status'=>false,'msg'=>'Phone OTP not match !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }elseif(md5($this->input->post('emailOtp'))!=$uData[0]['email_otp'])

            {

                $this->response(['status'=>false,'msg'=>'Email OTP not match !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {

                $this->Registration_model->updateClinicsInfo(['current_status'=>'otpverify','d_date'=>date('Y-m-d H:i:s'),'d_by'=>$this->input->post('user_id',true)],$this->input->post('user_id',true));

                $this->response(['status'=>true,'msg'=>'Successfully OTP Match','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

        }

    }



    public function updateLabInfo_post()

    {

        if($this->input->post('lab_full_name')=='')

        {

            $this->response(['status'=>false,'msg'=>'Lab full name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('lab_short_name')=='')

        {

            $this->response(['status'=>false,'msg'=>'Lab short name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('clinic_code')=='')

        {

            $this->response(['status'=>false,'msg'=>'clinic_code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $dataArray['lab_name'] = $this->input->post('lab_full_name',true);

            $dataArray['lab_short_name'] = $this->input->post('lab_short_name',true);

            $this->Registration_model->updateClinicsInfo($dataArray,$this->input->post('clinic_code',true));

            $this->response(['status'=>true,'msg'=>'Successfully Found !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }

    }



    

    function sendEmailOtp($email)

    {



    }

    function sendPhoneOtp($phone)

    {

        

    }



    function dateDiffMin($dateTimeObject1, $dateTimeObject2)

    {

        

        $s = strtotime($dateTimeObject1);

        $e = strtotime($dateTimeObject2);

        return $dm = ($e-$s)/60;

    }



    function purchasePlan_post()

    {

        if($this->input->post('clinic_code')=='')

        {

            $this->response(['status'=>false,'msg'=>'clinic_code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('plan_id')=='')

        {

            $this->response(['status'=>false,'msg'=>'Plan id is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $planDetails = $this->Plan_model->getPlanDetails_m($this->input->post('plan_id',true));

            if($this->Plan_model->clinicPlanExist_m($this->input->post('clinic_code',true))>0)

            {

               $resData = $this->Plan_model->userPlanExistData_m($this->input->post('clinic_code',true));

               $start_date = date('Y-m-d H:i:s',strtotime($resData[0]['end_date']));

               $date = strtotime("+".$planDetails[0]['days']." day", strtotime($start_date));

               $end_date = date("Y-m-d H:i:s", $date);

               $dataArray['plan_id'] = $planDetails[0]['id'];

               $dataArray['amount'] = $planDetails[0]['amount'];

               $dataArray['start_date'] = $start_date;

               $dataArray['end_date'] = $end_date;

               $dataArray['days'] = $planDetails[0]['days'];

               $dataArray['clinic_code'] = $this->input->post('clinic_code',true);

               $dataArray['status'] = 1;

               $this->Plan_model->createSubscription_m($dataArray);

               $dataMArray['expiry_date'] = $end_date;

               $dataMArray['blocked'] = 0;

               $dataMArray['current_status'] = 'completed';

               $this->Registration_model->updateClinicsInfo($dataMArray,$this->input->post('clinic_code',true));

               $clinicData = $this->Registration_model->getAdminUsers($this->input->post('clinic_code',true));

               $verify = $this->Registration_model->verifyAdminUsers($clinicData[0]['phone'],$clinicData[0]['email']);

               if($verify==0)

               {

                    $aData['clinic_code'] = $this->input->post('clinic_code',true);

                    $aData['email'] = $clinicData[0]['email'];

                    $aData['phone'] = $clinicData[0]['phone'];

                    $aData['password'] = $clinicData[0]['tmp_password'];

                    $aData['first_name'] = $clinicData[0]['first_name'];

                    $aData['last_name'] = $clinicData[0]['last_name'];

                    $aData['blocked'] = 0;

                    $aData['image'] = '';

                    $aData['role'] = 1;

                    $aData['c_by'] = $this->input->post('clinic_code',true);

                    $aData['c_date'] = date('Y-m-d H:i:s');

                    $aData['current_status'] = 'completed';

                    $aData['status'] = 1;

                    $this->Registration_model->createAdminUsers($aData);

               }

               $this->response(['status'=>true,'msg'=>'Successfully Registed !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {

               $resData = $this->Plan_model->userPlanExistData_m($this->input->post('clinic_code',true));

               $start_date = date('Y-m-d H:i:s');

               $date = strtotime("+".$planDetails[0]['days']." day", strtotime($start_date));

               $end_date = date("Y-m-d H:i:s", $date);

               $dataArray['plan_id'] = $planDetails[0]['id'];

               $dataArray['amount'] = $planDetails[0]['amount'];

               $dataArray['start_date'] = $start_date;

               $dataArray['end_date'] = $end_date;

               $dataArray['days'] = $planDetails[0]['days'];

               $dataArray['clinic_code'] = $this->input->post('clinic_code',true);

               $dataArray['status'] = 1;

               $this->Plan_model->createSubscription_m($dataArray);

               $dataMArray['registration_date'] = date('Y-m-d H:i:s');

               $dataMArray['expiry_date'] = $end_date;

               $dataMArray['blocked'] = 0;

               $dataMArray['current_status'] = 'completed';

               $this->Registration_model->updateClinicsInfo($dataMArray,$this->input->post('clinic_code',true));

              

               $clinicData = $this->Registration_model->getAdminUsers($this->input->post('clinic_code',true));

               $verify = $this->Registration_model->verifyAdminUsers($clinicData[0]['phone'],$clinicData[0]['email']);

               if($verify==0)

               {

                    $aData['clinic_code'] = $this->input->post('clinic_code',true);

                    $aData['email'] = $clinicData[0]['email'];

                    $aData['phone'] = $clinicData[0]['phone'];

                    $aData['password'] = $clinicData[0]['tmp_password'];

                    $aData['first_name'] = $clinicData[0]['first_name'];

                    $aData['last_name'] = $clinicData[0]['last_name'];

                    $aData['blocked'] = 0;

                    $aData['image'] = '';

                    $aData['role'] = 1;

                    $aData['c_by'] = $this->input->post('clinic_code',true);

                    $aData['c_date'] = date('Y-m-d H:i:s');

                    $aData['current_status'] = 'completed';

                    $aData['status'] = 1;

                    $this->Registration_model->createAdminUsers($aData);

               }

               $this->response(['status'=>true,'msg'=>'Successfully Registed !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

        }

    }





    public function user_create_post()

    {

        if($this->input->post('email',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Email is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('first_name',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'First name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('last_name',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Last name is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('role_id',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Role is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('clinic_code',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Clinic code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('user_id',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'User Id code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {



            $emailVerifyExist = $this->Registration_model->verifyUsersEmail($this->input->post('email',true));

            if($emailVerifyExist>0)

            {

                $this->response(['status'=>false,'msg'=>'This email has already associated with any other account plesae try another !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }else

            {

                $passcode = md5(uniqid().date('dmYHis').rand(10,1000));



                $aData = [];

                $aData['clinic_code'] = $this->input->post('clinic_code',true);

                $aData['email'] = $this->input->post('email',true);

                $aData['password'] = NULL;

                $aData['first_name'] = $this->input->post('first_name',true);

                $aData['last_name'] = $this->input->post('last_name',true);

                $aData['blocked'] = 0;

                $aData['image'] = '';

                $aData['role'] = $this->input->post('role_id',true);

                $aData['c_by'] = $this->input->post('user_id',true);

                $aData['c_date'] = date('Y-m-d H:i:s');

                $aData['current_status'] = 'completed';

                $aData['password_link_passwcode'] = $passcode;

                $aData['link_status'] = 1;

                $aData['status'] = 1;

                $this->Registration_model->createAdminUsers($aData);



                $mail = new PHPMailer();

                $mail->IsSMTP();

                $mail->Mailer = "smtp";

                $mail->SMTPDebug = 0;

                $mail->SMTPAuth = true;

                $mail->SMTPSecure = "tls";

                $mail->Port = 587;

                $mail->Host = "smtp.gmail.com";

                $mail->Username = "autoreplyispl@gmail.com";

                $mail->Password = "Ma@123456!";

                $mail->IsHTML(true);

                $mail->AddAddress($this->input->post('email',true));



                $mail->SetFrom("autoreplyispl@gmail.com", "iotas solution");

                $mail->Subject = 'INVITATION_SET_PASSWORD_MEDIKAMART_LABO';

                // $mail->AddReplyTo("nkkoiri111@gmail.com", "Nitai koiri");

                // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");

                $content = '';

                $content .= '<h3>Invitation For Set Password</h3>';

                $content .= '<p>This is an invitaion email for creation of user account in medikamart software please click below link</p>';

                $content .= '<p><a target="_blank" href="http://localhost/labo/PasswordSet?passcode='.$passcode.'"><button style="width:200px;height:25px;background:green;color:white;font-size:25px;cursor:pointer;">Set Password</button></a></p>';

                $mail->MsgHTML($content);

                if (!$mail->Send())

                {

                    $this->response(['status'=>false,'msg'=>'Invitation Failed to Sent try again !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                    

                }

                else

                {

                   $this->response(['status'=>true,'msg'=>'Invitation Successfully Sent !','status_code'=>REST_Controller::HTTP_OK]);

                    

                }



            }



        }

    }



    public function get_passcode_status_post()

    {

        if($this->input->post('passcode',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Passcode is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $result = $this->Registration_model->verifyPasscode($this->input->post('passcode',true));

            if($result>0)

            {

                $this->response(['status'=>false,'msg'=>'Yes Found !','status_code'=>REST_Controller::HTTP_OK]);

            }else

            {

                $this->response(['status'=>false,'msg'=>'Wrong Passcode !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

        }

    }



    public function set_passcode_status_post()

    {

        if($this->input->post('passcode',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Passcode is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('password',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Password is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {

            $result = $this->Registration_model->updateUsersData(['password'=>md5($this->input->post('password',true)),'link_status'=>0],['password_link_passwcode'=>$this->input->post('passcode',true)]);

            if($result)

            {

                $this->response(['status'=>false,'msg'=>"Successfully Done ! Plesae Login",'status_code'=>REST_Controller::HTTP_OK]);

            }else

            {

                $this->response(['status'=>false,'msg'=>'Failed To Set Password ! Try Again','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

            }

        }

    }



     public function resend_invitaion_email_post()

    {

        if($this->input->post('clinic_code',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'Clinic code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('user_id',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'User id is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }elseif($this->input->post('d_dy',true)=="")

        {

            $this->response(['status'=>false,'msg'=>'d_by code is required !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

        }else

        {



           $emails = $this->Registration_model->get_emails($this->input->post('user_id',true),$this->input->post('clinic_code',true));

           if(!empty($emails))

           {

                $passcode = md5(uniqid().date('dmYHis').rand(10,1000));

                $aData = [];

                $aData['d_by'] = $this->input->post('d_by',true);

                $aData['d_date'] = date('Y-m-d H:i:s');

                $aData['password_link_passwcode'] = $passcode;

                $aData['link_status'] = 1;

                $where['clinic_code'] = $this->input->post('clinic_code',true);

                $where['user_id'] = $this->input->post('user_id',true);

                $this->Registration_model->updateUsersData($aData,$where);

                $mail = new PHPMailer();

                $mail->IsSMTP();

                $mail->Mailer = "smtp";

                $mail->SMTPDebug = 0;

                $mail->SMTPAuth = true;

                $mail->SMTPSecure = "tls";

                $mail->Port = 587 ;

                $mail->Host = $this->mailhost;

                $mail->Username = $this->mailuser;

                $mail->Password = $this->mailpassword;

                $mail->IsHTML(true);

                $mail->SetFrom($this->mailsendfromemail, $this->mailsendfromname);

                $mail->AddAddress($emails[0]['email']);

                $mail->Subject = 'INVITATION_SET_PASSWORD_MEDIKAMART_LABO';

                // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");

                $content = '';

                $content .= '<h3>Invitation For Set Password</h3>';

                $content .= '<p>This is an invitaion email for creation of user account in medikamart software please click below link</p>';

                $content .= '<p><a target="_blank" href="http://localhost/labo/PasswordSet?passcode='.$passcode.'"><button style="width:200px;height:25px;background:green;color:white;font-size:25px;cursor:pointer;">Set Password</button></a></p>';

                $mail->MsgHTML($content);

                // print_r($mail->Send());die;

                if (!$mail->Send())

                {

                    $this->response(['status'=>false,'msg'=>'Invitation Failed to Sent try again !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

                    

                }

                else

                {

                   $this->response(['status'=>true,'msg'=>'Invitation Successfully Sent !','status_code'=>REST_Controller::HTTP_OK]);

                    

                }

           }else

           {

             $this->response(['status'=>false,'msg'=>'User Id code is wrong !','status_code'=>REST_Controller::HTTP_BAD_REQUEST]);

           }

           



        }

    }





    public function get_org_role_master_post()

    {

        $result = $this->Registration_model->get_orgnisation_role();

        $this->response(['status'=>true,'msg'=>'Successfully !','data'=>$result,'status_code'=>REST_Controller::HTTP_OK]);

    }



}



?>

