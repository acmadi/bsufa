<?php
			#die('tes');
			extract(PopulateForm());
			#var_dump($cek);
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			$start_date = inggris_date($startdate);
			$end_date	= inggris_date($enddate);
			
			#var_dump(@$cek);
			#SUMMARY SALES REPORT
			#if(@$cek == '1'){
				
				#IF($pt == 44){
				#$rows = $this->db->query("SoldUnit ");
				#$data = $rows->result();
				#}
				#ELSE{
				#$rows = $this->db->query("SoldUnitProject ".$pt."");
				#$data = $rows->result();				
				#}
				
				#$rows = $this->db->query("StokUnit ");
				#$data = $rows->result();
				
				#$nmsubproject= $rows->projectname;
				#var_dump($rows);
				#$data = $rows;
				#foreach ( )
				#require('fpdf/classreport.php');
				#	$pdf=new PDF('L','mm','A4');
				#	$pdf->SetMargins(10,0,0,5);
				#	$pdf->AliasNbPages();
				#	$pdf->AddPage();
				#	$pdf->SetFont('Arial','B',14);
				#	$pdf->SetMargins(2,10,2);
		
			
			
					#HEADER CONTENT
			
				#		$judul 		= "SALES SUMMARY REPORT";
				#		$periode	= "Periode";
			
			
			
			
							#Header
						#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
						#pdf->SetFont('Arial','B',12);
				#		$pdf->SetFont('Arial','B',12);
				#		$pdf->SetX(25);
				#		$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
				#		$pdf->SetFont('Arial','B',12);		
				#		$pdf->SetXY(25,16);
				#		$pdf->Cell(0,10,$judul,20,0,'L');
			
						#$pdf->SetFont('Arial','B',12);		
						#$pdf->SetXY(62,16);
						#$pdf->Cell(0,10,$nmsubproject,20,0,'L');
			
			
				#		$pdf->ln(8);
				#		$pdf->SetX(25);
				#		$pdf->Cell(20,10,$periode,20,0,'L');
			
				#		$pdf->SetFont('Arial','',9);
				#		$pdf->Cell(20,10,': '.indo_date($start_date),0,0,'L');
				#		$pdf->Cell(20,10,'To  '.indo_date($end_date),0,0,'L');
				
						
				#			$pdf->SetFont('Arial','B',8);
				#			$pdf->SetXY(30,45);
			
			
								#HEADER TABLE
			
				#				$y_axis_initial = 40;
				#				$y_axis = 0;
				#				$pdf->SetFont('Arial','',8);
				#				$pdf->setFillColor(222,222,222);
				#				$pdf->SetY($y_axis_initial);
				#				$pdf->SetX(3);
				#				$pdf->Cell(10,10,'No',1,0,'C',0);
				#				$pdf->Cell(42,10,'Project Name',1,0,'C',0);
				#				$pdf->Cell(73,6,'SALEABLE',1,0,'C',0);
				#				$pdf->SetXY(55,46);
				#				$pdf->Cell(9,4,'Unit',1,0,'C',0);
								
				#				$pdf->Cell(17,4,'NETT/LAND',1,0,'C',0);
				#				$pdf->Cell(22,4,'SGA/BUILDING',1,0,'C',0);
				#				$pdf->Cell(25,4,'PriceList Basic',1,0,'C',0);
								
				#				$pdf->SetXY(128,40);
				#				$pdf->Cell(73,6,'SOLD',1,0,'C',0);
				#				$pdf->SetXY(128,46);
				#				$pdf->Cell(9,4,'Unit',1,0,'C',0);
								
				#				$pdf->Cell(17,4,'NETT/LAND',1,0,'C',0);
				#				$pdf->Cell(22,4,'SGA/BUILDING',1,0,'C',0);
				#				$pdf->Cell(25,4,'Sold Price',1,0,'C',0);
			
				#				$pdf->SetXY(201,40);
				#				$pdf->Cell(73,6,'AVAILABLE',1,0,'C',0);
				#				$pdf->SetXY(201,46);
				#				$pdf->Cell(9,4,'Unit',1,0,'C',0);
								
				#				$pdf->Cell(17,4,'NETT/LAND',1,0,'C',0);
				#				$pdf->Cell(22,4,'SGA/BUILDING',1,0,'C',0);
				#				$pdf->Cell(25,4,'Price Balanced',1,0,'C',0);
			
				#									$pdf->Ln();
							#RESET VARIABLE
				#			$i=1;
				#			$grandtotstok 		= 0;
				#			$grandtotstoknett 	= 0;
				#			$grandtotstoksga	= 0;
				#			$grandtotpricebasic = 0;
							
							#GRAND SOLD
				#			$grandsold 		= 0;
				#			$grandsoldnett 	= 0;
				#			$grandsoldsga	= 0;
				#			$grandsoldprice	= 0;
							
							#GRAND AVAILABLE
				#			$grandavunit		= 0;
				#			$grandavnett		= 0;
				#			$grandavsga			= 0;
				#			$grandavprice		= 0;
						
						#var_dump($data);
				#		foreach($data as $row){
				#			$subproject = $row->subproject_id;
							#var_dump($subproject);
							#TOTAL STOK UNIT
				#			IF($pt == 44){
				#			$sql = $this->db->select('count(unit_id) as totstok')
				#							->where('id_subproject',$subproject)
				#							->get('db_unit_yogya')
				#							->row();
							#var_dump($sql);
							#TOTAL STOK LAND/SGA
				#			$sql1 = $this->db->select('sum(tanah) as totstoknett')
				#							->where('id_subproject',$subproject)
				#							->get('db_unit_yogya')
				#							->row();
							#TOTAL STOK BUILDING/SGA
				#			$sql2 = $this->db->select('sum(bangunan) as totstoksga')
				#							->where('id_subproject',$subproject)
				#							->get('db_unit_yogya')
				#							->row();
							#TOTAL PRICELIST BASIC
				#			$sql3 = $this->db->select('sum(pricelist_ppn) as totpricebasic')
				#							->where('id_subproject',$subproject)
				#							->get('db_unit_yogya')
				#							->row();
				#			}
				#			ELSE{
				#			$sql = $this->db->select('count(unit_id) as totstok')
				#							->where('id_subproject',$subproject)
				#							->where('status_unit <>',10)
				#							->get('db_unit_bdm')
				#							->row();
							#var_dump($sql);
							#TOTAL STOK LAND/SGA
				#			$sql1 = $this->db->select('sum(tanah) as totstoknett')
				#							->where('id_subproject',$subproject)
				#							->where('status_unit <>',10)
				#							->get('db_unit_bdm')
				#							->row();
							#TOTAL STOK BUILDING/SGA
				#			$sql2 = $this->db->select('sum(bangunan) as totstoksga')
				#							->where('id_subproject',$subproject)
				#							->where('status_unit <>',10)
				#							->get('db_unit_bdm')
				#							->row();
							#TOTAL PRICELIST BASIC
				#			$sql3 = $this->db->select('sum(pricelist_ppn) as totpricebasic')
				#							->where('id_subproject',$subproject)
				#							->get('db_unit_bdm')
				#							->row();							
							#}
							#SALEABLE
				#			$totstok 		= $sql->totstok;
				#			$totstoknett 	= $sql1->totstoknett;
				#			$totstoksga		= $sql2->totstoksga;
				#			$totpricebasic 	= $sql3->totpricebasic;
							#SOLD						
				#			$sold 		= $row->sold;
				#			$soldnett 	= $row->soldnett;
				#			$soldsga	= $row->soldsga;
				#			$soldprice	= $row->soldprice;
							#AVAIlABLE
				#			$avunit		= $totstok - $sold ;
				#			$avnett		= $totstoknett - $soldnett;
				#			$avsga		= $totstoksga - $soldsga;
				#			$avprice	= $totpricebasic - $soldprice;
							
							#GRAND SALEABLE
				#			$grandtotstok 		= $grandtotstok + $totstok ;
				#			$grandtotstoknett 	= $grandtotstoknett + $totstoknett;
				#			$grandtotstoksga	= $grandtotstoksga + $totstoksga;
				#			$grandtotpricebasic = $grandtotpricebasic + $totpricebasic;
							
							#GRAND SOLD
				#			$grandsold 		= $grandsold + $sold;
				#			$grandsoldnett 	= $grandsoldnett + $soldnett; 
				#			$grandsoldsga	= $grandsoldsga + $soldsga;
				#			$grandsoldprice	= $grandsoldprice + $soldprice;
							
							#GRAND AVAILABLE
				#			$grandavunit		= $grandavunit + $avunit;
				#			$grandavnett		= $grandavnett + $avnett;
				#			$grandavsga			= $grandavsga + $avsga;	
				#			$grandavprice		= $grandavprice + $avprice;
							
				#			$pdf->SetX(3);
				#			$pdf->SetFont('Arial','',6);	
				#			$pdf->Cell(10,8,$i,20,0,'C');
				#			$pdf->Cell(42,8,$row->projectname,20,0,'L');
							
				#			$pdf->Cell(9,8,number_format($sql->totstok),20,0,'C');
				#			$pdf->Cell(17,8,number_format($sql1->totstoknett).' M2',20,0,'C');
				#			$pdf->Cell(22,8,number_format($sql2->totstoksga).' M2',20,0,'C');
				#			$pdf->Cell(25,8,number_format($sql3->totpricebasic),20,0,'R');
													
				#			$pdf->Cell(9,8,number_format($row->sold),20,0,'C');
				#			$pdf->Cell(17,8,number_format($row->soldnett).' M2',20,0,'C');
				#			$pdf->Cell(22,8,number_format($row->soldsga).' M2',20,0,'C');
				#			$pdf->Cell(25,8,number_format($row->soldprice),20,0,'R');
							
				#			$pdf->Cell(9,8,number_format($avunit),20,0,'C');
				#			$pdf->Cell(17,8,number_format($avnett).' M2',20,0,'C');
				#			$pdf->Cell(22,8,number_format($avsga).' M2',20,0,'C');
				#			$pdf->Cell(25,8,number_format($avprice),20,0,'R');
						
				#			$i++;
				#			$pdf->Ln();
				#		}
						
				#				$pdf->SetX(3);
				#				$pdf->SetFont('Arial','B',6);
				#				$pdf->Cell(52,8,'TOTAL',0,0,'R',1);
								
													
				#			$pdf->Cell(9,8,number_format($grandtotstok),20,0,'C',1);
				#			$pdf->Cell(17,8,number_format($grandtotstoknett).' M2',20,0,'C',1);
				#			$pdf->Cell(22,8,number_format($grandtotstoksga).' M2',20,0,'C',1);
				#			$pdf->Cell(25,8,number_format($grandtotpricebasic),20,0,'R',1);
													
				#			$pdf->Cell(9,8,number_format($grandsold ),20,0,'C',1);
				#			$pdf->Cell(17,8,number_format($grandsoldnett).' M2',20,0,'C',1);
				#			$pdf->Cell(22,8,number_format($grandsoldsga).' M2',20,0,'C',1);
				#			$pdf->Cell(25,8,number_format($grandsoldprice),20,0,'R',1);
							
				#			$pdf->Cell(9,8,number_format($grandavunit),20,0,'C',1);
				#			$pdf->Cell(17,8,number_format($grandavnett).' M2',20,0,'C',1);
				#			$pdf->Cell(22,8,number_format($grandavsga).' M2',20,0,'C',1);
				#			$pdf->Cell(25,8,number_format($grandavprice),20,0,'R',1);
						
						
						
				#		$pdf->Output("history.pdf","I");
				
				#}
			
			
			
			
			
			
			#DETAIL SALES REPORT
			#else{
			
			
			
			
			#QUERY
			
			$rows = $this->db->query("SP_listinvoice '".$subproject."','".$start_date."','".$end_date."',".$checkbox."")->row();
			
			
			
			
			$nmsubproject= $rows->nm_subproject;
			
			#Price/m2
		
			
					
			
			
			#kondisi Beda Project
			require('fpdf/classreport.php');
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',14);
			$pdf->SetMargins(2,10,2);
		
			
			
			#HEADER CONTENT
			
			$judul 		= "REKAP INVOICE";
			$periode	= "Periode ";
			
			
			
			
			#Header
			$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			#pdf->SetFont('Arial','B',12);
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
			
			$pdf->SetFont('Arial','B',12);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul.' - ',20,0,'L');
			
			$pdf->SetFont('Arial','B',12);		
			$pdf->SetXY(62,16);
			$pdf->Cell(0,10,$nmsubproject,20,0,'L');
			
			
			$pdf->ln(8);
			$pdf->SetX(25);
			$pdf->Cell(20,10,$periode,20,0,'L');
			
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(20,10,': '.indo_date($start_date),0,0,'L');
			$pdf->Cell(20,10,'To  '.indo_date($end_date),0,0,'L');
			
						
			
			$pdf->SetFont('Arial','B',10);
					$pdf->SetXY(30,45);
			
			
			#HEADER TABLE
			
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',7);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(3);
			$pdf->Cell(8,6,'No',1,0,'C',1);
			$pdf->Cell(50,6,'Nama Tenant',1,0,'C',1);
			$pdf->Cell(20,6,'Kode Tenant',1,0,'C',1);
			$pdf->Cell(85,6,'Keterangan',1,0,'C',1);
			$pdf->Cell(26,6,'Invoice No.',1,0,'C',1);
			$pdf->Cell(20,6,'Tanggal',1,0,'C',1);
			$pdf->Cell(20,6,'Rental',1,0,'C',1);
			$pdf->Cell(10,6,'Materai',1,0,'C',1);
			$pdf->Cell(20,6,'PPN',1,0,'C',1);
			$pdf->Cell(23,6,'Jumlah',1,0,'C',1);
			//$pdf->Cell(18,6,'Keterangan',1,0,'C',1);
			
			
			$pdf->Ln();
			
			$max=23;
			$row_height = 4;
			$y_axis = $y_axis + $row_height;
			$no=1;
        	$i = 1;
			$noproject=1;
        	$iproject = 1;
			#Menkosongkan Total
			
					#$tottanah 			= 0;
					#$totbangunan		= 0;
					$base_amount		= 0;
					$stamp		= 0;
					$tax_amount 	= 0;
					$totdiscamount		= 0;
					
					$base_amount2		= 0;
					$stamp2		= 0;
					$tax_amount2	= 0;
		
					#$totbf				= 0;
					#$totdp				= 0;
					$totpl 				= 0;
					
		$flag = array('1','2');			
		$sqlproject = $this->db->select('nm_subproject, SUM(base_amount) as base_amount, SUM(tax_amount) as tax_amount, 
														SUM(trx_amount) as trx_amount, isnull(SUM(stamp),0) as stamp')
											->join('db_invoice','subproject_id  = id_subproject')
											->where('pt_id',12)
											->where('tgl_invoice >=',$start_date)
											->where_in('id_flag',$flag)
											->group_by('nm_subproject')
											->order_by('nm_subproject')
											->get('db_subproject')
											->result();		
			
			foreach($sqlproject as $roww){
					
			//$pdf->Cell(50,6,$roww->nm_subproject,10,0,'L');
			
			$project = $roww->nm_subproject;
			
			$data1 = $this->db->query("SP_listinvoice_detail '".$subproject."','".$start_date."','".$end_date."','".$project."',".$checkbox."");
			
			$data = $data1->result();
			
			#var_dump($data);
			
			$a=0;
			$b=0;
			$c=0;
			
			foreach($data as $row){
				$a = $a + $row->base_amount;
				$b = $b + $row->stamp;
				$c = $b + $row->tax_amount;
				#ROW DATA
					$tglsales = $row->tgl_invoice;
					$tglsales = indo_date($tglsales);	
					
					
					$customernama = $row->customer_nama;				
		
					
					$base_amount =  $base_amount+($row->base_amount);
					$stamp =  $stamp+($row->stamp);
					$tax_amount =  $tax_amount+($row->tax_amount);
					
					
					
					
			$pdf->SetX(3);
			$pdf->SetFont('Arial','',6);	
			$pdf->Cell(8,6,$i,10,0,'R');
			$pdf->Cell(50,6,$customernama,10,0,'L');
			$pdf->Cell(20,6,$row->kd_tenant,10,0,'L');
			$pdf->Cell(85,6,$row->description,10,0,'L');
			$pdf->Cell(26,6,$row->no_invoice,10,0,'C');
			$pdf->Cell(20,6,indo_date($row->tgl_invoice),10,0,'C');
			//$pdf->Cell(20,6,$row->nm_subproject,10,0,'L');
			$pdf->Cell(20,6,number_format($row->base_amount),10,0,'R');
			$pdf->Cell(10,6,number_format($row->stamp),10,0,'R');
			$pdf->Cell(20,6,number_format($row->tax_amount),10,0,'R');
			$pdf->Cell(23,6,number_format($row->trx_amount+$row->stamp),10,0,'R');
			//$pdf->Cell(18,6,'',10,0,'L');
			$no++;	
			$i++;
			$pdf->Ln();
			
			//$base_amount2 =  $base_amount2+($row->base_amount);
			// $stamp2 =  $stamp2+($row->stamp);
			// $tax_amount2 =  $tax_amount2+($row->tax_amount);
			
						
	}
			
		
	
	
			$pdf->SetX(3);
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(200,6,'TOTAL : '.$roww->nm_subproject,0,0,'R',1);
			$pdf->Cell(29,6,number_format($a),0,0,'R',1);
			$pdf->Cell(10,6,number_format($b),0,0,'R',1);
			$pdf->Cell(20,6,number_format($c),0,0,'R',1);
			$pdf->Cell(23,6,number_format($a+$b+$c),0,0,'R',1);
			$noproject++;	
			$iproject++;
			$pdf->Ln();
	}
	
			#die('tes');
					$pdf->SetX(3);
					$pdf->SetFont('Arial','B',6);
					$pdf->Cell(200,6,'TOTAL : ',0,0,'R',1);
					$pdf->Cell(29,6,number_format($base_amount),0,0,'R',1);
					$pdf->Cell(10,6,number_format($stamp),0,0,'R',1);
					$pdf->Cell(20,6,number_format($tax_amount),0,0,'R',1);
					$pdf->Cell(23,6,number_format($base_amount+$tax_amount+$stamp),0,0,'R',1);
					//$pdf->Cell(25,6,'',0,0,'R',1);
					#$pdf->Cell(18,6,number_format($totbf),0,0,'R',1);
					#$pdf->Cell(18,6,number_format($totdp),0,0,'R',1);
					//$pdf->Cell(3,6,'',0,0,'R',1); 
									
			
			/*
			#$pdf->SetFont('Arial','B',10);
			#$pdf->SetXY(25,22);
			#$pdf->Cell(0,10,'Tahun '.$thn,20,0,'L');
			#end header
			*/
			
			$pdf->Output("history.pdf","I");	
#}
#$url= "reprint/sp".$idsp.".pdf";
#$pdf->Output($url);
#redirect($url);
			
#$pdf->Output("hasil.pdf","I");
