<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open(uri_string())?>
<? showErrors() ?>
	<table>
	 <tr>
	  <td><?=$labels->group_id?></td>
	  <td>:</td>
	  <td><?=createForm('dropdown:45','group_id',$UserGroup,@$data?$data->group_id:$usermenuSelected)?> *</td>
	 </tr>			 
	 <tr>
	  <td><?=$labels->username?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','username',@$data->username)?> *</td>
	 </tr>			 
	 <tr>
	  <td><?=$labels->password?></td>
	  <td>:</td>
	  <td><?=createForm('password:45','password','')?> *</td>
	 </tr>			 
	 <tr>
	  <td><?=$labels->passconf?></td>
	  <td>:</td>
	  <td><?=createForm('password:45','passconf','')?> *</td>
	 </tr>			 
	 <tr>
	  <td><?=$labels->status?></td>
	  <td>:</td>
	  <td><?=createForm('radio','status',array('on','off'),@$data?$data->status:'off')?> *</td>
	 </tr>	 
	 <tr>
	  <td colspan="2">&nbsp;</td>
	  <td id="markButton">
		<?=form_submit('submit','Submit')?>
		<?=buttonRedirect('Cancel',$module_url)?>
	  </td>
	 </tr>
	</table>
<?=form_close()?>
<? $this->load->view(ADMIN_FOOTER) ?>
