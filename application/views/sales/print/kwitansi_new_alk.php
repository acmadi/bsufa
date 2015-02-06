<?php
	require('fpdf/classreportkwitansi.php');
	
	$pdf=new PDF('P','mm',array(210.1,175.9)); 
	//$pdf=new PDF('P','mm','A4');
	$pdf->SetMargins(10,10,2);
	$pdf->AliasNbPages();	
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$session_id = $this->UserLogin->isLogin();
	$this->pt_id = $session_id['id_pt'];
	$pt = $this->pt_id;
	//var_dump($pt);
			//var_dump($cekdt);exit;
	$judul = "Kwitansi";
	$nopem = $cekdt->kwtbill_no;
	$tglreceipt = $cekdt->kwtbill_paydate;
	$bank = $cekdt->bank_nm;
	$acctno = '-';
			
	$pdf->SetXY(137,39);
	$pdf->Cell(40,5,'',10,0,'L',0);
	$pdf->Cell(40,5,$nopem,10,0,'L',0);
		
	$pdf->SetXY(130,15);
	$pdf->Cell(40,5,'',10,0,'L',0);
	$pdf->Cell(40,5,'',10,0,'L',0);
			
	$pdf->Ln(10);
	$pdf->SetXY(30,15);
	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(40,5,$judul,10,0,'L',0);
	$pdf->Ln(8);
	$pdf->SetXY(30,30);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,5,'',10,0,'L',0);
	$pdf->Cell(8,5,'',10,0,'C',0);
	//$pdf->Cell(20,5,$bank,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,15);
	$pdf->Cell(30,5,'',10,0,'L',0);
	$pdf->Cell(8,5,'',10,0,'C',0);
	///$pdf->Cell(20,5,$bank,10,0,'L',0);
			
	$pdf->Ln(5);
	$pdf->Cell(8,5,'',10,0,'L',0);
	#konsisi looping data pembayaran
	$pdf->Cell(155,5,'',10,0,'L',0);
	$pdf->Cell(20,5,'',10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,53);
	$pdf->Cell(8,5,$cekdt->customer_nama,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,70);
	//$pdf->Cell(8,5,Ucfirst(toRupiah($cekdt->kwtbill_pay)).' Rupiah',10,0,'L',0);
	$pdf->MultiCell(155,5,ucwords(toRupiah2($cekdt->kwtbill_pay)),10,'L',0);
	// $pdf->Cell(8,5,substr(Ucfirst(toRupiah($cekdt->kwtbill_pay)),0,86),10,0,'L',0);
	// $pdf->SetXY(30,68);
	// $pdf->Cell(8,5,substr(Ucfirst(toRupiah($cekdt->kwtbill_pay)),86,86).' Rupiah',10,0,'L',0);

	$pdf->Ln(5);
	$pdf->SetXY(30,86);
	$pdf->Cell(8,5,$cekdt->paygroup_nm.' Unit '.$cekdt->unit_no.' dari harga jual Rp '.number_format($cekdt->selling_price),10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,102);
	$pdf->Cell(8,5,$cekdt->kwtbill_remark.'  ',10,0,'L',0);
	$pdf->Cell(164,5,'',10,0,'L',0);
	// $pdf->Ln(5);
	// $pdf->SetXY(30,70);
	// $pdf->Cell(8,5,'',10,0,'L',0);
	// #akhir konsisi data pembayaran
			
	// $pdf->Cell(8,5,'Terbilang '.Ucfirst(toRupiah($cekdt->kwtbill_pay)),10,0,'L',0);
	$pdf->SetXY(10,129);
	$pdf->Cell(20,5,number_format($cekdt->kwtbill_pay),10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(160,126);
	$pdf->Cell(155,5,indo_date($cekdt->kwtbill_paydate),10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(150,145);
	$pdf->Cell(155,5,'Sovialisma. MDS',10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(150,147);
	$pdf->Cell(155,5,'--------------------------------',10,0,'L',0);
	$pdf->SetXY(150,150);
	$pdf->Cell(155,5,'Retail & Strata Dept. Head',10,0,'L',0);			
				
	$pdf->Output("hasil.pdf","I");	
		
	
