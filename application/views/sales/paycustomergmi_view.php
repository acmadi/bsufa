<?$this->load->view(ADMIN_HEADER)?>
<?#=script('jquery-1.7.2.min.js')?>
<?#=script('jquery.js')?>
<?=script('thickbox.js')?>
<?#=script('jquery.form.js')?>
<?=link_tag(CSS_PATH.'thickbox.css')?>
<?#=link_tag(CSS_PATH.'main.css')?>
<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script> 
<script language="javascript" src="<?=base_url()?>assets/js/thickbox.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/thickbox.css" type="text/css" /-->

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>

<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.number_format.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/validationEngine.jquery.css" type="text/css" />


<script type="text/javascript">
//~ $(document).ready(function(){
	//~ $('#subjumlah').hide();
//~ 
//~ });	
	
 function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      //$.post('<?=site_url('denda_customer/loaddata')?>', //request ke fungsi load data di inputAP
      $.post('<?=site_url('sales/paycustomergmi/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 //alert(data.length);
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#subproject').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
   
   

   
/*function tampilbill(unitid,cid){
	$.post('<?=site_url('sales/paycustomer/cekunitbill')?>',
		{unitid:unitid,custid:cid},
		function(data){
			//var nil = 3;
			if(data.error == undefined){
				//alert(data.length);
				$('#bill').empty();
				var n = 0;
				for(var x=0;x<data.length;x++){
				//alert(data[x].due_date);
				 
				n = n + 1;
				$('#bill').append("<tr><td style='width:100px'>"+n
				+"</td><td>"+data[x].paygroup_nm+"</td><td>"+data[x].due_date+
				"</td><td>"+data[x].tgl_paydate+"</td><td>"+data[x].amount+
				"</td><td><input name='idbill' type='checkbox' value='"+data[x].id_billing+"'/></td></tr>");
				//alert(data);
				}
			}else{
				alert(data.error);
				$('#bill').text('');
			}
		},'json'
	  );
}*/





$(function(){
	
		
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	}).numeric();
	
	
	loadData('bank',0);	 
	loadData('unid',0);	 
	loadData('subproject',0);	
	$('#subproject').change( 
		function(){
			if($('#unit option:selected').val() != '')
				loadData('unit',$('#subproject option:selected').val());				
		}
	);
	
	$(document).ready(function(){
		$('#link').attr('disabled',true);
		$("#terima1").hide();
		$("#terima2").hide();
		$("#charge").hide();
		$('.sourcehide').hide();
		
		
	});
	

		$('#unit').change( 
		function(){
			//var custid = $('#').val();
			//tampilbill($(this).val(),);
			var proj = $('#subproject option:selected').val() 
			$.getJSON('<?=site_url('sales/paycustomergmi/cekbilling')?>/'+$(this).val()+'/'+proj,
			function(data){
				//tampilbill(data.unit_id,data.customer_id)
				$('#customername').val(data.customer_nama);
				$('#hp').val(data.customer_hp);
				$('#alamat').val(data.customer_alamat1);
				$('#customerid').val(data.customer_id);
			
			});
		}
	);
	
	 $.fn.datebox.defaults.formatter = function(date) {
                        var y = date.getFullYear();
                        var m = date.getMonth() + 1;
                        var d = date.getDate();
                        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
            };
	
	$('#tgl').datebox({  
        required:true  
    });
	
	$('#tgl1').datebox({  
        required:true  
    });
	
	$("#tipe").change(function(){
				if($("#tipe option:selected").val()==3){
					$("#charge").show();
					$("#terima1").show();
					$("#terima2").show();
		
				}else{
					$("#charge").hide();
					$("#terima1").hide();
					$("#terima2").hide();
				}
				
		})
		
	$("#bank").change(function(){
	//loadData('unid',$('#sid option:selected').val());	
				if($("#bank option:selected").val()==32){
					$(".sourcehide").show();
			
				}else{
					$('.sourcehide').hide();

				}
				
		})
		
	$('#unid').change(function(){
		var id = $('#unid').val();
		$.getJSON('<?=site_url('sales/paycustomergmi/cek_data')?>/'+id,
			function(response){
				$('#amount').val(numToCurr(response.amount));

			});
	});		
    
    
     

});



 //$(document).ready(function () {

      
	//});






