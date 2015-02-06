<?php

		//doc_no, doc_date, nm_supplier,inv_no, inv_date,due_date,descs, trx_amt, 
		//(trx_amt*10)/100 as PPN, (trx_amt*10)/100 as PPH23
		
			require('fpdf/classreport.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			
			//die($checkbox);
			
			$data = $this->db->query("sp_reportkomisi ".$id."")
							 ->result();
							 
			$tgl_proses = $this->db->where('id_proses',$id)
							   ->get('db_proseskomisi')->row();
			$tgl_proses1 = indo_date($tgl_proses->tgl_proses);				   
			
							 
			
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. BUDI DAYA MAKMUR";
				$judul 		= "Komisi Report";
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
				$pdf->Cell(10,4,'$tgl',0,0,'L');
			
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
				$pdf->Cell(0,10,$periode.' : '.$tgl_proses1,20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			// Start Isi Tabel
			$pdf->SetX(1);
			$pdf->Cell(0,10,'Alokasi Komisi  :',20,0,'L');
			$pdf->Ln(4);
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			
			
			$pdf->SetXY(2,40);
			$pdf->Cell(20,5,'Div Head',1,0,'L',0);
			$pdf->Cell(20,5,'0.070%',1,0,'C',0);
			$pdf->SetXY(2,45);
			$pdf->Cell(20,5,'Dept Head',1,0,'L',0);
			$pdf->Cell(20,5,'0.105%',1,0,'C',0);
			$pdf->SetXY(2,50);
			$pdf->Cell(20,5,'MGR Sales',1,0,'L',0);
			$pdf->Cell(20,5,'0.150%',1,0,'C',0);
			$pdf->SetXY(2,55);
			$pdf->Cell(20,5,'Sales',1,0,'L',0);
			$pdf->Cell(20,5,'0.100%',1,0,'C',0);
			$pdf->SetXY(2,60);
			$pdf->Cell(20,5,'CS',1,0,'L',0);
			$pdf->Cell(20,5,'0.015%',1,0,'C',0);
			$pdf->SetXY(2,65);
			$pdf->Cell(20,5,'Adm',1,0,'L',0);
			$pdf->Cell(20,5,'0.020%',1,0,'C',0);
			$pdf->SetXY(2,70);
			$pdf->Cell(20,5,'Total',1,0,'L',1);
			$pdf->Cell(20,5,'1.360%',1,0,'C',1);
			
			
			$pdf->SetX(6);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(10);
			
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(35,10,'Customer',1,0,'C',1);
			//$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(15,10,'Tgl SP',1,0,'C',1);
			$pdf->Cell(25,10,'Harga(Inc VAT)',1,0,'C',1);
			$pdf->Cell(25,10,'Harga(Exc VAT)',1,0,'C',1);
			$pdf->Cell(20,10,'Payment',1,0,'C',1);
			$pdf->Cell(10,10,'Persen',1,0,'C',1);
			$pdf->Cell(120,5,'Komisi',1,0,'C',1);
			// $pdf->Cell(50,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'Sales Name',1,0,'C',1);
			// $pdf->Cell(20,10,'PPN',1,0,'C',1);
			// $pdf->Cell(20,10,'PPH 23',1,0,'C',1);
			// $pdf->Cell(20,10,'Total',1,0,'C',1);
			
			
			$pdf->Ln(5);
			
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'L',0);
			$pdf->Cell(35,5,'',10,0,'L',0);
			$pdf->Cell(15,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'Sales',1,0,'C',1);
			$pdf->Cell(20,5,'MGR Sales',1,0,'C',1);
			$pdf->Cell(20,5,'Dept Head',1,0,'C',1);
			$pdf->Cell(20,5,'Div Head',1,0,'C',1);
			$pdf->Cell(20,5,'CS',1,0,'C',1);
			$pdf->Cell(20,5,'Adm',1,0,'C',1);
			// $pdf->Cell(55,5,'',10,0,'C',0);
			$pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 14;	
			$pdf->Ln(5);
			$tot1 = 0;
			$tot2 = 0;
			$tot3 = 0;
			$tot4 = 0;
			
			$tot5 = 0;
			$tot6 = 0;
			$tot7 = 0;
			$tot8 = 0;
			
			$totol = 0;
					
			
	// for($i = 1;$i <= 200; $i++){
	foreach($data as $row){	
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
				$pt			= "PT. Graha Multi Insani";
				$judul 		= "Komisi Report";
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
				$pdf->Cell(10,4,'$tgl',0,0,'L');
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,'$pt',20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,'$judul',20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'$periode'.' : '.'$startdate'. '  To  '.'$enddate',20,0,'L');
			
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,10,'No',1,0,'C',1);
			$pdf->Cell(25,5,'A/P',1,0,'C',1);
			$pdf->Cell(25,5,'A/P',1,0,'C',1);
			//$pdf->Cell(15,10,'Unit',1,0,'C',1);
			$pdf->Cell(45,10,'Vendor',1,0,'C',1);
			$pdf->Cell(60,5,'Invoice',1,0,'C',1);
			$pdf->Cell(50,10,'Description',1,0,'C',1);
			$pdf->Cell(20,10,'DPP',1,0,'C',1);
			$pdf->Cell(20,10,'PPN',1,0,'C',1);
			$pdf->Cell(20,10,'PPH 23',1,0,'C',1);
			$pdf->Cell(20,10,'Total',1,0,'C',1);
			
			
			$pdf->Ln(5);
			
			$pdf->Cell(8,5,'',10,0,'C',0);
			//$pdf->Cell(25,5,'No.',1,0,'C',1);
			//$pdf->Cell(25,5,'Date',1,0,'C',1);
			$pdf->Cell(45,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'No.',1,0,'C',1);
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
			
			$tot1 = $tot1 + $row->sales;
			$tot2 = $tot2 + $row->manager;
			$tot3 = $tot3 + $row->dept_head;
			$tot4 = $tot4 + $row->div_head;
			$tot5 = $tot5 + $row->cs;
			$tot6 = $tot6 + $row->admin;
			
			
					
			
			$pdf->Cell(8,10,$no,1,0,'C',0);
			$pdf->Cell(15,10,$row->unit_no,1,0,'L',0);
			$pdf->Cell(35,10,$row->customer_nama,1,0,'L',0);
			$pdf->Cell(15,10,indo_date($row->tgl_sales),1,0,'L',0);
			$pdf->Cell(25,10,number_format($row->selling_price),1,0,'R',0);
			$pdf->Cell(25,10,number_format($row->exclude),1,0,'R',true);
			$pdf->Cell(20,10,number_format($row->payment),1,0,'R',0);
			$pdf->Cell(10,10,number_format($row->persen).'%',1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->sales),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->manager),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->dept_head),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->div_head),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->cs),1,0,'R',0);
			$pdf->Cell(20,10,number_format($row->admin),1,0,'R',0);
			// $pdf->Cell(50,10,'substr($row->descs,0,40)',"L"."R",0,'L',0);
			$pdf->Cell(20,10,$row->nama_sales,1,0,'L',0);
			// $pdf->Cell(20,10,'number_format($row->mtax_amt)',1,0,'R',0);
			// $pdf->Cell(20,10,'number_format($row->mtax_deduct_amt)',1,0,'R',0);
			
				
			//$pdf->Cell(20,10,'number_format($total)',1,0,'R',0);
			
				 $pdf->Ln(5);

			// $pdf->SetX(265);
					
			// $pdf->Cell(50,5,'substr($row->descs,40,40)','L'.'R'.'B',0,'L',0);
		
			$pdf->Ln(5);		
			// $tot1 = 0;
			// $tot2 = 0;
			// $tot3 = 0;
			
			// $tot5 = $tot5 + $tot4;
			// $tot6 = $tot6 + $row->mtax_amt;
			// $tot7 = $tot7 + $row->mtax_deduct_amt;
			// $tot8 = $tot8 + $row->mbase_amt;
			
			$i++;
			$no++;
			$noo++;
		
	}
	
			$pdf->Cell(8,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'C',0);
			$pdf->Cell(35,5,'',10,0,'C',0);
			$pdf->Cell(15,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(25,5,'',10,0,'L',0);
			$pdf->Cell(20,5,'',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			// $pdf->Cell(20,5,'',10,0,'C',0);
			//$pdf->Cell(10,5,'GRAND TOTAL',1,0,'L',1);
			$pdf->Cell(20,5,number_format($tot1),1,0,'R',1);
			$pdf->Cell(20,5,number_format($tot2),1,0,'R',1);
			$pdf->Cell(20,5,number_format($tot3),1,0,'R',1);
			$pdf->Cell(20,5,number_format($tot4),1,0,'R',1);
			$pdf->Cell(20,5,number_format($tot5),1,0,'R',1);
			$pdf->Cell(20,5,number_format($tot6),1,0,'R',1);
		
			
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
	
