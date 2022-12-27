<?php

function CallAPI($api, $data, $method) {
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


function checkpermissions($sessionData)
{
	$method='POST';
    $api='User/role_master';
    $data='action=RP&clinic_code='.$sessionData['clinic_code'].'&user_id='.$sessionData['user_id'].'&role_id='.$sessionData['role'];
    $result = CallAPI($api, $data, $method); 
    if($result['response_code']==200)
    {
    	return $permission = json_decode($result['response_data'][0]['role_permission'],true);
    	
    }else{
    	redirect('/Login');
    }
    
}




?>