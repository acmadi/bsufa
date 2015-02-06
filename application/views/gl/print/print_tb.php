<?php


			
			
		
			require('fpdf/tanpapage.php');
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
			$tglx = date('Ym',strtotime($tgl));
			$tgly = date('Y-m-d',strtotime($tgl));
			$tglz = date('Y-m-d',strtotime($tgl2));
			$tgla = $tgl2;
			// die($tgly);
			if ($project_detail==0){			
			$data = $this->db->query("sp_listtrbal_periode '".$print."','".$tgly."','".$tglz."'")->result();
			}else{
			$data = $this->db->query("sp_listtrbal_periode_console '".$print."','".$tgly."','".$tglz."',".$project_detail."")->result();
			}
			
			//$data = $this->db->query("sp_listtrbal_periode '".$print."','".$tgly."','".$tglz."'")->result();
			//die(inggris_date($tgl));
			
			
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			#HEAD
			#HEADER CONTENT
				$pt			= "PT BAKRIE SWASAKTI UTAMA";
				$judul 		= "Report Trial Balance";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				$tgl2  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl2,0,0,'L');
			
			#Header
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L');
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Periode'.' : '.inggris_date($tgl). ' s/d '.inggris_date($tgla),20,0,'L');
				//$pdf->Cell(0,10,'As Of'.' : '.$tgl,20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(3);
			
			// Start Isi Tabel
			
			
			
			$pdf->SetFont('Arial','B',8);
			
			
			
			$pdf->Cell(30,5,'Account No.',1,0,'C',1);
			$pdf->Cell(62,5,'Account Name',1,0,'C',1);
			$pdf->Cell(31,5,'Opening Balance',1,0,'C',1);
			$pdf->Cell(25,5,'Debit',1,0,'C',1);
			$pdf->Cell(25,5,'Credit',1,0,'C',1);
			$pdf->Cell(31,5,'Ending Balance',1,0,'C',1);
			
			
			
		
			$pdf->SetFont('Arial','',6);
			
			$i = 1;	
			$no = 1;
			$noo = 0;
			$max = 47;	
			$pdf->Ln(5);
			$tot1 = 0;
			$tot2 = 0;
			$tot3 = 0;
			$tot4 = 0;
			
					 
			
