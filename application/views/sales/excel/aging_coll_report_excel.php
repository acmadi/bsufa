<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!--
<style type="text/css">
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
-->
<table border="1">
	<tr>
		<td>No</td>
		<td>Unit.No</td>
		<td>Customer Name</td>
		<td>Payment Type</td>
		<td>Sales Date</td>
		<td>Sqm.Nett</td>
		<td>Sqm.SGA</td>
		<td>Telp</td>
		<td>Hp</td>
		<td>Selling Price (Ppn)</td>
		<td>Paid</td>
		<td>%</td>
		<td>Not Due</td>
		<td>Over Due</td>
		<td>0 - 30 Days</td>
		<td>31 - 60 Days</td>
		<td>61 - 90 Days</td>
		<td> > 90 Days</td>
		<td>Total Outstanding</td>
	</tr>

<?php
extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];
$start_date = inggris_date($start_date);

//$data = $this->db->query("UnitSalesAging ".$pt.",'".$start_date."'")->result();
$data = $this->db->query("AgingbyALLProject ".$pt.",'".$start_date."','".$duapuluh."'")->result();
//var_dump($data);exit();
$i = 0;
$tot1 = 0;
$tot2 = 0;
$tot3 = 0;
$tot4 = 0;
$tot5 = 0;
$tot6 = 0;
$tot7 = 0;
$tot8 = 0;
$tot9 = 0;
$tot10 = 0;
foreach($data as $row):
$i++;
$persen = round(($row->payamount / $row->selling_price) * 100);
$persen2 =$persen.'%';
$overdue = $row->aging30 + $row->aging60 + $row->aging90 + $row->agingover;
$os = $row->selling_price - $row->payamount;
$tot1 = $tot1 + $row->selling_price;
$tot2 = $tot2 + $row->payamount;
$tot3 = $tot3 + $persen;
$tot4 = $tot4 + $row->notdue;
$tot5 = $tot5 + $overdue;
$tot6 = $tot6 + $row->aging30;
$tot7 = $tot7 + $row->aging60;
$tot8 = $tot8 + $row->aging90;
$tot9 = $tot9 + $row->agingover;
$tot10 = $tot10 + $os;
$ab = 0;
$note = $ab.$row->customer_tlp;
$nope = $ab.$row->customer_hp;

$tglsales = $row->tgl_sales;
$tglsales2 = inggris_date($tglsales);


?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->unit_no?></td>
		<td><?=$row->customer_nama?></td>
		<td><?=$row->paytipe_nm?></td>
		<td><?=$tglsales2?></td>
		<td><?=$row->tanah?></td>
		<td><?=$row->bangunan?></td>
		
		<td class="text"><?=$row->customer_tlp?></td>
		<td class="text"><?=$row->customer_hp?></td>
		<td><?=number_format($row->selling_price)?></td>
		<td><?=number_format($row->payamount)?></td>
		<td><?=$persen2?></td>
		<td><?=number_format($row->notdue)?></td>
		<td><?=number_format($overdue)?></td>
		<td><?=number_format($row->aging30)?></td>
		<td><?=number_format($row->aging60)?></td>
		<td><?=number_format($row->aging90)?></td>
		<td><?=number_format($row->agingover)?></td>
		<td><?=number_format($os)?></td>
	</tr>
<?php
endforeach;
?>
	<tr>
		<td colspan="9">Total</td>
		<td><?=number_format($tot1)?></td>
		<td><?=number_format($tot2)?></td>
		<td><?=number_format($tot3)?></td>
		<td><?=number_format($tot4)?></td>
		<td><?=number_format($tot5)?></td>
		<td><?=number_format($tot6)?></td>
		<td><?=number_format($tot7)?></td>
		<td><?=number_format($tot8)?></td>
		<td><?=number_format($tot9)?></td>
		<td><?=number_format($tot10)?></td>
	</tr>
