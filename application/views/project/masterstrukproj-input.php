<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<script type="text/javascript">
$(function(){
	$('#project_id').change(function(){
		//alert("test");
		$.getJSON('<?=site_url('masterstrukproj/cekdata')?>/'+$(this).val(),
			function(response){
				$('#bgttot').val(numToCurr(response.tot_bgtproj));
				$('#land').val(numToCurr(response.land_bgtproj));
				$('#sgfa').val(numToCurr(response.sgfa));
				$('#gba').val(numToCurr(response.gba));
			})
	});


	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	}).numeric();
	
	
	$('#formAdd')
	.validationEngine()
	.ajaxForm({
		success:function(response){
			if(response=='sukses'){
				alert(response);
				refreshTable();
			}else{
				alert(response);
			}
		}
	});	
	

		
	
});	
</script>



<h2>Master Struktur Project</h2>
<div id="x-input">
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('masterstrukproj/save'), $attr);
?>
    <fieldset>
       <label for="name">Project Name</label>
			<select name="project_id" id="project_id">
					<option value="" selected></option>
				<?php foreach($project as $row): ?>
					<option value="<?=$row->subproject_id ?>"><?=$row->nm_subproject?></option>
				<?php endforeach ?>
			</select>
		<br/>  
	   <label for="total budget">Total Budget</label><input type="text" name="bgttot" id="bgttot" readonly="true" style="width:120px" placeholder="" class="input"/><br/>
	   <label for="start">Land Effective</label><input type="text" name="land" id="land" readonly="true" placeholder="" class="input" style="width:80px"/>m2<br/>
	   <label for="start">SGFA</label><input type="text" name="sgfa" id="sgfa" readonly="true" placeholder="" style="width:80px" class="input"/>m2<br/>
	   <label for="start">GBA</label><input type="text" name="gba" id="gba"  placeholder="" class="input" style="width:80px"/>m2<br/>
	   <label for="start">Structure Cost</label>
			<select name="cost" id="cost">
					<option value="" selected></option>
				<?php foreach($costproj as $row): ?>
					<option value="<?=$row->id_scostproj?>"><?=$row->nm_scost?></option>
				<?php endforeach ?>			
			</select>
		<br/>
	   <label for="start">Budget Cost</label><input type="text" name="bgtcost" class="validate[required] calculate input" id="bgtcost"  style="width:120px" placeholder=""/><br/>	   
       <input type="submit" value="Save" name="save"/> <input type="reset" value="Cancel" name="reset"/>
    </fieldset>
<?=form_close()?>
</div>
