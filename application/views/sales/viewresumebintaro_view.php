<html>
<head>


<title>Status Unit</title>
<script>
/*function reFresh() {
  location.reload(true)
}

window.setInterval("reFresh()",360000);
*/	
</script>

</head>

<?
$resume=$this->db->query("select b.unitstatus_nm,count(b.unitstatus_nm) as jml, sum(a.tanah) as tanah, sum(a.bangunan) as bangunan
from db_unit_bdm a
left join db_unitstatus b on b.unitstatus_id = a.status_unit
where id_pt=66
group by b.unitstatus_nm")->result();

#var_dump($resume);exit();

?>

<body>
<div id="wrap">

	<!--<div id="wrapheader">-->
	<br>
	<br>
	<br>
	
	<table id="tabel" border="0" width="800px">	
		<tr bgcolor="#FF5637">
			<td class="class6" colspan="3"><b>Status</b></td>
			<td class="class6" align="right"><b>Unit</b></td>
			<td class="class6" align="right"><b>Nett</b></td>
			<td class="class6"align="right"><b>Sqm</b></td>
			
		</tr>
<?
	$t1 = 0;
	$t2 = 0;
	$t3 = 0;
	
 foreach($resume as $row){ ?>	
	<tr>
			<td class="class1" colspan="3" align="left"><?=$row->unitstatus_nm; ?></td>
			<td class="class1" align="right"><b><!--input type="text" name="un" id="un" value="" --><?=$row->jml; ?></b></td>
			<td class="class1" align="right"><b><blink><?=$row->tanah; ?></blink></b></td>
			<td class="class1" align="right"><b><blink><?=$row->bangunan; ?></blink></b></td>
		</tr>

		
		<? 
$t1 = $t1 +$row->jml;
$t2 = $t2 +$row->tanah;
$t3 = $t3 +$row->bangunan;

#die($t1);



} ?>		
			<tr bgcolor="#FF5637">
			<td class="class6" colspan="3"><b>Grand Total</b></td>
			<td class="class6" align="right"><b><?=$t1; ?></b></td>
			<td class="class6" align="right"><b><?=$t2; ?></b></td>
			<td class="class6" align="right"><b><?=$t3; ?></b></td>
			
		</tr>
    
		<!--tr>
			<td class="class2" colspan="3">Reserved</td>
			<td class="class2"><b>k</b></td>
			<td class="class2"><b>k</b></td>
			<td class="class2"><b>k</b></td>
		</tr>
		<tr>
			<td class="class3" colspan="3">Sold</td>
			<td class="class3"><b>k</b></td>
			<td class="class3"><b>k</b></td>
			<td class="class3"><b>k</b></td>
		</tr>
		<tr>
			<td class="class4" colspan="3">N/A</td>
			<td class="class4"><b>k</b></td>
			<td class="class4"><b>k</b></td>
			<td class="class4"><b>k</b></td>
		</tr>
		<tr>
			<td class="class5" colspan="3">Proses Dealing</td>
			<td class="class5"><b>k</b></td>
			<td class="class5"><b>k</b></td>
			<td class="class5"><b>k</b></td>
		</tr>
		<tr>
			<td  class="class7" colspan="3">Grand Total Unit </td>
			<td  class="class7" align="center"><b>k</b></td>
			<td  class="class7" align="center"><b>k</b></td>
			<td  class="class7" align="center"><b>k</b></td>
		</tr-->
		
		



</table>
	
</body>
</html>
