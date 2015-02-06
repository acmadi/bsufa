<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=projection.xls");
header("Pragma: no-cache");
header("Expires: 0");


$session_id = $this->UserLogin->isLogin();
$user = $session_id['username'];
$pt	= $session_id['id_pt'];

if ($pt==11){
$namapt="PT. BAKRIE SWASAKTI UTAMA";
}elseif ($pt==22){
$namapt			= "PT. BUMI DAYA MAKMUR";
}elseif ($pt==44){
$namapt			= "PT. GRAHA MULTI INSANI";
}else{
$namapt			= "PT. AKASA LEGIAN KARYA";
}

$pt2			= $namapt;
$judul 		= "Projection Report";
$periode	= "As Of";

extract(PopulateForm());
$date = inggris_date($tgl);
$date2 = inggris_date($tgl2);


#BULAN MUNDUR
$blnutama = date('m',strtotime($date));
$thnutama = date('Y',strtotime($date));
$month = date( 'F', mktime(0, 0, 0, $blnutama));
$total = 0; 
$tot = 0;
$grandtot = 0;
$bln = $this->db->query("sp_period_procjectionawal '".$date."'")->result();

$payment = $this->db->query("sp_period_procjectionpayment '".$date."'")->result();
 


?>
<table border="0">
	<tr>
		<td colspan='4'><font size='5'><b><?=$pt2?></b></font></td>
	</tr>
	<tr>
		<td colspan='4'><font size='5'><b><?=$judul?></b></font></td>
	</tr>
	<tr>
		<td colspan='4'><font size='5'><b><?=$periode?>: <?=$month?>  <?=$thnutama?></b></font></td>
	</tr>
	<tr>
		<td colspan='4'></td>
	</tr>
	<tr>
		<td><b>Lot No</b></td>
		<td><b>Buyer Name</b></td>
		<td><b>Sales Date</b></td>
		<td><b>Sqm</b></td>
		<td align='center'><b>Type</b></td>
		<td><b>Selling Price</b></td>
		<td><b>Discount Price</b></td>
		<td><b>Net Selling Price</b></td>
		
		<?	
			foreach ($payment as $tahun):
			$thn_payment = SUBSTR($tahun->period,0,4);

		?>

		<td><?=$thn_payment?></td>
		
		
		<?ENDFOREACH?>
		
		<?	
			foreach ($bln as $bulan):
			$thn = SUBSTR($bulan->period,0,4);
			$bln = SUBSTR($bulan->period,4,2);
			$nmbln = date('M',mktime(0, 0, 0, $bln, 10));
		
		
		?>

		<td><?=$nmbln.$thn?></td>
		
		
		<?ENDFOREACH?>
		<td align='center'><b>Total</b></td>
		<td><b>Paid</b></td>
		<td><b>%</b></td>
		<td align='center'><b>Not Due</b></td>
		<td align='center'><b>Over Due</b></td>
		<td align='center'><b>Aging 0 - 30</b></td>
		<td align='center'><b>Aging 31 - 60</b></td>
		<td align='center'><b>Aging 31 - 90</b></td>
		<td align='center'><b>Aging > 90</b></td>
		<td align='center'><b>TOTAL OUTSTANDING</b></td>
		
		<?
		$blnutama2 = date('m',strtotime($date));
		$thnutama2 = date('Y',strtotime($date));
		$total2 = 0; 
		$date2 = '2018-12-31'; 
		$blnutama3 = date('m',strtotime($date2));
		$tot2 = 0;
		$grandtot2 = 0;
		$bln2 = $this->db->query("sp_period_procjection '".$date."','".$date2."'")->result();
 
		
		
		
		
			foreach ($bln2 as $bulan2):
			$thn2 = SUBSTR($bulan2->period,0,4);
			$bln2 = SUBSTR($bulan2->period,4,2);
			$nmbln2 = date('M',mktime(0, 0, 0, $bln2, 10));		
		?>
		<? if ($nmbln2=='Dec') {?>
		<td><?=$nmbln2.$thn2?></td>
		<td align='center'><b>Total</b></td>
		<?}else{?>
		<td><?=$nmbln2.$thn2?></td>
		<?}?>
		<?ENDFOREACH?>
		<td align='center'><b>Total</b></td>
		
	</tr>
	
	<tr>
		<td colspan='4'></td>
	</tr>
	
		<?	
			//extract(PopulateForm());
			$period = date('Ym',strtotime($tgl));
		
			$periodebln = date('m',strtotime($date));
			
			
			// $sql = "select  b.acc_name,b.acc_no from db_coa b join db_trlbal c on c.acc_no = b.acc_no 
					// where left(b.acc_no,1)  = '4' and b.account_neraca='1' group by b.acc_name,b.acc_no order by b.acc_no";
		if ($date=='2014-09-30'){			
		
		if ($pt==44){
			
		$data = $this->db->query("sp_projectionpaymentgmi '".$thn."','".$date."','".$periodebln."',".$pt.",".$subproject."")->result();
		}else{
		$data = $this->db->query("sp_projectionpayment '".$thn."','".$date."','".$periodebln."',".$pt.",".$subproject."")->result();
		}
		}else{
		
		if ($pt==44){
		$data = $this->db->query("sp_projectionpaymentovergmi '".$thn."','".$date."','".$periodebln."',".$pt.",".$subproject."")->result();		
		}else{
		$data = $this->db->query("sp_projectionpaymentover '".$thn."','".$date."','".$periodebln."',".$pt.",".$subproject."")->result();
		}
		}
		
		//$data = $this->db->query("sp_InvoiceAP '".$vendor."','".$project_detail."','".$checkbox."','".inggris_date($startdate)."','".inggris_date($enddate)."'")
					//		 ->result();


			//$cek  = $this->db->query($sql2)->result();
			
			
		
				foreach($data as $row):?>
				<?
				$overdue = $row->aging130 + $row->aging160 + $row->aging190 + $row->agingover1;
				$os = $overdue+$row->notdue1 ;
				$total = $row->Jan+$row->Feb+$row->Mar+$row->Apr+$row->Mei+$row->Jun+$row->Jul+$row->Aug+$row->Sep+$row->Okt+$row->Nov+$row->Des;
				$paid = $row->paid+$row->paid2+$row->paid3+$row->paid4+$row->paid5+$row->paid6+$row->paid7+$row->paid8+$row->paid9+$total;
				$persen=($paid/$row->selling_price)*100;
				

				?>
			<tr>
				
				
			    <td align='left'><?=$row->unit_no?></td>
			    <td><?=$row->customer_nama?></td>
				<td align='left'><?=inggris_date($row->tgl_sales)?></td>
			    <td><?=$row->bangunan?></td>
				<td align='center'><?=$row->paytipe_nm?></td>
				<td align='right'><?=number_format($row->price_manual)?></td>
			    <td><?=number_format($row->discamount)?></td>
				<td align='right'><?=number_format($row->selling_price)?></td>
				<td><?=number_format($row->paid)?></td>
				<td><?=number_format($row->paid2)?></td>
				<td><?=number_format($row->paid3)?></td>
				<td><?=number_format($row->paid4)?></td>
				<td><?=number_format($row->paid5)?></td>
				<td><?=number_format($row->paid6)?></td>
				<td><?=number_format($row->paid7)?></td>
				<td><?=number_format($row->paid8)?></td>
				<td><?=number_format($row->paid9)?></td>
			    <td><?=number_format($row->Jan)?></td>
				<td><?=number_format($row->Feb)?></td>
				<td><?=number_format($row->Mar)?></td>
				<td><?=number_format($row->Apr)?></td>
				<td><?=number_format($row->Mei)?></td>
				<td><?=number_format($row->Jun)?></td>
				<td><?=number_format($row->Jul)?></td>
				<td><?=number_format($row->Aug)?></td>
				<td><?=number_format($row->Sep)?></td>
				<td><?=number_format($row->Okt)?></td>
				<td><?=number_format($row->Nov)?></td>
				<td><?=number_format($row->Des)?></td>	
				<td><?=number_format($total)?></td>
				<td><?=number_format($paid)?></td>
				<td><?=number_format($persen)?></td>
			
			

				<td><?=number_format($row->notdue1)?></td>
				<td><?=number_format($overdue)?></td>
				<td><?=number_format($row->aging130)?></td>
				<td><?=number_format($row->aging160)?></td>
				<td><?=number_format($row->aging190)?></td>
				<td><?=number_format($row->agingover1)?></td>
				<td><?=number_format($os)?></td>
				
		
				

		
		
				
				<td><?=number_format($row->Jan1)?></td>
				<td><?=number_format($row->Feb1)?></td>
				<td><?=number_format($row->Mar1)?></td>
				<td><?=number_format($row->Apr1)?></td>
				<td><?=number_format($row->Mei1)?></td>
				<td><?=number_format($row->Jun1)?></td>
				<td><?=number_format($row->Jul1)?></td>
				<td><?=number_format($row->Aug1)?></td>
				<td><?=number_format($row->Sep1)?></td>
				<td><?=number_format($row->Okt1)?></td>
				<td><?=number_format($row->Nov1)?></td>
				<td><?=number_format($row->Des1)?></td>
				<? $total1=$row->Jan1+$row->Feb1+$row->Mar1+$row->Apr1+$row->Mei1+$row->Jun1+$row->Jul1+$row->Aug1+$row->Sep1+$row->Okt1+$row->Nov1+$row->Des1;
				?>
				<td><?=number_format($total1)?></td>
				<td><?=number_format($row->Jan2)?></td>
				<td><?=number_format($row->Feb2)?></td>
				<td><?=number_format($row->Mar2)?></td>
				<td><?=number_format($row->Apr2)?></td>
				<td><?=number_format($row->Mei2)?></td>
				<td><?=number_format($row->Jun2)?></td>
				<td><?=number_format($row->Jul2)?></td>
				<td><?=number_format($row->Aug2)?></td>
				<td><?=number_format($row->Sep2)?></td>
				<td><?=number_format($row->Okt2)?></td>
				<td><?=number_format($row->Nov2)?></td>
				<td><?=number_format($row->Des2)?></td>
				<? $total2=$row->Jan2+$row->Feb2+$row->Mar2+$row->Apr2+$row->Mei2+$row->Jun2+$row->Jul2+$row->Aug2+$row->Sep2+$row->Okt2+$row->Nov2+$row->Des2;
				?>
				<td><?=number_format($total2)?></td>
				<td><?=number_format($row->Jan3)?></td>
				<td><?=number_format($row->Feb3)?></td>
				<td><?=number_format($row->Mar3)?></td>
				<td><?=number_format($row->Apr3)?></td>
				<td><?=number_format($row->Mei3)?></td>
				<td><?=number_format($row->Jun3)?></td>
				<td><?=number_format($row->Jul3)?></td>
				<td><?=number_format($row->Aug3)?></td>
				<td><?=number_format($row->Sep3)?></td>
				<td><?=number_format($row->Okt3)?></td>
				<td><?=number_format($row->Nov3)?></td>
				<td><?=number_format($row->Des3)?></td>
				<? $total3=$row->Jan3+$row->Feb3+$row->Mar3+$row->Apr3+$row->Mei3+$row->Jun3+$row->Jul3+$row->Aug3+$row->Sep3+$row->Okt3+$row->Nov3+$row->Des3;
				?>
				<td><?=number_format($total3)?></td>
				<td><?=number_format($row->Jan4)?></td>
				<td><?=number_format($row->Feb4)?></td>
				<td><?=number_format($row->Mar4)?></td>
				<td><?=number_format($row->Apr4)?></td>
				<td><?=number_format($row->Mei4)?></td>
				<td><?=number_format($row->Jun4)?></td>
				<td><?=number_format($row->Jul4)?></td>
				<td><?=number_format($row->Aug4)?></td>
				<td><?=number_format($row->Sep4)?></td>
				<td><?=number_format($row->Okt4)?></td>
				<td><?=number_format($row->Nov4)?></td>
				<td><?=number_format($row->Des4)?></td>
				<? $total4=$row->Jan4+$row->Feb4+$row->Mar4+$row->Apr4+$row->Mei4+$row->Jun4+$row->Jul4+$row->Aug4+$row->Sep4+$row->Okt4+$row->Nov4+$row->Des4;
				?>
				<td><?=number_format($total4)?></td>
				<td><?=number_format($row->Jan5)?></td>
				<td><?=number_format($row->Feb5)?></td>
				<td><?=number_format($row->Mar5)?></td>
				<td><?=number_format($row->Apr5)?></td>
				<td><?=number_format($row->Mei5)?></td>
				<td><?=number_format($row->Jun5)?></td>
				<td><?=number_format($row->Jul5)?></td>
				<td><?=number_format($row->Aug5)?></td>
				<td><?=number_format($row->Sep5)?></td>
				<td><?=number_format($row->Okt5)?></td>
				<td><?=number_format($row->Nov5)?></td>
				<td><?=number_format($row->Des5)?></td>
				<? $total5=$row->Jan5+$row->Feb5+$row->Mar5+$row->Apr5+$row->Mei5+$row->Jun5+$row->Jul5+$row->Aug5+$row->Sep5+$row->Okt5+$row->Nov5+$row->Des5;
				?>
				<td><?=number_format($total5)?></td>
				<td><?=number_format($row->Jan6)?></td>
				<td><?=number_format($row->Feb6)?></td>
				<td><?=number_format($row->Mar6)?></td>
				<td><?=number_format($row->Apr6)?></td>
				<td><?=number_format($row->Mei6)?></td>
				<td><?=number_format($row->Jun6)?></td>
				<td><?=number_format($row->Jul6)?></td>
				<td><?=number_format($row->Aug6)?></td>
				<td><?=number_format($row->Sep6)?></td>
				<td><?=number_format($row->Okt6)?></td>
				<td><?=number_format($row->Nov6)?></td>
				<td><?=number_format($row->Des6)?></td>
				<? $total6=$row->Jan6+$row->Feb6+$row->Mar6+$row->Apr6+$row->Mei6+$row->Jun6+$row->Jul6+$row->Aug6+$row->Sep6+$row->Okt6+$row->Nov6+$row->Des6;
				?>
				<td><?=number_format($total6)?></td>
				<td><?=number_format($row->Jan7)?></td>
				<td><?=number_format($row->Feb7)?></td>
				<td><?=number_format($row->Mar7)?></td>
				<td><?=number_format($row->Apr7)?></td>
				<td><?=number_format($row->Mei7)?></td>
				<td><?=number_format($row->Jun7)?></td>
				<td><?=number_format($row->Jul7)?></td>
				<td><?=number_format($row->Aug7)?></td>
				<td><?=number_format($row->Sep7)?></td>
				<td><?=number_format($row->Okt7)?></td>
				<td><?=number_format($row->Nov7)?></td>
				<td><?=number_format($row->Des7)?></td>
				<? $total7=$row->Jan7+$row->Feb7+$row->Mar7+$row->Apr7+$row->Mei7+$row->Jun7+$row->Jul7+$row->Aug7+$row->Sep7+$row->Okt7+$row->Nov7+$row->Des7;
				?>
				<td><?=number_format($total7)?></td>


			
		
			<?endforeach?>
	</tr>		
			
				 
				
				
				
				
				
				
			
			
					
			
					
			
			
		
				
			
			
			
		
		
		
	
	

</table>

