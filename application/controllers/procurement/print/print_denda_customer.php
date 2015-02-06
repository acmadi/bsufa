<?php
class print_denda_customer extends controller{
	function index(){
			extract(PopulateForm());		
			require('fpdf/classreport.php');
			$pdf=new PDF('L','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$judul = "Recapitulation Penalty Customer";
			$session_id = $this->UserLogin->isLogin();
			$pt = $session_id['id_pt'];
			$data_pt = $this->mstmodel->get_nama_pt($pt);
			$nama_pt = "PT \t".$data_pt['ket'];
			
			

							  
							  
			
			if($periode=="All"){
			#Header
			/*Cek data header*/
			$rowcust = $this->db->join('db_custprofil','id_customer = customer_id')
							  ->join('db_subproject','db_denda.id_project = subproject_id')
							  ->where('customer_id',$customer)
							  ->where('denda_unit',$unit)
							  ->get('db_denda')->row();
							  //var_dump($unit);exit;
			$nildenda = $this->db->select_sum('denda_nilai')
								 ->where('id_customer',$customer)
								 ->where('denda_unit',$unit)
								 ->get('db_denda')->row();
							  //var_dump($rowcust);exit;			
			$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
			$pdf->SetFont('Arial','B',10);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul,20,0,'L');
			$pdf->SetXY(25,22);
			$pdf->Cell(15,10,$rowcust->nm_subproject,2,0,'L');
			//$pdf->Cell(6,10,$rowcust->nm_project,2,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(4,35);
			$pdf->Cell(30,10,'Nama',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,$rowcust->customer_nama,2,0,'L');
			$pdf->SetXY(4,40);
			$pdf->Cell(30,10,'Unit',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,$rowcust->denda_unit,2,0,'L');
			$pdf->SetXY(4,45);
			$pdf->Cell(30,10,'Start Date',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,indo_date($rowcust->denda_tglmulai),2,0,'L');
			$pdf->SetXY(4,50);
			$pdf->Cell(30,10,'Amount',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,number_format($nildenda->denda_nilai),2,0,'L');
			$pdf->SetXY(4,60);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(30,10,'Periode 1',2,0,'L');
			$pdf->SetFont('Arial','',10);
			/*$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,$periode,2,0,'L');*/
			#end header
			
			$y_axis_initial = 70;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(4);
			$pdf->Cell(12,6,'No',1,0,'C',1);
			$pdf->Cell(30,6,'Customer Date',1,0,'C',1);
			$pdf->Cell(30,6,'Amount',1,0,'C',1);
			$pdf->Cell(30,6,'Paid Date',1,0,'C',1);
			$pdf->Cell(30,6,'Paid',1,0,'C',1);
			$pdf->Cell(30,6,'Balance',1,0,'C',1);
			$pdf->Ln();
			$max=20;
			$row_height = 6;
			$y_axis = $y_axis + $row_height;
			$i=1;
			$no=0;
			
			#Cek / ambil data
			$data2 = $this->db->join('db_denda','denda_id = id_denda')
							  ->where('cicilan_ceklist',2)
							  ->where('id_customer',$customer)
							  ->order_by('denda_periode','ASC')
							  ->get('db_cicilan')->result();
			
			
			$jmldenda = $nildenda->denda_nilai;
			$jmlcicilan = 0;
			$sisa = 0;
			//Cek Periode Awal
			$xrow = $this->db->where('id_customer',$customer)
							 ->order_by('denda_periode','ASC')
							 ->get('db_denda')->row();
							 
			//var_dump($xrow->denda_periode);
			$periode = $xrow->denda_periode;				 
			foreach($data2 as $row){
				$jmlcicilan = $jmlcicilan + $row->cicilan_jml;
				$sisa = $jmldenda - $jmlcicilan;
				if($sisa < 0) $sisa = 0;
				else $sisa = $sisa;
				
				if($periode!=$row->denda_periode){			
				//if($no == $max){ 
					$pdf->AddPage();
					#Header
					$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
					$pdf->SetFont('Arial','B',12);
					$pdf->SetX(25);
					$pdf->Cell(0,10,$nama_pt,20,0,'L');		
					$pdf->SetXY(25,15);
					$pdf->Cell(0,10,$judul,20,0,'L');
					#end header

					$pdf->SetFont('Arial','B',10);
					$pdf->SetXY(4,30);
					$pdf->Cell(0,10,"Periode ".$row->denda_periode,20,0,'L');
					$pdf->SetFont('Arial','',10);
					$pdf->SetY(40);
					$pdf->SetX(4);
					$pdf->Cell(12,6,'No',1,0,'C',1);
					$pdf->Cell(30,6,'Customer Date',1,0,'C',1);
					$pdf->Cell(30,6,'Amount',1,0,'C',1);
					$pdf->Cell(30,6,'Paid Date',1,0,'C',1);
					$pdf->Cell(30,6,'Paid',1,0,'C',1);
					$pdf->Cell(30,6,'Balance',1,0,'C',1);
					$pdf->SetY(40);
					$pdf->SetX(25);
					$y_axis = $y_axis + $row_height;
					$no=0;
					$pdf->Ln();
					
				}
				$periode = $row->denda_periode;
				$pdf->SetX(4);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(12,6,$i,1,0,'C');
				$pdf->Cell(30,6,indo_date($row->cicilan_tgl),1,0,'C');
				$pdf->Cell(30,6,number_format($jmldenda),1,0,'R');
				$pdf->Cell(30,6,indo_date($row->cicilan_byr),1,0,'C');
				$pdf->Cell(30,6,number_format($row->cicilan_jml),1,0,'R');
				$pdf->Cell(30,6,number_format($sisa),1,0,'R');
				$pdf->Ln();
				$no++;
				$i++;
			}
			$pdf->SetX(4);
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(30,5,'Total Paid',2,0,'L');
			$pdf->Cell(6,5,':',2,0,'L');
			$pdf->Cell(10,5,number_format($jmlcicilan),2,0,'L');
			$pdf->Ln();
			$pdf->Cell(30,5,'Total Balanced',2,0,'L');
			$pdf->Cell(6,5,':',2,0,'L');
			$pdf->Cell(10,5,number_format($sisa),2,0,'L');
			}else{			
			/*Cek data header*/
			$rowcust = $this->db->join('db_custprofil','id_customer = customer_id')
							  ->join('db_subproject','db_denda.id_project = subproject_id')
							  ->where('customer_id',$customer)
							  ->where('denda_unit',$unit)
							  ->where('subproject_id',$project)
							  ->where('denda_periode',$periode)
							  ->get('db_denda')->row();
							  //var_dump($unit);exit;
			$nildenda = $this->db->select_sum('denda_nilai')
								 ->where('id_customer',$customer)
								 ->where('denda_unit',$unit)
								 ->where('denda_periode',$periode)
								 ->get('db_denda')->row();
							  //var_dump($rowcust);exit;
			#Header
			$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$nama_pt,20,0,'L');
			$pdf->SetFont('Arial','B',10);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$judul,20,0,'L');
			$pdf->SetXY(25,22);
			$pdf->Cell(15,10,$rowcust->nm_subproject,2,0,'L');
			//$pdf->Cell(6,10,$rowcust->nm_project,2,0,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(4,35);
			$pdf->Cell(30,10,'Nama',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,$rowcust->customer_nama,2,0,'L');
			$pdf->SetXY(4,40);
			$pdf->Cell(30,10,'Unit',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,$rowcust->denda_unit,2,0,'L');
			$pdf->SetXY(4,45);
			$pdf->Cell(30,10,'Start Date',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,indo_date($rowcust->denda_tglmulai),2,0,'L');
			$pdf->SetXY(4,50);
			$pdf->Cell(30,10,'Amount',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,number_format($nildenda->denda_nilai),2,0,'L');
			$pdf->SetXY(4,55);
			$pdf->Cell(30,10,'Periode',2,0,'L');
			$pdf->Cell(6,10,':',2,0,'L');
			$pdf->Cell(10,10,$periode,2,0,'L');
			#end header
			
