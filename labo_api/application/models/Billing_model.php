<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Billing_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	    public function create_billing_m($data)
	    {
	    	$result = $this->db->insert('tbl_billing_master',$data);
	    	if($result==TRUE)
	    	{
	    		$id = $this->db->insert_id();
	    		$ref_no = 'BILL-0'.$id;
	    		$this->db->update('tbl_billing_master',['ref_no'=>$ref_no],['id'=>$id]);
	    		return $ref_no;
	    	}else
	    	{
	    		return 105;
	    	}
	    }

	    public function paid_unpaid_billing_m($data,$where)
	    {
	    	return $this->db->update('tbl_billing_master',$data,$where);
	    	
	    }

	    public function create_billing_test_m($data)
	    {
	    	return $this->db->insert('tbl_billing_test_details',$data);
	    }

	    public function get_billing_list_m($clinic_code,$from_date,$to_date)
	    {
	    	$this->db->select('bl.ref_no,bl.grand_total_amount,bl.paid_unpaid,bl.billing_date,p.full_name,p.title,v.vendor_name,bl.patient_id,bl.report_status,bl.print_status,bl.digital_sign,p.email,bl.clinic_code');
	    	$this->db->from('tbl_billing_master bl');
	    	$this->db->join('tbl_patient_master p','p.id=bl.patient_id','left');
	    	$this->db->join('tbl_vendor_master v','v.id=bl.vendor_id','left');
	    	$this->db->where(['bl.status'=>1,'bl.clinic_code'=>$clinic_code]);
	    	$this->db->where(['date(bl.billing_date)>='=>$from_date,'date(bl.billing_date)<='=>$to_date]);
	    	$this->db->order_by('bl.id','DESC');
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		
	    		$main_array = array();
	    		foreach($qry->result_array() as $key=>$value)
	    		{
	    			$main_array[$key]['ref_no'] = $value['ref_no'];
	    			$main_array[$key]['grand_total_amount'] = $value['grand_total_amount'];
	    			$main_array[$key]['paid_unpaid'] = $value['paid_unpaid'];
	    			$main_array[$key]['report_status'] = $value['report_status'];
	    			
	    			$main_array[$key]['billing_date'] = $value['billing_date'];
	    			$main_array[$key]['clinic_code'] = $value['clinic_code'];
	    			
	    			$main_array[$key]['email'] = $value['email'];
	    			$main_array[$key]['full_name'] = $value['full_name'];
	    			$main_array[$key]['title'] = $value['title'];
	    			$main_array[$key]['vendor_name'] = $value['vendor_name'];
	    			$main_array[$key]['patient_id'] = $value['patient_id'];
	    			$main_array[$key]['print_status'] = $value['print_status'];
	    			$main_array[$key]['digital_sign'] = $value['digital_sign'];
	    			$amount = $this->getTotalPaymentAmount($value['ref_no']);
	    			$main_array[$key]['paid_amount'] = $amount;
	    		}
	    		return $main_array;
	    	}else
	    	{
	    		return 105;
	    	}

	    }

	    public function get_pending_report_list_m()
	    {
	    	$this->db->select('bl.ref_no,bl.grand_total_amount,bl.paid_unpaid,bl.billing_date,p.full_name,p.title,v.vendor_name,bl.patient_id,bl.report_status');
	    	$this->db->from('tbl_billing_master bl');
	    	$this->db->join('tbl_patient_master p','p.id=bl.patient_id','left');
	    	$this->db->join('tbl_vendor_master v','v.id=bl.vendor_id','left');
	    	$this->db->where(['bl.status'=>1,'bl.report_status'=>0]);
	    	$qry = $this->db->get();
	    	if($qry->num_rows()>0)
	    	{
	    		
	    		$main_array = array();
	    		foreach($qry->result_array() as $key=>$value)
	    		{
	    			$main_array[$key]['ref_no'] = $value['ref_no'];
	    			$main_array[$key]['grand_total_amount'] = $value['grand_total_amount'];
	    			$main_array[$key]['paid_unpaid'] = $value['paid_unpaid'];
	    			$main_array[$key]['report_status'] = $value['report_status'];
	    			
	    			$main_array[$key]['billing_date'] = $value['billing_date'];
	    			$main_array[$key]['full_name'] = $value['full_name'];
	    			$main_array[$key]['title'] = $value['title'];
	    			$main_array[$key]['vendor_name'] = $value['vendor_name'];
	    			$main_array[$key]['patient_id'] = $value['patient_id'];
	    			$amount = $this->getTotalPaymentAmount($value['ref_no']);
	    			$main_array[$key]['paid_amount'] = $amount;
	    		}
	    		return $main_array;
	    	}else
	    	{
	    		return 105;
	    	}

	    }

	    public function getTotalPaymentAmount($ref_no)
	    {
	    	$this->db->select('sum(pm.cr_amount) as amount');
	    	$this->db->from('tbl_payment_historys pm');
	    	$this->db->where(['pm.ref_no'=>$ref_no,'pm.status'=>1]);
	    	$qry = $this->db->get();
	    	$data = $qry->result_array();
	    	return $data[0]['amount'];
	    }


	    public function getTotalPaymentCrAmount($ref_no)
	    {
	    	$this->db->select('sum(pm.cr_amount) as amount');
	    	$this->db->from('tbl_payment_historys pm');
	    	$this->db->where(['pm.ref_no'=>$ref_no,'pm.status'=>1]);
	    	$qry = $this->db->get();
	    	$data = $qry->result_array();
	    	return $data[0]['amount'];
	    }

	    public function getTotalAmount($ref_no)
	    {
	    	$this->db->select('grand_total_amount');
	    	$this->db->from('tbl_billing_master bl');
	    	$this->db->where(['bl.ref_no'=>$ref_no,'bl.status'=>1]);
	    	$qry = $this->db->get();
	    	$data = $qry->result_array();
	    	if(empty($data))
	    	{
	    		return [];
	    	}else
	    	{
	    		return $data[0]['grand_total_amount'];
	    	}
	    	
	    }

	    public function getTotalDataAmount($ref_no)
	    {
	    	$this->db->select('bl.grand_total_amount,p.title,p.full_name,p.mobile,p.email,b.business_name,b.business_address,bl.clinic_code,bl.patient_id');
	    	$this->db->from('tbl_billing_master bl');
	    	$this->db->join('tbl_patient_master p','p.id = bl.patient_id','left');
	    	$this->db->join('tbl_business_kyc_details b','b.clinic_code = bl.clinic_code','left');
	    	$this->db->where(['bl.ref_no'=>$ref_no,'bl.status'=>1]);
	    	$qry = $this->db->get();
	    	$data = $qry->result_array();
	    	if(empty($data))
	    	{
	    		return [];
	    	}else
	    	{
	    		return $data[0];
	    	}
	    	
	    }


	    public function getWalletBalances($clinic_code)
	    {
	    	$this->db->select('bal_amount');
	    	$this->db->from('tbl_clinic_wallet');
	    	$this->db->where(['clinic_code'=>$clinic_code,'status'=>1]);
	    	$qry = $this->db->get();
	    	$data = $qry->result_array();
	    	if(empty($data))
	    	{
	    		return 0;
	    	}else
	    	{
	    		return $data[0]['bal_amount'];
	    	}
	    	
	    }

	    public function getWalletHistory($clinic_code)
	    {
	    	$this->db->select('*');
	    	$this->db->from('tbl_clinic_wallet_history');
	    	$this->db->where(['clinic_code'=>$clinic_code,'status'=>1]);
	    	$this->db->order_by('id','desc');
	    	$qry = $this->db->get();
	    	return $data = $qry->result_array();
	    }
	   
	    public function update_billing_m($data,$where)
	    {
	    	return $this->db->update('tbl_billing_master',$data,$where);
	    }
	    public function update_billing_test_m($data,$where)
	    {
	    	return $this->db->update('tbl_billing_test_details',$data,$where);
	    }
	   
	    public function getBillingDetailsList_m($ref_no)
	    {
	    	$this->db->select('tm.test_name,tm.rate');
	    	$this->db->from('tbl_billing_test_details bl');
	    	$this->db->join('tbl_test_master tm','tm.id=bl.test_id','left');
	    	$this->db->where(['bl.ref_no'=>$ref_no,'bl.status'=>1]);
	    	$qry = $this->db->get();
	    	return $qry->result_array();
	    }


	    public function getPatientDetails_m($ref_no)
	    {
	    	$this->db->select('bm.tax_type,bm.cgst,bm.sgst,bm.igst,bm.discount,bm.total_amount,bm.grand_total_amount,bm.collection_charge,bm.billing_date,pm.full_name as patient_name,pm.age,pm.sex,pm.mobile,vm.vendor_name as vendor_name,vm.id as vendor_id,vm.vendor_firm,pm.title,bm.report_date,bm.report_remarks,bm.digital_sign,pm.month');
	    	$this->db->from('tbl_billing_master bm');
	    	$this->db->join('tbl_vendor_master vm','vm.id=bm.vendor_id','left');
	    	$this->db->join('tbl_patient_master pm','pm.id=bm.patient_id','left');
	    	$this->db->where(['bm.ref_no'=>$ref_no,'bm.status'=>1,'pm.status'=>1,'vm.status'=>1]);
	    	$qry = $this->db->get();
	    	return $qry->result_array();
	    }


	    /*public function getPatientDetails_m($ref_no)
	    {
	    	$this->db->select('bm.tax_type,bm.cgst,bm.sgst,bm.igst,bm.discount,bm.total_amount,bm.grand_total_amount,bm.collection_charge,bm.billing_date,pm.full_name as patient_name,pm.age,pm.sex,pm.mobile,vm.vendor_name as vendor_name,vm.vendor_firm,pm.title,bm.report_date,bm.report_remarks,bm.digital_sign');
	    	$this->db->from('tbl_billing_master bm');
	    	$this->db->join('tbl_vendor_master vm','vm.id=bm.vendor_id','left');
	    	$this->db->join('tbl_patient_master pm','pm.id=bm.patient_id','left');
	    	$this->db->where(['bm.ref_no'=>$ref_no,'bm.status'=>1,'pm.status'=>1,'vm.status'=>1]);
	    	$qry = $this->db->get();
	    	return $qry->result_array();
	    }*/


	    /*Wallet Functions*/
	    public function verifyWalletExist($clinic_code)
	    {
	    	$result = $this->db->select('count(id) as total')->from('tbl_clinic_wallet')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();
	    	return $result[0]['total'];
	    }

	    public function createWallet($data)
	    {
	    	return $this->db->insert('tbl_clinic_wallet',$data);
	    }

	    public function getWalletBalance($clinic_code)
	    {
	    	$result = $this->db->select('bal_amount')->from('tbl_clinic_wallet')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();
	    	if(empty($result))
	    	{
	    		return 0;
	    	}else
	    	{
	    		return $result[0]['bal_amount'];
	    	}
	    }

	     public function updateWallet($data,$where)
	    {
	    	return $this->db->update('tbl_clinic_wallet',$data,$where);
	    }
	    public function createWalletTransactionLog($data)
	    {
	    	return $this->db->insert('tbl_clinic_wallet_history',$data);
	    }

	    public function paymentGatwayBillLog($data)
	    {
	    	return $this->db->insert('tbl_payment_gateway_customer_history',$data);
	    }

	    public function paymentHistoryLog($data)
	    {
	    	$this->db->insert('tbl_payment_historys',$data);
	    	$id = $this->db->insert_id();
	    	$str = 'PMT-0'.$id;
	    	return $this->db->update('tbl_payment_historys',['payment_id'=>$str],['id'=>$id]);

	    }

	     public function updateBillPaidStatus($data,$where)
	    {
	    	return $this->db->update('tbl_billing_master',$data,$where);
	    }


	    /*14-07-2022*/

	    public function verifyClinicReportCountExistOrNot($clinic_code)
	    {
	    	$result = $this->db->select('count(id) as total')->from('tbl_free_plan_report_count')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();
	    	return $result[0]['total'];
	    }

	    public function getClinicReportCount($clinic_code)
	    {
	    	$result = $this->db->select('total_report')->from('tbl_free_plan_report_count')->where(['clinic_code'=>$clinic_code,'status'=>1])->get()->result_array();
	    	if(empty($result))
	    	{
	    		return 0;
	    	}else
	    	{
	    		return $result[0]['total_report'];
	    	}
	    }

	    public function createClinicReportCount($data)
	    {
	    	return $this->db->insert('tbl_free_plan_report_count',$data);
	    }

	    public function updateClinicReportCount($data,$where)
	    {
	    	return $this->db->update('tbl_free_plan_report_count',$data,$where);
	    }

	    public function verifyClinicReportPlanSubscribeExistOrNot($clinic_code)
	    {
	    	return $this->db->select('end_date')->from('tbl_plan_subscriptions_details')->where(['clinic_code'=>$clinic_code,'status'=>1,'current_status'=>'paid'])->order_by('end_date','desc')->limit(1)->get()->result_array();
	    }



	    /*14-07-2022*/



	  
	
	}
?>