<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open_multipart(uri_string())?>
<? showErrors() ?>
	<table>
	 <tr>
	  <td><?=$labels->catagory_name?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','catagory_name',@$data->catagory_name)?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->parent_catagory_id?></td>
	  <td>:</td>
	  <td>
	  <?
		echo '<select name="parent_catagory_id">';
		echo '<option value="">* top catagory</option>';
		echo loadCatagory($catagoryList,0,0,@$data->parent_catagory_id);
		echo '</select>';					  
	  ?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->catagory_index?></td>
	  <td>:</td>
	  <td><?=createForm('input:4','catagory_index',@$data->catagory_index)?> *</td>
	 </tr>		 
	 <tr>
	  <td><?=$labels->allow_comment?></td>
	  <td>:</td>
	  <td><?=createForm('radio','allow_comment',array('yes','no'),@$data?$data->allow_comment:'yes')?> *</td>
	 </tr>		
	 <tr>
	  <td>Catagory image:</td>
	  <td>:</td>
	  <td><?=form_upload('catagory_image')?>
			<? if(is_file($filePath.@$data->catagory_image)): ?>
				<small><?=$data->catagory_image?></small>
				<input type="hidden" name="old_catagory_image" value="<?=$data->catagory_image?>" />
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
