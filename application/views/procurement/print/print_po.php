<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			include_once( APPPATH."libraries/translate_currency.php"); 
	
		//	$rows = $this->db->query("sp_printpr '".$id."'")->row();
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
			// $judul 		= "TENDER EVALUATION";
			// $periode	= "As Off";
			// $date		= "24 January 2012";
			// $project	= "XXX";
			// $angka		= "100000000000000";
			// $contractor	= "PT. Pandega Design Weharima";
			// $job		= "Pembuatan maket Skala 1:100 dan skala 1:200";
			// $alamat		= "Jl. Pangeran Jayakarta";
			// $kota		= "Jakarta Pusat";
			// $tlp		= "(021) 78999999 ";
			// $fax		=  "(021) 78999999 ";
			// $up			= "Joni Kemod";
			// $bilangan 	= UcFirst(toRupiah(11200000000));
			$pdf->SetX(25);
				
			// Start diatas tabel
			$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(130,5,'PT. GRAHA MULTI INSANI',10,0,'L');
			$pdf->SetFont('Arial','',6);
			// $pdf->Cell(10,5,'No. PR',10,0,'L');
			// $pdf->Cell(2,5,':',10,0,'L');
			// $pdf->Cell(30,5,$rows->no_pr,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(0,3,'Komplek Apartemen Taman Rasuna',20,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(0,3,'Jl. HR Rasuna Said - Kuningan',20,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(0,3,'Jakarta Selatan (12960)',20,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(0,3,'Telp : (021)8305011   Fax : (021) 8305012',20,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(0,3,'NPWP. 01.260.283.7.xxxx',20,0,'L');
			$pdf->Ln(15);
			
			$pdf->SetFont('Arial','U'.'B',18);
			$pdf->SetX(5);
			$pdf->Cell(0,3,'PURCHASE ORDER',20,0,'C');
			$pdf->Ln(10);
			
			
			#SUPPLIER
			$pdf->SetFont('Arial','B',10);
			$pdf->SetX(5);
			$pdf->Cell(80,4,'To :','10',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetFont('Arial','',8);
			$pdf->SetX(5);
			$pdf->Cell(80,4,'','10',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(80,4,'','10',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(80,4,'','10',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(80,4,'Tlp.  Fax. ','10',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(80,4,'UP. ','L'.'B'.'R',0,'L');
			$pdf->Ln(4);
			
			
			$pdf->SetXY(125,55);
			$pdf->Cell(15,4,'No. PO','L'.'T',0,'L');
			$pdf->Cell(3,4,':','T',0,'L');
			$pdf->Cell(62,4,'PO-GMI/MKT-1206/0001','T'.'R',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetXY(125,59);
			$pdf->Cell(15,4,'Tgl. PO','L',0,'L');
			$pdf->Cell(3,4,':',20,0,'L');
			$pdf->Cell(62,4,'','R',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetXY(125,63);
			$pdf->Cell(15,4,'Divisi','L',0,'L');
			$pdf->Cell(3,4,':',20,0,'L');
			$pdf->Cell(62,4,'Finance & MIS','R',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetXY(125,67);
			$pdf->Cell(15,4,'Reff. PR','L',0,'L');
			$pdf->Cell(3,4,':',20,0,'L');
			$pdf->Cell(62,4,'PR/MKT-1205/0001','R',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetXY(125,71);
			$pdf->Cell(15,4,'Currency','L',0,'L');
			$pdf->Cell(3,4,':',20,0,'L');
			$pdf->Cell(62,4,'IDR','R',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetXY(125,75);
			$pdf->Cell(80,4,'','L'.'B'.'R',0,'L');
			$pdf->Ln(4);
			
			$pdf->SetXY(5,81);
			$pdf->Cell(12,5,'Remark : ','L'.'T'.'B',0,'L');
			$pdf->Cell(188,5,'bla bla bla','T'.'B'.'R',0,'L');
			$pdf->Ln(3);
			
			$pdf->SetXY(5,87);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(6,5,'No.',1,0,'C');
			$pdf->Cell(102,5,'Description',1,0,'C');
			$pdf->Cell(12,5,'Qty',1,0,'C');
			$pdf->Cell(20,5,'Measure',1,0,'C');
			$pdf->Cell(25,5,'Price',1,0,'C');
			$pdf->Cell(10,5,'Disc.',1,0,'C');
			$pdf->Cell(25,5,'Total Price',1,0,'C');
			
			$pdf->Ln(8);
			
			
		
			
			
			
			$i = 1;	
			$no = 0;
			$max = 45;	
		
			
			$tot = 0;
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
			//$pdf->Cell(8,5,'',1,0,'C',0);
			
			// $dt = $this->db->join('db_prorder b','b.no_pr = a.no_pr','left')
						   // ->where('a.id_pr',$rows->id_pr)
						    // ->get('db_pr a')->result();
			
			
			
	//foreach($dt as $row){
	for($i=1; $i<= 8; $i++){		
		
		//
			$pdf->SetFont('Arial','',6);
			//$pdf->Ln(5);
			//$pdf->Cell(22,5,'I. THE 18th',1,0,'C',0);
			$pdf->Cell(6,5,$i,1,0,'C');
			$pdf->Cell(102,5,'bla bla bla',1,0,'L');
			$pdf->Cell(12,5,'10,000',1,0,'C');
			$pdf->Cell(20,5,'Unit',1,0,'C');
			$pdf->Cell(25,5,'',1,0,'C');
			$pdf->Cell(10,5,'100%',1,0,'C');
			$pdf->Cell(25,5,'',1,0,'C');
			$pdf->Ln(5);				
			$i++;
			$no++;
		
		
	}
			$pdf->Ln(1);
		
			$pdf->SetFont('Arial','B',7);
			$pdf->SetX(5);
			$pdf->Cell(140,4,'','10',0,'R');
			$pdf->Cell(35,4,'Subtotal','10',0,'R');
			$pdf->Cell(25,4,'','10',0,'C');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(140,4,'','10',0,'R');
			$pdf->Cell(35,4,'Discount','10',0,'R');
			$pdf->Cell(25,4,'','10',0,'C');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(140,4,'','10',0,'R');
			$pdf->Cell(35,4,'Total','10',0,'R');
			$pdf->Cell(25,4,'',1,0,'C');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(140,4,'','10',0,'R');
			$pdf->Cell(35,4,'PPN','10',0,'R');
			$pdf->Cell(25,4,'',1,0,'C');
			$pdf->Ln(4);
			
			$pdf->SetX(5);
			$pdf->Cell(140,4,'','L'.'B'.'R',0,'R');
			$pdf->Cell(35,4,'Grand Total','L'.'B'.'R',0,'R');
			$pdf->Cell(25,4,'',1,0,'C');
			$pdf->Ln(4);
		
			$pdf->Ln(1);
			$pdf->SetX(5);
			$pdf->Cell(15,6,'Terbilang : ',20,0,'L');
			$pdf->Cell(185,6,'#'.''.'#',1,0,'L');
			$pdf->Ln(6);
			
			$pdf->Ln(1);
			$pdf->SetX(5);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(15,5,'Keterangan : ',20,0,'L');
			
			$pdf->Ln(5);
			$pdf->SetX(5);
			$pdf->Cell(80,5,'1. Barang tidak bisa diterima tanpa mencantumkan nomer PO di Kwitansi/Invoice','10',0,'L');
			$pdf->SetFont('Arial','B','8');
			$pdf->Cell(120,5,'Acknowledge By, ',20,0,'C');
			
			
			$pdf->Ln(5);
			$pdf->SetX(5);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(80,5,'2. Barang yang dikirim harus sama dengan sepesifikasi yang ada di PO','10',0,'L');
			
			$pdf->Ln(5);
			$pdf->SetX(5);
			$pdf->Cell(80,5,'3. Pembayaran 14 hari setelah barang diterima','L'.'B'.'R',0,'L');
			
			$pdf->Ln(10);
			$pdf->SetX(85);
			$pdf->SetFont('Arial','U','8');
			$pdf->Cell(120,5,'Mr.xxxxx',20,0,'C');
			
			$pdf->Ln(3);
			$pdf->SetX(85);
			$pdf->SetFont('Arial','B','8');
			$pdf->Cell(120,5,'Purchasing Manager',20,0,'C');
		
				$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");

