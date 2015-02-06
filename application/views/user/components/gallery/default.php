<? $this->load->view(ADMIN_HEADER); ?>
<? if($alldata): ?> 
<table border="0" width="95%" align="center">
	<tr id="tableDataHeader">
		<th>No</th>	
		<th><?=$labels->gallery_catagory_name?></th>
		<!--<th>Action</th>-->			
	  </tr>
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
        <td align="center"><?=anchor('administrator/gallerycontent/index/'.$data->id_gallery_catagory,$data->gallery_catagory_name)?></td>
        <!--<td align="center" nowrap>
         <? //=anchorAdmin($module_url,$data->id_gallery_catagory)?>
        </td>-->
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? $this->load->view(ADMIN_FOOTER) ?>
