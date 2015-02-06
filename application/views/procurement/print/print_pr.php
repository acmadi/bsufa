<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			include_once( APPPATH."libraries/translate_currency.php"); 
	
			$rows = $this->db->query("sp_printpr '".$id."'")->row();
//var_dump($rows);exit();			
			
			$pdf->SetMargins(27,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			#HEAD
			#HEADER CONTENT
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				
			#CETAK TANGGAL
				#$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				
			#	$pdf->Cell(10,4,$tgl,0,0,'L');
			
				#Header
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetX(25);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(130,5,'PT. GRAHA MULTI INSANI',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(10,5,'No. PR',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,$rows->no_pr,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Komplek Apartemen Taman Rasuna',10,0,'L');
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',6);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jl. HR. Rasuna Said - Kuningan',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,' ',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jakarta Selatan (12960)',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Telp : (021) 830-5011 Fax : (021) 830-5012',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'NPWP : 021.672.152.2-011.00',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
				
			
			$pdf->Ln(13);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetX(25);
			$pdf->Cell(130,5,'PURCHASE REQUISITION',10,0,'L');
			$pdf->Ln(10);
			
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(80,5,'Request',10,0,'L');
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',6);
			
			$pdf->Cell(20,5,'Transaction Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,indo_date($rows->tgl_pr),10,0,'L');
			$pdf->Cell(15,4,'',10,0,'C');
			$pdf->Cell(15,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Cell(20,5,'Approval Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,indo_date($rows->tgl_aproval),10,0,'L');
			$pdf->Cell(15,4,'',10,0,'C');
			$pdf->Cell(15,5,' ',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Cell(20,5,'Requestor ',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,$rows->req_pr,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Cell(20,5,'Divisi',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(40,5,$rows->divisi_nm,10,0,'L');
			$pdf->Cell(50,4,'',10,0,'C');
		
			
			#start Tabel
			$pdf->Ln(8);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(10,8,'No',1,0,'C',1);
			$pdf->Cell(20,8,'Qty',1,0,'C',1);
			$pdf->Cell(20,8,'Unit',1,0,'C',1);
			$pdf->Cell(60,8,'Description',1,0,'C',1);
			$pdf->Cell(40,8,'Vendor Recomended',1,0,'C',1);
			
			$pdf->Ln(8);
			
			
		
			$i = 1;
			$no = 1;
			$max = 1;
			
			
			$i = 1;	
			$no = 0;
			$max = 45;	
		
			
			$tot = 0;
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
			//$pdf->Cell(8,5,'',1,0,'C',0);
			
			$dt = $this->db->join('db_prorder b','b.no_pr = a.no_pr','left')
						->join('db_divisi c', 'c.divisi_id = a.div_pr')
						   ->where('a.id_pr',$rows->id_pr)
						    ->get('db_pr a')->result();
			
			//var_dump($dt);			
	foreach($dt as $row){
			
		if($no == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$judul 		= "OUTSTANDING PO REPORT";
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
			$pdf->SetX(25);
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(130,5,'PT. GRAHA MULTI INSANI',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(10,5,'No. PR',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,$rows->no_pr,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Komplek Apartemen Taman Rasuna',10,0,'L');
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',6);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jl. HR. Rasuna Said - Kuningan',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,' ',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jakarta Selatan (12960)',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Telp : (021) 830-5011 Fax : (021) 830-5012',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'NPWP : 021.672.152.2-011.00',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
				
			
			$pdf->Ln(13);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetX(25);
			$pdf->Cell(130,5,'PURCHASE REQUISITION',10,0,'L');
			$pdf->Ln(10);
			
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(80,5,'Request',10,0,'L');
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',6);
			
			$pdf->Cell(20,5,'Transaction Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,indo_date($rows->tgl_pr),10,0,'L');
			$pdf->Cell(15,4,'',10,0,'C');
			$pdf->Cell(15,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Cell(20,5,'Approval Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,indo_date($rows->tgl_aproval),10,0,'L');
			$pdf->Cell(15,4,'',10,0,'C');
			$pdf->Cell(15,5,' ',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Cell(20,5,'Requestor ',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(59,5,$rows->req_pr,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->Cell(20,5,'Divisi',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(40,5,$rows->divisi_nm,10,0,'L');
			$pdf->Cell(50,4,'',10,0,'C');
			
			
			$pdf->Ln(10);
			
			$pdf->SetX(2);
			
			
			$pdf->SetFont('Arial','',6);
				
			
			
			
			
			
			$pdf->Cell(10,8,'No',1,0,'C',1);
			$pdf->Cell(20,8,'Qty',1,0,'C',1);
			$pdf->Cell(20,8,'Unit',1,0,'C',1);
			$pdf->Cell(60,8,'Description',1,0,'C',1);
			$pdf->Cell(40,8,'Vendor Recomended',1,0,'C',1);
		
			$no = 0;
			//$pdf->Ln(5);
			
		}
		//
			$pdf->SetFont('Arial','',6);
			//$pdf->Ln(5);
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
			$pdf->Cell(10,5,$i,1,0,'C',0);
			$pdf->Cell(20,5,$row->qty_brg,1,0,'C',0);
			$pdf->Cell(20,5,$row->unit_brg,1,0,'C',0);
			$pdf->Cell(60,5,$row->nm_brg,1,0,'L',0);
			$pdf->Cell(40,5,$row->recvendor,1,0,'L',0);		
			$pdf->Ln(5);				
			$i++;
			$no++;
		
		
	}
			$pdf->SetFont('Arial','B',6);
			$pdf->Ln(25);
			$pdf->Cell(98,5,'Proposed by,',10,0,'L',0);
			$pdf->Cell(80,5,'Approved by,',10,0,'L',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			
			$pdf->Ln(25);
			
			
			
			$pdf->Cell(98,5,'(User Admin)',10,0,'L',0);
			$pdf->Cell(80,5,'(General Manager)',10,0,'L',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
		
				$pdf->SetFont('Arial','',6);
				// $pdf->SetX(180);
				// $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				// $pdf->Cell(2,4,':',4,0,'L');
				// $pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");

