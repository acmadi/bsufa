<?php

		ini_set('memory_limit','512M');

			require('fpdf/tanpapage.php');
			include_once( APPPATH."libraries/translate_currency.php"); 

			extract(PopulateForm());
			$pdf=new PDF('P','mm','A4');
						if($pt==44){
						$data = $this->db->query("select * from db_apinvoiceoth where doc_no='".$doc_no->doc_no."' and (acc_no!='0' or acc_no!='')")->result();
						}elseif($pt==11){
						//$data = $this->db->query("sp_cetakpayvoucherall2 '".$id."'")
						//	 ->result();
						$data = $this->db->query("select * from db_apinvoiceoth where doc_no='".$doc_no->doc_no."' and (acc_no!='0' or acc_no!='') and acc_no != '' and acc_no != '0' order by id_other desc")->result();

						}	 
							 	$rows = $this->db->query("sp_cetakpayvoucherall '".$id."'")
							 ->row();
			//var_dump($data);
							 
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();	
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			$pdf->setFillColor(222,222,222);
			#HEAD
			#HEADER CONTENT
			#$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
				
			#CETAK TANGGAL
				#$tgl  = date("d-m-Y");
			#TANGGAL CETAK
				
			#	$pdf->Cell(10,4,$tgl,0,0,'L');
			
				#Header
			##$pdf->Image(site_url().'assets/images/bakrie_gmi.JPG',4,8,20);	
			$pdf->SetX(25);
				
			// Start diatas tabel
			
			$pdf->SetFont('Arial','B',7);
			$pdf->Cell(110,5,'PT. Bakrie Swasakti Utama',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,5,'Voucher No.',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,5.5,$rows->doc_no,10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetFont('Arial','',7);
			$pdf->SetX(25);
			$pdf->Cell(110,5,'Epiwalk 6th Floor',10,0,'L');
			// $pdf->SetFont('Arial','',6);
			// $pdf->Cell(25,5,'',10,0,'L');
			// $pdf->Cell(2,5,':',10,0,'L');
			// $pdf->Cell(30,3.5,'',1,0,'L');
			$pdf->Ln(3);
			$pdf->SetFont('Arial','',7);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'Jl. HR. Rasuna Said - Kuningan',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(25,5,'',10,0,'L');
			$pdf->Cell(2,5,'',10,0,'L');
			$pdf->Cell(30,5,'',10,0,'L');
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'Jakarta Selatan (12960)',10,0,'L');
			$pdf->SetFont('Arial','',7);
			
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'Telp : (021) 830-5011 Fax : (021) 830-5012',10,0,'L');
			$pdf->SetFont('Arial','',7);
			
			$pdf->Ln(3);
			
			$pdf->SetX(25);
			$pdf->Cell(100,5,'NPWP : 021.672.152.2-011.00',10,0,'L');
			$pdf->SetFont('Arial','',7);
				
			
			$pdf->Ln(6);
			$pdf->SetFont('Arial','B',11);
			$pdf->SetX(25);
			$pdf->Cell(110,5,'REQUEST PAYMENT VOUCHER',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(25,5,'INV No.',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(30,4,$rows->inv_no,10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','',9);
			
			$pdf->SetX(10);
			$pdf->Cell(20,5,'',10,0,'L');
			$pdf->Cell(4,5,'',10,0,'L');
			$pdf->Cell(59,4,'',10,0,'L');
			$pdf->Cell(42,4,'',10,0,'L');
			$pdf->Cell(25,5,'INV Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(30,4,indo_date($rows->inv_date),10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(20,5,'Paid to',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(59,4,$rows->nm_supplier,10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(42,4,'',10,0,'L');
			$pdf->Cell(25,5,'INV Due Date',10,0,'L');
			$pdf->Cell(2,5,':',10,0,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(30,4,indo_date($rows->due_date),10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(20,5,'NPWP',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(55,4,$rows->npwp,10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(20,5,'Address',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(158,4,$rows->alamat,10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(20,5,'Amount (IDR)',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(55,4,number_format($rows->base_amt),10,0,'L');
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(20,5,'Says',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			#$pdf->Cell(158,4,ucwords(terbilang(10000000.78)).' Rupiah',10,0,'L');
			$pdf->Write(5,ucwords(toRupiah($rows->base_amt)).' Rupiah');
			$pdf->Ln(8);
			
			$pdf->SetX(10);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(20,5,'Remark',10,0,'L');
			$pdf->Cell(4,5,':',10,0,'L');
			$pdf->Cell(158,4,$rows->descs,100,'L');
				$pdf->Ln(8);
			
			
			
			
			
			
			
			#start Tabel
			$pdf->SetX(10);
		
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(8,5,'No',1,0,'C',1);
			$pdf->Cell(26,5,'COA',1,0,'C',1);
			$pdf->Cell(98,5,'ACCOUNT NAME',1,0,'C',1);
			$pdf->Cell(25,5,'DEBET',1,0,'C',1);
			$pdf->Cell(25,5,'CREDIT',1,0,'C',1);
			$pdf->Ln(5);
			$no = 1;
			$totdb = 0;
            $totcr = 0;
			//for($i = 1;$i <= 27; $i++){
			if($pt==44){
			foreach($data as $row){	
			 $totdb = $totdb + $row->debet;
             $totcr = $totcr + $row->credit;
             
        			$pdf->SetX(10);
        			$pdf->Cell(8,5,$no,1,0,'C',0);
        			$pdf->Cell(26,5,$row->acc_no,1,0,'L',0);
        			$pdf->Cell(98,5,$row->acc_name,1,0,'L',0);
        			$pdf->Cell(25,5,number_format($row->debet),1,0,'R',0);
        			$pdf->Cell(25,5,number_format($row->credit),1,0,'R',0);
        			$pdf->Ln(5);	
        			$no++;
			}
			}elseif($pt==11){
			foreach($data as $row){	
			 $totdb = $totdb + $row->debet;
             $totcr = $totcr + $row->credit;
             
        			/*$pdf->SetX(10);
        			$pdf->Cell(8,5,$no,1,0,'C',0);
        			$pdf->Cell(26,5,$row->acc_no1,1,0,'L',0);
        			$pdf->Cell(78,5,$row->acc_name,1,0,'L',0);
        			$pdf->Cell(35,5,number_format($row->debet),1,0,'R',0);
        			$pdf->Cell(35,5,number_format($row->credit),1,0,'R',0);
        			$pdf->Ln(5);	
        			$no++;*/
					$pdf->SetX(10);
        			$pdf->Cell(8,5,$no,1,0,'C',0);
        			$pdf->Cell(26,5,$row->acc_no,1,0,'L',0);
        			$y = $pdf->GetY();
					$x = $pdf->GetX();
					$width = 98;
				
					#$pdf->Cell(40,50, 'quantity', 1, 0, "l");

			$pdf->SetFont('Arial','',7);

					$pdf->Cell($width,5,($row->acc_name),1,'L');
					$pdf->SetXY($x + $width, $y);	

			$pdf->SetFont('Arial','',8);
        			#$pdf->Cell(78,5,$row->acc_name,1,0,'L',0);
        			$pdf->Cell(25,5,number_format($row->debet),1,0,'R',0);
        			$pdf->Cell(25,5,number_format($row->credit),1,0,'R',0);
        			$pdf->Ln(5);	
        			$no++;
				
			}
			
			}
			for($m = $no-1;$m <= 21;$m++){
				$pdf->SetX(10);
        			$pdf->Cell(8,5,'',1,0,'C',0);
        			$pdf->Cell(26,5,'',1,0,'L',0);
        			$pdf->Cell(98,5,'',1,0,'L',0);
        			$pdf->Cell(25,5,'',1,0,'R',0);
        			$pdf->Cell(25,5,'',1,0,'R',0);
        			$pdf->Ln(5);
			}
			
			
		        $pdf->SetX(10);  
                $pdf->Cell(8,5,'',10,0,'C',0);
    			$pdf->Cell(26,5,'',10,0,'L',0);
                $pdf->SetFont('Arial','B',9);
    			$pdf->Cell(98,5,'Total',10,0,'R',0);
    			$pdf->Cell(25,5,number_format($totdb),1,0,'R',0);
    			$pdf->Cell(25,5,number_format($totcr),1,0,'R',0);
			
			$pdf->Ln(7);		
			$pdf->SetX(15);
			$pdf->SetFont('Arial','',9);
		
			
			$pdf->SetX(10);
			$pdf->Cell(60.6,10,'Prepared By',1,0,'C',0);
			$pdf->Cell(60.6,5,'Checked By',1,0,'C',0);
			$pdf->Cell(60.6,5,'Approved By',1,0,'C',0);
			
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->Cell(60.6,10,'',10,0,'C',0);
			$pdf->Cell(60.6,5,'Fin & Acct Dept Head',1,0,'C',0);
			$pdf->Cell(60.6,5,'Finance Controller Div. Head',1,0,'C',0);
			/*
			$pdf->Cell(36.4,10,'',10,0,'C',0);
			$pdf->Cell(36.4,5,'FINANCE',1,0,'C',0);
			$pdf->Cell(36.4,5,'ACCOUNTING',1,0,'C',0);
			$pdf->Cell(36.4,10,'',10,0,'C',0);		
			$pdf->Cell(36.4,10,'',10,0,'C',0);
			*/
			$pdf->Ln(5);
			
			$pdf->SetX(10);
			$pdf->Cell(60.6,30,'',1,0,'C',0);
			$pdf->Cell(60.6,30,'',1,0,'C',0);
			$pdf->Cell(60.6,30,'',1,0,'C',0);
			
			$pdf->Ln(30);
			
			$pdf->SetX(10);
			$pdf->Cell(60.6,5,'Date. ',1,0,'L',0);
			$pdf->Cell(60.6,5,'Date. ',1,0,'L',0);
			$pdf->Cell(60.6,5,'Date. ',1,0,'L',0);
					
			$pdf->Ln(25);		
	
	
	
				$pdf->SetFont('Arial','',9);
				$pdf->SetX(160);
				$pdf->Cell(15,4,'Print Date',0,0,'L',0);	
				$pdf->Cell(2,4,':',4,0,'L');
				$pdf->Cell(2,4,date("d-m-Y"),4,0,'L');
			$pdf->Output("hasil.pdf","I");

