<?php
	require('fpdf/classreport.php');
	$pdf=new PDF('P','mm','A4');
	$pdf->SetMargins(10,10,2);
	$pdf->AliasNbPages();	
	$pdf->AddPage();
	$pdf->SetFont('Arial','',8);
			
	$judul = "RECEIPT VOUCHER";
	$nopem = "";
	$tglreceipt = $cekdt->received_date;
	$bank = $cekdt->bank_coa;
	$acctno = '-';
			
	$pdf->SetXY(130,10);
	$pdf->Cell(40,5,'No. Bukti Pembayaran',10,0,'L',0);
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
	$pdf->Cell(8,5,$cekdt->reference,10,0,'L',0);
	$pdf->Cell(164,5,'',10,0,'L',0);
	$pdf->Ln(5);
	$pdf->Cell(8,5,'',10,0,'L',0);
	#akhir konsisi data pembayaran
			
	$pdf->Cell(155,5,'Terbilang '.Ucfirst(toRupiah($cekdt->amount_unidenti)),10,0,'L',0);
	$pdf->Cell(20,5,number_format($cekdt->amount_unidenti),10,0,'L',0);
	$pdf->Ln(10);
	#template tabel
	$pdf->Cell(10,5,'NO',1,0,'C',0);
	$pdf->Cell(50,5,'KODE PERKIRAAN',1,0,'C',0);
	$pdf->Cell(75,5,'NAMA PERKIRAAN',1,0,'C',0);
	$pdf->Cell(30,5,'DEBIT',1,0,'C',0);
	$pdf->Cell(30,5,'KREDIT',1,0,'C',0);
	$pdf->SetXY(10,68);
	/*$pdf->Cell(10,130,'',1,0,'C',0);
	$pdf->Cell(50,130,'',1,0,'C',0);
	$pdf->Cell(75,130,'',1,0,'C',0);
	$pdf->Cell(30,130,'',1,0,'C',0);
	$pdf->Cell(30,130,'',1,0,'C',0);*/
	#akhir template tabel 
			
	#konsisi looping data
	$pdf->SetXY(10,68);
	$no = 0;		
	#$totdebet = 0;
	##$totcredit = 0;
	#foreach($dtmap as $row):
	#$no++;
	#$totdebet = $totdebet + $row->debet;
	#$totcredit = $totcredit + $row->debet;	
		
	$pdf->Cell(10,5,'1',10,0,'C',0);
	$pdf->Cell(50,5,$cekdt->bank_coa,10,0,'L',0);
	$pdf->Cell(75,5,$cekdt->bank_nm,10,0,'L',0);
	$pdf->Cell(30,5,number_format($cekdt->amount_unidenti),10,0,'R',0);
	$pdf->Cell(30,5,'0',10,0,'R',0);
	$pdf->Ln();
	$pdf->Cell(10,5,'2',10,0,'C',0);
	$pdf->Cell(50,5,'2.02.08',10,0,'L',0);
	$pdf->Cell(75,5,'Unidentified',10,0,'L',0);
	$pdf->Cell(30,5,'0',10,0,'R',0);
	$pdf->Cell(30,5,number_format($cekdt->amount_unidenti),10,0,'R',0);
	$pdf->Ln();

	#endforeach;		
			
			
	$pdf->Ln(4);
	#akhir kondisi looping data
			
	#$pdf->Ln();
	#$pdf->Cell(10,5,'',10,0,'C',0);
	#$pdf->Cell(50,5,'',10,0,'C',0);
	$pdf->Cell(195,0,'',1,0,'R',0);
	$pdf->Ln();
	$pdf->Cell(135,5,'TOTAL',10,0,'C',0);
	$pdf->Cell(30,5,number_format($cekdt->amount_unidenti),10,0,'R',0);
	$pdf->Cell(30,5,number_format($cekdt->amount_unidenti),10,0,'R',0);
	$pdf->Ln();
	$pdf->Cell(195,0,'',1,0,'R',0);		
	$pdf->Ln(100);
			
	$pdf->Cell(49,5,'Disetor Oleh',1,0,'C',0);
	$pdf->Cell(49,5,'Diverifikasi',1,0,'C',0);
	$pdf->Cell(49,5,'Diketahui',1,0,'C',0);
	$pdf->Cell(49,5,'Dibukukan',1,0,'C',0);
	$pdf->Ln(5);
		
	$pdf->Cell(49,30,'',1,0,'C',0);
	$pdf->Cell(49,30,'',1,0,'C',0);
	$pdf->Cell(49,30,'',1,0,'C',0);
	$pdf->Cell(49,30,'',1,0,'C',0);
			
			
			
				
	$pdf->Output("hasil.pdf","I");	
		
	
