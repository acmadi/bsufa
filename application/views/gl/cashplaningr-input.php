<?=link_tag(CSS_PATH.'menuformx.css')?>
<?//=script('jquery-1.4.2.min.js')?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<script type="text/javascript">
$(function(){
		$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();
});
</script>

<form method="post" action="<?=site_url('jurnaltransfer/simpan')?>">
	<table>
		<tr>
			<td>Acc No</td>
			<td>:</td>
			<td><input type="text" name="acc_no" class="xinput"/></td>
		</tr>	
		<tr>
			<td>Acc Name</td>
			<td>:</td>
			<td><input type="text" name="acc_name" class="xinput"/></td>
		</tr>	
		<tr>	
			<td>Currency</td>
			<td>:</td>
			<td>
				<select name="currency" class="xinput">
					<option></option>
					<?php foreach($currency as $row):?>
						<option value="<?=$row->currency_id?>">
							<?=$row->currency_cd?>
						</option>
					<?php endforeach?>	
				</select>
			</td>
		</tr>
		<tr>	
			<td>Spec</td>
			<td>:</td>
			<td>
				<select name="spec" class="xinput">
					<option></option>
					<?php foreach($spec as $row):?>
						<option value="<?=$row->spec_id?>">
							<?=$row->spec_name?>
						</option>
					<?php endforeach?>	
				</select>
			</td>
		</tr>
		<tr>	
			<td>Group</td>
			<td>:</td>
			<td>
				<select name="group" class="xinput">
					<option></option>
					<?php foreach($type as $row):?>
						<option value="<?=$row->type_id?>">
							<?=$row->type_name?>
						</option>
					<?php endforeach?>	
				</select>
			</td>
		</tr>
		<tr>	
			<td>Type</td>
			<td>:</td>
			<td><input type="text" name="type" class="xinput"/></td>
		</tr>
			<tr>	
			<td>Level</td>
			<td>:</td>
			<td><input type="text" name="level" class="xinput"/></td>
		</tr>
		</tr>
			<tr>	
			<td>Status</td>
			<td>:</td>
			<td><input type="text" name="status" class="xinput"/></td>
		</tr>
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Save"/></td>
		</tr>
	</table>
</form>