//~ var os 		= $('#os').val();
//~ var payment = $('#payment').val();

//~ function target_popup(form) {
    //~ window.open('', 'formpopup', 'width=400,height=300,top=200,left=200,directories=no,location=no,menubar=no,scrollbars=no,status=no,toolbar=no,resizable=no');
    //~ form.target = 'formpopup';
//}
</script>



<h2 id='frame0'>Payment Bill<hr width="150px" align="left"></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>sales/paycustomergmi/tampilbill" onsubmit="target_popup(this)">
<input type="hidden" name="customerid" id="customerid"/>
<table>
	<tr id='frame1'>
		<td>Project</td>
			<td>:</td>
				<td>
					<select name="subproject" id="subproject" class="xinput"></select>
				</td>
		
		<td>Received Date</td>
			<td>:</td>
			<td><input type="text" name="tgl" id="tgl"  style="width:120px"></td>		
			
		<td>Bank/Adj</td>
			<td>:</td>
				<td><select name='bank' id='bank'></td>

					
		

	</tr>
	
	<tr id='frame2'>
		<td>Unit</td>
			<td>:</td>
				<td><select name='unit' id='unit' class='xinput'></select></td>
				
		<td>Amount</td>
			<td>:</td>
				<td><input name='amount' id='amount' class="input calculate validate[required]"></td>
		
					
		<!--<td>Komisi MKT</td>
			<td>:</td>
				<td><input type="hidden" name="cekkomisi" id='cekkomisi' value="0" /> <input type="checkbox" name="cekkomisi" id='cekkomisi' value="1" /></td>
		-->		
				
		
	
	</tr>
	
	<tr id='frame3'>
		<td>Customer</td>
			<td>:</td>
				<td><input name='customername' id='customername' class='xinput' readonly /></td>
				
		<td>Type</td>
			<td>:</td>
				<td><select name='tipe' id='tipe' class='xinput'>
					<option></option>
					<option value=1>Cash</option>
					<option value=2>Transfer</option>
					<option value=3>Credit Card</option>
					<option value=4>Check</option>
					<option value=5>Giro</option>
					<option value=6>Non Cash</option>
					</select></td>
	
	<td id ="terima2">Charge</td>
			<td id ="terima1">:</td>
			<td><input type="text" name="charge" id="charge"  class="validate[required] xinput" value="0" /></td>
	</tr>
	<tr id='frame4'>
		<td colspan='3'>&nbsp;</td>
		<td>No.Reff</td>
			<td>:</td>
				<td><input name='reff'></td>
	</tr>
	
	<tr class="sourcehide">
		<td>Payment Unidentified</td>
		<td>:</td>
		<td>
			<select name='unid' id="unid" class="xinput"></select>
		</td>
		</tr>
	
	
	
<!--
	<tr>
		<td>Mobile Phone</td>
			<td>:</td>
				<td><input name='hp' id='hp' class='xinput' readonly></td>
	
	</tr>
	
	<tr>
		<td colspan='3'>Address</td>
	</tr>
	<tr>
		<td colspan='4'><textarea name='alamat' id="alamat" readonly></textarea></td>
	</tr>
-->

<tr id='frame5'><td colspan="4"><input type="submit" name="cekbill" value="Payment Billing"/></td></tr>	

</table>	
</form>	
<!-- Cek Billing Number-->

<!--form action="<?#=site_url('sales/paycustomer')?>"  method="post"-->

	<?php 
	$x= 0;
	$subamount = 0;
	$subpay =0;
	$subos = 0;
	if(@$data['cekbill']):
	?>
		<script>
		$(document).ready(function(){
			$('#frame0').hide();
			$('#frame1').hide();
			$('#frame2').hide();
			$('#frame3').hide();
			$('#frame4').hide();
			$('#frame5').hide();
		});	
		</script>
