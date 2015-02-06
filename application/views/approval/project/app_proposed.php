


<?php
	
	
	defined('BASEPATH') or die('Access Denied');
	
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('proposedbgt/appprop'), $attr);

?>
	
	<? if($tes->id_flag == 1){ echo "SORRRY THIS PROPOSED BUDGET HAS BEEN APPROVED";}else{?>
	
			<table width='40%' align='center' border='0' cellpading='1' cellspacing='1'>
			
			<tr>
				<td style='width:150px;'> No.</td>
				<td style='width:2px;'>:</td>
				<td><input type='text' name='no' id='no' value='<?=$tes->no_trbgtproj?>' style='width:250px;background-color:#FFFF80;' readonly='true'></td>
			</tr>
			<tr>
				<td>Date</td>
				<td >:</td>
				<td><input type='text' name='vname' id='vname' style='background-color:#FFFF80;' readonly='true' value='<?=indo_date($tes->tgl_proposed)?>'></td>
			</tr>
			
			<tr>
				<td >Job</td>
				<td >:</td>
				<td><input type='text' name='job' id='job' style='width:500px;background-color:#FFFF80;' readonly='true' value='<?=$tes->mainjob_desc?>'></td>
			</tr>
			<tr>
				<td>Value</td>
				<td>:</td>
				<td><input type='text' name='nilai' id='nilai' style='text-align:right;background-color:#FFB0B0;' readonly='true' value='<?=number_format($tes->mainjob_total)?>'></td>
			</tr>
			
		</table><br>
		
		<table border='0' cellpadding ='1' cellspacing='1'>
			<tr>
				<td colspan='8' bgcolor='black' align='center' ><font color='white'><b>BUDGET ALOCATION</b></font></td>
			</tr>
			<tr bgcolor='#5D5D5D' align='center' style='font-size:15px;'>
<!--
				<td>No</td>
-->
				<td><font color='#FFFFFF'>CODE</font></td>
				<td><font color='#FFFFFF'>ACCOUNT</td>
				<td><font color='#FFFFFF'>PROJECT</td>
				<td><font color='#FFFFFF'>BUDGET</td>
				<td><font color='#FFFFFF'>TOTAL</td>
				<td><font color='#FFFFFF'>ACTUAL</td>
				<td><font color='#FFFFFF'>PROPOSED</td>
				<td><font color='#FFFFFF'>BALANCED</td>
		   </tr>
			
		  <?$totprop = 0;
			foreach($sql as $row):?>
		  
				<?$nilblc = $row->totbgt - ($row->totact + $row->nilai_proposed);?>
				
			<tr bgcolor=''>
				
				<td style='width:100px'><?=$row->kd_bgtproj?></td>
				<td style='width:100px'><?=$row->coa_no?></td>
				<td style='width:200px;font-size:14px;'><?=$row->nm_subproject?></td>
				<td style='width:500px'><?=$row->nm_bgtproj?></td>
				<td style='width:120px;text-align:right;'><font><?=number_format($row->totbgt)?></font></td>
				<td style='width:120px;text-align:right;'><?=number_format($row->totact)?></td>
				<td style='width:120px;text-align:right;'><?=number_format($row->nilai_proposed)?></td>
				<td style='width:120px;text-align:right;'><?=number_format($nilblc)?></td>
		   </tr>
		   
			<?$totprop = $totprop + $row->nilai_proposed;
			  endforeach?>
			<tr>
				<td colspan='6' style='background-color:black;'>&nbsp;</td>
				<td style='width:120px;text-align:right;background-color:#FFB0B0;'><?=number_format($totprop)?></td>
				<td style='background-color:black;'>&nbsp;</td>
			</tr>
		<table>
		
				<label><button type='submit' name='klik' value='1'>Approved</label>
				<label><button type='submit' name='batal' value='1'>Declined</label>
				
			</tr>
		</table>
			<?}?>
	<?=form_close()?>
		
		

		
		
