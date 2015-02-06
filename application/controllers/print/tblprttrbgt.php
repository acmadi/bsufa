<?php
class tblprttrbgt Extends Controller{
	function __construct(){
		parent::controller();
		$this->load->Model('tblprttrbgt_model','printrequestbgt');
		$this->load->Model('UserLogin','user');	
	}

	function index(){
		$session_id = $this->user->isLogin();
		$id =  $session_id['id'];		
		$group = $session_id['class'];
		$level = $session_id['level_id'];
			
		$data = $this->printrequestbgt->get_data($group);

		require('fpdf/classpdfbudget.php');
		$pdf=new PDF('L','mm','A4');
		$pdf->SetMargins(2,10,2);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		#Header print I Request
		$pdf->SetFont('Arial','B',12);
		$pdf->setXY(25,15);
		$pdf->Cell(0,10,'Actual Budget Tahun 2011',20,0,'L');
		$pdf->setXY(24,20);
		$pdf->Cell(0,10,'',20,0,'L');
		
		$y_axis_initial = 40;
		$y_axis = 0;
		$pdf->SetFont('Arial','',8);
		$pdf->setFillColor(222,222,222);
		$pdf->SetY($y_axis_initial);
		$pdf->SetX(4);
		$pdf->Cell(8,6,'No',1,0,'C',1);
		$pdf->Cell(18,6,'Budget ID',1,0,'C',1);
		$pdf->Cell(25,6,'Date',1,0,'C',1);
		$pdf->Cell(35,6,'Division',1,0,'C',1);
		$pdf->Cell(170,6,'Description',1,0,'C',1);
		$pdf->Cell(35,6,'Nilai',1,0,'C',1);
		$pdf->Ln();
		$max=20;
		$row_height = 6;
		$y_axis = $y_axis + $row_height;
		$no=0;
		$i = 1;
		foreach($data as $row){
			if($no==$max){
				$pdf->AddPage();
				#Header print II Request
				$pdf->SetFont('Arial','B',12);
				$pdf->setXY(25,15);
				$pdf->Cell(0,10,'Actual Tahun 2011',20,0,'L');
				$pdf->SetFont('Arial','',8);
				$pdf->SetY(40);
				$pdf->SetX(4);
				$pdf->Cell(8,6,'No',1,0,'C',1);
				$pdf->Cell(18,6,'Budget ID',1,0,'C',1);
				$pdf->Cell(25,6,'Date',1,0,'C',1);
				$pdf->Cell(35,6,'Division',1,0,'C',1);
				$pdf->Cell(170,6,'Description',1,0,'C',1);
				$pdf->Cell(35,6,'Nilai',1,0,'C',1);
				$pdf->SetY(40);
				$pdf->SetX(25);
				$y_axis = $y_axis + $row_height;
				$no=0;
				$pdf->Ln();
			}
			$pdf->SetX(4);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(8,6,$i,1,0,'C');
			$pdf->Cell(18,6,$row->code,1,0,'C');
			$pdf->Cell(25,6,$row->date,1,0,'C');
			$pdf->Cell(35,6,$row->group_name,1,0,'C');#$row->group_name,1);
			$pdf->Cell(170,6,$row->remark,1);
			$pdf->Cell(35,6,number_format($row->amount,","),1,0,"R");
			$pdf->Ln();
			$i++;
			$no++;
		}
				
		$pdf->Output("hasil.pdf","I");
	}
}
