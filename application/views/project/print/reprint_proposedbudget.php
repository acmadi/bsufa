<?php
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('L','mm','A4');
			$pt = 44;
			$pdf->SetMargins(20,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			$rowdata = $this->db->where('mainjob_id',$id)->get('db_mainjob')->row();
			
			$tglmain = inggris_date($rowdata->mainjob_date);
			//$rowdata = $this->db->query("sp_Insbgtproj '".$tglmain."','".$no_prop."','".$job."',".$pt."")->row();
			#HEAD
			#HEADER CONTENT
				$pt			= "PT. GRAHA MULTI INSANI";
				$judul 		= "PROPOSED PROJECT BUDGET";
				$periode	= "";
	
			#CETAK TANGGAL
				$tglcetak  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tglcetak,0,0,'L');
			
			#Header
				$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'',20,0,'L');
		
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				
			// Start Isi Tabel
			
	
		
			$pdf->SetFont('Arial','B',15);
			$pdf->Ln(4);
						
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,'Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(30,5,indo_date($rowdata->mainjob_date),10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,5,'Job',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(65,5,$rowdata->mainjob_desc,10,0,'L',0);
			$pdf->Ln(10);
			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(90,5,'Job',1,0,'C',1);
			$pdf->Cell(80,5,'Project Budget Alocation',1,0,'C',1);
			$pdf->Cell(30,5,'Total Budget',1,0,'C',1);
			$pdf->Cell(30,5,'Proposed Budget',1,0,'C',1);
			$pdf->Cell(30,5,'Balanced Budget',1,0,'C',1);
			
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 15;	
			$pdf->Ln(5);
			
	$data = $this->db->select('left(main_job,60) as job, nm_bgtproj,total_bgt,nilai_proposed')		
					 ->join('db_bgtproj_update','kd_bgtproj = kode_bgtproj','left')
					 ->where('no_trbgtproj',$rowdata->no_trbgtproj)
					 ->group_by('main_job, nm_bgtproj,total_bgt,nilai_proposed')
					 ->get('db_trbgtproj')->result();
	$total = 0;
	$totbgt = 0;
	$totblc = 0;		 
	foreach($data as $row){
		/*if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "Graha Multi Insani";
				$judul 		= "";
				$periode	= "";
				
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
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'',20,0,'L');
			
				$pdf->Ln(10);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
			
			
			#start Tabel
			#$pdf->SetX(2);
			#$pdf->SetFont('Arial','B',10);
			#$pdf->Ln(4);
			#$pdf->Cell(8,5,'',1,0,'C',1);
			#$pdf->Cell(65,5,'Proposed Budget',1,0,'C',1);
			#$pdf->Ln(5);

			#$pdf->SetFont('Arial','B',7);
			#$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(90,5,'Detail Job',1,0,'C',1);
			$pdf->Cell(80,5,'Budget Description',1,0,'C',1);
			$pdf->Cell(30,5,'Total Budget',1,0,'C',1);
			$pdf->Cell(30,5,'Proposed Budget',1,0,'C',1);
			#$pdf->Cell(30,5,'Balanced Budget',1,0,'C',1);
			
			
			
			
			$pdf->Ln(5);
			$noo = 0;
	
			
		}*/
			#$a = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa4";
			$total = $total + $row->nilai_proposed;
			$totbgt = $totbgt +  $row->total_bgt;
			$pdf->SetFont('Arial','',8);
			$blc = $row->total_bgt - $row->nilai_proposed;
			$totblc = $totblc + $blc;
			$pdf->Cell(8,5,$no,1,0,'C',0);
			$pdf->Cell(90,5,$row->job,1,0,'L',0);
			$pdf->Cell(80,5,$row->nm_bgtproj,1,0,'L',0);
			$pdf->Cell(30,5,number_format($row->total_bgt),1,0,'R',0);
			$pdf->Cell(30,5,number_format($row->nilai_proposed),1,0,'R',0);
			$pdf->Cell(30,5,number_format($blc),1,0,'R',0);
		
			$pdf->Ln(5);		
			$i++;
			$no++;
			$noo++;
		
	}
			$pdf->SetFont('Arial','B',8);
	  	
			//$pdf->Cell(8,5,$no,1,0,'C',0);
			#$pdf->Cell(8,5,'',10,0,'C',0);
			#$pdf->Cell(90,5,'',10,0,'L',0);
			#$pdf->Cell(80,5,'',10,0,'L',0);
			#$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Cell(178,5,'T O T A L',1,0,'R',1);
			$pdf->Cell(30,5,number_format($totbgt),1,0,'R',1);
			$pdf->Cell(30,5,number_format($total),1,0,'R',1);
			$pdf->Cell(30,5,number_format($totblc),1,0,'R',1);
			$pdf->Ln(30);
			
			
			
			$pdf->SetFont('Arial','B',10);
			if($total <= 300000){
			
			$pdf->Cell(40,8,'Proposed by:',1,0,'L',0);
			$pdf->Cell(40,8,'Approved by:',1,0,'L',0);
			
			$pdf->Ln(8);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			
			$pdf->Ln(35);
			$pdf->Cell(40,8,'User',1,0,'C',0);
			$pdf->Cell(40,8,'FAM',1,0,'C',0);
			
		}
			elseif($total > 300000 and $total <= 30000000){
			
			$pdf->Cell(40,8,'Proposed by:',1,0,'L',0);
			$pdf->Cell(80,8,'Approved by:',1,0,'L',0);
			
			$pdf->Ln(8);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			
			$pdf->Ln(35);
			$pdf->Cell(40,8,'User',1,0,'C',0);
			$pdf->Cell(40,8,'GM',1,0,'C',0);
			$pdf->Cell(40,8,'FC',1,0,'C',0);
			
		}
			elseif($total > 30000000 and $total <= 150000000){
			
			$pdf->Cell(40,8,'Proposed by:',1,0,'L',0);
			$pdf->Cell(160,8,'Approved by:',1,0,'L',0);
			
			$pdf->Ln(8);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			
			$pdf->Ln(35);
			$pdf->Cell(40,8,'User',1,0,'C',0);
			$pdf->Cell(40,8,'FC',1,0,'C',0);
			$pdf->Cell(40,8,'GM',1,0,'C',0);
			$pdf->Cell(40,8,'CFO BSU',1,0,'C',0);
			$pdf->Cell(40,8,'DIREKTUR GMI',1,0,'C',0);
			
		}
			
			elseif($total > 150000000){
			$pdf->Cell(40,8,'Proposed by:',1,0,'L',0);
			$pdf->Cell(200,8,'Approved by:',1,0,'L',0);
			
			$pdf->Ln(8);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			
			$pdf->Ln(35);
			$pdf->Cell(40,8,'User',1,0,'C',0);
			$pdf->Cell(40,8,'FC',1,0,'C',0);
			$pdf->Cell(40,8,'GM',1,0,'C',0);
			$pdf->Cell(40,8,'CFO BSU',1,0,'C',0);
			$pdf->Cell(40,8,'DIREKTUR GMI',1,0,'C',0);
			$pdf->Cell(40,8,'DIREKTUR UTAMA GMI',1,0,'C',0);
			#$pdf->Cell(30,5,'',1,0,'R',0);
		} 
			else{
			die('Total Tidak ada di range Nilai');
				
				}
			
		
		
			$pdf->Output("hasil.pdf","I");	;
	
