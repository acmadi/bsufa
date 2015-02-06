<tr valign="bottom">
  <td id="content" colspan="3">
  <br />
  <table border="0" width="957" align="center" cellspacing="0" cellpadding="0">
		<tr >
			<td class="menuatas2">&nbsp;</td>
			<td colspan="2" class="menuatas"><b><font color="#5d605c">&nbsp;Home</font><b></td>
			<td class="menuatas1">&nbsp;</td>
		</tr>
	</table>
	<table border="0" width="957" align="center" bgcolor="#FFFFFF">
		

		<tr>
			<td rowspan="4">
	  		<? if($highlights): ?>
				<div id="divContentTab">					
					<?	
						$x = 1;				
						foreach($highlights as $h){					
						  $img = $filePath.$h->highlight_image;
						  if(is_file($img)){
							list($w,$h) = getimagesize($img);
							$attr = array('src'=>$img,'width'=>526,'height'=>231);
							echo '<div id="div'.($x++).'">'.img($attr).'</div>';
						  }
						}
					?>
				</div>
				<div id="divProfileDesc">
			<?
				$x = 1;
				foreach($highlights as $h){		
					echo '<div id="profileContent_div'.($x++).'">';
					echo anchor('article'.$h->id_article.'/'.$h->article_url,$h->article_title);
					echo previewContent($h->article_content).'</div>';
				}
			?>
				</div>
			<? endif; ?>
			</td>
		   <? if($highlights): ?>
			 <? $x = 1; ?>
			 <? foreach($highlights as $h): ?>
	<? if($x>1): ?><tr><? endif; ?>
		<td colspan="2" id="divTriggerTab" class='sidenav'onClick="openContent(this,'div<?=$x?>')" <? if($x==1): ?> id="firstSlide"<? endif; ?>>
			  <?=img(array('src'=>'home/thumb/70/'.$h->highlight_image,'border'=>0,'align'=>'left'))?>
			  <div>TOKYO<br /><b><?=$h->article_title?></b></div>
		</td>
	<? if($x++>1): ?></tr><? endif; ?>
			 <? endforeach; ?>	
		   <? endif; ?>	
	  
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
	
	<tr><td colspan="3">&nbsp;</td></tr>
    <tr valign="top">
      <td class="borderGray-left" width="33%">
	    <? if($latestNews): ?>
      	  <h3 class="gray" align="center">Berita Terakhir</h3>		  
      	  <div class="gray"><?=date('d F Y',strtotime($latestNews->article_update))?></div>
      	  <div class="gray top10"><?=anchor('news',previewContent($latestNews->article_content))?></div>
		<? endif; ?>
      </td>
	  <td class="borderGray-center" width="33%">
      	  <h3 class="gray" align="center">Kejuaraan</h3>
		  <div class="gray"><? echo previewContent(@$latestKejuaraan->kejuaraan_desc,300) ?></div>
	  </td>
	  <td class="borderGray-right" width="33%">
	  	  <h3 class="gray" align="center">Klub</h3>		
	  	  <div class="gray">
		    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam. </p>
		  </div>  		  
	  </td>
    </tr>
