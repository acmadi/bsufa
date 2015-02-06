<?php

require('fpdf/tanpapage.php');
$pdf=new PDF('P','mm','A4');

$pdf->SetMargins(8,5,10);
$pdf->AliasNbPages();	
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->setFillColor(222,222,222);

$periode	= "Periode";
	
#CETAK TANGGAL
	$tglcetak  = date("d-m-Y");
#TANGGAL CETAK
	$pdf->SetFont('Arial','',6);
	$pdf->SetXY(258,10);
	$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				
	$pdf->SetXY(268,10);
	$pdf->Cell(2,4,':',4,0,'L');
					
	$pdf->SetXY(269,10);
	$pdf->Cell(10,4,'',0,0,'L');

#Header
	#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',18);
	$pt = "PT. Bakrie Swasakti Utama";
	$pdf->SetX(25);
	$pdf->Cell(0,10,$pt,20,0,'L');

	$pdf->SetFont('Arial','B',12);
	
	$pdf->SetXY(25,16);
	$pdf->Cell(10,5,@$judul,0,0,'L');
	$pdf->SetFont('Arial','B',11);
	$pdf->Ln(5);
	$pdf->Cell(40,5,'Aset',0,0,'L');
	$pdf->Cell(10,5,':',0,0,'L');
	if ($all == 1) {
		$pdf->Cell(0,5,'ALL',0,0,'L');
	} else {
		$pdf->Cell(0,5,'Masing',0,0,'L');
	}
	$pdf->Ln(5);
	$pdf->Cell(40,5,'As Off',0,0,'L');
	$pdf->Cell(10,5,':',0,0,'L');
	$pdf->Cell(0,5,'...',0,0,'L');
	
	$pdf->Ln(10);
	$pdf->Cell(0,0,'',1,0,'L');

	$pdf->Ln(5);
	$pdf->Cell(0,0,'Daftar Pemindahan Aset',0,0,'L');

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',9,'B');
	$pdf->Cell(8,5,'No',1,0,'C',0);
	$pdf->Cell(30,5,'Kode Aset',1,0,'C',0);
	$pdf->Cell(40,5,'Nama Aset',1,0,'C',0);
	$pdf->Cell(30,5,'Pemindahan',1,0,'C',0);
	$pdf->Cell(25,5,'Dari',1,0,'C',0);
	$pdf->Cell(25,5,'Menuju',1,0,'C',0);
	$pdf->Cell(15,5,'Kategori',1,0,'C',0);
	$pdf->Cell(25,5,'Nilai Saat Ini',1,0,'C',0);

	$pdf->Ln(5);
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(8,5,'','L'.'B',0,'C',0);
	$pdf->Cell(30,5,'','L'.'B',0,'C',0);
	$pdf->Cell(40,5,'','L'.'B',0,'C',0);
	$pdf->Cell(30,5,'','L'.'B',0,'C',0);
	$pdf->Cell(25,5,'','L'.'B',0,'C',0);
	$pdf->Cell(25,5,'','L'.'B',0,'C',0);
	$pdf->Cell(15,5,'','L'.'B',0,'C',0);
	$pdf->Cell(25,5,'','L'.'B'.'R',0,'C',0);


	

$pdf->Output("TRACK_ASET.pdf","I");

?>