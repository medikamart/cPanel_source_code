<?php
class MY_Controller extends CI_Controller
{
public $business_kyc = 0;
public $user_kyc = 0;
public $business_name = '-';
public function __construct()
  {
    parent::__construct();
   
   error_reporting(0);
    $api='Kyc/get_kyc_status';
    $data='clinic_code='.$_SESSION['user_data']['clinic_code'];
    $method='POST';
    $response_kyc = $this->CallAPI($api, $data, $method);
    // echo '<pre>';
    // print_r($response_kyc);die;
    $this->business_kyc = $response_kyc['data'][0]['bsiness_kyc']; 
    $this->user_kyc = $response_kyc['data'][0]['user_kyc']; 
    $this->business_name = $response_kyc['data'][0]['lab_name'];
  }
  public function CallAPI($api, $data, $method) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://medikamart.in/labo_api/api/".$api,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POSTFIELDS => $data,
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
    // if ($httpCode == 200) {
      return json_decode($response, true);
    // }else{
    //   return 404;
    // }
  }

  

}
?>