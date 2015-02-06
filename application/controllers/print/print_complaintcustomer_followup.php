<?php
class print_complaintcustomer_followup extends controller{
	function print_history_complaint($id){
		
		
					#$namaprospe	=	$this->db->select('customer_nama')
					#								->where('customer_id',$id)
					#								->get('db_customer')
					#								->row_array();
					#$namaprospek =	$namaprospe['customer_nama'];
					$query = $this->db->query("ViewComplaint " .$id."");
											
					$row 		= $query->row();
					
					$name		= $row->customer_nama;
					$mobile		= $row->customer_hp;
					$address	= $row->customer_alamat1;
					$city		= $row->kota_nm;
					
					
					$date		= $row->tgl_complaint;
					$date		= indo_date($date);
					
					$project	= $row->nm_subproject;
					$status		= $row->csfustat_nm;
					$tipecs		= $row->cstipe_nm;
					$desc		= $row->csdesc_nm;
					$note		= $row->note;
					#var_dump($row);
					
					
					#var_dump($row);exit;
		#var_dump($id);exit;
			require('fpdf/classreport.php');
			$pdf=new PDF('P','mm','A4');
			$pdf->SetMargins(2,10,2);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',12);
			
			#HEADER CONTENT
			$judul 		= "FOLLOW UP CUSTOMER COMPLAINT";
			$divisi 	= "Customer Service Department - PT. Bakrie Swasakti Utama";
			
			$subket1	= "A. Customer Profile";
			$nameket	= "Customer Name";
			$mobileket	= "Mobile Phone";
			$addressket	= "Address";
			$cityket	= "City";
			
			
			
			$subket2 	= "B. Customer Complaint Information";
			$dateket	= "Complaint Date";
			$projectket	= "Project";
			$statusket	= "Status";
			$tipecsket	= "Complaint Type";
			$descket	= "Complaint Desc";
			$noteket	= "Note";
			
			
			
			
			
			
			
			
			#Header
			#$pdf->Image(site_url().'assets/images/bakrie.JPG',4,8,20);	
			$pdf->SetFont('Arial','B',12);
			$pdf->SetX(25);
			$pdf->Cell(0,10,$judul,20,0,'L');
			
			$pdf->SetFont('Arial','B',10);		
			$pdf->SetXY(25,16);
			$pdf->Cell(0,10,$divisi,20,0,'L');
			
			#HEADER1
			$pdf->SetFont('Arial','u',10);
			$pdf->SetXY(25,30);
			$pdf->Cell(0,10,$subket1,20,0,'L');
			
			
			
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,35);
			$pdf->Cell(0,10,$nameket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$name,10,0,'L');
			
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,40);
			$pdf->Cell(0,10,$mobileket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$mobile,10,0,'L');
						
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,45);
			$pdf->Cell(0,10,$addressket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$address,10,0,'L');
								
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,50);
			$pdf->Cell(0,10,$cityket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$city,10,0,'L');
			
			#HEADER2
			$pdf->SetFont('Arial','u',10);
			$pdf->SetXY(25,60);
			$pdf->Cell(0,10,$subket2,20,0,'L');
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,65);
			$pdf->Cell(0,10,$dateket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$date,10,0,'L');
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,70);
			$pdf->Cell(0,10,$projectket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$project,10,0,'L');
						
			$pdf->SetFont('Arial','B',9);
			$pdf->SetXY(25,75);
			$pdf->Cell(0,10,$statusket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$status,10,0,'L');
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,80);
			$pdf->Cell(0,10,$tipecsket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$tipecs,10,0,'L');
			
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,85);
			$pdf->Cell(0,10,$descket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$desc,10,0,'L');
			
			$pdf->SetFont('Arial','',9);
			$pdf->SetXY(25,90);
			$pdf->Cell(0,10,$noteket,20,0,'L');
				$pdf->SetX(65);
				$pdf->Cell(0,10,':',10,0,'L');
					$pdf->SetX(70);
					$pdf->Cell(0,10,$note,10,0,'L');
			
			
			
			
		 		
					
			#end header
			
			#Header data
			
			/*$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,35);
			$pdf->Cell(0,10,': '.$prospect_stat ,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,40);
			$pdf->Cell(0,10,': '.$interestproject,20,0,'L');
			
			$pdf->SetFont('Arial','',10);
			$pdf->SetXY(70,45);
			$pdf->Cell(0,10,': ',20,0,'L');
			
			
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
			$pdf->Cell(0,10,': '.$prospect_shift,20,0,'L');*/
			
			
			
			
			
			$pdf->Output("history.pdf","I");	;
	
		}
	#
	/*{
		 var_dump($id);exit;
		 
	}*/
}
