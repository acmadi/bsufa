<?php
	#die("test");
	extract(PopulateForm());
	$session_id = $this->UserLogin->isLogin();
	$pt = $session_id['id_pt'];
	$data_pt = $this->mstmodel->get_nama_pt($pt);
	$nama_pt = "PT \t".$data_pt['ket'];
	$rowproj = $this->db->where('subproject_id',$proj)
					    ->get('db_subproject')->row();
	$project = $rowproj->nm_subproject;
	#var_dump($project);exit;
	$start = inggris_date($start_date);
	$end	= inggris_date($end_date);
			
	#$rows = $this->db->query("SoldUnit ");
	#$data = $rows->result();

	require('fpdf/classreport.php');
	$pdf=new PDF('L','mm','A4');
	$pdf->SetMargins(2,10,2);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->SetMargins(2,10,2);
		
						
	#HEADER CONTENT
	$judul 		= "History All Payment";
	$periode	= "Periode";
			
	#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
	#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
	#Header
	$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(25);
	$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
	$pdf->SetFont('Arial','B',10);		
	$pdf->SetXY(25,16);
	$pdf->Cell(0,10,$judul." ".$project,20,0,'L');
			
			
	$pdf->Ln(8);
	$pdf->SetX(25);
	$pdf->Cell(20,10,'Periode '.$start_date.' sampai '.$end_date,20,0,'L');
	
	
	
	
	
	
	
	
			
	$pdf->SetFont('Arial','',9);
	$pdf->SetXY(30,45);
						
	$y_axis_initial = 40;
	$y_axis = 0;
	$pdf->SetFont('Arial','',8);
	$pdf->setFillColor(222,222,222);
	$pdf->SetY($y_axis_initial);
	
	
	// Start Isi Tabel
			$pdf->SetX(1);
			// $pdf->Cell(0,10,'Alokasi Komisi  :',20,0,'L');
			// $pdf->Ln(4);
			// $pdf->SetX(6);
			// $pdf->SetFont('Arial','B',8);
			// $pdf->Ln(4);
			
			//tutup dulu
			// $pdf->SetXY(2,40);
			// $pdf->Cell(20,5,'Project',1,0,'L',1);
			// $pdf->Cell(20,5,'Paid',1,0,'C',1);
			// $pdf->SetXY(2,45);
			// $pdf->Cell(20,5,'Coral',1,0,'L',0);
			// $pdf->Cell(20,5,'0.105%',1,0,'C',0);
			// $pdf->SetXY(2,50);
			// $pdf->Cell(20,5,'Sand',1,0,'L',0);
			// $pdf->Cell(20,5,'0.150%',1,0,'C',0);
			// $pdf->SetXY(2,55);
			// $pdf->Cell(20,5,'Ocea',1,0,'L',0);
			// $pdf->Cell(20,5,'0.100%',1,0,'C',0);

	
			$pdf->Ln(10);
	
	#HEADER TABLE
	$pdf->SetX(3);
		$pdf->Cell(10,6,'No',1,0,'C',0);
			$pdf->Cell(65,6,'Project',1,0,'C',0);
			$pdf->Cell(20,6,'Unit',1,0,'C',0);
			$pdf->Cell(55,6,'Customer',1,0,'C',0);
			$pdf->Cell(30,6,'Sqm',1,0,'C',0);
			#$pdf->Cell(40,6,'SP No',1,0,'C',0);
			$pdf->Cell(30,6,'Sp Date',1,0,'C',0);
			$pdf->Cell(30,6,'Harga Jual',1,0,'C',0);
			$pdf->Cell(30,6,'Paid',1,0,'C',0);
	$pdf->Ln();				
	
	#Cek Data Payment
	$data = $this->db->query("SP_history_payment_summary ".$proj.",".$pt.",'".$start."','".$end."'")->result();
				 
	$i = 1;	
	$no = 0;
	$max = 19;		
	#$tgl = inggris_date($date);
	$tot1 = 0;	 
	foreach($data as $row){
		//Cek Aging
		$tot1 = $tot1 + $row->kwtbill_pay;
		if($no == $max){ 
			$pdf->AddPage();
			#Header
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
					
			$pdf->SetFont('Arial','B',10);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul." ".$project,20,0,'L');
					
					
			$pdf->Ln(8);
			$pdf->SetX(25);
			$pdf->Cell(20,10,'Periode '.$start_date.' sampai '.$end_date,20,0,'L');
					
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(30,45);
								
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			#HEADER TABLE
			$pdf->SetX(3);
			$pdf->Cell(10,6,'No',1,0,'C',0);
			$pdf->Cell(65,6,'Project',1,0,'C',0);
			$pdf->Cell(20,6,'Unit',1,0,'C',0);
			$pdf->Cell(55,6,'Customer',1,0,'C',0);
			$pdf->Cell(30,6,'Sqm',1,0,'C',0);
			#$pdf->Cell(40,6,'SP No',1,0,'C',0);
			$pdf->Cell(30,6,'Sp Date',1,0,'C',0);
			$pdf->Cell(30,6,'Harga Jual',1,0,'C',0);
			$pdf->Cell(30,6,'Paid',1,0,'C',0);
			$pdf->Ln();				
			$no = 0;
			$pdf->Ln();			
		}
				 
		$pdf->SetX(3);
		$pdf->Cell(10,6,$i,10,0,'C',0);
		$pdf->Cell(65,6,$row->nm_subproject,10,0,'L',0);
		$pdf->Cell(20,6,$row->unit_no,10,0,'C',0);
		$pdf->Cell(55,6,$row->customer_nama,10,0,'L',0);
		$pdf->Cell(30,6,$row->bangunan,10,0,'R',0);		
		$pdf->Cell(30,6,indo_date($row->tgl_sales),10,0,'C',0);
		$pdf->Cell(30,6,number_format($row->selling_price),10,0,'R',0);
		$pdf->Cell(30,6,number_format($row->kwtbill_pay),10,0,'R',0);
		$pdf->Ln();
		$i++;
		$no++;
		
	}
		$pdf->cell(270,0,'',1,0,'C',0);
		// $pdf->Ln();
		// $pdf->Cell(230,6,'Total Cash Received :',10,0,'R',0);
		// $pdf->Cell(40,6,'0',10,0,'R',0);		
		// $pdf->Ln();
		// $pdf->Cell(230,6,'Total Giro Received :',10,0,'R',0);
		// $pdf->Cell(40,6,'0',10,0,'R',0);
		// $pdf->Ln();
		// $pdf->Cell(230,6,'Total Transfer Received :',10,0,'R',0);
		// $pdf->Cell(40,6,number_format($tot1),10,0,'R',0);
		$pdf->Ln();
		$pdf->Cell(230,6,'Total Amount :',10,0,'R',0);
		$pdf->Cell(40,6,number_format($tot1),10,0,'R',0);
		$pdf->Ln();						
	$pdf->Output("history.pdf","I");
				

			
			
			