<h2>Payment Bill<hr width="150px" align="left"></h2>
<div class="printed">
<form method="post" id="myform" action="<?=base_url()?>sales/paycustomergmi/bayar" onsubmit="target_popup(this)">
<input type="hidden" name="customerid" id="customerid"/>
<table>		
		<tr id='frame10'>
		<td>Project</td>
			<td>:</td>
				<td>
					<input name='subproject1' value='<?=$data['row']->nm_subproject?>'>
				</td>
		
		<td>Received Date</td>
			<td>:</td>
			<td><input type="text" name="tgl1" id="tgl1" value='<?=$data['tgl']?>'  style="width:120px"></td>		
			
		<td>Bank/Adj</td>
			<td>:</td>
				<td><input name='bank1' value='<?=$data['bank']->bank_nm?>'></td>
				
	
				<td><input type="hidden" name='bank4' value='<?=$data['bank4']?>'></td>
		
	</tr>
	<tr id='frame11'>
		<td>Unit</td>
			<td>:</td>
				<td><input name='unit1' value='<?=@$data['roow']->unit_no?>' class='xinput'></select></td>
				
		<td>Amount</td>
			<td>:</td>
				<td><input name='amount1' id='amount1'value='<?=$data['amount']?>' style='text-align:right' ></td>
				
		<td>Total Payment</td>
			<td>:</td>
				<td><input name='totpay' id='totpay' style="text-align:right;background-color:#000000;color:#FFFFFF;" readonly></td>
		
<td>Charge</td>
			<td>:</td>
				<td><input name='charge1' value='<?=$data['charge']?>' class='xinput'>	</td>		
				
				<td><input type='hidden' name='project1' value='<?=$data['row']->subproject_id?>'></td>
				<td><input type="hidden" name='unid1' value='<?=$data['unid1']?>'></td>	
		
	
	</tr>
	<tr id='frame12'>
		<td>Customer</td>
			<td>:</td>
				<td><input name='customername1' id='customername' class='xinput' readonly  value='<?=$data['customer']?>'/></td>
				
		<td>Type</td>
			<td>:</td>
				<td><input name='tipe1' value='<?=$data['tipe']?>' class='xinput' readonly>	</td>
				
		<td>Balanced</td>
			<td>:</td>
				<td><input name='balance' id='balance'  style="text-align:right;background-color:#000000;color:#FFFFFF;" readonly></td>
		<td>Komisi MKT</td>
			<td>:</td>
				<td><input type="hidden" name="cekkomisi" id='cekkomisi' value="0" /> <input type="checkbox" name="cekkomisi" id='cekkomisi' value="1" /></td>
	</tr>
	<tr id='frame13'>
		<td colspan='3'>&nbsp;</td>
		<td>No.Reff</td>
			<td>:</td>
				<td><input name='reff1' value='<?=$data['reff']?>' readonly></td>
		<td>Remark</td>
			<td>:</td>
				<td><input name='remark' id='remark'   style="width:200px" ></td>		
		<td><input type='submit' value='P A Y'></td>
	</tr>


<tr id='frame7'><td style="padding:20 0 0 0;border-bottom:solid"><b>PAYMENT SCHEDULE</b></td></tr>
	<table cellpadding='0' border='1' cellspacing='1' width='800px'>
	<tr bgcolor="#CCCCCC">
		<td style='width:50px' align='center'>No</td>
		<td style='width:10px' align='center'>ID</td>
		<td style='width:150px' align='center'>Term Of Payment</td>
		<td style='width:100px' align='center'>Due Date</td>
		<td style='width:100px'align='center'>Pay Date</td>
		<td style='width:150px'align='center'>Due Amount</td>
		<td style='width:200px'align='center'>Paid</td>
		<td style='width:150px' align='center'>OS</td>
		<td style='width:200px'align='center'>Payment</td>		
		<td style='width:150px' align='center'>Pay All</td>

