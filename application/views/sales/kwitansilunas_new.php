<?php
	require('fpdf/classreportkwitansi.php');
	$pdf=new PDF('P','mm','A4');
	$pdf->SetMargins(10,10,0);
	$pdf->AliasNbPages();	
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	$session_id = $this->UserLogin->isLogin();
	$this->pt_id = $session_id['id_pt'];
	$pt = $this->pt_id;
	//var_dump($pt);
			
	$judul = "Kwitansi";
	$nopem = $cekdt->no_sp;
	$tglreceipt = $cekdt->tgl_paydate;
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
	$pdf->SetFont('Arial','',10); 
	//$pdf->Cell(40,5,$judul,10,0,'L',0);
	$pdf->Ln(8);
	$pdf->SetXY(30,30);
	$pdf->SetFont('Arial','',10);
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
	$pdf->Cell(8,5,$cekdt->customer_nama,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,62);
	$pdf->SetFont('Arial','',10); 
	//$pdf->Cell(8,5,Ucfirst(toRupiah($cekdt->selling_price)).' Rupiah',10,0,'L',0);
	$pdf->MultiCell(155,5,ucwords(toRupiah2($cekdt->selling_price)),10,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,78);
	$pdf->SetFont('Arial','',10); 
	
	if ($cekdt->id_subproject=='11203'){
	
	$pdf->Cell(8,5,'Pembelian 1 Unit Office  '.$cekdt->unit_no.'  a/n '.$cekdt->customer_nama,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,93);
	$pdf->Cell(8,5,'Pelunasan Unit Office '.$cekdt->unit_no,10,0,'L',0);
	$pdf->Cell(164,5,'',10,0,'L',0);
     }
     else {
	$pdf->Cell(8,5,'Pembelian 1 Unit Apartement '.$cekdt->unit_no.'  a/n '.$cekdt->customer_nama,10,0,'L',0);
	$pdf->Ln(5);
	$pdf->SetXY(30,93);
	$pdf->Cell(8,5,'Pelunasan Unit Apartement '.$cekdt->unit_no,10,0,'L',0);
	$pdf->Cell(164,5,'',10,0,'L',0);
     }
     
	// $pdf->Ln(5);
	// $pdf->SetXY(30,70);
	// $pdf->Cell(8,5,'',10,0,'L',0);
	// #akhir konsisi data pembayaran
			
	// $pdf->Cell(8,5,'Terbilang '.Ucfirst(toRupiah($cekdt->kwtbill_pay)),10,0,'L',0);
	$pdf->SetXY(10,120);
	$pdf->Cell(20,5,number_format($cekdt->selling_price),10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(160,112);
	$pdf->Cell(155,5,indo_date($cekdt->tgl_paydate),10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(150,145);
	$pdf->Cell(155,5,'Sovialisma. MDS',10,0,'L',0);
	$pdf->Ln(10);
	$pdf->SetXY(150,147);
	$pdf->Cell(155,5,'--------------------------------',10,0,'L',0);
	$pdf->SetXY(150,150);
	$pdf->Cell(155,5,'Retail & Strata Dept. Head',10,0,'L',0);			
			
				
	$pdf->Output("hasil.pdf","I");	
		
	
