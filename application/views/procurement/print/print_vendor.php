<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			//die(inggris_date($start_date));
			$pdf=new PDF('P','mm','A4');
			//$sql = $
			
			
			$data = $this->db->query("sp_prreport_vend '".inggris_date($start_date)."','".inggris_date($end_date)."'")
							 ->result();
			
			$pdf->SetMargins(20,0,0,5);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEAD
				
			#HEADER CONTENT
				$judul 		= "VENDOR REPORT";
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
			
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$judul,20,0,'L');
			
				$pdf->SetFont('Arial','',8);
				
			
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,'View Report Vendor',20,0,'L');
				$pdf->Cell(0,10,'Periode'.' : '.$start_date.' s/d '.$end_date,20,0,'L');
				
		
			
			// Start Isi Tabel
			
			$pdf->Ln(15);
							
			$pdf->SetX(5);
			
			
			$pdf->SetFont('Arial','',6);
				
			
			
			$pdf->Ln(4);
			
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(100,5,'VENDOR',1,0,'C',1);
			$pdf->Cell(70,5,'Last PO',1,0,'C',1);
			
			
			
			$pdf->Ln(5);
			
			
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
			$pdf->Cell(8,5,'',0,0,'C',0);
			$pdf->Cell(25,5,'Category',1,0,'C',1);
			$pdf->Cell(25,5,'Code',1,0,'C',1);
			$pdf->Cell(50,5,'Name',1,0,'C',1);
			$pdf->Cell(25,5,'Date',1,0,'C',1);
			$pdf->Cell(25,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Amount',1,0,'C',1);
					
			
			$i = 1;	
			$no = 0;
			$max = 45;	
			//$pdf->AddPage();
			$pdf->Ln(5);	   
			$tot = 0;
			
	foreach($data as $row){
			$tot = $tot + $row->harga_tot;	
		if($no == $max){ 
			$pdf->AddPage();
			//				
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
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$judul,20,0,'L');
			
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);
				$pdf->SetFont('Arial','',8);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,'View Report Vendor',20,0,'L');
				
				$pdf->Cell(0,10,'Periode'.' : '.$start_date.' s/d '.$end_date,20,0,'L');
			
			
			$pdf->Ln(20);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(100,5,'VENDOR',1,0,'C',1);
			$pdf->Cell(70,5,'Last PO',1,0,'C',1);
			
			
			
			$pdf->Ln(5);
			
			
			$pdf->Cell(8,5,'',0,0,'C',0);
			$pdf->Cell(25,5,'Category',1,0,'C',1);
			$pdf->Cell(25,5,'Code',1,0,'C',1);
			$pdf->Cell(50,5,'Name',1,0,'C',1);
			$pdf->Cell(25,5,'Date',1,0,'C',1);
			$pdf->Cell(25,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Amount',1,0,'C',1);
			$pdf->Ln(5);
			$no = 0;
			//$pdf->Ln(5);
			
		}
		//
		
			$tglpo = indo_date($row->tgl_po);
			if($tglpo=='01-01-1970') $tglpo = "-";
			$pdf->SetFont('Arial','',6);
			//$pdf->Ln(5);
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
			$pdf->Cell(8,5,$i,1,0,'C',0);
			$pdf->Cell(25,5,$row->kdkel_usaha,1,0,'C',0);
			$pdf->Cell(25,5,substr($row->nm_supplier,0,3).'-'.$row->kd_supp_gb,1,0,'C',0);
			$pdf->Cell(50,5,substr($row->nm_supplier,0,39),1,0,'L',0);
			$pdf->Cell(25,5,$tglpo,1,0,'C',0);
			$pdf->Cell(25,5,$row->no_po,1,0,'C',0);
			$pdf->Cell(20,5,number_format($row->harga_tot),1,0,'R',0);
			$pdf->Ln(5);				
			$i++;
			$no++;
		
		
	}
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(8,5,'',0,0,'C',0);
			$pdf->Cell(25,5,'',0,0,'C',0);
			$pdf->Cell(25,5,'',0,0,'C',0);
			$pdf->Cell(50,5,'',0,0,'L',0);
			$pdf->Cell(25,5,'',0,0,'C',0);
			$pdf->Cell(25,5,'Total',1,0,'C',0);
			$pdf->Cell(20,5,number_format($tot),1,0,'R',0);

			$pdf->Output("hasil.pdf","I");	;
	
