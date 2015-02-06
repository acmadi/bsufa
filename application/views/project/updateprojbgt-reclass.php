<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>







<script type="text/javascript">
	
	var kugiri = new RegExp(",", "g");
	
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
		
		var sisabgt = parseInt($('#sisa').val().replace(kugiri,""));
		var reclasstot = parseInt($('#reclassnil').val().replace(kugiri,""));
		
		if (reclasstot > sisabgt){
			alert("Melebihi Nilai Sisa RECLASS");
			$("[name=reclassnil]").val('');
		
		}
		
		
});
	
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
	$(function(){
		
		
		
		loadData('proj',0);
		
				$('#proj').change(function(){
					loadData('budget',$('#proj option:selected').val());
				});
				$('#budget').change(function(){
					
						var tot = $('#budget option:selected').val();
					
						$.post('<?=site_url('updateprojbgt/dropinput')?>/' + tot,
						function(data){
									$('#totalbgt').val(numToCurr(data.testi));
									$('#actgrandbgt').val(numToCurr(data.hasil));
									$('#grandsisa').val(numToCurr(data.balance));												
									$('#cosproj').val(data.cosproj);
									$('#kodeproj').val(data.kodeproj);
									$('#divisi').val(data.divisi);
									$('#pt').val(data.pt);
									$('#pro').val(data.pro);
									$('#coa').val(data.coa);
									$('#nmbgt').val(data.nmbgt);		
									
									//~ if(data.balance == 0){ alert('Budget ini tidak bisa diRECLASS'); 
									//~ $('#reclassnil').hide();
									//~ $('#submit').hide();
									//~ $('#reset').hide();}		
									//~ else{
									$('#reclassnil').show();
									$('#submit').show();
									$('#reset').show();
									//~ }
									
									},'json');
							
					
					
				});
		
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

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('updateprojbgt/savereclass'), $attr);
?>			


	<div id='setlabel'>	
		
	 <fieldset>
		
		<input type="hidden"  name='kodebgtproj' id='kodebgtproj' value='<?=$row->kode_bgtproj?>' >
		<input  type="hidden"  name='idcostproj' id='idcostproj' value='<?=$row->id_costproj?>' >
		<input  type="hidden"  name='nmbgtproj' id='nmbgtproj' value='<?=$row->nm_bgtproj?>' >
		<input  type="hidden"  name='iddivisi' id='iddivisi' value='<?=$row->id_divisi?>' >
		<input  type="hidden"  name='idpt' id='idpt' value='<?=$row->id_pt?>' >	
		<input  type="hidden"  name='idsubproject' id='idsubproject' value='<?=$row->id_subproject?>' >	
		<input  type="hidden"  name='coano' id='coano' value='<?=$row->coa_no?>' >	
		
		
		<label>Code.BGT :</label><input type="text" style='text-align:left;width:250px;' name='kode' id='kode' value='<?=$row->nm_bgtproj?>' >
	
		<label>Total.BGT :</label><input type="text" name='totbgt' id='totbgt' value='<?=number_format($row->totbgt)?>' >
		
		<label>Actual.BGT :</label><input type="text" name='actbgt' id='actbgt' value='<?=number_format($row->realisasi)?>' >
		<?$sisa = $row->totbgt - $row->realisasi;?>
		 <label>Balanced.BGT :</label><input type="text" name='sisa' value='<?=number_format($sisa)?>' id='sisa'>
		
		<?if($sisa == 0){?><script>alert('Budget ini sudah tidak bisa diRECLASS')</script>	 
		
		<?}else{?>
      
       
		
  
</div>

 <div id='setlabel2'>
		<fieldset>
		<input  type="hidden" name='cosproj' id='cosproj'  >
		<input  type="hidden" name='kodeproj' id='kodeproj'  >	
		<input  type="hidden" name='divisi' id='divisi'  >	
		<input  type="hidden" name='pt' id='pt'  >
		<input  type="hidden" name='nmbgt' id='nmbgt'  >		
		<input  type="hidden" name='pro' id='pro'  >	
		<input  type="hidden" name='coa' id='coa'  >		
			
			
			
		<label>PROJECT</label><select name='proj' id='proj'></select>
		<label>RECLASS BGT</label><select name='budget' id='budget'></select>
		<label>Total.BGT :</label><input  type="text" name='totalbgt' id='totalbgt'  >
		
		<label>Actual.BGT :</label><input type="text" name='actgrandbgt' id='actgrandbgt'  >
		
		 <label>Balanced.BGT :</label><input type="text" name='grandsisa' id='grandsisa'>
		 <label>Total Reclass :</label><input type="text" name='reclassnil' class="calculate validate[required]" id='reclassnil'style='background-color: #FFFFFF;' >
		<button type="submit" id='submit' > SAVE</button> <button type="reset" id='reset'>CANCEL</buton>
		
		</fieldset>
	</div>
<?}?>
<?=form_close()?>
