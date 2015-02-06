<tr valign="bottom">
  <td id="content" colspan="3"><br />
		<table border="0" width="957" align="center" cellspacing="0" cellpadding="0">
				<tr >
					<td class="menuatas2">&nbsp;</td>
					<td colspan="2" class="menuatas"><b><font color="#5d605c">&nbsp;News</font><b></td>
					<td class="menuatas1">&nbsp;</td>
				</tr>
		</table>
		<table border="0" width="957" align="center" bgcolor="#FFFFFF">
			<tr>
				  <!-- <td width="200">&nbsp;</td> -->
				  <td colspan="2" id="tdGalleryNews">
			<? if($catagory): ?>
			 <table>
			   <tr>
				 <? if($catagory->catagory_image): ?>
				 <td><?=img('news/image/80/'.$catagory->catagory_image)?></td>
				 <? endif; ?>
				 <td class="articleCatTitle"><?=$catagory->catagory_name?></td>
			   </tr>
			 </table>
			<? endif; ?>

			<? if($alldata): ?>
			<table border="0" width="870" cellspacing="0" cellpadding="0">
			
			
			<? 
			 $x = 0;
			 foreach($alldata as $row): ?>
			<tr>
				<td class="tdspace" width="150px">&nbsp;</td>
				<td class="styleTgl"><b><font color="#ffffff"><?=$row->article_update?></font></b></td>
			</tr>
			<tr>
				<td rowspan="3" class="coverBerita"><img src="<?$filePath.$row->highlight_image?>"/><?=$row->highlight_image?></td>
				<td class="tdjudul"><b><font color="#424242"><?=anchor('article'.$row->id_article.'/'.$row->article_url,$row->article_title)?></font></b></td>
			</tr>
			<tr>
				<td class="tdarticle"><?=character_limiter($row->article_content,300)?></td>
			</tr>
			<tr>
				<td class="rm"><?=anchor('article'.$row->id_article.'/'.$row->article_url,'Read more')?></td>
			</tr>
			

<!--			 <div id="boxtable">
				<div class="tablebox">
					<div class="tablebawah">
					dsadsadsadsadsa
						<div class="coverBerita"></div>
					</div>
				</div>
			</div>

				<div class="styleTgl"><b><font color="#ffffff"><?=$row->article_update?></font></b></div>
				<div id="coverBerita"></div>
				<h3><font color="#424242"><?=anchor('article'.$row->id_article.'/'.$row->article_url,$row->article_title)?></font></h3>
				<div><?=character_limiter($row->article_content,300)?></div>
				<div align="right" class="rm"><?=anchor('acticle'.$row->id_article.'/'.$row->article_url,'Read more')?></div> -->
			  <? endforeach; ?>
			  </table>
			 <div align="center">
			 <? echo $pagging['links']?>
			</div>
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
