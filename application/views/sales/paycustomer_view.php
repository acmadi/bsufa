<?$this->load->view(ADMIN_HEADER)?>
<?=script('jquery-1.7.2.min.js')?>
<?=script('jquery.js')?>
<?=script('thickbox.js')?>
<?=script('jquery.form.js')?>
<?=link_tag(CSS_PATH.'thickbox.css')?>
<?=link_tag(CSS_PATH.'main.css')?>
<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script> 
<script language="javascript" src="<?=base_url()?>assets/js/thickbox.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/thickbox.css" type="text/css" /-->
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
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
			 $('#'+type).append('<option>-Pilih data-</option>'); // buat pilihan awal pada combobox
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
	loadData('subproject',0);	
	$('#subproject').change( 
		function(){
			if($('#unit option:selected').val() != '')
				loadData('unit',$('#subproject option:selected').val());				
		}
	);
	
	$(document).ready(function(){
		$('#link').attr('disabled',true);
	});
	

		$('#unit').change( 
		function(){
			//var custid = $('#').val();
			//tampilbill($(this).val(),);
			var proj = $('#subproject option:selected').val() 
			$.getJSON('<?=site_url('sales/paycustomer/cekbilling')?>/'+$(this).val()+'/'+proj,
			function(data){
				//tampilbill(data.unit_id,data.customer_id)
				$('#customername').val(data.customer_nama);
				$('#hp').val(data.customer_hp);
				$('#alamat').val(data.customer_alamat1);
				$('#customerid').val(data.customer_id);
			
			});
		}
	);

});
</script>



<h2>Payment Bill<hr width="150px" align="left"></h2>
<div class="printed">
<form method="post" action="<?=base_url()?>sales/paycustomer/tampilbill">
<input type="hidden" name="customerid" id="customerid"/>
<table>
	<tr>
		<td>Project</td>
		<td>:</td>
		<td colspan="4">
			<select name="subproject" id="subproject" class="xinput"></select>
		</td>
	</tr>
	<tr>
		<td>Unit</td>
			<td>:</td>
				<td><select name='unit' id='unit' class='xinput'></select></td>
	
	</tr>
	<tr>
		<td>Customer Name</td>
			<td>:</td>
				<td><input name='customername' id='customername' class='xinput' readonly /></td>
	
	</tr>
	
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
<tr><td colspan="4"><input type="submit" name="cekbill" value="Cek Bill"/></td></tr>	
<tr><td style="padding:20 0 0 0;border-bottom:solid"><b>List Of Billing </b></td></tr>
</table>	
</form>	
<!-- Cek Billing Number-->

<!--form action="<?=site_url('sales/paycustomer')?>"  method="post"-->
<table cellpadding='0' border='1' cellspacing='1' width='800px'>
	<tr bgcolor="#CCCCCC">
		<td style='width:50px' align='center'>No</td>
		<td style='width:150px' align='center'>Term Of Payment</td>
		<td style='width:100px' align='center'>Due Date</td>
		<td style='width:100px'align='center'>Pay Date</td>
		<td style='width:150px'align='center'>Due Amount</td>
		<td style='width:200px'align='center'>Pay Amount</td>
		<td style='width:150px' align='center'>OS</td>
		<td style='width:100px' align='center'>Status</td>
		<!--td style='width:50px' align='center'>Pay</td-->			
	</tr>
	<?php 
	$x= 0;
	$subamount = 0;
	$subpay =0;
	$subos = 0;
	if(@$data['cekbill']):
	$no=0; 
	#var_dump($cek);
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
		$status = "<a id='link' class='thickbox' title='Bayar bill' href='".site_url('sales/paycustomer/bayarbill')."/".$billing."/".$customer."/".$bayar."?width=750&height=450'/>Pay</a>";
		$color ="#FFF";
	}elseif($row->id_flag==2){
		$status = "Paid";
		$color ="#FFFF66";
	}else{
		$status = "-";
		$color ="#FFF";
	}
	
	?>
		<tr bgcolor="<?=$color?>" style="color:#000">
		<td align="center"><?=$no?></td>
		<td align="center"><?php echo $row->paygroup_nm ." ".$n.$m ?></td>
		<td align="center"><?=indo_date($row->due_date)?></td>		
		<td align="center"><?=$paydate?></td>
		<td align="right"><?=number_format($row->amount)?></td>
		<td align="right"><?=number_format($row->pay_amount)?></td>
		<td align="right"><?=number_format($os)?></td>
		<td align="center">
		   <?=$status?>
		</td>								
		</tr>
	<?php
	 endforeach;
	 endif;
	?>
	<tr bgcolor="#CCCCCC">
		<td colspan="4" align="right" >Total</td>
		<td align="right"><?=number_format($subamount)?></td>
		<td align="right"><?=number_format($subpay)?></td>	
		<td align="right"><?=number_format($subos)?></td>
		<td align="center">-</td>
	</tr>
		
	<!--tr id="bill"></tr-->
</table>
	<!--input type="submit" class='thickbox' name="save" title="Pay Billing" value="Pay Bill"/>
	<input type="reset" name="cancel" value="Cancel"/-->	
<!--/form-->
</div>
<?$this->load->view(ADMIN_FOOTER)?>
