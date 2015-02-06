<?php


		#Print Budget	
		/*require('fpdf/classpdf.php');
		$pdf=new PDF('L','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',18);
		$pdf->Cell(0,15,'PROPOSED BUDGET FORM',20,0,'C');


		//Line break
		$pdf->Ln(15);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetXY(250,2);
		$pdf->Cell(2,5,"tgl_aju/no_urut",0,0,'L');
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(10,30);
		$pdf->Cell(0,5,"Proposed Date",0,1);
		$pdf->SetXY(46,30);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(49,30);
		$pdf->Cell(0,5,"%tgl_aju",0,1);
		$pdf->SetXY(10,37);
		$pdf->Cell(0,5,"Proposed Amount",0,1);
		$pdf->SetXY(46,37);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(49,37);
		$pdf->Cell(0,5,"%amount",0,1);
		$pdf->SetXY(10,44);
		$pdf->Cell(0,5,"Status",0,1);
		$pdf->SetXY(46,44);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(49,44);
		$pdf->Cell(40,5,"%status",0,1,'L');
		$pdf->SetXY(10,51);
		$pdf->Cell(0,5,"Divisi",0,1);
		$pdf->SetXY(46,51);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(49,51);
		$pdf->Cell(0,5,"%row2->divisi_nm",0,1);
		
		$pdf->SetXY(110,30);
		$pdf->Cell(0,5,"BGT. Account",0,1);
		$pdf->SetXY(140,30);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(143,30);
		$pdf->Cell(0,5,"%row->code",0,1);
		$pdf->SetXY(110,37);
		$pdf->Cell(0,5,"BGT. Desc",0,1);
		$pdf->SetXY(140,37);
		$pdf->Cell(0,5,":",0,1);
		$pdf->SetXY(143,37);
		$pdf->Cell(0,5,"%row->descbgt",0,1);
		
		
		$pdf->SetFont('Arial','B',14);
		$pdf->SetXY(10,58);
		$pdf->Cell(90,8,"DETAIL BUDGET",1,1,'C');
		$pdf->SetXY(101,58);
		$pdf->Cell(90,8,"DIVISON BUDGET",1,1,'C');
		$pdf->SetXY(192,58);
		$pdf->Cell(90,8,"ALL BUDGET",1,1,'C');
		
		#Budget Detail
		
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(10,68);
		$pdf->Cell(40,5,"Budget Month",0,1);
		$pdf->SetXY(51,68);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,68);
		$pdf->Cell(45,5,"%bgt_month",0,1,'R');
		$pdf->SetXY(10,75);
		$pdf->Cell(40,5,"Actual Month",0,1);
		$pdf->SetXY(51,75);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,75);
		$pdf->Cell(45,5,"%actmonth",0,1,'R');
		$pdf->SetXY(10,83);
		$pdf->Cell(40,5,"Balanced Month",0,1);
		$pdf->SetXY(51,83);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,83);
		$pdf->Cell(45,5,"%blc_month",0,1,'R');
		$pdf->SetXY(10,90);
		$pdf->Cell(40,5,"Budget YTD",0,1);
		$pdf->SetXY(51,90);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,90);
		$pdf->Cell(45,5,"%bgt_ytd",0,1,'R');
		$pdf->SetXY(10,97);
		$pdf->Cell(40,5,"Actual YTD",0,1);
		$pdf->SetXY(51,97);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,97);
		$pdf->Cell(45,5,"%actytd",0,1,'R');
		$pdf->SetXY(10,104);
		$pdf->Cell(40,5,"Balanced YTD",0,1);
		$pdf->SetXY(51,104);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,104);
		$pdf->Cell(45,5,"%blc_ytd",0,1,'R');
		$pdf->SetXY(10,111);
		$pdf->Cell(40,5,"Budget Annual",0,1);
		$pdf->SetXY(51,111);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,111);
		$pdf->Cell(45,5,"%annu_tot",0,1,'R');
		$pdf->SetXY(10,118);
		$pdf->Cell(40,5,"Actual Annual",0,1);
		$pdf->SetXY(51,118);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,118);
		$pdf->Cell(45,5,"%actann",0,1,'R');
		$pdf->SetXY(10,125);
		$pdf->Cell(40,5,"Balanced Annual",0,1);
		$pdf->SetXY(51,125);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(54,125);
		$pdf->Cell(45,5,"%blc_ann",0,1,'R');
		
		
		//Budget Divisi
				
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(101,68);
		$pdf->Cell(40,5,"Budget Month",0,1);
		$pdf->SetXY(142,68);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,68);
		$pdf->Cell(45,5,"%totmnthdiv",0,1,'R');
		$pdf->SetXY(101,75);
		$pdf->Cell(40,5,"Actual Month",0,1);
		$pdf->SetXY(142,75);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,75);
		$pdf->Cell(45,5,"%actdivmonth",0,1,'R');
		$pdf->SetXY(101,83);
		$pdf->Cell(40,5,"Balanced Month",0,1);
		$pdf->SetXY(142,83);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,83);
		$pdf->Cell(45,5,"%blc_divmonth",0,1,'R');
		$pdf->SetXY(101,90);
		$pdf->Cell(40,5,"Budget YTD",0,1);
		$pdf->SetXY(142,90);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,90);
		$pdf->Cell(45,5,"%totytddiv",0,1,'R');
		$pdf->SetXY(101,97);
		$pdf->Cell(40,5,"Actual YTD",0,1);
		$pdf->SetXY(142,97);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,97);
		$pdf->Cell(45,5,"%actdivytd",0,1,'R');
		$pdf->SetXY(101,104);
		$pdf->Cell(40,5,"Balanced YTD",0,1);
		$pdf->SetXY(142,104);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,104);
		$pdf->Cell(45,5,"%blc_divytd",0,1,'R');
		$pdf->SetXY(101,111);
		$pdf->Cell(40,5,"Budget Annual",0,1);
		$pdf->SetXY(142,111);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,111);
		$pdf->Cell(45,5,"%totdiv",0,1,'R');
		$pdf->SetXY(101,118);
		$pdf->Cell(40,5,"Actual Annual",0,1);
		$pdf->SetXY(142,118);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,118);
		$pdf->Cell(45,5,"%actdivann",0,1,'R');
		$pdf->SetXY(101,125);
		$pdf->Cell(40,5,"Balanced Annual",0,1);
		$pdf->SetXY(142,125);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(145,125);
		$pdf->Cell(45,5,"%blc_divann",0,1,'R');
		
		
		#Cetak Budget All Divisi
		
		$pdf->SetFont('Times','',12);
		$pdf->SetXY(192,68);
		$pdf->Cell(40,5,"Budget Month",0,1);
		$pdf->SetXY(233,68);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,68);
		$pdf->Cell(45,5,"%totmnthalldiv",0,1,'R');
		$pdf->SetXY(192,75);
		$pdf->Cell(40,5,"Actual Month",0,1);
		$pdf->SetXY(233,75);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,75);
		$pdf->Cell(45,5,"%actalldivmonth",0,1,'R');
		$pdf->SetXY(192,83);
		$pdf->Cell(40,5,"Balanced Month",0,1);
		$pdf->SetXY(233,83);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,83);
		$pdf->Cell(45,5,"%blcmnthalldiv",0,1,'R');
		$pdf->SetXY(192,90);
		$pdf->Cell(40,5,"Budget YTD",0,1);
		$pdf->SetXY(233,90);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,90);
		$pdf->Cell(45,5,"%totytdalldiv",0,1,'R');
		$pdf->SetXY(192,97);
		$pdf->Cell(40,5,"Actual YTD",0,1);
		$pdf->SetXY(233,97);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,97);
		$pdf->Cell(45,5,"%actalldivytd",0,1,'R');
		$pdf->SetXY(192,104);
		$pdf->Cell(40,5,"Balanced YTD",0,1);
		$pdf->SetXY(233,104);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,104);
		$pdf->Cell(45,5,"%blcytdalldiv",0,1,'R');
		$pdf->SetXY(192,111);
		$pdf->Cell(40,5,"Budget Annual",0,1);
		$pdf->SetXY(233,111);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,111);
		$pdf->Cell(45,5,"%totalldiv"	,0,1,'R');
		$pdf->SetXY(192,118);
		$pdf->Cell(40,5,"Actual Annual",0,1);
		$pdf->SetXY(233,118);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,118);
		$pdf->Cell(45,5,"%actalldivann",0,1,'R');
		$pdf->SetXY(192,125);
		$pdf->Cell(40,5,"Balanced Annual",0,1);
		$pdf->SetXY(233,125);
		$pdf->Cell(2,5,":",0,1);
		$pdf->SetXY(236,125);
		$pdf->Cell(45,5,"%blcalldiv",0,1,'R');
		
		#Approval 
		
			 	$pdf->SetFont('Arial','B',10);
				$pdf->SetXY(10,140);
				$pdf->Cell(90,8,"ISSUE BY:",1,1,'C');
				
				$pdf->SetXY(101,140);
				$pdf->Cell(90,8,"REVIEW BY:",1,1,'C');
				$pdf->SetXY(192,140);
				$pdf->Cell(45,8,"APPROVAL BY:",1,1,'C');
				
				$pdf->SetFont('Arial','',8);
				$pdf->SetXY(10,148);
				$pdf->Cell(45,5,"Prepare By:",1,1,'C');
				$pdf->SetXY(55,148);
				$pdf->Cell(45,5,"Proposed By:",1,1,'C');
				$pdf->SetXY(101,148);
				$pdf->Cell(45,35,"",1,1,'C');
				$pdf->SetXY(146,148);
				$pdf->Cell(45,35,"",1,1,'C');
				
				$pdf->SetXY(192,148);
				$pdf->Cell(45,35,"",1,1,'C');
				
				
				
				$pdf->SetXY(10,153);
				$pdf->Cell(45,30,"",1,1,'C');
				$pdf->SetXY(55,153);
				$pdf->Cell(45,30,"",1,1,'C');
				
				
				$pdf->SetXY(10,183);
				$pdf->Cell(45,5,"Name:",1,1,'L');
				$pdf->SetXY(55,183);
				$pdf->Cell(45,5,"Name:",1,1,'L');
				$pdf->SetXY(101,183);
				$pdf->Cell(45,5,"BUDGET CONTROL",1,1,'C');
				$pdf->SetXY(146,183);
				$pdf->Cell(45,5,"CHIEF FINANCE OFFICER",1,1,'C');
				$pdf->SetXY(192,183);
				$pdf->Cell(45,5,"DIRECTOR",1,1,'C');
				
		
		
		
		
		
		$pdf->Output();*/
