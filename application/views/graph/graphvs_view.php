<? $this->load->view(ADMIN_HEADER) ?>
<table border="0">
	<tr>
		<td width="50%"><?#echo $data['graph1'];?>
		<iframe src="<?=base_url()?>graph/graph_budget" width="100%" frameborder="no" border="0" framespacing="0" height="300">
          <p>Your browser does not support iframes.</p>
       </iframe>
		</td>
	    <td><?echo $data['graph2'];?></td>
	</tr>
</table>
<?$this->load->view(ADMIN_FOOTER)?>
