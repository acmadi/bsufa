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
	<div class="classhome"><a href="<?=site_url('sales/sales')?>" ><< back</a></div>
	<table >	
		<tr>
			<td class="class1" colspan="3" style="width:50px">Grand Total</td></tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px">Unit</td>
			<td bgcolor="#FFFFFF" style="width:5px">: </td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['total']->status?> ,Unit</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Luas(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px"> :</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['total']->land?></td>
		</tr>
			
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Bangunan(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px">:</td>
			<td bgcolor="#FFFFFF" style="width:70px"> <?=$data['total']->bgnan?></td>
		</tr>
		
		<tr>
			<td class="class1" colspan="3" style="width:50px">Available</td></tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px">Total Unit</td>
			<td bgcolor="#FFFFFF" style="width:5px">: </td>
			<td bgcolor="#FFFFFF" style="width:70px"><blink><?=$data['avaliable']->status?> ,Unit</blink></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Luas(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px"> :</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['avaliable']->land?></td>
		</tr>
			
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Bangunan(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px">:</td>
			<td bgcolor="#FFFFFF" style="width:70px"> <?=$data['avaliable']->bgnan?></td>
		</tr>
		
		<tr>
			<td class="class2" colspan="3" style="width:50px">Reserved</td></tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px">Total Unit</td>
			<td bgcolor="#FFFFFF" style="width:5px">: </td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['reserved']->status?> ,Unit</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Luas(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px"> :</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['reserved']->land?></td>
		</tr>
			
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Bangunan(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px">:</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['reserved']->bgnan?></td>
		</tr>
		
		<tr>
			<td class="class1" colspan="3" style="width:50px">Sold</td></tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px">Total Unit</td>
			<td bgcolor="#FFFFFF" style="width:5px">: </td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['sold']->status?> ,Unit</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Luas(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px"> :</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['sold']->land?></td>
		</tr>
			
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Bangunan(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px">:</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['sold']->bgnan?></td>
		</tr>
		
		<tr>
			<td class="class1" colspan="3" style="width:50px">N/A</td></tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px">Total Unit</td>
			<td bgcolor="#FFFFFF" style="width:5px">: </td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['na']->status?> ,Unit</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Luas(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px"> :</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['na']->land?></td>
		</tr>
			
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Bangunan(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px">:</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['na']->bgnan?></td>
		</tr>
		
		<tr>
			<td class="class1" colspan="3" style="width:50px">Proses Dealing</td></tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px">Total Unit</td>
			<td bgcolor="#FFFFFF" style="width:5px">: </td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['pd']->status?> ,Unit</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Luas(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px"> :</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['pd']->land?></td>
		</tr>
			
		<tr>
			<td bgcolor="#FFFFFF" style="width:5px"> Bangunan(Sqm)</td>
			<td bgcolor="#FFFFFF" style="width:5px">:</td>
			<td bgcolor="#FFFFFF" style="width:70px"><?=$data['pd']->bgnan?></td>
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
					<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
					</div>
							
		<?php			
				}else{
		?>
			<div class="classheader2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
			</div>
			
		<?php } $i++; endforeach; ?>												
	</div>
	
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
				<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
			</div>
		<?php }else{ ?>
			<div class="classmiddle2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
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
				<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
			</div>
		<?php }else{ ?>
			<div class="class2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
			</div>		
		<?php } $i++; endforeach; ?>									
	
		</div>
	</div>	

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
				<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
			</div>
		<?php }else{ ?>
			<div class="classfooter2" style="background-color:<?=$bgcolor?>">
				<a class='thickbox' href='form_sales_town/<?=$row->unit_id?>?width=750&height=450' title='Status Unit'><?=$row->unit_no?></a>
			</div>		
		<?php } $i++; endforeach; ?>									
	</div>		
</div>	
</body>
</html>

