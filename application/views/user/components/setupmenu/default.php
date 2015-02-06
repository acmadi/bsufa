<? $this->load->view(ADMIN_HEADER); ?>
<? if($alldata): ?>
	<table border="1" width="95%" align="center">
	  <tr id="tableDataHeader">
		<th>No</th>
		<th><?=$labels->group_name?></th>	
		<th>Action</th>			
	  </tr>
	  <? $index = +1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
		<td>&nbsp;<?=$data->group_name?></td>
        <td align="center" nowrap>
		 <?=anchor('user/usermenu/index/'.$data->id_group,'View')?>
        </td>
	  </tr>
	  <? endforeach; ?>
	</table>
<? endif; ?>
<? $this->load->view(ADMIN_FOOTER) ?>
