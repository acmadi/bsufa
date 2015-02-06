<? $this->load->view(ADMIN_HEADER); ?>
<? if($alldata): ?>
	<table border="0" width="95%" align="center">
	  <tr id="tableDataHeader">
		<th>No</th>	
		<th><?=$labels->name?></th>	
		<th><?=$labels->link_index?></th>			
		<th><?=$labels->url?></th>			
		<th><?=$labels->status?></th>			
		<th>Action</th>			
	  </tr>
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
        <td><?=$data->name?></td>
        <td align="center"><?=$data->link_index?></td>
        <td align="center"><?=$data->url?></td>
        <td align="center"><?=$data->status?></td>
        <td align="center" nowrap>
         <?=anchorAdmin($module_url,$data->id_link)?>
        </td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? echo buttonRedirect('Add New Link',$module_url.'add/',1);?>
<? $this->load->view(ADMIN_FOOTER) ?>
