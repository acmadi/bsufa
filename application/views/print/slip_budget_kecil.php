<?php
extract(PopulateForm());

		$session_id = $this->UserLogin->isLogin(); 
		#$divisi_id = $session_id['divisi_id'];
		$pt = $session_id['id_pt'];
		$parent = $session_id['id_parent'];
		$div = $session_id['divisi_id'];
//die($parent.' '.$div);
$a = $cekdata['divisi_id'];
//die($div.' '.$a);
//die($parent);
require('fpdf/classpdf.php');
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(180,2);
$pdf->Cell(2,5,$cekkode,0,0,'L');
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(30,2);
$pdf->Cell(2,20,$cekdata['nama_pt'],0,0,'L');
$pdf->SetFont('Times','B',18);
$pdf->SetXY(2,20);
$pdf->Cell(205,10,"Proposed Budget",0,0,'C');
$pdf->SetFont('Times','',12);
$pdf->SetXY(4,35);
$pdf->Cell(0,5,"Date",0,1);
$pdf->SetXY(75,35);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,35);
$pdf->Cell(0,5,$cekdata['tgl_aju'] ,0,1);
$pdf->SetXY(4,45);
$pdf->Cell(0,5,"Division",0,1);
$pdf->SetXY(75,45);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,45);
$pdf->Cell(0,5,$cekdata['divisi_nm'],0,1);
$pdf->SetXY(4,55);
$pdf->Cell(0,5,"Request Amount",0,1);
$pdf->SetXY(75,55);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,55);
$pdf->Cell(0,5,"(In - Rp)",0,1);
$pdf->SetXY(190,55);
$pdf->Cell(0,5,$cekdata['amount'],0,1,"R",0);
$pdf->SetXY(4,65);
$pdf->Cell(0,5,"Budget No",0,1);
$pdf->SetXY(75,65);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,65);
$pdf->Cell(0,5,$cekdata['code_acc'],0,1);
$pdf->SetXY(4,75);
$pdf->Cell(0,5,"Budget Descr",0,1);
$pdf->SetXY(75,75);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,75);
$pdf->Cell(0,5,$cekdata['descbgt'],0,1);
$pdf->SetXY(4,85);
$pdf->Cell(0,5,"Status",0,1);
$pdf->SetXY(75,85);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,85);
$pdf->Cell(0,5,$cekdata['status'],0,1);
$pdf->SetXY(2,100);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(205,5,"Balance Info",0,0,'C');
//$pdf->SetLineWidth(0.3);
//$pdf->Line(5,105,200,105);
$pdf->SetFont('Times','',12);
$pdf->SetXY(4,110);
$pdf->Cell(0,5,"Annual Budget",0,1);
$pdf->SetXY(75,110);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,110);
$pdf->Cell(0,5,"(In - Rp)",0,1);
$pdf->SetXY(190,110);
$pdf->Cell(0,5,$cekdata['annu_tot'],0,1,"R",0);
$pdf->SetXY(4,120);
$pdf->Cell(0,5,"Balance - Annual Budget",0,1);
$pdf->SetXY(75,120);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,120);
$pdf->Cell(0,5,"(In - Rp)",0,1);
$pdf->SetXY(190,120);
$pdf->Cell(0,5,$cekdata['blc_ann'],0,1,"R",0);
$pdf->SetXY(4,130);
$pdf->Cell(0,5,"Budget YTD",0,1);
$pdf->SetXY(75,130);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,130);
$pdf->Cell(0,5,"(In - Rp)",0,1);
$pdf->SetXY(190,130);
$pdf->Cell(0,5,$cekdata['bgt_ytd'],0,1,"R",0);
$pdf->SetXY(4,140);
$pdf->Cell(0,5,"Used - Budget YTD",0,1);
$pdf->SetXY(75,140);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,140);
$pdf->Cell(0,5,"(In - Rp)",0,1);
$pdf->SetXY(190,140);
$pdf->Cell(0,5,$cekdata['actytd'],0,1,"R",0);
$pdf->SetXY(4,150);
$pdf->Cell(0,5,"Balance - Budget YTD",0,1);
$pdf->SetXY(75,150);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,150);
$pdf->Cell(0,5,"(In - Rp)",0,1);
$pdf->SetXY(190,150);
$pdf->Cell(0,5,$cekdata['blc_ytd'],0,1,"R",0);
$pdf->SetXY(4,160);
$pdf->Cell(0,5,"Balance - Budget Division This Month",0,1);
$pdf->SetXY(75,160);
$pdf->Cell(0,5,":",0,1);
$pdf->SetXY(80,160);
$pdf->Cell(0,5,"(In - Rp)",0,1);
$pdf->SetXY(190,160);
$pdf->Cell(0,5,$cekdata['blc_divmonth'],0,1,"R",0);
$pdf->SetXY(4,170);
$pdf->Cell(0,5,"Remark :",0,1);
$pdf->SetXY(5,175);
$pdf->cell(200,12,$cekdata['remark'],1,10,'L');

