<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=incomestatement.xls");
header("Pragma: no-cache");
header("Expires: 0");

$pt			= "PT. GRAHA MULTI INSANI";
$judul 		= "Income Statement";
$periode	= "As Of";

extract(PopulateForm());
$date = inggris_date($tgl);

#BULAN MUNDUR
$blnutama = date('m',strtotime($date));
$thnutama = date('Y',strtotime($date));
$total = 0; 
$tot = 0;
$grandtot = 0;
 $sql = "select acc_period  from db_trlbal  where SUBSTRING(acc_period,1,4) = ".$thnutama." AND SUBSTRING(acc_period,5,2) <= ".$blnutama." group by acc_period";
 
 $bln =  $this->db->query($sql)->result();


?>
<table border="0">
	<tr>
		<td colspan='4'><font size='5'><b><?=$pt?></b></font></td>
	</tr>
	<tr>
		<td colspan='4'><font size='5'><b><?=$judul?></b></font></td>
	</tr>
	<tr>
		<td colspan='4'><font size='5'><b><?=$periode?>: <?=$tgl?></b></font></td>
	</tr>
	<tr>
		<td colspan='4'></td>
	</tr>
	<tr>
		<td><b>Account</b></td>
		<td><b>Description</b></td>
<!--
		<?#if($thnutama == 2012){?>
		<td><b>Begining Balanced</b></td>
		<?#}?>
-->
		<?#for ($i=1;$i<=$blnutama;$i++){?>
		
<!--
		<td><b><?#=date('M',mktime(0, 0, 0, $i, 10))?>&nbsp; <?#=$thnutama?></b></td>
