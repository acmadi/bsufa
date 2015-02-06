<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open(uri_string())?>
<? showErrors() ?>
 <table>
	<tr>
	  <td><?=$labels->project_name?></td>
	  <td>:</td>
	  <td><?=createForm('input:25','kejuaraan_name',@$data->kejuaraan_name)?></td>
	</tr>
	<tr valign="top">
	  <td><?=$labels->kejuaraan_desc?></td>
	  <td>:</td>
	  <td><?=createForm('htmleditor:700:400','kejuaraan_desc',@$data->kejuaraan_desc)?></td>
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