if($parent == '1203' ){
	

$pdf->SetFont('Times','B',12);
$pdf->SetXY(5,195);
$pdf->Cell(0,5,"Prepared by :",0,1);
$pdf->SetXY(85,195);
$pdf->Cell(0,5,"Acknowledge by :",0,1);
$pdf->SetXY(175,195);
$pdf->Cell(0,5,"Approved by :",0,1);
$pdf->SetFont('Times','',12);
$pdf->SetXY(5,230);
$pdf->Cell(0,5,"(Admin)",0,1);
$pdf->SetXY(85,230);
$pdf->Cell(0,5,"(Manager)",0,1);
$pdf->SetXY(70,230);
$pdf->SetXY(175,230);
$pdf->Cell(0,5,"(FC Manager)",0,1);

}elseif($parent == '1202' ){
	

$pdf->SetFont('Times','B',12);
$pdf->SetXY(5,195);
$pdf->Cell(0,5,"Prepared by :",0,1);
$pdf->SetXY(85,195);
$pdf->Cell(0,5,"Acknowledge by :",0,1);
$pdf->SetXY(175,195);
$pdf->Cell(0,5,"Approved by :",0,1);
$pdf->SetFont('Times','',12);
$pdf->SetXY(5,230);
$pdf->Cell(0,5,"(Admin)",0,1);
$pdf->SetXY(85,230);
$pdf->Cell(0,5,"(Manager)",0,1);
$pdf->SetXY(70,230);
$pdf->SetXY(175,230);
$pdf->Cell(0,5,"(FC Manager)",0,1);

}elseif($parent == '1201' ){
	

$pdf->SetFont('Times','B',12);
$pdf->SetXY(5,195);
$pdf->Cell(0,5,"Prepared by :",0,1);
$pdf->SetXY(85,195);
$pdf->Cell(0,5,"Acknowledge by :",0,1);
$pdf->SetXY(175,195);
$pdf->Cell(0,5,"Approved by :",0,1);
$pdf->SetFont('Times','',12);
$pdf->SetXY(5,230);
$pdf->Cell(0,5,"(Admin)",0,1);
$pdf->SetXY(85,230);
$pdf->Cell(0,5,"(Manager)",0,1);
$pdf->SetXY(70,230);
$pdf->SetXY(175,230);
$pdf->Cell(0,5,"(FC Manager)",0,1);

}
/*
/*
/*
elseif($parent == '113'){
$pdf->SetFont('Times','B',12);
$pdf->SetXY(5,195);
$pdf->Cell(0,5,"Prepared by :",0,1);
$pdf->SetXY(175,195);
$pdf->Cell(0,5,"Approved by :",0,1);
$pdf->SetFont('Times','',12);
$pdf->SetXY(5,230);
$pdf->Cell(0,5,"(Admin Divisi)",0,1);
$pdf->SetXY(70,230);
$pdf->SetXY(175,230);
$pdf->Cell(0,5,"(Div. Head)",0,1);
*/


else{
$pdf->SetFont('Times','B',12);
$pdf->SetXY(5,195);
$pdf->Cell(0,5,"Prepared by :",0,1);
$pdf->SetXY(175,195);
$pdf->Cell(0,5,"Approved by :",0,1);
$pdf->SetFont('Times','',12);
$pdf->SetXY(5,230);
$pdf->Cell(0,5,"(Admin Divisi)",0,1);
$pdf->SetXY(70,230);
$pdf->SetXY(175,230);
$pdf->Cell(0,5,"(Div. Head)",0,1);
}
$url= "reprint/Budget".$cekdata['last_id'].".pdf";
//$url= "Budget".$cekdata['last_id'].".pdf";
$pdf->Output($url);
	//$pdf->Output($url,"I");
redirect($url);

