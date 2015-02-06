<html>
<head>
<?=link_tag(CSS_PATH.'town.css')?>
<?=script('jquery-1.4.2.min.js')?>
<?=script('jquery.js')?>
<?=script('thickbox.js')?>
<?=script('jquery.form.js')?>
<?=link_tag(CSS_PATH.'thickbox.css')?>
<title>Town House Status</title>
</head>
<?php #var_dump($data['unitdt']); ?>
<body>
	<div class="classhome"><a href="<?=site_url('sales/viewalokasi_status')?>" ><< back</a></div>
	<table width="10%" height="15" font="8px	">	
		<tr>
			<td class="class1" colspan="2" style="width:50px">Available</td></tr>
		<tr>
			<td class="class1" style="width:5px">Total Unit</td>
			
			<td class="class1" style="width:70px"><b><blink><?=$data['avaliable']->status?></blink></b></td>
		</tr>
		<tr>
			<td class="class1" style="width:5px"> Luas(Sqm)</td>
		
			<td class="class1" style="width:70px"><b><blink><?=$data['avaliable']->land?></blink></b></td>
		</tr>
			
		<tr>
			<td class="class1" style="width:5px"> Bangunan(Sqm)</td>

			<td class="class1" style="width:70px"><b><blink><?=$data['avaliable']->bgnan?></blink></b></td>
		</tr>
		
		<tr>
			<td class="class2" colspan="2" style="width:50px">Reserved</td></tr>
		<tr>
			<td class="class2" style="width:5px">Total Unit</td>
		
			<td class="class2" style="width:70px"><b><?=$data['reserved']->status?></b></td>
		</tr>
		<tr>
			<td class="class2" style="width:5px"> Luas(Sqm)</td>

			<td class="class2" style="width:70px"><b><?=$data['reserved']->land?></b></td>
		</tr>
			
		<tr>
			<td class="class2" style="width:5px"> Bangunan(Sqm)</td>
		
			<td class="class2" style="width:70px"><b><?=$data['reserved']->bgnan?></b></td>
		</tr>
		
		<tr>
			<td class="class3" colspan="2" style="width:50px">Sold</td></tr>
		<tr>
			<td class="class3" style="width:5px">Total Unit</td>
	
			<td class="class3" style="width:70px"><b><?=$data['sold']->status?></b></td>
		</tr>
		<tr>
			<td class="class3" style="width:5px"> Luas(Sqm)</td>

			<td class="class3" style="width:70px"><b><?=$data['sold']->land?></b></td>
		</tr>
			
		<tr>
			<td class="class3" style="width:5px"> Bangunan(Sqm)</td>
	
			<td class="class3" style="width:70px"><b><?=$data['sold']->bgnan?></b></td>
		</tr>
		
		<tr>
			<td class="class4" colspan="2" style="width:50px">N/A</td></tr>
		<tr>
			<td class="class4" style="width:5px">Total Unit</td>

			<td class="class4" style="width:70px"><b><?=$data['na']->status?></b></td>
		</tr>
		<tr>
			<td class="class4" style="width:5px"> Luas(Sqm)</td>

			<td class="class4" style="width:70px"><b><?=$data['na']->land?></b></td>
		</tr>
			
		<tr>
			<td class="class4" style="width:5px"> Bangunan(Sqm)</td>
	
			<td class="class4" style="width:70px"><b><?=$data['na']->bgnan?></b></td>
		</tr>
		
		<tr>
			<td class="class5" colspan="2" style="width:50px">Proses Dealing</td></tr>
		<tr>
			<td class="class5" style="width:5px">Total Unit</td>
	
			<td class="class5" style="width:70px"><b><?=$data['pd']->status?></b></td>
		</tr>
		<tr>
			<td class="class5" style="width:5px"> Luas(Sqm)</td>
	
			<td class="class5" style="width:70px"><b><?=$data['pd']->land?></b></td>
		</tr>
			
		<tr>
			<td class="class5" style="width:5px"> Bangunan(Sqm)</td>
	
			<td class="class5" style="width:70px"><b><?=$data['pd']->bgnan?></b></td>
		</tr>
		<tr>
			<td colspan="2" style="width:50px" class="class6">Grand Total</td></tr>
		<tr>
			<td class="class6" style="width:5px">Unit</td>
			<td class="class6" style="width:70px"><b><?=$data['total']->status?></b></td>
		</tr>
		<tr>
			<td class="class6" style="width:5px"> Luas(Sqm)</td>
			
			<td class="class6" style="width:70px"><b><?=$data['total']->land?></b></td>
		</tr>
			
		<tr>
			<td class="class6" style="width:5px"> Bangunan(Sqm)</td>
			
			<td class="class6" style="width:70px"><b><?=$data['total']->bgnan?></b></td>
		</tr>
		
		


