<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=GLbyVoucher.xls");
header("Pragma: no-cache");
header("Expires: 0");

$pt			= "PT. GRAHA MULTI INSANI";
$judul 		= "JOURNAL TRANSACTION LISTING";
$periode	= "Periode";

			extract(PopulateForm());
				

$rows= $this->db->query("sp_printgeneralledger2 '".inggris_date($tgl)."', '".inggris_date($tgl2)."','".$project_detail."'")
							 ->result();

//~ $nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
//~ $nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();



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
		<td colspan='6'><font size='3'><b><?=$periode.' :'.$tgl.' s/d '.$tgl2?></b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	
	

	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Trans. Date</td>
		<td><b>Account No.</b></td>
		<td><b>Acc. Name</b></td>
		<td><b>Description</b></td>
		<td><b>In Base Currency</b></td>
		
	<tr>
		<td colspan='3'>&nbsp;</td>
		<td><b>Debit</b></td>
		<td><b>Credit</b></td>
	</tr>		
		

		
		
		
	</tr>
	

<?php 


foreach($rows as $row):


//~ $nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
	//~ $nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();

//$persen = ($row->pay / $row->selling_price) * 100;
?>
	<tr>
		
		<td><b><?=inggris_date($row->trans_date)?></b></td>

		<td><b><?=$row->voucher?><b></td>
		<td><b><?=$row->desc?><b></td>
		
		
	</tr>	
	
<?php 
$voucher = $row->voucher;
$data2 = $this->db->query("sp_printgeneralledger '".$voucher."'")->result();

$totdebit=0;
$totcredit=0;			


			foreach($data2 as $sql):
					$totdebit = $totdebit + $sql->debit;
					$totcredit = $totcredit + $sql->credit;?>
			<tr>
					
					<td><?=$sql->acc_no?></td>

					<td><?=$sql->acc_name?></td>
					<td><?=$sql->line_desc?></td>
					<td><?=number_format($sql->debit)?></td>
					<td><?=number_format($sql->credit)?></td>
					
					
					
				</tr>	


			<?endforeach ?>

			<tr>
				<td colspan='3' align='right'><b>Sub Total</b></td>
				<td><b><?php if ($totdebit < 0) {
								echo number_format($totdebit*-1);
							} else {
								echo number_format($totdebit);
							}
				 ?></b></td>
				<td><b><?php if ($totcredit < 0) {
								echo number_format($totcredit*-1);
							} else {
								echo number_format($totcredit);
							}
				
				?></b></td>
				
			</tr>
			<tr>
				<td>&nbsp;</td>
				
			</tr>


<?
$i++;
endforeach ?>

	
</table>
