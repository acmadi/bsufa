<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css" />
<form method="post" action="">
<table border="0" cellpadding="2" cellspacing="2">
    <!--Personal Data-->
    <tr>
		<td colspan="3" style="border-bottom:solid"><b>Customer Profile</b></td>
    </tr>
    <tr>
		<td>Project</td>
		<td>:</td>
		<td>
			
			<select name="id_project" class="xinput">
				<?php foreach($project as $row): ?>
				<option value="<?=$row->kd_project?>"><?=$row->nm_project?></option>
				<?php endforeach; ?>
			</select>
		</td>	
    </tr>
   <tr>
		<td>Customer</td>
		<td>:</td>
		<td>
			<select name="customer" class="xinput">
				<?php foreach($customer as $row): ?>
				<option value="<?=$row->customer_id?>"><?=$row->customer_nama?></option>
				<?php endforeach; ?>
			</select>
		</td>	
    </tr>
   <tr>
		<td>Unit</td>
		<td>:</td>
		<td>
			<select name="id_unit" class="xinput">
				<?php foreach($unit as $row): ?>
				<option value=""><?=$row->unit_no?></option>
				<?php endforeach; ?>
			</select>
		</td>	
    </tr>
   <tr>
		<td>Price</td>
		<td>:</td>
		<td><input type="text" name="" id="" value=""/></td>	
    </tr>
	<!-- End-->	
	<tr>
		<td style="padding:20 0 0 0"><input type="submit" name="save" value="Save"/></td>
		<td style="padding:20 0 0 0"><input type="reset" name="cancel" value="Cancel"/></td>
	</tr>
</table>
</form>
