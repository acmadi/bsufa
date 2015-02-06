<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.ui.core.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.ui.widget.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.number_format.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/validationEngine.jquery.css" type="text/css" />
<script type="text/javascript">
 function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('sales/paycustomer/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			// $('#'+type).append('<option>ALL</option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 $('#unid').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }




$(function(){
	$(document).ready(function(){
		$('#payun').hide();	
		$('.xhide').hide();
		$('.yhide').hide();	
		$('.zhide').hide();	
		$('.chide').hide();	
		$('.payhide').hide();
		$('.unpayhide').hide();	
		$('.sourcehide').hide();
		$('#komisi').hide();
		$('.nhide').hide();
	});
	
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();
	
	$( ".datepicker" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat : 'dd-mm-yy',
		yearRange : '1940 : 2030'	
	});
	
	
	$('#pay').bind('keyup keypress',function(){
			var kugiri = new RegExp(",", "g");
			var am  =  parseInt($('#amount').val().replace(kugiri,""));
			var pay =  parseInt($(this).val().replace(kugiri,""));
			var xblc =  parseInt($('#xblc').val().replace(kugiri,""));
			var blc = xblc - pay;
			
			if($('#transfer option:selected').val() == 3) {
				var unamount = parseInt($('#unamount').val().replace(kugiri,""));				
				if(pay > unamount) alert("Tidak boleh lebih besar dari unidentified");
			}
			$('#blc').val(numToCurr(blc));
	});
	
	$('#transfer').change(function(){
		if($('#transfer option:selected').val()==1){
			$('.zhide').show();
			$('.chide').hide();
			$('.payhide').show();
			$('.sourcehide').hide();
		}else if($('#transfer option:selected').val()==2){
			//alert("test");
			$('.sourcehide').hide();
			$('.zhide').hide();
			$('.chide').show();
			$('.payhide').show();
		}else if($('#transfer option:selected').val()==4){
			//alert("test");
			$('.zhide').show();
			$('.chide').hide();
			$('.payhide').show();
			$('.sourcehide').hide();
		}else{
			$('.sourcehide').show();
			$('.zhide').hide();
			$('.chide').hide();
			$('.payhide').hide();			
		}		
	});
	
	$("input:checkbox").click(function(){
		if($("input:checkbox:checked").val()==1) {
			$('#komisi').show();
		}else{
			$('#komisi').hide();
		 }
	});
	
	$("#payun").change(function(){
		
	});
	
	
	$('#cara').change(function(){
		if($('#cara option:selected').val()==1){
			$('.xhide').hide();
			$('.yhide').show();
			$('.payhide').show();
			$('.nhide').hide();
		}else{
			$('.xhide').show();
			$('.yhide').hide();
			$('.chide').hide();
			$('.payhide').show();
			$('.nhide').show();			
		}
	});
	
	//Cek tipe
	$('#tipecek').change(function(){
		$('.sourcehide').show();
	});
	
	//Cek data
	$('#sid').change(function(){
		loadData('unid',$('#sid option:selected').val());	
		if($('#sid option:selected').val()==1){
			$('.unpayhide').hide();
		}else{
			$('.unpayhide').show();
		}			
	});
	
	$('.nhide').change(function(){
		$('.chide').show();
		//alert("test");
	});
	
	//Cek Unid
	$('#unid').change(function(){
		$('.payhide').show();
		var id = $('#unid').val();
		$.getJSON('<?=site_url('sales/paycustomer/cek_data')?>/'+id,
			function(response){
				$('#unamount').val(numToCurr(response.amount));
				$('#bankun').val(response.bank_nm);
				$('#xpayun').val(response.pay_unidenti);
			});
	});		
	
	$('#formAdd')
	.validationEngine()
	.ajaxForm({
	success:function(response){
		if(response == "sukses"){
			var bill = $('#idbill').val();
			alert("Payment Berhasil dibayar");
			setTimeout("location.reload(true);",1500);
			window.open("<?=site_url('sales/paycustomer/kwtcust')?>/"+bill+"");			
			refreshTable();
		}else{
			alert(response);
		}	
	  }		
	});		
	
});
</script>
		<?php
			$blc = number_format($bill->amount - $bill->pay_amount);
		?>
