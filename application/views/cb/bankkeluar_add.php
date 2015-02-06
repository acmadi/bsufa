<html>
<head>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<?=script('jquery.formx.js')?>
<?=script('currency.js')?>
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>
<script type="text/javascript">	
	var totrow = parseInt($('#total_row').val());
	
	<?php for($a = 1;$a <= 50; $a++){?>
		$('#acc_cash<?php echo $a;?>').autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>cb/bankkeluar/getcoacash",
				data: { term: $('#acc_cash<?php echo $a;?>').val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$('#cash_name<?php echo $a;?>').val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$('#acc_cash<?php echo $a;?>').val(coa[0]);
		},
		minLength: 1
	});
	<?php } ?>
	$(function(){
	
$("#apno").change(function(){
	//alert('tes');
	//$('#amount').val(0);
			$.getJSON('<?=site_url()?>/bankkeluar/getdata/' + $(this).val(),
			function(getdata){				
				$('#total_billing').val(numToCurr(getdata.MBASE_AMT));
				$('#paid_billing').val(numToCurr(getdata.MALLOC_AMT));
				$('#balance').val(numToCurr(getdata.MBAL_AMT));
				$('#remark').val((getdata.DESCS));
				$('#amount').val(numToCurr(getdata.amount));
				$('#alamat').val(getdata.alamat);
				$('#nm_supplier').val(getdata.nm_supplier);
			});	
		});	
		});	

		$('.calculate').bind('keyup keypress',function(){
			var rep_coma = new RegExp(",", "g");
			$(this).val(numToCurr($(this).val()));			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
					var balance = parseInt($('#balance').val().replace(rep_coma,""));
		
					if (amount > balance) {
					
                              alert('Nilai Amount lebih besar daripada Nilai Balance');
							  $('#amount').val(0);
							}
					else  {
							}
			});	
			

</script>
</head>
<form id="formAdd" method="post" action="<?=site_url('cb/bankkeluar/saveheader')?>">
 <?php $tgl = date('m/d/Y'); ?>
