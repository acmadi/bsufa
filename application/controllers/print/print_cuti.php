<?php
class print_cuti extends controller{
	function index(){
			extract(PopulateForm());		
			require('fpdf/classreport.php');
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$judul = "Laporan Cuti Karyawan";
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
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
			$pdf->Cell(0,10,'Tahun '.$thn,20,0,'L');
			#end header
			
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(4);
			$pdf->Cell(12,6,'No',1,0,'C',1);
			$pdf->Cell(60,6,'Nama Karyawan',1,0,'C',1);
			$pdf->Cell(40,6,'Saldo Cuti',1,0,'C',1);
			$pdf->Cell(40,6,'Cuti Tahunan',1,0,'C',1);
			$pdf->Cell(40,6,'Cuti Bersama',1,0,'C',1);
			$pdf->Cell(40,6,'Sisa Cuti',1,0,'C',1);
			$pdf->Ln();
			$max=20;
			$row_height = 6;
			$y_axis = $y_axis + $row_height;
			$i=1;
			$no=0;
			
			#Cek / ambil data
			/*$data = $this->db->join('db_kary','id_kary=kary_id')
							 ->join('db_karycutipar','karyawan_id=kary_id')
							 ->where('id_divisi',$divisi)
							 //->group_by('kary_id')
							 ->get('db_karycuti')->result();*/
							
			$sql = "select nama,(select sum(saldo_cuti) 
					from db_karycutipar where karyawan_id = id_kary) as saldo,
					(select sum(aju_cuti) from db_karycuti where
					kary_id = id_kary and flowapp_id = 10 and jns_cuti = 1)
					 as jml_cuti,
					(select sum(cuti_bersama)from db_karycutipar where
					karyawan_id = id_kary) 
					as cuti_bersama from db_kary  where id_divisi = 
					'$divisi' and isnull(db_kary.id_flag,0) != 10 order by nama asc ";

			
			$query = $this->db->query($sql);
			$data = $query->result();				
			#end data
			
			foreach($data as $row){
				if ($no == $max){ 
					$pdf->AddPage();
					#Header
					$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
					$pdf->SetFont('Arial','B',12);
					$pdf->SetX(25);
					$pdf->Cell(0,10,'PT. Bakrie Swasakti Utama',20,0,'L');		
					$pdf->SetXY(25,15);
					$pdf->Cell(0,10,$judul,20,0,'L');
					$pdf->SetXY(25,20);
					$pdf->Cell(0,10,'Tahun '.$thn,20,0,'L');
					#end header
					$pdf->SetFont('Arial','',8);
					$pdf->SetY(40);
					$pdf->SetX(4);
					$pdf->Cell(12,6,'No',1,0,'C',1);
					$pdf->Cell(60,6,'Nama Karyawan',1,0,'C',1);
					$pdf->Cell(40,6,'Saldo Cuti',1,0,'C',1);
					$pdf->Cell(40,6,'Cuti Tahunan',1,0,'C',1);
					$pdf->Cell(40,6,'Cuti Bersama',1,0,'C',1);
					$pdf->Cell(40,6,'Sisa Cuti',1,0,'C',1);
					$pdf->SetY(40);
					$pdf->SetX(25);
					$y_axis = $y_axis + $row_height;
					$no=0;
					$pdf->Ln();
				}
				$sisa = $row->saldo - ($row->jml_cuti + $row->cuti_bersama);
				$pdf->SetX(4);
				$pdf->SetFont('Arial','',5);
				$pdf->Cell(12,6,$i,1,0,'C');
				$pdf->Cell(60,6,$row->nama,1,0,'C');
				$pdf->Cell(40,6,number_format($row->saldo),1,0,'C');
				$pdf->Cell(40,6,number_format($row->jml_cuti),1,0,'C');
				$pdf->Cell(40,6,number_format($row->cuti_bersama),1,0,'C');
				$pdf->Cell(40,6,number_format($sisa),1,0,'C');
				$pdf->Ln();
				$no++;
				$i++;
			}
			/*$pdf->SetX(4);
			$pdf->setFillColor(222,222,222);
			$pdf->Cell(60,4,"Total",1,0,'C',1);
			$pdf->Cell(16,4,number_format($totbgt1,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt2,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt3,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt4,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt5,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt6,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt7,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt8,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt9,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt10,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt11,","),1,0,'R',1);
			$pdf->Cell(16,4,number_format($totbgt12,","),1,0,'R',1);
			$pdf->Cell(20,4,number_format($tottot_mst,","),1,0,'R',1);*/
			$pdf->Output("hasil.pdf","I");	;
	}
}
