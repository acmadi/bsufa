<?php
	
	
		/*$sql = "select distinct id_pt,nm_pt from view_daily order by id_pt asc";
		$cekdata = $this->db->query($sql)->result();*/

			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','Legal');
			
			$pdf->SetMargins(5,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(120,255,255);
			
			#HEAD
				
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
			$pdf->SetFont('Arial','',8);

			$pdf->SetX(180);
			#$pdf->Cell(0,5,'Lembar Ke : ',20,0,'L');
			$pdf->Cell(0,5,'',10,0,'L');
			$pdf->Ln(5);

			$pdf->SetFont('Arial','B',12);

			$pdf->SetX(85);
			$pdf->Cell(0,10,'',20,0,'L');
		
			$pdf->Ln(8);

			$pdf->SetFont('Arial','',9);

			//table header
			#$pdf->Cell(30,5,'Kode dan Nomor Seri Faktur Pajak','L'.'T'.'B',0,'L',0);
			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(130,5,$dat->no_fakturpajak,10,0,'L',0);
			$pdf->Ln(5);

			#$pdf->Cell(190,5,'Pengusaha Kena Pajak',1,0,'L',0);
			$pdf->Cell(190,5,'',10,0,'L',0);
			$pdf->Ln(8);

			
			
			#$pdf->Cell(55,5,'Nama','L',0,'L',0);
			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(130,5,' PT. BAKRIE SWASAKTI UTAMA ',10,0,'L',0);
			$pdf->Ln(5);

			$pdf->SetFont('Arial','',9);
			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(130,5,'anu itu annu itu',10,0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(130,5,'-',10,0,'L',0);
			$pdf->Ln(5);
		
			$pdf->Cell(53,5,'',10,'L',0);
			$pdf->Cell(5,5,'  ',10,0,'C',0);
			$pdf->Cell(130,5,'02.467.169.5-011.000',10,0,'L',0);
			$pdf->Ln(10);
			
			#$pdf->Cell(190,5,'Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak',1,0,'L',0);
			$pdf->Cell(190,5,'',10,0,'L',0);
			$pdf->Ln(5);

			#$pdf->Cell(55,5,'Nama',10,0,'L',0);
			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(130,5,$dat->customer_nama,10,0,'L',0);
			$pdf->Ln(5);

			$pdf->SetFont('Arial','',9);
			#$pdf->Cell(45,5,'Alamat',10,0,'L',0);
			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(130,5,'anu itu aduh itu ituu aduuuhhh',10,0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(130,5,'-',10,0,'L',0);
			$pdf->Ln(5);

			#$pdf->Cell(55,5,'NPWP','L',0,'L',0);
			$pdf->Cell(53,5,'',10,0,'L',0);
			$pdf->Cell(5,5,'',10,0,'C',0);
			$pdf->Cell(130,5,'500.000.343.88',10,0,'L',0);
			$pdf->Ln(5);

			

			#$pdf->Cell(15,5,'No','L'.'T'.'R',0,'C',0);
			$pdf->Cell(15,5,'',10,0,'C',0);
			#$pdf->Cell(110,5,'Nama Barang Kena Pajak / Jasa Kena Pajak','L'.'T'.'R',0,'C',0);
			$pdf->Cell(110,5,'',10,0,'C',0);
			$pdf->Cell(65,5,'',10,0,'C',0);
			$pdf->Ln(10);

			// #$pdf->Cell(15,5,'Urut','L'.'B'.'R',0,'C',0);
			// $pdf->Cell(15,5,'',10,0,'C',0);
			// $pdf->Cell(110,5,'',10,0,'C',0);
			// $pdf->Cell(65,5,'',10,0,'C',0);
			// $pdf->Ln(5);

			// $pdf->Cell(15,5,'',10,0,'C',0);
			// $pdf->Cell(110,5,'',10,0,'C',0);
			// $pdf->Cell(65,5,'',10,0,'C',0);
			// $pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5); 

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);
				
				$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);
				
				$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);
				
				$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);
				
				$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);
				
				$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);
				
				$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(5);
				
				$pdf->Cell(5,5,'1',10,0,'L',0);
			$pdf->Cell(10,5,'',10,0,'L',0);
			$pdf->Cell(120,5,$dat->description,10,0,'L',0);
			$pdf->Cell(65,5,number_format(10000000),10,0,'R',0);
			$pdf->Ln(9);
			
			

			#$pdf->Cell(135,5,'Harga Jual / Penggantian / Uang Muka / Termin *)',10,0,'L',0);
			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,number_format(50000000),10,0,'R',0);
			$pdf->Ln(9);

			#$pdf->Cell(135,5,'Dikurangi Potongan Harga',10,0,'L',0);
			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,number_format(50000000),10,0,'R',0);
			$pdf->Ln(9);

			#$pdf->Cell(135,5,'Dikurangi Uang Muka Yang Telah Diterima',10,0,'L',0);
			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,number_format(50000000),10,0,'R',0);
			$pdf->Ln(9);

			#$pdf->Cell(135,5,'Dasar Pengenaan Pajak',10,0,'L',0);
			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,number_format(50000000),10,0,'R',0);
			$pdf->Ln(9);

			#$pdf->Cell(135,5,'PPN = 10% x Dasar Pengenaan Pajak',10,0,'L',0); 
			$pdf->Cell(135,7,'',10,0,'L',0); 
			$pdf->Cell(65,7,number_format(50000000),10,0,'R',0);
			$pdf->Ln(9);

			// $pdf->Cell(135,7,'',10,0,'L',0);
			// $pdf->Cell(65,7,'',10,0,'C',0);
			// $pdf->Ln(5);			
			
			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,inggris_date($dat->date_fakturpajak),10,0,'C',0);
			$pdf->Ln(7);

			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,'',10,0,'C',0);
			$pdf->Ln(7);

			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,'',10,0,'C',0);
			$pdf->Ln(7);

			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,'',10,0,'C',0);
			$pdf->Ln(7);

			// $pdf->Cell(135,7,'',10,0,'L',0);
			// $pdf->Cell(65,7,'..........................................................',10,0,'C',0);
			// $pdf->Ln(7);

			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,'FAIZ',10,0,'L',0);
			$pdf->Ln(7);
 
			$pdf->Cell(135,7,'',10,0,'L',0);
			$pdf->Cell(65,7,'',10,0,'C',0);
			#$pdf->Ln();

			$pdf->Output("TAX_REPORT.pdf","I");	;
	
