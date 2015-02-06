<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<?php
$date = date("d-m-Y");
$apptanggal = date("d-m-Y",strtotime($data->apptanggal));
#list($d,$m,$Y) = split("-",$apptanggal);

$tanggal = date("d-m-Y",strtotime($data->tanggal));
list($d,$m,$Y) = split("-",$tanggal);

$month = date( 'F', mktime(0, 0, 0, $m));
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$pt = $session_id['id_pt'];	
$divisi = $data->divisi_id;
$kode = $data->code_id;
$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");

#Budget Month
$id = str_replace("0","",$m);
$jbln = $arr[$id];
$tot3 = $this->mstmodel->total_month($kode,$jbln,$Y);
$tot4 = $this->mstmodel->appact_month($kode,$month,$Y);
$totmnth = $tot3['jml'];
$actmonth = $tot4['jml'];
$blc_month = $totmnth - $actmonth;

$amount = number_format($data->amount);

#Budget Annual
$tot1 = $this->mstmodel->total_annual($kode,$Y);
$tot2 = $this->mstmodel->appact_annual($kode,$divisi,$Y);
$totmst = $tot1['tot_mst'];
$actann = $tot2['jml'];
$blcann = $totmst - $actann;

#Budget YTD
$totytd = 0;
for($i=1;$i<=$m;$i++){
	$n = $arr[$i];
	$tot5 = $this->mstmodel->total_ytd($n,$kode,$Y);
	$hsl = $tot5['jml'];
	$totytd = $totytd + $hsl;
}	
$tot6 = $this->mstmodel->appact_ytd($kode,$Y);
$actytd = $tot6['jml'];
$blcytd = $totytd - $actytd;




#Budget Month perdivisi
$tot3div = $this->mstmodel->total_monthdiv($divisi,$jbln,$Y);
$tot4div = $this->mstmodel->appact_monthdiv($divisi,$month,$Y);
$totmnthdiv = $tot3div['jml'];
$actdivmonth = $tot4div['jml'];
$blc_divmonth = $totmnthdiv - $actdivmonth;

#Budget YTD perdivisi
$totytddiv = 0;
for($i=1;$i<=$m;$i++){
	$n = $arr[$i];
	$tot5div = $this->mstmodel->total_ytddiv($n,$divisi,$Y);
	$hsldiv = $tot5div['jml'];
	$totytddiv = $totytddiv + $hsldiv;
}	
$tot6div = $this->mstmodel->appact_ytddiv($divisi,$Y);
$actytddiv = $tot6div['jml'];
$blcytddiv = $totytddiv - $actytddiv;		

#Budget Annual Perdivisi
$dtdiv = $this->mstmodel->total_annualdiv($divisi,$Y,$pt);
$dtactdiv = $this->mstmodel->appact_annualdiv($divisi,$Y,$pt);
$totdiv = $dtdiv->jml;
$actanndiv = $dtactdiv ->jml;
$blcanndiv = $totdiv - $actanndiv;

#Budget Annual Alldivisi
$dtalldiv = $this->mstmodel->total_annualalldiv($Y,$pt);
$dtactalldiv = $this->mstmodel->appact_annualalldiv($Y,$pt);
$totalldiv = $dtalldiv->jml;
$actannalldiv = $dtactalldiv->jml;
$blcannalldiv = $totalldiv - $actannalldiv;

#Budget Month Alldivisi
$tot3alldiv = $this->mstmodel->total_monthalldiv($jbln,$Y,$pt);
$tot4alldiv = $this->mstmodel->appact_monthalldiv($month,$Y,$pt);
$totmnthalldiv = $tot3alldiv['jml'];
$actmnthalldiv = $tot4alldiv['jml'];
$blc_alldivmonth = $totmnthalldiv - $actmnthalldiv;

#divisi
$div = $this->mstmodel->getdivisi($divisi);


$totytdalldiv = 0;
for($i=1;$i<=$m;$i++){
	$n = $arr[$i];
	$tot5alldiv = $this->mstmodel->total_ytdalldiv($n,$Y,$pt);
	$hslalldiv = $tot5alldiv['jml'];
	$totytdalldiv = $totytdalldiv + $hslalldiv;
}			
$tot6alldiv = $this->mstmodel->appact_ytdalldiv($Y,$pt);
$actytdalldiv = $tot6alldiv['jml'];
$blcytdalldiv = $totytdalldiv - $actytdalldiv;

$namabudget = $this->mstmodel->get_namabudget($data->id_trbgt);
$nama		= $namabudget['descbgt'];
$code		= $namabudget['code'];

