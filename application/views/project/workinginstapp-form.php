<?#=script('jquery-1.7.2.min.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('workinginstapp/save'), $attr);
?>
<div class="easyui-tabs" style="width:900px;height:450px;">
		<input type="hidden" name="id_kontrak" id="id_kontrak" value="<?=$data->id_kontrak?>"/>
		<div title="Working Instruction" style="padding:10px;">
			<table border="0" width="600px">
				<tr>
					<td>Date</td>
					<td><input type="text" name="date" value="<?=gettgl()?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>SPK.No</td>
					<td><input type="text" name="no_spk" id="no_spk" value="<?=$data->no_spk?>" maxlength="20" readonly="true" style="width:180px"/></td>
				</tr>
				<tr>
					<td>Contract.No</td>
					<td><input type="text" name="no_contr" id="no_contr" maxlength="20" style="width:180px"/></td>
				</tr>
				<tr>
					<td>Project.Nm</td>
					<td><input type="text" name="proj" value="<?=$data->nm_subproject?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Job</td>
					<td><input type="text" name="job" value="<?=$data->job?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Budget.Nm</td>
					<td><input type="text" name="date" value="<?=$data->nm_bgtproj?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Budget.Amount</td>
					<td><input type="text" name="date" value="<?=$data->nilai_proposed?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Start Date</td>
					<td><input type="text" name="date" value="<?=$data->start_date?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>End Date</td>
					<td><input type="text" name="date" value="<?=$data->end_date?>" readonly="true"/></td>
				</tr>												
			</table>    
		</div>	
		<div title="Payment" style="padding:10px;">
			<label for="name">Currency</label><input type="text" name=""/><br/>
			<label for="name">Contr. Amount</label><input type="text" name=""/><br/>
			<label for="name">PPN (10%)</label><input type="text" name=""/><br/>
			<label for="name">PPH</label><input type="text" name=""/><br/>
			<label for="name">Contr. Amount Before Tax</label><input type="text" name=""/><br/><br/>
			<label for="name">DP</label><input type="text" name=""/><br/>
			<label for="name">Progress</label><input type="text" name=""/><br/>
			<label for="name">Retension 5 %</label><input type="text" name=""/><br/>
			<input type="submit" value="Approval" /> <input type="submit" value="Unapprove" />					
		</div>  
		<div title="Contractor" style="padding:10px;">		
			<label for="name">Name</label><select name=""></select><br/>  
			<label for="name">Address</label><input type="text" name=""/><br/>  
			<label for="name">PIC</label><input type="text" name=""/><br/>  
			<label for="name">Phone</label><textarea name=""></textarea><br/>  
			<label for="name">Email</label><textarea name=""></textarea><br/>  
		</div>
		<div title="Signing" style="padding:10px;">		
			<h5>Pihak I</h5>
			<label for="name">Name</label><select name=""></select><br/>  
			<label for="name">Position</label><input type="text" name=""/><br/> 
			<h5>Pihak II</h5> 
			<label for="name">Name</label><select name=""></select><br/>  
			<label for="name">Position</label><input type="text" name=""/><br/> 			  
		</div>
</div>
<?=form_close()?>
