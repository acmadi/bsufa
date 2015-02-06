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
				if(response=="sukses"){
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
<h2><font color='red' size='2'>Input Alokasi per Project <hr width="150px" align="left"></font></h2>


<div id="x-input">
 <form action="<?=site_url('alokasiproj/save')?>" method="post" id="formAdd">
    <table>
		<tr>
			<td>Date</td>
			<td>:</td>
			<td><input type="text" name="date" value=<?=gettgl()?> style="width:90px" readonly="true"/></td>
		</tr>
		<tr>
			<td>Project</td>
			<td>:</td>
			<td>
				<select name="project" id="project" style="width:110px">
					<option value=""></option>
				<? foreach ($proj as $row){ ?>
					<option value=<?=@$row->subproject_id?>><?=@$row->nm_subproject ?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Alokasi</td>
			<td>:</td>
			<td><input type="text" name="alokasi" id="alokasi" style="width:50px" maxlength="5" class="calculate">%</td>
		</tr>
		<tr>
			<td colspan="3">Remark :</td>
		</tr>
		<tr>
			<td colspan="3">
			<textarea name="rem" id="rem" style="width:300px;height:50px"></textarea></td>
		</tr>
		<tr>
			<td colspan="3">
			<input type="submit" name="simpan" value="Save" id="submit">
			<input type="reset" name="batal" value="Reset"><span id="alert"></span></td>
		</tr>
		
    </table>
 </form>
   
</div>
