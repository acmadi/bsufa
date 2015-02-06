<?php
class print_cuti_karyawan extends controller{
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
			$pdf->Cell(0,10,'Tahun : '.$thn,20,0,'L');
			#end header
			
			$y_axis_initial = 40;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(4);
			$pdf->Cell(12,6,'No',1,0,'C',1);
			$pdf->Cell(30,6,'Nik',1,0,'C',1);
			$pdf->Cell(70,6,'Nama Karyawan',1,0,'C',1);
			$pdf->Cell(30,6,'Tanggal mulai cuti',1,0,'C',1);
			$pdf->Cell(30,6,'Tanggal akhir cuti',1,0,'C',1);
			//$pdf->Cell(30,6,'Jenis Cuti',1,0,'C',1);
			$pdf->Cell(30,6,'Jumlah Cuti',1,0,'C',1);
			$pdf->Cell(30,6,'Sisa Cuti',1,0,'C',1);
			//$pdf->Cell(30,6,'Jumlah Cuti',1,0,'C',1);
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
			if($divisi=="all"){				
				$sql = "select * from db_karycuti
				left join db_kary on(id_kary = kary_id)
				left join db_karycutipar on(id_kary = karyawan_id)
				left join db_karycutijns on(karycutijns_id = jns_cuti)
				where flowapp_id = 10 and jns_cuti = 1 and datename(YY,startdate_cuti) = '$thn'
				order by nama asc
				";
			}else{
				$sql = "select * from db_karycuti
				left join db_kary on(id_kary = kary_id)
				left join db_karycutipar on(id_kary = karyawan_id)
				left join db_karycutijns on(karycutijns_id = jns_cuti)
				where flowapp_id = 10 and id_divisi = '$divisi' 
				and jns_cuti = 1 and datename(YY,startdate_cuti) = '$thn'
				order by nama asc
				";
			}
			
			$query = $this->db->query($sql);
			$data = $query->result();				
			#end data
			//Cek data awal
			$xdata = $this->db->join('db_kary','id_kary = kary_id')
							  ->order_by('nama','desc')
							  ->where('flowapp_id','10')
							  ->get('db_karycuti')->result();
			foreach($xdata as $xrow){
				$nama = $xrow->nama;
			     $nik = $xrow->kary_id;
			}
			//var_dump($nik);
			$totcuti = 0;
			foreach($data as $row){
				//$sisa_cuti = $row->saldo_cuti;
				//$dtakry = $this->db->get('db_kary')->row();
				$sisa_cuti = $row->saldo_cuti;
				//$jmlcuti = $row->aju_cuti;
				
				if($row->kary_id == $nik){
					//$totcuti = $totcuti + 1;
		            $nik = $nik;
					$totcuti = $totcuti +  $row->aju_cuti;
					$sisa_cuti = $sisa_cuti - $totcuti;
				}else{
					$totcuti = $row->aju_cuti;
					$nik = $row->kary_id;
					$sisa_cuti = $sisa_cuti - $totcuti;
				}    
				$nik = $nik;
				//$sisa_cuti = $sisa_cuti;
				//var_dump($row->kary_id."-".$jmlcuti."-".$totcuti."-".$row->nama);
				
				if($no == $max){ 
					$pdf->AddPage();
					#Header
					$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
					$pdf->SetFont('Arial','B',12);
					$pdf->SetX(25);
					$pdf->Cell(0,10,'PT. Bakrie Swasakti Utama',20,0,'L');		
					$pdf->SetXY(25,15);
					$pdf->Cell(0,10,$judul,20,0,'L');
					$pdf->SetXY(25,20);
					$pdf->Cell(0,10,'Tahun : '.$thn,20,0,'L');
					#end header

					$pdf->SetFont('Arial','',10);
					$pdf->SetY(40);
					$pdf->SetX(4);
					$pdf->Cell(12,6,'No',1,0,'C',1);
					$pdf->Cell(30,6,'Nik',1,0,'C',1);
					$pdf->Cell(70,6,'Nama Karyawan',1,0,'C',1);
					$pdf->Cell(30,6,'Tanggal mulai cuti',1,0,'C',1);
					$pdf->Cell(30,6,'Tanggal akhir cuti',1,0,'C',1);
					//$pdf->Cell(30,6,'Jenis Cuti',1,0,'C',1);
					$pdf->Cell(30,6,'Jumlah Cuti',1,0,'C',1);
					$pdf->Cell(30,6,'Sisa Cuti',1,0,'C',1);
					$pdf->SetY(40);
					$pdf->SetX(25);
					$y_axis = $y_axis + $row_height;
					$no=0;
					$pdf->Ln();
				}
				$pdf->SetX(4);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(12,6,$i,1,0,'C');
				$pdf->Cell(30,6,$row->kary_id,1,0,'C');
				$pdf->Cell(70,6,$row->nama,1,0,'C');
				$pdf->Cell(30,6,$row->startdate_cuti,1,0,'C');
				$pdf->Cell(30,6,$row->enddate_cuti,1,0,'C');
				//$pdf->Cell(30,6,$row->karycutijns_nm,1,0,'C');
				$pdf->Cell(30,6,$row->aju_cuti,1,0,'C');
				$pdf->Cell(30,6,$sisa_cuti,1,0,'C');
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