foreach($data as $rows){	
		 
					 
   
	$a = ($rows->balance_base + $rows->db_base) - $rows->cr_base;		
	
		if($noo == $max){ 
			$pdf->AddPage();
			//				
			#CETAK TANGGAL
				$tgl2  = date("d-m-Y");
			#HEADER CONTENT
				$pt			= "PT BAKRIE SWASAKTI UTAMA";
				$judul 		= "Report Trial Balance";
				$periode	= "Periode";
	
			#CETAK TANGGAL
				//$tgl2  = date("d-m-Y");
			#TANGGAL CETAK
				$pdf->SetFont('Arial','',6);
				$pdf->SetXY(258,10);
				$pdf->Cell(10,4,'Print Date',0,0,'L',0);	
							
				$pdf->SetXY(268,10);
				$pdf->Cell(2,4,':',4,0,'L');
								
				$pdf->SetXY(269,10);
				$pdf->Cell(10,4,$tgl2,0,0,'L');
			
			#$month1 = date( 'F', mktime(0, 0, 0, $periode1));		
			#$month2 = date( 'F', mktime(0, 0, 0, $periode2));		
					
			#Header
				//$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				$pdf->SetFont('Arial','B',18);
	
				$pdf->SetX(25);
				$pdf->Cell(0,10,$pt,20,0,'L');
			
				$pdf->SetFont('Arial','B',12);
				
				$pdf->SetXY(25,16);
				$pdf->Cell(0,10,$judul,20,0,'L'); 
				$pdf->SetFont('Arial','B',11);
				$pdf->SetXY(25,22);
				$pdf->Cell(0,10,'Periode'.' : '.inggris_date($tgl). ' s/d '.inggris_date($tgla),20,0,'L');
				//$pdf->Cell(0,10,'As Of'.' : '. $tgl,20,0,'L');
				$pdf->Ln(10);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(1);
				$pdf->Cell(0,0,'',1,0,'L');
				$pdf->Ln(3);
			
			
			$pdf->SetX(2);
			$pdf->SetFont('Arial','B',8);
		
			
			$pdf->Cell(30,5,'Account No.',1,0,'C',1);
			$pdf->Cell(62,5,'Account Name',1,0,'C',1);
			$pdf->Cell(31,5,'Opening Balance',1,0,'C',1);
			$pdf->Cell(25,5,'Debit',1,0,'C',1);
			$pdf->Cell(25,5,'Credit',1,0,'C',1);
			$pdf->Cell(31,5,'Ending Balance',1,0,'C',1);
			$pdf->Ln(5);

			$noo = 0;
	
			
		}
	$a = ($rows->balance_base + $rows->db_base) - $rows->cr_base; 
			
			if ($rows->Type == 1){
			$pdf->SetFont('Arial','B',6);
			$pdf->Cell(30,5,$rows->acc_no,1,0,'L',0);
			$pdf->Cell(62,5,$rows->acc_name,1,0,'L',0);
			$pdf->Cell(31,5,number_format($rows->balance_base),1,0,'R',0);
			$pdf->Cell(25,5,number_format($rows->db_base),1,0,'R',0);
			$pdf->Cell(25,5,number_format($rows->cr_base),1,0,'R',0);
			$pdf->Cell(31,5,number_format($a),1,0,'R',0);
			$pdf->Ln(5);
		}else{
			$pdf->SetFont('Arial','',6);
			$pdf->Cell(30,5,$rows->acc_no,1,0,'L',0);
			$pdf->Cell(62,5,$rows->acc_name,1,0,'L',0);
			$pdf->Cell(31,5,number_format($rows->balance_base),1,0,'R',0);
			$pdf->Cell(25,5,number_format($rows->db_base),1,0,'R',0);
			$pdf->Cell(25,5,number_format($rows->cr_base),1,0,'R',0);
			$pdf->Cell(31,5,number_format($a),1,0,'R',0);
			$pdf->Ln(5);
		}		
			$i++;
			$no++;
			$noo++;
			
			$tot2=$tot2+$rows->db_base;
			$tot3=$tot3+$rows->cr_base;
		
	}
			$pdf->SetFont('Arial','B',6);
			
			 $balance1 = "select sum(balance_base) as a from db_trlbal_periode 
					inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					where db_trlbal_periode.type=2";
					
					  $balance = $this->db->query($balance1)->row();     

					
			$closing1  = "select (sum(balance_base)+ sum(db_base) - sum(cr_base)) as b from db_trlbal_periode 
					inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					where db_trlbal_periode.type=2";
					
					$closing = $this->db->query($closing1)->row();     
					
					
					
			$debet1   =	"select sum(db_base) as c from db_trlbal_periode 
					 inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					 where db_trlbal_periode.type=2";
					 
					 $debet = $this->db->query($debet1)->row();     

					 
					 
			$credit1=	"select sum(cr_base)  as d from db_trlbal_periode 
					 inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					 where db_trlbal_periode.type=2";			 
					 
					 $credit = $this->db->query($credit1)->row();     
					 
	  	
			//$pdf->Cell(30,5,'',1,0,'L',1);
			$pdf->Cell(92,5,'Balance',1,0,'R',1);
			$pdf->Cell(31,5,number_format($balance->a),1,0,'R',1);
			$pdf->Cell(25,5,number_format($debet->c),1,0,'R',1);
			$pdf->Cell(25,5,number_format($credit->d),1,0,'R',1);
			$pdf->Cell(31,5,number_format($closing->b),1,0,'R',1);
			$pdf->Output("hasil.pdf","I");	;
	
