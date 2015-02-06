<tr valign="bottom">
  <td id="content" colspan="3"><br />
		<table border="0" width="957" align="center" cellspacing="0" cellpadding="0">
				<tr >
					<td class="menuatas2">&nbsp;</td>
					<td colspan="2" class="menuatas"><b><font color="#5d605c">&nbsp;Kontak Kami</font><b></td>
					<td class="menuatas1">&nbsp;</td>
				</tr>
		</table>
	<table border="0" width="957" align="center" bgcolor="#FFFFFF">		
		<tr>
			<td width="200">&nbsp;</td>
			<td colspan="2" id="content">
					
		 <table width="100%">
		  <tr valign="top">
		   <td> <?=img('assets/media/images/maplocation.jpg')?></td>   
		   <td>
			<?=form_open(uri_string())?>
			<? showErrors() ?>
				<table>
				 <tr>
				  <td><?=$labels->name?></td>
				  <td>:</td>
				  <td><?=createForm('input:35','name','')?> *</td></tr>	 
				 <tr>
				  <td><?=$labels->email?></td>
				  <td>:</td>
				  <td><?=createForm('input:35','email','')?> *</td>
				 </tr>
				 <tr>
				  <td><?=$labels->message?></td>
				  <td>:</td>
				  <td><?=createForm('textarea:40:7','message','')?> *</td>
				 </tr>		 		 	 
				 <tr>
				  <td colspan="2">&nbsp;</td>
				  <td id="markButton">
					<?=form_submit('submit','Submit')?>
					<?=form_reset('reset','Cancel')?>
				  </td>
				 </tr>
				</table>
				
			<?=form_close()?>
			 </td>
		   </tr>
		  </table>

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
