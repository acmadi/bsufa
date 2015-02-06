<?php
$date = date("d-m-Y");
$tanggal = strftime("%d-%m-%Y",strtotime($data->tanggal));
list($d,$m,$Y) = split("-",$tanggal);
$month = date( 'F', mktime(0, 0, 0, $m));
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];	
$divisi = $data->divisi_id;
$kode = $data->code_id;
$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");

#Budget Month
$id = str_replace("0","",$m);
$jbln = $arr[$id];
$tot3 = $this->mstmodel->total_month($kode,$jbln,$Y);
$tot4 = $this->mstmodel->realact_month($kode,$month,$Y);
$totmnth = $tot3['jml'];
$actmonth = $tot4['jml'];
$blc_month = $totmnth - $actmonth;


#Budget Annual
$tot1 = $this->mstmodel->total_annual($kode,$Y);
$tot2 = $this->mstmodel->realact_annual($kode,$divisi,$Y);
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
$tot6 = $this->mstmodel->realact_ytd($kode,$Y);
$actytd = $tot6['jml'];
$blcytd = $totytd - $actytd;




#Budget Month perdivisi
$tot3div = $this->mstmodel->total_monthdiv($divisi,$jbln,$Y);
$tot4div = $this->mstmodel->realact_monthdiv($divisi,$month,$Y);
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
$tot6div = $this->mstmodel->realact_ytddiv($divisi,$Y);
$actytddiv = $tot6div['jml'];
$blcytddiv = $totytddiv - $actytddiv;		

#Budget Annual Perdivisi
$dtdiv = $this->mstmodel->total_annualdiv($divisi,$Y);
$dtactdiv = $this->mstmodel->realact_annualdiv($divisi,$Y);
$totdiv = $dtdiv->jml;
$actanndiv = $dtactdiv ->jml;
$blcanndiv = $totdiv - $actanndiv;

#Budget Annual Alldivisi
$dtalldiv = $this->mstmodel->total_annualalldiv($Y);
$dtactalldiv = $this->mstmodel->realact_annualalldiv($Y);
$totalldiv = $dtalldiv->jml;
$actannalldiv = $dtactalldiv->jml;
$blcannalldiv = $totalldiv - $actannalldiv;

#Budget Month Alldivisi
$tot3alldiv = $this->mstmodel->total_monthalldiv($jbln,$Y);
$tot4alldiv = $this->mstmodel->realact_monthalldiv($month,$Y);
$totmnthalldiv = $tot3alldiv['jml'];
$actmnthalldiv = $tot4alldiv['jml'];
$blc_alldivmonth = $totmnthalldiv - $actmnthalldiv;

$totytdalldiv = 0;
for($i=1;$i<=$m;$i++){
	$n = $arr[$i];
	$tot5alldiv = $this->mstmodel->total_ytdalldiv($n,$Y);
	$hslalldiv = $tot5alldiv['jml'];
	$totytdalldiv = $totytdalldiv + $hslalldiv;
}			
$tot6alldiv = $this->mstmodel->realact_ytdalldiv($Y);
$actytdalldiv = $tot6alldiv['jml'];
$blcytdalldiv = $totytdalldiv - $actytdalldiv;

$namabudget = $this->mstmodel->get_namabudget($data->id_trbgt);
$nama		= $namabudget['descbgt'];

