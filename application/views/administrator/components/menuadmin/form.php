<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open(uri_string())?>
<?=loadThickbox()?>
<? showErrors() ?>
<script language="javascript">
 function pickItem(url){
 	$('input[@name=module_path]').val(url);
 	tb_remove();
 }
</script>
	<table>
	 <tr>
	  <td><?=$labels->module_name?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','module_name',@$data->module_name)?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->module_index?></td>
	  <td>:</td>
	  <td><?=createForm('input:4','module_index',@$data->module_index)?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->parent_module_id?></td>
	  <td>:</td>
	  <td>
	  <?
		//$parent_id = ;
		function loadNavigator($data,$parent,$level,$parent_id){
		  if(isset($data[$parent])){ // jika ada anak dari menu maka tampilkan
			$str = ''; 
			foreach($data[$parent] as $value){
			  $child = loadNavigator($data,$value->id_module,$level+1,$parent_id); 
			  $str .= '<option value='.$value->id_module;
			  if($parent_id == $value->id_module) $str .= ' selected';
			  $str .= '> '.str_repeat('--',$level).' '.$value->module_name.'</option>';
			  if($child) $str .= $child;
			}
			//$str .= '</ul>';
			return $str;
		  }else return false;
		}
		echo '<select name="parent_module_id">';
		echo '<option value="">* top Menu</option>';
		echo loadNavigator($menuList,0,0,@$data->parent_module_id);
		echo '</select>';					  
	  ?> *</td>
	 </tr>
	 <tr>
	  <td><?=$labels->module_path?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','module_path',@$data->module_path)?> 
	  	  <a href="<?=site_url('administrator/menu/thickbox')?>/?width=450&height=350" class="thickbox">get from article</a>
	  </td>
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
