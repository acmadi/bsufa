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
			
	$judul = "RECEIPT VOUCHER";
	$nopem = $cekdt->kwtbill_no;
	$tglreceipt = $cekdt->kwtbill_paydate;
	$bank = $cekdt->bank_nm;
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
	$pdf->Cell(8,5,'Pembayaran '.$cekdt->paygroup_nm.' '.$cekdt->customer_nama.' Unit '.$cekdt->unit_no.'--'.$cekdt->kwtbill_descs,10,0,'L',0);
	$pdf->Cell(164,5,'',10,0,'L',0);
	$pdf->Ln(5);
	$pdf->Cell(8,5,'',10,0,'L',0);
	#akhir konsisi data pembayaran
			
	$pdf->Cell(155,5,'Terbilang '.Ucfirst(toRupiah($cekdt->kwtbill_pay)),10,0,'L',0);
	$pdf->Cell(20,5,number_format($cekdt->kwtbill_pay),10,0,'L',0);
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
	$totdebet = 0;
	$totcredit = 0;
	//var_dump($dtmap->umasuk);
	
	
	foreach($dtmap as $row):
		$no++;
		
		
		
		
		if($pt==44 || $pt==66){
		$totdebet = $totdebet + $row->debet;
		$totcredit = $totcredit + $row->debet;	
		
		$pdf->Cell(10,5,$no,10,0,'C',0);
		$pdf->Cell(50,5,$row->acc_coa,10,0,'L',0);
		$pdf->Cell(75,5,$row->remark,10,0,'L',0);
		$pdf->Cell(30,5,number_format($row->debet),10,0,'R',0);
		$pdf->Cell(30,5,number_format($row->credit),10,0,'R',0);
		$pdf->Ln();
		}else{
		$totdebet = $totdebet + $row->UMasuk;
		$totcredit = $totcredit + $row->UMasuk;	
		
		$sql = "SELECT * FROM db_coagabung WHERE kodeacc = '".$row->kodeacc."' and id_pt=$pt";
		$roww = $this->db->query($sql)->row();
		
		$pdf->Cell(10,5,$no,10,0,'C',0);
		$pdf->Cell(50,5,@$row->kodeacc,10,0,'L',0);
		$pdf->Cell(75,5,@$roww->accname,10,0,'L',0);
		$pdf->Cell(30,5,number_format(@$row->UMasuk),10,0,'R',0);
		$pdf->Cell(30,5,number_format(@$row->UKeluar),10,0,'R',0);
		$pdf->Ln();
		
		}
	endforeach;		
			
			
	$pdf->Ln(4);
	#akhir kondisi looping data
			
	#$pdf->Ln();
	#$pdf->Cell(10,5,'',10,0,'C',0);
	#$pdf->Cell(50,5,'',10,0,'C',0);
	$pdf->Cell(195,0,'',1,0,'R',0);
	$pdf->Ln();
	$pdf->Cell(135,5,'TOTAL',10,0,'C',0);
	$pdf->Cell(30,5,number_format($totdebet),10,0,'R',0);
	$pdf->Cell(30,5,number_format($totcredit),10,0,'R',0);
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
		
	
