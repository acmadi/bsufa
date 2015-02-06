<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('currency.js')?>
<?=script('jquery.validationEngine-enx.js')?>
<?=script('jquery.validationEnginex.js')?>
<?=script('jquery.formx.js')?>







<script type="text/javascript">
	
	var kugiri = new RegExp(",", "g");
	

		
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
	   

	
	
	
	

</script>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('addbgt/saveaddbgt'), $attr);
?>			


	<div id='setlabel'>	
		
		<fieldset>
		<input  type="hidden"  name='idaddbgt' id='idaddbgt' value='<?=$sql->id_bgtproj_update_add?>' >
		<input  type="hidden"  name='idcostproj2' id='idcostproj2' value='<?=$sql->id_costproj?>' >
		<input type="hidden"  name='kodebgtproj2' id='kodebgtproj2' value='<?=$sql->kode_bgtproj?>' >
		<input  type="hidden"  name='nmbgtproj2' id='nmbgtproj2' value='<?=$sql->nm_bgtproj?>' >
		<input  type="hidden"  name='nilaibgtproj2' id='nilaibgtproj2' value='<?=$sql->nilai_bgtproj?>' >
		<input  type="hidden"  name='tglbgtproj2' id='tglbgtproj2' value='<?=$sql->tgl_bgtproj?>' >
		<input  type="hidden"  name='inputdate2' id='inputdate2' value='<?=$sql->input_date?>' >
		<input  type="hidden"  name='iddivisi2' id='iddivisi2' value='<?=$sql->id_divisi?>' >
		<input  type="hidden"  name='idpt2' id='idpt2' value='<?=$sql->id_pt?>' >	
		<input  type="hidden"  name='idsubproject2' id='idsubproject2' value='<?=$sql->id_subproject?>' >	
		<input  type="hidden"  name='coano2' id='coano2' value='<?=$sql->coa_no?>' >	
		<input  type="hidden"  name='adj2' id='adj' value='<?=$sql->adj?>' >
		<input  type="hidden"  name='remark2' id='remark2' value='<?=$sql->remark?>' >		
		
		
		
		
		
		<label>Description :</label><input type="text" style='text-align:left;width:250px;' name='kode' id='kode' value='<?=$sql->remark?>' >
		<label>Amount :</label><input type="text" style='text-align:right;width:100px;' name='kode' id='kode' value='<?=number_format($sql->nilai_bgtproj)?>' >
		<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
		
		<label>Account :</label><input type="text" name='totbgt' id='totbgt' value='<?=$sql->coa_no?>' style='text-align:left;' >
		
				
		<label>Code.BGT</label><input name='proj' id='proj' value='<?=$sql->kode_bgtproj?>' style='text-align:left;'>
		<label>Project</label><input name='budget' id='budget' value='<?=$sql->nm_subproject?>' style='text-align:left;'>
		
		<label style='width:300px;'><button type="submit" name='klik' id='submit' value='1' > Approved</button> <button type="submit" name=batal value='1'id='reset'>Declined</buton></label>
		
  
</div>
</fieldset>


<?=form_close()?>
