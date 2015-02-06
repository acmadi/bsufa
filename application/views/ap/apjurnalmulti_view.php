<?php //var_dump($nn);exit;?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<?=link_tag(CSS_PATH.'styletable.css')?>
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>
<script type="text/javascript">
$(function(){	
	var nm = $('#nm').val();
	var d1 = $('#acc_debet_1').val().replace(/,/g,'');
	var d2 = $('#acc_debet_2').val().replace(/,/g,'');
	var d3 = $('#acc_debet_3').val().replace(/,/g,'');
	var da = 0;
	for(p=4;p<=nm;p++){
	var da = da+$('#acc_debet_'+p).val().replace(/,/g,'');
	}
	alert('tes');
	var td = d1+d2+d3+da;
	$('#total_debet').val(td);
	
	$(".get_addcoaacno").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno1").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno1").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name1").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno1").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno2").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno2").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name2").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno2").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno3").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno3").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name3").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno3").val(coa[0]);
		},
		minLength: 1
	});
	
	$(".get_addcoaacno4").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno4").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name4").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno4").val(coa[0]);
		},
		minLength: 1
	});
	
	// digunakan untuk autocomplete yang setelah di enter rownya
	<?php for($f=1; $f<=100; $f++){ ?>
	$("tbody#itemlist").on("keyup","#get_mycoa",function(){
		var c = $(".get_coaacnoi<?=$f;?>").val();
		$( ".get_coaacnoi<?=$f;?>" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
					data: { term: c},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			minLength: 1
		});
	});
	<?php } ?>
	
	
	

});
</script>


