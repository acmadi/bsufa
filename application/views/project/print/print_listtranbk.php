<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "Bakri Swasakti Utama";
				$judul 		= "List Transaksi Bank Keluar";
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
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. ' s/d ',20,0,'L');
		
			
			// Start Isi Tabel
			
			$pdf->Ln(10);
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'No. Voucher',1,0,'C',1);
			$pdf->Cell(15,10,'Tanggal',1,0,'C',1);
			$pdf->Cell(20,10,'Vendor',1,0,'C',1);
			$pdf->Cell(80,10,'Uraian',1,0,'C',1);
			$pdf->Cell(20,10,'Profit Center',1,0,'C',1);
			$pdf->Cell(20,10,'Jenis',1,0,'C',1);
			$pdf->Cell(20,10,'No. C/G',1,0,'C',1);
			$pdf->Cell(20,10,'Tgl. Cek/B',1,0,'C',1);
			$pdf->Cell(20,10,'Bank',1,0,'C',1);
			$pdf->Cell(20,10,'Jumlah',1,0,'C',1);
			$pdf->Cell(20,10,'Tgl. bayar',1,0,'C',1);
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 28;	
			$pdf->Ln(10);
			
					
			
	for($i = 1;$i <= 200; $i++){
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "Bakri Swasakti Utama";
				$judul 		= "List Transaksi Bank Keluar";
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
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '. ' s/d ',20,0,'L');
			
			
			$pdf->Ln(10);
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'No. Voucher',1,0,'C',1);
			$pdf->Cell(15,10,'Tanggal',1,0,'C',1);
			$pdf->Cell(20,10,'Vendor',1,0,'C',1);
			$pdf->Cell(80,10,'Uraian',1,0,'C',1);
			$pdf->Cell(20,10,'Profit Center',1,0,'C',1);
			$pdf->Cell(20,10,'Jenis',1,0,'C',1);
			$pdf->Cell(20,10,'No. C/G',1,0,'C',1);
			$pdf->Cell(20,10,'Tgl. Cek/B',1,0,'C',1);
			$pdf->Cell(20,10,'Bank',1,0,'C',1);
			$pdf->Cell(20,10,'Jumlah',1,0,'C',1);
			$pdf->Cell(20,10,'Tgl. bayar',1,0,'C',1);
			
			$pdf->Ln(10);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(20,5,'No. Voucher',1,0,'C',0);
			$pdf->Cell(15,5,'Tanggal',1,0,'C',0);
			$pdf->Cell(20,5,'Vendor',1,0,'L',0);
			$pdf->Cell(80,5,substr($a,0,72),1,0,'L',0);
			$pdf->Cell(20,5,'Profit Center',1,0,'L',0);
			$pdf->Cell(20,5,'Jenis',1,0,'C',0);
			$pdf->Cell(20,5,'No. C/G',1,0,'C',0);
			$pdf->Cell(20,5,'Tgl. Cek/B',1,0,'C',0);
			$pdf->Cell(20,5,'Bank',1,0,'C',0);
			$pdf->Cell(20,5,number_format(1000000000),1,0,'R',0);
			$pdf->Cell(20,5,'Tgl. bayar',1,0,'C',0);
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',6);
	  	
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(80,5,'',10,0,'L',0);
			$pdf->Cell(20,5,' ',10,0,'L',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(40,5,'Total',1,0,'C',1);
			$pdf->Cell(20,5,number_format(1000000000),1,0,'R',1);
			$pdf->Cell(20,5,'',10,0,'C',0);	
		
			$pdf->Output("hasil.pdf","I");	;
	
