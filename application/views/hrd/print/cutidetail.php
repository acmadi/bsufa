<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			#die($dipisi);
			$pdf=new PDF('L','mm','A4');
			
			$divis = $this->db->select('divisi_nm')->where('divisi_id',$div)->get('db_divisi')->row();
			
			$querysum = $this->db->query("sp_summaryleaving '".$years."','".$div."'")->result();
			
			#var_dump($querysum->lama);exit();
			
			$pdf->SetMargins(10,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "Bakrie Swasakti Utama";
				$judul 		= "Summary Leaving per Division Report";
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
			
				$pdf->SetFont('Arial','',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Divisi'.' : '. $divis->divisi_nm,20,0,'L');
				$pdf->SetXY(25,28);
				$pdf->Cell(0,10,'Periode'.' : '. $years,20,0,'L');
				
				
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
			
			// Start Isi Tabel
			
		
		
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(4);
			
			$pdf->Cell(8,12,'No',1,0,'C',1);
			$pdf->Cell(65,12,'Nama',1,0,'C',1);
			$pdf->Cell(25,12,'Join Date',1,0,'C',1);
			$pdf->Cell(25,6,'Saldo Akhir','T'.'L'.'R',0,'C',1);
			$pdf->Cell(75,6,'Saldo Awal '.$years,1,0,'C',1);
			$pdf->Cell(75,6,'Cuti Berjalan '.$years,1,0,'C',1);
			$pdf->Ln(6);
			$pdf->Cell(8,0,'',10,0,'C',1);
			$pdf->Cell(65,0,'',10,0,'C',1);
			$pdf->Cell(25,0,' ',10,0,'C',1);
			$pdf->Cell(25,6,$years-1,'B'.'L'.'R',0,'C',1);
			$pdf->Cell(25,6,'Cuti Tahunan',1,0,'C',1);
			$pdf->Cell(25,6,'Cuti Besar',1,0,'C',1);
			$pdf->Cell(25,6,'Total',1,0,'C',1);
			$pdf->Cell(25,6,'Cuti Bersama',1,0,'C',1);
			$pdf->Cell(25,6,'Pemakaian',1,0,'C',1);
			$pdf->Cell(25,6,'Sisa',1,0,'C',1);
			
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 22;	
			$pdf->Ln(6);
			
			//~ $query = "select nama,saldo_awal,cuti_bersama, saldo_cuti as saldo_cuti, isnull(tgl_join,'-') as tgl_join, isnull((select sum(aju_cuti) from db_karycuti where
			//~ kary_id=a.id_kary and year(startdate_cuti) = '".($years)."' ),0)+ cuti_bersama as used,isnull((((saldo_cuti )-(select sum(aju_cuti) from db_karycuti where
			//~ kary_id=a.id_kary and year(startdate_cuti) = '".($years)."' ))),0)-cuti_bersama as balance, divisi_nm
						//~ from db_kary a 
						//~ left join db_karycutipar b	on a.id_kary=b.karyawan_id 
						//~ inner join db_divisi c on a.id_divisi=c.divisi_id
						//~ where divisi_id = $div and isnull(a.id_flag,0) != 10 and (b.thn) = '".($years)."'
						//~ ";
			//~ $query = "select nama,saldo_awal,cuti_bersama, saldo_cuti as saldo_cuti, isnull(tgl_join,'-') as tgl_join,  as used,saldo_cuti - (isnull((select sum(aju_cuti) from db_karycuti where
			//~ kary_id=a.id_kary and year(startdate_cuti) = '".($years)."' ),0)+ cuti_bersama)as balance, divisi_nm
						//~ from db_kary a 
						//~ left join db_karycutipar b	on a.id_kary=b.karyawan_id 
						//~ inner join db_divisi c on a.id_divisi=c.divisi_id
						//~ where divisi_id = $div and isnull(a.id_flag,0) != 10 and (b.thn) = '".($years)."'
						//~ ";			
			//~ 
		
			
			
					
	foreach ($querysum as $row){		
	#for($i = 1;$i <= 200; $i++){
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEAD
			#HEADER CONTENT
				$pt			= "Bakrie Swasakti Utama";
				$judul 		= "Summary Leaving per Division Report";
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
			
				$pdf->SetFont('Arial','',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Divisi'.' : '. $divis->divisi_nm,20,0,'L');
				$pdf->SetXY(25,28);
				$pdf->Cell(0,10,'Periode'.' : '. $years,20,0,'L');
				
				
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
								
			
			// Start Isi Tabel
			
		
		
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(4);
			
			$pdf->Cell(8,12,'No',1,0,'C',1);
			$pdf->Cell(65,12,'Nama',1,0,'C',1);
			$pdf->Cell(25,12,'Join Date',1,0,'C',1);
			$pdf->Cell(25,6,'Saldo Akhir','T'.'L'.'R',0,'C',1);
			$pdf->Cell(75,6,'Saldo Awal '.$years,1,0,'C',1);
			$pdf->Cell(75,6,'Cuti Berjalan '.$years,1,0,'C',1);
			$pdf->Ln(6);
			$pdf->Cell(8,0,'',10,0,'C',1);
			$pdf->Cell(65,0,'',10,0,'C',1);
			$pdf->Cell(25,0,' ',10,0,'C',1);
			$pdf->Cell(25,6,$years-1,'B'.'L'.'R',0,'C',1);
			$pdf->Cell(25,6,'Cuti Tahunan',1,0,'C',1);
			$pdf->Cell(25,6,'Cuti Besar',1,0,'C',1);
			$pdf->Cell(25,6,'Total',1,0,'C',1);
			$pdf->Cell(25,6,'Cuti Bersama',1,0,'C',1);
			$pdf->Cell(25,6,'Pemakaian',1,0,'C',1);
			$pdf->Cell(25,6,'Sisa',1,0,'C',1);
			
			$pdf->Ln(6);
			$noo = 0;
	
			
		}
	$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$pdf->SetFont('Arial','',10);
			//~ $pdf->Cell(8,5,$no,1,0,'C',0);
			//~ $pdf->Cell(65,5,$row->nama,1,0,'L',0);
			//~ $pdf->Cell(25,5,indo_date($row->tgl_join),1,0,'R',0);
			//~ #$pdf->Cell(20,5,$row->saldo_cuti,1,0,'R',0);
			//~ $pdf->Cell(25,5,$row->saldo_cuti,1,0,'R',0);
			//~ $pdf->Cell(25,5,$row->cuti_bersama,1,0,'R',0);
			//~ $pdf->Cell(25,5,$row->used,1,0,'R',0);
			//~ $pdf->Cell(25,5,$row->balance,1,0,'R',0);
			#var_dump($row->lama);exit();
			$pdf->Cell(8,6,$no,1,0,'C',0);
			$pdf->Cell(65,6,$row->nama,1,0,'L',0);
			$pdf->Cell(25,6,indo_date($row->tgl_join),1,0,'C',0);
			$pdf->Cell(25,6,$row->saldo_awal,1,0,'C',0);
			
			if($row->lama <=6){
			$a = 12;
			$b = 0;
			$pdf->Cell(25,6,$a,1,0,'C',0);
			$pdf->Cell(25,6,$b,1,0,'C',0);
			$c = $a + $b;
			
		}else{
			$a = 0;
			$b = 21;
			$pdf->Cell(25,6,$a,1,0,'C',0);
			$pdf->Cell(25,6,$b,1,0,'C',0);
			$c = $a + $b;
		}
			$d = $row->saldo_awal + $c;
			
		
			$pdf->Cell(25,6,$d,1,0,'C',0);
		
			$pdf->Cell(25,6,$row->cuti_bersama,1,0,'C',0);
			$pdf->Cell(25,6,$row->used,1,0,'C',0);
			
			$y = $d + ($row->cuti_bersama + $row->used);
			$pdf->Cell(25,6,$y,1,0,'C',0);
			
		
			$pdf->Ln(6);		
			$i++;
			$no++;
			$noo++;
		 
	}
			$pdf->SetFont('Arial','B',6);
	  	
			//~ //$pdf->Cell(8,5,$no,1,0,'C',0);
			//~ $pdf->Cell(73,5,'GRAND TOTAL',1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'L',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'C',1);
			//~ $pdf->Cell(20,5,number_format(1000000000),1,0,'R',1);
		//~ $pdf->Ln(10);
		
		//~ $pdf->SetFont('Arial','',6);
				//~ $pdf->SetX(180);
				//~ $pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				//~ $pdf->Cell(2,4,':',4,0,'L');
				//~ $pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");	;
	
