<?php
class print_detail_frontoffice extends controller{
	function index(){
			extract(PopulateForm());
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			#STORE PROCEDURE
			#$query = $this->db->query("PrintSalesProspect '" .$customer."'");
			#		$row 				= $query->row();
			#		$manager	 		= $row->nama;
					#$hpprospek 			= $row->customer_hp;
					#$interestproject 	= $row->nm_subproject;
					#$tipe_media 		= $row->tipemedia_nm;
					#$source_media		= $row->media_nm;
					#$sales_name 		= $row->nama;
					#$prospect_stat 		= $row->prospectstat_nm;
					#$prospect_email		= $row->email;
					#$prospect_venue		= $row->venue;
					#$prospect_shift		= $row->shift;
					#$prospect_payment	= $row->payment;
			
			#$data = $this->db->query("PrintSalesDetail '" .$salesmanager."'");
			
							#$data	=	$this->db->select('*') 
							#			->join('db_custcomp','id_customer = customer_id','left')
							#			->join('db_kary','attr_id = attribute','left')
							#			->join('db_followup','db_customer.customer_id = db_followup.id_customer','left') 
							#			->join('db_prospectstat', 'prospectstat_id = fu_stat','left')
							#			->like('attribute',$salesmanager,'after')
							#			->order_by('prospectstat_nm','desc')
							#			->get('db_customer')->result();			
			
			$start_date1 = inggris_date($start_date);
			$end_date1 = inggris_date($end_date);
			
			
			
			#var_dump($venue);
			$data1 = $this->db->query("ViewFO '" .$venue."','" .$start_date1."','" .$end_date1."'")->result();
				#$data = $data1->result();
				#var_dump($data);
			
			#HEADER TEMPAT
			if($venue == 1)
				{	
					$perusahaan	= 'PT. Bakrie Swasakti Utama';
					$tempat 	= 'MORE';}
				else{
						
						$perusahaan	= 'PT. Graha Multi Insani';
						$tempat = 'MO YOGYA';}
						
			
			
			#$fu_tgl = indo_date($tgl);
			
			#$sale	 	= $data['nama'];
			#$date 		= indo_date($date_fu);
			#$query		= $data['nama'];
			#$data3	= $data->result();
			#var_dump($sale);
			require('fpdf/classreport.php');
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->SetMargins(2,10,2);
		
			
			
			#HEADER CONTENT
			
			$judul 		= 'Front Office  - '. $tempat;
			$periode	= "Periode";
			$mgr		= "Sales Name";
			
			
			
			#Header
			#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$perusahaan,20,0,'L');
			$pdf->SetFont('Arial','B',12);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul,20,0,'L');
			$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(25,22);
			$pdf->Cell(0,10,$periode,20,0,'L');
			
			
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(60,22);
			$pdf->Cell(0,10,': '.$start_date,2,1,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(80,22);
			$pdf->Cell(0,10,'To  '.$end_date,20,0,'L');
			
			
			
			$pdf->SetFont('Arial','B',10);
					$pdf->SetXY(30,45);
			
			
			#HEADER TABLE
			
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(3);
			$pdf->Cell(8,6,'No',1,0,'C',1);
			$pdf->Cell(23,6,'Date',1,0,'C',1);
			$pdf->Cell(40,6,'Name',1,0,'C',1);
			$pdf->Cell(40,6,'Contact Person',1,0,'C',1);
			$pdf->Cell(35,6,'Source',1,0,'C',1);
			$pdf->Cell(100,6,'Reason',1,0,'C',1);
			
			
			$pdf->Ln();
			#END
			
			$max=15;
			$row_height = 4;
			$y_axis = $y_axis + $row_height;
			$no=0;
        	$i = 1;
			
			
			foreach($data1 as $row){
				$tgl = $row->tgl;
				$tgl = indo_date($tgl);
				
				#PAGE HEADER SELANJUTNYA
				if($no == $max){
						#HEADER TOP
						$pdf->AddPage();
						$pdf->SetFont('Arial','B',12);
						$pdf->SetX(25);
						$pdf->Cell(0,10,$nama_pt,20,0,'L');
						$pdf->SetFont('Arial','B',12);		
						$pdf->SetXY(25,16);
						$pdf->Cell(0,10,$judul,20,0,'L');
						$pdf->SetFont('Arial','',10);		
						$pdf->SetXY(25,22);
						$pdf->Cell(0,10,$periode,20,0,'L');
			
						$pdf->SetFont('Arial','',10);		
						$pdf->SetXY(25,28);
						$pdf->Cell(0,10,$mgr,20,0,'L');
			
						$pdf->SetFont('Arial','',9);
						$pdf->SetXY(60,22);
						$pdf->Cell(0,10,': '.$start_date,2,1,'L');
						$pdf->SetFont('Arial','',9);
						$pdf->SetXY(80,22);
						$pdf->Cell(0,10,'To  '.$end_date,20,0,'L');
			
						
			
			
						$pdf->Ln();
						#END
						
						#HEADER TABLE
						$pdf->SetFont('Arial','',8);
						$pdf->setFillColor(222,222,222);
						$pdf->SetY($y_axis_initial);
							$pdf->SetX(3);
							$pdf->Cell(8,6,'No',1,0,'C',1);
							$pdf->Cell(23,6,'Date',1,0,'C',1);
							$pdf->Cell(40,6,'Name',1,0,'C',1);
							$pdf->Cell(25,6,'Contact Person',1,0,'C',1);
							$pdf->Cell(50,6,'Source',1,0,'C',1);
							$pdf->Cell(60,6,'Reason',1,0,'C',1);
						
						$pdf->SetY(40);
						#$pdf->SetX(25);
						$y_axis = $y_axis + $row_height;
						$pdf->Ln();
						$no=0;
						
						#END
							
							
							
							}
								$pdf->SetX(3);
								$pdf->SetFont('Arial','',8);	
								$pdf->Cell(7,8,$i,20,0,'R');
								$pdf->Cell(23,8,$tgl,20,0,'C');
								$pdf->Cell(41,8,$row->nama,20,0,'L');
								$pdf->Cell(41,8,$row->pic,20,0,'L');
								$pdf->Cell(36,8,$row->source,20,0,'L');
								$pdf->Cell(61,8,$row->tujuan,20,0,'L');
								
								$no++;
								$i++;
								$pdf->Ln();
				
							}
			
		
			#$pdf->SetFont('Arial','B',10);
			#$pdf->SetXY(25,22);
			#$pdf->Cell(0,10,'Tahun '.$thn,20,0,'L');
			#end header
			
			
			$pdf->Output("history.pdf","I");	
	}
}
