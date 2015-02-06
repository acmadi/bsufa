<?#=script('jquery-1.7.2.min.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('cjc/saveapp'), $attr);
?>
		<? if($data->flag_id == 1){ echo "SORRRY THIS CJC HAS BEEN APPROVED";}else{?>
		<input type="hidden" name="id" id="id" value="<?=$data->id_cjc?>"/>

			<table border="0" width="600px">
				<tr>
					<td>Date</td>
					<td><input type="text" name="date" value="<?=gettgl()?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>SPK.No</td>
					<td><input type="text" name="no_spk" id="no_spk" value="<?=$view->no_spk?>" maxlength="20" readonly="true" style="width:220px"/></td>
				</tr>
				<tr>
					<td>Contract .No</td>
					<td><input type="text" name="no_contr" id="no_contr" value="<?=$view->no_kontrak?>"  readonly="true" maxlength="20" style="width:220px"/></td>
				</tr>						
				<tr>
					<td>Mainjob</td>
					<td><input type="text" name="job" value="<?=$view->job?>" style="width:400px" readonly="true"/></td>
				</tr>
				<tr>
					<td>Contract.Amount</td>
					<td><input type="text" name="date" style="width:180px" class="input" value="<?=number_format($view->contract_amount)?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Total Value Claim</td>
					<td><input type="text" name="date" style="width:180px" class="input" value="<?=number_format($sql->tot)?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Balance Value</td>
					<?$blc = $view->contract_amount - $sql->tot?>
					<td><input type="text" name="blc" style="width:180px" class="input" value="<?=number_format($blc)?>" readonly="true"/></td>
				</tr>
				
				<tr>
					<td>Proposed Value Claim</td>
					<td><input type="text" name="claim_amount" style="background-color:#FFFF80;" value="<?=number_format($data->claim_amount)?>" readonly="true"/></td>
				</tr>	
				<tr>
					<td>Remark CJC</td>
					<td><input type="text" name="remark" style="width:400px;background-color:#FFFF80;" value="<?=$data->remark?>" readonly="true"/></td>
				</tr>																																															
			</table>    
		<table  width='50%'>
		<tr>
				<td>
				<label><button type='submit' name='klik' value='1'>Approved</label>
				<label><button type='submit' name='batal' value='1'>Declined</label>
				</td>
			</tr>
		</table>

	<?}?>
<?=form_close()?>
