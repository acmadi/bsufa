<?php
class print_mall2mall_customerprospek extends controller{
	function index(){
			extract(PopulateForm());
			
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			#STORE PROCEDURE
			
						
			
			$start_date1 = inggris_date($start_date);
			$end_date1 = inggris_date($end_date);
			
			$data1 = $this->db->query("ProspectMall2Mall '" .$venue."','".$start_date1."','" .$end_date1."'");
				$data = $data1->result();
				#var_dump($data);
			
			
			

			
			
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
			
			$judul 		= "Prospective Mall 2 Mall Analysis Report";
			$periode	= "Periode";
			$mall2mall	= "Venue";
			
			
			
			
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
			
			$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(25,28);
			$pdf->Cell(0,10,$mall2mall,20,0,'L');
			
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(60,22);
			$pdf->Cell(0,10,': '.$start_date,2,1,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(80,22);
			$pdf->Cell(0,10,'To  '.$end_date,20,0,'L');
			
			
			$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(60,28);
			$pdf->Cell(0,10,': '.$venue,20,0,'L');
			
			
			#HEADER TABLE
			
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(25);
			$pdf->Cell(8,6,'No',1,0,'C',0);
			$pdf->Cell(50,6,'Manager Of Duty',1,0,'C',0);
			$pdf->Cell(40,6,'Total Prospect',1,0,'C',0);
			
			$pdf->Ln();
			#END
			
			/*$pdf->SetFont('Arial','',9);
			$pdf->SetXY(60,22);
			$pdf->Cell(0,10,': '.$start_date,2,1,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(80,22);
			$pdf->Cell(0,10,'To  '.$end_date,20,0,'L');*/
			
			/*$pdf->SetFont('Arial','',10);		
			$pdf->SetXY(60,28);
			$pdf->Cell(0,10,': '.$manager,20,0,'L');*/
			
			$no = 1;
			$pdf->SetFont('Arial','B',10);
					$pdf->SetXY(20,45);
			
			foreach ($data as $row){
				$venue = $row->venue;
				$jml = $row->jml;
				$nama = $row->nama;
				
				$pdf->SetX(25);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(8,8,$no,20,0,'C');
				$pdf->Cell(50,8,$nama,20,0,'L');
				$pdf->Cell(39.5,8,$jml.'  Prospect',20,0,'R');
				$no++;
				$pdf->ln();
				
			}
			
			
			
			$pdf->Output("ProspekMall2Mall.pdf","I");	
	}
}
