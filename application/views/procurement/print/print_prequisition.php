<?php

		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			#die($id);
			$pdf=new PDF('P','mm','A4');
			//~ $q1 = "select e.divisi_nm as divisi_nm,c.no_pr as no_pr,c.tgl_pr,c.tgl_aproval as tgl_aproval,c.req_pr as req_pr, b.qty_req AS qty_req,b.unit_brg as unit_brg,a.nm_brg as nm_brg,a.ven1 as ven1,a.sat1 as sat1,a.tot1 as tot1,a.ven2 as ven2,
						//~ a.sat2 as sat2,a.tot2 as tot2,a.ven3 as ven3,a.sat3 as sat3,a.tot3 as tot3,b.no_pr as no_pr,
						//~ c.div_pr as div_pr,c.tgl_pr as tgl_pr,c.tgl_aproval as tgl_aproval,c.req_pr as req_pr,d.alamat as alamat,d.telepon as telepon,c.ket_pr as ket_pr
						 //~ from db_lem_db_pr_pnwrvend a
						//~ left join db_pr_dver b on a.id_pr = b.id_pr
						//~ left join db_pr c on c.id_pr = a.id_pr
						//~ left join pemasokmaster d on d.kd_supp_gb = b.kd_supp
						//~ left JOIN DB_divisi e on e.divisi_id = c.div_pr
						//~ where a.id_pr ='".$id."'";
						
			$q2 = $this->db->query("sp_printpnwr '".$id."'")
						  ->row();
							 
			$pdf->SetMargins(2,10,2);
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
			#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetX(25);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(130,5,'PT. GRAHA MULTI INSANI',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'No. PR',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,$q2->no_pr,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Komplek Apartemen Taman Rasuna',10,0,'L');
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(20,5,'Request',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',6);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jl. HR. Rasuna Said - Kuningan',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'Transaction Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,indo_date($q2->tgl_pr),10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Jakarta Selatan (12960)',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'Approved Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,indo_date($q2->tgl_aproval),10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'Telp : (021) 830-5011 Fax : (021) 830-5012',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'Requestor',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,$q2->req_pr,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(130,5,'NPWP : 021.672.152.2-011.00',10,0,'L');
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(20,5,'Department',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->Cell(30,5,$q2->divisi_nm,10,0,'L');
				
			
			$pdf->Ln(13);
			$pdf->SetFont('Arial','B',9);
			$pdf->SetX(25);
			$pdf->Cell(130,5,'PURCHASE REQUISITION',10,0,'L');
			$pdf->Ln(10);
			
			//~ $pdf->SetFont('Arial','B',6);
			//~ $pdf->Cell(80,5,'Suggested Selected :',10,0,'L');
			//~ $pdf->Cell(25,5,'Budget Control Use Only',10,0,'L');
			//~ $pdf->Ln(5);
			//~ $pdf->SetFont('Arial','',6);
			//~ 
			//~ $pdf->Cell(20,5,'Name',10,0,'L');
			//~ $pdf->Cell(2,5,':',10,0,'L');
			//~ $pdf->Cell(59,5,'Abas',10,0,'L');
			//~ $pdf->Cell(15,4,'X',1,0,'C');
			//~ $pdf->Cell(15,5,'Budgeted',10,0,'L');
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->Cell(20,5,'Address',10,0,'L');
			//~ $pdf->Cell(2,5,':',10,0,'L');
			//~ $pdf->Cell(59,5,'Kuningan',10,0,'L');
			//~ $pdf->Cell(15,4,'X',1,0,'C');
			//~ $pdf->Cell(15,5,'Non Budgeted',10,0,'L');
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->Cell(20,5,'Phone / Fax',10,0,'L');
			//~ $pdf->Cell(2,5,':',10,0,'L');
			//~ $pdf->Cell(59,5,'021 - 0000000',10,0,'L');
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->Cell(20,5,'TOP',10,0,'L');
			//~ $pdf->Cell(2,5,':',10,0,'L');
			//~ $pdf->Cell(40,5,'',10,0,'L');
			//~ $pdf->Cell(50,4,'Budgeted < 30 Juta',1,0,'C',1);
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->SetFont('Arial','B',6);
			//~ $pdf->Cell(40,5,'Reason For Requisition',10,0,'L');
			//~ $pdf->Ln(5);
			//~ 
			//~ $pdf->Cell(206,5,'Toner Untuk Yogya',1,0,'L');
			$pdf->Ln(1);
			
			
			#start Tabel
			$pdf->Ln(5);
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(8,8,'No',1,0,'C',1);
			$pdf->Cell(10,8,'Qty',1,0,'C',1);
			$pdf->Cell(13,8,'Unit',1,0,'C',1);
			$pdf->Cell(55,8,'Description',1,0,'C',1);
			$pdf->Cell(40,4,$q2->ven1,1,0,'C',1);
			$pdf->Cell(40,4,$q2->ven2,1,0,'C',1);
			$pdf->Cell(40,4,$q2->ven3,1,0,'C',1);
			$pdf->Ln(4);
			
			$pdf->Cell(8,0,'',0,0,'C',0);
			$pdf->Cell(10,0,'',0,0,'C',0);
			$pdf->Cell(13,0,'',0,0,'C',0);
			$pdf->Cell(55,0,'',0,0,'C',0);
			$pdf->Cell(20,4,'Price',1,0,'C',1);		
			$pdf->Cell(20,4,'Total',1,0,'C',1);		
			$pdf->Cell(20,4,'Price',1,0,'C',1);		
			$pdf->Cell(20,4,'Total',1,0,'C',1);
			$pdf->Cell(20,4,'Price',1,0,'C',1);
			$pdf->Cell(20,4,'Total',1,0,'C',1);
			$pdf->Ln(4);
			
			//~ $querypr = "select b.qty_req AS qty_req,b.unit_brg as unit_brg,a.nm_brg as nm_brg,a.ven1 as ven1,a.sat1 as sat1,a.tot1 as tot1,a.ven2 as ven2,
						//~ a.sat2 as sat2,a.tot2 as tot2,a.ven3 as ven3,a.sat3 as sat3,a.tot3 as tot3,b.no_pr as no_pr,
						//~ c.div_pr as div_pr,c.tgl_pr as tgl_pr,c.tgl_aproval as tgl_aproval,c.req_pr as req_pr,d.alamat as alamat,d.telepon as telepon,c.ket_pr as ket_pr
						 //~ from db_lem_db_pr_pnwrvend a
						//~ left join db_pr_dver b on a.id_pr = b.id_pr
						//~ left join db_pr c on c.id_pr = a.id_pr
						//~ left join pemasokmaster d on d.kd_supp_gb = b.kd_supp
						//~ where a.id_prg = 1";
			$data = $this->db->query("sp_printpnwr1 '".$id."'")->result();
			
			$i = 1;
			
			#for($i = 1;$i <= 27; $i++){
			foreach ($data as $query){
			
			$pdf->Cell(8,4,$i,1,0,'C',0);
			$pdf->Cell(10,4,$query->qty_req,1,0,'C',0);
			$pdf->Cell(13,4,$query->unit_brg,1,0,'C',0);
			$pdf->Cell(55,4,$query->nm_brg,1,0,'L',0);
			$pdf->Cell(20,4,number_format($query->sat1),1,0,'R',0);		
			$pdf->Cell(20,4,number_format($query->tot1),1,0,'R',0);		
			$pdf->Cell(20,4,number_format($query->sat2),1,0,'R',0);		
			$pdf->Cell(20,4,number_format($query->tot2),1,0,'R',0);		
			$pdf->Cell(20,4,number_format($query->sat3),1,0,'R',0);		
			$pdf->Cell(20,4,number_format($query->tot3),1,0,'R',0);
			$pdf->Ln(4);	
			$i++;	
				
			}
			$pdf->Ln(7);		
			$pdf->SetX(15);
			$pdf->SetFont('Arial','',6);
		
			
			//~ $pdf->SetX(28);
			//~ $pdf->Cell(150,4,'Approval Signature',1,0,'C',0);
			//~ $pdf->Ln(4);		
				//~ 
			//~ $pdf->SetX(28);
			//~ $pdf->Cell(55,4,'Prepared By',1,0,'C',0);
			//~ $pdf->Cell(25,4,'FAM',1,0,'C',0);
			//~ $pdf->Cell(25,4,'FC',1,0,'C',0);		
			//~ $pdf->Cell(45,4,'General Manager',1,0,'C',0);		
				//~ 
			//~ $pdf->Ln(4);
			//~ 
			//~ $pdf->SetX(28);
			//~ $pdf->Cell(55,15,'',1,0,'C',0);
			//~ $pdf->Cell(25,15,'',1,0,'C',0);
			//~ $pdf->Cell(25,15,'',1,0,'C',0);
			//~ $pdf->Cell(45,15,'',1,0,'C',0);		
			//~ $pdf->Ln(15);
			//~ 
			//~ $pdf->SetX(28);
			//~ $pdf->Cell(55,3,'Date :',1,0,'L',0);
			//~ $pdf->Cell(25,3,'Date :',1,0,'L',0);
			//~ $pdf->Cell(25,3,'Date :',1,0,'L',0);		
			//~ $pdf->Cell(45,3,'Date :',1,0,'L',0);		
			//~ $pdf->Ln(25);
		//~ 
	
	
	
				$pdf->SetFont('Arial','',6);
				$pdf->SetX(180);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("Y-m-d"),4,0,'L');
			$pdf->Output("hasil.pdf","I");

