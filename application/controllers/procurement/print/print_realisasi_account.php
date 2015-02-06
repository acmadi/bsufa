<?php
class print_realisasi_account extends controller{
	function index(){
		extract(PopulateForm());
		//Converting Tanggal
		list($d1,$m1,$y1) = split("-",$tgl1);
		//list($d2,$m2,$y2) = split("-",$tgl2);
		$tglawal  = $y1."-".$m1."-".$d1; 
		//$tglakhir = $y2."-".$m2."-".$d2;
		//cek array budget
		$arrbgt = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7",
		"bgt8","bgt9","bgt10","bgt11","bgt12");
		//Cek nama PT
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];				
		$data_pt = $this->mstmodel->get_nama_pt($pt);
		$nama_pt = "PT \t".$data_pt['ket'];
		

		/*for($i=intval($m1);$i<=intval($m2);$i++){
			$bgt = $arrbgt[$i];
			$rowbgt = $this->db->select_sum($bgt)
							  ->where('code',$code)
							  ->get('db_mstbgt')->row();
			$tot = $tot + $rowbgt->$bgt;
		}*/
		
		//Data untuk di Looping
		$data = $this->mstmodel->realisasi_item($code,$tglawal,$thn);
		$dtbgt = $this->mstmodel->cekmstbudget($code,$thn);
		if($dtbgt > 0){
			$dtbgt = $this->mstmodel->getmstbudget($code,$thn,$pt);
			$tot = $dtbgt->tot_mst;
			$descbgt = $dtbgt->descbgt;	
		}else{
			die("Data Not Found");
		}
			
		
		require('fpdf/classreport.php');
		$pdf=new PDF('L','mm','A4');
		$pdf->SetMargins(2,10,2);
		$pdf->AliasNbPages();
		$pdf->AddPage();
				
		#header
		$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);
		$pdf->setFillColor(222,222,222);
		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(25,10);
		$pdf->Cell(50,6,$nama_pt,2,0,'L');
		$pdf->SetFont('Arial','B',12);
		$pdf->SetXY(25,16);
		$pdf->Cell(50,6,'Mutasi Realisasi Budget  '.$thn,2,0,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->SetXY(25,22);
		$pdf->Cell(30,6,'Code',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$code,2,0,'L');
		$pdf->SetXY(25,28);
		$pdf->Cell(30,6,'Description',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$descbgt,2,0,'L');
		$pdf->SetXY(25,34);
		$pdf->Cell(30,6,'Amount',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,number_format($tot),2,0,'L');
		$pdf->SetXY(25,40);
		$pdf->Cell(30,6,'As Off',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$tgl1,2,0,'L');
		/*$pdf->SetXY(25,56);
		$pdf->Cell(30,6,'Tahun',2,0,'L');
		$pdf->Cell(10,6,':',2,0,'C');
		$pdf->Cell(30,6,$thn,2,0,'L');*/		
		#end header
		
		//$pdf->SetLineWidth(0.5);
		//$pdf->Line(5,40,500,40);
		$y_axis_initial = 50;
		$y_axis = 0;
		$pdf->SetFont('Arial','',10);
		$pdf->setFillColor(222,222,222);
		$pdf->SetY($y_axis_initial);
		$pdf->SetX(5);
		$pdf->Cell(15,6,'No',1,0,'C',1);
		$pdf->Cell(50,6,'Date',1,0,'C',1);
		$pdf->Cell(50,6,'Realisasi Budget',1,0,'C',1);
		$pdf->Cell(50,6,'Balanced Budget',1,0,'C',1);
		$pdf->Cell(100,6,'Remark',1,0,'C',1);
		$pdf->Ln();	
		$max=35;
		$row_height = 6;
		$y_axis = $y_axis + $row_height;
		$no=0;
		$totreal = 0;
		$totamount = 0;
		foreach($data as $row){
			if ($no == $max){
				#header
				$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);
				$pdf->setFillColor(222,222,222);
				$pdf->SetFont('Arial','B',14);
				$pdf->SetXY(25,10);
				$pdf->Cell(50,6,'Mutasi Realisasi Budget  '.$thn,2,0,'L');
				$pdf->SetFont('Arial','B',10);
				$pdf->SetXY(25,15);
				$pdf->Cell(30,6,'Code',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,$code,2,0,'L');
				$pdf->SetXY(25,20);
				$pdf->Cell(30,6,'Description',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,$dtbgt->descbgt,2,0,'L');
				$pdf->SetXY(25,25);
				$pdf->Cell(30,6,'Amount',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,number_format($tot),2,0,'L');
				$pdf->SetXY(25,30);
				$pdf->Cell(30,6,'As Off',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,$tgl1,2,0,'L');
				$pdf->SetXY(25,35);
				$pdf->Cell(30,6,'Tahun',2,0,'L');
				$pdf->Cell(10,6,':',2,0,'C');
				$pdf->Cell(30,6,$thn,2,0,'L');		
				#end header
		
				//$pdf->SetLineWidth(0.5);
				//$pdf->Line(5,40,500,40);
				$y_axis_initial = 50;
				$y_axis = 0;
				$pdf->SetFont('Arial','',10);
				$pdf->setFillColor(222,222,222);
				$pdf->SetY($y_axis_initial);
				$pdf->SetX(5);
				$pdf->Cell(15,6,'No',1,0,'C',1);
				$pdf->Cell(50,6,'Date',1,0,'C',1);
				$pdf->Cell(50,6,'Realisasi Budget',1,0,'C',1);
				$pdf->Cell(50,6,'Balanced Budget',1,0,'C',1);
				$pdf->Cell(100,6,'Remark',1,0,'C',1);
				$pdf->Ln();	
				$row_height = 6;
				$y_axis = $y_axis + $row_height;
				$no=0;				
				}
			$no++;
			$real = $row->amount;
			$totreal = $totreal + $real;
			$jml = $tot - $totreal;
			$last_id = $row->id_trbgt;
			//var_dump($jml);exit;
			if($jml >= 0){
				$amount = number_format($jml);
				$pdf->SetFont('Arial','B',8);
				$pdf->SetX(5);
				$pdf->Cell(15,6,$no,2,0,'C');
				$pdf->Cell(50,6,indo_date($row->tanggal),2,0,'C');
				$pdf->Cell(50,6,number_format($real),2,0,'R');
				$pdf->Cell(50,6,$amount,2,0,'R');
				$pdf->Cell(100,6,$row->remark,0,'L');
				$pdf->Ln();
			}else{
				$amount = "(".number_format(-($jml)).")";
				$pdf->SetFont('Arial','B',8);
				$pdf->SetX(5);
				$pdf->Cell(15,6,$no,2,0,'C');
				$pdf->Cell(50,6,indo_date($row->tanggal),2,0,'C');
				$pdf->Cell(50,6,number_format($real),2,0,'R');
				$pdf->Cell(50,6,$amount,2,0,'R');
				$pdf->Cell(100,6,$row->remark,0,'L');
				$pdf->Ln();
			}
		
		}
		//$pdf->Cell(270,0,'',1,0,'L');
		$pdf->Ln();
		$pdf->SetX(5);		
		$pdf->Cell(65,6,'Total',2,0,'L');
		$pdf->Cell(50,6,number_format($totreal),2,0,'R');
		$pdf->Cell(50,6,'',2,0,'R');
		$pdf->Cell(100,6,'',0,'L');

        $thn2 = substr($tgl1,6,4);
        if($thn != $thn2) echo"PDF error Cek Tahun dan As Off";
        else $pdf->Output();

	}
}


