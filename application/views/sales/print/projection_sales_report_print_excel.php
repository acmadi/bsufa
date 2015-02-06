<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=ProjectionDetail.xls");
header("Pragma: no-cache");
header("Expires: 0");

$pt			= "PT. GRAHA MULTI INSANI";
$judul 		= "Projection Collection";
$periode	= "ALL PROJECT";
extract(PopulateForm());
$session_id = $this->UserLogin->isLogin();
$pt = $session_id['id_pt'];
//$subproject='41011';
//var_dump($project);


$data = $this->db->query("sp_projection ".$pt.",".$subproject."")->result();
//$data = $this->db->query("sp_projection")->result();




$sql = "SELECT datediff(m,CURRENT_TIMESTAMP, max(due_date)) AS jml,CURRENT_TIMESTAMP AS awal, MAX(due_date) AS akhir,  
		MONTH(CURRENT_TIMESTAMP) AS bln FROM db_billing WHERE id_flag <> 10";
$roww = $this->db->query($sql)->row();

$grandtotover = 0;
$grandtotbln = 0;
$totproj = 0;
$totkwtbilpay = 0;
$totgrand = 0;
$totpayover = 0;

extract(PopulateForm());
$i = 0;

?>
<table>
	<tr>
		<td colspan='6'><font size='5'><b><?=$pt?></b></font></td>
	</tr>
	<tr>
		<td colspan='6'><font size='3'><b><?=$judul?></b></td>
	</tr>
	<tr>
		<td colspan='6'><font size='3'><b><?=$periode?></b></td>
	</tr>
	<tr>
		<?$today = date("F j, Y");?>
		<td colspan='6' align='left'><font size='3'><b>Date Per: <?=$today?></b></td>
	</tr>
	<tr></tr>
	
	<tr style="border:1">
		<td><b>No</b></td>
		<td><b>No. Unit</b></td>
		<td><b>Customer</b></td>
		<td><b>Over Due</b></td>
		<?for($a=1;$a<=$roww->jml;$a++){?>
			<?$bulan = $roww->bln+$a;
			$nmbln = date('MY',mktime(0, 0, 0, $bulan, 10));
			?>
		<td><b><?=$nmbln?></b></td>
		<?}?>
		<td align='center'><b>T O T A L </b></td>
		
	</tr>
	<?foreach($data as $rows):?>
	<?$i = $i+1;?>
	<tr border='2' cellpadding ='1'>
		<td><b><?=$i?></b></td>
		<td><b><?=$rows->unit_no?></b></td>
		<td><b><?=$rows->customer_nama?></b></td>
		
		<?
					
			//~ $sql = "SELECT ISNULL(SUM(kwtbill_pay),0) AS totpay, ISNULL(sum(b.amount),0) AS totbill FROM db_kwtbill a
					//~ JOIN db_billing b ON b.id_billing = a.id_bill WHERE b.id_sp = '".$rows->id_sp."' AND a.id_flag <> 10 
					//~ AND kwtbill_paydate < CURRENT_TIMESTAMP AND b.id_flag <> 10 AND due_date < CURRENT_TIMESTAMP";
					
					
			$sql = "SELECT SUM(amount) as totbill FROM db_billing WHERE id_sp = '".$rows->id_sp."' and id_flag <>10 AND due_date < CURRENT_TIMESTAMP ";
			$wrr = $this->db->query($sql)->row();		

			$sql = "SELECT a.id_billing,(SELECT ISNULL(sum(kwtbill_pay),0) from db_kwtbill where id_bill = a.id_billing and isnull(id_flag,0) <> 10) AS totpay
					FROM db_billing a 
					WHERE id_sp = '".$rows->id_sp."' AND id_flag <>10 AND due_date < CURRENT_TIMESTAMP order by id_billing";
			
			
			$rw = $this->db->query($sql)->result();
			
			foreach ($rw as $wr):
				$totpayover = $totpayover + $wr->totpay;
				
			endforeach;
			
			$totover = $wrr->totbill - $totpayover;
			
			$grandtotover = $grandtotover + $totover;

		?>
		
		
		<td><b><?=number_format($totover)?></b></td>
			<?$totpayover = 0;?>
		
		
		
		
		<?for($a=1;$a<=$roww->jml;$a++){?>
			<?$bulan = $roww->bln+$a;
			$idsp = $rows->id_sp;
			$nmbln = date('MY',mktime(0, 0, 0, $bulan, 10));
			$thn = SUBSTR($nmbln,3,4);
			#$bln = date('M',mktime(0, 0, 0, $bulan, 10));
			
			$queri = "select ISNULL(sum(amount),0) as amount,ISNULL(sum(id_billing),0) as idbilling
					  from db_billing where MONTH(due_date) = '".$bulan."' and year(due_date) = ".$thn." and id_sp = '".$rows->id_sp."'";
			$rowww = $this->db->query($queri)->row();
			#$this->db->query("sp_projection_bln '".$nmbln."','".$idsp."'")->row();
			#foreach($rowww as $rw):
			
			$sql = "SELECT ISNULL(SUM(kwtbill_pay),0) AS kwtbillpay FROM db_kwtbill WHERE id_bill = '".$rowww->idbilling."' and id_flag <> 10";
			$roow = $this->db->query($sql)->row();
			
			$total = $rowww->amount - $roow->kwtbillpay;
			
			$totproj = $totproj + $total;
			
			?>
			
		<td><?=number_format($total)?></td>
		
		<? }?>
		
			<? $mastertoth = $totover + $totproj; ?>
		<td><b><?=number_format($mastertoth)?></b></td>
		<?$totproj = 0;?>
		
	</tr>
	
	
	<?endforeach?>
	
	<tr></tr>
	<tr>
		<td colspan='3' align='center'><b>T O T A L</b></td>
		<td><b><?=number_format($grandtotover)?></b></td>
		
		<?for($a=1;$a<=$roww->jml;$a++){?>
			<?$bulan = $roww->bln+$a;
			$idsp = $rows->id_sp;
			$nmbln = date('MY',mktime(0, 0, 0, $bulan, 10));
			$thn = SUBSTR($nmbln,3,4);
			#$bln = date('M',mktime(0, 0, 0, $bulan, 10));
			
			$sql = "SELECT ISNULL(SUM(amount),0) AS totamount FROM db_billing a
					JOIN db_sp b on id_sp = sp_id WHERE b.id_flag = 1 AND MONTH(due_date) = '".$bulan."' and year(due_date) = ".$thn." ";
					  
			$rooow = $this->db->query($sql)->row();
			#$this->db->query("sp_projection_bln '".$nmbln."','".$idsp."'")->row();
			#foreach($rowww as $rw):
			
			$sql = "SELECT a.id_billing,(SELECT ISNULL(SUM(kwtbill_pay),0) FROM db_kwtbill WHERE id_bill = a.id_billing and id_flag <> 10) AS totkwtbillpay
					FROM db_billing a JOIN db_sp b on id_sp = sp_id WHERE b.id_flag = 1 AND MONTH(due_date) = '".$bulan."' and year(due_date) = ".$thn."";
			$rrow = $this->db->query($sql)->result();
			
			
			foreach($rrow as $que):
				$totkwtbilpay = $totkwtbilpay + $que->totkwtbillpay;
			endforeach;
			//~ $total = $rowww->amount - $roow->kwtbillpay;
			//~ 
			//~ $totproj = $totproj + $total;
			$grandtotbln = $rooow->totamount - $totkwtbilpay;
			$totgrand = $totgrand + $grandtotbln;
			
			?>
			
		<td><?=number_format($grandtotbln)?></td>
			<?$totkwtbilpay = 0;?>
		
		<? }?>
		<?	$mastertot = $grandtotover + $totgrand;?>
		<td><b><?=number_format($mastertot)?></b></td>
		
	</tr>

</table>
