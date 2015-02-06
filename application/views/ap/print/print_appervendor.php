<?php
		
		//doc_no, doc_date, nm_supplier,inv_no, inv_date,due_date,descs, trx_amt, 
		//(trx_amt*10)/100 as PPN, (trx_amt*10)/100 as PPH23
		//die('a');
			ini_set('memory_limit','512M');
			require('fpdf/classreport.php');
			extract(PopulateForm());
	
			if($project==0){
			$oo = $this->db->query("select a.vendor_acct,b.nm_supplier from db_apinvoice a 
			join pemasokmaster b on a.vendor_acct = b.kd_supplier
			where a.due_date >= '".inggris_date($startdate)."' and due_date <= '".inggris_date($enddate)."'
			group by a.vendor_acct,b.nm_supplier");
			}else{
			$oo = $this->db->query("select a.vendor_acct,b.nm_supplier from db_apinvoice a 
			join pemasokmaster b on a.vendor_acct = b.kd_supplier
			where (a.due_date >= '".inggris_date($startdate)."' and due_date <= '".inggris_date($enddate)."') and a.project_no = '$project'
			group by a.vendor_acct,b.nm_supplier");
			}
			$dd = $oo->result();
			
			//var_dump($dd);exit;
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(5,10,3);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pts		= "PT. Bakrie Swasakti Utama";
				$judul 		= "List AP Per Vendor";
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
				$pdf->Cell(10,4,date('m-d-Y'),0,0,'L');
			
			#Header
				//$pdf->Image(site_url().'assets/img/eastonpark.png',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pts,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Ass Off : '.$enddate,20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(30,10,'A/P',1,0,'C',1);
			$pdf->Cell(30,10,'Vendor',1,0,'C',1);
			$pdf->Cell(30,10,'Date',1,0,'C',1);
			$pdf->Cell(150,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'Amount',1,0,'C',1);
			$pdf->Cell(20,10,'Amount',1,0,'C',1);
						
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',6);
			
			$pdf->Cell(8,10,'','L'.'B',0,'C',0);
			$pdf->Cell(30,10,'','B'.'R',0,'C',0);
			$pdf->Cell(30,10,'','B'.'R',0,'C',0);
			$pdf->Cell(30,10,'','B'.'R',0,'L',0);
			$pdf->Cell(150,10,'','B'.'R',0,'L',0);
			$pdf->Cell(20,10,'','B'.'R',0,'R',0);
			$pdf->Cell(20,10,'','B'.'R',0,'R',0);

			$pdf->Ln(5);
			$no = 1;
			$tsa = 0;
			foreach($dd as $rowk){
			$pdf->Cell(288,5,$rowk->nm_supplier,1,0,'C',1);
			$pdf->Ln(5);
	
			
			$cb = $this->db->query("select * from db_apinvoice where vendor_acct = '".$rowk->vendor_acct."' and (due_date >= '".inggris_date($startdate)."' and due_date <= '".inggris_date($enddate)."')")->result();
			$nos = 1;
			$ta = 0;
			if(!empty($cb)){
			foreach($cb as $row){
			$pdf->Cell(8,10,$nos,1,0,'C',0);
			$pdf->Cell(30,10,$row->doc_no,1,0,'C',0);
			$pdf->Cell(30,10,substr($rowk->nm_supplier,0,21),1,0,'L',0);
			$pdf->Cell(30,10,indo_date($row->due_date),1,0,'C',0);
			$y = $pdf->GetY();
			$x = $pdf->GetX();
			$width = 150;
		
			#$pdf->Cell(40,50, 'quantity', 1, 0, "l");


			$pdf->MultiCell($width,5,($row->descs),'LRT','L');
			$pdf->SetXY($x + $width, $y);
			//$pdf->MultiCell(,5,$row->descs,1,'L');
			
			$pdf->Cell(20,10,number_format($row->base_amt),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->base_amt),1,0,'R',0);
			$pdf->Ln(10);
			$pdf->Cell(288,0,'','T',1,'C',0);
			
			$nos++; 
			$ta = $ta+$row->base_amt;
			}
			$pdf->Cell(8,5,'',1,0,'C',0);
			$pdf->Cell(155,5,'',1,0,'C',0);
			$pdf->Cell(105,5,'SUB TOTAL',1,0,'L',1);
			$pdf->Cell(20,5,number_format($ta),1,0,'R',1);
			$pdf->Ln(5);
			}
			$tsa = $tsa+$ta;
			}
			$pdf->Cell(8,10,'',10,0,'C',0);
			$pdf->Cell(25,10,'',10,0,'C',0);
			$pdf->Cell(25,10,'',10,0,'C',0);
			$pdf->Cell(45,10,'',10,0,'L',0);
			$pdf->Cell(20,10,'',10,0,'C',0);
			$pdf->Cell(20,10,'',10,0,'C',0);
			$pdf->Cell(20,10,'',10,0,'C',0);
			$pdf->Cell(105,10,'GRAND TOTAL',1,0,'L',1);
			$pdf->Cell(20,10,number_format($tsa),1,0,'R',1);
		
			
			$pdf->SetFont('Arial','B',6);
			$pdf->Output("hasil.pdf","I");	;
	
