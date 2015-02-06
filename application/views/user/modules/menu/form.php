<? $this->load->view(ADMIN_HEADER); ?>
<?=form_open(uri_string())?>
<?=loadThickbox()?>
<? showErrors() ?>
<script language="javascript">
 function pickItem(url){
 	$('input[@name=menu_url]').val(url);
 	tb_remove();
 }
 function selectURL(val){
	if(val == "") return;
	var url = '<?=site_url('?d=administrator')?>';
	switch(parseInt(val)){
		case 1: url += '&c=article&m=thickbox&type=news'; break;
		case 2: url += '&c=article&m=thickbox&type=content'; break;
	}
	url += '&width=450&height=350';
	//alert(url);
	$('#anchor-hidden').attr('href',url).click();
 }
</script>
	<table>
	 <tr>
	  <td><?=$labels->menu_title?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','menu_title',@$data->menu_title)?> *</td>
	 </tr>	 
	 <tr>
	  <td><?=$labels->parent_menu_id?></td>
	  <td>:</td>
	  <td>
	  <?
		//$parent_id = ;
		function loadNavigator($data,$parent,$level,$parent_id){
		  if(isset($data[$parent])){ // jika ada anak dari menu maka tampilkan
			$str = ''; 
			foreach($data[$parent] as $value){
			  $child = loadNavigator($data,$value->id_menu,$level+1,$parent_id); 
			  $str .= '<option value='.$value->id_menu;
			  if($parent_id == $value->id_menu) $str .= ' selected';
			  $str .= '> '.str_repeat('--',$level).' '.$value->menu_title.'</option>';
			  if($child) $str .= $child;
			}
			//$str .= '</ul>';
			return $str;
		  }else return false;
		}
		echo '<select name="parent_menu_id">';
		echo '<option value="">* top Menu</option>';
		echo loadNavigator($menuList,0,0,@$data->parent_menu_id);
		echo '</select>';					  
	  ?> *</td>
	 </tr>
	 <tr>
	  <td><?=$labels->menu_index?></td>
	  <td>:</td>
	  <td><?=createForm('input:4','menu_index',intval(@$data->menu_index))?>
	  </td>
	 </tr>	
	 <tr>
	  <td><?=$labels->menu_url?></td>
	  <td>:</td>
	  <td><?=createForm('input:45','menu_url',@$data->menu_url)?> 
			<select onChange="selectURL(this.value)">
				<option value="">-get from:-</option>
				<option value="1">News</option>
				<option value="2">Various Content</option>
			</select>
	  	  <a href="#" class="thickbox" id="anchor-hidden" style="display:none"></a>
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
	  <td colspan="2">&nbsp;</td>
	  <td id="markButton">
		<?=form_submit('submit','Submit')?>
		<?=buttonRedirect('Cancel',$module_url)?>
	  </td>
	 </tr>
	</table>
<?=form_close()?>
<? $this->load->view(ADMIN_FOOTER) ?>
