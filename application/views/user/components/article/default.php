<?
	$this->load->view(ADMIN_HEADER);
	function loadMenu($module_url,$data,$parent,$level){
	  if(isset($data[$parent])){ // jika ada anak dari menu maka tampilkan
		$str = ''; 
		foreach($data[$parent] as $value){
		  $child = loadMenu($module_url,$data,$value->id_catagory,$level+1); 
		  $str .= '<tr class="tableDataColomn"><td>&nbsp;'.str_repeat('--',$level).' '.$value->catagory_name;
		  $str .= '</td><td align="center">'.$value->allow_comment.'</td>';
		  $str .= '<td align="center">'.anchor('administrator/article/index/'.$value->id_catagory,'View').' | '.anchorAdmin($module_url,$value->id_catagory).'</td></tr>';
		  if($child) $str .= $child;
		}
		//$str .= '</ul>';
		return $str;
	  }else return false;
	}
	echo '<table width="95%" align="center"><tr id="tableDataHeader"><th>'.$labels->catagory_name.'</th>';
	echo '<th>'.$labels->allow_comment.'</th><th width="200">Action</th></tr>';
	echo loadMenu($module_url,$alldata,0,0);
	echo '</table>';
	echo buttonRedirect('Tambah Catagory',$module_url.'add/',1);
	$this->load->view(ADMIN_FOOTER);
?>
