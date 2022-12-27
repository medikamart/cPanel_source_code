<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'/third_party/vendor/autoload.php';
use Razorpay\Api\Api;
use Razorpay\Api\PaymentLink;
use Razorpay\Api\Errors\SignatureVerificationError;
class Subscription extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
        $d['v'] = 'purchase/plan.php';
		$this->load->view('template',$d);
	}

	public function payment_success()
	{	
        $d['v'] = 'purchase/success.php';
		$this->load->view('template',$d);
	}

	public function payment_failed()
	{	
        $d['v'] = 'purchase/failed.php';
		$this->load->view('template',$d);
	}

	public function myplan()
	{	
		$method='POST';
        $api='Payment/getMySubscriptions';
        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method); 
        $d['result'] = $result['response_data'];

        $d['v'] = 'purchase/myplan.php';
		$this->load->view('template',$d);
	}

	public function PaymentNow()
	{

		$method='POST';
        $api='Plan/get_plan_details';
        $data='plan_id='.$_POST['plan_id'];
        $result = $this->CallAPI($api, $data, $method); 
        $planDetails = $result['data']; 

        $method='POST';
        $api='BusinessKyc/get_business_kyc_status';
        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method); 
        $clinicDetails = $result['response_data']; 


        $method='POST';
        $api='Payment/getSubscriptionId';
        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&plan_id='.$_POST['plan_id'].'&amount='.$planDetails[0]['total_amount'].'&days='.$planDetails[0]['days'].'&user_id='.$this->session->userdata('user_data')['user_id'];
        $result = $this->CallAPI($api, $data, $method); 
        $subscription_id = $result['response_data']['subscription_id']; 

        // echo '<pre>';
        // print_r($clinicDetails);die;
		/*Configuration*/
// 		$keyId = 'rzp_test_seRWIDdZdllv3B';
// 		$keySecret = 'qsnA1qrMjCv21GeET60s7JYS';

		$keyId = 'rzp_live_Qirg4wJbYO31dl';
		$keySecret = 'EIeVGZF4ZHNep396qWjA0iKU';

		$displayCurrency = 'INR';

		// Create the Razorpay Order
		$api = new Api($keyId, $keySecret);

		// We create an razorpay order using orders api
		// Docs: https://docs.razorpay.com/docs/orders
		//

		$bill_no = $subscription_id;
		$bill_amount = $planDetails[0]['total_amount'];
		$customer_name = $clinicDetails[0]['business_name'];
		$customer_mobile  = $clinicDetails[0]['business_contact'];
		$customer_email  = $clinicDetails[0]['business_email'];
		$customer_address  = $clinicDetails[0]['business_address'];
		$gst_no  = $clinicDetails[0]['gst_no'];
		$plan_order_id  = $subscription_id;

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
		    "name"              => "MEDIKAMART HEALTHCARE SOLUTIONS PRIVATE LIMITED",
		    "description"       => "",
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
		<form action="<?php echo base_url().'Subscription/verifyPayement'; ?>" method="POST">
			<h1>MEDIKAMART HEALTHCARE SOLUTIONS PRIVATE LIMITED</h1>
			<p>Bill No.: <?php echo $bill_no; ?></p>
			<p>Plan : <?php echo $planDetails[0]['plan_name']; ?></p>
			<p>Price : Rs.<?php echo $planDetails[0]['amount']; ?></p>
			<p>GST : <span><?php echo $planDetails[0]['tax_perc']; ?>%</span></p>
			<p>Payable Amount : Rs.<span><?php echo $planDetails[0]['total_amount']; ?></span></p>
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
		    	// print_r($_POST);die;
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
	        $api='Payment/SavepaymentGatway';
	        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&razorpay_payment_id='.$_POST['razorpay_payment_id'].'&amount='.$_POST['amount'].'&razorpay_order_id='.$_POST['razorpay_order_id'].'&razorpay_signature='.$_POST['razorpay_signature'].'&ref_no='.$_POST['shopping_order_id'].'&status=paid&user_id='.$this->session->userdata('user_data')['user_id'];
	        $result = $this->CallAPI($api, $data, $method);
	        
		    return redirect('/Subscription/payment_success?paymentId='.$_POST['razorpay_payment_id']);
		}
		else
		{
			$method='POST';
	        $api='Payment/SavepaymentGatway';
	        $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&razorpay_payment_id='.$_POST['razorpay_payment_id'].'&amount='.$_POST['amount'].'&razorpay_order_id='.$_POST['razorpay_order_id'].'&razorpay_signature='.$_POST['razorpay_signature'].'&ref_no='.$_POST['shopping_order_id'].'&status=fail&user_id='.$this->session->userdata('user_data')['user_id'];
	        $result = $this->CallAPI($api, $data, $method); 
		    return redirect('/Subscription/payment_failed?paymentId='.$_POST['razorpay_payment_id']);
		}
	}




}

?>