<?php 
	$this->load->library('CustomFPDF');
	$pdf = $this->customfpdf->getInstance();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->Header('Arial');
	$pdf->SetFont('Times','',10);

	// $pdf->SetFont('Arial','B',8);
	// $pdf->Cell(0,0,'#PURCHASE ORDER ID : ',0,1,'R');
	$h_height = 0;
	$h_width = 202;
	$float_x = 5;
	$float_y = 5;
	$pdf->Image(base_url().'report_assets/2pad.PNG',$float_x,$float_y,$h_width,$h_height,'PNG');

	$file =  date('Ymdhis').'__details.pdf';
	$pdf->Output($file,'I');

?>