<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>Project Name</td>
		<td>Unit Sale</td>
		<td>NETT/LAND Sale</td>
		<td>SGA/BUILDING Sale</td>
		<td>PriceList Basis Sale</td>
		<td>Unit Sold</td>
		<td>NETT/LAND Sold</td>
		<td>SGA/BUILDING Sold</td>
		<td>PriceList Basis Sold</td>
		<td>Unit AV</td>
		<td>NETT/LAND AV</td>
		<td>SGA/BUILDING AV</td>
		<td>PriceList Basis AV</td>
		</tr>
	
<?php 

extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];

IF($pt == 44){
$rows = $this->db->query("SoldUnit ");
$data = $rows->result();
}
ELSE{
$rows = $this->db->query("SoldUnitProject ".$pt."");
$data = $rows->result();				
}

//$data = $this->db->query("SalesReport '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();
			
//$data = $data1->result();

//$data = $this->db->query("PaymentCustomerReport '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."',".$pt."")->result();
//$data = $this->db->query("sp_payment_report '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();

//$data1 = $this->db->query("PaymentCustomerReport '".$subproject."','".$start_date."','".$end_date."'");
			
			// $data = $data1->result();

$i= 0; 
foreach($data as $row): 
$i++;
					//$tglsales = $row->tgl_sales;
					//$tglsales = indo_date($tglsales);
					
					
					
					// $customernama = $row->customer_nama;
					// $nama = $row->nama;
					// $no_sp = $row->no_sp;
					// $unitno = $row->unit_no;
					// $paytipepl = $row->id_paytipepl;
					// $paytipenm = $row->paytipe_nm;
					// $tanah = $row->tanah;
					// $discamount = $row->discamount;
					// $bangunan = $row->bangunan;
					// $sellingprice = $row->selling_price;
					// $view_unit = $row->view_unit;
					// $pricemanual = $row->price_manual;
					// $bf = $row->bf;
					// $dp = $row->dp;
					// $pl = $row->pl;
					
					
					// $tottanah 			= $tottanah + $tanah;
					// $totbangunan		= $totbangunan + $bangunan;
					// $totpricemanual		= $totpricemanual + $pricemanual;
					// $totsellingprice 	= $totsellingprice + $sellingprice;
					// $totdiscamount		= $totdiscamount + $discamount;
					// $totbf				= $totbf + $bf;
					// $totdp				= $totdp + $dp;
					// $totpl				= $totpl + $pl;
					
					
					
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
		<td><?=$row->projectname?></td>
		<td><?=$row->totstok?></td>
		<td><?=$row->totstoknett?></td>
		<td><?=$row->totstoksga?></td>
		<td><?=$row->totpricebasic?></td>
		<td><?=$row->sold?></td>
		<td><?=$row->soldnett?></td>
		<td><?=$row->soldsga?></td>
		<td><?=$row->soldprice?></td>
		<td><?=$row->totstok-$row->sold?></td>
		<td><?=$row->totstoknett-$row->soldnett?></td>
		<td><?=$row->totstoksga-$row->soldsga?></td>
		<td><?=$row->totpricebasic-$row->soldprice?></td>
	
	</tr>	

<?php endforeach ?>
	
</table>