-->
		
		<?#}?>
		<?	
			foreach ($bln as $bulan):
			$thn = SUBSTR($bulan->acc_period,0,4);
			$bln = SUBSTR($bulan->acc_period,4,2);
			$nmbln = date('M',mktime(0, 0, 0, $bln, 10));
		
		
		?>
		<td><?=$nmbln.$thn?></td>
		<?ENDFOREACH?>
		<td align='center'><b>Total</b></td>
	</tr>
	
	<tr>
		<td colspan='4'></td>
	</tr>
	
		<?	$period = date('Ym',strtotime($tgl));
			
			$sql = "select  b.acc_name,b.acc_no from db_coa b join db_trlbal c on c.acc_no = b.acc_no 
					where left(b.acc_no,1) > = '4'and left(b.acc_no,1) < = '7' and b.account_neraca='1' group by b.acc_name,b.acc_no order by b.acc_no";


			$cek  = $this->db->query($sql)->result();
			
			
		
				foreach($cek as $row):?>
			<tr>
		
				<td align='left'><b><?=$row->acc_no?> </td>
				<td><b><?=$row->acc_name?> </td>
			</tr>
			<tr>
					<?
					if ($thnutama <=2012){
					$sql = "select a.balance_base,a.acc_no,a.acc_name from db_trlbal a JOIN db_coa b on a.acc_no = b.acc_no 
								where account_neraca = '$row->acc_no' and a.acc_period = 201211
									group by a.balance_base,a.acc_no,a.acc_name order by a.acc_no";}
					else{
						$sql = "select a.balance_base,a.acc_no,a.acc_name from db_trlbal a JOIN db_coa b on a.acc_no = b.acc_no 
								 where account_neraca = '$row->acc_no' and SUBSTRING(a.acc_period,1,4) = ".$thnutama." 
									and SUBSTRING(a.acc_period,5,2) <= ".$blnutama."
										group by a.balance_base,a.acc_no,a.acc_name order by a.acc_no";
					}
					
					$cek2 = $this->db->query($sql)->result();
					
					foreach ($cek2 as $roow):
					?>
				
			    <td align='left'><?=$roow->acc_no?></td>
			    <td><?=$roow->acc_name?></td>
<!--
			    <?#if($thnutama <= 2012){?>
			    <td><?#=number_format($roow->balance_base)?></td>
			    <?#}?>
-->
							<?
							for ($x=1;$x<=$blnutama;$x++){
							
									$jml = strlen($x);
									if($jml == 1){ $x = "0".$x."";}	
										if($thnutama <= 2012){
							$sql2 = "select db_base - cr_base as end_base,
										(select balance_base +(db_base - cr_base) from db_trlbal where acc_period = ".$thnutama.$x." 
										  and acc_no ='$roow->acc_no' and acc_type = 2) as totblc
									from db_trlbal where acc_period = ".$thnutama.$x." and acc_no ='$roow->acc_no' and acc_type = 2"; 
									}else{
							
							$sql2 = "select db_base - cr_base as end_base,
										(select balance_base +(db_base - cr_base) from db_trlbal where acc_period = ".$thnutama.$x." 
										  and acc_no ='$roow->acc_no' and acc_type = 2) as totblc
									from db_trlbal where acc_period = ".$thnutama.$x." and acc_no ='$roow->acc_no' and acc_type = 2"; 			
							}
								
							
							
							$cek3 = $this->db->query($sql2)->result();
							
							foreach($cek3 as $rooow):
						$tot = $tot + $rooow->end_base;	
							?>
			    
			    <td><?=number_format($rooow->end_base)?></td>
				
							<? endforeach;} ?>
							<?#if($thnutama <= 2012){?>
				<td><b><?=number_format($rooow->totblc);?></b></td>
					<?$tot = 0;#}?>
			 </tr>
			 
			 
					<?endforeach?>
			
			<tr>
			 
				<td>&nbsp;</td>
				<td><b>TOTAL <?=$row->acc_name?></b></td>
				<?#if($thnutama <= 2012){?>
<!--
				<td><b>&nbsp;</b></td>
-->
				<?#}?>
						<?
							if ($thnutama == 2012){
								for ($x=11;$x<=$blnutama;$x++){
							
									$jml = strlen($x);
									if($jml == 1){ $x = "0".$x."";}	
									
							$sql3 = "select isnull(sum(db_base - cr_base),0) as end_base from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$thnutama.$x." and account_neraca = '$row->acc_no'";

							
							$queri = $this->db->query($sql3)->result();
							
							$sqla = "select sum(balance_base +(db_base - cr_base)) as totalblc from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$thnutama.$x." and account_neraca = '$row->acc_no'";

							
							$queria = $this->db->query($sqla)->row();
							
							foreach ($queri as $roooow):
							#$total = $total + $roooow->end_base;	
							
							?>
							
				<td><b><?=number_format($roooow->end_base)?></b></td>
							
							
							
				
							<?endforeach;}?>
				<td><b><?=number_format($queria->totalblc)?></b></td>						
							<? $total=0;
							
							
							
							
							} else{
							
				
						
							for ($x=1;$x<=$blnutama;$x++){
							
									$jml = strlen($x);
									if($jml == 1){ $x = "0".$x."";}	
									
							$sql3 = "select isnull(sum(db_base - cr_base),0) as end_base from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$thnutama.$x." and account_neraca = '$row->acc_no'";

							
							$queri = $this->db->query($sql3)->result();
							#$sql3 = $this->db->query("sp_pl_excel '".$thnutama.$x."','".$row->acc_no."'")->result();		
							#echo $sql3;
							foreach ($queri as $roooow):
							#if ($roooow->endbase == null){ $roooow->endbase = '';}
								
							$total = $total + $roooow->end_base;	
							?>
							
							
							
				<td><b><?=number_format($roooow->end_base)?></b></td>
							
							<?endforeach;?>
				<td><b><?=number_format($total)?></b></td>
						<?}; $total=0;}?>
			 </tr>
			
			
			<tr>
				<td>&nbsp;</td>
			</tr>
			
				<?endforeach?>
					
				 
				
				
				
				
				
				
			<tr>
				<td>&nbsp;</td>
				<td><b>TOTAL OTHER INCOME(EXPENSES)</b></td>
				<?#if($thnutama <= 2012){?>
<!--
				<td><b>&nbsp;</b></td>
-->
				<?#}?>
							<?
							
							if ($thnutama == 2012){
											for ($x=11;$x<=$blnutama;$x++){
										
												$jml = strlen($x);
												if($jml == 1){ $x = "0".$x."";}	
							
							
							
							$sql ="select isnull(sum(db_base - cr_base),0) as income,
								  (select isnull(sum(db_base - cr_base),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
								  where acc_period = ".$thnutama.$x." and account_neraca = '7.02') as expenses
									from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$thnutama.$x." and account_neraca = '7.01'";
							$queri = $this->db->query($sql)->result();
							
							#TOTAL YTD
							$sqlytd ="select isnull(sum(balance_base +(db_base - cr_base)),0) as incomeytd,
								  (select isnull(sum(balance_base + (db_base - cr_base)),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
								  where acc_period = ".$thnutama.$x." and account_neraca = '7.02') as expensesytd
									from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$thnutama.$x." and account_neraca = '7.01'";
							$queriytd = $this->db->query($sqlytd)->result();
							
							foreach($queri as $rows):
								
								$totinc = ($rows->income - (-1 * $rows->expenses));
							endforeach;				
							
							
							foreach($queriytd as $rowws):
								
								$totincytd = ($rowws->incomeytd - (-1 * $rowws->expensesytd));
							endforeach;				
							?>
							
							
							
				<td><b><?=number_format($totinc)?></b></td>
				
						<?
							};$totinc=0;?>
							
				<td><b><?=number_format($totincytd)?></b></td>							
							
							<?}else{
							
							
							
											for ($x=1;$x<=$blnutama;$x++){
										
												$jml = strlen($x);
												if($jml == 1){ $x = "0".$x."";}	
							
							
							
							$sql ="select isnull(sum(db_base - cr_base),0) as income,
								  (select isnull(sum(db_base - cr_base),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
								  where acc_period = ".$thnutama.$x." and account_neraca = '7.02') as expenses
									from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$thnutama.$x." and account_neraca = '7.01'";
							$queri = $this->db->query($sql)->result();
							
							foreach($queri as $rows):
								
								$totinc = ($rows->income - (-1 * $rows->expenses));
							endforeach;				
							?>
							
				<td><b><?=number_format($totinc)?></b></td>		
						<?
							};$totinc=0;}
							?>
							
				
				<td></td>
			</tr>
			
					
			<tr>
				<td>&nbsp;</td>
				<td><b>PROFIT(LOSS) BEFORE TAX</b></td>
				<?#if($thnutama <= 2012){?>
<!--
				<td><b>&nbsp;</b></td>
-->
				<?#}?>
						<?
						
						#if ($thnutama == 2012){
													for ($x=11;$x<=$blnutama;$x++){
												
														$jml = strlen($x);
														if($jml == 1){ $x = "0".$x."";}	
									
						
						$sql = "select isnull(sum(db_base - cr_base),0) as profit,
								  (select isnull(sum(db_base - cr_base),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$thnutama.$x." and account_neraca > '4.00' and a.acc_type = 2) as loss,
										(select isnull(sum(db_base - cr_base),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
											where acc_period = ".$thnutama.$x." and account_neraca > '8.00' and a.acc_type = 2) as tax 
								from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$thnutama.$x." and account_neraca = '4.00'";
					
						$queri = $this->db->query($sql)->result();
						
						foreach ($queri as $roows):

							$totplbftax = ($roows->profit -  ($roows->loss + $roows->tax ));
						
						endforeach;
					
					?>
				<td><b><?=number_format($totplbftax)?></b></td>
					<?}?>		
							
					<?
					
					$sqlag = "select isnull(sum(balance_base+(db_base - cr_base)),0) as profit,
								  (select isnull(sum(balance_base+(db_base - cr_base)),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$period." and account_neraca > '4.00' and a.acc_type = 2) as loss,
										(select isnull(sum(balance_base + (db_base - cr_base)),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
											where acc_period = ".$period." and account_neraca > '8.00' and a.acc_type = 2) as tax 
								from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$period." and account_neraca = '4.00'";
					
					$queriag = $this->db->query($sqlag)->row();
					
					$totbfytd = ($queriag->profit -  ($queriag->loss + $queriag->tax ));
					?>
				<td><b><?=number_format($totbfytd)?></b></td>
				
				
				
				
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			
				<?
					$sqlab = "select  b.acc_name,b.acc_no from db_coa b join db_trlbal c on c.acc_no = b.acc_no 
								where left(b.acc_no,1) > = '8' and b.account_neraca='1' group by b.acc_name,b.acc_no order by b.acc_no";
					$cekab  = $this->db->query($sqlab)->result();
					
					foreach ($cekab as $rowss):
				?>
			<tr>
				<td align="left"><b><?=$rowss->acc_no?></b></td>
				<td><b><?=$rowss->acc_name?></b></td>
			</tr>
			
					<?
					$sqlac = "select a.balance_base,a.acc_no,a.acc_name from db_trlbal a JOIN db_coa b on a.acc_no = b.acc_no 
								 where account_neraca = '$rowss->acc_no' and a.acc_period = ".$period."
										group by a.balance_base,a.acc_no,a.acc_name order by a.acc_no";
					$queriac = $this->db->query($sqlac)->result();
					
						foreach($queriac as $rowsss):
					?>
			<tr>
				<td align='left'><?=$rowsss->acc_no?></td>
				
				<td><?=$rowsss->acc_name?></td>
				<?#if($thnutama <= 2012){?>
<!--
				<td>&nbsp;</td>
-->
					<?#}
						
							if ($thnutama == 2012){
								for ($x=11;$x<=$blnutama;$x++){
							
									$jml = strlen($x);
									if($jml == 1){ $x = "0".$x."";}	
									
							$sqlad = "select isnull(sum(db_base - cr_base),0) as end_base from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$thnutama.$x." and a.acc_no = '$rowsss->acc_no'";

							$queriad = $this->db->query($sqlad)->result();
							
							$sqlae = "select isnull(balance_base +(db_base - cr_base),0) as totblctax from db_trlbal
									 where acc_period = ".$period." and acc_no ='$rowsss->acc_no' and acc_type = 2";
							$queriae = $this->db->query($sqlae)->row();			
							
							foreach($queriad as $rowssss):
						?>
				<td><?=number_format($rowssss->end_base)?></td>
				
						<?endforeach;}?>
				<td><b><?=number_format($queriae->totblctax)?></b></td>
						
						<?}?>
			</tr>
			
						<?endforeach?>
			<tr>
				<td>&nbsp;</td>
				<td><b>TOTAL <?=$rowss->acc_name?></b></td>
				<?#if($thnutama <= 2012){?>
<!--
				<td>&nbsp;</td>
-->
					<?#}
							if ($thnutama == 2012){
								for ($x=11;$x<=$blnutama;$x++){
							
									$jml = strlen($x);
									if($jml == 1){ $x = "0".$x."";}	
									
									$sqlaf = "select isnull(sum(balance_base +(db_base - cr_base)),0) as totalblcaf from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$thnutama.$x." and account_neraca = '$rowss->acc_no'";
				
									$queriaf = $this->db->query($sqlaf)->result();
									foreach($queriaf as $rowt):
								#echo $sqlaf;
								?>
								
				<td><?=number_format($rowt->totalblcaf)?></td>				
					
					<?endforeach;}}?>
			</tr>				
			
			
			<tr>
				<td>&nbsp;</td>
			</tr>
			
					<?endforeach?>
				
			
			<tr>
				<td>&nbsp;</td>
				<td><b>PROFIT(LOSS) AFTER TAX</b></td>
				<?#if($thnutama <= 2012){?>
<!--
				<td><b>&nbsp;</b></td>
-->
				<?#}?>
						<?
						
						if ($thnutama == 2012){
													for ($x=11;$x<=$blnutama;$x++){
												
														$jml = strlen($x);
														if($jml == 1){ $x = "0".$x."";}	
									
						
						$sql = "select isnull(sum(db_base - cr_base),0) as profit,
								  (select isnull(sum(db_base - cr_base),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
									where acc_period = ".$thnutama.$x." and account_neraca > '4.00' and a.acc_type = 2) as loss,
										(select isnull(sum(db_base - cr_base),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
											where acc_period = ".$thnutama.$x." and account_neraca > '8.00' and a.acc_type = 2) as tax 

								from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$thnutama.$x." and account_neraca = '4.00'";
						
						$queri = $this->db->query($sql)->result();
						
						foreach ($queri as $rooows):

							$totpltax = ($rooows->profit -  $rooows->loss);
						
						endforeach;
					
					?>
				<td><b><?=number_format($totpltax)?></b></td>
					<?
						};$totpltax=0;}else{
							
							
							
											for ($x=1;$x<=$blnutama;$x++){
										
												$jml = strlen($x);
												if($jml == 1){ $x = "0".$x."";}	
							
				$sql = "select isnull(sum(db_base - cr_base),0) as profit,
								(select isnull(sum(db_base - cr_base),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
								where acc_period = ".$thnutama.$x." and account_neraca > '4.00' and a.acc_type = 2) as loss 
								from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$thnutama.$x." and account_neraca = '4.00'";
						
						$queri = $this->db->query($sql)->result();
						
						foreach ($queri as $rooows):

							$totpltax = ($rooows->profit -  $rooows->loss);
						
						endforeach;
					
					?>
				<td><b><?=number_format($totpltax)?></b></td>
					<? };$totpltax=0;}
					
					$sqlah = "select isnull(sum(balance_base+(db_base - cr_base)),0) as profit,
								(select isnull(sum(balance_base + (db_base - cr_base)),0) from db_trlbal a join db_coa b on a.acc_no = b.acc_no 
								where acc_period = ".$period." and account_neraca > '4.00' and a.acc_type = 2) as loss 
								from db_trlbal a join db_coa b on a.acc_no = b.acc_no where acc_period = ".$period." and account_neraca = '4.00'";
						
					$queriah = $this->db->query($sqlah)->row();
					
					$totpltaxytd = ($queriah->profit -  $queriah->loss);?>
				
				<td><b><?=number_format($totpltaxytd)?></b></td>
				
				
			</tr>
			
		
		
		
	
	

</table>