</table>	
	
	
	


	
<div id="wrap">	
	<div id="wrapheader">
	<!--	<div class="classhome"><a href="<?//=site_url('sales/alokasi_status')?>">HOME</a></div>-->
		<?php 
			$i = 0;
			foreach($data['unittown1'] as $row):
				#Cek Cek Status Unit
				if($row->status_unit==1){
					$bgcolor ='#00FF66';
				}elseif($row->status_unit==2){
					$bgcolor ='#FFFF66';
				}elseif($row->status_unit==3){
					$bgcolor ='#FF0000';
				}else{
					$bgcolor ='#666666';
				}
				
				if($i == 0){
		?>
			
					<div class="classheader1" style="background-color:<?=$bgcolor?>">
					<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='Reserver Unit'><?=$row->unit_no?></a>
					</div>
							
		<?php			
				}else{
		?>
			<div class="classheader2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='View Unit'><?=$row->unit_no?></a>
			</div>
			
		<?php } $i++; endforeach; ?>												
	</div>
	<br>
	<br>
	<br>
	<div id="wrapmiddle">
		<div id="wrapmiddle1">
		<?php 
			$i = 0;
			foreach($data['unittown2'] as $row):
				#Cek Cek Status Unit
				if($row->status_unit==1){
					$bgcolor ='#00FF66';
				}elseif($row->status_unit==2){
					$bgcolor ='#FFFF66';
				}elseif($row->status_unit==3){
					$bgcolor ='#FF0000';
				}else{
					$bgcolor ='#666666';
				}
			
				if($i == 0){
		?>	
			<div class="classmiddle1" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='View Unit'><?=$row->unit_no?></a>
			</div>
		<?php }else{ ?>
			<div class="classmiddle2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='View Unit'><?=$row->unit_no?></a>
			</div>		
		<?php } $i++; endforeach; ?>									
		</div>
		
		<div id="wrapmiddle2">
		<?php 
			$i = 0;
			foreach($data['unittown3'] as $row):
				#Cek Cek Status Unit
				if($row->status_unit==1){
					$bgcolor ='#00FF66';
				}elseif($row->status_unit==2){
					$bgcolor ='#FFFF66';
				}elseif($row->status_unit==3){
					$bgcolor ='#FF0000';
				}else{
					$bgcolor ='#666666';
				}
			
				if($i == 0){
		?>	
			<div class="class1" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='View Unit'><?=$row->unit_no?></a>
			</div>
		<?php }else{ ?>
			<div class="class2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='View Unit'><?=$row->unit_no?></a>
			</div>		
		<?php } $i++; endforeach; ?>									
	
		</div>
	</div>	

<!--	<div id="wrapheader"> -->
		<div id="wrapfooter">
		<?php 
			$i = 0;
			foreach($data['unittown4'] as $row):
				#Cek Cek Status Unit
				if($row->status_unit==1){
					$bgcolor ='#00FF66';
				}elseif($row->status_unit==2){
					$bgcolor ='#FFFF66';
				}elseif($row->status_unit==3){
					$bgcolor ='#FF0000';
				}else{
					$bgcolor ='#666666';
				}
			
				if($i == 0){
		?>	
			<div class="classfooter1" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='View Unit'><?=$row->unit_no?></a>
			</div>
		<?php }else{ ?>
			<div class="classfooter2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_alokasi_town/<?=$row->unit_id?>?width=750&height=450' title='View Unit'><?=$row->unit_no?></a>
			</div>		
		<?php } $i++; endforeach; ?>									
<!--	</div>-->		
		</div>
		</div>	
</body>
</html>