<body>
	<table>
	<tr>
	<td colspan="6">
	<h2>PAYMENT</h2>		
	</td>
	</tr>

	<tr>
		<td>Voucher</td>
			<td>:</td>
			<td><input style="width:220px;border:1px solid lightgray;padding:3px" type="text" name="voucher" id="voucher" class="validate[required] xinput" value="<?php echo $nobk; ?>" class="validate[required]" size="30" /></td>
		<td>Trans Date</td>
			<td>:</td>
			<td>
			<input id="tgl" name="tgl" class="easyui-datebox" value="<?=$tgl?>" size="30" style="width:220px;border:1px solid lightgray;padding:3px"></input>
			</td>
					

			
	</tr>
	<script>
	$('.memo').hide();
	$('.bank').show();
	$('#paid').change(function(){
	var paid = $(this).val();
	if(paid == 'Non Cash'){
	$('.memo').show();
	$('.bank').hide();
	}else{
	$('.memo').hide();
	$('.bank').show();
	}
	});
	</script>
	<tr>
		<td>Tagihan AP</td>
			<td>:</td>			
			<td>
                        <input type="text" name="apno" id="apno" value="<?php echo $row->doc_no;?>" style="width:220px;border:1px solid lightgray;padding:3px">
                        <input type="hidden" name="id_plan" id="id_plan" value="<?php echo $row->id_plan;?>">
			</td>
		<td>Cara Bayar</td>			
			<td>:</td>
			<td>
			<select name='paid' id="paid" style="width:220px;border:1px solid lightgray;padding:3px">
			<option value='Cash'>Cash</option>
			<option value='Non Cash'>Non Cash</option>
			</select>
			</td>			
	</tr>
	<script>
	$('#proj').change(function(){
	var proj = $(this).val();
	$.post('<?php echo base_url();?>cb/bankkeluar/get_bank/'+proj,function(obj){
	$('#bank').html(obj);
	});
	});
	</script>
	<tr>
		<td>Nama Supplier</td>
			<td>:</td>
			<td><input style="width:220px;border:1px solid lightgray;padding:3px" type="text" name="nm_supplier" id="nm_supplier" readonly="readonly" size="30" value="<?php echo $row->nm_supplier;?>"/></td>
		<td class="bank">Project</td>
			<td class="bank">:</td>
			<td class="bank"> <input type="hidden" name="amount" value="<?php echo $row->base_amt;?>"> 
				 <input type="hidden" name="project" value="<?php echo $row->project_no;?>"> 
					<select name="proj" id="proj" style="width:220px;border:1px solid lightgray;padding:3px">
					<option></option>
					<?php 
					$query = $this->db->query("select * from project where judul = 'N' and pt_project = '11' order by nm_project")->result();
					foreach($query as $rob){?>
					<option value="<?php echo $rob->kd_project;?>"><?php echo $rob->nm_project;?></option>
					<?php } ?>
					</select> 
					
		<td class="bank">Bank</td>
			<td class="bank">:</td>
			<td class="bank"> <input type="hidden" name="amount" value="<?php echo $row->base_amt;?>"> 
				 <input type="hidden" name="project" value="<?php echo $row->project_no;?>"> 
					<select name="bank" id="bank" style="width:220px;border:1px solid lightgray;padding:3px">
					<!--option></option>
					<?php foreach($bank as $rob){?>
					<option value="<?php echo $rob->bank_id;?>"><?php echo $rob->bank_nm." | ".$rob->bank_acc;?></option>
					<?php } ?> -->
					</select> 
					<input type="hidden" class="calculate input validate[required]" name="amount" id="amount" value="<?php echo number_format($row->base_amt);?>" size="30" />
            </td>
		<td class="memo">No Memo</td>
			<td class="memo">:</td>
			<td class="memo">
			 <input type="text" name="memo" id="memo" value="" style="width:220px;border:1px solid lightgray;padding:3px">
			</td>
		
	</tr>
	<tr>
		<td>Alamat Supplier</td>
			<td>:</td>			
			<td>
                        <textarea name="alamat" id="alamat" readonly="readonly" style="width:220px;border:1px solid lightgray;padding:3px"><?php echo $row->alamat;?></textarea>        
            </td>
		<td>Remark</td>
			<td>:</td>
			<td><textarea style="width:220px;border:1px solid lightgray;padding:3px" name="remark" id="remark"><?php echo $row->rem; ?></textarea></td>
			
	</tr>
	<tr>
		<td>Jumlah Tagihan</td>
			<td>:</td>			
			<td>
            <input type="text" name="amount" class="calculate" readonly id="amount" value="<?php echo number_format($row->base_amt);?>" style="width:220px;border:1px solid lightgray;padding:3px;text-align:right;background-color:yellow">
			</td>
		<td>Jumlah Bayar</td>
			<td>:</td>
			<td>
			<input type="text" name="byr" id="byr" value="<?php echo number_format($bayar->amount);?>" style="width:220px;border:1px solid lightgray;padding:3px;text-align:right;background-color:red" readonly >
			</td>
		<td>Sisa Pembayaran</td>
			<td>:</td>
			<td>
			<input type="text" name="balance" id="balance" value="<?php echo number_format($row->base_amt-$bayar->amount);?>" style="width:220px;border:1px solid lightgray;padding:3px;text-align:right;background-color:yellow" readonly >
			</td>
				
	</tr>
	<tr>

	<tr>
	<td colspan=10>
		<br>
		<table align="left" border="0">
		<tr align="center" style="background:gray;color:white">
			<td style="padding:5px">No. Akun</td>
			<td style="padding:5px;width:500px">Deskripsi</td>
			<td style="padding:5px">Debet</td>
			<td style="padding:5px">Akun Cash Flow</td>
			<td style="padding:5px">Nama Akun Cash Flow</td>
			<td style="padding:5px">Nilai</td>
		</tr>
		<?php $no = 1; foreach($coa as $rca){?>
		<tr align="center">
			<td><input type="text" name="acc_no<?php echo $no;?>" value="<?php echo $rca->acc_no;?>" style="width:110px;border:1px solid dimgray;padding:3px;background:lightgray" readonly></td>
			<td><input type="text" name="acc_name<?php echo $no;?>" value="<?php echo $rca->acc_name;?>" style="width:500px;border:1px solid dimgray;padding:3px;background:lightgray" readonly></td>
			<td><input type="text" class="calculate" name="acc_debet<?php echo $no;?>" value="<?php echo number_format($rca->debet);?>" style="text-align:right;width:100px;border:1px solid dimgray;padding:3px;background:lightgray" readonly></td>
			<td>
			
			<input type="text" name="kodecash<?php echo $no;?>" id="acc_cash<?php echo $no;?>" style="text-align:right;width:150px;border:1px solid dimgray;padding:3px">
			</td>
			<td>
			<input type="text" name="cashname<?php echo $no;?>" id="cash_name<?php echo $no;?>" style="background:lightgray;text-align:right;width:150px;border:1px solid dimgray;padding:3px" readonly>
			
			</td>
			<td><input type="text" name="amount<?php echo $no;?>" value="<?php echo number_format($bayar->amount);?>" class="calculate" style="text-align:right;width:150px;border:1px solid dimgray;padding:3px"></td>
		</tr>
		<?php $no++; } ?>
		<input type="hidden" name="total_row" id="total_row" value="<?php echo $no-1;?>">
		</table>
	</td>
	</tr>
	</table>
		<tr>
			<td colspan='3'><input type="submit" name="save" value="Simpan"/></td>
			<!--td colspan='3'><input type="reset" name="cancel" value="Cancel"/></td-->
		</tr>
		</form>
</body>

<script type="text/javascript" >

$(document).ready(function() {
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
				//
				//refreshTable();
				//$('#buttonID').click();
			}
		});
});

</script>

</html>
