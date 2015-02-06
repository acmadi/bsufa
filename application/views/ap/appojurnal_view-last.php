<?php //var_dump($pph);exit;?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<?=link_tag(CSS_PATH.'styletable.css')?>
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$( ".get_coaacno" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_coaacno").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			var value = ui.item.value;
			var coa = value.split('|');
			$(".auto-j_name").val(id);
		},
		minLength: 1
	});
	
	$(".get_debcoaacno").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_debcoaacno").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			var value = ui.item.value;
			var coa = value.split('|');
			$(".auto-d_name").val(id);
		},
		minLength: 1
	});
	
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
			var value = ui.item.value;
			var coa = value.split('|');
			$(".auto-add_name").val(id);
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
<?php 
	//left join db_pr e on e.trbgt_id = a.id_trbgt
	//left join db_BarangPOH d on d.id_pr = e.id_pr
	#$suppl = $this->db->query("SP_multijurnal_view ".$value."")->row()->NM_SUPP; 
	$ppnx = "select acc_no,acc_name from db_coa where acc_name = 'PPN Masukan'";
	$ppni = $this->db->query($ppnx)->row();
	
	$queryit = "select a.code_id, c.acc_no, c.acc_name, d.harga_tot
			from db_trbgtdiv a
			left join db_mstbgt b on b.code = a.code_id 
			left join db_coa c on c.acc_no = b.acc
			left join db_pr e on e.trbgt_id = a.id_trbgt 
			left join db_BarangPOH d on d.id_pr = e.id_pr
			where a.id_trbgt =  $idtrbgt  and b.id_pt = $pt and b.thn = $ye 
			";
			#var_dump($queryit);exit();
	$row1 = $this->db->query($queryit)->row();
				
	$sql = "select db_kelusaha.acc_dr, db_coa.acc_name from 
				pemasok inner join db_kelusaha on pemasok.id_kelusaha = db_kelusaha.id_kelusaha 
				inner join db_coa on db_kelusaha.acc_dr = db_coa.acc_no
				where pemasok.nm_supplier = '$suppl' and db_coa.id_pt = $pt";//var_dump($sql);
	$row = $this->db->query($sql)->row();
	
	
	
	?>

<!-- update danu -->
	<script type="text/javascript">
$(document).ready(function() {
	$('.calculate').bind('keyup keypress',function(){			
		$(this).val(numToCurr($(this).val()));
	});	
});

