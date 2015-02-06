<?php
			require('fpdf/tanpapage.php');
			#die($idno);
			$data = $this->db->join('db_mstbgt','code = code_id')
							 ->join('db_divisi','db_divisi.divisi_id = db_trbgtdiv.divisi_id')
							 ->where('id_trbgt',$idno)
							 ->get('db_trbgtdiv')
							 ->row();


#budget anual
$bgtan = $this->db->select('tot_mst')
			  ->where('thn',$data->divthn)
			  ->where('code',$data->code_id)
			  ->where('id_pt',$data->id_pt)
			  ->get('db_mstbgt')->row();

#budget YTD
$bgh = "select sum(appamount) as a from db_trbgtdiv where code_id = '".$data->code_id."' and divthn = '".$data->divthn."' and apptanggal <= getdate()";
$bgcr = $this->db->query($bgh)->row();
#var_dump($bgcr);exit();			  



			$pdf=new PDF('P','mm','A4');
			
			$pdf->SetMargins(10,5,10);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			
			
			#HEAD
			#HEADER CONTENT
				
				
				#$judul 		= "Taman Rasuna Apartemen - Combined";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tglcetak  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,'',0,0,'L');
			
			#Header
				#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
				if($data->id_pt == 11){
					$pt = "PT. Bakrie Swasakti Utama";
				}elseif($data->id_pt == 22){
					$pt = "PT. Bumi Daya Makmur";
				
				}elseif($data->id_pt == 33){
					$pt = "PT. Bakrie Pesona Rasuna";
				
				}elseif($data->id_pt == 44){
					$pt = "PT. Graha Multi Insani";
				
				}elseif($data->id_pt == 55){
					$pt = "PT. Provices Indonesia";
				}else{
					$pt = "gagal query";
				}
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,@$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'BUDGED '.$data->divthn,20,0,'L');
				$pdf->Ln(10);
				#$pdf->SetXY(25,22);
				#$pdf->Cell(0,10,'',20,0,'L');
		
				#$pdf->Ln(5);
				
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				
			// Start Isi Tabel
			
	
		 
			$pdf->SetFont('Arial','B',15);
			$pdf->Ln(4);
						
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(190,10,'BUDGET MONITORING',20,0,'C');
			
			$pdf->Ln(13);
			$pdf->Cell(190,0,'',1,0,'C');
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Account Title',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(117,5,$data->code_id,10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Sub Account',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(117,5,substr($data->description,10,100),10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Status',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(117,5,$data->status_bgt,10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Annual Budget',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,number_format($bgtan->tot_mst),10,0,'R',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Budget Year To Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,number_format($bgcr->a),10,0,'R',0);
			$pdf->Ln(13);
			
			
			$total = 3000001212;
			
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(190,10,'REQUEST',20,0,'C');
			
			$pdf->Ln(13);
			$pdf->Cell(190,0,'',1,0,'C');
			$pdf->Ln(5);
			
			
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,date("d-m-Y"),10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Divisi / Unit',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,$data->divisi_nm,10,0,'L',0);
			$pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Ln(5);
			//~ $pdf->Cell(75,5,'P I C',10,0,'L',0);
			//~ $pdf->Cell(8,5,':',10,0,'C',0);
			//~ $pdf->Cell(77,5,'TP',10,0,'L',0);
			//~ $pdf->Cell(30,5,'',10,0,'R',0);
			$pdf->Ln(10);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(79,5,'Value Allocation For :',10,0,'L',0);
			$pdf->Cell(83,5,'',10,0,'L',0);
			$pdf->Cell(63,5,'',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->Cell(79,5,'PROJECT',10,0,'L',0);
			$pdf->Cell(83,5,'Alokasi %',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			
			#alokasi project
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Taman Rasuna',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'ROP',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Wisma Bakrie 1',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Wisma Bakrie 2',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			$pdf->Ln(5);
			
			$pdf->SetX(15);
			$pdf->Cell(79,5,'Tower 18',10,0,'L',0);
			$pdf->Cell(83,5,'0.38',10,0,'L',0);
			$pdf->Cell(63,5,'VALUE (In-Rp.)',10,0,'L',0);
			#$pdf->Ln(5);
			#end alokasi project
#budget YTD Request
$yds = "select sum(amount) as b from db_trbgtdiv where code_id = '".$data->code_id."' and divthn = '".$data->divthn."' and tanggal <= getdate()";
$bgr = $this->db->query($yds)->row();			
#balance YTD
$blcytd = $bgtan->tot_mst - $bgcr->a;	
#balance anual 
$blcan = $bgtan->tot_mst - 	$bgr->b	;
			$pdf->Ln(10);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(75,5,'Request Amount',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,number_format($data->amount),10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Year To Date Request',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,number_format($bgr->b),10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Balance - Year To Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,number_format($blcytd),10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Balance - Annual Budget',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,number_format($blcan),10,0,'R',0);
			$pdf->Ln(5);
			$pdf->Cell(75,5,'Year To Date request To Annual Budget Percentage',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(77,5,'(In-Rp.)',10,0,'L',0);
			$pdf->Cell(30,5,'0',10,0,'R',0);
			$pdf->Ln(13);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(20,5,'Remark',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(190,5,$data->remark,10,0,'L',0);
			
			
			
			$pdf->Ln(13);
			$pdf->Cell(190,0,'',1,0,'C');
			$pdf->Ln(5);
			
			
			
			
			$pdf->Ln(8);
			$pdf->Cell(30,5,'Verified Date',10,0,'L',0);
			$pdf->Cell(8,5,':',10,0,'C',0);
			$pdf->Cell(63,5,indo_date($data->apptanggal),10,0,'L',0);
		$pdf->Ln(5);
		
			
			$pdf->SetFont('Arial','',10);
			if($data->amount > 30000000){
			
			$pdf->Cell(79,5,'Verified by :',10,0,'L',0);
			$pdf->Cell(83,5,'Acknowledge by :',10,0,'L',0);
			$pdf->Cell(63,5,'Approved by :',10,0,'L',0);
			$pdf->Ln(30);
			
			
			
			$pdf->Cell(79,5,'('.' Administrator '.')',10,0,'L',0);
			$pdf->Cell(83,5,'('.' Azman '.')',10,0,'L',0);
			$pdf->Cell(63,5,'('.' BOD '.')',10,0,'L',0);
			
			}else{
			$pdf->Cell(98,5,'Proposed by :',10,0,'C',0);
			$pdf->Cell(80,5,'Approved by :',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			
			$pdf->Ln(30);
			
			
			
			$pdf->Cell(98,5,'(Project Manager)',10,0,'L',0);
			$pdf->Cell(80,5,'(General Manager)',10,0,'C',0);
			$pdf->Cell(40,5,'',10,0,'R',0);
			
			
				
				}
			
			
		
		
			$pdf->Output("hasil.pdf","I");	;
	
