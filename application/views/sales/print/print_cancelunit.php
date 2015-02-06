<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			
			$data = $this->db->query("sp_cancelunit '".$tgl1."','".$tgl2."'")->result();
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "Bakrie Swasakti Utama";
				$judul 		= "Cancel Unit Report";
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
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '.indo_date($tgl1). ' s/d '.indo_date($tgl2),20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
			
			// Start Isi Tabel
			
		
		
			$pdf->SetFont('Arial','B',7);
			$pdf->Ln(4);
			
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Cancel Date',1,0,'C',1);
			$pdf->Cell(20,5,'Sales Date',1,0,'C',1);
			$pdf->Cell(30,5,'Unit No',1,0,'C',1);
			$pdf->Cell(55,5,'Project',1,0,'C',1);
			$pdf->Cell(20,5,'Selling Price',1,0,'C',1);
			$pdf->Cell(20,5,'Payment',1,0,'C',1);
			$pdf->Cell(20,5,'Remark',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 45;	
			$pdf->Ln(5);
			
			$que = "select claim_date, claim_no, nama, petty_desc, db_pettyclaim.debet, db_pettyclaim.credit, saldo 
					from db_pettyclaim 
					inner join cashflow on kodecash=acc_no
					where claim_date between '".inggris_date($tgl1)."' and '".inggris_date($tgl2)."'  order by pettycash_id";
			$query = $this->db->query($que)->result();		
	
	foreach($data as $row){
	#for($i = 1;$i <= 200; $i++){
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "Bakrie Swasakti Utama";
				$judul 		= "Cancel Unit Report";
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
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'As Of'.' : '.indo_date($tgl1). ' s/d '.indo_date($tgl2),20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
		
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Cancel Date',1,0,'C',1);
			$pdf->Cell(20,5,'Sales Date',1,0,'C',1);
			$pdf->Cell(30,5,'Unit No',1,0,'C',1);
			$pdf->Cell(55,5,'Project',1,0,'C',1);
			$pdf->Cell(20,5,'Selling Price',1,0,'C',1);
			$pdf->Cell(20,5,'Payment',1,0,'C',1);
			$pdf->Cell(20,5,'Remark',1,0,'C',1);
		
			
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(20,5,indo_date($row->cancel_date),1,0,'C',0);
			$pdf->Cell(20,5,indo_date($row->sales_date),1,0,'C',0);
			$pdf->Cell(30,5,$row->unit_no,1,0,'L',0);
			$pdf->Cell(55,5,$row->nm_subproject,1,0,'L',0);
			$pdf->Cell(20,5,number_format($row->sell_price),1,0,'R',0);
			$pdf->Cell(20,5,number_format($row->payment),1,0,'R',0);
			$pdf->Cell(20,5,'',1,0,'R',0);
			
		
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',6);
	  	
			//~ //$pdf->Cell(8,5,$no,1,0,'C',0);
			//~ $pdf->Cell(73,5,'GRAND TOTAL',1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'L',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'R',1);
		//~ $pdf->Ln(10);
		
		$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");	;
	
