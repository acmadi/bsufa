<? $this->load->view(ADMIN_HEADER); ?>
<? if($alldata): ?> 
<table border="0" width="95%" align="center">
	<tr id="tableDataHeader">
		<th>No</th>	
		<th><?=$labels->kejuaraan_name?></th>
		<th><?=$labels->kejuaraan_desc?></th>	
		<th>Action</th>			
	  </tr>
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
        <td align="center"><?=$data->kejuaraan_name?></td>
		<td><?=previewContent($data->kejuaraan_desc)?></td>
        <td align="center" nowrap>
         <?=anchorAdmin($module_url,$data->kejuaraan_id)?>
        </td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? echo buttonRedirect('Add Kejuaraan',$module_url.'add/',1);?>
<? $this->load->view(ADMIN_FOOTER) ?>
