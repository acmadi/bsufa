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
		<td>Customer</td>
		<td>Unit.No</td>
		<td>TOP</td>
		<td>Selling Price</td>
		<td>Total Paid</td>
		<td>Payment BF</td>
		<td>Payment DP</td>
		<td>Payment PL</td>
		<td>O/S</td>
		<td>Paid</td>
		<td>Sales Name</td>
	</tr>
	
<?php 

extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];


//$data = $this->db->query("PaymentCustomerReport '".$subproject."','".inggris_date($end_date)."',".$pt."")->result();
$data = $this->db->query("PaymentCustomerReport '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."',".$pt."")->result();
//$data = $this->db->query("sp_payment_report '".$subproject."','".inggris_date($start_date)."','".inggris_date($end_date)."'")->result();

//$data1 = $this->db->query("PaymentCustomerReport '".$subproject."','".$start_date."','".$end_date."'");
			
			// $data = $data1->result();

$i= 0; 
foreach($data as $row): 
$i++;
$totpaid = $row->bf + $row->dp + $row->pl;
$persen = ($totpaid / $row->selling_price) * 100;
$os = $row->selling_price - $totpaid;

?>
	<tr>
		<td><?=$i?></td>
		<td><?=indo_date($row->tgl_sales)?></td>
		<td><?=$row->customer_nama?></td>
		<td><?=$row->unit_no?></td>
		<td><?=$row->paytipe_nm?></td>
		<td><?=number_format($row->selling_price)?></td>
		<td><?=number_format($totpaid)?></td>
		<td><?=number_format($row->bf)?></td>
		<td><?=number_format($row->dp)?></td>
		<td><?=number_format($row->pl)?></td>
		<td><?=number_format($os)?></td>
		<td><?=number_format($persen)?></td>
		<td><?=$row->nama?></td>
	</tr>	
<?php endforeach ?>
	
</table>
