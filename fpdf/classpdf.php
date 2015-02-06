<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
//Page header
function Header()
{
   // $this->Image('http://localhost/bsuportal/assets/images/bakrie.JPG',4,8,20);
	/*$this->SetLineWidth(0.5);
	$this->Line(5,28,500,28);*/
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

function TextWithDirection($x, $y, $txt, $direction='R')
{
    if ($direction=='R')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',1,0,0,1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='L')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',-1,0,0,-1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='U')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,1,-1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    elseif ($direction=='D')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,-1,1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    else
        $s=sprintf('BT %.2F %.2F Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}

function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
{
    $font_angle+=90+$txt_angle;
    $txt_angle*=M_PI/180;
    $font_angle*=M_PI/180;

    $txt_dx=cos($txt_angle);
    $txt_dy=sin($txt_angle);
    $font_dx=cos($font_angle);
    $font_dy=sin($font_angle);

    $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}

function Output($name='',$dest='')
{
        //Output PDF to some destination
        //Finish document if necessary
        if($this->state<3)
                $this->Close();
        //Normalize parameters
        if(is_bool($dest))
                $dest=$dest ? 'D' : 'F';
        $dest=strtoupper($dest);
        if($dest=='')
        {
                if($name=='')
                {
                        $name='doc.pdf';
                        $dest='I';
                }
                else
                        $dest='F';
        }
        switch($dest)
        {
                case 'I':
                        //Send to standard output
                        if(ob_get_contents())
                                $this->Error('Some data has already been output, can\'t send PDF file');
                        if(php_sapi_name()!='cli')
                        {
                                //We send to a browser
                                header('Content-Type: application/pdf');
                                if(headers_sent())
                                        $this->Error('Some data has already been output to browser, can\'t send PDF file');
                                header('Content-Length: '.strlen($this->buffer));
                                header('Content-disposition: inline; filename="'.$name.'"');
                        }
                        echo $this->buffer;
                        break;
                case 'D':
                        //Download file
                        if(ob_get_contents())
                                $this->Error('Some data has already been output, can\'t send PDF file');
                        if(isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
                                header('Content-Type: application/force-download');
 else
                                header('Content-Type: application/octet-stream');
                        if(headers_sent())
                                $this->Error('Some data has already been output to browser, can\'t send PDF file');
                        header('Content-Length: '.strlen($this->buffer));
                        header('Content-disposition: attachment; filename="'.$name.'"');
                        echo $this->buffer;
                        break;
                case 'F':
                        //Save to local file
                        $f=fopen($name,'wb');
                        if(!$f)
                                $this->Error('Unable to create output file: '.$name);
                        fwrite($f,$this->buffer,strlen($this->buffer));
                        fclose($f);
                        break;
                case 'S':
                        //Return as a string
                        return $this->buffer;
                default:
                        $this->Error('Incorrect output destination: '.$dest);
        }
        return '';
} 


}

