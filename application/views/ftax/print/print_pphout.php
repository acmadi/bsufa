<?php
#die('tes');
		//doc_no, doc_date, nm_supplier,inv_no, inv_date,due_date,descs, trx_amt, 
		//(trx_amt*10)/100 as PPN, (trx_amt*10)/100 as PPH23
		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			//die($pph."','".$startdate."','".$enddate);
			$data = $this->db->query("sp_pphout '".$pph."','".inggris_date($startdate)."','".inggris_date($enddate)."'")->result();
			
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. Bakrie Swasakti Utama";
				$judul 		= "List PPH Payment";
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
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,$periode.' : '.$startdate. '  To  '.$enddate,20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',6);
			$pdf->Ln(4);
			
			$pdf->Cell(8,6,'NO',1,0,'C',1);
			$pdf->Cell(50,6,'NAMA WP',1,0,'C',1);
			$pdf->Cell(30,6,'NPWP',1,0,'C',1);
			$pdf->Cell(25,6,'DPP',1,0,'C',1);
			$pdf->Cell(25,6,'PPH',1,0,'C',1);
			$pdf->Cell(15,6,'TARIF',1,0,'C',1);
			$pdf->Cell(30,6,'PROJECT',1,0,'C',1);
			$pdf->Cell(60,6,'AP DESC',1,0,'C',1);
			$pdf->Cell(25,6,'TGL AP',1,0,'C',1);
			$pdf->Cell(25,6,'TGL BAYAR',1,0,'C',1);
			
			
			$pdf->Ln(6);
	
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 17;	
			//$pdf->Ln(5);
			$tot = 0;
					
			
	// for($i = 1;$i <= 200; $i++){
	foreach($data as $row){	
		$tot = $tot + $row->base_amt;
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$$pt		= "PT. Bakrie Swasakti Utama";
				$judul 		= "List PPH Payment";
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
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
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
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(6);
			$pdf->Cell(8,6,'NO',1,0,'C',1);
			$pdf->Cell(50,6,'NAMA WP',1,0,'C',1);
			$pdf->Cell(30,6,'NPWP',1,0,'C',1);
			$pdf->Cell(25,6,'DPP',1,0,'C',1);
			$pdf->Cell(25,6,'PPH',1,0,'C',1);
			$pdf->Cell(15,6,'TARIF',1,0,'C',1);
			$pdf->Cell(30,6,'PROJECT',1,0,'C',1);
			$pdf->Cell(60,6,'AP DESC',1,0,'C',1);
			$pdf->Cell(25,6,'TGL AP',1,0,'C',1);
			$pdf->Cell(25,6,'TGL BAYAR',1,0,'C',1);
			
			$pdf->Ln(6);
			
			$pdf->Cell(8,5,'',10,0,'C',0);
			//$pdf->Cell(20,5,'No.',1,0,'C',1);
			//$pdf->Cell(20,5,'Date',1,0,'C',1);
			$pdf->Cell(55,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'No.',1,0,'C',1);
			$pdf->Cell(20,5,'Date',1,0,'C',1);
			$pdf->Cell(85,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'(Incl PPN)',1,0,'C',1);
			$pdf->Cell(35,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'',10,0,'C',0);
			$noo = 0;
			$pdf->Ln(5);
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			// $pdf->SetFont('Arial','',6);
			// $pdf->Cell(8,5,'',1,0,'C',0);
			// $pdf->Cell(25,5,'No.',1,0,'C',0);
			// $pdf->Cell(25,5,'Date',1,0,'C',0);
			// $pdf->Cell(45,5,'',1,0,'L',0);
			// $pdf->Cell(25,5,'No.',1,0,'C',0);
			// $pdf->Cell(25,5,'Date.',1,0,'C',0);
			// $pdf->Cell(65,5,'',1,0,'C',0);
			// $pdf->Cell(25,5,'',1,0,'C',0);
			// $pdf->Cell(25,5,'',1,0,'C',0);
			// $pdf->Cell(25,5,'',1,0,'C',0);
			$pdf->Cell(8,6,$no,1,0,'C',0);
			$pdf->Cell(50,6,$row->nm_supplier,1,0,'L',0);
			$pdf->Cell(30,6,$row->npwp,1,0,'C',0);
			$pdf->Cell(25,6,number_format($row->base_amt),1,0,'R',0);
			$pph = $this->db->query("select debet from db_apinvoiceoth where acc_name like '%pph%' and doc_no = '".$row->doc_no."'")->row();
			$pdf->Cell(25,6,'',1,0,'C',0);
			$pdf->Cell(15,6,$row->percent_pph,1,0,'C',0);
			$pdf->Cell(30,6,substr($row->nm_project,0,23),1,0,'L',0);
			$pdf->Cell(60,6,$row->doc_no.' | '.substr($row->descs,0,25),1,0,'L',0);
			$pdf->Cell(25,6,indo_date($row->doc_date),1,0,'C',0);
			$pdf->Cell(25,6,indo_date($row->payment_date),1,0,'C',0);
			/*$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,8,$no,1,0,'C',0);
			//$pdf->Cell(20,8,$row->voucher,1,0,'L',0);
			//$pdf->Cell(20,8,$row->trans_date,1,0,'L',0);
			$pdf->Cell(55,8,$row->nm_supplier,1,0,'L',0);
			$pdf->Cell(20,8,$row->doc_no,1,0,'L',0);
			$pdf->Cell(20,8,indo_date($row->doc_date),1,0,'L',0);
			$pdf->Cell(85,4,substr($row->descs,0,58),"L"."R",0,'L',0);
			$pdf->Cell(25,8,number_format($row->base_amt),1,0,'R',0);
			$pdf->Cell(35,6,'',"L"."R",0,'L',0);
			$pdf->Cell(25,8,'',1,0,'C',0);*/
			
			$pdf->Ln(6);

			/*$pdf->SetX(105);
					
			$pdf->Cell(85,5,substr(@$row->descs,58,58),'L'.'R'.'B',0,'L',0);
			$pdf->SetX(215);
			$pdf->Cell(35,5,'','L'.'R'.'B',0,'L',0);
		
			$pdf->Ln(5);*/		
			$i++;
			$no++;
			$noo++;
		
	}
			/*$pdf->Cell(8,5,'',10,0,'C',0);
			//$pdf->Cell(20,5,'',10,0,'C',0);
			//$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(55,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			$pdf->Cell(85,5,'GRAND TOTAL',1,0,'C',1);
			$pdf->Cell(25,5,number_format($tot),1,0,'R',1);
			$pdf->Cell(35,5,'',10,0,'C',0);
			$pdf->Cell(25,5,'',10,0,'C',0);*/
			
			$pdf->SetFont('Arial','B',6);
	  	
			
			
		
			$pdf->Output("hasil.pdf","I");	;
	
