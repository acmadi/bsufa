<?
	if($data){
	   echo '<h2>Links</h2><ul>';
	   foreach($data as $row){
		   echo '<li>'.anchor($row->url,$row->name,array('target'=>'_blank')).'</li>';
	   }
	   echo '</ul>';
	}
?>
