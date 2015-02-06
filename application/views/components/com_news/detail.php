<tr valign="bottom">
  <td id="content" colspan="3"><br />
		<table border="0" width="957" align="center" cellspacing="0" cellpadding="0">
				<tr >
					<td class="menuatas2">&nbsp;</td>
					<td colspan="2" class="menuatas"><b><font color="#5d605c">&nbsp;<?=$data->article_title ?></font><b></td>
					<td class="menuatas1">&nbsp;</td>
				</tr>
		</table>
	<table border="0" width="957" align="center" bgcolor="#FFFFFF">
		<? if(@$data): ?>
		<tr>
			<!--  <td width="10">&nbsp;</td> -->
			 <td colspan="2" id="tdContent">
				<h1><em><?=$data->article_title ?></em></h1>
				<!--div align="right"><?=date('d M Y',strtotime($data->article_date)) ?></div-->
				<p><?=$data->article_content?></p>
			</td>
		</tr>
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
