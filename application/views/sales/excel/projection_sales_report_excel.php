<?php
	extract(PopulateForm());
	$session_id = $this->UserLogin->isLogin();
	$pt = $session_id['id_pt'];
	$data_pt = $this->mstmodel->get_nama_pt($pt);
	$nama_pt = "PT. \t".$data_pt['ket'];
			
	#$start_date = inggris_date($start_date);
	#$end_date	= inggris_date($end_date);
			
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
	$judul 		= "PROJECTION COLLECTION SUMMARY REPORT";
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
	#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
	$pdf->SetFont('Arial','B',12);
	
	$pdf->SetX(25);
	$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
	$pdf->SetFont('Arial','',10);
	#$pdf->SetFont('Arial','B',12);		
	$pdf->SetXY(25,16);
	$pdf->Cell(0,10,$judul.' - '.$thn,20,0,'L');
			
	#$pdf->ln(4);
	#$pdf->SetX(25);
	#$pdf->Cell(20,10,'Tahun '.$thn,20,0,'L');
			
	#$pdf->SetFont('Arial','',6);
	#$pdf->Cell(15,10,': '.$month1,0,0,'L');
	#$pdf->Cell(20,10,'To '.$month2,0,0,'L');
				
						
	#$pdf->SetFont('Arial','B',8);
	$pdf->SetXY(30,40);
			
			
	#HEADER TABLE
			
	$y_axis_initial = 40;
	$y_axis = 0;
	$pdf->SetFont('Arial','',6);
	$pdf->setFillColor(222,222,222);
	$pdf->SetY($y_axis_initial);
	$pdf->SetX(3);
	$pdf->Cell(5,3,'No',1,0,'C',0);
	$pdf->Cell(25,3,'PROJECT',1,0,'C',0);
	$pdf->Cell(15,3,'Jan',1,0,'C',0);
	$pdf->Cell(15,3,'Feb',1,0,'C',0);
	$pdf->Cell(15,3,'Mar',1,0,'C',0);
	$pdf->Cell(15,3,'Apr',1,0,'C',0);
	$pdf->Cell(15,3,'May',1,0,'C',0);
	$pdf->Cell(15,3,'Jun',1,0,'C',0);
	$pdf->Cell(15,3,'Jul',1,0,'C',0);
	$pdf->Cell(15,3,'Aug',1,0,'C',0);
	$pdf->Cell(15,3,'Sep',1,0,'C',0);
	$pdf->Cell(15,3,'Oct',1,0,'C',0);
	$pdf->Cell(15,3,'Nov',1,0,'C',0);
	$pdf->Cell(15,3,'Dec',1,0,'C',0);								
	$pdf->Cell(15,3,'TOTAL',1,0,'C',0);
			
			$pdf->setFillColor(222,222,222);
			#TAHUN BERIKUTNYA
		 	for($i = 1;$i <= 3; $i++){
				$year = $thn + $i;
				$pdf->Cell(15,3,$year,1,0,'C',1);
			}		
	
	
	
	$pdf->Ln();
	#RESET VARIABLE
	$pdf->SetFont('Arial','',5);
	$pdf->SetX(3);
	$pdf->Cell(5,4,'1',1,0,'C',0);
	$pdf->Cell(25,4,'AWANA CONDOTEL',1,0,'L',0);
	$tot1 = 0;
	for($i = 1;$i <= 12; $i++){
		$sql    = "select sum(amount) - sum(isnull(pay_amount,0)) as balance 
							from db_billing
				  
							JOIN db_sp on(id_sp = sp_id)
							
							where datepart(mm,due_date) = '$i' 
							and datename(yy,due_date) ='$thn'
							and id_subproject = '41012'
							";
					$rows = $this->db->query($sql)->row();			   
					$balance = $rows->balance;
					$tot1 = $tot1 + $balance;			   
					$pdf->Cell(15,4,number_format($balance),1,0,'R',0);
	}
		$pdf->SetFont('Arial','B',5);
		$pdf->Cell(15,4,number_format($tot1),1,0,'R',0);
		
		
		#TAHUN BERIKUTNYA
		$pdf->setFillColor(222,222,222);
		$grandtot1 =0;
		 	for($i = 1;$i <= 3; $i++){
				$year = $thn + $i;
				$sql    = "select sum(amount) - sum(isnull(pay_amount,0)) as balance 
							from db_billing
				  
							JOIN db_sp on(id_sp = sp_id)
							
							where datepart(mm,due_date) = '$i' 
							and datename(yy,due_date) ='$year'
							and id_subproject = '41012'
							";
					$rows = $this->db->query($sql)->row();			   
					$balance = $rows->balance;
					$grandtot1 = $grandtot1 + $balance;			   
					$pdf->Cell(15,4,number_format($balance),1,0,'R',1);
				
					
			}		
		 
		
		
		$pdf->SetFont('Arial','',5);
		$pdf->Ln(4);
		$pdf->SetX(3);
		$pdf->Cell(5,4,'2',1,0,'C',0);
		$pdf->Cell(25,4,'AWANA TOWN HOUSE',1,0,'L',0);
		$tot2 = 0;
		
		#TOTAL TOWN HOUSE
		for($i = 1;$i <= 12; $i++){
			$sql    = "select sum(amount) - sum(isnull(pay_amount,0)) as balance 
							from db_billing
				  
							JOIN db_sp on(id_sp = sp_id)
							
							where datepart(mm,due_date) = '$i' 
							and datename(yy,due_date) ='$thn'
							and id_subproject = '41011'
							";
					$rows = $this->db->query($sql)->row();			   
					$balance = $rows->balance;
					$tot2 = $tot2 + $balance;			   
					$pdf->Cell(15,4,number_format($balance),1,0,'R',0);
	}
		
		
		$pdf->SetFont('Arial','B',5);
		$pdf->Cell(15,4,number_format($tot2),1,0,'R',0);
			#TAHUN BERIKUTNYA
			$pdf->setFillColor(222,222,222);
			$grandtot2 =0;
		 	for($i = 1;$i <= 3; $i++){
				$year = $thn + $i;
				$sql    = "select sum(amount) - sum(isnull(pay_amount,0)) as balance 
							from db_billing
				  
							JOIN db_sp on(id_sp = sp_id)
							
							where datepart(mm,due_date) = '$i' 
							and datename(yy,due_date) ='$year'
							and id_subproject = '41011'
							";
					$rows = $this->db->query($sql)->row();			   
					$balance = $rows->balance;
					$grandtot2 = $grandtot2 + $balance;			   
					$pdf->Cell(15,4,number_format($balance),1,0,'R',1);
				
					
			}		
		
		 
			
			$pdf->Ln(4);													
			$pdf->SetX(33);
			for($i = 1;$i <= 12; $i++){
			
			$sql    = "select sum(amount) - sum(isnull(pay_amount,0)) as balance 
							from db_billing
				  
							JOIN db_sp on(id_sp = sp_id)
							
							where datepart(mm,due_date) = '$i' 
							and datename(yy,due_date) ='$thn'
							
							";
					$rows = $this->db->query($sql)->row();			   
					$balance = $rows->balance;
			$tot2 = $tot2 + $balance;			   
			
			
			$pdf->Cell(15,4,number_format($balance),1,0,'R',0);
		}
			#GRAND TOTAL
			$grandtot = $tot1 + $tot2;
			$pdf->Cell(15,4,number_format($grandtot),1,0,'R',0);
			
			#TAHUN BERIKUTNYA
			$pdf->setFillColor(222,222,222);
			$grandtot3 =0;
		 	for($i = 1;$i <= 3; $i++){
				$year = $thn + $i;
				$sql    = "select sum(amount) - sum(isnull(pay_amount,0)) as balance 
							from db_billing
				  
							JOIN db_sp on(id_sp = sp_id)
							
							where datepart(mm,due_date) = '$i' 
							and datename(yy,due_date) ='$year'
							
							";
					$rows = $this->db->query($sql)->row();			   
					$balance = $rows->balance;
					$grandtot3 = $grandtot3 + $balance;			   
					$pdf->Cell(15,4,number_format($balance),1,0,'R',1);
				
					
			}		
			
			
			$pdf->SetX(3,100);
			$pdf->Cell(30,4,'TOTAL',1,0,'R',0);
	
	
	$pdf->Output("history.pdf","I");
				

			
			
			
