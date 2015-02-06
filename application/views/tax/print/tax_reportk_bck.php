<?php
	
	
		/*$sql = "select distinct id_pt,nm_pt from view_daily order by id_pt asc";
		$cekdata = $this->db->query($sql)->result();*/

			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','Letter');
			
			$pdf->SetMargins(12,10,2);
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
			$pdf->Cell(0,5,'Lembar Ke : ',20,0,'L');
			$pdf->Ln(5);

			$pdf->SetFont('Arial','B',12);

			$pdf->SetX(85);
			$pdf->Cell(0,10,'FAKTUR PAJAK',20,0,'L');
		
			$pdf->Ln(10);

			$pdf->SetFont('Arial','',9);

			//table header
			$pdf->Cell(55,5,'Kode dan Nomor Seri Faktur Pajak','L'.'T'.'B',0,'L',0);
			$pdf->Cell(5,5,':','T'.'B',0,'C',0);
			$pdf->Cell(130,5,$dat->no_fakturpajak,'T'.'L'.'B',0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(190,5,'Pengusaha Kena Pajak',1,0,'L',0);
			$pdf->Ln(5);

			
			
			$pdf->Cell(55,5,'Nama','L',0,'L',0);
			$pdf->Cell(5,5,':',0,0,'C',0);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(130,5,' PT. BAKRIE SWASAKTI UTAMA ','R',0,'L',0);
			$pdf->Ln(5);

			$pdf->SetFont('Arial','',9);
			$pdf->Cell(55,5,'Alamat','L',0,'L',0);
			$pdf->Cell(5,5,':',0,0,'C',0);
			$pdf->Cell(130,5,'Epiwalk Suites Lt. 6 Unit A601 Jl. HR. Rasuna Said Karet Kuningan, Setiabudi','R',0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(55,5,'','L',0,'L',0);
			$pdf->Cell(5,5,'',0,0,'C',0);
			$pdf->Cell(130,5,'Jakarta Selatan DKI Jakarta 12940','R',0,'L',0);
			$pdf->Ln(5);
		
			$pdf->Cell(55,5,'NPWP','L',0,'L',0);
			$pdf->Cell(5,5,' : ',0,0,'C',0);
			$pdf->Cell(130,5,'02.467.169.5-011.000','R',0,'L',0);
			$pdf->Ln(5);
			
			$pdf->Cell(190,5,'Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak',1,0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(55,5,'Nama','L',0,'L',0);
			$pdf->Cell(5,5,':',0,0,'C',0);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(130,5,$dat->customer_nama,'R',0,'L',0);
			$pdf->Ln(5);

			$pdf->SetFont('Arial','',9);
			$pdf->Cell(55,5,'Alamat','L',0,'L',0);
			$pdf->Cell(5,5,':',0,0,'C',0);
			$pdf->Cell(130,5,$dat->customer_alamat1,'R',0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(55,5,'','L',0,'L',0);
			$pdf->Cell(5,5,'',0,0,'C',0);
			$pdf->Cell(130,5,'','R',0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(55,5,'NPWP','L',0,'L',0);
			$pdf->Cell(5,5,' : ',0,0,'C',0);
			$pdf->Cell(130,5,'','R',0,'L',0);
			$pdf->Ln(5);

			

			$pdf->Cell(15,5,'No','L'.'T'.'R',0,'C',0);
			$pdf->Cell(110,5,'Nama Barang Kena Pajak / Jasa Kena Pajak','L'.'T'.'R',0,'C',0);
			$pdf->Cell(65,5,'Harga Jual/Penggantian/Uang Muka/Termin','L'.'T'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'Urut','L'.'B'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'B'.'R',0,'C',0);
			$pdf->Cell(65,5,'(Rp.)','L'.'B'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'1','L'.'R',0,'C',0);
			$pdf->Cell(110,5,$dat->description,'L'.'R',0,'L',0);
			$pdf->Cell(65,5,number_format($dat->trx_amount),'L'.'R',0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(15,5,'','L'.'R',0,'C',0);
			$pdf->Cell(110,5,'','L'.'R',0,'C',0);
			$pdf->Cell(65,5,'','L'.'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'Harga Jual / Penggantian / Uang Muka / Termin *)','L'.'T'.'R',0,'L',0);
			$pdf->Cell(65,5,number_format($dat->trx_amount),'L'.'T'.'R',0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'Dikurangi Potongan Harga','L'.'T'.'R',0,'L',0);
			$pdf->Cell(65,5,'','L'.'T'.'R',0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'Dikurangi Uang Muka Yang Telah Diterima','L'.'T'.'R',0,'L',0);
			$pdf->Cell(65,5,'','L'.'T'.'R',0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'Dasar Pengenaan Pajak','L'.'T'.'R',0,'L',0);
			$pdf->Cell(65,5,number_format($dat->trx_amount),'L'.'T'.'R',0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'PPN = 10% x Dasar Pengenaan Pajak',1,0,'L',0);
			$pdf->Cell(65,5,number_format($dat->tax_amount),1,0,'R',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'','L',0,'L',0);
			$pdf->Cell(65,5,'','R',0,'C',0);
			$pdf->Ln(5);			
			
			$pdf->Cell(125,5,'','L',0,'L',0);
			$pdf->Cell(65,5,'Jakarta , '.inggris_date($dat->date_fakturpajak),'R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'','L',0,'L',0);
			$pdf->Cell(65,5,'','R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'','L',0,'L',0);
			$pdf->Cell(65,5,'','R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'','L',0,'L',0);
			$pdf->Cell(65,5,'','R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'','L',0,'L',0);
			$pdf->Cell(65,5,'..........................................................','R',0,'C',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'','L',0,'L',0);
			$pdf->Cell(65,5,'       Nama : '.$dat->ttd_fakturpajak,'R',0,'L',0);
			$pdf->Ln(5);

			$pdf->Cell(125,5,'','L'.'B',0,'L',0);
			$pdf->Cell(65,5,'','R'.'B',0,'C',0);
			$pdf->Ln(5);

			$pdf->Output("TAX_REPORT.pdf","I");	;
	
