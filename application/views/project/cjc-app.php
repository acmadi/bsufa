
<?#=link_tag(CSS_PATH.'icon.css')?>
<?#=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>

<?=script('currency.js')?>	


<?=link_tag(CSS_PATH.'x-forminput.css')?>

<script type="text/javascript">
$(function(){
	var rep_coma = new RegExp(",", "g");
	
							
});


		
</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('cjc/saveapp'), $attr);
#$blc_dp = $prop->blc_dp - $data->balanced_dp;
#$id = $data->id_cjc;

#$ppn = $data->ppn_amount;
#$pph = $data->pph_amount;
#$blcdp	= ($data->dp_amount) - (@$data->balanced_dp);
#$nett = ($data->proposed_amount) - $ppn - $pph;
?>

		
	<div title="Certified Job To Complish" style="padding:10px;">
			<input type='hidden' name='id' value='<?=$data->id_cjc;?>'>
		<label for="name">Date</label><input type="text" name="tgl" style='width:100px;background-color:#FFFFA6'value="<?=indo_date($data->date_cjc)?>" readonly="true"/><br/>
		<label for="name">No</label><input type="text" name="nokontrak" style='width:300px;background-color:#FFFFA6' id="nokontrak" value="<?=$data->no_cjc?>" readonly="true"/><br/> 		 
		<label for="name">Value Claim</label><input type="text" name="claim" id="claim" style='width:150px;background-color:#FFA8A8;text-align:right' value="<?=number_format($data->claim_amount)?>" readonly="true"/><br/> 		 
		<label for="name">Description</label><input type="text" name="keterangan" style='width:350px;background-color:#FFFFA6' id="keterangan" class="input" value="<?=$data->remark?>" readonly="true"/><br/> 
		<label for="name">JOB</label><input type="text" name="job" style='width:400px;background-color:#FFFFA6' id="job" class="input" value="<?=$data->job?>" readonly="true"/><br/> 		 		 
		
	</div>
	
<label style='width:300px;'><button type="submit" name='klik' id='submit' value='1' > Approved</button> <button type="submit" name=batal value='1'id='reset'>Unaproved</buton></label>
<?=form_close()?>
