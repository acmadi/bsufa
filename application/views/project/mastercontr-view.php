<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>
<?=script('jquery.numeric.js')?>

<? #var_dump($view_dt) ?>
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
			<label>Contractor Type</label><input type="text" name="contrnm" value="<?=$view_dt->mstcontrtype_nm?>" id="contrnm" readonly/>
			<label>Contractor Name</label><input type="text" name="contrnm" id="contrnm" value="<?=$view_dt->vendor_nm?>" readonly/>
			<label>Category</label><input type="text" name="contrnm" id="contrnm" value="<?=$view_dt->mstcontrcat_nm?>"/>		
			<label>Address</label><input type="text" name="contrnm" id="contrnm"/>
			<label>Country</label><input type="text" name="contrnm" id="contrnm"/>
			<label>Province</label><input type="text" name="contrnm" id="contrnm"/>
			<label>City</label><input type="text" name="contrnm" id="contrnm"/>
			<label>Handphone</label><input type="text" name="hp" id="hp"/>
			<label>Telephone</label><input type="text" name="tlp" id="tlp"/>
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
