<?php

		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			$data = $this->db->query("sp_paymentAR '".inggris_date($startdate)."','".inggris_date($enddate)."','".$project_detail."'")
							 ->result();
			
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "Graha Multi Insani";
				$judul 		= "Payment Receipt A/R";
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
				$pdf->Cell(0,10,$periode.' : '.$startdate. '  To  '.$enddate,20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'Tanggal',1,0,'C',1);
			$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(40,10,'Customer',1,0,'C',1);
			$pdf->Cell(80,10,'Keterangan',1,0,'C',1);
			$pdf->Cell(25,10,'Kode Byr',1,0,'C',1);
			$pdf->Cell(25,10,'Jns Byr',1,0,'C',1);
			$pdf->Cell(25,10,'Tgl. Giro / Cek',1,0,'C',1);
			$pdf->Cell(25,10,'No. Cek',1,0,'C',1);
			$pdf->Cell(25,10,'Nilay bayar',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 28;	
			$pdf->Ln(10);
			$b=0;
					
			
	// for($i = 1;$i <= 200; $i++){
		foreach($data as $row){	
		$b = $b + $row->kwtbill_pay;
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "Graha Multi Insani";
				$judul 		= "Payment Receipt A/R";
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
				#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,$periode.' : '.$startdate. '  To  '.$enddate.' : '. ' s/d ',20,0,'L');
			
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(20,10,'Tanggal',1,0,'C',1);
			$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(40,10,'Customer',1,0,'C',1);
			$pdf->Cell(80,10,'Keterangan',1,0,'C',1);
			$pdf->Cell(25,10,'Kode Byr',1,0,'C',1);
			$pdf->Cell(25,10,'Jns Byr',1,0,'C',1);
			$pdf->Cell(25,10,'Tgl. Giro / Cek',1,0,'C',1);
			$pdf->Cell(25,10,'No. Cek',1,0,'C',1);
			$pdf->Cell(25,10,'Nilai bayar',1,0,'C',1);
			
			$pdf->Ln(10);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(20,5,$row->date_jurnal,1,0,'C',0);
			$pdf->Cell(15,5,$row->id_unit,1,0,'C',0);
			$pdf->Cell(40,5,$row->customer_nama,1,0,'L',0);
			$pdf->Cell(80,5,substr($row->kwtbill_remark,0,72),1,0,'L',0);
			$pdf->Cell(25,5,$row->kwtbill_nm,1,0,'L',0);
			$pdf->Cell(25,5,$row->paytipe_nm,1,0,'C',0);
			$pdf->Cell(25,5,$row->coa_desc,1,0,'C',0);
			$pdf->Cell(25,5,$row->coa_desc,1,0,'C',0);
			$pdf->Cell(25,5,number_format($row->kwtbill_pay),1,0,'R',0);
		
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',6);
	  	
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'L',0);
			$pdf->Cell(80,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$pdf->Cell(50,5,'Grand Total',1,0,'C',1);
			$pdf->Cell(25,5,number_format($b),1,0,'R',1);
			
		
			$pdf->Output("hasil.pdf","I");	;
	
