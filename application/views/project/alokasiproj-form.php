<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>
<?=script('currency.js')?>
<?=script('jquery.numeric.js')?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>

<script language="javascript">
	$(function(){
	
	
	
	
		$('#formAdd')
		//.validationEngine()
		.ajaxForm({
			success:function(response){
				//alert(response);
				if(response=="Update Data Sukses"){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
				//
				//refreshTable();
				//$('#buttonID').click();
			}
		});		
		
		$('.calculate').bind('keyup keypress',function(){
		$(this).val();
	 }).numeric();		
});
	
</script>
<h2><font color='red' size='2'>Alokasi per Project <hr width="150px" align="left"></font></h2>


<div id="x-input">
 <form action="<?=site_url('alokasiproj/ubah_alokasi')?>" method="post" id="formAdd">
    <table>
		<input type="hidden" name="idup" id="idup" value=<?=$isi->id_alokasiproj?>>
		<tr>
			<td>Date</td>
			<td>:</td>
			<td><input type="text" name="date" value=<?=indo_date($isi->tgl_input)?> style="width:90px" readonly="true"/></td>
		</tr>
		<tr>
			<td>Project</td>
			<td>:</td>
			<td>
				
				
				
				<select name="project" id="project" class="xinput">
				<? if($proj): ?>
				<? foreach($proj as $row): ?>
					<option value="<?=$row->subproject_id?>" <? if($row->subproject_id == @$isi->project_id) echo 'selected';?>> <?=$row->nm_subproject?> </option>
				<? endforeach;?>
				<? endif;?>
		</select>
		</select>
				
				
			</td>
		</tr>
		<tr>
			<td>Alokasi</td>
			<td>:</td>
			<td><input type="text" name="alokasi" id="alokasi" style="width:50px" maxlength="5" class="calculate" value=<?=$isi->alokasi?>>%</td>
		</tr>
		<tr>
			<td>Remark</td>
			<td>:</td>
			<td><textarea name="rem" id="rem" style="width:300px;height:50px" ><?=$isi->remark?></textarea></td>
		</tr>
		<tr>
			<td colspan="3">
			<input type="submit" name="simpan" value="Update" id="submit">
			</span></td>
		</tr>
		
    </table>
 </form>
   
</div>




