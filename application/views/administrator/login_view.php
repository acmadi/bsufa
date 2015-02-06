<? $this->load->view(ADMIN_HEADER) ?>
<?=form_open(uri_string())?>
<? showErrors();?>
<table>
	<tr>
		<td>Username</td>
		<td>:</td>
		<td><?=form_input('username')?></td>
	</tr>
	<tr>
		<td>Password</td>
		<td>:</td>
		<td><?=form_password('password')?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td id="markButton">
			<?=form_submit('login','Login!')?>
			<?=form_reset('','Cancel');	?>
		</td>
	</tr>
</table>
<?=form_close()?>
<? $this->load->view(ADMIN_FOOTER) ?>
