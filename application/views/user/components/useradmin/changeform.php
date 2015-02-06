<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open(uri_string())?>
<? showErrors() ?>
	<table>			 
	 <tr>
	  <td>Old Password</td>
	  <td>:</td>
	  <td><?=createForm('password:45','passold','')?> *</td>
	 </tr>				 
	 <tr>
	  <td>New Password</td>
	  <td>:</td>
	  <td><?=createForm('password:45','password','')?> *</td>
	 </tr>			 
	 <tr>
	  <td>Re-enter Password</td>
	  <td>:</td>
	  <td><?=createForm('password:45','passconf','')?> *</td>
	 </tr>	 
	 <tr>
	  <td colspan="2">&nbsp;</td>
	  <td id="markButton">
		<?=form_submit('submit','Submit')?>
	  </td>
	 </tr>
	</table>
<?=form_close()?>
<? $this->load->view(ADMIN_FOOTER) ?>
