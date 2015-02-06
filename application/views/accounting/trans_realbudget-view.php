<?php


#ambil data dari fungsi MYController
#tampilkan format tanggal
$tanggal 		= date("d-m-Y",strtotime($data->tanggal));

$amount			= number_format($data->amount);

#ambil data dari db_trbgtdiv
$real = $this->mstmodel->trbgtdiv($data->id_trbgt);
#ambil data divisi
$div	= $this->mstmodel->getdivisi($data->divisi_id);


#ambil data status dan approve dari db_trbgtdiv
$status 	= $real->status_bgt;
$apptanggal = date("d-m-Y",strtotime($real->apptanggal));
			  
			  
$appamount	= $real->appamount;
$appremark	= $real->appremark;

#rubah fungsi tanggal


#Ambil data divisi dari db_divisi
$divisi	= $div->divisi_nm;

#Ambil data coa dari db_mstbgt
$coa 		= $this->mstmodel->getmstbudget($data->code_id);
$acc 		= $coa->acc;
$coadesc 	= $coa->descacc;
$descbgt 	= $coa->descbgt;
$cf 		= $coa->cf;
$desccf 	= $coa->desccf;


#ambil data detail budget dari db_trbgtdiv
$bgt_month					= $real->bgt_month;
$act_month					= $real->act_month;
$bgtytd_month				= $real->bgtytd_month;
$actytd_month				= $real->actytd_month;
$bgtann_month				= $real->bgtann_month;
$actann_month				= $real->actann_month;

#hitung detail budget balance
$detblcmonth = $bgt_month - $act_month;
$detblcytd	= $bgtytd_month - $actytd_month;
$detblcann	= $bgtann_month  - $actann_month;

#format akunting detai budget
$bgt_month		= number_format($real->bgt_month);
$act_month		= number_format($real->act_month);
$bgtytd_month	= number_format($real->bgtytd_month);
$actytd_month	= number_format($real->actytd_month);
$bgtann_month	= number_format($real->bgtann_month);
$actann_month	= number_format($real->actann_month);
$detblcmonth	= number_format($detblcmonth);			
$detblcytd		= number_format($detblcytd);
$detblcann		= number_format($detblcann);

#ambil data divisi budget dari db_trbgtdiv			
$bgt_divmonth		= $real->bgt_divmonth;
$act_divmonth		= $real->act_divmonth;
$bgtytd_divmonth	= $real->bgtytd_divmonth;
$actytd_divmonth	= $real->actytd_divmonth;
$bgtann_divmonth	= $real->bgtann_divmonth;
$actann_divmonth	= $real->actann_divmonth;

#hitung divisi budget Balance
$divblcmonth	= $bgt_divmonth - $act_divmonth; 
$divblcytd		= $bgtytd_divmonth - $actytd_divmonth; 
$divblcann		= $bgtann_divmonth - $actann_divmonth; 

#format akunting divisi budget
$bgt_divmonth		= number_format($real->bgt_divmonth);
$act_divmonth		= number_format($real->act_divmonth);
$bgtytd_divmonth	= number_format($real->bgtytd_divmonth);
$actytd_divmonth	= number_format($real->actytd_divmonth);
$bgtann_divmonth	= number_format($real->bgtann_divmonth);
$actann_divmonth	= number_format($real->actann_divmonth);
$divblcmonth		= number_format($divblcmonth);
$divblcytd			= number_format($divblcytd);
$divblcann			= number_format($divblcann);
			
#ambil data alldivisi budget dari db_trbgtdiv	
$bgt_alldivmonth		= $real->bgt_alldivmonth;
$act_alldivmonth		= $real->act_alldivmonth;
$bgtytd_alldivmonth		= $real->bgtytd_alldivmonth;
$actytd_alldivmonth		= $real->actytd_alldivmonth;
$bgtann_alldivmonth		= $real->bgtann_alldivmonth;
$actann_alldivmonth		= $real->actann_alldivmonth;

#hitung all divisi budget Balance
$allblcmonth	= $bgt_alldivmonth - $act_alldivmonth;	
$allblcytd		= $bgtytd_alldivmonth - $actytd_alldivmonth;	
$allblcann		= $bgtann_alldivmonth - $actann_alldivmonth;


#format akunting All divisi budget
$bgt_alldivmonth		= number_format($real->bgt_alldivmonth);
$act_alldivmonth		= number_format($real->act_alldivmonth);
$bgtytd_alldivmonth		= number_format($real->bgtytd_alldivmonth);
$actytd_alldivmonth		= number_format($real->actytd_alldivmonth);
$bgtann_alldivmonth		= number_format($real->bgtann_alldivmonth);
$actann_alldivmonth		= number_format($real->actann_alldivmonth);
$allblcmonth			= number_format($allblcmonth);
$allblcytd				= number_format($allblcytd);
$allblcann				= number_format($allblcann);



