<?php
class print_denda_project extends controller{
	function index(){
			extract(PopulateForm());		
			require('fpdf/classreport.php');
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$judul = "Summary Penalty Project";
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			/*Cek data header*/
							  
			
			#Header
			$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
			$pdf->SetFont('Arial','B',12);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul,20,0,'L');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(25,22);
			$pdf->Cell(15,10,'As Off',2,0,'L');
			$pdf->Cell(5,10,$tgl1,2,0,'L');
			/*$pdf->SetXY(25,28);
			$pdf->Cell(15,10,'As Off',2,0,'L');
			$pdf->Cell(5,10,$tgl1,2,0,'L');*/
			#end header
			
			$y_axis_initial = 45;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(4);
			$pdf->Cell(12,6,'No',1,0,'C',1);
			$pdf->Cell(70,6,'Project',1,0,'C',1);
			$pdf->Cell(40,6,'Amount',1,0,'C',1);
			$pdf->Cell(40,6,'Paid',1,0,'C',1);
			$pdf->Cell(40,6,'Balanced',1,0,'C',1);
			$pdf->Ln();
			$max=20;
			$row_height = 6;
			$y_axis = $y_axis + $row_height;
			$i=1;
			$no=0;
			
			#Cek / ambil data
			$sql  = "select b.nm_subproject,(select sum(denda_nilai)
					from db_denda where id_project = b.subproject_id) as denda,
					(select sum(cicilan_jml) from db_cicilan left join
					db_denda on(id_denda = denda_id) where
					cicilan_ceklist = 2 and id_project = b.subproject_id)
					as cicilan from db_denda a 
					LEFT JOIN db_subproject b on(b.subproject_id=a.id_project)
					where nm_subproject is not null 
					and a.id_pt = '$pt'
					group by b.subproject_id,b.nm_subproject
					";
			$query = $this->db->query($sql);
			$data  = $query->result();		
			
			$tot1  = 0;
			$tot2  = 0;
			$tot3  = 0;
			foreach($data as $row){								
				if($no == $max){ 
					$pdf->AddPage();
					#Header
					$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
					$pdf->SetFont('Arial','B',12);
					$pdf->SetX(25);
					$pdf->Cell(0,10,$nama_pt,20,0,'L');		
					$pdf->SetXY(25,15);
					$pdf->Cell(0,10,$judul,20,0,'L');
					$pdf->SetXY(25,20);
					#end header

					$pdf->SetFont('Arial','',10);
					$pdf->SetY(45);
					$pdf->SetX(4);
					$pdf->Cell(12,6,'No',1,0,'C',1);
					$pdf->Cell(70,6,'Project',1,0,'C',1);
					$pdf->Cell(40,6,'Amount',1,0,'C',1);
					$pdf->Cell(40,6,'Paid',1,0,'C',1);
					$pdf->Cell(40,6,'Balanced',1,0,'C',1);
					$pdf->SetY(45);
					$pdf->SetX(25);
					$y_axis = $y_axis + $row_height;
					$no=0;
					$pdf->Ln();
				}
				$balance = $row->denda - $row->cicilan;
				$tot1 = $tot1 + $row->denda;
				$tot2 = $tot2 + $row->cicilan;
				$tot3 = $tot3 + $balance;
				
				$pdf->SetX(4);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(12,6,$i,1,0,'C');
				$pdf->Cell(70,6,$row->nm_subproject,1,0,'C');
				$pdf->Cell(40,6,number_format($row->denda),1,0,'R');
				$pdf->Cell(40,6,number_format($row->cicilan),1,0,'R');
				$pdf->Cell(40,6,number_format($balance),1,0,'R');
				$pdf->Ln();
				$no++;
				$i++;
			}
			$pdf->SetX(4);
			$pdf->SetFont('Arial','',8);
			$pdf->cell(82,6,'Total',1,0,'C');
			$pdf->Cell(40,6,number_format($tot1),1,0,'R');
			$pdf->Cell(40,6,number_format($tot2),1,0,'R');
			$pdf->Cell(40,6,number_format($tot3),1,0,'R');
			$pdf->Output();
	}
}
