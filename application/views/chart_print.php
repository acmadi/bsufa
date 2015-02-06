<?php
require_once("fpdf/classreport.php"); 
$pdf=new PDF('L','mm','A4');
$pdf->SetMargins(2,10,2);
$pdf->AliasNbPages();
$pdf->AddPage();

			
#Grafik Line
$pdf->SetXY(10,30);
$pdf->Image(site_url().'template/lat.png',10,20,100);
$pdf->Ln();	
$pdf->Output("hasil.pdf","I");	