?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<script type="text/javascript">
</script>
<div id="utama"align="center">
<form method="post" action=""  id="formAdd">
	<!--<input type="hidden" name="divisi_id" id="divisi_id"/>-->
	<table border="0">
		<tr>
			
				<td>Proposed Date</td>
				<td>:</td> 
				<td ><b><?=$tanggal;?></b></td>
				<td>Approved Date</td>
				<td>:</td> 
				<td><b> <?=$apptanggal?> </b></td>
				<td>ACC. Account</td>
				<td>:</td> 
				<td><b><?=$acc ?> </b></td>
	
		</tr>
		<tr>
				<td>Proposed</td>
				<td>:</td> 
				<td><b><?=$amount?></b></td>			
				<td>Approved</td>
				<td>:</td> 
				<td><b><?=$amount?></b></td>			
				<td>ACC. Desc</td>
				<td>:</td> 
				<td><b><?=$coadesc?> </b> </td>			
		</tr>
		<tr>
				<td>Status</td>
				<td>:</td> 
				<td><b><?=$status?></b></td>			
				<td>BGT. Account</td>
				<td>:</td> 
				<td><b><?=$data->code_id?></b></td>			
				<td>CF. Account</td>
				<td>:</td> 
				<td><b><?=$cf?></b></td>			
		
		</tr>
		<tr>
				<td>Divisi</td>
				<td>:</td> 
				<td><b><?=$divisi?></b></td>			
				<td>BGT. Desc</td>
				<td>:</td> 
				<td><b><?=$descbgt?></b></td>			
				<td>CF. Desc</td>
				<td>:</td> 
				<td><b><?=$desccf?></b></td>			
		</tr>
		<tr>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>DETAIL BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>DIVISION BUDGET</b></font></td>
			<td colspan='3' valign='center' align='center' bgcolor='black'><font color='white'><b>ALL BUDGET</b></font></td>
		</tr>
		
				<tr>
						<td>Budget  Month</td>
						<td>:</td>
						<td align="right"><input type="text" name=""  class="input"  value="<?=$bgt_month?>" readonly="true" ></td>					
						<td>Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  value="<?=$bgt_divmonth?>" readonly="true"/></td>
						
						<td>Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="" class="input" value="<?=$bgt_alldivmonth?>" readonly="true"/></td>
				</tr>
				<tr>
						<td>Actual  Month</td>
						<td>:</td>
						<td align="right"><input type="text" name="" value="<?=$act_month?>" class="input validate[required]" readonly="true" ></td>
					
						<td>Actual  Month</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  value="<?=$act_divmonth?>"  readonly="true"/></td>
						
						<td>Actual  Month</td>
						<td>:</td>
						<td><input type="text" name="" class="input" value="<?=$act_alldivmonth?>"  readonly="true"/></td>
				</tr>
				<tr>
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="blc_month" value="<?=$detblcmonth?>" class="input" readonly="true"/></td>
					
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="blc_divmonth" class="input"  value="<?=$divblcmonth?>" readonly="true"/></td>
						
						<td>Balance Budget  Month</td>
						<td>:</td>
						<td><input type="text" name="blc_divallmonth" class="input"  value="<?=$allblcmonth?>" readonly="true"/></td>
				</tr>
				<tr>	
						<td>Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="" id="bgt_ytd" value="<?=$bgtytd_month?>" class="input" readonly="true"/></td>
					
						<td>Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="" class="input" value="<?=$bgtytd_divmonth?>"  readonly="true"/></td>
						
						<td>Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="" class="input" value="<?=$bgtytd_alldivmonth?>" readonly="true"/></td>
				</tr>
				<tr>
						<td>Actual  YTD</td>
						<td>:</td>
						<td align="right"><input type="text" name=""  class="input validate[required]" value="<?=$actytd_month?>" readonly="true" ></td>
					
						<td>Actual  YTD</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  readonly="true" value="<?=$actytd_divmonth?>" /></td>
						
						<td>Actual  YTD</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  readonly="true" value="<?=$actytd_alldivmonth?>" /></td>
				</tr>
				<tr>
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="blc_ytd"  class="input" readonly="true" value="<?=$detblcytd?>"/></td>
					
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name="blc_divytd" class="input"  readonly="true" value="<?=$divblcytd?>" /></td>
						
						<td>Balance Budget  YTD</td>
						<td>:</td>
						<td><input type="text" name=" blc_divallytd" class="input"  readonly="true" value="<?=$allblcytd?>" /></td>
				</tr>
				<tr>						
						<td>Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  value="<?=$bgtann_month?>" readonly="true"/></td>
					
						<td>Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="" class="input" value="<?=$bgtann_divmonth?>" readonly="true"/></td>
						
						<td>Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  value="<?=$bgtann_alldivmonth?>" readonly="true"/></td>
				</tr>
				<tr>						
						<td>Actual  Annual</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  readonly="true" value="<?=$actann_month?>"/></td>
					
						<td>Actual  Annual</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  readonly="true" value="<?=$actann_divmonth?>"/></td>
						
						<td>Actual  Annual</td>
						<td>:</td>
						<td><input type="text" name="" class="input"  readonly="true" value="<?=$actann_alldivmonth?>"/></td>
				</tr>
				<tr>
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="blc_ann" class="input"  readonly="true" value="<?=$detblcann?>"/></td>
										
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="blc_divann" class="input"  readonly="true" value="<?=$divblcann?>"/></td>
					
						<td>Balance Budget  Annual</td>
						<td>:</td>
						<td><input type="text" name="blc_divallann" class="input"  readonly="true" value="<?=$allblcann?>"/></td>
				</tr>
		
		<tr>
			
				<td>Remark</td> 
				<td>:</td> 
				<td colspan='7'><textarea name="remark" id="remark" readonly="true" class="validate[required]"><?=$data->remark?></textarea></td>
			
		</tr>
	</table>
</form>
</div>
