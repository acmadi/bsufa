<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('jquery.numeric.js')?>
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>

<script type="text/javascript">
	
	
	$.validationEngineLanguage.allRules['ajaxValidateNip'] = {
		"url": "<?=site_url('updateprojbgt/cekacc')?>",
	    "alertText": "*Account ini sudah ada",
	    "alertTextOk": "Account Available",
	    "alertTextLoad": "* Validating, please wait"
	};
	
	$.validationEngineLanguage.allRules['ajaxValidateCode'] = {
		"url": "<?=site_url('updateprojbgt/cekcode')?>",
	    "alertText": "*Account ini sudah ada",
	    "alertTextOk": "Account Available",
	    "alertTextLoad": "* Validating, please wait"
	};
	
	
	
	
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('updateprojbgt/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#combobox_customer').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
 
 
 $(document).ready(function(){
	 $('.calculate').bind('keyup keypress',function(){
				$(this).val(numToCurr($(this).val()));
			});
	 $('#project_id1').hide();
	 $('#proj').hide();
	 
	 $('#cost1').hide();
	 $('#cost2').hide();
	 
	 $('#code1').hide();
	 $('#code').hide();
	 
	 $('#coa1').hide();
	 $('#coa_no').hide();
	 
	 $('#cost').hide();
	 $('#cost3').hide();
	 
	 $('#scost1').hide();
	 $('#scost').hide();
	 
	 $('#sub1').hide();
	 $('#sub2').hide();
	 
	 $('#bgtcode1').hide();
	 $('#bgtcode2').hide();
	 
	 $('#bgtnmm1').hide();
	 $('#bgtnmm2').hide();
	 
	 //~ $('#cost1').show();
	 //~ $('#cost2').show();
	 //~ 
	 
	 $('#total1').hide();
	 $('#total2').hide();
	 
	 $('#submit').hide();
	 $('#reset').hide();
	 
	 $('#idcostproj').hide();
     $('#kodebgtproj').hide();
     $('#nmbgtproj').hide();
     $('#iddivisi').hide();
     $('#idpt').hide();
     $('#idsubproject').hide();
     $('#coano').hide();
	 
	 
	 
 })
 
 $('#tipe').change(function(){
	 if($('#tipe').val() == 1){
	 
	 $('#project_id1').show();
	 $('#proj').show();
	 
	 $('#scost1').show();
	 $('#scost').show();
	 
	 
	 
	 $('#coa1').show();
	 $('#coa_no').show();
	 	 
	 
	 $('#sub1').hide();
	 $('#sub2').hide();
	 
	 $('#code1').show();
	 $('#code').show();
	 
	 $('#cost1').show();
	 $('#cost2').show();
	 
	 
	 $('#total1').show();
	 $('#total2').show();
	 
	 $('#submit').show();
	 $('#reset').show();
	 
	 $('#idcostproj').hide();
     $('#kodebgtproj').hide();
     $('#nmbgtproj').hide();
     $('#iddivisi').hide();
     $('#idpt').hide();
     $('#idsubproject').hide();
     $('#coano').hide();
	
	loadData('proj',0);
	loadData('scost',0);
	//~ $('#proj').change(function(){
		//~ loadData('cost3',$('#proj option:selected').val());
	//~ })
	
	//~ $('#scost').change(function(){
		//~ loadData('cost2',$('#scost option:selected').val());
	//~ })
	 
	 
	 
	
	
	 }
	 else if($('#tipe').val() == 2){
		 
	$('#project_id1').show();
	 $('#proj').show();
	 
	 
	 $('#cost1').hide();
	 $('#cost2').hide();
	 
	 $('#scost1').hide();
	 $('#scost').hide();
	 
	 $('#cost').show();
	 $('#cost3').show();
	 
	 $('#code1').hide();
	 $('#code').hide();
	 
	 $('#coa1').hide();
	 $('#coa_no').hide();
	 
	 $('#idcostproj').hide();
     $('#kodebgtproj').hide();
     $('#nmbgtproj').hide();
     $('#iddivisi').hide();
     $('#idpt').hide();
     $('#idsubproject').hide();
     $('#coano').hide();
						
							
	 
	 
	 
	 
	 
	 $('#total1').show();
	 $('#total2').show();
	 
	 $('#submit').show();
	 $('#reset').show();
	
			loadData('proj',0);
			$('#proj').change(function(){
				loadData('cost3',$('#proj option:selected').val());
			})
			
			$('#cost3').change(function(){
				
				var id = $('#cost3 option:selected').val();
				
				//~ alert (id);
				
						$.post('<?=site_url('updateprojbgt/getdata')?>/' + id,
						function(data){
							$('#idcostproj').val(data.idcostproj);
							$('#kodebgtproj').val(data.kodebgtproj);
							$('#nmbgtproj').val(data.nmbgtproj);
							$('#iddivisi').val(data.iddivisi);
							$('#idpt').val(data.idpt);
							$('#idsubproject').val(data.idsubproject);
							$('#coano').val(data.coano);
							
					
						},'json');
				
			})
			
			
			
	 }
	 else{
		 
		$('#project_id1').hide();
	 $('#proj').hide();
	 
	 $('#cost1').hide();
	 $('#cost2').hide();
	 
	 $('#code1').hide();
	 $('#code').hide();
	 
	 $('#coa1').hide();
	 $('#coa_no').hide();
	 
	 
	 $('#scost1').hide();
	 $('#scost').hide();
	 
	 $('#sub1').hide();
	 $('#sub2').hide();
	 
	 $('#bgtcode1').hide();
	 $('#bgtcode2').hide();
	 
	 $('#bgtnmm1').hide();
	 $('#bgtnmm2').hide();
	 
	 $('#total1').hide();
	 $('#total2').hide();
	 
	 $('#submit').hide();
	 $('#reset').hide();
	 
	 $('#idcostproj').hide();
     $('#kodebgtproj').hide();
     $('#nmbgtproj').hide();
     $('#iddivisi').hide();
     $('#idpt').hide();
     $('#idsubproject').hide();
     $('#coano').hide();
	 
	 
	 }
	 
	 
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
	 
						
	 
 })
 
   
   
   
