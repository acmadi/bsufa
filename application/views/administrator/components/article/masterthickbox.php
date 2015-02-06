<?
	if($alldata){
	  $index = 1;
	  ?>
		<table width="95%" align="center">
		  <tr id="tableDataHeader">
			<th>No</th>
			<th>Article</th>
		  </tr>
		  <? foreach($alldata as $row): ?>
			  <tr class="tableDataColomn">
				<td align="center"><?=$index++?></td>
				<td><a href="javascript:pickItem('article<?=$row->id_article?>/<?=$row->article_url?>')"><?=$row->article_title?></a></td>
			  </tr>
		  <? endforeach; ?>
		</table>
		<? echo $pagging['links'] ?>
	  <?
	}
?>