<!--		<td style='width:100px' align='center'>Status</td>

		td style='width:50px' align='center'>Pay</td>			-->
	</tr>


	
	<?
	
	
	$no=0; 
	$n=0;
	$m=0;
	#<script>
	#frame2.hide();
	#</script>
	
//var_dump($cek);
	foreach($data['cek'] as $row):
	$no++;

	#$paygroup = $row->paygroup_nm;

	$dt = $this->db->select('count(id_paygroup) as id')
				   ->where('id_sp',$row->id_sp)
				   ->where('id_paygroup',2)
				   ->get('db_billing')->row();

				
	if($row->paytipe_id==1)
	{
		#die("test");
		if($row->paygroup_nm=="Pelunasan"){
			$n++;
			if($dt->id <= 1) $m="";
		}else{
			$n="";
		}
							
		if($row->paygroup_nm=="Down Payment"){
			$m++;
			if($dt->id <= 1) $m="";
		}else{
			$m="";
		}							
	}else{
		if($row->paygroup_nm=="Pelunasan"){
			$n++;
							if($row->paytipe_id!=2) $n="";
							if($dt->id <= 1) $m="";
		}else{
			$n="";
			}
						
						$m=0;	
		if($row->paygroup_nm==="Down Payment"){
						$m++;
							if($dt->id <= 1) $m="";
						}else{
							$m="";
						}	
						
		}


	if($row->tgl_paydate==NULL) $paydate = "-";
	else $paydate = indo_date($row->tgl_paydate);
	
	$os = $row->amount - $row->pay_amount;
	
	if($os < 0 ) {
		$os = 0;
		
	}
	##Total Keseluruahan##
	$subamount = $subamount + ceil($row->amount);
	$subpay = $subpay + $row->pay_amount;
	$subos = $subos + $os;

	#Cek Pembayaran
	$bayar = $row->paygroup_nm ." ".$n.$m;
	
	$billing = $row->id_billing;
	$customer = $row->customer_id;
	if($row->id_flag == 1){
		$status = "<a id='link' class='thickbox' title='Bayar bill' href='".site_url('sales/paycustomergmi/bayarbill')."/".$billing."/".$customer."/".$bayar."?width=750&height=450'/>Pay</a>";
		$color ="#FFF";
	}elseif($row->id_flag==2){
		$status = "Paid";
		$color ="#FFFF66";
	}else{
		$status = "-";
		$color ="#FFF";
	}
	
	?>
		<tr>
		<input type='hidden' name='no' id='no' value="<?=$no?>">
		<td style='width:50px' align="center" name='no' id='no'><?=$no?></td>
		<input type='hidden' name='bill[]' id='bill' value="<?php echo $row->id_billing; ?>">
		<td style='width:10px'><input name='bill<?=$no?>' id='bill<?=$no?>' value=<?php echo $row->id_billing; ?> style='text-align:left' readonly></td>
		<!--<td style='width:50px' align="center"><input name='id_billing<?=($billing)?>' id='id_billing<?=($billing)?>' value='<?=($billing)?>' class="input calculate validate[required]" ></td>-->
		<td style='width:150px' align="center"><?php echo $row->paygroup_nm ." ".$n.$m ?></td>
		<!--<td style='width:150px' align="center"><?php echo $row->bank_nm ?></td>-->
		<td style='width:100px' align="center"><?=indo_date($row->due_date)?></td>		
		<td style='width:100px' align="center"><?=$paydate?></td>
		<td style='width:150px' align="right"><?=number_format($row->amount)?></td>
		<td style='width:200px' align="right"><?=number_format($row->pay_amount)?></td>		
		<input type='hidden' name='os' id='os' value='<?=number_format($os)?>'>		
		<td style='width:150px'><input name='os<?=$no?>' id='os<?=$no?>' value=<?=number_format($os)?> style='text-align:right' readonly></td>
		<td style='width:200px' align="right"><input name='payment[]' id='payment<?=$no?>' class="input calculate validate[required]" style="background-color:#FF8080" value='0'></td>
		<!--<td><input type="hidden" name="ceklist" id="ceklist" value="0" /> <input type="checkbox" name="ceklist[]" id="ceklist" value=<?php echo $row->id_billing; ?> /></td>-->
	    <td><input type="checkbox" name="ceklist[]" id="ceklist<?=$no?>" value="<?php echo $row->id_billing; ?>"/></td>

		<td align="center">
		   <?#=$status?>
		</td>								

		</tr>
	

	<?php
	 endforeach;
	
	?>
	
	


	<tr bgcolor="#CCCCCC" id='subjumlah'>
		<td colspan="5" align="right" >Total</td>
		<td style='width:150px' align="right"><?=number_format($subamount)?></td>
		<td style='width:150px' align="right"></td>
		<td style='width:200px' align="right"><?=number_format($subos)?></td>	
		<td style='width:200px' align="right"><input name='subtotpay' id='subtotpay'  style="text-align:right;background-color:#000000;color:#FFFFFF;"  readonly ></td>
		<td style='width:150px' align="right"><?=number_format($subpay)?></td>
