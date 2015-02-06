<tr valign="bottom">
  <td id="content" colspan="3"><br />
		<table border="0" width="957" align="center" cellspacing="0" cellpadding="0">
				<tr >
					<td class="menuatas2">&nbsp;</td>
					<td colspan="2" class="menuatas"><b><font color="#5d605c">&nbsp;Gallery</font><b></td>
					<td class="menuatas1">&nbsp;</td>
				</tr>
		</table>
	<table border="0" width="957" align="center" bgcolor="#FFFFFF">
		<tr valign="bottom">
			  <td width="200">&nbsp;</td>
			  <td id="content">
					<h1><em><?=$galleryName ?></em></h1>
					<? if($gallery): ?>
					<div id="divContentTab">					
							<?	
								$x = 1;				
								foreach($gallery as $ban){					
								  $img = $filePath.$ban->image;
								  if(is_file($img)){
									list($w,$h) = getimagesize($img);
									$attr = array('src'=>$img,'width'=>516,'height'=>362);
									echo '<div id="div'.($x++).'">'.img($attr).'</div>';
								  }
								}
							?>
						</div>
					<? endif; ?>
			  </td>
			  <td id="divProfileDesc" class="gray">
				<?
					if($gallery):
					$x = 1;
					foreach($gallery as $ban){		
						echo '<div style="padding-bottom: 10px" id="profileContent_div'.($x++).'">'.nl2br($ban->gallery_content_desc).'</div>';
					}
					endif;
				?> 				
			  </td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" id="divTriggerTab">
				   <? if($gallery): ?>
					 <? $x = 1; ?>
					 <? foreach($gallery as $ban): ?>
					  <a href="javascript:;" onClick="openContent(this,'div<?=$x?>')"<? if($x++==1): ?> id="firstSlide"<? endif; ?>><?=img(array('src'=>'gallery/thumb/70/'.$ban->image,'border'=>0))?></a>
					 <? endforeach; ?>	
				   <? endif; ?>	
			</td>
		</tr>
	</table>
	<table border="0" width="957" align="center" cellspacing="0">
			<tr >
				<td class="menubawah2">&nbsp;</td>
				<td colspan="2" class="menubawah">&nbsp;</td>
				<td class="menubawah1">&nbsp;</td>
			</tr>
	</table>
  </td>
</tr>