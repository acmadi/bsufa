
<html>
<head>
<?=link_tag(CSS_PATH.'grove.css')?>
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

<body background="https://mis.bsu.co.id/assets/foto/monyet1.jpg">
<div id="wrap">

	<div class="classhome"><a href="<?=site_url('sales/viewunitgrove_status')?>" ><< back</a></div>
	<!--<div id="wrapheader">-->
	
	<!--br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br>
	<br><br><br><br><br><br-->
	<?
				if($data['avaliable']->land==NULL){
					$data['avaliable']->land ="0";
				}elseif($data['reserved']->land==NULL){
					$data['reserved']->land ="0";
				}elseif($data['sold']->land==NULL){
					$data['sold']->land ="0";
				}elseif($data['na']->land==NULL){
					$data['na']->land ="0";
				}elseif($data['pd']->land==NULL){
					$data['pd']->land ="0";
				}
	?>
	
	
<table id="tabel" border="0">	
		<tr bgcolor="#FF5637">
			<td class="class6" colspan="3"><b>Status</b></td>
			<td class="class6" align="center"><b>Unit</b></td>
			<td class="class6" align="center"><b>Nett</b></td>
			<td class="class6"align="center"><b>SGA</b></td>
			
		</tr>
		<tr bgcolor="#FF9933">
			<td class="class1" colspan="3">Available</td>
			<td class="class1" ><b><blink><?=$data['avaliable']->status?></blink></b></td>
			<td class="class1" ><b><blink><?=$data['avaliable']->land?></blink></b></td>
			<td class="class1" ><b><blink><?=$data['avaliable']->bgnan?></blink></b></td>
		</tr>
		<tr>
			<td class="class2" colspan="3">Reserved</td>
			<td class="class2"><b><?=$data['reserved']->status?></b></td>
			<td class="class2"><b><?=$data['reserved']->land?></b></td>
			<td class="class2"><b><?=$data['reserved']->bgnan?></b></td>
		</tr>
		<tr>
			<td class="class3" colspan="3">Sold</td>
			<td class="class3"><b><?=$data['sold']->status?></b></td>
			<td class="class3"><b><?=$data['sold']->land?></b></td>
			<td class="class3"><b><?=$data['sold']->bgnan?></b></td>
		</tr>
		<tr>
			<td class="class4" colspan="3">N/A</td>
			<td class="class4"><b><?=$data['na']->status?></b></td>
			<td class="class4"><b><?=$data['na']->land?></b></td>
			<td class="class4"><b><?=$data['na']->bgnan?></b></td>
		</tr>
		<tr>
			<td class="class5" colspan="3">Proses Dealing</td>
			<td class="class5"><b><?=$data['pd']->status?></b></td>
			<td class="class5"><b><?=$data['pd']->land?></b></td>
			<td class="class5"><b><?=$data['pd']->bgnan?></b></td>
		</tr>
		<tr>
			<td  class="class7" colspan="3">Grand Total Unit </td>
			<td  class="class7" align="center"><b><?=$data['total']->status?></b></td>
			<td  class="class7" align="center"><b><?=$data['total']->land?></b></td>
			<td  class="class7" align="center"><b><?=$data['total']->bgnan?></b></td>
		</tr>
		
		



</table>

	<div id="wrapcenter">

		<?php 
		extract(PopulateForm());
		//die($view);
		
			$max = 12;
			$no = 1;
			
			//$que = $this->db->get('db_unit_grove')->result();
			//var_dump($que);
			
			echo "<table id='wrapcenter' border='0' align='center'><tr>";
			//echo "<table border='0' align='center'>";
			
			foreach($data['unit'] as $row):
				
				#Cek Cek Status Unit
				if($row->status_unit==1){
					$bgcolor ='#00FF66';
				}elseif($row->status_unit==2){
					$bgcolor ='#FFFF66';
				}elseif($row->status_unit==3){
					$bgcolor ='#FF0000';
				}elseif($row->status_unit==4){
					$bgcolor ='#666666';
				}else{
					$bgcolor ='#33CCFF';
				}
				
				if($no==$max){
					echo "<td bgcolor=".$bgcolor."><a class='thickbox' href='form_grove/".$row->unit_id."?width=600&height=500' title='Reserved Unit'>".$row->unit_no."</a></td>";
					//echo "<td bgcolor=".$bgcolor.">".$row->unit_no."</a></td>";
					echo"<tr>";
					$no = 0;
				}else{
					
					echo "<td bgcolor=".$bgcolor."><a class='thickbox' href='form_grove/".$row->unit_id."?width=600&height=500' title='Reserved Unit'>".$row->unit_no."</a></td>";
		//	
				
				} 
			$no++;
			endforeach; 
			
			echo"</tr></table>";
		?>
</div>
</div>
	

</body>
</html>
