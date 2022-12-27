<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'third_party/vendor/autoload.php';
use Razorpay\Api\Api;
use Razorpay\Api\PaymentLink;
use Razorpay\Api\Errors\SignatureVerificationError;
class Payment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
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


	public function PaymentNow()
	{

		$method='POST';
        $api='Billing/getbillDetails';
        $data='bill_no='.$this->uri->segment(3);
        $result = $this->CallAPI($api, $data, $method);

        if($result['response_code']==200)
        {
        	$amount = $result['response_data']['balance']; 
        	if($amount>0)
        	{
        			/*Configuration*/
				// 			$keyId = 'rzp_test_seRWIDdZdllv3B';
				// 			$keySecret = 'qsnA1qrMjCv21GeET60s7JYS';

							$keyId = 'rzp_live_Qirg4wJbYO31dl';
							$keySecret = 'EIeVGZF4ZHNep396qWjA0iKU';

							$displayCurrency = 'INR';

							// Create the Razorpay Order
							$api = new Api($keyId, $keySecret);

							// We create an razorpay order using orders api
							// Docs: https://docs.razorpay.com/docs/orders
							//

							$bill_no = $this->uri->segment(3);
							$bill_amount = $amount;
							$customer_name = $result['response_data']['data']['title'].' '.$result['response_data']['data']['full_name'];
							$customer_mobile  = $result['response_data']['data']['mobile'];
							$customer_email  = $result['response_data']['data']['email'];
							$customer_address  = 'NA';
							$client_name = $result['response_data']['data']['business_name'];
							$client_address = $result['response_data']['data']['business_address'];
							$gst_no  = 'N/A';
							$plan_order_id  = $this->uri->segment(3);

							$orderData = [
							    'receipt'         => $bill_no,//Bill No
							    'amount'          => $bill_amount * 100, // 2000 rupees in paise
							    'currency'        => 'INR',
							    'payment_capture' => 1 // auto capture
							];

							$razorpayOrder = $api->order->create($orderData);

							$razorpayOrderId = $razorpayOrder['id'];

							$_SESSION['razorpay_order_id'] = $razorpayOrderId;


							$displayAmount = $amount = $orderData['amount'];

							if ($displayCurrency !== 'INR')
							{
							    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
							    $exchange = json_decode(file_get_contents($url), true);

							    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
							}

							$data = [
							    "key"               => $keyId,
							    "amount"            => $amount,
							    "name"              => $client_name,
							    "description"       => $client_address,
							    "image"             => base_url().'assets/logo-com1.png',
							    "prefill"           => [
							    "name"              => $customer_name,
							    "email"             => $customer_email,
							    "contact"           => $customer_mobile,
							    ],
							    "notes"             => [
							    "address"           => "NA",
							    "merchant_order_id" => $plan_order_id,
							    ],
							    "theme"             => [
							    "color"             => "#F37254"
							    ],
							    "order_id"          => $razorpayOrderId,
							];

							if ($displayCurrency !== 'INR')
							{
							    $data['display_currency']  = $displayCurrency;
							    $data['display_amount']    = $displayAmount;
							}

							$json = json_encode($data);

							?>
							<form action="<?php echo base_url().'Payment/verifyPayement'; ?>" method="POST">
								<h1><?php echo $client_name; ?></h1>
								<h5>MEDIKAMART HEALTHCARE SOLUTIONS PRIVATE LIMITED</h5>
								<p>Bill No.: <?php echo $bill_no; ?></p>
								<p>Payable Amount : Rs.<span><?php echo $bill_amount; ?></span></p>
								<p>Time: <?php echo date('d-m-Y H:i:s'); ?></p>
								<hr>
								<table style="width:100%;margin: 0px auto;">
									<thead>
										<tr>
											<th>
												<p>Billing Name (<span style="color: red;">*</span>)</p>
												<input type="text" value="<?php echo $customer_name; ?>" name="billing_name">
											</th>
										</tr>
										<tr>
											<th>
												<p>Contact Number (<span style="color: red;">*</span>)</p>
												<input type="number" value="<?php echo $customer_mobile; ?>" name="">
											</th>
										</tr>
										<tr>
											<th>
												<p>Email (<span style="color: red;">*</span>)</p>
												<input type="email" value="<?php echo $customer_email; ?>" name="">
											</th>
										</tr>
										<tr>
											<th>
												<p>Address (<span style="color: red;">*</span>)</p>
												<textarea name=""><?php echo $customer_address; ?></textarea>
											</th>
										</tr>
										<tr>
											<th>
												<p>GSTIN (Optional)</p>
												<input value="<?php echo $gst_no; ?>" type="text" name="">
											</th>
										</tr>
										<tr>
											<th></th>
										</tr>
									</thead>
								</table>
								<hr>
							  <script
							    src="https://checkout.razorpay.com/v1/checkout.js"
							    data-key="<?php echo $data['key']?>"
							    data-amount="<?php echo $data['amount']?>"
							    data-currency="INR"
							    data-name="<?php echo $data['name']?>"
							    data-image="<?php echo $data['image']?>"
							    data-description="<?php echo $data['description']?>"
							    data-prefill.name="<?php echo $data['prefill']['name']?>"
							    data-prefill.email="<?php echo $data['prefill']['email']?>"
							    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
							    data-notes.shopping_order_id="<?php echo $plan_order_id; ?>"
							    data-order_id="<?php echo $data['order_id']?>"
							    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
							    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
							  >
							  </script>
							  	<a href="<?php echo base_url("Subscription"); ?>">
							  		<button type="button"> Cancel</button>
								</a>
							  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
							  <input type="hidden" name="shopping_order_id" value="<?php echo $plan_order_id; ?>">
							  <input type="hidden" name="amount" value="<?php echo $bill_amount; ?>">
							  <input type="hidden" name="clinic_code" value="<?php echo $result['response_data']['data']['clinic_code']; ?>">
							  <input type="hidden" name="patient_id" value="<?php echo $result['response_data']['data']['patient_id']; ?>">
							</form>
							<style type="text/css">
								body{
									background: darkslategrey;
									margin: 0;
									padding: 0;
									color: white;
								}
								form{
									width: 100%;
								    min-height: 400px;
								    text-align: center;
								    padding-top: 20px;
								}

								input[type=text],input[type=number],input[type=email],textarea{
									width: 30%;
									height: 25px;
								}
								textarea{
									height: 100px;
								}
								input[type=submit]{
									padding: 5px 20px;
									border-radius: 10px;
									font-size: 25px;
									cursor: pointer;
								}
								button{
									padding: 5px 20px;
									border-radius: 10px;
									font-size: 25px;
									cursor: pointer;
								}
							</style>

							<?php
        	}else
        	{
        		echo '<div style="width:100%;height:100%;text-align:center;padding-top:10%;"><p><img src="'.base_url().'assets/success.gif"></p><h2>Your Payment is already Paid</h2></div>';
        	}
        }else
        {
        	echo $result['Message'];
        }
        

        
        // echo '<pre>';
        // print_r($result);die; 
        
		
	}

	public function verifyPayement()
	{
		$success = true;
		/*Configuration*/
// 		$keyId = 'rzp_test_seRWIDdZdllv3B';
// 		$keySecret = 'qsnA1qrMjCv21GeET60s7JYS';

		$keyId = 'rzp_live_Qirg4wJbYO31dl';
		$keySecret = 'EIeVGZF4ZHNep396qWjA0iKU';

		$error = "Payment Failed";

		if (empty($_POST['razorpay_payment_id']) === false)
		{
		    $api = new Api($keyId, $keySecret);

		    try
		    {
		    	
		        // Please note that the razorpay order ID must
		        // come from a trusted source (session here, but
		        // could be database or something else)
		        $attributes = array(
		            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
		            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
		            'razorpay_signature' => $_POST['razorpay_signature']
		        );

		        $api->utility->verifyPaymentSignature($attributes);
		    }
		    catch(SignatureVerificationError $e)
		    {
		        $success = false;
		        $error = 'Razorpay Error : ' . $e->getMessage();
		    }
		}

		if ($success === true)
		{

					$method='POST';
	        $api='Billing/payBillPayment';
	        $data='patient_id='.$_POST['patient_id'].'&clinic_code='.$_POST['clinic_code'].'&razorpay_payment_id='.$_POST['razorpay_payment_id'].'&amount='.$_POST['amount'].'&razorpay_order_id='.$_POST['razorpay_order_id'].'&razorpay_signature='.$_POST['razorpay_signature'].'&shopping_order_id='.$_POST['shopping_order_id'].'&curent_status=success';
	        $result = $this->CallAPI($api, $data, $method);

	        echo '<div style="width:100%;height:100%;text-align:center;padding-top:10%;"><p><img src="'.base_url().'assets/success.gif"></p><h2>Your Payment is already Paid</h2></div>';
		}
		else
		{
			$method='POST';
      $api='Billing/payBillPayment';
      $data='patient_id='.$_POST['patient_id'].'&clinic_code='.$_POST['clinic_code'].'&razorpay_payment_id='.$_POST['razorpay_payment_id'].'&amount='.$_POST['amount'].'&razorpay_order_id='.$_POST['razorpay_order_id'].'&razorpay_signature='.$_POST['razorpay_signature'].'&shopping_order_id='.$_POST['shopping_order_id'].'&curent_status=success';
      $result = $this->CallAPI($api, $data, $method);
		 echo '<div style="width:100%;height:100%;text-align:center;padding-top:10%;"><p><img src="'.base_url().'assets/failed.gif"></p><h2>Your Payment is Failed</h2></div>';
		}
	}




}

?>