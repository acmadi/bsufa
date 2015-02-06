<? $this->load->view(ADMIN_HEADER); ?>
<script language="javascript">
  function setShowed(id,stat){
	 $.post('<?=site_url('administrator/homeprofile/setfrontend')?>',
		{postID:id,postStatus:stat},
		function(response){
			$('#show'+id).text(response);
		}
	);
  }
</script>
<? if($alldata): ?>
<?=loadThickbox()?>
	<table border="0" width="95%" align="center">
	  <tr id="tableDataHeader">
		<th>No</th>
		<th><?=$labels->title?></th>			
		<th>Image</th>			
		<th>Tanggal</th>			
		<th>Show @ Index</th>			
		<th>Action</th>			
	  </tr>
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
		<td><?=$data->title?></td>
		<td align="center"><?=anchor($filePath.$data->profile_image,$data->profile_image,array('class'=>'thickbox','rel'=>'slideShow'))?></td>
		<td align="center"><?=mysqlToDate($data->submit_date)?></td>
		<td align="center">
			<input type="checkbox" onClick="setShowed(<?=$data->id_profile?>,this.checked)"<?=($data->show_frontend=='yes'?' checked':'')?>>
			<span id="show<?=$data->id_profile?>"><?=$data->show_frontend?></span>
		</td>
		<td align="center" nowrap><?=anchorAdmin($module_url,$data->id_profile)?></td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? echo buttonRedirect('Add New Profile',$module_url.'add/',1);?>
<? $this->load->view(ADMIN_FOOTER) ?>
