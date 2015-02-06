<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open_multipart(uri_string())?>
<? showErrors() ?>
 <table>
  <tr>
	  <td><?=$labels->gallery_content_name?></td>
	  <td>:</td>
	  <td><?=createForm('input:40','gallery_content_name',@$data->gallery_content_name)?></td>
  </tr>
  <tr>
	  <td><?=$labels->gallery_content_index?></td>
	  <td>:</td>
	  <td><?=createForm('input:4','gallery_content_index',intval(@$data->gallery_content_index))?></td>
  </tr>
  <tr>
	  <td valign="top"><?=$labels->gallery_content_desc?></td>
	  <td valign="top">:</td>
	  <td><?=createForm('textarea:40:5','gallery_content_desc',@$data->gallery_content_desc)?></td>
  </tr>
  <tr>
	  <td>Image</td>
	  <td>:</td>
	  <td><?=form_upload('image')?>
		<? if(is_file($filePath.@$data->image)): ?>
			<small><?=$data->image?></small>
			<input type="hidden" name="old_image" value="<?=$data->image?>" />
		<? endif; ?> *</td>
  </tr>
  <tr>
	  <td colspan="2">&nbsp;</td>
	  <td id="markButton">
		<?=form_hidden('gallery_catagory_id',@$data?$data->gallery_catagory_id:$currentCatagory)?>
		<?=form_submit('submit','Submit')?>
		<?=buttonRedirect('Cancel',$module_url)?>
	  </td>
  </tr> 
 </table>
 <?=form_close()?>
<? $this->load->view(ADMIN_FOOTER) ?>
