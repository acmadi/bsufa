<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?=script('jquery.numeric.js')?>


<script type="text/javascript">
	//FUNGSI LOAD DATA
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('mastercontr/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append($('<option></option>').val('').text(''));
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }


  $(function(){  
	   
	  loadData('negara',0);
	   $('#negara').change(function(){
		   //alert($('#negara option:selected').val());
		   loadData('propinsi',$('#negara option:selected').val());
	   });
	
	   $('#propinsi').change(function(){
		   loadData('kota',$('#propinsi option:selected').val());
	   });	
	   
	   
		$('.intcalculate').bind('keyup keypress',function(){
			$(this).val($(this).val());
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


<h2>Master Contractor</h2>
<div id="x-input">
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('mastercontr/save'), $attr);
?>
    <fieldset>
	   <div class="x1">
			<label>Contractor Type</label>
				<option></option>
				<select name="contrtype" id="contrtype">
					<?php foreach($contrtype as $row): ?>
						<option value="<?=$row->mstcontrtype_id?>"><?=$row->mstcontrtype_nm?></option>
					<?php endforeach; ?>
				</select>
			<label>Contractor Name</label><input type="text" name="contrnm" id="contrnm"/>
			<label>Category</label>
				<option></option>
				<select name="contrcat" id="contrcat">
					<?php foreach($contrcat as $row): ?>
						<option value="<?=$row->mstcontrcat_id?>"><?=$row->mstcontrcat_nm?></option>
					<?php endforeach; ?>
				</select>			
			<label>Address</label><textarea name="address" id="address"/>
			<label>Country</label><select name="negara" id="negara"></select>
			<label>Province</label><select name="propinsi" id="propinsi"></select>
			<label>City</label><select name="kota" id="kota"></select>
			<label>Handphone</label><input type="text" name="hp" id="hp" class="intcalculate"/>
			<label>Telephone</label><input type="text" name="tlp" id="tlp" class="intcalculate"/>
			<input type="submit" value="Save" name="save"/> <input type="reset" value="Cancel" name="reset"/>
       </div>
       <div class="x1">
			<label>NPWP</label><input type="text" name="npwp" id="npwp"/>
			<label>Akta</label><input type="text" name="akta" id="akta"/>
			<label>Contact Name</label><input type="text" name="contact" id="contact"/>
			<label>Fax</label><input type="text" name="fax" id="fax"/>
			<label>Email</label><input type="text" name="email" id="email" class="validate[required,custom[email]]"/>
			<label>Web</label><input type="text" name="web" id="web" class=""/>
			
       </div><br/>
    </fieldset>
<?=form_close()?>
</div>
