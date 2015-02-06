<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open_multipart(uri_string())?>
<? showErrors() ?>
	<table>
	 <tr>
	  <td><?=$labels->title?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','title',@$data->title)?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->profile_index?></td>
	  <td>:</td>
	  <td><?=createForm('input:4','profile_index',intval(@$data->profile_index))?> *</td>
	 </tr>	 
	 <tr valign="top">
	  <td><?=$labels->content?></td>
	  <td>:</td>
	  <td><?=createForm('htmleditor:700:450','content',@$data->content)?> *</td>
	 </tr>
	 <tr>
	  <td>Image Slideshow:</td>
	  <td>:</td>
	  <td><?=form_upload('profile_image')?>
			<? if(is_file($filePath.@$data->profile_image)): ?>
				<small><?=$data->profile_image?></small>
				<input type="hidden" name="old_profile_image" value="<?=$data->profile_image?>" />
			<? endif; ?></td>
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