<!-- end update danu -->
<input type="hidden" id="aktif_flagjurnal">	
<table class="datatable">
	<tr height="25px">
		<th align="center">COA</th>
		<th align="center">Account Name</th>
		<th align="center">Debet</th>
		<th align="center">Kredit</th>
	</tr>
	<?php if($cno!=0){?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_1" id="acc_dr_1" value="<?php echo $cno;?>" class="get_addcoaacno1 mytextbox"></td>
		<td align="center"><input type="text"  name="name_dr_1" id="name_dr_1" value="<?php echo $cnm;?>" class="auto-add_name1 mytextbox"></td>
		<td align="right"><input type="text"   name="acc_debet_1" id="acc_debet_1" class="mytextbox" value=0 style="text-align:right"></td>
		<td align="right"><input type="text"   name="acc_credit_1" id="acc_credit_1" class="mytextbox"  value="<?php echo number_format($valap);?>" style="text-align:right"></td>
	</tr>
	<?php } ?>
	<?php if(empty($aloc)){ ?>
	<?php 
	//var_dump($nn);exit;
	$td = 0;
	$n=4;foreach($nn as $key){
	
	//var_dump($key);exit;
	if($flag=='ope'){
	
	$query = $this->db->query("select a.acc,a.descbgt,b.amount from db_mstbgt a
								join db_trbgtdiv b on a.code = b.code_id
								where a.id_pt=11 and a.thn = b.divthn and b.id_trbgt = '".$key."'")->row();
	}elseif($flag=='po'){
	$query = $this->db->query("select db_mstbgt.acc as acc,db_mstbgt.descbgt as descbgt,db_trbgtdiv.amount as amount from db_trbgtdiv
								join db_mstbgt on db_trbgtdiv.code_id = db_mstbgt.code 
								where db_trbgtdiv.id_trbgt = '".$key."' and db_trbgtdiv.divthn = db_mstbgt.thn and db_mstbgt.id_pt=11")->row();
	
	}
	

	if($dpp_ppn!=0){
	$td = $td+($query->amount/1.1);
	?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_<?php echo $n;?>" id="acc_dr_<?php echo $n;?>" value="<?php echo $query->acc;?>" class="get_addcoaacno<?php echo $n;?> mytextbox"></td>
		<td align="center"><input type="text"  name="name_dr_<?php echo $n;?>" id="name_dr_<?php echo $n;?>" value="<?php echo $query->descbgt;?>" class="auto-add_name<?php echo $n;?> mytextbox"></td>
		<td align="right"><input type="text"   name="acc_debet_<?php echo $n;?>" id="acc_debet_<?php echo $n;?>" class="mytextbox" value="<?php echo number_format($query->amount/1.1);?>" style="text-align:right"></td>
		<td align="right"><input type="text"   name="acc_credit_<?php echo $n;?>" id="acc_credit_<?php echo $n;?>" class="mytextbox" value=0 style="text-align:right"></td>
	</tr>
	<?php }else{
	$td = $td+$query->amount;
	?>	
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_<?php echo $n;?>" id="acc_dr_<?php echo $n;?>" value="<?php echo $query->acc;?>" class="get_addcoaacno<?php echo $n;?> mytextbox"></td>
		<td align="center"><input type="text"  name="name_dr_<?php echo $n;?>" id="name_dr_<?php echo $n;?>" value="<?php echo $query->descbgt;?>" class="auto-add_name<?php echo $n;?> mytextbox"></td>
		<td align="right"><input type="text"   name="acc_debet_<?php echo $n;?>" id="acc_debet_<?php echo $n;?>" class="mytextbox" value="<?php echo number_format($query->amount);?>" style="text-align:right"></td>
		<td align="right"><input type="text"   name="acc_credit_<?php echo $n;?>" id="acc_credit_<?php echo $n;?>" class="mytextbox" value=0 style="text-align:right"></td>
	</tr>
	<?php }	
	$n++; }
	}else{ $n = 4;
	foreach($all_proj as $row){
	?>
	
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_<?php echo $n;?>" id="acc_dr_<?php echo $n;?>"  class="mytextbox get_addcoaacno<?php echo $n;?>"  value="<?php echo $row->acc_no;?>"></td>
		<td align="center"><input type="text"  name="name_dr_<?php echo $n;?>" id="name_dr_<?php echo $n;?>"  class="mytextbox auto-add_name<?php echo $n;?>"  value="<?php echo $row->acc_name;?>"></td>
		<td align="right"><input type="text"   name="acc_debet_<?php echo $n;?>" id="acc_debet_<?php echo $n;?>" class="mytextbox"    value="<?php echo number_format($tn*(int)$row->alokasi_persen/100);?>"  style="text-align:right"></td>
		<td align="center"><input type="text"  name="acc_credit_<?php echo $n;?>" id="acc_credit_<?php echo $n;?>" class="mytextbox"   value="0"  style="text-align:right"></td>
	</tr>
	<?php ?>
	
	<?php  $n++;} }
	if($dpp_ppn!=0){
	?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_2" id="acc_dr_2" value="1.01.07.01.08" class="get_addcoaacno2 mytextbox"></td>
		<td align="center"><input type="text"  name="name_dr_2" id="name_dr_2" value="PPn Masukan" class="auto-add_name2 mytextbox"></td>
		<td align="right"><input type="text"   name="acc_debet_2" id="acc_debet_2"  value="<?php echo number_format($dpp_ppn*10/100);?>" class="mytextbox" style="text-align:right"></td>
		<td align="right"><input type="text"   name="acc_credit_2" id="acc_credit_2" value=0 class="mytextbox" style="text-align:right"></td>
	</tr>
	<?php } 
	if($pph!=0){
	?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_3" id="acc_dr_3" value="<?php echo $pno;?>" class="get_addcoaacno3 mytextbox"></td>
		<td align="center"><input type="text"  name="name_dr_3" id="name_dr_3" value="<?php echo $pnm;?>" class="auto-add_name3 mytextbox"></td>
		<td align="right"><input type="text"   name="acc_debet_3" id="acc_debet_3" value=0 class="mytextbox" style="text-align:right"></td>
		<td align="right"><input type="text"   name="acc_credit_3" id="acc_credit_3" value="<?php echo number_format($pph);?>"class="mytextbox" style="text-align:right"></td>
	</tr>
	<?php } ?>
	<input type="hidden" name="nm" id="nm" value="<?php echo $n-1;?>">
	<tbody id="itemlist"></tbody>
	<!-- update danu -->
	<tr height="25px">
		<td align="center"><input type="text" id="acc_dr" class="get_addcoaacno mytextbox"></td>
		<td align="center"><input type="text" id="acc_name" class="auto-add_name mytextbox"></td>
		<td align="right"><input type="text" id="acc_debet" style="text-align:right" class="mytextbox calculate"></td>
		<td align="center"><input type="text" id="acc_credit" style="text-align:right" class="mytextbox calculate"></td>
	</tr>

	<script type="text/javascript">
		$(document).ready(function() {
			
			//debet
			if ((document.getElementById('acc_debet_1').value.replace(/,/g,'')) == '') {
				var a1 = 0;
			} else{
				var a1 = parseInt(document.getElementById('acc_debet_1').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_debet_2').value.replace(/,/g,'')) == '') {
				var a2 = 0;
			} else{
				var a2 = parseInt(document.getElementById('acc_debet_2').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_debet_3').value.replace(/,/g,'')) == '') {
				var a3 = 0;
			} else{
				var a3 = parseInt(document.getElementById('acc_debet_3').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_debet_4').value.replace(/,/g,'')) == '') {
				var a4 = 0;
			} else{
				var a4 = parseInt(document.getElementById('acc_debet_4').value.replace(/,/g,''));
			};

			var td = a1 + a2 + a3 + a4;
			$("#total_debet").val(numToCurr(td));

			//credit
			if ((document.getElementById('acc_credit_1').value.replace(/,/g,'')) == '') {
				var c1 = 0;
			} else{
				var c1 = parseInt(document.getElementById('acc_credit_1').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_credit_2').value.replace(/,/g,'')) == '') {
				var c2 = 0;
			} else{
				var c2 = parseInt(document.getElementById('acc_credit_2').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_credit_3').value.replace(/,/g,'')) == '') {
				var c3 = 0;
			} else{
				var c3 = parseInt(document.getElementById('acc_credit_3').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_credit_4').value.replace(/,/g,'')) == '') {
				var c4 = 0;
			} else{
				var c4 = parseInt(document.getElementById('acc_credit_4').value.replace(/,/g,''));
			};

			var tc = c1 + c2 + c3 + c4;
			$("#total_credit").val(numToCurr(tc));
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#total_debet').change(function(event) {
				$(this).val(numToCurr($(this).val()));
			});
			$('#total_credit').change(function(event) {
				$(this).val(numToCurr($(this).val()));
			});		
		});
	</script>

	<tr>
		<td colspan="2"> <b>GRAND TOTAL </b></td>
		<td><input type="text" id="total_debet" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate" ></td>
		<td><input type="text" id="total_credit" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate" ></td>
	</tr>

	<!-- end update danu -->
</table>

<script type="text/javascript"> 
	function clear(){
		$("#acc_dr").val("");
		$("#acc_name").val("");
		$("#acc_debet").val("");
		$("#acc_credit").val("");
	}
	
	$("tbody#itemlist").on("click","#hapus",function(){
		$(this).parent().parent().remove();
	});
		
		// enter invoice_ap
		var num = 0;
		$('#acc_credit').on('keypress', function(e) {  
		var a = 1;
		if(e.keyCode==13){
			e.preventDefault();
			var acc_dr 	 = $("#acc_dr").val();
			var acc_name 	 = $("#acc_name").val();

			var acc_debet 	 = $("#acc_debet").val().replace(/,/g,'');
			if (acc_debet == '') { acc_debet = 0; } else {acc_debet = parseInt($("#acc_debet").val().replace(/,/g,''));};

			var acc_credit	 = $("#acc_credit").val().replace(/,/g,'');
			if (acc_credit == '') {acc_credit = 0;} else {acc_credit = parseInt($("#acc_credit").val().replace(/,/g,''));};
			
			var totd = parseInt($("#total_debet").val().replace(/,/g,''));
			var total1 = totd + acc_debet;
			var totc = parseInt($("#total_credit").val().replace(/,/g,''));
			var total2 = totc + acc_credit;
			var items = "";
			$("#total_debet").val(total1);
			$("#total_credit").val(total2);
			num++;
			a++;
			
			items += "<tr id='get_mycoa' height='25px'>"; 
			items += "<td align='center'><input type='text' name='item[acc_dr][]'   	 id='item[acc_dr][]'   		class='detail_nilai get_coaacnoi"+num+" mytextbox' value='"+ acc_dr+ "'   width=''autocomplete='off'></td>";
			items += "<td align='center'><input type='text' name='item[acc_name][]'    id='item[acc_name][]'    class='detail_nilai mytextbox' value='"+ acc_name +"'    width='' ></td>";
			items += "<td align='right'><input type='text' name='item[acc_debet][]'   style='text-align:right' id='item[acc_debet][]'   class='detail_nilai mytextbox' value='"+ acc_debet +"'    width='' ></td>";
			items += "<td align='center'><input type='text' name='item[acc_credit][]' style='text-align:right' id='item[acc_credit][]' 	class='detail_nilai mytextbox' value='"+ acc_credit +"' width=''></td>";
			items += "<td><a href='javascript:void(0);' id='hapus'><img src='<?=site_url('assets/img/attributes_delete_icon.png')?>' /></a></td>";
			items += "</tr>";
			
			$("#acc_dr").focus();
			
			if ($("tbody#itemlist tr").length == 0)
			{
				$("#itemlist").append(items);
				clear();
			}else{
				var callback = checkList(acc_dr);
				if(callback === true){ 
					$("#itemlist").append(items);
					clear();
					return false;
				}
			}
			
		}
		
	});
		
	function checkList(val){ 
		var cb = true;
		console.log($(acc_dr).val());
	
		$("#itemlist tr").each(function(index){
			var input = $(this).find("input[type='hidden']:first");
			if (input.val() == $(acc_dr).val()){
				cb = false;
			}
		});
		return cb;
	}
</script>