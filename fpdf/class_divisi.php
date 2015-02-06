<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
//Page header
function Header()
{
    $this->Image('http://localhost/bsuportal/assets/images/bakrie.JPG',4,8,20);
    $this->SetFont('Arial','B',12);
    #$this->SetX(25);
    #$this->Cell(0,10,'PT. Bakrie Swasakti Utama',20,0,'L');
	$this->SetLineWidth(0.5);
	$this->Line(5,32,295,32);
	$this->SetLineWidth(0);
	$this->SetFont('Arial','',10);
	$this->setFillColor(222,222,222);
	$this->SetXY(5,38);
	$this->Cell(55,13,'DIVISION',1,0,'C',1);
	$this->SetXY(60,38);
	$this->Cell(75,7,'THIS MONTH',1,0,'C',1);
	$this->SetXY(135,38);
	$this->Cell(75,7,'YTD',1,0,'C',1);
	$this->SetXY(210,38);
	$this->Cell(75,7,'ANNUAL',1,0,'C',1);
}


function AddCol($field=-1,$width=-1,$caption='',$align='L')
{
    //Add a column to the table
    if($field==-1)
        $field=count($this->aCols);
    $this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
}



//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}



}


