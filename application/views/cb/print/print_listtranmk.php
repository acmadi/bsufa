<?php

		
			require('fpdf/tanpapage.php');
			#extract(PopulateForm());
				$pdf=new PDF('L','mm','A4');
			
					#$startdate = in 'BK','11202','2015-01-01','2015-02-17',0
				#die($trx."','".$project_detail."','".inggris_date($startdate)."','".inggris_date($enddate).","."$bank");
				#die($bank);
				//die("sp_listtranmk '".$trx."','".$project_detail."','".inggris_date($startdate)."','".inggris_date($enddate)."',".$bank);
				$yu = "sp_listtranmk '".$trx."','".$project_detail."','".inggris_date($startdate)."','".inggris_date($enddate)."',".$bank;

				#die($yu);

				$data = $this->db->query($yu)->result();
					#$data = $this->db->query("sp_listtranmk 'BK','11202','2015-01-01','2015-02-17',0")->result();		 
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT BAKRIE SWASAKTI UTAMA";
				$judul1 		= "List Bank In";
				$judul2 		= "List Bank Out";
				$judul3 		= "List Transaksi Bank Transit";
				$judul4 		= "List Transaksi Bank All";
				
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl,0,0,'L');
			
			#Header
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				//~ die($trx);
				//~ extract(PopulateForm());
				
				if($trx == 'BM'){
					$pdf->Cell(0,10,$judul1,20,0,'L');
					}
				
				else{
					$pdf->Cell(0,10,$judul2,20,0,'L');
					}
					/*
				elseif($trx == 'DF'){
					$pdf->Cell(0,10,$judul3,20,0,'L');}
					
				elseif($trx == '1'){
					$pdf->Cell(0,10,$judul4,20,0,'L');}
				*/
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,$periode.' : '.$startdate. '  To  '.$enddate,20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');	
								
			
			// Start Isi Tabel
			
			$pdf->Ln(6);
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'No. Voucher',1,0,'C',1);
			$pdf->Cell(15,10,'Date',1,0,'C',1);
			
			if($trx == 'BM'){
				$pdf->Cell(60,10,'Receive From',1,0,'C',1);
			}else{
				$pdf->Cell(60,10,'Paid To',1,0,'C',1);
			}
			$pdf->Cell(80,10,'Description',1,0,'C',1);
			#if($trx=='BM'){
			#	$pdf->Cell(20,10,'Profit Center',1,0,'C',1);}
			#else{
			#	$pdf->Cell(20,10,'Cost Center',1,0,'C',1);}
			$pdf->Cell(10,10,'Type',1,0,'C',1);
			$pdf->Cell(10,10,'Status',1,0,'C',1);
			$pdf->Cell(20,10,'No. C/G',1,0,'C',1);
			#$pdf->Cell(20,10,'Tgl. Cek/B',1,0,'C',1);
			$pdf->Cell(30,10,'Bank',1,0,'C',1);
			$pdf->Cell(20,10,'Amount',1,0,'C',1);
			$pdf->Cell(20,10,'Paydate',1,0,'C',1);
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 11;	
			$pdf->Ln(10);
			$tot = 0;
					
			
	//for($i = 1;$i <= 200; $i++){
	foreach($data as $row){	
	$tot = $tot + $row->amount;
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt				= "PT BAKRIE SWASAKTI UTAMA";
				$judul1 		= "List Bank In";
				$judul2 		= "List Bank Out";
				$judul3 		= "List Transaksi Bank Transit";
				$judul4 		= "List Transaksi Bank All";
				$periode		= "Periode";
	
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl,0,0,'L');
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				if($trx =='BM'){
					$pdf->Cell(0,10,$judul1,20,0,'L');}
				
				else{
					$pdf->Cell(0,10,$judul2,20,0,'L');}
					/*
				elseif($trx =='DF'){
					$pdf->Cell(0,10,$judul3,20,0,'L');}
					
				elseif($trx =='1'){
					$pdf->Cell(0,10,$judul4,20,0,'L');}
					*/
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,$periode.' : '.$startdate. '  To  '.$enddate,20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');	
								
			
			$pdf->Ln(6);
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'No. Voucher',1,0,'C',1);
			$pdf->Cell(15,10,'Date',1,0,'C',1);
			
			if($trx == 'BM'){
			$pdf->Cell(60,10,'Receive From',1,0,'C',1);
			}else{
			$pdf->Cell(60,10,'Paid To',1,0,'C',1);
			}
			
			$pdf->Cell(80,10,'Description',1,0,'C',1);
			#if($trx=='BM'){
			#	$pdf->Cell(20,10,'Profit Center',1,0,'C',1);}
			#else{
			#	$pdf->Cell(20,10,'Cost Center',1,0,'C',1);}
			$pdf->Cell(10,10,'Type',1,0,'C',1);
			$pdf->Cell(10,10,'Status',1,0,'C',1);
			$pdf->Cell(20,10,'No. C/G',1,0,'C',1);
			#$pdf->Cell(20,10,'Tgl. Cek/B',1,0,'C',1);
			$pdf->Cell(30,10,'Bank',1,0,'C',1);
			$pdf->Cell(20,10,'Amount',1,0,'C',1);
			$pdf->Cell(20,10,'Paydate',1,0,'C',1);
			
			$pdf->Ln(10);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
	
			if ($row->status == 3){			
			$status='R';
			}else{
			$status='-';
			}
	
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,12,$no,1,0,'C',0);
			$pdf->Cell(20,12,$row->voucher,1,0,'L',0);
			$pdf->Cell(15,12,indo_date($row->trans_date),1,0,'L',0);
			$pdf->Cell(60,12,$row->nm_supplier,1,0,'L',0);
			$pdf->Cell(80,4,substr($row->descs,0,72),"L"."R",0,'L',0);
			#$pdf->Cell(20,5,$row->from,1,0,'L',0);
			$pdf->Cell(10,12,$row->paidby,1,0,'C',0);
			$pdf->Cell(10,12,$status,1,0,'C',0);
			$pdf->Cell(20,12,$row->slipno,1,0,'L',0);
			#$pdf->Cell(20,5,indo_date($row->slip_date),1,0,'L',0);
			$pdf->Cell(30,6,substr($row->acc_name,0,26),"L"."R",0,'L',0);
			$pdf->Cell(20,12,number_format($row->amount),1,0,'R',0);
			$pdf->Cell(20,12,indo_date($row->payment_date),1,0,'C',0);
			
			$pdf->Ln(3);

			$pdf->SetX(105);
					
			$pdf->Cell(80,4,substr(@$row->descs,72,72),'L'.'R',0,'L',0);
			$pdf->SetX(225);
			$pdf->Cell(30,9,substr(@$row->acc_name,26,52),'L'.'R'.'B',0,'L',0);
			
			$pdf->Ln(4);
			$pdf->SetX(105);
					
			$pdf->Cell(80,5,substr(@$row->descs,144,72),'L'.'R'.'B',0,'L',0);
			
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',6);
	  	
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(15,5,'',10,0,'L',0);
			$pdf->Cell(60,5,'',10,0,'L',0);
			$pdf->Cell(80,5,'',10,0,'L',0);
			#$pdf->Cell(20,5,$row->from,1,0,'L',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			#$pdf->Cell(20,5,indo_date($row->slip_date),1,0,'L',0);
			$pdf->Cell(30,5,'TOTAL',1,0,'L',0);
			$pdf->Cell(20,5,number_format($tot),1,0,'R',0);
			//$pdf->Cell(20,5,$trx,10,0,'C',0);
		
			$pdf->Output("BankTransaction.pdf","I");	;
	
