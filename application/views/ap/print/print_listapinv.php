<?php

		//doc_no, doc_date, nm_supplier,inv_no, inv_date,due_date,descs, trx_amt, 
		//(trx_amt*10)/100 as PPN, (trx_amt*10)/100 as PPH23
		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			//die($checkbox);
			//die($vendor);
			//$data = $this->db->query("sp_InvoiceAP '".$vendor."','".$project_detail."','".$checkbox."','".inggris_date($startdate)."','".inggris_date($enddate)."'")
			//				 ->result();
			if($vendor==0){
			$data = $this->db->query("select a.pphtb,a.doc_no,a.doc_date,b.nm_supplier,a.inv_no,CASE WHEN a.inv_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.inv_date, 121) END AS inv_date,CASE WHEN a.due_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.due_date, 121) END AS due_date,a.descs,a.base_amt
									from db_apinvoice a 
									join pemasokmaster b on b.kd_supplier = a.vendor_acct")->result();
			}else{
			$data = $this->db->query("select a.pphtb,a.doc_no,a.doc_date,b.nm_supplier,a.inv_no,CASE WHEN a.inv_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.inv_date, 121) END AS inv_date,CASE WHEN a.due_date IS NULL THEN '-' ELSE CONVERT(varchar(50), a.due_date, 121) END AS due_date,a.descs,a.base_amt
									from db_apinvoice a 
									join pemasokmaster b on b.kd_supplier = a.vendor_acct where a.vendor_acct = '$vendor'")->result();
			}
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. BAKRIE SWASAKTI UTAMA";
				$judul 		= "List Invoice AP Vendor";
				$periode	= "As Off";
	
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
				#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,$periode.' : '.$enddate,20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(45,5,'A/P',1,0,'C',1);
			//$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(40,10,'Vendor',1,0,'C',1);
			$pdf->Cell(70,5,'Invoice',1,0,'C',1);
			$pdf->Cell(50,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'PPHTB',1,0,'C',1);
			$pdf->Cell(20,10,'PPN',1,0,'C',1);
			$pdf->Cell(20,10,'PPH 23',1,0,'C',1);
			$pdf->Cell(20,10,'Total',1,0,'C',1);
			
			
			$pdf->Ln(5);
			
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'No.',1,0,'C',1);
			$pdf->Cell(20,5,'Date',1,0,'C',1);
			$pdf->Cell(40,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'No.',1,0,'C',1);
			$pdf->Cell(20,5,'Date.',1,0,'C',1);
			$pdf->Cell(20,5,'Due Date',1,0,'C',1);
			$pdf->Cell(55,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 14;	
			$pdf->Ln(5);
			$tot1 = 0;
			$tot2 = 0;
			$tot3 = 0;
			
			$tot5 = 0;
			$tot6 = 0;
			$tot7 = 0;
			$tot8 = 0;
			
			$totol = 0;
			$tpphtb = 0;	
			
	// for($i = 1;$i <= 200; $i++){
	foreach($data as $row){	
	$tpphtb = $tpphtb+$row->pphtb;
		#$tot1 = 0;
		#$tot2 = 0;
		#$tot3 = 0;
		#$tot4 = 0;
		
		
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "PT. Bakrie Swasakti Utama";
				$judul 		= "List Invoice AP Vendor";
				$periode	= "As Off";
				
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
				$pdf->Cell(0,10,$periode.' : '.$enddate,20,0,'L');
			
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(45,5,'A/P',1,0,'C',1);
			//$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(40,10,'Vendor',1,0,'C',1);
			$pdf->Cell(70,5,'Invoice',1,0,'C',1);
			$pdf->Cell(50,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'DPP',1,0,'C',1);
			$pdf->Cell(20,10,'PPN',1,0,'C',1);
			$pdf->Cell(20,10,'PPH 23',1,0,'C',1);
			$pdf->Cell(20,10,'Total',1,0,'C',1);
			
			
			$pdf->Ln(5);
			
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'No.',1,0,'C',1);
			$pdf->Cell(20,5,'Date',1,0,'C',1);
			$pdf->Cell(40,5,'',10,0,'L',0);
			$pdf->Cell(30,5,'No.',1,0,'C',1);
			$pdf->Cell(20,5,'Date.',1,0,'C',1);
			$pdf->Cell(20,5,'Due Date',1,0,'C',1);
			$pdf->Cell(55,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$pdf->SetFont('Arial','',6);
			//$tot1 = $tot1 + $row->mbase_amt;
			//$tot2 = $tot2 + $row->mtax_amt;
			//$tot3 = $tot3 + $row->mtax_deduct_amt;
			//$tot4 = $tot3 + $tot1;
			
			
					
			
			$pdf->Cell(8,10,$no,1,0,'C',0);
			$pdf->Cell(25,10,$row->doc_no,1,0,'C',0);
			$pdf->Cell(20,10,indo_date($row->doc_date),1,0,'C',0);
			$pdf->Cell(40,10,substr($row->nm_supplier,0,28),1,0,'L',0);
			$y = $pdf->GetY();
			$x = $pdf->GetX();
			$width = 30;
			$pdf->MultiCell($width,5,($row->inv_no),'LRT','C');
			$pdf->SetXY($x + $width, $y);
			//$pdf->Cell(30,10,$row->inv_no,1,0,'C',0);
			$pdf->Cell(20,10,indo_date($row->inv_date),1,0,'C',0);
			$pdf->Cell(20,10,indo_date($row->due_date),1,0,'C',0);
			$y = $pdf->GetY();
			$x = $pdf->GetX();
			$width = 50;
			$pdf->MultiCell($width,5,(substr($row->descs,0,70)),'LRT','L');
			$pdf->SetXY($x + $width, $y);
			//$pdf->Cell(50,10,substr($row->descs,0,40),"L"."R",0,'L',0);
			//$pdf->Cell(20,10,number_format($tot4),1,0,'R',0);
			//$pdf->Cell(20,10,number_format($row->mtax_amt),1,0,'R',0);
			//$pdf->Cell(20,10,number_format($row->mtax_deduct_amt),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->pphtb),1,0,'R',0);
			$pdf->Cell(20,10,'',1,0,'R',0);
			$pdf->Cell(20,10,'',1,0,'R',0);
			
		
			//$pdf->SetX(225);
			//$pdf->Cell(35,5,substr(@$row->bank_nm,26,52),'L'.'R'.'B',0,'L',0);
			 
			//$totel = $row->mbase_amt + $row->mtax_amt - $row->mtax_deduct_amt;
			//$total = ($row->mbase_amt + $row->mtax_deduct_amt) - $row->mtax_deduct_amt ;
			//$totol = $totol + $totel;
			
			$pdf->Cell(20,10,number_format($row->base_amt),1,0,'R',0);
			
				//$pdf->Ln(5);

			//$pdf->SetX(165);
					
			//$pdf->Cell(50,5,substr($row->descs,40,40),'L'.'R'.'B',0,'L',0);
		
			$pdf->Ln(10);
			$pdf->Cell(288,0,'','T',1,'C',0);		
			$tot1 = 0;
			$tot2 = 0;
			$tot3 = 0;
			
			//$tot5 = $tot5 + $tot4;
			//$tot6 = $tot6 + $row->mtax_amt;
			//$tot7 = $tot7 + $row->mtax_deduct_amt;
			$tot8 = $tot8 + $row->base_amt;
			
			$i++;
			$no++;
			$noo++;
		
	}
	
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$pdf->Cell(45,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(50,5,'GRAND TOTAL',1,0,'L',1);
			$pdf->Cell(20,5,number_format($tpphtb),1,0,'R',1);
			$pdf->Cell(20,5,'',1,0,'R',1);
			$pdf->Cell(20,5,'',1,0,'R',1);
			$pdf->Cell(20,5,number_format($tot8),1,0,'R',1);
		
			
			$pdf->SetFont('Arial','B',6);
	  	/*
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'L',0);
			$pdf->Cell(80,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$pdf->Cell(50,5,'Grand Total',1,0,'C',1);
			$pdf->Cell(25,5,number_format(1000000000),1,0,'R',1);
			
		*/
			$pdf->Output("hasil.pdf","I");	;
	
