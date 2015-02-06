<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<?=link_tag(CSS_PATH.'styletable.css')?>
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>
<script type="text/javascript">
$(function(){	
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
<!-- update danu -->
	<script type="text/javascript">
$(document).ready(function() {
	$('.calculate').bind('keyup keypress',function(){			
		$(this).val(numToCurr($(this).val()));
	});
	$("#aktif_flagjurnal").val("<?=$flag?>");
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
	<?php $n=1;for($L=0; $L<sizeof($row_jurnal); $L++){?>
	<tr height="25px">
		<td align="center"><input type="text" readonly name="acc_dr_<?=$n?>" 	 id="acc_dr_<?=$n?>" 	 value="<?php echo $row_jurnal[$L]->acc_no;?>" 	  class="get_coaacno mytextbox"></td>
		<td align="center"><input type="text" readonly name="name_dr_<?=$n?>" 	 id="name_dr_<?=$n?>" 	 value="<?php echo $row_jurnal[$L]->acc_name;?>"   class="auto-j_name mytextbox"></td>
		<td align="right"><input type="text"  readonly name="acc_debet_<?=$n?>"  id="acc_debet_<?=$n?>"  value="<?php if(!$row_jurnal[$L]->debet  == '0'){ echo number_format($row_jurnal[$L]->debet); }else{ echo "0";} ?>" 						  class="mytextbox" style="text-align:right"></td>
		<td align="right"><input type="text"  readonly name="acc_credit_<?=$n?>" id="acc_credit_<?=$n?>" value="<?php if(!$row_jurnal[$L]->credit == '0'){ echo number_format($row_jurnal[$L]->credit); }else{ echo "0";} ?>" class="mytextbox"style="text-align:right"></td>
	</tr>
	<?php 
	$total_debet[] = $row_jurnal[$L]->debet; 
	$total_credit[] = $row_jurnal[$L]->credit; 
		} 
	?>
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
			$("#total_debet").val(td);

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
			$("#total_credit").val(tc);
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
		<td><input type="text" id="total_debet" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate"  value="<?=number_format(array_sum($total_debet))?>" readonly></td>
		<td><input type="text" id="total_credit" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate" value="<?=number_format(array_sum($total_credit))?>" readonly></td>
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