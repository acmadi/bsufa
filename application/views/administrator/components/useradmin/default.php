<? $this->load->view(ADMIN_HEADER); ?>
<? if($alldata): ?>
	<table border="0" width="95%" align="center">
	  <tr id="tableDataHeader">
		<th>No</th>
		<th>Group Name</th>	
		<th><?=$labels->username?></th>	
		<th><?=$labels->status?></th>	
		<th>Action</th>			
	  </tr>  
	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
		<td>&nbsp;<?=$data->group_name?></td>
		<td>&nbsp;<?=$data->username?></td>
		<td align="center">&nbsp;<?=$data->status?></td>
        <td align="center" nowrap>
		<?
		if($data->group_id=='1'){
			echo '&nbsp;';
		}else {
		?>
         <?=anchor($module_url.'/edit/'.$data->id_user,'Edit')?> | 
         <?=anchor($module_url.'/delete/'.$data->id_user,'Delete')?>
		<? } ?>
        </td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<? echo buttonRedirect('Add New User',$module_url.'add/',1);?>
<? $this->load->view(ADMIN_FOOTER) ?>

