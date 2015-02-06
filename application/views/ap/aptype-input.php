<?=link_tag(CSS_PATH.'menuformx.css')?>
<?//=script('jquery-1.4.2.min.js')?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />

<script type="text/javascript">
$(function(){
		$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();
});
</script>

<form method="post" action="<?=site_url('aptype/simpan')?>">
	<table>
		<tr>
			<td>AP Type</td>
			<td>:</td>
			<td><input type="text" name="aptype_cd" class="xinput"/></td>
		</tr>	
		<tr>
			<td>Description</td>
			<td>:</td>
			<td><input type="text" name="descs" class="xinput"/></td>
		</tr>		
		<tr>
			<td><input type="submit" name="save" value="Save"/></td>
			<td><input type="reset"   name="cancel" value="Cancel"/></td>
		</tr>
	</table>
</form>