?>

<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<script type="text/javascript">
	$(function(){
		$('#formAdd').validationEngine({
				beforeSuccess: function(){
					refreshTable();
					setTimeout('location.reload(true);',100);
				},			
				success: function(){
					$('#formAdd').ajaxSubmit({
						success: function(data){
							alert(String(data).replace(/<\/?[^>]+>/gi, ''));
							refreshTable();
							setTimeout('location.reload(true);',100);
						}
					});
					return false;
				}
			});
		
		$('.calculate').bind('keyup keypress',function(){
			$(this).val( numToCurr( $(this).val() ) );
		  }).numeric();
			
		});
</script>
<div id="utama"align="center">
<form method="post" action="<?=site_url('print/slip_appbudget')?>"  id="formAdd" target="_blank">
	<input type="hidden" name="code" id="code" value="<?=$data->code_id?>"/>
	
	<input type="hidden" name="apptanggal" id="apptanggal" value="<?=$date?>"/>
	<table border="0" width="850px">
		<tr>
				<td>Approved Date</td>
				<td>:</td> 
				<td ><b><?=@$apptanggal?></b></td>
								
				<td>Proposed Date</td>
				<td>:</td> 
				<td ><b><?=$tanggal?></b></td>
				
				<td>ACC. Account</td>
				<td>:</td> 
				<td><b><?=$kd['acc']?></b></td>
				
		</tr>
		<tr>
				<td>Approved Amount </td>
				<td>:</td> 
				<td><span><b><?=number_format($data->appamount)?></b></span></td>
								
				<td>Proposed Amount </td>
				<td>:</td> 
				<td><b><?=$amount?></b></td>
	
				<td>ACC. Desc</td>
				<td>:</td> 
				<td ><b><?=$kd['descacc']?></b></td>
		</tr>	
		
		<tr>
				<td>Status</td>
				<td>:</td> 
				<td><b><?=$data->status_bgt?></b></td>
				
				<td>BGT. Account </td>
				<td>:</td> 
				<td><b><?=$code?></b></td>
				
				<td>CF. Account</td>
				<td>:</td> 
				<td><b><?=$kd['cf']?></b></td>
				
		</tr>		
				
				<td>Divisi</td>
				<td>:</td> 
				<td><b><?=$div->divisi_nm?></b></td>
				<td>BGT. Desc </td>
				<td>:</td> 
				<td><b><?=$nama?></b></td>
				<td>CF. Desc </td>
				<td>:</td> 
				<td><b></b></td>
			
		</tr>
	
		<tr>
				<td>Remark</td> 
				<td>:</td>
				<td colspan='7'><?=@$data->appremark?></td> 
		</tr>
		<tr>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>DETAIL BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>DIVISION BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>ALL BUDGET</b></font></td>
		</tr>
		
				<tr>
						<td>Budget  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($totmnth)?></td>					
						<td>Budget  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($totmnthdiv)?></td>
						
						<td>Budget  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($totmnthalldiv)?></td>
				</tr>
				<tr>
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($actmonth)?></td>
					
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($actdivmonth)?></td>
						
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($actmnthalldiv)?></td>
				</tr>
				<tr>
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($blc_month)?></td>
					
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($blc_divmonth)?></td>
						
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td align="right"><?=number_format($blc_alldivmonth)?></td>
				</tr>
				<tr>	
						<td>Budget  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($totytd)?></td>
					
						<td>Budget  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($totytddiv)?></td>
						
						<td>Budget  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($totytdalldiv)?></td>
				</tr>
				<tr>
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($actytd)?></td>
					
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($actytddiv)?></td>
						
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($actytdalldiv)?></td>
				</tr>
				<tr>
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($blcytd)?></td>
					
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($blcytddiv)?></td>
						
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td align="right"><?=number_format($blcytdalldiv)?></td>
				</tr>
				<tr>						
						<td>Budget  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($totmst)?></td>
					
						<td>Budget  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($totdiv)?></td>
						
						<td>Budget  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($totalldiv)?></td>
				</tr>
				<tr>						
						<td>Actual  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($actann)?></td>
					
						<td>Actual  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($actanndiv)?></td>
						
						<td>Actual  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($actannalldiv)?></td>
				</tr>
				<tr>
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($blcann)?></td>
										
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($blcanndiv)?></td>
					
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td align="right"><?=number_format($blcannalldiv)?></td>
				</tr>
			<tr>
		</tr>
	</table>
</form>
</div>

