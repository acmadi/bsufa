<?php
class print_summary_budget extends controller{
	function index(){
		require('fpdf/classpdf.php');	
		$pdf=new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',22);
		$pdf->SetXY(2,25);
		$pdf->Cell(206,5,'Summary Budget Expenses',0,0,'C');
		$pdf->SetFont('Times','',10);
		$pdf->setFillColor(222,222,222);
		$pdf->SetXY(10,40);
		$pdf->Cell(50,6,'Expenses',1,0,'C',1);
		$pdf->Cell(40,6,'Budget',1,0,'C',1);
		$pdf->Cell(40,6,'Proposed',1,0,'C',1);
		$pdf->Cell(40,6,'Realisasi',1,0,'C',1);
		$pdf->Ln();		
		$arr = array("6.01","6.02","6.03");
		$cat = array("General Expenses","Marketing Expenses","Personal Expenses");
		$tot1 = 0;
		$tot2 = 0;
		$tot3 = 0;
		
		$session_id = $this->UserLogin->isLogin();
		$pt = $session_id['id_pt'];
		$divisi = $session_id['id_pt'];
		
		for($i = 0 ; $i < 3 ; $i++)
		{
			//Pengecekan nilai Budget
			$nil = $arr[$i];
			$row1 = $this->mstmodel->sumglobal("db_mstbgt","substring(acc,1,4)",$nil,"tot_mst",$divisi,$pt);
			$dt1 = $row1->tot_mst;
			$num1 = ceil($dt1 / 1000000);
			$data_1[] =  (string) $num1;
			
			//Pengecekan nilai proposed
			$row2 = $this->db->select_sum('amount')
							 ->join('db_mstbgt','code = code_id')
							 ->where('substring(acc,1,4)',$nil)
							 ->where('db_trbgtdiv.flag_id',0)
							 ->get('db_trbgtdiv')
							 ->row();
			$dt2 = $row2->amount;
			$num2 = ceil($dt2 / 1000000);
			$data_2[] =  (string) $num2;
			
			
			//Pengecekan nilai Realisasi
			$row3 = $this->db->select_sum('amount')
							 ->join('db_mstbgt','code = code_id')
							 ->where('substring(acc,1,4)',$nil)
							 ->where('db_trbgtdiv.flag_id',1)
							 ->get('db_trbgtdiv')
							 ->row();
			$dt3 = $row3->amount;
			$num3 = ceil($dt3 / 1000000);
			$data_3[] =  (string) $num3;
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(50,6,$cat[$i],1,0,'L');
			$pdf->Cell(40,6,number_format($dt1,","),1,0,'R');
			$pdf->Cell(40,6,number_format($dt2,","),1,0,'R');
			$pdf->Cell(40,6,number_format($dt3,","),1,0,'R');
			$tot1 = $tot1 + $dt1;
			$tot2 = $tot2 + $dt2;
			$tot3 = $tot3 + $dt3;
			$pdf->Ln();	
								 
		}	
			$pdf->Cell(50,6,"Total :",1,0,'L');
			$pdf->Cell(40,6,number_format($tot1,","),1,0,'R');
			$pdf->Cell(40,6,number_format($tot2,","),1,0,'R');
			$pdf->Cell(40,6,number_format($tot3,","),1,0,'R');			
		$pdf->Output();		
	}
}
