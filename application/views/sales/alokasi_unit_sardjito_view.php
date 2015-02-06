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

window.setInterval("reFresh()",3600);
</script>
</head>

<body>
<div id="wrap">
	<div class="classhome"><a href="<?=site_url('sales/alokasi_status')?>" ><< back</a></div>
	<!--<div id="wrapheader">-->
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
	
	
	<table class="wrapheader" border="0">	
		<tr bgcolor="#FF9933">
			<td  colspan="3">Grand Total Unit </td>
			<td><b><?=$data['total']->status?> ,Unit</b></td>
			<td><b>| Nett. <?=$data['total']->land?> Sqm </b></td>
			<td><b>| SGA. <?=$data['total']->bgnan?> Sqm </b></td>
		</tr>
		<tr>
			<td class="class1" colspan="3">Available</td>
			<td><b><blink><?=$data['avaliable']->status?>(Unit)</b></td>
			<td><b><blink> <?=$data['avaliable']->land?>(Sqm)</b></td>
			<td><b><blink> <?=$data['avaliable']->bgnan?>(Sqm) </b></td>
		</tr>
		<tr>
			<td class="class2" colspan="3">Reserved</td>
			<td><b><?=$data['reserved']->status?> ,Unit</b></td>
			<td><b>| Nett. <?=$data['avaliable']->land?> Sqm </b></td>
			<td><b>| SGA. <?=$data['avaliable']->bgnan?> Sqm </b></td>
		</tr>
		<tr>
			<td class="class3" colspan="3">Sold</td>
			<td><b><?=$data['sold']->status?> ,Unit</b></td>
			<td><b>| Nett. <?=$data['avaliable']->land?> Sqm </b></td>
			<td><b>| SGA. <?=$data['avaliable']->bgnan?> Sqm </b></td>
		</tr>
		<tr>
			<td class="class4" colspan="3">N/A</td>
			<td><b><?=$data['na']->status?> ,Unit</b></td>
			<td><b>| Nett. <?=$data['avaliable']->land?> Sqm </b></td>
			<td><b>| SGA. <?=$data['avaliable']->bgnan?> Sqm </b></td>
		</tr>
		<tr>
			<td class="class5" colspan="3">Proses Dealing</td>
			<td><b><?=$data['pd']->status?> ,Unit</b></td>
			<td><b>| Nett. <?=$data['avaliable']->land?> Sqm </b></td>
			<td><b>| SGA. <?=$data['avaliable']->bgnan?> Sqm </b></td>
		</tr>
		
		
		
<!--	</div>	-->


</table>
	<div id="wrapcenter">
		<?php 
			$max = 8;
			$no = 1;
			
			echo "<table border='0' align='center'><tr>";
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
					echo"<tr>";
					$no = 0;
				}else{
					echo "<td bgcolor=".$bgcolor."><a class='thickbox' href='form_alokasi/".$row->unit_id."?width=750&height=450' title='Reserved Unit'>".$row->unit_no."</a></td>";
				} 
			$no++;
			endforeach; 
			echo"</table></tr>";
		?>
	</div>
	<!--div id="wrapfooter">
		<span class="class1">Avaliable</span>
		<span class="class2">Reserved</span>
		<span class="class3">Sold</span>
		<span class="class4">N/A</span>
	</div-->	
</div>	
</body>
</html>
