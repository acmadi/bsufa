<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			
			$q1 = "select a.nama as nama,b.divisi_nm as divisi_nm,a.id_kary as id_kary, c.cuti_bersama,
					a.tgl_join as tgl_join,c.saldo_cuti as saldo_cuti,
					((saldo_cuti )-(select isnull(sum(aju_cuti),0) from db_karycuti where
					kary_id=a.id_kary and year(startdate_cuti) = '".($tgl1)."' ))-cuti_bersama as balance
					from db_kary a 
					left join db_divisi b on a.id_divisi = b.divisi_id
					left join db_karycutipar c on a.id_kary = c.karyawan_id
					where a.id_kary = $kary and isnull(a.id_flag,0) != 10";
			
			$q2 = $this->db->query($q1)->row();
			
			
			$pdf=new PDF('L','mm','A4');
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "Bakrie Swasakti Utama";
				$judul 		= "Leaving per Employee";
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
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Periode'.' : '. $tgl1,20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
			$pdf->Ln(10);
			// Start Isi Tabel
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(30,5,'Name',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$q2->nama,10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(30,5,'Division',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$q2->divisi_nm,10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(30,5,'NIK',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$q2->id_kary,10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(30,5,'Join Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(20,5,indo_date($q2->tgl_join),10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(30,5,'Saldo',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$q2->saldo_cuti.' Hari',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(30,5,'Cuti Bersama',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$q2->cuti_bersama.' Hari',10,0,'L',0);
			$pdf->Ln(4);
			$pdf->Cell(30,5,'Balance',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(20,5,$q2->balance.' Hari',10,0,'L',0);
			$pdf->Ln(4);
			
			
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Ln(4);
			
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Request Date',1,0,'C',1);
			$pdf->Cell(20,5,'Start Date',1,0,'C',1);
			$pdf->Cell(20,5,'End',1,0,'C',1);
			$pdf->Cell(20,5,'Used',1,0,'C',1);
			//$pdf->Cell(20,5,'Balanced',1,0,'C',1);
			$pdf->Cell(50,5,'Remark',1,0,'C',1);
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 24;	
			$pdf->Ln(5);
			$tot1 = 0;
			
			$que = "select nama, (saldo_cuti) As Saldo_cuti,  aju_cuti as used,  tgl_join, divisi_nm, tgl_aju, startdate_cuti, enddate_cuti, ket_cuti from db_kary a 
			inner join db_karycutipar b	on a.id_kary = b.karyawan_id 
			inner join db_divisi c on a.id_divisi = c.divisi_id 
			inner join db_karycuti d on a.id_kary = d.kary_id
			where a.id_kary = $kary and year(d.startdate_cuti) = '".($tgl1)."'";
			
			$qeuy = $this->db->query($que)->result();
					
	foreach ($qeuy as $row){		
	#for($i = 1;$i <= 200; $i++){
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "Bakrie Swasakti Utama";
				$judul 		= "Leaving per Employee";
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
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Periode'.' : '. $tgl1,20,0,'L');
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
		
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Ln(4);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(20,5,'Request Date',1,0,'C',1);
			$pdf->Cell(20,5,'Start Date',1,0,'C',1);
			$pdf->Cell(20,5,'End',1,0,'C',1);
			$pdf->Cell(20,5,'Used',1,0,'C',1);
			//$pdf->Cell(20,5,'Balanced',1,0,'C',1);
			$pdf->Cell(50,5,'Remark',1,0,'C',1);
		
			
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}
	
			$tot1 = $tot1 + $row->used;
			
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(20,5,indo_date($row->tgl_aju),1,0,'L',0);
			$pdf->Cell(20,5,indo_date($row->startdate_cuti),1,0,'R',0);
			$pdf->Cell(20,5,indo_date($row->enddate_cuti),1,0,'R',0);
			$pdf->Cell(20,5,$row->used,1,0,'R',0);
			// $pdf->Cell(20,5,$row->balance,1,0,'R',0);
			$pdf->Cell(50,5,$row->ket_cuti,1,0,'L',0);
			
		
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(68,5,'TOTAL',1,0,'R',1);
			$pdf->Cell(20,5,number_format($tot1),1,0,'R',1);
			$pdf->Cell(50,5,'',1,0,'R',1);
					
		// $pdf->SetFont('Arial','',6);
				// $pdf->SetX(120);
				// $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				// $pdf->Cell(2,4,':',4,0,'L');
				// $pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
				
			$pdf->Output("hasil.pdf","I");	;
	
