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
echo form_open(site_url('reclassbgt/savereclass'), $attr);
?>			


	<div id='setlabel'>	
		
		<fieldset>
		<input  type="hidden"  name='idreclass' id='idreclass' value='<?=$sql1->id_reclass?>' >
		<input  type="hidden"  name='idcostproj' id='idcostproj' value='<?=$sql1->id_costproj?>' >
		<input type="hidden"  name='kodebgtproj' id='kodebgtproj' value='<?=$sql1->kode_bgtproj?>' >
		<input  type="hidden"  name='nmbgtproj' id='nmbgtproj' value='<?=$sql1->nm_bgtproj?>' >
		<input  type="hidden"  name='nilaibgtproj' id='nilaibgtproj' value='<?=$sql1->nilai_bgtproj?>' >
		<input  type="hidden"  name='tglbgtproj' id='tglbgtproj' value='<?=$sql1->tgl_bgtproj?>' >
		<input  type="hidden"  name='inputdate' id='inputdate' value='<?=$sql1->input_date?>' >
		<input  type="hidden"  name='iddivisi' id='iddivisi' value='<?=$sql1->id_divisi?>' >
		<input  type="hidden"  name='idpt' id='idpt' value='<?=$sql1->id_pt?>' >	
		<input  type="hidden"  name='idsubproject' id='idsubproject' value='<?=$sql1->id_subproject?>' >	
		<input  type="hidden"  name='coano' id='coano' value='<?=$sql1->coa_no?>' >	
		<input  type="hidden"  name='adj' id='adj' value='<?=$sql1->adj?>' >
		<input  type="hidden"  name='remark' id='remark' value='<?=$sql1->remark?>' >		
		
		<input  type="hidden"  name='idcostproj2' id='idcostproj2' value='<?=$sql2->id_costproj?>' >
		<input type="hidden"  name='kodebgtproj2' id='kodebgtproj2' value='<?=$sql2->kode_bgtproj?>' >
		<input  type="hidden"  name='nmbgtproj2' id='nmbgtproj2' value='<?=$sql2->nm_bgtproj?>' >
		<input  type="hidden"  name='nilaibgtproj2' id='nilaibgtproj2' value='<?=$sql2->nilai_bgtproj?>' >
		<input  type="hidden"  name='tglbgtproj2' id='tglbgtproj2' value='<?=$sql2->tgl_bgtproj?>' >
		<input  type="hidden"  name='inputdate2' id='inputdate2' value='<?=$sql2->input_date?>' >
		<input  type="hidden"  name='iddivisi2' id='iddivisi2' value='<?=$sql2->id_divisi?>' >
		<input  type="hidden"  name='idpt2' id='idpt2' value='<?=$sql2->id_pt?>' >	
		<input  type="hidden"  name='idsubproject2' id='idsubproject2' value='<?=$sql2->id_subproject?>' >	
		<input  type="hidden"  name='coano2' id='coano2' value='<?=$sql2->coa_no?>' >	
		<input  type="hidden"  name='adj2' id='adj' value='<?=$sql2->adj?>' >
		<input  type="hidden"  name='remark2' id='remark2' value='<?=$sql2->remark?>' >		
		
		
		
		
		
		<label>Code.BGT :</label><input type="text" style='text-align:left;width:250px;' name='kode' id='kode' value='<?=$sql1->coa_no?>' >
		<label>Description :</label><input type="text" style='text-align:left;width:250px;' name='kode' id='kode' value='<?=$sql1->nm_bgtproj?>' >
	
		<label>RECLASS :</label><input type="text" name='totbgt' id='totbgt' style='background-color:#FFFFFF;font:bold;' value='<?=number_format($sql2->nilai_bgtproj)?>' >
		
		<label style='width:300px;'><b>TO</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		
      
 			
		
			
		<label>Code.BGT</label><input name='proj' id='proj' value='<?=$sql2->coa_no?>' style='text-align:left;background-color:#B7DBFF;'>
		<label>Description</label><input name='budget' id='budget' value='<?=$sql2->nm_bgtproj?>' style='text-align:left;width:250px;background-color:#B7DBFF;'>
		
		<label style='width:300px;'><button type="submit" name='klik' id='submit' value='1' > APPROVED</button> <button type="submit" name=batal value='1'id='reset'>DECLINED</buton></label>
		
  
</div>
</fieldset>


<?=form_close()?>
