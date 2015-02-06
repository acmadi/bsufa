<?
	if($data){
		echo '<h2>Recent Updates</h2><ul>';
		foreach($data as $row){
		   echo '<li>'.anchor('article'.$row->id_article.'/'.$row->article_url,$row->article_title).'</li>';
		}
		echo '</ul>';
	}
?>
