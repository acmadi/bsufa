<?php
/*
 * FUNGSI NUMERIK KE TERHITUNG
 * (c) 2008-2010 by amarullz@yahoo.com
 *
 */

function terbilang_get_valid($str,$from,$to,$min=1,$max=9){
	$val=false;
	$from=($from<0)?0:$from;
	for ($i=$from;$i<$to;$i++){
		if (((int) $str{$i}>=$min)&&((int) $str{$i}<=$max)) $val=true;
	}
	return $val;
}
function terbilang_get_str($i,$str,$len){
	$numA=array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
	$numB=array("","se","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
	$numC=array("","Satu ","Dua ","Tiga ","Empat ","Lima ","Enam ","Tujuh ","Delapan ","Sembilan ");
	$numD=array(0=>"puluh",1=>"belas",2=>"ratus",4=>"ribu", 7=>"juta", 10=>"milyar", 13=>"triliun");
	$buf="";
	$pos=$len-$i;
	switch($pos){
		case 1:
				if (!terbilang_get_valid($str,$i-1,$i,1,1))
					$buf=$numA[(int) $str{$i}];
			break;
		case 2:	case 5: case 8: case 11: case 14:
				if ((int) $str{$i}==1){
					if ((int) $str{$i+1}==0)
						$buf=($numB[(int) $str{$i}]).($numD[0]);
					else
						$buf=($numB[(int) $str{$i+1}]).($numD[1]);
				}
				else if ((int) $str{$i}>1){
						$buf=($numB[(int) $str{$i}]).($numD[0]);
				}				
			break;
		case 3: case 6: case 9: case 12: case 15:
				if ((int) $str{$i}>0){
						$buf=($numB[(int) $str{$i}]).($numD[2]);
				}
			break;
		case 4: case 7: case 10: case 13:
				if (terbilang_get_valid($str,$i-2,$i)){
					if (!terbilang_get_valid($str,$i-1,$i,1,1))
						$buf=$numC[(int) $str{$i}].($numD[$pos]);
					else
						$buf=$numD[$pos];
				}
				else if((int) $str{$i}>0){
					if ($pos==4)
						$buf=($numB[(int) $str{$i}]).($numD[$pos]);
					else
						$buf=($numC[(int) $str{$i}]).($numD[$pos]);
				}
			break;
	}
	return $buf;
}
function toRupiah($nominal){
	$buf="";
	$str=$nominal."";
	//$str=sprintf("%3.0f",$nominal); 
	$len=strlen($str);
	for ($i=0;$i<$len;$i++){
		$buf=trim($buf)." ".terbilang_get_str($i,$str,$len);
	}
	
	
	// do the cents - use printf so that we get the
	// same rounding as printf
	
	
	
	// $workstr = sprintf("%3.2f",$nominal); // convert to a string
	// $intstr = @substr($workstr, strlen - 2, 2);
	

	// $workint = (integer)($intstr);
	// if ($workint == 0){
	  // $buf .= "Nol";
	  // }else{
	  // $buf .= getwords_rupiah($workint);
	  // }
	// if ($workint == 1){
	  // $buf .= " Sen";
	  // }else{
	  // $buf .= " Sen";
	  // }	 
	 
	return trim($buf);
}

function toRupiah2($nominal){
	$buf="";
	$str=$nominal."";
	//$str=sprintf("%3.0f",$nominal); 
	$len=strlen($str);
	for ($i=0;$i<$len;$i++){
		$buf=trim($buf)." ".terbilang_get_str($i,$str,$len);
	}
	
	
	// do the cents - use printf so that we get the
	// same rounding as printf
	
	
	
	// $workstr = sprintf("%3.2f",$nominal); // convert to a string
	// $intstr = @substr($workstr, strlen - 2, 2);
	

	// $workint = (integer)($intstr);
	// if ($workint == 0){
	  // $buf .= "Nol";
	  // }else{
	  // $buf .= getwords_rupiah($workint);
	  // }
	// if ($workint == 1){
	  // $buf .= " Sen";
	  // }else{
	  // $buf .= " Sen";
	  // }	 
	 
	return trim($buf." Rupiah");
}


function toRupiah_leasing($nominal){
	$buf="";
	$buf2="";
	//$str=$nominal."";
	$str=sprintf("%3.0f",$nominal); 
	$len=strlen($str);
	for ($i=0;$i<$len;$i++){
		$buf=trim($buf)." ".terbilang_get_str($i,$str,$len);
	}
	
	
	// do the cents - use printf so that we get the
	// same rounding as printf
	
	
	
	$workstr = sprintf("%3.2f",$nominal); // convert to a string
	$intstr = @substr($workstr, strlen - 2, 2);
	

	$workint = (integer)($intstr);
	if ($workint == 0){
	  $buf2 .= "Nol";
	  }else{
	  $buf2 .= getwords_rupiah($workint);
	  }
	if ($workint == 1){
	  $buf2 .= " Sen";
	  }else{
	  $buf2 .= " Sen";
	  }	 
	 
	return trim($buf."Rupiah ". $buf2);
}

function toDollar($numval){
	$moneystr = "";
	// handle the millions
	$milval = (integer)($numval / 1000000);
	if($milval > 0)  {
	  $moneystr = getwords($milval) . " Million";
	  }
	 
	// handle the thousands
	$workval = $numval - ($milval * 1000000); // get rid of millions
	$thouval = (integer)($workval / 1000);
	if($thouval > 0)  {
	  $workword = getwords($thouval);
	  if ($moneystr == "")    {
		$moneystr = $workword . " Thousand";
		}else{
		$moneystr .= " " . $workword . " Thousand";
		}
	  }
	 
	// handle all the rest of the dollars
	$workval = $workval - ($thouval * 1000); // get rid of thousands
	$tensval = (integer)($workval);
	if ($moneystr == ""){
	  if ($tensval > 0){
		$moneystr = getwords($tensval);
		}else{
		$moneystr = "Zero";
		}
	  }else // non zero values in hundreds and up
	  {
	  $workword = getwords($tensval);
	  $moneystr .= " " . $workword;
	  }
	 
	// plural or singular 'dollar'
	$workval = (integer)($numval);
	if ($workval == 1){
	  $moneystr .= " Dollar And ";
	  }else{
	  $moneystr .= " Dollars And ";
	  }
	 
	// do the cents - use printf so that we get the
	// same rounding as printf
	$workstr = sprintf("%3.2f",$numval); // convert to a string
	$intstr = @substr($workstr, strlen - 2, 2);
	$workint = (integer)($intstr);
	if ($workint == 0){
	  $moneystr .= "Zero";
	  }else{
	  $moneystr .= getwords($workint);
	  }
	if ($workint == 1){
	  $moneystr .= " Cent";
	  }else{
	  $moneystr .= " Cents";
	  }
	 
	// done 
	return $moneystr;
	}
 
//*************************************************************
// this function creates word phrases in the range of 1 to 999.
// pass it an integer value
//*************************************************************
function getwords($workval)
	{
	$numwords = array(
	  1 => "One",
	  2 => "Two",
	  3 => "Three",
	  4 => "Four",
	  5 => "Five",
	  6 => "Six",
	  7 => "Seven",
	  8 => "Eight",
	  9 => "Nine",
	  10 => "Ten",
	  11 => "Eleven",
	  12 => "Twelve",
	  13 => "Thirteen",
	  14 => "Fourteen",
	  15 => "Fifteen",
	  16 => "Sixteen",
	  17 => "Seventeen",
	  18 => "Eighteen",
	  19 => "Nineteen",
	  20 => "Twenty",
	  30 => "Thirty",
	  40 => "Forty",
	  50 => "Fifty",
	  60 => "Sixty",
	  70 => "Seventy",
	  80 => "Eighty",
	  90 => "Ninety");
	 
	// handle the 100's
	$retstr = "";
	$hundval = (integer)($workval / 100);
	if ($hundval > 0){
	  $retstr = $numwords[$hundval] . " Hundred";
	  }
	 
	// handle units and teens
	$workstr = "";
	$tensval = $workval - ($hundval * 100); // dump the 100's
	 
	// do the teens
	if (($tensval < 20) && ($tensval > 0)){
	  $workstr = $numwords[$tensval];
	   // got to break out the units and tens
	  }else{
	  $tempval = ((integer)($tensval / 10)) * 10; // dump the units
	  $workstr = $numwords[$tempval]; // get the tens
	  $unitval = $tensval - $tempval; // get the unit value
	  if ($unitval > 0){
		$workstr .= " " . $numwords[$unitval];
		}
	  }
	 
	// join the parts together 
	if ($workstr != ""){
		if ($retstr != ""){
			$retstr .= " " . $workstr;
		}else{
		$retstr = $workstr;
		}
	  }
	return $retstr;
	}
	
	function getwords_rupiah($workval)
	{
	$numwords = array(
	  1 => "Satu",
	  2 => "Dua",
	  3 => "Tiga",
	  4 => "Empat",
	  5 => "Lima",
	  6 => "Enam",
	  7 => "Tujuh",
	  8 => "Delapan",
	  9 => "Sembilan",
	  10 => "Sepuluh",
	  11 => "Sebelas",
	  12 => "Dua belas",
	  13 => "Tiga belas",
	  14 => "Empat belas",
	  15 => "Lima belas",
	  16 => "Enam belas",
	  17 => "Tujuh belas",
	  18 => "Delapan belas",
	  19 => "Sembilan belas",
	  20 => "Dua puluh",
	  30 => "Tiga puluh",
	  40 => "Empat puluh",
	  50 => "Lima puluh",
	  60 => "Enam Puluh",
	  70 => "Tujuh puluh",
	  80 => "Delapan puluh",
	  90 => "Sembilan puluh");
	 
	// handle the 100's
	$retstr = "";
	$hundval = (integer)($workval / 100);
	if ($hundval > 0){
	  $retstr = $numwords[$hundval] . " Hundred";
	  }
	 
	// handle units and teens
	$workstr = "";
	$tensval = $workval - ($hundval * 100); // dump the 100's
	 
	// do the teens
	if (($tensval < 20) && ($tensval > 0)){
	  $workstr = $numwords[$tensval];
	   // got to break out the units and tens
	  }else{
	  $tempval = ((integer)($tensval / 10)) * 10; // dump the units
	  $workstr = $numwords[$tempval]; // get the tens
	  $unitval = $tensval - $tempval; // get the unit value
	  if ($unitval > 0){
		$workstr .= " " . $numwords[$unitval];
		}
	  }
	 
	// join the parts together 
	if ($workstr != ""){
		if ($retstr != ""){
			$retstr .= " " . $workstr;
		}else{
		$retstr = $workstr;
		}
	  }
	return $retstr;
	}



function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
} 

?>
