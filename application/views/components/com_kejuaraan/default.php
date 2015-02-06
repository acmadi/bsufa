<tr valign="bottom">
  <td id="content" colspan="3"><br />
		<table border="0" width="957" align="center" cellspacing="0" cellpadding="0">
				<tr >
					<td class="menuatas2">&nbsp;</td>
					<td colspan="2" class="menuatas"><b><font color="#5d605c">&nbsp;Daftar Kejuaraan</font><b></td>
					<td class="menuatas1">&nbsp;</td>
				</tr>
		</table>
	<table border="0" width="957" align="center" bgcolor="#FFFFFF">
		<tr valign="top">
			  <!-- <td width="200">&nbsp;</td> -->
			  <td colspan="2" id="tdContent">
		<? if($alldata): ?>

		 <? foreach($alldata as $row): ?>
		   <div class="bottom10">
			<!--h3><?=anchor('kejuaraan/detail/'.$row->kejuaraan_id,$row->kejuaraan_name)?></h3-->
			<h3><?=$row->kejuaraan_name?></h3>
			<div><?=$row->kejuaraan_desc?></div>
		   </div>
		 <? endforeach; ?>
		 <? echo $pagging['links']?>

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
