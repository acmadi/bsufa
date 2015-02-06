<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/thickbox.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/thickbox.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.form.js"></script>
<?php 
$max = 10;
$no = 1;
$unit = $this->db->get('db_unit')->result();
echo "<table border=1><tr>";
foreach($unit as $row):
	if($no==$max){
		echo"<tr>";
		$no = 0;
	}else{
		echo "<td><a class='thickbox' href='unit/formx/1?width=750&height=450' title='Detail Unit'>".$row->unit_no."</a></td>";
	} 
$no++;
endforeach; 
echo"</table></tr>";

?>
