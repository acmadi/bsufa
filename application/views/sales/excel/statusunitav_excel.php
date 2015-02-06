<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

		

<table border="1">
	<tr>
		<td>No</td>
		<td>lot_no</td>
		<td>price list</td>
		<td>build_up_area</td>
		<td>view unit</td>
		<td>unit type</td>
		<td>project_no</td>
		

	</tr>
	
<?php 

extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];

$data = $this->db->query("StatusunitReport '".$subproject."','".$type."','".inggris_date($start_date)."'")->result();
			
//$data = $data1->result();

//$data = $this->db->query("PaymentCustomerReport '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."',".$pt."")->result();
//$data = $this->db->query("sp_payment_report '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();

//$data1 = $this->db->query("PaymentCustomerReport '".$subproject."','".$start_date."','".$end_date."'");
			
			// $data = $data1->result();

$i= 0; 
foreach($data as $row): 
$i++;
					//$tglsales = $row->compute_0007;
					//$tglsales = indo_date($tglsales);
					
					
					
					// $customernama = $row->customer_nama;
					// $nama = $row->nama;
					// $no_sp = $row->no_sp;
					// $unitno = $row->unit_no;
					// $paytipenm = $row->paytipe_nm;
					// $tanah = $row->tanah;
					// $discamount = $row->discamount;
					// $bangunan = $row->bangunan;
					// $sellingprice = $row->selling_price;
					// $pricemanual = $row->price_manual;
					// $bf = $row->bf;
					// $dp = $row->dp;
					// $pl = $row->pl;
					
					
					// // $tottanah 			= $tottanah + $tanah;
					// // $totbangunan		= $totbangunan + $bangunan;
					// // $totpricemanual		= $totpricemanual + $pricemanual;
					// // $totsellingprice 	= $totsellingprice + $sellingprice;
					// // $totdiscamount		= $totdiscamount + $discamount;
					// // $totbf				= $totbf + $bf;
					// // $totdp				= $totdp + $dp;
					// // $totpl				= $totpl + $pl;
					
					
					
					// $pricem2 = $sellingprice/$bangunan;
					
					// $pricemanual =  number_format($row->price_manual);
					// $pricem2	= number_format($pricem2);
					
					// $discamount = number_format($row->discamount);
										
					// $sellingprice= number_format($row->selling_price);
					
					
					// $bf	= number_format($row->bf);
					// $dp	= number_format($row->dp);
					// $pl = number_format($row->pl);

?>

	<tr>
		<td><?=$i?></td>
		<td><?=$row->lot_no?></td>
		<td><?=$row->pricelist?></td>
		<td><?=$row->build_up_area?></td>
		<td><?=$row->view_unit?></td>
		<td><?=$row->unit_type?></td>
		<td><?=$row->project_no?></td>
		
		<!--<td><?=$pl?></td>-->
	</tr>	

<?php endforeach ?>
	
</table>
