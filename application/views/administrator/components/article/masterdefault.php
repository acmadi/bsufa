<? $this->load->view(ADMIN_HEADER); ?>
<?
/*
	echo '<center><b>Catagory:</b> <select onChange="document.location=\''.site_url($this->module_url.'index').'/\'+this.value">';
	echo '<option value="0">* all catagory</option>';
	echo loadCatagory($catagoryList,0,0,$currentCatagory);
	echo '</select></center>';					  
*/	
?>
<script language="javascript">
  function setShowed(id,stat){
	 $.post('<?=site_url('administrator/article/setfrontend')?>',
		{postID:id,postStatus:stat},
		function(response){
			$('#show'+id).text(response);
		}
	);
  }
</script>
<h2 align="center">Catagory: <i><?=$catagoryName?></i></h2>
<? if($alldata): ?>
	<table border="0" width="95%" align="center">
	  <tr id="tableDataHeader">
		<th>No</th>
		<th><?=$labels->article_title?></th>			
		<th>Highlight Image</th>			
		<th>Tanggal</th>			
		<th><?=$labels->status?></th>			
		<th>Show @ Index</th>			
		<th>Action</th>			
	  </tr>
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
		<td><?=$data->article_title?></td>
		<td><?=$data->highlight_image?></td>
		<td align="center"><?=mysqlToDate($data->article_date)?></td>
		<td align="center"><?=$data->status?></td>
		<td align="center">
			<input type="checkbox" onClick="setShowed(<?=$data->id_article?>,this.checked)"<?=($data->show_frontend=='yes'?' checked':'')?>>
			<span id="show<?=$data->id_article?>"><?=$data->show_frontend?></span>
		</td>
		<td align="center" nowrap><?=anchorAdmin($module_url,$data->id_article)?></td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? echo buttonRedirect('Add New Article',$module_url.'add/'.$currentCatagory,1);?>
<? $this->load->view(ADMIN_FOOTER) ?>
