<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<style type="text/css">
.text{
  mso-number-format:"\@";/*force text*/
}
</style>
<table border="1">
	<tr>
		<td>No</td>
		<td>Unit.No</td>
		<td>Customer Name</td>
		<td>Payment Type</td>
		<td>Sales Date</td>
		<td>Sqm.Nett</td>
		<td>Sqm.SGA</td>
		<td>Project</td>
		<!--<td>Hp</td>-->
		<td>Selling Price (Ppn)</td>
		<td>Paid</td>
		<td>%</td>
		<td>Not Due</td>
		<td>Over Due</td>
		<td>0 - 30 Days</td>
		<td>31 - 60 Days</td>
		<td>61 - 90 Days</td>
		<td>91 Days - 1 Years</td>
		<td>1 Years - 2 Years</td
		<td>2 Years - 3 Years</td
		<td> > 3 Years</td>
		<td>Total Outstanding</td>
	</tr>

<?php
extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];

// $rows = $this->db->query("AgingbyProject '".$subproject."','".$start_date."','".$duapuluh."'");
// $data = $rows->result();

$data = $this->db->query("AgingbyProjectBSU ".$pt."")->result();
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
$tot11 = 0;
$tot12 = 0;
$tot13 = 0;
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
$tot11 = $tot11 + $row->aging1th;
$tot12= $tot12 + $row->aging2th;
$tot13 = $tot13 + $row->aging3th;
$tot10 = $tot10 + $os;
$ab = 0;
//$note = $ab.$row->customer_tlp;
//$nope = $ab.$row->customer_hp;


?>
	<tr>
		<td><?=$i?></td>
		<td><?=$row->unit_no?></td>
		<td><?=$row->customer_nama?></td>
		<td><?=$row->paytipe_nm?></td>
		<td><?=$row->tgl_sales?></td>
		<td><?=$row->tanah?></td>
		<td><?=$row->bangunan?></td>
		
		<td><?=$row->id_subproject?></td>
		<!--<td class="text"><?=$row->customer_hp?></td>-->
		<td><?=number_format($row->selling_price)?></td>
		<td><?=number_format($row->payamount)?></td>
		<td><?=$persen2?></td>
		<td><?=number_format($row->notdue)?></td>
		<td><?=number_format($overdue)?></td>
		<td><?=number_format($row->aging30)?></td>
		<td><?=number_format($row->aging60)?></td>
		<td><?=number_format($row->aging90)?></td>
		<td><?=number_format($row->aging1th)?></td>
		<td><?=number_format($row->aging2th)?></td>
		<td><?=number_format($row->aging3th)?></td>
		<td><?=number_format($row->agingover)?></td>
		<td><?=number_format($os)?></td>
	</tr>
<?php
endforeach;
?>
	<tr>
		<td colspan="8">Total</td>
		<td><?=number_format($tot1)?></td>
		<td><?=number_format($tot2)?></td>
		<td><?=number_format($tot3)?></td>
		<td><?=number_format($tot4)?></td>
		<td><?=number_format($tot5)?></td>
		<td><?=number_format($tot6)?></td>
		<td><?=number_format($tot7)?></td>
		<td><?=number_format($tot8)?></td>
		<td><?=number_format($tot11)?></td
		<td><?=number_format($tot12)?></td
		<td><?=number_format($tot13)?></td
		<td><?=number_format($tot9)?></td>
		<td><?=number_format($tot10)?></td>
	</tr>
