<?
	if($data && $filePath){
		echo '<h2>Categories</h2>';
		echo '<table cellspacing="6" class="tableCatagory">';
		foreach($data as $row){
			echo '<tr><td>'.img('article/image/30/'.$row->catagory_image).'</td><td>'.anchor('article/index/'.$row->id_catagory,$row->catagory_name).'</td></tr>';
		}
		echo '</table>';
	}
?>
