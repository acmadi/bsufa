<html>
<head>
<?=link_tag(CSS_PATH.'jogja.css')?>
<?=script('jquery-1.4.2.min.js')?>
<?=script('jquery.js')?>
<?=script('thickbox.js')?>
<?=script('jquery.form.js')?>
<?=link_tag(CSS_PATH.'thickbox.css')?>
<title>Status Unit</title>
<script>
function reFresh() {
  location.reload(true)
}

window.setInterval("reFresh()",360000);
</script>
</head>

<body>

	<div class="classhome"><a href="<?=site_url('sales/viewsalesadmin_status')?>" ><< back</a></div>
	




	<table align='center' cellpadding='0' border='1' cellspacing='1' width='100%'>
	<tr bgcolor="#CCCCCC">
		<td style='width:20px' align='center' rowspan="2"><font size="8">UNIT</td>
		<td style='width:50px' align='center' rowspan="2"><font size="8">SGFA (M2)</td>
		<td style='width:150px' align='center' rowspan="2"><font size="8">TYPE</td>
		<td style='width:100px' align='center' rowspan="2"><font size="8">VIEW</td>
		<th colspan="3"style='width:100px' align='center'><font size="8">PRICE (INCL PPN)</th>
	


	</tr>
	</tr>
                                    
                
                                                                      
                                    <th><font size="4">CASH</th>
                                    <th><font size="4">12X</th>
                                    <th><font size="4">24X / KPA</th>                                    
                                    </tr>
	
		<?php 
		
			$hasil = $this->db->query("pricelist")->result();
		
			foreach($hasil as $row):
				
				?>
		<tr>
		
		<td style='width:20px' align="center" ><font size="8"><?=$row->no?></td>
		<td style='width:50px' align="center"><font size="8"><?=$row->sga?></td>
		<td style='width:150px' align="center"><font size="8"><?=$row->tipe?></td>
		<td style='width:100px' align="center"><font size="8"><?=$row->muka?></td>
		<td style='width:100px' align="right"><font size="8"><?=number_format($row->cash)?></td>
		<td style='width:100px' align="right"><font size="8"><?=number_format($row->thp12)?></td>		
		<td style='width:100px' align="right"><font size="8"><?=number_format($row->thp24)?></td>	
			
			

		</tr>	
				
			<?php
	 endforeach;
	
			
			
		?>


</table> 


</body>
</html>
