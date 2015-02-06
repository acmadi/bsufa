<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>SP Date</td>
		<td>No SP</td>
		<td>Customer</td>
		<td>Sales Name</td>
		<td>Unit.No</td>
		<td>TOP</td>
		<td>X</td>
		<td>Net</td>
		<td>SGA</td>
		<td>Price List</td>
		<td>Disc. Amount</td>
		<td>Selling Price</td>
		<td>Price M2</td>
		<td>Booking Fee</td>
		<td>Down Payment</td>
		<td>Pelunasan</td>
		<td>View</td>

	</tr>
	
<?php 

extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];

$data = $this->db->query("SalesReport '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();
			
//$data = $data1->result();

//$data = $this->db->query("PaymentCustomerReport '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."',".$pt."")->result();
//$data = $this->db->query("sp_payment_report '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();

//$data1 = $this->db->query("PaymentCustomerReport '".$subproject."','".$start_date."','".$end_date."'");
			
			// $data = $data1->result();

$i= 0; 
foreach($data as $row): 
$i++;
					$tglsales = $row->tgl_sales;
					$tglsales = indo_date($tglsales);
					
					
					
					$customernama = $row->customer_nama;
					$nama = $row->nama;
					$no_sp = $row->no_sp;
					$unitno = $row->unit_no;
					$paytipepl = $row->id_paytipepl;
					$paytipenm = $row->paytipe_nm;
					$tanah = $row->tanah;
					$discamount = $row->discamount;
					$bangunan = $row->bangunan;
					$sellingprice = $row->selling_price;
					$view_unit = $row->view_unit;
					$pricemanual = $row->price_manual;
					$bf = $row->bf;
					$dp = $row->dp;
					$pl = $row->pl;
					
					
					// $tottanah 			= $tottanah + $tanah;
					// $totbangunan		= $totbangunan + $bangunan;
					// $totpricemanual		= $totpricemanual + $pricemanual;
					// $totsellingprice 	= $totsellingprice + $sellingprice;
					// $totdiscamount		= $totdiscamount + $discamount;
					// $totbf				= $totbf + $bf;
					// $totdp				= $totdp + $dp;
					// $totpl				= $totpl + $pl;
					
					
					
					$pricem2 = $sellingprice/$bangunan;
					
					$pricemanual =  number_format($row->price_manual);
					$pricem2	= number_format($pricem2);
					
					$discamount = number_format($row->discamount);
										
					$sellingprice= number_format($row->selling_price);
					
					
					$bf	= number_format($row->bf);
					$dp	= number_format($row->dp);
					$pl = number_format($row->pl);

?>


	<tr>
		<td><?=$i?></td>
		<td><?=indo_date($tglsales)?></td>
		<td><?=$no_sp?></td>
		<td><?=$customernama?></td>
		<td><?=$nama?></td>
		<td><?=$unitno?></td>
		<td><?=$paytipenm?></td>
		<td><?=$paytipepl?></td>
		<td><?=$tanah?></td>
		<td><?=$bangunan?></td>
		<td><?=$pricemanual?></td>
		<td><?=$discamount?></td>
		<td><?=$sellingprice?></td>
		<td><?=$pricem2?></td>
		<td><?=$bf?></td>
		<td><?=$dp?></td>
		<td><?=$pl?></td>
		<td><?=$view_unit?></td>
	</tr>	

<?php endforeach ?>
	
</table>