<form method="post" action="<?=site_url('sales/paycustomer/updatebill')?>" id="formAdd">
<table border="0" cellspacing="2" cellpadding="2">
	
	<tr>
		<input type="hidden" name="idbill" id="idbill" value="<?=$bill->id_billing?>"/>
		<input type="hidden" name="xblc" id="xblc" value="<?=$blc?>" maxlength="20"/>
		<input type="hidden" name="xpay" id="xpay" value="<?=$bill->pay_amount?>"/>
		<input type="hidden" name="xpayun" id="xpayun"/>		
		<td>Pay Date</td>
		<?php $tgl = date("d-m-Y");?>
		<td>:</td>
		<td><input name="paytgl" value="<?=$tgl?>" class="xinput datepicker" readonly /></td>
	</tr>
	<tr>
		<td>Billing No.</td>
		<td>:</td>
		<td><input name='nobill' value="<?=$no?>" id="bill" style="width:80px" readonly /></td>
	</tr>
	<tr>
		<td>Payment Type</td>
		<td>:</td>
		<td>
			<select name='cara' id="cara" class="xinput">
				<option selected ></option>
				<?php foreach($cara as $row): ?>
					<option value="<?=$row->payjns_id?>">
						<?=$row->payjns_nm?>
					</option>
				<?php endforeach; ?>
			</select>
		</td>
		<td class="yhide" colspan="2">
			<select name="transfer" id="transfer" class="xinput">
				<option></option>
				<?php foreach($source as $row):?>
					<option value="<?=$row->paysource_id?>"><?=$row->paysource_nm?></option>
				<?php endforeach;?>				 
			</select>
		</td>
		<td class="nhide" colspan="2">
			<select name="xtransfer" id="xtransfer" class="xinput">
				<option></option>
				<?php foreach($cekbank as $row): ?>
					<option value="<?=$row->bankcek_id?>">
						<?=$row->bankcek_nm?>
					</option>
				<?php endforeach; ?>
			</select>
		</td>					
	</tr>
	<!--tr class='xhide'>
		<td>COA</td>
		<td>:</td>
		<td>
			<select name='bank' id="bank" class="xinput validate[required]">
				<?php foreach($coa as $row): ?>
					<option value="<?=$row->kodeacc?>"><?=$row->kodeacc?>{<?=$row->namaacc?>}</option>
				<?php endforeach ?>
			</select>
		</td>
	</tr-->
	<!--tr class="xhide">
		<td>Source</td>
		<td>:</td>
		<td>
			<select name='tipecek' id="tipecek" class="xinput validate[required]">
					<option></option>
				<?php /*foreach($cek as $row): ?>
					<option value="<?=$row->paytipecek_id?>"><?=$row->paytipecek_nm?></option>
				<?php endforeach */?>
			</select>
		</td>
	</tr-->
	<tr class="sourcehide">
		<td>Unidentified Type</td>
		<td>:</td>
		<td>
			<select name='sid' id="sid" class="xinput">
				<option></option>
				<?php foreach($unsource as $row):?>
					<option value="<?=$row->paysource_id?>"><?=$row->paysource_nm?></option>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr class="sourcehide">
		<td>Payment Unidentified</td>
		<td>:</td>
		<td>
			<select name='unid' id="unid" class="xinput"></select>
		</td>
	</tr>
	<tr class="sourcehide">
		<td>Amount</td>
		<td>:</td>
		<td><input type="text" name="unamount" id="unamount" class="input" readonly/></td>
	</tr>	
	<tr class="sourcehide">
		<td>Bank</td>
		<td>:</td>
		<td><input type="text" name="bankun" id="bankun" readonly/></td>
	</tr>
	<tr class="unpayhide">
		<td>Charge Amount</td>
		<td>:</td>
		<td><input type="text" name="charge" id="charge" class="input calculate validate[required]"/></td>
	</tr>
	<tr class='zhide'>
		<td>Bank</td>
		<td>:</td>
		<td>
			<!--input type="text" name="bnk" id="bnk" readonly  value="Bank Tabungan Negara" /-->
			<select name="acc">
				
				<?php #var_dump($account);exit;
					foreach($account as $row):?>
					<option value="<?=$row->bank_id?>"><?=$row->bank_nm?></option>
				<?php endforeach;?>
				
			</select>
		</td>
	</tr>	
	<!--tr class='zhide'>
		<td>Account</td>
		<td>:</td>
		<td>
			<input type="text" name="acc" id="acc" value="00241-01-30-000321-9" readonly />
		</td>
	</tr-->
			
	<!--tr class="xhide">
		<td>Acc. Bank</td>
		<td>:</td>
		<td><input name='acc' id="acc" class="xinput validate[required]"/></td>	
	</tr>
	<tr class="xhide">
		<td>Branch. Bank</td>
		<td>:</td>
		<td><input name='cbg' id="cbg" class="xinput validate[required]"/></td>	
	</tr>
	<tr class="xhide">
		<td>Refrensi</td>
		<td>:</td>
		<td><input name='an' id="an" class="xinput validate[required]"/></td>	
	</tr-->
	<tr>
		<td>Bill Amount</td>
		<td>:</td>
		<td><input name='amount' type="text" id="amount" class="xinput" style="text-align:right" value="<?=$blc?>" readonly /></td>
	</tr>		
	<tr class='payhide'>
		<td>Payment Amount</td>
		<td>:</td>
		<td>
			<input name="pay" type="text" maxlength="15" id="pay" class="xinput calculate validate[required]" style="text-align:right" />
			
		</td>		
		<!--td><input type="checkbox" name="un" value="1"/></td>
		<td>Unidentified</td-->
	</tr>
	<tr class='payhide'>
		<td>Biaya Adm</td>
		<td>:</td>
		<td>
		<input name="adm" type="text" maxlength="15" id="adm" value=0 class="xinput calculate validate[required]"  style="text-align:right" />
		</td>
		<!--td><input type="checkbox" name="un" value="1"/></td>
		<td>Unidentified</td-->
	</tr>
	<tr class='chide'>
		<td>Charge</td>
		<td>:</td>
		<td>
			<input type="text" name="charge" id="chide"  class="calculate validate[required]"  style="text-align:right"/>
		</td>
	</tr>
	
	<tr class='payhide'>
		<td align="left">Commision<input type="checkbox" name="un" value="1" width="1px"/></td>
		<td>:</td>
		<td>
			<input name="komisi" type="text" maxlength="15" id="komisi" class="xinput calculate" style="text-align:right"  value="2,000,000" readonly />
		</td>
		<td><!--input type="checkbox" name="un" value="1"/--></td>
	</tr>
	<tr>
		<td>Balanced Amount</td>
		<td>:</td>
		<td><input name="blc" id="blc" style="text-align:right" class="xinput" value="<?=$blc?>" readonly /></td>
	</tr>
	<tr class='payhide'>
		<td>Remark</td>
		<td>:</td>
		<td><textarea name="remark" id="remark" class="xinput validate[required]"></textarea></td>		
	</tr>
	<tr class='payhide'>
		<td>Description</td>
		<td>:</td>
		<td><textarea name="descs" id="descs" value='-' ></textarea></td>		
	</tr>
	<tr>
		<td>Unit</td>
		<td>:</td>
		<td><input type="text" value="<?=$cekcust->unit_no?>" readonly /></td>		
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><input type="text" value="<?=$cekcust->customer_nama?>" readonly /></td>		
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td><input type="text" value="<?=$bay?>" readonly /></td>		
	</tr>
</table>	
	<input type="submit" name="save" value="Pay Bill" style="width:100px"/>
	<input type="reset" name="cancel" value="Cancel" style="width:100px"/>	

</form>
