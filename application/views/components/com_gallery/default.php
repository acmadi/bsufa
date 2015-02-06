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
		<tr valign="top">
			  <td width="200">
				<?
					if($alldata){
						foreach($alldata as $row){
							echo '<h3>'.anchor('gallery/index/'.$row->id_gallery_catagory,$row->gallery_catagory_name).'</h3>';
						}
					}
				?>
			  </td>
			  <td colspan="2" id="tdGallery">
					<br />
					<?
						echo loadThickbox();
						if($gallery){					
							$x = 1;	
							echo '<table width="90%" align="center" cellspacing="2" cellpadding="4"><tr>';										 			
							foreach($gallery as $ban){					
							  $img = $filePath.$ban->image;					  
							  echo '<td align="center" bgcolor="#FFFFFF" width="25%">';
							  if(is_file($img)){
								list($w,$h) = getimagesize($img);
								?><a href="<?=site_url('?c=gallery&m=detail&id='.$ban->id_gallery_content.'&width=550&height=450')?>" class="thickbox"><?=img(array('src'=>'gallery/thumb/100/'.$ban->image,'border'=>0))?></a><?
							  }
							  echo '</td>';
							  if($x%4==0) {
								echo '</tr><tr>'; 
								$x=0;
							  }
							  $x++;
							}
							if($x>1){
							  while($x<=4) {
								echo '<td align="center" bgcolor="#FFFFFF" width="25%">&nbsp;</td>';
								$x++;
							  }
							}
							echo '</tr></table>';
						}
					?>
					<br />

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