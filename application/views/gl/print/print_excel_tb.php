<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=TrialBalanced.xls");
header("Pragma: no-cache");
header("Expires: 0");

$pt			= "PT. GRAHA MULTI INSANI";
$judul 		= "TRIAL BALANCED";
$periode	= "Periode";

extract(PopulateForm());

$tgly = date('Y-m-d',strtotime($tgl));
$tglz = date('Y-m-d',strtotime($tgl2));
	

$data = $this->db->query("sp_listtrbal_periode '".$print."','".$tgly."','".$tglz."'")->result();

//~ $nmacc1 = $this->db->select('acc_name')->where('acc_no',$acc_no)->get('db_coa')->row();
//~ $nmacc2 = $this->db->select('acc_name')->where('acc_no',$acc_no2)->get('db_coa')->row();



$i= 0;
$saldo = 0;
$totbalancebase = 0;
$totdb_base = 0;
$totcr_base = 0;
$tota = 0;



?>

<table border="0">
	<tr>
		<td colspan='6'><font size='5'><b><?=$pt?></b></font></td>
	</tr>
	<tr>
		<td colspan='6'><font size='3'><b><?=$judul?></b></td>
	</tr>
	<tr>
		<td colspan='6'><font size='3'><b><?=$periode.' :'.$tgly.' s/d '.$tglz?></b></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	
	

	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		
		<td><b>Account No.</b></td>
		<td><b>Account. Name</b></td>
		<td><b>Opening Balanced</b></td>
		<td><b>Debit</b></td>
		<td><b>Credit</b></td>
		<td><b>Ending Balanced</b></td>
		
		
	</tr>
	

<?php 


foreach($data as $rows):


$a = ($rows->balance_base + $rows->db_base) - $rows->cr_base; 
?>
	<tr>
		
		<td align='left'><b><?=$rows->acc_no?></b></td>

		<td><b><?=$rows->acc_name?><b></td>
		<td><b><?=number_format($rows->balance_base)?><b></td>
		<td><b><?=number_format($rows->db_base)?><b></td>
		<td><b><?=number_format($rows->cr_base)?><b></td>
		<td><b><?=number_format($a)?><b></td>
	
	</tr>	

<?endforeach?> 

		
			
			 <? $balance1 = "select sum(balance_base) as a from db_trlbal_periode 
					inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					where db_trlbal_periode.type=2";
					
					  $balance = $this->db->query($balance1)->row();     

					
			$closing1  = "select (sum(balance_base)+ sum(db_base) - sum(cr_base)) as b from db_trlbal_periode 
					inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					where db_trlbal_periode.type=2";
					
					$closing = $this->db->query($closing1)->row();     
					
					
					
			$debet1   =	"select sum(db_base) as c from db_trlbal_periode 
					 inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					 where db_trlbal_periode.type=2";
					 
					 $debet = $this->db->query($debet1)->row();     

					 
					 
			$credit1=	"select sum(cr_base)  as d from db_trlbal_periode 
					 inner join db_coa on db_coa.acc_no=db_trlbal_periode.acc_no
					 where db_trlbal_periode.type=2";			 
					 
					 $credit = $this->db->query($credit1)->row();     
			

?>

			<tr>
				<td colspan='2' align='right'><b>Sub Total</b></td>
				<td><b><?=number_format($balance->a)?></b></td>
				<td><b><?=number_format($debet->c)?></b></td>
				<td><b><?=number_format($credit->d)?></b></td>
				<td><b><?=number_format($closing->b)?></b></td>
				
			</tr>
			<tr>
				<td>&nbsp;</td>
				
			</tr>



	
</table>
