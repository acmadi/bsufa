<?php
class print_allsales_summary_customerprospek extends controller{
	function index(){
			extract(PopulateForm());
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			#STORE PROCEDURE
			#$query = $this->db->query("PrintSalesProspect '" .$salesmanager."'");
			#		$row 				= $query->row();
			#		$manager	 		= $row->nama;
						
			
			$start_date1 = inggris_date($start_date);
			$end_date1 = inggris_date($end_date);
			
			$data1 = $this->db->query("AllProspectStatus '" .$start_date1."','" .$end_date1."'");
				$data = $data1->result();
				#var_dump($data);
			
			$query1 = $this->db->query("AllProspectInterestProject '" .$start_date1."','" .$end_date1."'");
				$query2 = $query1->result();
				
			$query3 = $this->db->query("AllProspectSource '" .$start_date1."','" .$end_date1."'");
				$query4 = $query3->result();
			

			
			
			#$fu_tgl = indo_date($tgl);
			
			#$sale	 	= $data['nama'];
			#$date 		= indo_date($date_fu);
			#$query		= $data['nama'];
			#$data3	= $data->result();
			#var_dump($query4);
			require('fpdf/classreport.php');
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->SetMargins(2,10,2);
		
			
			
			#HEADER CONTENT
			
			$judul 		= "ALL Prospective Summary Report";
			$periode	= "Periode";
			#$mgr		= "Sales Name";
			
			$judul1		= "A. Prospect Summary Status";
			$judul2		= "B. Prospect Summary Interest Project";
			$judul3		= "C. Prospect Summary Source";
			
			
			#Header
			#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
			$pdf->SetFont('Arial','B',12);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul,20,0,'L');
			
			
			$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(25,22);
			$pdf->Cell(0,10,$periode,20,0,'L');
			
			#$pdf->SetFont('Arial','',10);		
			#$pdf->SetXY(25,28);
			#$pdf->Cell(0,10,$mgr,20,0,'L');
			
			$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(25,30);
			$pdf->Cell(0,10,$judul1,20,0,'L');
			
			$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(25,80);
			$pdf->Cell(0,10,$judul2,20,0,'L');
			
			$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(150,30);
			$pdf->Cell(0,10,$judul3,20,0,'L');
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(60,22);
			$pdf->Cell(0,10,': '.$start_date,2,1,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(80,22);
			$pdf->Cell(0,10,'To  '.$end_date,20,0,'L');
			
			#$pdf->SetFont('Arial','',10);		
			#$pdf->SetXY(60,28);
			#$pdf->Cell(0,10,': ',20,0,'L');
			
			
			$pdf->SetFont('Arial','B',10);
					$pdf->SetXY(30,40);
			
			foreach ($data as $row){
				$jenisstatus = $row->prospectstat_nm;
				$jml = $row->jml;
				
				$pdf->SetX(30);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(30,8,$jenisstatus,20,0,'L');
				$pdf->Cell(0.5,8,"=",20,0,'L');
				$pdf->Cell(10,8,$jml,20,0,'R');
				
				$pdf->ln();
				
			}
			
			$pdf->SetFont('Arial','B',10);
					$pdf->SetXY(30,90);
					
			foreach ($query2 as $row){
				$project = $row->nm_subproject;
				$jml = $row->jml;
				
				$pdf->SetX(30);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(70,8,$project,20,0,'L');
				$pdf->Cell(0.5,8,"=",20,0,'L');
				$pdf->Cell(10,8,$jml,20,0,'R');
				
				$pdf->ln();
			
			}
			
			$pdf->SetXY(80,40);
			
			foreach ($query4 as $row){
				$media = $row->media_nm;
				$jml = $row->jml;
				
				$pdf->SetX(155);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(70,8,$media,20,0,'L');
				$pdf->Cell(0.5,8,"=",20,0,'L');
				$pdf->Cell(10,8,$jml,20,0,'R');
				
				$pdf->ln();
			
			}
			
			$pdf->Output("history.pdf","I");	
	}
}
