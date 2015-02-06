<?php
	require('fpdf/classreport.php');
	$pdf=new PDF('P','mm','A4');
	$pdf->SetMargins(10,10,2);
	$pdf->AliasNbPages();	
	$pdf->AddPage();
	$pdf->SetFont('Arial','',8);
	$session_id = $this->UserLogin->isLogin();
	$this->pt_id = $session_id['id_pt'];
	$pt = $this->pt_id;
	//var_dump($pt);
			
	$judul = "Kwitansi";
	//$nopem = $cekdt->kwtbill_no;
	$tglreceipt = $cekdt->kwtbill_paydate;
	$bank = $cekdt->bank_nm;
	$acctno = '-';
			
	$pdf->SetXY(130,10);
	$pdf->Cell(40,5,'',10,0,'L',0);
	$pdf->Cell(40,5,$nopem,10,0,'L',0);
		
	$pdf->SetXY(130,15);
	$pdf->Cell(40,5,'Tanggal Receipt',10,0,'L',0);
	$pdf->Cell(40,5,indo_date($tglreceipt),10,0,'L',0);
			
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(40,5,$judul,10,0,'L',0);
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(30,5,'BANK',10,0,'L',0);
	$pdf->Cell(8,5,':',10,0,'C',0);
	$pdf->Cell(20,5,$bank,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->Cell(30,5,'ACCT. NO',10,0,'L',0);
	$pdf->Cell(8,5,':',10,0,'C',0);
	$pdf->Cell(20,5,$acctno,10,0,'L',0);
			
	$pdf->Ln(5);
	$pdf->Cell(8,5,'',10,0,'L',0);
	#konsisi looping data pembayaran
	$pdf->Cell(155,5,'',10,0,'L',0);
	$pdf->Cell(20,5,'',10,0,'L',0);
	$pdf->Ln(5);
	$pdf->Cell(8,5,'Pembayaran '.$cekdt->paygroup_nm.' '.$cekdt->customer_nama.' Unit '.$cekdt->unit_no.'--'.$cekdt->kwtbill_descs,10,0,'L',0);
	$pdf->Cell(164,5,'',10,0,'L',0);
	$pdf->Ln(5);
	$pdf->Cell(8,5,'',10,0,'L',0);
	#akhir konsisi data pembayaran
			
	$pdf->Cell(155,5,'Terbilang '.Ucfirst(toRupiah($cekdt->kwtbill_pay)),10,0,'L',0);
	$pdf->Cell(20,5,number_format($cekdt->kwtbill_pay),10,0,'L',0);
	$pdf->Ln(10);
	
			
			
			
				
	$pdf->Output("hasil.pdf","I");	
		
	
