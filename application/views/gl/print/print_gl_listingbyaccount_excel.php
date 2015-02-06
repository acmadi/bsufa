<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=GL.xls");
header("Pragma: no-cache");
header("Expires: 0");

$pt			= "PT. GRAHA MULTI INSANI";
$judul 		= "General Ledger";
$periode	= "Periode";

			extract(PopulateForm());
				$tglx = date('M-Y',strtotime($tgl1));
				$tgly = date('M-Y',strtotime($tgl2));
				#die($tglx);
				$tglsatu = explode('-',$tgl1);
				$a = $tglsatu[1].$tglsatu[2];
				#die($a);
				
				$tgldua = explode('-',$tgl2);
				$b = $tgldua[1].$tgldua[2];

$data = $this->db->query("sp_printgeneralledgeracc2 '".$a."','".$b."','".$project_detail."','".inggris_date($tgl1)."','".inggris_date($tgl2)."','".$acc_no."','".$acc_no2."'")
									->result();

$nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
$nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();



$i= 0;
$saldo = 0;
$totdebit = 0;
$totcredit = 0;
$totsaldo = 0;






?>

<table border="0">
	<tr>
		<td colspan='6'><font size='5'><b><?=$pt?></b></font></td>
	</tr>
	<tr>
		<td colspan='6'><font size='3'><b><?=$judul?></b></td>
	</tr>
	<tr>
		<td colspan='6'><font size='3'><b><?=$periode.' :'.$tgl1.' s/d '.$tgl2?></b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	
	
	<tr>
		<td colspan='6'><font size='3'><b>From Account : <?=$acc_no.'  '.$nmacc1->acc_name?></b></td>
		
	</tr>
	<tr>
		<td colspan='6'><font size='3'><b>To Account : .<?=$acc_no2.'   '.$nmacc2->acc_name?></b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
<!--
		<td>Trans. Date</td>
-->
		<td><b>Account No.</b></td>
		<td><b>Acc. Name</b></td>
		<td><b>Description</b></td>
		<td><b>Debit</b></td>
		<td><b>Credit</b></td>
		<td><b>Saldo</b></td>
		
		

		
		
		
	</tr>
	

<?php 


foreach($data as $row):


$nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
	$nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();

//$persen = ($row->pay / $row->selling_price) * 100;
?>
	<tr>
		
		<td><b><?=$row->acc_no?></b></td>

		<td colspan='2'><b><?=$row->acc_name?><b></td>
		<td colspan='3'><b>Begining Balance<b></td>
		
		
	</tr>	
	
<?php 

$data2 = $this->db->query("sp_printgeneralledgeracc '".$a."','".$b."','".inggris_date($tgl1)."','".inggris_date($tgl2)."','".$row->acc_no."'")->result();


			foreach($data2 as $rows):?>
			<tr>
					
					<td><?=indo_date($rows->trans_date)?></td>

					<td><?=$rows->voucher?></td>
					<td><?=$rows->line_desc?></td>
					<td><?=number_format($rows->debit)?></td>
					<td><?=number_format($rows->credit)?></td>
					
					<? $saldo = $saldo + ($rows->debit - $rows->credit);  ?>
					<? $totdebit = $totdebit + $rows->debit;  ?>
					<? $totcredit = $totcredit + $rows->credit;  ?>
					<? $totsaldo = $totsaldo + $saldo;  ?>
					<td><?=$saldo?></td>
					
				</tr>	


			<?endforeach ?>

			<tr>
				<td colspan='3' align='right'><b>Sub Total</b></td>
				<td><b><?=number_format($totdebit)?></b></td>
				<td><b><?=number_format($totcredit)?></b></td>
				<td><b><?=number_format($totsaldo)?></b></td>
			</tr>



<?
$i++;
endforeach ?>

	
</table>
