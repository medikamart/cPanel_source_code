
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Report extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function apointment($ref_no)
	{
		// patient list
		$method='POST';
        $api='Report/report_master';
        $data='action=R&ref_no='.$ref_no.'&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);  
        $d['test_details'] = $result['response_data'];
        $d['basic_data'] = $result['basic_data'];
        
        $method='POST';
        $api='Unit/unit_master';
        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);  
        $d['unit_list'] = $result['response_data'];
        $method='POST';
        $api='Vendor/vendor_master';
        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);  
        $d['vendor_list'] = $result['response_data'];
       
		$d['v'] = 'report/create_report';
		$this->load->view('template',$d);
	}

	public function create_report_now()
	{
		$data = base64_encode(urlencode(json_encode($_POST,TRUE)));
		$method='POST';
        $api='Report/report_master';
        $data='action=C&data='.$data;
        $result = $this->CallAPI($api, $data, $method);  
        echo json_encode($result);
	}


	public function report_settings()
	{
		$d['v'] = 'report/report_settings';
		$this->load->view('template',$d);
	}

	public function test_report_download()
	{
		$ref_no = $this->uri->segment(3);
		$this->report($ref_no);
	}
	public function report($ref_no)
    {
        	$sessionData = $this->session->userdata('user_data');
        	$method='POST';
	        $api='Report/report_master';
	        $data='action=R&use_type=print&&ref_no='.$ref_no;
	        $result = $this->CallAPI($api, $data, $method);  
	        $test_details = $result['response_data'];
	        $basic_data = $result['basic_data'];
	        $method='POST';
	        $api='Unit/unit_master';
	        $data='action=R';
	        $result = $this->CallAPI($api, $data, $method);  
	        $unit_list = $result['response_data'];
	      
            $this->load->library('CustomFPDF');
			$pdf = $this->customfpdf->getInstance();
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->Header('Arial');
			$pdf->SetFont('Times','',10);

			$method='POST';
	        $api='Tool/get_pad_image_letest';
	        $data='clinic_code='.$sessionData['clinic_code'];
	        $clinicresult = $this->CallAPI($api, $data, $method); 


			$digital_sign = $basic_data[0]['digital_sign'];
			$h_height = 0;
			$h_width = 206;
			$float_x = 2;
			$float_y = 2;
			$h_image = $clinicresult['response_data'];
			$txt='Investigation Report';
			$pdf->Image($h_image,$float_x,$float_y,$h_width,$h_height,'PNG');
			$pdf->SetFont('Arial','B',16);

			$pdf->Cell(0,30,'',0,1);


			$pdf->SetFont('Arial','B',16);

			$pdf->Cell(0,0,'',1,1);

			$pdf->Cell(0,3,'',0,1);



			$pdf->SetFont('Arial','',10);

			$pdf->Cell(20,5,'Patient :',0,0);

			$pdf->Cell(50,5,$basic_data[0]['title'].' '.$basic_data[0]['patient_name'],0,0);



			$pdf->Cell(100,5,'Recived Date :',0,0,'R');

			$pdf->Cell(20,5,date('d-m-Y',strtotime($basic_data[0]['billing_date'])),0,1,'R');



			$pdf->Cell(20,5,'Age :',0,0);

			$age_str  = '';
			if(!empty($basic_data[0]['age']))
			{
				$age_str .= $basic_data[0]['age'].' '.'Years ';
			}
			if(!empty($basic_data[0]['month']))
			{
				$age_str .= $basic_data[0]['month'].' '.'Months ';
			}
			$pdf->Cell(50,5,$age_str,0,0);



			$pdf->Cell(100,5,'Report Date :',0,0,'R');

			$pdf->Cell(20,5,date('d-m-Y',strtotime($basic_data[0]['report_date'])),0,1,'R');



			$pdf->Cell(20,5,'Sex :',0,0);

			$pdf->Cell(50,5,$basic_data[0]['sex'],0,0);



			$pdf->Cell(100,5,'Report No :',0,0,'R');

			$pdf->Cell(20,5,$ref_no,0,1,'R');



			$pdf->Cell(20,5,'Refered By :',0,0);

			$pdf->Cell(50,5,$basic_data[0]['vendor_name'],0,1);





			$pdf->SetFont('Arial','B',16);

			$pdf->Cell(0,3,'',0,1);

			$pdf->Cell(0,0,'',1,1);

			$pdf->Cell(0,3,'',0,1);



			$pdf->SetFont('Arial','',16);

			$pdf->Cell(0,10, $txt,0,1,'C');


			foreach($test_details as $key=>$value)
			{
				$pdf->SetFont('Arial','U',10);

    			$pdf->Cell(0,10,$value['category_name'],0,1,'C');
	            foreach($value['test_list'] as $key2=>$value2)
	            {
	            	
	            	$pdf->SetFont('Arial','U',10);

        			$pdf->Cell(0,3,$value2['test_name'],0,5,'C');

        			if($value2['important']==1)
        			{
        				$pdf->SetFont('Arial','',10);

			              $pdf->Cell(0,10,'Slide agglutination test for Salmonella group of organisms reveal following titers.',0,1,'L');

			              $pdf->SetFont('Arial','B',10);

			              $pdf->Cell(80,5,'Test',0,0);

			              $pdf->Cell(25,5,'1:20',0,0);

			              $pdf->Cell(25,5,'1:40',0,0);

			              $pdf->Cell(25,5,'1:80',0,0);

			              $pdf->Cell(25,5,'1:160',0,0);

			              $pdf->Cell(25,5,'1:320',0,1);



			              $pdf->Cell(0,1,'',1,1);
        			}else
        			{

        			     $pdf->Cell(0,1,'',1,1);

			              $pdf->SetFont('Arial','B',10);

			              $pdf->Cell(80,5,'Test',0,0);

			              $pdf->Cell(40,5,'Result',0,0);

			              $pdf->Cell(40,5,'Unit',0,0);

			              $pdf->Cell(50,5,'Reference',0,1);



			              $pdf->Cell(0,1,'',1,1);
        			}


				$i = 1;
        			foreach($value2['sub_test'] as $key3=>$value3)
        			{
        				// echo '<pre>';
	           //  		print_r($value3);
				if($i==1)
				{ $he = 7;}else{$he = 2;}
	            		if($value2['important'] == 1)
			             {


				
			              $pdf->SetFont('Arial','',10);

			              $pdf->Cell(80,$he,$value3['res_test_name'],0,0);
				
				      $pdf->SetFont('Arial','',15);
			              $pdf->Cell(25,$he,$value3['res_one_20'],0,0);

			              $pdf->Cell(25,$he,$value3['res_one_40'],0,0);

			              $pdf->Cell(25,$he,$value3['res_one_80'],0,0);

			              $pdf->Cell(25,$he,$value3['res_one_160'],0,0);

			              $pdf->Cell(25,$he,$value3['res_one_320'],0,1);

			            

			             }else

			             {



			              $pdf->SetFont('Arial','',10);

			              $pdf->Cell(80,$he,$value3['res_test_name'],0,0);

			              $pdf->Cell(40,$he,$value3['res_result'],0,0);
			              $unit_res = '';
			              foreach($unit_list as $key5=>$value5)
			              {
			              	if($value5['id']==$value3['res_unit_id'])
			              	{
			              		$unit_res = $value5['unit'];
			              	}
			              }

			              $pdf->Cell(40,$he,$unit_res,0,0);

			              $pdf->Cell(50,$he,$value3['res_reference'],0,1);

			              $pdf->Cell(0,2,'',0,1);

			             	$i++;

			             }
        			}




	            }



			}


			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(0,10,'Remarks : '.$basic_data[0]['report_remarks'],0,1,'L');

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(20,2,'',0,0);

			$pdf->Cell(20,2,'Wish You Good Health',0,1);



			$pdf->SetFont('Arial','',10);

			$pdf->Cell(0,10, $txt='----Report End----',0,1,'C');





			 $pdf->SetFont('Arial','',8);

			 $pdf->Cell(0,50,'',0,1);

			
			 if($digital_sign ==1)

			 {

			    $image1 = base_url()."report_assets/sign.png";

			    $pdf->Cell( 0, 17, $pdf->Image($image1, 140, $pdf->GetY(), 33.78), 0, 1,'R',false ); 

			 }

			 

			 $pdf->Cell(0,5,'       Signature                                                ',0,1,'R');

			 $pdf->Cell(0,2,'(Authorized Signature)                                          ',0,1,'R');
		

			$file =  date('Ymdhis').'__details.pdf';
			$pdf->Output($file,'I');
		    
       
    }


    public function getVendorDue()
    {
    	$method='POST';
        $api='Vendor/vendor_master';
        $data='action=R&clinic_code='.$this->session->userdata('user_data')['clinic_code'];
        $result = $this->CallAPI($api, $data, $method);  
        $d['vendor_list'] = $result['response_data'];
    	$d['v'] = 'report/vendorDuePayment';
		$this->load->view('template',$d);
    }
    public function getVendorPaymentDue_ajax()
	{
		$vendor_id = $this->input->post('vendor_id')!=''?$this->input->post('vendor_id'):'';
	    $pay_status = $this->input->post('pay_status')!=''?$this->input->post('pay_status'):'';
	    $from_date = $this->input->post('from_date')!=''?date('Y-m-d',strtotime($this->input->post('from_date'))):date('Y-m-d');
	    $to_date = $this->input->post('to_date')!=''?date('Y-m-d',strtotime($this->input->post('to_date'))):date('Y-m-d');

		$data = 'vendor_id='.$vendor_id.'&pay_status='.$pay_status.'&from_date='.$from_date.'&to_date='.$to_date;
		$method='POST';
        $api='Report/getVendorDueReport';
        $result = $this->CallAPI($api, $data, $method);  

        // echo '<pre>';
        // print_r($result['response_data']);die;

        $this->load->library('CustomFPDF');
		$pdf = $this->customfpdf->getInstance();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->Header('Arial');
		$pdf->SetFont('Times','',10);

		
		$h_height = 0;
		$h_width = 210;
		$float_x = 2;
		$float_y = 2;
		$h_image = base_url().'report_assets/pad.PNG';
		$txt='Investigation Report';
		$pdf->Image($h_image,$float_x,$float_y,$h_width,$h_height,'PNG');
		$pdf->SetFont('Arial','B',16);

		$pdf->Cell(0,30,'',0,1);


		$pdf->SetFont('Arial','B',16);

		$pdf->Cell(0,0,'',1,1);

		$pdf->Cell(0,3,'',0,1);

		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(30,5,'Billing Date',0,0);
		$pdf->Cell(30,5,'Billing No.',0,0);
		$pdf->Cell(60,5,'Refered By',0,0);
		$pdf->Cell(20,5,'Total',0,0);
		$pdf->Cell(20,5,'Discount',0,0);
		$pdf->Cell(20,5,'Grand Total',0,0);
		$pdf->Cell(30,5,'Status',0,1);

		$pdf->Cell(0,1,'',1,1);
		$pdf->Cell(0,5,'',0,1);

		$pdf->SetFont('Arial','',8);
		$total_discount = 0;
		$total_sub = 0;
		$total_grand = 0;
		$total_paid = 0;
		$total_unpaid = 0;
		if(!empty($result['response_data']))
		{
			foreach($result['response_data'] as $key=>$value)
			{
				// echo '<pre>';
				// print_r($value);
				$pdf->Cell(30,5,date('d-m-Y',strtotime($value['billing_date'])),0,0);
				$pdf->Cell(30,5,$value['ref_no'],0,0);
				$pdf->Cell(60,5,$value['vendor_name'],0,0);
				$pdf->Cell(20,5,$value['total_amount'],0,0);
				$pdf->Cell(20,5,$value['discount'],0,0);
				$pdf->Cell(20,5,$value['grand_total_amount'],0,0);

				$total_discount += $value['discount'];
				$total_sub += $value['total_amount'];
				$total_grand += $value['grand_total_amount'];

				if($value['paid_unpaid']==1)
				{
					$pdf->Cell(30,5,'Paid',0,1);
					$total_paid += $value['grand_total_amount'];
					
				}elseif($value['paid_unpaid']==0)
				{
					$pdf->Cell(30,5,'Unpaid',0,1);
					$total_unpaid += $value['grand_total_amount'];
				}
				
			}
			
		}

		$pdf->Cell(0,1,'',1,1);
		$pdf->Cell(0,0,'',0,1);
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(60,5,'Grand Total ',0,0);
		$pdf->Cell(30,5,round($total_paid,2).'(paid)',0,0);
		$pdf->Cell(30,5,round($total_unpaid,2).'(unpaid)',0,0);
		$pdf->Cell(20,5,'Rs. '.round($total_sub,2),0,0);
		$pdf->Cell(20,5,'Rs. '.round($total_discount,2),0,0);
		$pdf->Cell(20,5,'Rs. '.round($total_grand,2),0,0);
		$pdf->Cell(30,5,'-',0,1);



		$file =  date('Ymdhis').'__paymentDetails.pdf';
		$pdf->Output($file,'D');
        // echo json_encode($result);
	}


}
?>
