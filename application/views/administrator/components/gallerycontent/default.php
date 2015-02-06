<? $this->load->view(ADMIN_HEADER); ?>
<b>Gallery Catagory: <big><?=$galleryName?></big></b>
<? if($alldata): ?> 
<?=loadThickbox()?>
<table border="0" width="95%" align="center">
	<tr id="tableDataHeader">
		<th>No</th>	
		<th><?=$labels->gallery_content_name?></th>
		<th>Image</th>
		<th>Action</th>			
	  </tr>
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
        <td align="center"><?=$data->gallery_content_name?></td>
		<td align="center"><?=anchor($filePath.$data->image,$data->image,array('class'=>'thickbox','rel'=>'slideShow'))?></td>
        <td align="center" nowrap>
         <?=anchorAdmin($module_url,$data->id_gallery_content)?>
        </td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? echo buttonRedirect('Add Gallery Content',$module_url.'add/'.$currentCatagory,1);?>
<? $this->load->view(ADMIN_FOOTER) ?>