<!--
		<td align="center">-</td>
-->
	</tr>
	
<script>

$(function(){
var kugiri = new RegExp(",", "g");
	
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
		var tot=0;
				
		 for (var i=1; i <= <?=$no?>; i++){
		
		
				var payment1 = parseInt($("#payment"+i).val().replace(kugiri,""));
				var os1 = parseInt($("#os"+i).val().replace(kugiri,""));
				
				
				
				
				if(payment1 > os1){
					alert('Pembayaran Melebihi Nilai Tagihan');
					$("#payment"+i).val('');
				}
				
				var tot=tot+payment1;
				
			}
			
	
		
		$('#totpay').val(numToCurr(tot));
		$('#subtotpay').val(numToCurr(tot));
				 
		var totpay = parseInt($("#totpay").val().replace(kugiri,""));
		var amount = parseInt($("#amount1").val().replace(kugiri,""));
		
		var balance = amount - totpay;
				
		$('#balance').val(numToCurr(balance));
	   
	    }).numeric();
		
		
		
		
		// $('#ceklist[]').click(function() {
		
		// for (var i=1; i <= <?=$no?>; i++){
		
		
				// var payment1 = parseInt($("#payment"+i).val().replace(kugiri,""));
				// var os1 = parseInt($("#os"+i).val().replace(kugiri,""));
				
				
				
				
				// if (!$(this).is(':checked')) {
				// var ans = confirm("Are you sure?");
				// $('#payment'+i).val(4000);
			// }
				
			// }
			// $('#payment').val(4000);
		// });

});



$('#myform :checkbox').click(function() {
var tot=0;
var kugiri = new RegExp(",", "g");
	for (var i=1; i <= <?=$no?>; i++){	
	var payment1 = parseInt($("#payment"+i).val().replace(kugiri,""));
	var os1 = parseInt($("#os"+i).val().replace(kugiri,""));
    var error = parseInt($("#ceklist"+i).val());
	$('checkbox').is(':checked'); 
    // $this will contain a reference to the checkbox   
    if ($("#ceklist"+i).is(':checked')) {
      $("#payment"+i).val(numToCurr(os1));
	  var tot=tot+os1;
	  $('#totpay').val(numToCurr(tot));
		$('#subtotpay').val(numToCurr(tot));
		var totpay = parseInt($("#totpay").val().replace(kugiri,""));
		var amount = parseInt($("#amount1").val().replace(kugiri,""));		
		var balance = amount - totpay;
		
		var remark = ($("#paygroup").val());
				
		$('#balance').val(numToCurr(balance));
		$('#remark').val((remark));
	   
    } else {
        $("#payment"+i).val(0);
    }
	}
	
});





</script>	
	
	
	<? endif;?>
	
	

		
	<!--tr id="bill"></tr-->
</table>
	<!--input type="submit" class='thickbox' name="save" title="Pay Billing" value="Pay Bill"/>
	<input type="reset" name="cancel" value="Cancel"/-->	
<!--/form-->
</div>
<?$this->load->view(ADMIN_FOOTER)?>
