<?
	function loadMenu($module_url,$data,$parent,$level){
	  if(isset($data[$parent])){ // jika ada anak dari menu maka tampilkan
		$str = ''; 
		foreach($data[$parent] as $value){
		  $child = loadMenu($module_url,$data,$value->id_catagory,$level+1); 
		  $str .= '<tr class="tableDataColomn"><td>&nbsp;'.str_repeat('--',$level);
		  $str .= '<a href="javascript:pickItem(\'article/index/'.$value->id_catagory.'\')">'.$value->catagory_name.'</a>';
		  $str .= '</td><td align=center>'.$value->catagory_type.'</td></tr>';
		  if($child) $str .= $child;
		}
		//$str .= '</ul>';
		return $str;
	  }else return false;
	}
	echo '<table width="95%" align="center"><tr id="tableDataHeader"><th>'.$labels->catagory_name.'</th>';
	echo '<th>Type</th></tr>';
	echo loadMenu($module_url,$alldata,0,0);
	echo '</table>';
?>