</script>
<!-- end update danu -->	
<table class="datatable">
	<tr height="25px">
		<th align="center">COA</th>
		<th align="center">Account Name</th>
		<th align="center">Debet</th>
		<th align="center">Kredit</th>
	</tr>
	
 
	<?php if($ppn!=0 or $pph!=0){
		$b = replace_numeric($percen_pph);
		$c = replace_numeric($kredit);//$c = $ppn*(10/100); var_dump($ppn);
		$d = $c-($c*($b/110));	
		$e = $c-$d;
		
		/* Debet */
		$h = $c*(10/110);
		$i = $c - $h;
	?>
	<tr height="25px">
		<td align="center"><input type="text" name="acc_dr_1" id="acc_dr_1" value="<?php echo $row->acc_dr;?>" class="get_coaacno mytextbox"></td>
		<td align="center"><input type="text" name="name_dr_1" id="name_dr_1" value="<?php echo $row->acc_name;?>" class="auto-j_name mytextbox"></td>
		<td align="right"><input type="text" name="acc_debet_1" id="acc_debet_1" class="mytextbox" value="0" style="text-align:right"></td>
		<td align="right"><input type="text" name="acc_credit_1" id="acc_credit_1" class="mytextbox"  value="<?=@number_format($d);?>" style="text-align:right"></td>
	</tr>
	<?php }else{ ?>
	<tr height="25px">
		<td align="center"><input type="text" name="acc_dr_1" id="acc_dr_1" value="<?php echo $row->acc_dr;?>" class="get_coaacno mytextbox"></td>
		<td align="center"><input type="text" name="name_dr_1" id="name_dr_1" value="<?php echo $row->acc_name;?>" class="auto-j_name mytextbox"></td>
		<td align="right"><input type="text" name="acc_debet_1" id="acc_debet_1" class="mytextbox" value="0" style="text-align:right"></td>
		<td align="right"><input type="text" name="acc_credit_1" id="acc_credit_1" class="mytextbox"  value="<?=@number_format(replace_numeric($kredit));?>" style="text-align:right"></td>
	</tr>
	<?php } ?>
	
	<!-- PPN uncheck and PPH checked -->
	<?php if($ppn==0 and $pph==0){ echo "ites";?> 
	<tr height="25px">
		<td align="center"><input type="text" name="acc_dr_2" id="acc_dr_2"  class="get_debcoaacno mytextbox"  value="<?=@$row1->acc_no;?>"></td>
		<td align="center"><input type="text" name="name_dr_2" id="name_dr_2"  class="auto-d_name mytextbox" value="<?=@$row1->acc_name;?>"></td>
		<td align="right"><input type="text" name="acc_debet_2" id="acc_debet_2" class="mytextbox" value="<?=@number_format(replace_numeric($kredit));?>"  style="text-align:right"></td>
		<td align="center"><input type="text" name="acc_credit_2" id="acc_credit_2" class="mytextbox" value="0"  style="text-align:right"></td>
	</tr>
	<?php } else if($ppn==0 and $pph!=0){ echo "wtes";?> 
	<tr height="25px">
		<td align="center"><input type="text" name="acc_dr_2" id="acc_dr_2"  class="get_debcoaacno mytextbox"  value="<?=@$row1->acc_no;?>"></td>
		<td align="center"><input type="text" name="name_dr_2" id="name_dr_2"  class="auto-d_name mytextbox" value="<?=@$row1->acc_name;?>"></td>
		<td align="right"><input type="text" name="acc_debet_2" id="acc_debet_2" class="mytextbox" value="<?=@number_format(replace_numeric($kredit));?>"  style="text-align:right"></td>
		<td align="center"><input type="text" name="acc_credit_2" id="acc_credit_2" class="mytextbox" value="0"  style="text-align:right"></td>
	</tr>
	<?php } else { echo "xtes";?>
	<tr height="25px">
		<td align="center"><input type="text" name="acc_dr_2" id="acc_dr_2"  class="get_debcoaacno mytextbox"  value="<?=@$row1->acc_no;?>"></td>
		<td align="center"><input type="text" name="name_dr_2" id="name_dr_2"  class="auto-d_name mytextbox" value="<?=@$row1->acc_name;?>"></td>
		<td align="right"><input type="text" name="acc_debet_2" id="acc_debet_2" class="mytextbox" value="<?=@number_format($i);?>"  style="text-align:right"></td>
		<td align="center"><input type="text" name="acc_credit_2" id="acc_credit_2" class="mytextbox" value="0"  style="text-align:right"></td>
	</tr>
	<?php } ?>
	
	
	<!-- PPN Checked -->
	<?php if($ppn!=0){ ?>
	<tr height="25px">
		<td align="center"><input type="text" name="acc_dr_3" id="acc_dr_3"  class="mytextbox" value="<?=$ppni->acc_no;?>"></td>
		<td align="center"><input type="text" name="name_dr_3"  id="name_dr_3"  class="mytextbox" value="<?=$ppni->acc_name;?>"></td>
		<td align="right"><input type="text" name="acc_debet_3"  id="acc_debet_3" class="mytextbox"   value="<?=@number_format($h);?>"  style="text-align:right"></td>
		<td align="center"><input type="text" name="acc_credit_3"  id="acc_credit_3" class="mytextbox"  value="0"  style="text-align:right"></td>
	</tr>
	<?php } else { ?>
		<input type="hidden" id="acc_debet_3" class="mytextbox"   value=""  style="text-align:right">
		<input type="hidden" id="acc_credit_3" class="mytextbox"  value=""  style="text-align:right">
	<?php } ?>
	
	<!-- PPH Checked -->
	<?php if($pph!=0){  $persen_pph = $c - $d; ?>
	<tr height="25px">
		<td align="center"><input type="text" name="acc_dr_4" id="acc_dr_4"  class="mytextbox"  value="<?=@$pph[0]->acc_no;?>"></td>
		<td align="center"><input type="text" name="name_dr_4" id="name_dr_4"  class="mytextbox"  value="<?=@$pph[0]->acc_name;?>"></td>
		<td align="right"><input type="text" name="acc_debet_4" id="acc_debet_4" class="mytextbox"    value="0"  style="text-align:right"></td>
		<td align="center"><input type="text" name="acc_credit_4" id="acc_credit_4" class="mytextbox"   value="<?=@number_format($persen_pph);?>"  style="text-align:right"></td>
	</tr>
	<?php } else { ?>
		<input type="hidden" id="acc_debet_4" class="mytextbox"   value=""  style="text-align:right">
		<input type="hidden" id="acc_credit_4" class="mytextbox"  value=""  style="text-align:right">
	<?php } ?>
	
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
		<td><input type="text" id="total_debet" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate" readonly></td>
		<td><input type="text" id="total_credit" style="text-align:right;background-color:#EFFC94" class="mytextbox calculate" readonly></td>
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
	





<?php 
	$sql = "select db_kelusaha.acc_dr, db_coa.acc_name from 
				pemasok inner join db_kelusaha on pemasok.id_kelusaha = db_kelusaha.id_kelusaha 
				inner join db_coa on db_kelusaha.acc_dr = db_coa.acc_no
				where pemasok.nm_supplier = '$suppl'";//var_dump($sql);
	$row = $this->db->query($sql)->result();
?>

