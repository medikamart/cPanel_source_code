<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');
	class Report_model extends CI_Model
	{
		
		public function __construct() {
	        parent::__construct();
	        
	    }

	   public function get_reportDetails_m($ref_no,$test_array)
	   {
	   		$main_array = array();
	   		$report_status = $this->get_bill_report_status_m($ref_no);
	   		$category_list = $this->get_bill_category_list_m($ref_no,$test_array);
	   		foreach($category_list as $key=>$value)
	   		{
	   			$main_array[$key]['category_name'] = $value['category_name'];
	   			$main_array[$key]['category_id'] = $value['category_id'];
	   			$test_list = $this->get_bill_test_list_m($ref_no,$value['category_id'],$test_array);

	   			foreach($test_list as $key2=>$value2)
	   			{
	   				$main_array[$key]['test_list'][$key2]['test_name'] = $value2['test_name'];
	   				$main_array[$key]['test_list'][$key2]['b_test_id'] = $value2['b_test_id'];
	   				$main_array[$key]['test_list'][$key2]['important'] = $value2['important'];
	   				$main_array[$key]['test_list'][$key2]['test_id'] = $value2['test_id'];

	   				if($report_status==1)
	   				{
	   					$test_details_list = $this->get_report_test_details_list_m($value2['test_id'],$ref_no);
	   					$main_array[$key]['test_list'][$key2]['sub_test'] = $test_details_list;
	   				}else
	   				{
	   					$test_details_list = $this->get_bill_test_details_list_m($value2['test_id']);
	   					$main_array[$key]['test_list'][$key2]['sub_test'] = $test_details_list;
	   				}
	   				
	   				
	   			}
	   		}
	   		return $main_array;
	   }
	   public function get_bill_category_list_m($ref_no,$test_array)
	   {
	   		foreach($test_array as $key=>$value)
	   		{
	   			$this->db->or_where('td.test_id',$value);
	   		}

	   		$this->db->select('td.category_id,ct.category_name');
	   		$this->db->from('tbl_billing_test_details td');
	   		$this->db->join('tbl_category_master ct','ct.id=td.category_id','left');
	   		$this->db->where(['td.ref_no'=>$ref_no,'td.status'=>1]);
	   		
	   		$this->db->group_by('td.category_id');
			
	   		$qry = $this->db->get();
	   		// echo $this->db->last_query();die;
	   		return $qry->result_array();
	   }

	   public function get_bill_report_status_m($ref_no)
	   {
	   		$this->db->select('bl.report_status');
	   		$this->db->from('tbl_billing_master bl');
	   		$this->db->where(['bl.ref_no'=>$ref_no,'bl.status'=>1]);
	   		$qry = $this->db->get();
	   		$data =  $qry->result_array();
	   		return $data[0]['report_status'];
	   }

	   public function get_bill_test_list_m($ref_no,$category_id,$test_array)
	   {	

	   		$where = " (td.ref_no= '$ref_no' AND td.category_id='$category_id' AND td.status=1) ";
	   	    $sub_where="";
	   		foreach($test_array as $key=>$value)
	   		{
	   			// $this->db->or_where(['td.test_id'=>$value,'td.category_id'=>$category_id]);
	   			$sub_where .= $sub_where!=""?"  OR td.test_id = '$value' ": " td.test_id = '$value' ";
	   		}
	   		$where = $where." AND ( ".$sub_where." )";
	   		$sub_query = " select tm.test_name,td.id as b_test_id,td.test_id,tm.important from tbl_billing_test_details td left join tbl_test_master tm on tm.id= td.test_id ";
	   		if($where!="")
	   				$sub_query .= " WHERE ".$where." ";
	   		
	  //  		$this->db->select('tm.test_name,td.id as b_test_id,td.test_id,tm.important');
	  //  		$this->db->from('tbl_billing_test_details td');
	  //  		$this->db->join('tbl_test_master tm','tm.id=td.test_id','left');
	  //  		$this->db->where(['td.ref_no'=>$ref_no,'td.category_id'=>$category_id,'td.status'=>1]);
	  //  		$this->db->group_by('td.test_id');
			// $this->db->order_by('td.id','ASC');
	   		$qry = $this->db->query($sub_query);

	   		// echo  $this->db->last_query();die;
	   		return $qry->result_array();
	   }

	   public function get_bill_test_details_list_m($test_id)
	   {
	   		$this->db->select('
	   			td.id as sub_test_id,
	   			td.sub_test_name,
	   			td.unit_id,
	   			td.test_reference_id,
	   			rb.input_type,
	   			rb.box_details');
	   		$this->db->from('tbl_test_details td');
	   		$this->db->join('tbl_input_box_master rb','rb.id=td.result_box','left');
	   		$this->db->where(['td.test_id'=>$test_id,'td.status'=>1,'rb.status'=>1]);
	   		$qry = $this->db->get();
	   		return $qry->result_array();
	   }

	   public function get_report_test_details_list_m($test_id,$ref_no)
	   {
	   		$this->db->select('
	   			td.id as sub_test_id,
	   			td.sub_test_name,
	   			td.unit_id,
	   			td.test_reference_id,
	   			rb.input_type,
	   			rb.box_details,
	   			rp.unit as res_unit_id,
	   			rp.result as res_result,
	   			rp.one_20 as res_one_20,
	   			rp.one_40 as res_one_40,
	   			rp.one_80 as res_one_80,
	   			rp.one_160 as res_one_160,
	   			rp.one_320 as res_one_320,
	   			rp.reference as res_reference,
	   			rp.test_name as res_test_name
	   			');
	   		$this->db->from('tbl_test_details td');
	   		$this->db->join('tbl_input_box_master rb','rb.id=td.result_box','left');
	   		$this->db->join('report_details rp','rp.b_sub_test_id=td.id','left');
	   		$this->db->where(['td.test_id'=>$test_id,'td.status'=>1,'rb.status'=>1,'rp.status'=>1,'rp.ref_no'=>$ref_no]);
	   		$qry = $this->db->get();
	   		return $qry->result_array();
	   }

	  public function add_new_report_test_m($data)
	  {	
	  	$this->db->where(['b_test_id'=>$data['b_test_id'],'b_sub_test_id'=>$data['b_sub_test_id'],'status'=>1]);
	  	$qry = $this->db->get('report_details');
	  	if($qry->num_rows()>0)
	  	{
	  		$data['d_date'] = date('Y-m-d H:i:s');
	  		$this->db->update('report_details',$data,['b_test_id'=>$data['b_test_id'],'b_sub_test_id'=>$data['b_sub_test_id'],'status'=>1]);
	  		return $this->db->update('tbl_billing_master',['report_status'=>1,'report_date'=>date('Y-m-d H:i:s')],['ref_no'=>$data['ref_no']]);
	  	}else
	  	{
	  		$data['c_date'] = date('Y-m-d H:i:s');
	  		$this->db->insert('report_details',$data);
	  		return $this->db->update('tbl_billing_master',['report_status'=>1,'report_date'=>date('Y-m-d H:i:s')],['ref_no'=>$data['ref_no']]);
	  	}
	  	
	  }


	  public function alertPendingReport_m()
	  {
	  	$this->db->select('b.ref_no,b.billing_date,p.full_name');
	  	$this->db->from('tbl_billing_master b');
	  	$this->db->join('tbl_patient_master p','p.id=b.patient_id','left');
	  	$this->db->where(['b.report_status'=>0,'b.status'=>1]);
	  	return $this->db->get()->result_array();
	  }

	  public function get_billing_details_m($bill_no)
	  {
	  	$this->db->select('b.ref_no,b.billing_date,p.full_name,p.age,p.sex,p.mobile,v.vendor_name,v.vendor_firm,v.id as vendor_id');
	  	$this->db->from('tbl_billing_master b');
	  	$this->db->join('tbl_patient_master p','p.id=b.patient_id','left');
	  	$this->db->join('tbl_vendor_master v','v.id=b.vendor_id','left');
	  	$this->db->where(['b.status'=>1,'b.ref_no'=>$bill_no]);
	  	return $this->db->get()->result_array();
	  }

	  // total count start
	  public function total_earning_m($clinic_code)
	  {
	  	$this->db->select('if(sum(b.grand_total_amount) is null,0,sum(b.grand_total_amount)) as total_earning');
	  	$this->db->from('tbl_billing_master b');
	  	$this->db->where(['b.status'=>1,'b.report_status'=>1,'b.clinic_code'=>$clinic_code]);
	  	$data = $this->db->get()->result_array();
	  	return $data[0]['total_earning'];
	  }
	  public function total_earning_due_m($clinic_code)
	  {
	  	$this->db->select('sum(b.grand_total_amount) as total_earning');
	  	$this->db->from('tbl_billing_master b');
	  	$this->db->where(['b.status'=>1,'b.report_status'=>1,'b.paid_unpaid'=>0,'b.clinic_code'=>$clinic_code]);
	  	$data1 = $this->db->get()->result_array();

	  	$this->db->select('sum(h.dr_amount) as dr_amount');
	  	$this->db->from('tbl_payment_historys h');
	  	$this->db->join('tbl_billing_master b','b.ref_no=h.ref_no');
	  	$this->db->where(['b.status'=>1,'b.report_status'=>1,'b.paid_unpaid'=>0,'b.clinic_code'=>$clinic_code]);
	  	$data2 = $this->db->get()->result_array();
	  	return ($data1[0]['total_earning']-$data2[0]['dr_amount']);
	  }
	  public function total_report_done_m($clinic_code)
	  {
	  	$this->db->select('id');
	  	$this->db->from('tbl_billing_master b');
	  	$this->db->where(['b.status'=>1,'b.report_status'=>1,'b.clinic_code'=>$clinic_code]);
	  	return $this->db->get()->num_rows();
	  }

	  public function total_outing_income_m()
	  {
	  	$this->db->select('sum(o.amount) as total_outing');
	  	$this->db->from('tbl_outing_report o');
	  	$this->db->where(['o.status'=>1]);
	  	$data = $this->db->get()->result_array();
	  	return $data[0]['total_outing'];
	  }
	  // total count end
	  public function total_report_pending_m($clinic_code)
	  {
	  	$this->db->select('b.id');
	  	$this->db->from('tbl_billing_master b');
	  	$this->db->where(['b.status'=>1,'b.report_status'=>0,'b.clinic_code'=>$clinic_code]);
	  	return $this->db->get()->num_rows();
	  }


	  public function get_category_wise_count_report($clinic_code)
	  {	
		$this->db->where(['td.status'=>1,'bl.clinic_code'=>$clinic_code]);
	  	$this->db->select('cm.category_name,count(td.id) as total');
	  	$this->db->from('tbl_billing_test_details td');
	  	$this->db->join('tbl_billing_master bl','bl.ref_no = td.ref_no','left');
	  	$this->db->join('tbl_category_master cm','cm.id = td.category_id','left');
	  	$this->db->group_by('td.category_id');
	  	return $this->db->get()->result_array();
	  }

	  public function get_test_wise_count_report($clinic_code)
	  {
		$this->db->where(['td.status'=>1,'bl.clinic_code'=>$clinic_code]);
	  	$this->db->select('cm.category_name,ts.test_name,count(td.id) as total');
	  	$this->db->from('tbl_billing_test_details td');
	  	$this->db->join('tbl_billing_master bl','bl.ref_no = td.ref_no','left');
	  	$this->db->join('tbl_test_master ts','td.test_id = ts.id','left');
	  	$this->db->join('tbl_category_master cm','cm.id = td.category_id','left');
	  	$this->db->group_by('td.test_id');
	  	$this->db->order_by('count(td.id)','DESC');
	  	return $this->db->get()->result_array();
	  }

	  public function get_last_30_days_sales_report($clinic_code)
	  {	
	  	$date = date('d',strtotime("-30 days"));
		$this->db->where(['bm.status'=>1,'bm.clinic_code'=>$clinic_code]);
	  	$this->db->select('DATE_FORMAT(billing_date,"%d") as billing_date,sum(grand_total_amount) as grand_total_amount');
	  	$this->db->from('tbl_billing_master bm');
	  	$this->db->where(['date(billing_date)>='=>$date]);
	  	$this->db->order_by('billing_date','ASC');
	  	$this->db->group_by('date(billing_date)');
	  	return $this->db->get()->result_array();
	  }


	  public function get_refered_by_doctors_report($clinic_code)
	  {	
		$this->db->where(['bm.status'=>1,'bm.clinic_code'=>$clinic_code]);
	  	$this->db->select('vm.vendor_name,count(bm.id) as total');
	  	$this->db->from('tbl_billing_master bm');
	  	$this->db->join('tbl_vendor_master vm','vm.id=bm.vendor_id','left');
	  	$this->db->group_by('bm.vendor_id');
	  	$this->db->order_by('count(bm.id)','DESC');
	  	return $this->db->get()->result_array();
	  }

	   public function print_status_update($ref_no)
	  {
	  	return $this->db->update('tbl_billing_master',['print_status'=>1],['ref_no'=>$ref_no]);
	  }

	  public function get_print_test_list($ref_no)
	  {
	  		   $this->db->select('c.category_name,t.test_name,td.test_id');
	  		   $this->db->from('tbl_billing_test_details td');
	  		   $this->db->join('tbl_billing_master b','b.ref_no=td.ref_no','left');
	  		   $this->db->join('tbl_test_master t','t.id=td.test_id','left');
	  		   $this->db->join('tbl_category_master c','c.id=td.category_id','left');
	  		   $this->db->where(['td.ref_no'=>$ref_no,'td.status'=>1,'b.report_status'=>1]);
	  		   // $this->db->get();
	  		   // return $this->db->last_query();die;
	  		   return $this->db->get()->result_array();
	  }

	  public function store_print_details($data,$ref_no)
	  {
	  		$verify = $this->verify_print_details($ref_no);
	  		if($verify>0)
	  		{
	  			// update
	  			return $this->db->update('print_report_details',$data,['ref_no'=>$ref_no]);
	  		}else
	  		{
	  			return $this->db->insert('print_report_details',$data,['ref_no'=>$ref_no]);
	  		}
	  }

	  public function get_print_details($ref_no)
	  {
			$this->db->select('test_ids');
			$this->db->from('print_report_details');
			$this->db->where(['ref_no'=>$ref_no,'status'=>1]);
			return $this->db->get()->result_array();
	  }

	  public function verify_print_details($ref_no)
	  {
	  	$this->db->select('id');
	  	$this->db->from('print_report_details');
	  	$this->db->where(['ref_no'=>$ref_no,'status'=>1]);
	  	return $this->db->get()->num_rows();
	  }

	  public function get_lab_report_earning($billing_date,$clinic_code)
	  {
	  	$this->db->select('sum(grand_total_amount) as grand_total_amount');
	  	$this->db->from('tbl_billing_master');
	  	$this->db->where(['date(billing_date)'=>date('Y-m-d',strtotime($billing_date)),'status'=>1,'report_status'=>1,'clinic_code'=>$clinic_code]);
	  	$data = $this->db->get()->result_array();
	  	if(empty($data[0]['grand_total_amount']))
	  			return 0;
  		else
  				return $data[0]['grand_total_amount'];
	  }
	  public function get_outing_report_earning($outing_date)
	  {
	  	$this->db->select('sum(amount) as amount');
	  	$this->db->from('tbl_outing_report');
	  	$this->db->where(['date(outing_date)'=>date('Y-m-d',strtotime($outing_date)),'status'=>1]);
	  	$data = $this->db->get()->result_array();
	  	if(empty($data[0]['amount']))
	  			return 0;
  		else
  				return $data[0]['amount'];
	  }


	 public function get_billing_test_ids($ref_no)
	  {
	  	$this->db->select('test_id');
	  	$this->db->from('tbl_billing_test_details');
	  	$this->db->where(['ref_no'=>$ref_no,'status'=>1]);
	  	$result = $this->db->get()->result_array();
	  	$test_array = [];
	  	foreach($result as $key=>$value)
	  	{
	  		array_push($test_array,$value['test_id']);

	  	}
	  	return $test_array;
	  
	  }

	  public function getVendorPaymentDueReport_m($vendor_id,$pay_status,$from_date,$to_date)
	  {
	  	if($vendor_id!='')
	  			$this->db->where(['bl.vendor_id'=>$vendor_id]);
  		if($pay_status!='')
	  			$this->db->where(['bl.paid_unpaid'=>$pay_status]);
  		if($from_date!='' && $to_date!='')
	  			$this->db->where(['date(bl.billing_date)>='=>$from_date,'date(bl.billing_date)<='=>$to_date]);
	  	return $this->db->select('v.vendor_name,v.vendor_phone,v.vendor_firm,bl.ref_no,bl.billing_date,bl.grand_total_amount,bl.paid_unpaid,bl.discount,bl.total_amount')
	  	->from('tbl_billing_master bl')
	  	->join('tbl_vendor_master v','v.id = bl.vendor_id','left')
	  	->where(['bl.status'=>1])
	  	->get()->result_array();

	  }

	  public function updateVendorId_m($report_id,$vendor_id)
	  {
	  	return $this->db->update('tbl_billing_master',['vendor_id'=>$vendor_id],['ref_no'=>$report_id]);
	  }



	
	}
?>