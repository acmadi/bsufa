
<?#=script('jquery.tabs.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<?=script('jquery.edatagrid.js')?>
<?=script('currency.js')?>
<?=script('jquery.numeric.js')?>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">
<!--<script language="javascript" src="<?=site_url()?>assets/js/jquery-1.6.minx.js"></script>-->
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.formx.js"></script>
<?=script('datagrid-detailview.js')?>
<?=script('currency.js')?>

<?php
	$saldo = $this->db->query("select top(1) saldo_mptcash from master_pettycash order by id_mptcash desc")->result();
	$nomor = $this->db->query("select top(1) nomor_mptcash from master_pettycash order by id_mptcash desc")->result();
	
	if($nomor){
		$e = explode("/",$nomor[0]->nomor_mptcash);
		$a = $e[3] + 1;
		if($a<10){
			$nomor = "PC/".date('d/Y/')."0000".$a;
		}else if($a>=10 and $a<100){
			$nomor = "PC/".date('d/Y/')."000".$a;
		}else if($a>=100 and $a<1000){
			$nomor = "PC/".date('d/Y/')."00".$a;
		}else if($a>=1000 and $a<10000){
			$nomor = "PC/".date('d/Y/')."0".$a;
		}else{
			$nomor = "PC/".date('d/Y/').$a;
		}
	}else{
		$nomor = "PC/".date('d/Y/')."00001";
	}
?>


<script language="javascript">
	$(function(){
		$.validationEngineLanguage.allRules['ajaxValidateNip'] = {
			"url": "<?=site_url('tblkary/ceknip')?>",
	        "alertText": "*This name is already taken",
	        "alertTextOk": "This name is avaliable",
	        "alertTextLoad": "* Validating, please wait"
	     };
		 
		 $('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			var saldo = parseInt($('#saldo').val().replace(rep_coma,""));
			var total = amount+saldo;
			var nilai = 5000000;
					if($("#type option:selected").val()==1){
					if (saldo <  amount) {	
                              alert('Nilai Reimburse lebih besar daripada Saldo Petty Cash');
							  $('#amount').val(0);
							}	else
							 if (total > 5000000){
								alert('Nilai Harus 5.000.000');
							  $('#amount').val(0);
			
							}else
							if (amount>nilai){
							alert('Nilai Harus 5.000.000');
							  $('#amount').val(0);
			
							}
			}else {
			if (saldo <  amount) {
					
                              alert('Nilai Reimburse lebih besar daripada Saldo Petty Cash');
							  $('#amount').val(0);
							}	
							//else
							 // if (total > 5000000){
								// alert('Nilai Harus 5.000.000');
							  // $('#amount').val(0);
			
							// }else
							// if (amount>nilai){
							// alert('Nilai Harus 5.000.000');
							  // $('#amount').val(0);
			
							// }
							}
			
			});	
	     
		// $('#formAdd')
		// .validationEngine()
		// .ajaxForm({
			// success:function(response){
				// alert(response);
				// refreshTable();
				// //$('#btnReset').click();
			// }
		// });
	});
	
	$('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kodecash',  
        textField:'kodecash',  
        url:'pettycash/cashflow',  
        columns:[[  
            {field:'kodecash',title:'kodecash',width:100},  
            {field:'nama',title:'nama',width:200},  

        ]]  
    });  
	
				$('#formAdd')
		//.validationEngine()
		.ajaxForm({
			success:function(response){
				//alert(response);
				if(response=="sukses"){
					alert(response);
					refreshTable();
				}else{
					alert(response);
				}
			}
		});			
		
		$('#type').change(function(){
				if($("#type option:selected").val()==1){

				//$('#cc').attr('readOnly',true);
				 $('#cc').combogrid('disable');

				$.getJSON('<?=site_url('pettycash/getsaldo')?>/'+$(this).val(),
							function(data){
								
								$("#saldo").val(numToCurr(data.saldo));
							});
				
				}
				else
				{

					 $('#cc').combogrid('enable');
					$.getJSON('<?=site_url('pettycash/getsaldo')?>/'+$(this).val(),
							function(data){
								
								$("#saldo").val(numToCurr(data.saldo));
							});
				
	
				}
				
				
				// $.getJSON('<?=site_url('jurnaltransfer/getaccname')?>/'+$(this).val(),
							// function(data){
								
								// $("#acc_name").val(data.acc_name);
							// });
				
				});
	

</script>

<?php
$pecah = explode('-', $data->bln_mptcash);
switch ($pecah[1]) {
	case '1':
		$bln = 'Januari';
		break;

	case '2':
		$bln = 'Februari';
		break;

	case '3':
		$bln = 'Maret';
		break;

	case '4':
		$bln = 'April';
		break;

	case '5':
		$bln = 'Mei';
		break;

	case '6':
		$bln = 'Juni';
		break;

	case '7':
		$bln = 'Juli';
		break;

	case '8':
		$bln = 'Agustus';
		break;

	case '9':
		$bln = 'September';
		break;

	case '10':
		$bln = 'Oktober';
		break;

	case '11':
		$bln = 'Nopember';
		break;

	case '12':
		$bln = 'Desember';
		break;
}
?>

<form id="formAdd" action="<?=site_url()?>mpettycash/edit_saldo/<?=$data->id_mptcash;?>" method="post" >
<table>
	<tr>
		<td colspan='3'><font color='red'><b>MASTER PETTY CASH</b></font></td>
		<td colspan='3'>&nbsp;</td>
	</tr>
	<tr>
		<td>Nomor</td>
			<td>:</td>
			<td><input type="text" name="nomor_mpt" class="validate[required] xinput" id="claim_no"value="<?=$data->nomor_mptcash;?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Bulan</td>
			<td>:</td>
			<td>
			<select name="bln_mptcash" id="bln_mptcash">
				<option value="<?php echo $pecah[1];?>"><?php echo $bln;?></option>
				<option value='01'>Januari</option>
				<option value='02'>Februari</option>
				<option value='03'>Maret</option>
				<option value='04'>April</option>
				<option value='05'>Mei</option>
				<option value='06'>Juni</option>
				<option value='07'>Juli</option>
				<option value='08'>Agustus</option>
				<option value='09'>September</option>
				<option value='10'>Oktober</option>
				<option value='11'>Nopember</option>
				<option value='12'>Desember</option>
			</select> <?=date('Y');?>
			</td>
	</tr>	
	<tr>
		<td>Amount</td>
			<td>:</td>
			<td><input type="text" name="amount" class="calculate input validate[required]" id="amount" value="<?=number_format($data->amount_mptcash);?>"  size="30" /></td>
			<td>Sisa Saldo</td>
			<td>:</td>
			<td><input type="text" name="saldo" class="calculate input validate[required]" readonly="true" value="<?=@number_format($saldo[0]->saldo_mptcash);?>"  size="30" /></td>
	</tr>
	<tr>
		<td>Description</td>
			<td>:</td>
			<td><input type="text" name="petty_desc" class="validate[required] xinput" id="petty_desc" value="<?=$data->deskripsi?>"  size="30" /></td>
	</tr>
	<tr>	
		<td></td>
		<td></td>
		<td>
			<input type="submit" value="Save" />
			<input type="button" id="btnClose" value="Cancel" />
		</td>
	</tr>
	</table>
</form>
