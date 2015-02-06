<?php
	require('fpdf/tanpapage.php');
	include_once( APPPATH."libraries/translate_currency.php"); 
	
	
	
	$rows = $this->db->query("sp_print_tendereval ".$id_ten."")->row();
	$win = $this->db->query("sp_print_tenderwinner ".$id_ten."")->row();
			
	$pdf=new PDF('L','mm','A4');
	$pdf->SetMargins(2,10,2);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',14);
	$pdf->SetMargins(2,10,2);
	
		
						
	#HEADER 
	$judul 		= "TENDER EVALUATION";
	$periode	= "As Off";
	$date		= $rows->date_tendeva;
	$project	= '';
	$angka		=  $rows->offer_ven;
	$contractor	= $rows->nm_supplier;
	$job		= $rows->job;
	
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
			
	$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',12);
	$pdf->SetX(25);
	$pdf->Cell(0,10,'PT. GRAHA MULTI INSANI',20,0,'L');
	$pdf->Ln(8);
	
	#$pdf->SetFont('Arial','',11);
	#$pdf->SetX(25);
	#$pdf->Cell(0,5,'Project '.$project,20,0,'L');
	#$pdf->Ln(5);
	
	$pdf->SetFont('Arial','',9);
	$pdf->SetX(25);
	$pdf->Cell(0,5,$judul,20,0,'L');
	$pdf->Ln(5);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetX(25);

	$pdf->Ln(10);
	
	$pdf->Cell(0,0,'',1,10,'L',1);		
	$pdf->Ln(5);
	
	
	#CONTENT
	$pdf->SetX(5);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(40,3,'Date',20,0,'L');
	$pdf->Cell(2,3,':',20,0,'L');
	$pdf->Cell(40,3,indo_date($rows->date_tendeva),0,1,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(5);
	$pdf->Cell(40,3,'Budget Reff',20,0,'L');
	$pdf->Cell(2,3,':',20,0,'L');
	$pdf->Cell(40,3,$rows->no_tendeva,0,1,'L');
	$pdf->Ln(3);
	
	$pdf->SetX(5);
	$pdf->Cell(40,3,'Main Job',20,0,'L');
	$pdf->Cell(2,3,':',20,0,'L');
	$pdf->Cell(40,3,$rows->mainjob_desc,0,1,'L');
	$pdf->Ln(3);
	
	
	$pdf->SetX(5);
	$pdf->Cell(40,3,'Budget Amount (Rp)',20,0,'L');
	$pdf->Cell(2,3,':',20,0,'L');
	$pdf->Cell(28,3,number_format($rows->mainjob_total),0,1,'R');
	$pdf->Ln(3);
	
	$pdf->SetX(5);
	$pdf->Cell(40,3,'Tender Amount (Rp)',20,0,'L');
	$pdf->Cell(2,3,':',20,0,'L');
	$pdf->Cell(28,3,number_format($win->nilai_tender),0,1,'R');
	$pdf->Ln(3);
	
	$pdf->SetX(5);
	$pdf->Cell(40,3,'Job',20,0,'L');
	$pdf->Cell(2,3,':',20,0,'L');
	$pdf->Cell(40,3,$rows->job,0,1,'L');
	$pdf->Ln(3);
	

	
	$pdf->SetX(5);
	$pdf->Cell(40,3,'Tender Winner',20,0,'L');
	$pdf->Cell(2,3,':',20,0,'L');
	$pdf->Cell(40,3,$win->nm_supplier,0,1,'L');
	$pdf->Ln(3);
	
	
	
	#TABLE HEADER
	$pdf->SetFont('Arial','B',8);
	$pdf->setFillColor(222,222,222);
	$pdf->SetX(5);
	$pdf->Cell(6,10,'No',1,0,'L',1);
	$pdf->Cell(55,10,'Tender Participant',1,0,'C',1);
	$pdf->Cell(25,10,'Offering',1,0,'C',1);
	$pdf->Cell(25,10,'Final Nego',1,0,'C',1);
	$pdf->Cell(25,10,'Saving',1,0,'C',1);
	$pdf->Cell(10,10,'Score',1,0,'C',1);
	$pdf->Cell(140,10,'Remark',1,0,'C',1);
	$pdf->Ln(10);
	
	#$pdf->Cell(25,10,'Amount (Excl. Tax',1,0,'C',1);
	
	$id = $rows->mainjob_id;
	#ROW DATA
	$sql = "select nm_supplier,offer_ven,nego_ven,score_ven,remark_ven from db_participant a 
			join pemasokmaster b on b.kd_supp_gb = a.id_vendor
			where a.id_mainjob = '$id' 
			group by nm_supplier,offer_ven,nego_ven,score_ven,remark_ven";


	$cek  = $this->db->query($sql)->result();
	
	$i = 1;	
	$no = 0;
	
	$totsaving = 0;
	
	foreach($cek as $row){
			
			#$totsaving = $totsaving + $saving;
			$pdf->SetX(5);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(6,6,$i,1,0,'C');
			
			$pdf->Cell(55,6,$row->nm_supplier,1,0,'L');
			$pdf->Cell(25,6,number_format($row->offer_ven),1,0,'R');
			$pdf->Cell(25,6,number_format($row->nego_ven),1,0,'R');
			$saving = $row->offer_ven - $row->nego_ven;
			$pdf->Cell(25,6,number_format($saving),1,0,'R');
			
			$pdf->Cell(10,6,$row->score_ven,1,0,'C');
			$pdf->Cell(140,6,$row->remark_ven,1,0,'L');
			
			
			$pdf->Ln(6);
			$i++;
}
			
	
	//~ #TOTAL ROW DATA
	//~ $pdf->SetFont('Arial','B',7);
	//~ #$pdf->setFillColor(222,222,222);
	//~ #$pdf->SetX(5);
	//~ #$pdf->Cell(111,8,'T O T A L',1,0,'R',1);
	//~ #$pdf->Cell(25,8,number_format($totsaving),1,0,'R',1);
	//~ #$pdf->Cell(150,8,'',1,0,'R',1);
	//~ 
	//~ 
	//~ #APPROVAL
	//~ $pdf->SetXY(5,150);
	//~ $pdf->Cell(40,5,'Prepared By :',1,0,'L');
	//~ $pdf->Cell(80,5,'Approved By :',1,0,'L');
	//~ 
	//~ $pdf->SetXY(5,155);
	//~ $pdf->Cell(40,30,'',1,0,'L');
	//~ $pdf->Cell(80,30,'',1,0,'L');
	
	#die($win->nilai_tender);
	$pdf->SetX(5);
	$pdf->Ln(8);
	
	$pdf->SetFont('Arial','B',10);
			if($win->nilai_tender <= 300000){
			
			$pdf->Cell(40,8,'Proposed by:',1,0,'L',0);
			$pdf->Cell(40,8,'Approved by:',1,0,'L',0);
			
			$pdf->Ln(8);
			$pdf->Cell(40,35,'',1,0,'R',0);
			$pdf->Cell(40,35,'',1,0,'R',0);
			
			$pdf->Ln(35);
			$pdf->Cell(40,8,'User',1,0,'C',0);
			$pdf->Cell(40,8,'FAM',1,0,'C',0);
			
		}
			elseif($win->nilai_tender > 300000 and $win->nilai_tender <= 30000000){
			
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
			elseif($win->nilai_tender > 30000000 and $win->nilai_tender <= 150000000){
			
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
			
			elseif($win->nilai_tender > 150000000){
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
		
	$pdf->Output("kontrakstatuss.pdf","I");


