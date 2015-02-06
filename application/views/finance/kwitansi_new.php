<?php
	require('fpdf/classreport.php');
	$pdf=new PDF('P','mm','A4');
	$pdf->SetMargins(10,10,2);
	$pdf->AliasNbPages();	
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$session_id = $this->UserLogin->isLogin();
	$this->pt_id = $session_id['id_pt'];
	$pt = $this->pt_id;
	//var_dump($pt);
			
	$judul = "Kwitansi";
	$nopem = $nomor;
	$tglreceipt = $tgl;
	//$bank = $cekdt->bank_nm;
	$acctno = '-';
			
	$pdf->SetXY(115,25);
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
	$pdf->SetXY(30,47);
	$pdf->Cell(8,5,$tdari,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,62);
	$pdf->Cell(8,5,ucwords($outnominal).' Rupiah',10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,78);
	$pdf->Cell(8,5,$untuk,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,93);
	$pdf->Cell(8,5,$ket1,10,0,'L',0);
	$pdf->SetXY(30,101);
	$pdf->Cell(8,5,$ket2,10,0,'L',0);
	$pdf->SetXY(30,109);
	$pdf->Cell(8,5,$ket3,10,0,'L',0);
	$pdf->Cell(164,5,'',10,0,'L',0);
	// $pdf->Ln(5);
	// $pdf->SetXY(30,70);
	// $pdf->Cell(8,5,'',10,0,'L',0);
	// #akhir konsisi data pembayaran
			
	// $pdf->Cell(8,5,'Terbilang '.Ucfirst(toRupiah($cekdt->kwtbill_pay)),10,0,'L',0);
	$pdf->SetXY(10,120);
	$pdf->Cell(20,5,number_format($jumlah),10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(160,112);
	$pdf->Cell(155,5,indo_date($tgl),10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(150,145);
	$pdf->Cell(155,5,'Sovialisma. MDS',10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(150,147);
	$pdf->Cell(155,5,'--------------------------------',10,0,'L',0);
	$pdf->SetXY(150,150);
	$pdf->Cell(155,5,'Retail & Strata Dept. Head',10,0,'L',0);
	
			
			
			
				
	$pdf->Output("hasil.pdf","I");	
		
	
