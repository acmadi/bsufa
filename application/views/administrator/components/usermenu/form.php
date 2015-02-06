<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open(uri_string())?>
<?=loadThickbox()?>
<? showErrors() ?>
	<table>
	 <tr>
	  <td><?=$labels->group_id?></td>
	  <td>:</td>
	  <td><?=createForm('dropdown:45','group_id',$UserGroup,@$data?$data->group_id:$usermenuSelected)?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->module_id?></td>
	  <td>:</td>
	  <td>
	  <? 
		echo '<select name="module_id">';
		echo '<option value="">* top catagory</option>';
		echo loadCatagory($menuList,0,0,@$data->module_id,'id_module','module_name');
		echo '</select>';					  
	  ?>
	  </td>
	 </tr>		 
	 <tr>
	  <td colspan="2">&nbsp;</td>
	  <td id="markButton">
		<?=form_submit('submit','Submit')?>
		<?=buttonRedirect('Cancel',$module_back)?>
	  </td>
	 </tr>
	</table>
<?=form_close()?>
<? $this->load->view(ADMIN_FOOTER) ?>
