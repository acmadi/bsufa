<?php

		
			require('fpdf/tanpapage.php');
			include_once( APPPATH."libraries/translate_currency.php"); 
			//include_once( APPPATH."libraries/fungsi_terbilang.php"); 
			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
			
							$data = $this->db->query("sp_cetakinvoice")
							 ->result();
		
			foreach($data as $rows){					 
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			
			$pdf->SetX(25);
				
			
			$pdf->Ln(3);			
			
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			
			$pdf->Ln(3);
			
			$pdf->Ln(6);
			
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',8);
			
			$pdf->Ln(5);
			
			$pdf->Ln(5);
			
			$pdf->Ln(5);			
		
			$pdf->Ln(1);
			
			$pdf->SetX(70);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(158,4,($rows->npwp),10,0,'L');
			$pdf->Ln(6);
			
			$pdf->SetX(70);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(158,4,$rows->npwp,100,'L');
			$pdf->Ln(7);
			
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',8);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(59,4,$rows->nm_supplier." (".$rows->kd_tenant.")",10,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->SetX(132);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(20,5,'',10,0,'L');
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(59,4,indo_date($rows->doc_date),10,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(42,4,'',10,0,'L');			
			
			$pdf->Ln(9);
			
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',8);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(59,4,$rows->trade_name,10,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->SetX(132);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(20,5,'',10,0,'L');
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(59,4,$rows->unit,10,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(42,4,'',10,0,'L');
			
			
			$pdf->Ln(10);
			
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',8);
			$pdf->SetFont('Arial','B',8);
			//$pdf->Cell(158,4,$rows->alamat,10,0,'L');
			$pdf->MultiCell(51,4,($rows->alamat),10,'L',0);
			// $pdf->Cell(158,4,substr($rows->alamat,0,32),10,0,'L');
			// $pdf->Ln(4);
			// $pdf->SetX(57);
			// $pdf->Cell(158,4,substr($rows->alamat,32,40),10,0,'L');
			
			$pdf->Ln(-4);
			$pdf->SetXY(132,84);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(20,5,'',10,0,'L');
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			//$harga,2,',','.');
			$pdf->Cell(59,4,number_format($rows->luas,2,'.',','),10,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(42,4,'',10,0,'L');		
			
			$pdf->Ln(9);
			
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',8);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(158,4,'',10,0,'L');
			
			$pdf->SetX(132);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(20,5,'',10,0,'L');
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(59,4,$rows->doc_no,10,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(42,4,'',10,0,'L');		
			
			$pdf->Ln(9);
			
			if ($rows->customer_hp ==0)
			{
			
			$pdf->SetX(57);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(55,4,'-',10,0,'L');
			}else{
			$pdf->SetX(57);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(55,4,($rows->customer_hp),10,0,'L');
			
			}
			
			$pdf->SetX(132);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(20,5,'',10,0,'L');
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->Cell(55,4,($rows->no_kontrak_sewa),10,0,'L');
			
			$pdf->Ln(8);
			
			if ($rows->customer_fax ==0)
			{			
			$pdf->SetX(57);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(55,4,'-',10,0,'L');
			}else{
			$pdf->SetX(57);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(55,4,($rows->customer_fax),10,0,'L');			
			}
			
			$pdf->SetX(132);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(20,5,'',10,0,'L');
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->Cell(55,4,indo_date($rows->due_date),10,0,'L');			
			
			$pdf->Ln(2);			
			//$pdf->Ln(23);
			#start Tabel
			$pdf->SetX(10);
		
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(8,5,'',0,0,'C',0);
			$pdf->Cell(139,5,'',0,0,'C',0);
			$pdf->Cell(35,5,'',0,0,'C',0);
			$pdf->Ln(2); //hrsnya 5
			$no = 1;
			$totdb = 0;
            $totcr = 0;
			$totcr = $totcr + $rows->trx_amt;
								
        			$pdf->SetX(22);
        			$pdf->Cell(8,50,$no,0,0,'C',0);
        			$pdf->Cell(144,50,$rows->descs,0,0,'L',0);
					// $pdf->Cell(144,50,'Sewa tempat untuk penempatan perangkat Telkomsel Period',0,0,'L',0);
					// $pdf->Ln(4);
					// $pdf->SetX(30);
					// $pdf->Cell(144,50,'From : 15 Mar, 2011 to 14 Mar, 2016 ',0,0,'L',0);
					//$pdf->MultiCell(90,4,$rows->descs,10,'L',0);
					//$pdf->MultiCell(59,4,'#'.ucwords(toRupiah2($rows->trx_amount2)).'#',10,'L',0);
					//$pdf->Ln(-4);
					$pdf->SetX(179);
        			$pdf->Cell(15,50,($rows->base_amount3),0,0,'R',0);
					
					$pdf->Ln(4);
					$stamp=6000;
					
					if ($rows->stamp2==6000)
					{					
					$pdf->SetX(22);
        			$pdf->Cell(8,50," 2.",0,0,'C',0);
        			$pdf->Cell(144,50,"Stamp Duty Transaction",0,0,'L',0);
					$pdf->SetX(179);
        			$pdf->Cell(15,50,($rows->stamp),0,0,'R',0);
					
					$base=$rows->base_amount+$stamp;
					$total=$rows->trx_amt+$stamp;
					
					}else{
					$pdf->SetX(22);
        			$pdf->Cell(8,50,"",0,0,'C',0);
        			$pdf->Cell(144,50,"",0,0,'L',0);
					$pdf->SetX(179);
        			$pdf->Cell(15,50,'',0,0,'R',0);			

					$base=$rows->base_amount;
					$total=$rows->trx_amt;	
					}
					
        			$pdf->Ln(69);	
					
					
        				 
		        $pdf->SetX(12);  
                    $pdf->Cell(8,5,'',10,0,'C',0);
        			$pdf->Cell(26,5,'',10,0,'L',0);
                    $pdf->SetFont('Arial','B',8);
        			$pdf->Cell(113,5,'',10,0,'R',0);
           			$pdf->Cell(35,5,($rows->base_amount) ,0,0,'R',0);
					$pdf->Ln(3);	
					$pdf->SetX(12);  
					$pdf->Cell(8,5,'',10,0,'C',0);
        			$pdf->Cell(26,5,'',10,0,'L',0);
                    $pdf->SetFont('Arial','B',8);
        			$pdf->Cell(113,5,'',10,0,'R',0);
					$pdf->Cell(35,5,($rows->tax_amount),0,0,'R',0);
					$pdf->Ln(4);	
					$pdf->SetX(12);  
					$pdf->Cell(8,5,'',10,0,'C',0);
        			$pdf->Cell(26,5,'',10,0,'L',0);
                    $pdf->SetFont('Arial','B',8);
        			$pdf->Cell(113,5,'',10,0,'R',0);
					$pdf->Cell(35,5,($rows->trx_amt),0,0,'R',0);
					
					
			
			$pdf->Ln(0);		
			$pdf->SetX(15);
			$pdf->SetFont('Arial','',8);			
			
			$pdf->Ln(0);
		
			$pdf->Ln(0);
			
			$pdf->SetX(10);
			$pdf->Cell(60.6,30,'',0,0,'C',0);
			$pdf->Cell(60.6,30,'',0,0,'C',0);
			$pdf->Cell(60.6,30,'',0,0,'C',0);
			
			$pdf->Ln(2);
			
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',8);			
			$pdf->SetFont('Arial','B',8);
			
			$gun = sprintf("%3.2f",$rows->trx_amount2);
			
			$test =@substr($gun, strlen - 2, 2);
			
			// var_dump($test);exit();
			$g = ucwords(toRupiah_leasing($rows->trx_amt)) ;
			
			//$pdf->MultiCell(59,4,$g,1,'C',1);
			
			if ($test<>'00')
			{
			
			$pdf->MultiCell(59,4,'#'.ucwords(toRupiah_leasing($rows->trx_amount2)).'#',10,'L',0);
			
			// $pdf->Cell(59,4,'#'.substr(ucwords(toRupiah_leasing($rows->trx_amount2)),0,36),10,0,'L');
			// $pdf->Ln(4);
			
			// $pdf->SetX(57);
			// $pdf->Cell(59,4,substr(ucwords(toRupiah_leasing($rows->trx_amount2)).'#',36,42),10,0,'L');
			
			// $pdf->Ln(4);
			
			// $pdf->SetX(57);
			// $pdf->Cell(59,4,substr(ucwords(toRupiah_leasing($rows->trx_amount2)).'#',78,100),10,0,'L');
			}else
			{
			
			$pdf->MultiCell(59,4,'#'.ucwords(toRupiah2($rows->trx_amount2)).'#',10,'L',0);
			
			// $pdf->Cell(59,4,'#'.substr(ucwords(toRupiah2($rows->trx_amount2)),0,36),10,0,'L');
			// $pdf->Ln(4);
			
			// $pdf->SetX(57);
			// $pdf->Cell(59,4,substr(ucwords(toRupiah2($rows->trx_amount2)),36,40),10,0,'L');
			// $pdf->Ln(4);
			
			// $pdf->SetX(57);
			// $pdf->Cell(59,4,substr(ucwords(toRupiah2($rows->trx_amount2)),76,100),10,0,'L');
			}
			
			$pdf->Ln(-12);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			
			$pdf->Ln(27);
			
			if ($rows->id_subproject == '11103' || $rows->id_subproject=='11110')
			{
			$pdf->SetXY(57,225-1.75);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Bank BRI',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);		
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Capem, Kuningan Epicentrum',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'2013.01.000.005.30-6',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			}elseif ($rows->id_subproject == '11104' || $rows->id_subproject=='11106')
			{
			
			if ($rows->kd_tenant == 'BRI-002' || $rows->kd_tenant == 'C00179')
			{
			
			$pdf->SetXY(57,225-1.75);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Bank BRI',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);		
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Kuningan Epicentrum',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			
			$pdf->Cell(59,4,'2013.01.000005306',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');			
			}else
			{
			$pdf->SetXY(57,225-1.75);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Bank Bukopin',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);		
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'MT. HARYONO',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			
			$pdf->Cell(59,4,'102.1921.013',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');	
			}
			}elseif ($rows->id_subproject == '11101')
			{
			$pdf->SetXY(57,225-1.75);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Bank BRI',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			#$pdf->SetXY(57,229+2);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);		
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Kuningan Epicentrum',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			#$pdf->SetXY(57,233+2);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'0378.01.000.083.30-2',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');			
			}elseif ($rows->id_subproject == '11202')
			{
			$pdf->SetXY(57,225-1.75);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'Bank Bukopin',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);		
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'MT. HARYONO',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			
			$pdf->Ln(6);
			$pdf->SetX(57);
			$pdf->SetFont('Arial','',9);			
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,'101.9830.019',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');			
			}
								
			$pdf->Ln(-3);			
				
	
				$pdf->SetFont('Arial','B',9);
				$pdf->SetX(160,300);
				$pdf->Cell(15,4,'Yusril',0,0,'L',0);	
				$pdf->Ln(4);		
				$pdf->SetX(150);
				$pdf->Cell(15,4,'Accounting Manager',0,0,'L',0);	
				
				
			}			
				
				
			$pdf->Output("hasil.pdf","I");

