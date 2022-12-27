

<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Billing extends MY_Controller

{

	

	



	public function __construct()

	{

		parent::__construct();

		if(!$this->session->userdata('logged_in'))

		{

			redirect('/Login');

		}

	}

	public function billing()

	{



		// patient list

		  $method='POST';

        $api='Patient/patient_master';

        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

        $d['patient_list'] = $result['response_data'];

        // category list

        $method='POST';

        $api='Category/category_master';

        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

        $d['category_list'] = $result['response_data'];

        // vendor list

        $method='POST';

        $api='Vendor/vendor_master';

        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

        $d['vendor_list'] = $result['response_data'];



		$d['v'] = 'billing/billing';

		$this->load->view('template',$d);



	}



	public function get_test_list()

	{

		$this->input->post('ref_no')!=""?$ref_no = $this->input->post('ref_no'):$ref_no ="";

		$method='POST';

        $api='Report/update_report_print_status';

        $data='ref_no='.$ref_no;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}





	public function email_link_payment()

	{

		$payment_link = $this->input->post('payment_link',true);

      $bill_no = $this->input->post('bill_no',true);

      $amount = $this->input->post('amount',true);

      $email_id = $this->input->post('email',true);

      $clinic_code = $this->input->post('clinic_code',true);

		$method='POST';

        $api='Registration/send_payment_link';

        $data='bill_no='.$bill_no.'&amount='.$amount.'&email='.$email_id.'&clinic_code='.$clinic_code.'&payment_link='.$payment_link;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function store_print_details()

	{

		$this->input->post('ref_no')!=""?$ref_no = $this->input->post('ref_no'):$ref_no ="";

		// print_r($_POST);die;

		$method='POST';

        $api='Report/store_print_details';

        $data='ref_no='.$ref_no.'&test_ids='.json_encode($_POST['test_id']);

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function get_patient_details()

	{

		$this->input->post('id')!=""?$id = $this->input->post('id'):$id ="";

		$method='POST';

        $api='Patient/patient_master';

        $data='action=R&id='.$id.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function get_test_list_by_category()

	{

		$this->input->post('category_id')!=""?$category_id = $this->input->post('category_id'):$category_id ="";

		$method='POST';

        $api='Test/test_master';

        $data='action=R&category_id='.$category_id.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function addToWishList()

	{

		$sessionData = $this->session->userdata('user_data');

		$this->input->post('patient_id')!=""?$patient_id = $this->input->post('patient_id'):$patient_id ="";

		$this->input->post('test_id')!=""?$test_id = $this->input->post('test_id'):$test_id ="";

		$method='POST';

        $api='WishList/wishlist_master';

        $data='action=C&patient_id='.$patient_id.'&test_id='.$test_id.'&c_by='.$sessionData['user_id'];

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function create_billing()

	{

		$sessionData = $this->session->userdata('user_data');

		$this->input->post('patient_type')!=""?$patient_type=$this->input->post('patient_type'):$patient_type="";

		$this->input->post('billing_date')!=""?$billing_date=$this->input->post('billing_date'):$billing_date="";

		$this->input->post('patient_title')!=""?$patient_title=$this->input->post('patient_title'):$patient_title="";

		$this->input->post('full_name')!=""?$full_name=$this->input->post('full_name'):$full_name="";

		$this->input->post('patient_id')!=""?$patient_id=$this->input->post('patient_id'):$patient_id="";

		$this->input->post('patient_age')!=""?$patient_age=$this->input->post('patient_age'):$patient_age="";

		$this->input->post('patient_month')!=""?$patient_month=$this->input->post('patient_month'):$patient_month="";

		$this->input->post('patient_sex')!=""?$patient_sex=$this->input->post('patient_sex'):$patient_sex="";

		$this->input->post('patient_mobile')!=""?$patient_mobile=$this->input->post('patient_mobile'):$patient_mobile="";

		$this->input->post('patient_email')!=""?$patient_email=$this->input->post('patient_email'):$patient_email="";

		$this->input->post('patient_address')!=""?$patient_address=$this->input->post('patient_address'):$patient_address="";

		$this->input->post('vendor_id')!=""?$vendor_id=$this->input->post('vendor_id'):$vendor_id="";

		$this->input->post('test_total_amount')!=""?$test_total_amount=$this->input->post('test_total_amount'):$test_total_amount="";

		$this->input->post('discount_amount')!=""?$discount_amount=$this->input->post('discount_amount'):$discount_amount="";

		$this->input->post('tax_type')!=""?$tax_type=$this->input->post('tax_type'):$tax_type="";

		$this->input->post('tax_rate')!=""?$tax_rate=$this->input->post('tax_rate'):$tax_rate="";



		$this->input->post('collection_charge')!=""?$collection_charge=$this->input->post('collection_charge'):$collection_charge="";

		$this->input->post('advance_amount')!=""?$advance_amount=$this->input->post('advance_amount'):$advance_amount="";

		$this->input->post('payment_status')!=""?$payment_status=$this->input->post('payment_status'):$payment_status="";

		$this->input->post('payment_mode')!=""?$payment_mode=$this->input->post('payment_mode'):$payment_mode="";

		$this->input->post('transaction_id')!=""?$transaction_id=$this->input->post('transaction_id'):$transaction_id="";

		$this->input->post('test_array')!=""?$test_array=json_encode($this->input->post('test_array')):$test_array="";



		$method='POST';

        $api='Billing/billing_master';

        $data='action=C&patient_type='.$patient_type.'&billing_date='.$billing_date.'&c_by='.$sessionData['user_id'].'&patient_title='.$patient_title.'&full_name='.$full_name.'&patient_id='.$patient_id.'&patient_age='.$patient_age.'&patient_month='.$patient_month.'&patient_sex='.$patient_sex.'&patient_mobile='.$patient_mobile.'&patient_email='.$patient_email.'&patient_address='.$patient_address.'&vendor_id='.$vendor_id.'&test_total_amount='.$test_total_amount.'&discount_amount='.$discount_amount.'&tax_type='.$tax_type.'&tax_rate='.$tax_rate.'&collection_charge='.$collection_charge.'&advance_amount='.$advance_amount.'&payment_status='.$payment_status.'&payment_mode='.$payment_mode.'&transaction_id='.$transaction_id.'&test_array='.$test_array.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

           $result = $this->CallAPI($api, $data, $method);

           echo json_encode($result);

	}





	public function billing_list()

	{

		// patient list

			$from_date = $this->input->post('from_date')!=""?$this->input->post('from_date'):date('Y-m-d');

		   $to_date = $this->input->post('to_date')!=""?$this->input->post('to_date'):date('Y-m-d');

			$method='POST';

        $api='Billing/billing_master';

        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'].'&from_date='.$from_date.'&to_date='.$to_date;

        $result = $this->CallAPI($api, $data, $method); 

        // print_r($result);die; 

        $d['from_date'] = $from_date;

        $d['to_date'] = $to_date;

        $d['billing_list'] = $result['response_data'];

        

		$d['v'] = 'billing/billing_list';

		$this->load->view('template',$d);

	}



	public function pending_report()

	{

		// patient list

		$method='POST';

        $api='Billing/billing_master';

        $data='action=P&clinic_code='.$this->session->userdata('user_data')['clinic_code'];

        $result = $this->CallAPI($api, $data, $method);  

        $d['billing_list'] = $result['response_data'];

        // print_r($d['billing_list']);die;

		$d['v'] = 'report/pending_report';

		$this->load->view('template',$d);

	}



	public function get_due_details()

	{

		$this->input->post('ref_no')!=""?$ref_no = $this->input->post('ref_no'):$ref_no ="";

		$method='POST';

        $api='Billing/get_due_details';

        $data='ref_no='.$ref_no;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}

	public function update_print_status_now()

	{

		$this->input->post('ref_no')!=""?$ref_no = $this->input->post('ref_no'):$ref_no ="";

		$this->input->post('print_status')!=""?$print_status = $this->input->post('print_status'):$print_status =0;

		$method='POST';

        $api='Billing/update_print_status';

        $data='ref_no='.$ref_no.'&print_status='.$print_status;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function update_digital_sign_status_now()

	{

		$this->input->post('ref_no')!=""?$ref_no = $this->input->post('ref_no'):$ref_no ="";

		$this->input->post('status')!=""?$status = $this->input->post('status'):$status =0;

		$method='POST';

        $api='Billing/update_digital_sign_status_now';

        $data='ref_no='.$ref_no.'&status='.$status;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function payment_upadate_on_bill()

	{

		$sessionData = $this->session->userdata('user_data');

		

		$this->input->post('ref_no')!=""?$ref_no=$this->input->post('ref_no'):$ref_no="";

		$this->input->post('payment_date')!=""?$payment_date=$this->input->post('payment_date'):$payment_date="";

		$this->input->post('pay_amount')!=""?$pay_amount=$this->input->post('pay_amount'):$pay_amount="";



		$this->input->post('payment_status')!=""?$payment_status=$this->input->post('payment_status'):$payment_status="";

		$this->input->post('payment_mode')!=""?$payment_mode=$this->input->post('payment_mode'):$payment_mode="";

		$this->input->post('transaction_id')!=""?$transaction_id=$this->input->post('transaction_id'):$transaction_id="";

		$this->input->post('patient_id')!=""?$patient_id=$this->input->post('patient_id'):$patient_id="";



		$method='POST';

        $api='Billing/update_payment';

        $data='patient_id='.$patient_id.'&ref_no='.$ref_no.'&payment_date='.$payment_date.'&c_by='.$sessionData['user_id'].'&pay_amount='.$pay_amount.'&payment_status='.$payment_status.'&payment_mode='.$payment_mode.'&transaction_id='.$transaction_id;

           $result = $this->CallAPI($api, $data, $method);

           echo json_encode($result);

	}



	public function getPaymentStatement()

	{

		$sessionData = $this->session->userdata('user_data');

		$this->input->post('ref_no')!=""?$ref_no = $this->input->post('ref_no'):$ref_no ="";

		$method='POST';

        $api='Billing/billing_master';

        $data='action=S&ref_no='.$ref_no;

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}



	public function deleteBilling()

	{

		$sessionData = $this->session->userdata('user_data');

		$this->input->post('ref_no')!=""?$ref_no = $this->input->post('ref_no'):$ref_no ="";

		$method='POST';

        $api='Billing/billing_master';

        $data='action=D&ref_no='.$ref_no.'&d_by='.$sessionData['user_id'];

        $result = $this->CallAPI($api, $data, $method);  

        echo json_encode($result);

	}

	



		public function print_bill()

    {

    		$sessionData = $this->session->userdata('user_data');

        	$ref_no = $this->uri->segment(3);

            $this->load->library('CustomFPDF');

			$pdf = $this->customfpdf->getInstance();

			$pdf->AliasNbPages();

			$pdf->AddPage();

			$pdf->Header('Arial');

			$pdf->SetFont('Times','',10);

			$method='POST';

	        $api='Billing/get_billing_print_details';

	        $data='ref_no='.$ref_no;

	        $result = $this->CallAPI($api, $data, $method); 



	        $method='POST';

	        $api='Tool/get_pad_image_letest';

	        $data='clinic_code='.$sessionData['clinic_code'];

	        $clinicresult = $this->CallAPI($api, $data, $method); 

	        

	        // echo '<pre>'; 

	        // print_r();die;

	        $lab_name = 'LIFE CARE CENTRE';

	        $lab_address = 'Netaji Subhas Daily Market, Stall No: 132 (Suisa, Purulia).';

	        $total = 0;

	        $cgst = $result['basic_data'][0]['cgst'];

	        $sgst = $result['basic_data'][0]['sgst'];

	        $igst = $result['basic_data'][0]['igst'];

	        $discount = $result['basic_data'][0]['discount'];

	        $collection_charge = $result['basic_data'][0]['collection_charge'];



	      $h_height = 0;

			$h_width = 206;

			$float_x = 2;

			$float_y = 2;

			$h_image = $clinicresult['response_data'];

			$txt='Investigation Report';

			$pdf->Image($h_image,$float_x,$float_y,$h_width,$h_height,'PNG');



			// $pdf->SetFont('Arial','B',12);



			// $pdf->Cell(0,2,$lab_name,0,1,'C');

			// $pdf->SetFont('Arial','',7);



			// $pdf->Cell(0,10,$lab_address,0,1,'C');



			// $pdf->SetFont('Arial','B',12);



			// $pdf->SetFont('Arial','',7);



			// $pdf->Cell(20,5,'Contact :',0,0);

			

			// $pdf->Cell(50,5,'7678411561',0,1);



			// $pdf->Cell(20,5,'GSTIN :',0,0);

			

			// $pdf->Cell(50,5,'ZAXDZXXXXXXXXXX',0,1);



			// $pdf->Cell(20,5,'CIN :',0,0);

			

			// $pdf->Cell(50,5,'2545555455555',0,1);





			$pdf->Cell(0,30,'',0,1);



			$pdf->Cell(0,3,'',0,1);







			$pdf->SetFont('Arial','',7);



			$pdf->Cell(20,5,'Patient :',0,0);

			

			$pdf->Cell(50,5,$result['basic_data'][0]['title'].' '.$result['basic_data'][0]['patient_name'],0,0);







			$pdf->Cell(100,5,'Bill Date :',0,0,'R');



			$pdf->Cell(20,5,date('d-m-Y',strtotime($result['basic_data'][0]['billing_date'])),0,1,'R');







			$pdf->Cell(20,5,'Age :',0,0);



			$pdf->Cell(50,5,$result['basic_data'][0]['age'].' Years',0,0);

			

			$pdf->Cell(100,5,'Bill No :',0,0,'R');



			$pdf->Cell(20,5,$ref_no,0,1,'R');





			$pdf->Cell(20,5,'Sex :',0,0);



			$pdf->Cell(50,5,$result['basic_data'][0]['sex'],0,0);



			$pdf->Cell(100,5,'Contact :',0,0,'R');



			$pdf->Cell(20,5,$result['basic_data'][0]['mobile'],0,1,'R');



			











			$pdf->SetFont('Arial','B',8);



			$pdf->Cell(0,3,'',0,1);



			$pdf->Cell(0,0,'',1,1);



			$pdf->Cell(0,3,'',0,1);



			$pdf->SetFont('Arial','',7);

			$pdf->Cell(20,10,'Sl. No.',0,0,'C');

			$pdf->SetFont('Arial','',7);

			$pdf->Cell(150,10,'Test Name',0,0,'L');

			$pdf->SetFont('Arial','',7);

			$pdf->Cell(20,10,'Rate',0,1,'C');



			foreach($result['response_data'] as $key=>$value)

			{

				$pdf->SetFont('Arial','',6);

				$pdf->Cell(20,5,($key+1),0,0,'C');

				$pdf->SetFont('Arial','',6);

				$pdf->Cell(150,5,$value['test_name'],0,0,'L');

				$pdf->SetFont('Arial','',6);

				$pdf->Cell(20,5,$value['rate'],0,1,'C');

				$total += $value['rate'];

			}

			$pdf->SetFont('Arial','B',16);



			$pdf->Cell(0,3,'',0,1);



			$pdf->Cell(0,0,'',1,1);



			$pdf->Cell(0,3,'',0,1);



				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,'',0,0,'C');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(150,5,'Total',0,0,'R');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,$total.'.00',0,1,'C');



				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,'',0,0,'C');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(150,5,'CGST (+)',0,0,'R');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,$cgst,0,1,'C');



				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,'',0,0,'C');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(150,5,'SGST (+)',0,0,'R');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,$sgst,0,1,'C');



				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,'',0,0,'C');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(150,5,'IGST (+)',0,0,'R');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,$igst,0,1,'C');



				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,'',0,0,'C');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(150,5,'Discount (-)',0,0,'R');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,$discount,0,1,'C');



				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,'',0,0,'C');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(150,5,'Collection Charge (+)',0,0,'R');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,$collection_charge,0,1,'C');





				$grand = ($total+$cgst+$sgst+$igst+$collection_charge)-($discount);

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,'',0,0,'C');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(150,5,'Grand Total',0,0,'R');

				$pdf->SetFont('Arial','',8);

				$pdf->Cell(20,5,$grand.'.00',0,1,'C');



			



		



			$file =  date('Ymdhis').'__details.pdf';

			$pdf->Output($file,'I');

		    

       

    }







   public function wallet()

	{



	  $method='POST';

     $api='Billing/getWallet';

     $data='clinic_code='.$this->session->userdata('user_data')['clinic_code'];

     $result = $this->CallAPI($api, $data, $method); 

     $d['balance'] = $result['response_data']['balance'];

     $d['history'] = $result['response_data']['history'];

	  $d['v'] = 'billing/wallet';

	  $this->load->view('template',$d);



	}







}

?>