?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<script type="text/javascript">
</script>
<div id="utama"align="center">
<form method="post" action="<?=site_url('print/slip_realbudget')?>"  id="formAdd" target="_blank">
	<input type="hidden" name="code" id="code" value="<?=$data->code_id?>"/>
	
	<!--<input type="hidden" name="divisi_id" id="divisi_id"/>-->
	<table border="0">
		<tr>
			
				
				<td>Realisasi Date</td>
				<td>:</td> 
				<td ><input type="text" name="tgl_real" id="real_tgl" style='width:80px' class="input tgl" value="<?=$date?>" readonly="true" align='center'></td>

				<td>Proposed Date</td>
				<td>:</td> 
				<td colspan='6'><input type="text" name="tgl_aju" id="tgl_aju" style='width:80px' class="input tgl" value="<?=$tanggal?>" readonly="true" align='center'></td>
				
				
		</tr>
		<tr>
				<td>Realisasi Amount </td>
				<td>:</td> 
				<td >
				
				<?if ($data->flag_id == 2){?> 
				<input type="text" name="realamount" id="amount" class="calculate input validate[required]"  value="<?=number_format($data->realamount)?>" readonly='true'>
				<?} else{?>
				<input type="text" name="realamount" id="amount" class="calculate input validate[required]"  value="<?=number_format($data->realamount)?>" >
				<?}?>
				</td>
				
				
				<td>Proposed Amount </td>
				<td>:</td> 
				<td colspan='6'><input  type="text" name="amount" id="amount"  class="calculate input validate[required]" value="<?=number_format($data->amount)?>"  readonly='true' ></td>
		</tr>		
		
		
		
		
		<tr>
				<td>Description Budget</td>
				<td>:</td> 
				<td colspan='7'>
					<input type='text' name ='nama' value ="<?=$nama?>" readonly="true" style='width:400px'>
				</td>
			
		</tr>
		
		<tr>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>DETAIL BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>DIVISION BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>ALL BUDGET</b></font></td>
		</tr>
		
				<tr>
						<td>Budget  Month</td>
						<td>:</td>
						<td ><input type="text" name="bgt_month" id="bgt_month" class="input validate[required]" value="<?=number_format($totmnth)?>" readonly="true" ></td>					
						<td>Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="totmnthdiv" class="input" id="totmnthdiv" value="<?=number_format($totmnthdiv)?>" readonly="true"/></td>
						
						<td>Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="totmnthalldiv" class="input" id="totmnthalldiv" value="<?=number_format($totmnthalldiv)?>" readonly="true"/></td>
				</tr>
				<tr>
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><input type="text" name="actmonth" id="actmonth" value="<?=number_format($actmonth)?>" class="input validate[required]" readonly="true" ></td>
					
						<td>Actual  Month</td>
						<td>:</td>
						<td><input type="text" name="actdivmonth" class="input" id="actdivmonth" value="<?=number_format($actdivmonth)?>"  readonly="true"/></td>
						
						<td>Actual  Month</td>
						<td>:</td>
						<td><input type="text" name="actalldivmonth" class="input" id="actalldivmonth" value="<?=number_format($actmnthalldiv)?>"  readonly="true"/></td>
				</tr>
				<tr>
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td><input type="blc_month" name="blc_month" id="blc_month" value="<?=number_format($blc_month)?>" class="input" readonly="true"/></td>
					
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="blc_divmonth" class="input" id="blcmnthdiv" value="<?=number_format($blc_divmonth)?>" readonly="true"/></td>
						
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="blc_divallmonth" class="input" id="blcmnthalldiv" value="<?=number_format($blc_alldivmonth)?>" readonly="true"/></td>
				</tr>
				<tr>	
						<td>Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="bgt_ytd" id="bgt_ytd" value="<?=number_format($totytd)?>" class="input" readonly="true"/></td>
					
						<td>Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="totytddiv" class="input" value="<?=number_format($totytddiv)?>" id="totytddiv" readonly="true"/></td>
						
						<td>Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="totytdalldiv" class="input" id="totytdalldiv" value="<?=number_format($totytdalldiv)?>" readonly="true"/></td>
				</tr>
				<tr>
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><input type="text" name="actytd" id="actytd" class="input validate[required]" value="<?=number_format($actytd)?>" readonly="true" ></td>
					
						<td>Actual  YTD</td>
						<td>:</td>
						<td><input type="text" name="actdivytd" class="input" id="actdivytd" readonly="true" value="<?=number_format($actytddiv)?>" /></td>
						
						<td>Actual  YTD</td>
						<td>:</td>
						<td><input type="text" name="actalldivytd" class="input" id="actalldivytd" readonly="true" value="<?=number_format($actytdalldiv)?>" /></td>
				</tr>
				<tr>
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="blc_ytd" id="blc_ytd" class="input" readonly="true" value="<?=number_format($blcytd)?>"/></td>
					
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="blc_divytd" class="input" id="blcytddiv" readonly="true" value="<?=number_format($blcytddiv)?>" /></td>
						
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name=" blc_divallytd" class="input" id="blcytdalldiv" readonly="true" value="<?=number_format($blcytdalldiv)?>" /></td>
				</tr>
				<tr>						
						<td>Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="annu_tot" class="input" id="annu_tot" value="<?=number_format($totmst)?>" readonly="true"/></td>
					
						<td>Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="totdiv" class="input" id="totdiv" value="<?=number_format($totdiv)?>" readonly="true"/></td>
						
						<td>Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="totalldiv" class="input" id="totalldiv" value="<?=number_format($totalldiv)?>" readonly="true"/></td>
				</tr>
				<tr>						
						<td>Actual  Annual</td>
						<td>:</td>
						<td><input type="text" name="actann" class="input" id="actann" readonly="true" value="<?=number_format($actann)?>"/></td>
					
						<td>Actual  Annual</td>
						<td>:</td>
						<td><input type="text" name="actdivann" class="input" id="actdivann" readonly="true" value="<?=number_format($actanndiv)?>"/></td>
						
						<td>Actual  Annual</td>
						<td>:</td>
						<td><input type="text" name="actalldivann" class="input" id="actalldivann" readonly="true" value="<?=number_format($actannalldiv)?>"/></td>
				</tr>
				<tr>
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="blc_ann" class="input" id="tot_blc" readonly="true" value="<?=number_format($blcann)?>"/></td>
										
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="blc_divann" class="input" id="blcdiv" readonly="true" value="<?=number_format($blcanndiv)?>"/></td>
					
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="blc_divallann" class="input" id="blcalldiv" readonly="true" value="<?=number_format($blcannalldiv)?>"/></td>
				</tr>
		
		<tr>
				<td>Remark</td> 
				<td>:</td> 
				<td colspan='7'>
				<? if($data->flag_id == 2){?> 
				<textarea name="remark"  readonly='true' id="remark" style='width:200px' class="validate[required]"><?=$data->remark?></textarea>
				<?} else{?>
				<textarea name="remark"   id="remark" style='width:200px' class="validate[required]"><?=$data->remark?></textarea>
				<?}?>
				</td>
		</tr>
		
		
			<td colspan="9">
				<input type="hidden" name="id" value="<?=@$data->id_trbgt?>"/>
				<input type="submit" name="Realisasi" value="Realisasi">
				<input type="reset" id="btnClose" value="Close">
			</td>
		</tr>
	</table>
</form>
</div>

