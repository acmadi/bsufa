<?php
class prospekcustomer_followup extends controller{
	function print_history_prospek($id){
		
		
					#$namaprospe	=	$this->db->select('customer_nama')
					#								->where('customer_id',$id)
					#								->get('db_customer')
					#								->row_array();
					#$namaprospek =	$namaprospe['customer_nama'];
					$query = $this->db->query("ViewProspect " .$id."");
											
					$row 				= $query->row();
					$namaprospek 		= $row->customer_nama;
					$hpprospek 			= $row->customer_hp;
					$interestproject 	= $row->nm_subproject;
					$tipe_media 		= $row->tipemedia_nm;
					$source_media		= $row->media_nm;
					$sales_name 		= $row->nama;
					$prospect_stat 		= $row->prospectstat_nm;
					$prospect_email		= $row->email_1;
					$prospect_venue		= $row->venue;
					$prospect_shift		= $row->shift;
					$prospect_payment	= $row->payment;
					
					
					#var_dump($row);exit;
		#var_dump($id);exit;
			require('fpdf/classreport.php');
			$pdf=new PDF('P','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			
			#HEADER CONTENT
			$judul 		= "FOLLOW UP CUSTOMER PROSPECT";
			$divisi 	= "Sales Division - PT. Bakrie Swasakti Utama";
			
			$ket	 	= "A. Customer Prospect Follow Up";
			$status		= "Status Prospect Follow Up";
			$project	= "Interest Project";
			$sales		= "Sales Name";
			
			$ket2		= "B. Customer Prospect Information";
			$name		= "Customer Prospect Name";
			$hp			= "Mobile Phone";
			$emai		= "Email Address";
			
			$ket3		= "C. Source of Prospect Customer";
			$tipemedia	= "Source Type Media";
			$media		= "Source Media";
			$venue		= "Venue";
			$payment	= "Payment Planning";
			$shift		= "Shift";
			
			
			#Header
			#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$judul,20,0,'L');
			
			$pdf->SetFont('Arial','B',10);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$divisi,20,0,'L');
			
			
			$pdf->SetFont('Arial','u',10);
			$pdf->SetXY(25,30);
			$pdf->Cell(0,10,$ket,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,35);
			$pdf->Cell(0,10,$status,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,40);
			$pdf->Cell(0,10,$project,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,45);
			$pdf->Cell(0,10,$sales,20,0,'L');
			
			
			$pdf->SetFont('Arial','u',10);
			$pdf->SetXY(25,55);
			$pdf->Cell(0,10,$ket2,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,60);
			$pdf->Cell(0,10,$name,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,65);
			$pdf->Cell(0,10,$hp,20,0,'L');
					
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,70);
			$pdf->Cell(0,10,$emai,20,0,'L');
			
			
			$pdf->SetFont('Arial','u',10);
			$pdf->SetXY(25,80);
			$pdf->Cell(0,10,$ket3,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,85);
			$pdf->Cell(0,10,$tipemedia,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,90);
			$pdf->Cell(0,10,$media,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,95);
			$pdf->Cell(0,10,$venue,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,100);
			$pdf->Cell(0,10,$payment,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(25,105);
			$pdf->Cell(0,10,$shift,20,0,'L');
			
			
		 		
					
			#end header
			
			#Header data
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,35);
			$pdf->Cell(0,10,': '.$prospect_stat ,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,40);
			$pdf->Cell(0,10,': '.$interestproject,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,45);
			$pdf->Cell(0,10,': '.$sales_name,20,0,'L');
			
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,60);
			$pdf->Cell(0,10,': '.$namaprospek,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,65);
			$pdf->Cell(0,10,': '.$hpprospek,20,0,'L');
					
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,70);
			$pdf->Cell(0,10,': '.$prospect_email,20,0,'L');
			
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,85);
			$pdf->Cell(0,10,': '.$tipe_media,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,90);
			$pdf->Cell(0,10,': '.$source_media,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,95);
			$pdf->Cell(0,10,': '.$prospect_venue,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,100);
			$pdf->Cell(0,10,': '.$prospect_payment,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,105);
			$pdf->Cell(0,10,': '.$prospect_shift,20,0,'L');
			
			
			
			
			
			$pdf->Output("history.pdf","I");	;
	
		}
	#
	/*{
		 var_dump($id);exit;
		 
	}*/
}
