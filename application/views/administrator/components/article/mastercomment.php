<? $this->load->view(ADMIN_HEADER); ?>
<div class="contentBox">
  <span class="contentDate"><?=date('d M Y',strtotime($articledata->article_date)) ?></span>
  <span class="contentTitle"><h3><?=$articledata->article_title ?></h3></span><?=previewContent($articledata->article_content,500) ?>
 </div>
<? if($alldata): ?>
	<table border="1" width="95%" align="center">
	  <tr id="tableDataHeader">
		<th>No</th>
		<th><?=$commentLabels->name?></th>			
		<th><?=$commentLabels->email?></th>			
		<th><?=$commentLabels->comment_content?></th>			
		<th>Action</th>			
	  </tr>

	  <? $index = $pagging['page']+1; ?>
	  <? foreach($alldata as $data): ?>
	  <tr class="tableDataColomn">
		<td align="center"><?=$index++?></td>
		<td><?=$data->name?></td>
		<td align="center"><?=$data->email?></td>
		<td align="left"><?=character_limiter($data->comment_content,100)?></td>
		<td align="center" nowrap><?=anchorAdmin($module_url."comment/",$data->id_comment)?></td>
	  </tr>
	  <? endforeach; ?>
	</table>
	<div id="divAdminPagging"><? echo $pagging['links']?></div>
<? endif; ?>
<div style="text-align:center; margin-top: 1em"><?=buttonRedirect('Back',$backURL)?></div>
<? $this->load->view(ADMIN_FOOTER) ?>
