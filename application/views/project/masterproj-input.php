<?=script('currency.js')?>
<?=script('calendar.js')?>
<?=script('calendar2.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?=script('xcek.js')?>
<?=link_tag(CSS_PATH.'calendar.css')?>
<?=link_tag(CSS_PATH.'x-forminput.css')?>
<script type="text/javascript">
$(function(){
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
	
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	}).numeric();		
	
});	
</script>
<h2>Master Project</h2>

<div id="x-input">
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('masterproj/save'), $attr);
?>
    <fieldset>
       <label for="name">Project Name</label>
			<input name="project_id" type="text" style="width:150px">
				<br/>  
	   <label for="Address">Address</label><textarea name="address" id="address" class="validate[required]"></textarea><br/>
	   <label for="start">Start Date</label><input type="text" name="start_date" id="start_date" class="validate[required]" style="width:120px" readonly="true" placeholder=""/>
			<a href="JavaScript:;" onClick="return showCalendar('start_date', 'dd-mm-y');" title="Pilih Tanggal" > 
				<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/>
			</a>
	   	<br/>
	   <label for="start">End Date</label><input type="text" name="end_date" id="end_date" class="validate[required]" readonly="true" style="width:120px" placeholder=""/>
			<a href="JavaScript:;" onClick="return showCalendar('end_date', 'dd-mm-y');" title="Pilih Tanggal" > 
				<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/>
			</a>			
	   <br/>
	   <label for="start">Total Budget</label><input type="text" name="totbgt"  class="calculate input validate[required]" id="totbgt" maxlength="50" style="width:150px" placeholder=""/><br/>
	   <label for="start">Land Area</label><input type="text" id="land" name="land" class="calculate input validate[required]" maxlength="10" placeholder="" style="width:80px"/>m2<br/>
	   <label for="start">SGFA</label><input type="text" name="sgfa" id="sgfa" class="calculate input validate[required]" maxlength="10" placeholder="" style="width:80px"/>m2<br/>
	   <label for="start">GBA</label><input type="text" name="gba" id="gba" class="calculate input validate[required]" maxlength="10" placeholder="" style="width:80px"/>m2<br/>
	   <label for="start">Remarks</label><textarea name="remarks" id="remarks" class="validate[required]"></textarea><br/>
       <input type="submit" value="Save" name="save"/> <input type="reset" name="reset" value="Cancel" />
    </fieldset>
<?=form_close()?>
   
</div>
