<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<table border="1">
	<tr>
		<td>No</td>
		<td>Unit</td>
		<td>Customer</td>
		<td>Alamat</td>
		<td>Handphone</td>
		<td>Sales</td>		
	</tr>
	

<?php 

extract(PopulateForm());

$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];

$data = $this->db->query("CustomerAddressReport '".$proj."','".$pt."'")->result();

$i= 0; 
$total = 0;
foreach($data as $row): 
$i++;
//$persen = ($row->pay / $row->selling_price) * 100;

	

?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->unit_no?></td>
		<td><?=$row->customer_nama?></td>
		<td><?=$row->customer_alamat2?></td>
		<td><?=$row->customer_hp?></td>
		<td><?=$row->nama?></td>
	</tr>	
<?php endforeach ?>
	
</table>
