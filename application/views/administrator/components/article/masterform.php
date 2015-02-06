<? $this->load->view(ADMIN_HEADER); ?>
<?//=form_open(uri_string())?>
<?=form_open_multipart(uri_string())?>
<? showErrors() ?>
	<table>
	 <tr>
	  <td><?=$labels->article_title?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','article_title',@$data->article_title)?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->catagory_article_id?></td>
	  <td>:</td>
	  <td>
	  <?
		echo '<select name="catagory_article_id">';
		echo loadCatagory($catagoryList,0,0,@$data?$data->catagory_article_id:$currentCatagory,'id_catagory','catagory_name');
		echo '</select>';					  
	  ?> *</td>
	 </tr>
     <tr>
	  <td>Highlight Image</td>
	  <td>:</td>
	  <td><?=form_upload('highlight_image')?>
		<? if(is_file($filePath.@$data->highlight_image)): ?>
			<small><?=$data->highlight_image?></small>
			<input type="hidden" name="old_highlight_image" value="<?=$data->highlight_image?>" />
		<? endif; ?>
	  </td>
	 </tr>	
	 <tr valign="top">
	  <td><?=$labels->article_content?></td>
	  <td>:</td>
	  <td><?=createForm('htmleditor:700:450','article_content',@$data->article_content)?> *</td>
	 </tr>
     <tr valign="top">
	  <td>Article URL</td>
	  <td>:</td>
	  <td><?=createForm('input:50','article_url',@$data->article_url)?>
		<br /><small>)* isi dengan extension .html (bila dikosongkan sistem akan generate otomatis sesuai judul artikel)</small>
	  </td>
	 </tr>	
     <tr>
	  <td><?=$labels->meta_keys?></td>
	  <td>:</td>
	  <td><?=createForm('input:100','meta_keys',@$data->meta_keys)?>
	  </td>
	 </tr>	
     <tr>
	  <td><?=$labels->meta_desc?></td>
	  <td>:</td>
	  <td><?=createForm('input:100','meta_desc',@$data->meta_desc)?>
	  </td>
	 </tr>			 
	 <tr>
	  <td><?=$labels->status?></td>
	  <td>:</td>
	  <td><?=createForm('radio','status',array('publish','unpublish'),@$data?$data->status:'publish')?> *</td>
	 </tr>		 
	 <tr>
	  <td colspan="2">&nbsp;</td>
	  <td id="markButton">
		<?=form_submit('submit','Submit')?>
		<?=buttonRedirect('Cancel',$module_url.'/index/'.(@$data?$data->catagory_article_id:$currentCatagory))?>
	  </td>
	 </tr>
	</table>
<?=form_close()?>
<? $this->load->view(ADMIN_FOOTER) ?>
