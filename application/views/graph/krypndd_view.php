<? $this->load->view(ADMIN_HEADER) ?>
<script type="text/javascript" src="<?=base_url()?>assets/js/swfobject.js"></script>
<table>
	<tr>
		<td colspan='2'><?echo $data['graphdata2'];?> </td>
	</tr>
	
	<tr>
		<td><?echo $data['graphdata'];?> </td>
		<td><?echo $data['graphdata1'];?> </td>
		
	</tr>
	
</table>


 <?$this->load->view(ADMIN_FOOTER)?>
