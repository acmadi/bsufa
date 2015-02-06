<?// $this->load->view(ADMIN_HEADER) ?>
<?php
//$id = $lastid->kd_supplier;
//$no = $id + 1; 
?>
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.maskedinput.js" type="text/javascript"></script>


<?php //die("a");?>
<body>
<form action="<?=site_url()?>budgetalocation/save_persen" method="post" \>
<table border=0>
<tr>
	<td style="width:150px">Kode Project</td>
	<td style="width:200px"><input type="text" name="kd_project" value="<?php echo $kd_project;?>">
</tr>
<tr>
	<td style="width:150px">Nama Project</td>
	<td style="width:200px"><input type="text" name="nm_project" value="<?php echo $nm_project;?>">
</tr>
<tr>
	<td style="width:150px">Alokasi Persen</td>
	<td style="width:200px"><input type="text" name="alokasi_persen" value="<?php echo $alokasi_persen;?>">
</tr>
<tr>
	<td colspan=2 ><input type="submit" value="Save"></td>
</tr>
</table>
</form>
</body>
<?//$this->load->view(ADMIN_FOOTER)?>
