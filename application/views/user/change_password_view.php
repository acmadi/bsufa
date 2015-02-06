<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.6.minx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	$(function(){
		$('#formAdd')
		.validationEngine()
		.ajaxForm({
			success:function(response){
			alert(response);
			$('#btnReset').click();
		}
		});	
	});
</script>
<form method="post" action="<?=site_url()?>user/change_password/ubah_password" id="formAdd">
<table border="0">
	<input type="hidden" name="id_user" value="<?=$session['id']?>"/>
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><input type="text" name="username" id="username" value="<?=$session['username']?>" class="validate[required]" readonly="true"/></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><input type="password" name="password1" id="password1" value="" class="validate[required]" maxlength="12"/></td>
	</tr>
	<tr>
		<td>Repeat password</td>
		<td>:</td>
		<td><input type="password" name="password2" id="password2" value="" class="validate[required,equals[password1]]" maxlength="12"/></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Simpan" id="clickbutton"/><input type="reset" value="Batal"/> </td>
	</tr>
</table>
</form>
<?$this->load->view(ADMIN_FOOTER)?>
