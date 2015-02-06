<? $this->load->view(ADMIN_HEADER); ?>
<? if($alldata): ?>
	<table border="1" width="95%" align="center">
	  <tr id="tableDataHeader">
		<th>No</th>
		<th><?=$labels->name?></th>			
		<th><?=$labels->email?></th>			
		<th><?=$labels->message?></th>			
		<th>Submit date</th>			
		<th>Action</th>			
	  </tr>
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
		<td><?=$data->name?></td>
		<td><?=$data->email?></td>
		<td><?=$data->message?></td>
		<td align="center"><?=mysqlToDate($data->submitdate)?></td>
		<td align="center" nowrap>
			<?=anchor($module_url.'delete/'.$data->id_contactus,'delete')?>
		</td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? $this->load->view(ADMIN_FOOTER) ?>