			$y_axis_initial = 70;
			$y_axis = 0;
			$pdf->SetFont('Arial','',8);
			$pdf->setFillColor(222,222,222);
			$pdf->SetY($y_axis_initial);
			$pdf->SetX(4);
			$pdf->Cell(12,6,'No',1,0,'C',1);
			$pdf->Cell(30,6,'Customer Date',1,0,'C',1);
			$pdf->Cell(30,6,'Amount',1,0,'C',1);
			$pdf->Cell(30,6,'Paid Date',1,0,'C',1);
			$pdf->Cell(30,6,'Paid',1,0,'C',1);
			$pdf->Cell(30,6,'Balance',1,0,'C',1);
			$pdf->Ln();
			$max=20;
			$row_height = 6;
			$y_axis = $y_axis + $row_height;
			$i=1;
			$no=0;
			
			#Cek / ambil data
			$data2 = $this->db->where('id_denda',$rowcust->denda_id)
							  ->where('cicilan_ceklist',2)
							  ->get('db_cicilan')->result();
			
			
			$jmldenda = $nildenda->denda_nilai;
			$jmlcicilan = 0;
			$sisa = 0;
			foreach($data2 as $row){
				$jmlcicilan = $jmlcicilan + $row->cicilan_jml;
				$sisa = $jmldenda - $jmlcicilan;
				if($sisa < 0) $sisa = 0;
				else $sisa = $sisa;
								
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
					$pdf->SetY(65);
					$pdf->SetX(4);
					$pdf->Cell(12,6,'No',1,0,'C',1);
					$pdf->Cell(30,6,'Customer Date',1,0,'C',1);
					$pdf->Cell(30,6,'Amount',1,0,'C',1);
					$pdf->Cell(30,6,'Paid Date',1,0,'C',1);
					$pdf->Cell(30,6,'Paid',1,0,'C',1);
					$pdf->Cell(30,6,'Balance',1,0,'C',1);
					$pdf->SetY(70);
					$pdf->SetX(25);
					$y_axis = $y_axis + $row_height;
					$no=0;
					$pdf->Ln();
				}
				$pdf->SetX(4);
				$pdf->SetFont('Arial','',8);
				$pdf->Cell(12,6,$i,1,0,'C');
				$pdf->Cell(30,6,indo_date($row->cicilan_tgl),1,0,'C');
				$pdf->Cell(30,6,number_format($jmldenda),1,0,'R');
				$pdf->Cell(30,6,indo_date($row->cicilan_byr),1,0,'C');
				$pdf->Cell(30,6,number_format($row->cicilan_jml),1,0,'R');
				$pdf->Cell(30,6,number_format($sisa),1,0,'R');
				$pdf->Ln();
				$no++;
				$i++;
			}
			$pdf->SetX(4);
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(30,5,'Total Paid',2,0,'L');
			$pdf->Cell(6,5,':',2,0,'L');
			$pdf->Cell(10,5,number_format($jmlcicilan),2,0,'L');
			$pdf->Ln();
			$pdf->Cell(30,5,'Total Balance',2,0,'L');
			$pdf->Cell(6,5,':',2,0,'L');
			$pdf->Cell(10,5,number_format($sisa),2,0,'L');
		}
			$pdf->Output("hasil.pdf","I");	;
	}
}
