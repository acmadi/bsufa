<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open(uri_string())?>
<? showErrors() ?>
 <table>
	<tr>
	  <td><?=$labels->name?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','name',@$data->name)?></td>
	</tr>
	 <tr>
	   <td><?=$labels->link_index?></td>
	   <td>:</td>
	   <td><?=createForm('input:4','link_index',intval(@$data->link_index))?></td>
	 </tr>
	 <tr>
	   <td><?=$labels->url?></td>
	   <td>:</td>
	   <td><?=createForm('input:45','url',@$data->url)?></td>
	 </tr>
	 <tr>
	   <td><?=$labels->status?></td>
	   <td>:</td>
	   <td><?=createForm('radio','status',array('on','off'),@$data?$data->status:'on')?></td>
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