</script>
<div id="x-input">
<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('updateprojbgt/save'), $attr);
?>
    <fieldset>
     	
      <input name='idcostproj' id='idcostproj'>
      <input name='kodebgtproj' id='kodebgtproj'>
      <input name='nmbgtproj' id='nmbgtproj'>
      <input name='iddivisi' id='iddivisi'>
      <input name='idpt' id='idpt'>
      <input name='idsubproject' id='idsubproject'>
      <input name='coano' id='coano'>
      
      
      
       <label for="name">Budget Type</label>
			<select name="tipe" id="tipe" style='width:100px;'>
				<option>&nbsp;</option>
				<option value='1'>New</option>
				<option value='2'>Existing</option>
			</select><br/>
       
       <label id='project_id1'>Project Name</label>
			<select name="proj" id="proj" ></select><br> 
			        
	   <label id='scost1'>Structure Cost</label>
			<select name="scost" id="scost"></select><br/>		
		
	   <label id='coa1'>Account</label>
			<input typw='text' name="coa_no" id="coa_no" class="input validate[required,ajax[ajaxValidateNip]"><br/>		
	   
	   <label id='code1'>Kode</label>
			<input typw='text' name="code" id="code" class="input validate[required,ajax[ajaxValidateCode]"><br/>		
		
	   <label id='cost'>Budget Name</label>
			<select name="cost3" id="cost3"></select><br/>		
		
	   
	   <label id='cost1'>Budget Name</label>
			<input name="cost2" id="cost2"><br/>		
			
	   	   
	   <label id="total1">Amount</label>
			<input type="text" name="total2" id="total2" class="calculate input"  required='required' placeholder="" style='text-align:right;'/><br/>
		
		<input type="submit" id='submit'value="Save" /> <input type="reset" id='reset' value="Reset" />
    
    </fieldset>
<?=form_close()?>
   
</div>
