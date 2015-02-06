<?
	$this->load->view(ADMIN_HEADER);
	function loadMenu($module_url,$data,$parent,$level){
	  if(isset($data[$parent])){ // jika ada anak dari menu maka tampilkan
		$str = ''; 
		foreach($data[$parent] as $value){
		  $child = loadMenu($module_url,$data,$value->id_module,$level+1); 
		  $str .= '<tr class="tableDataColomn"><td>&nbsp;'.str_repeat('--',$level).' '.$value->module_name;
		  $str .= '</td><td align="center">'.$value->group_name.'</td>';
		  $str .= '</td><td align="center">'.$value->module_path.'</td>';
		  $str .= '<td align="center">'.anchorAdmin($module_url,$value->id_usermenu).'</td></tr>';
		  if($child) $str .= $child;
		}
		//$str .= '</ul>';
		return $str;
	  }else return false;
	}
?>
	<table width="95%" align="center">
	  <tr id="tableDataHeader">
	    <th>Menu</th><th>Group</th><th>Path</th><th width="200">Action</th>
	  </tr>
<? 
	echo loadMenu($module_url,$alldata,0,0);
	echo '</table>';
	echo buttonRedirect('Tambah Menu',$module_url.'add/'.$usermenu,1);
	$this->load->view(ADMIN_FOOTER);
?>
