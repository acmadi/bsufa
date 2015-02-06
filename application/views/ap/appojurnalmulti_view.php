<script type="text/javascript">
$(function(){
	$( ".get_coaacno" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_mjcoa",
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
			$(".get_coaname").val(id);
		},
		minLength: 1
	});
	
	// digunakan untuk autocomplete hasil dari pilihan multi
	<?php for($e=1; $e<=100; $e++){ ?>
	var c = $(".get_coaacno<?=$e;?>").val();
	$( ".get_coaacno<?=$e;?>" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_mjcoa",
				data: { term: c},
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
			$(".get_coaname<?=$e;?>").val(id);
		},
		minLength: 1
	});
	<?php } ?>
	
	// digunakan untuk autocomplete yang setelah di enter rownya
	<?php for($f=1; $f<=100; $f++){ ?>
	$("tbody#itemlist").on("keyup","#get_mycoa",function(){
		var c = $(".get_coaacnoi<?=$f;?>").val();
		$( ".get_coaacnoi<?=$f;?>" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_mjcoa",
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

<table border="1" height="100px" width="100%">
	<tr height="25px">
		<td align="center" style="width:200px">COA</td>
		<td align="center">Account Name</td>
		<td align="center">Debet</td>
		<td align="center">Kredit</td>
	</tr>
	
	<?php $n=1;foreach($nn as $key=>$value){?>
	<?php //var_dump($key."---".$value);exit;
	$sqlm = $this->db->query("SP_DetBudPO ".$value."")->row(); 
	$queryit = "select a.code_id, c.acc_no, c.acc_name, d.harga_tot
			from db_trbgtdiv a
			left join db_mstbgt b on b.code = a.code_id 
			left join db_coa c on c.acc_no = b.acc
			left join db_pr e on e.trbgt_id = a.id_trbgt 
			left join db_BarangPOH d on d.id_pr = e.id_pr
			where a.id_trbgt =  $value  and b.id_pt = $pt and b.thn = $ye 
			";
	$row1 = $this->db->query($queryit)->row(); 
	$sql = "select db_kelusaha.acc_dr, db_coa.acc_name from 
				pemasok inner join db_kelusaha on pemasok.id_kelusaha = db_kelusaha.id_kelusaha 
				inner join db_coa on db_kelusaha.acc_dr = db_coa.acc_no
				where pemasok.nm_supplier = '".$sqlm->NM_SUPP."' and db_coa.id_pt = $pt";//var_dump($sql);
	$row = $this->db->query($sql)->row();
	
	?>
	<tr height="15px">
		<td align="center"><input type="text" id="lacc_dr<?=$n;?>" value="<?php echo $row->acc_dr;?>" class="get_coaacno<?=$n;?> form-control"></td>
		<td align="center"><input type="text" id="lacc_name<?=$n;?>" value="<?php echo $row->acc_name;?>" class="get_coaname<?=$n;?> form-control"></td>
		<td align="center"><input type="text" id="lacc_debet" class="form-control auto"  data-d-group="3"></td>
		<td align="center"><input type="text" id="lacc_credit" class="form-control auto"  data-d-group="3"></td>
	</tr>
	<?php $n++; } ?>
	<tbody id="itemlist"></tbody>
	<tr height="15px">
		<td align="center"><input type="text" id="acc_dr" class="get_coaacno form-control"></td>
		<td align="center"><input type="text" id="acc_name" class="get_coaname form-control"></td>
		<td align="right"><input type="text" id="acc_debet" class="form-control auto"  data-d-group="3"></td>
		<td align="center"><input type="text" id="acc_credit" class="form-control auto"  data-d-group="3"></td>
	</tr>
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
		if(e.keyCode==13){
			e.preventDefault();
			var acc_dr 	     = $("#acc_dr").val();
			var acc_name 	 = $("#acc_name").val();
			var acc_debet 	 = $("#acc_debet").val();
			var acc_credit	 = $("#acc_credit").val();
			
			var items = "";
			num++;
			
			items += "<tr id='get_mycoa'>"; 
			items += "<td align='center'><input type='text' name='item[acc_dr][]'   id='item[acc_dr][]'   class='detail_nilai get_coaacnoi"+num+" form-control' value='"+ acc_dr+ "'   width=''autocomplete='off'></td>";
			items += "<td align='center'><input type='text' name='item[acc_name][]'    id='item[acc_name][]'    class='detail_nilai form-control' value='"+ acc_name +"'    width='' ></td>";
			items += "<td align='right'><input type='text' name='item[acc_debet][]'    id='item[acc_debet][]'    class='detail_nilai form-control auto'  data-d-group='3' value='"+ acc_debet +"'    width='' ></td>";
			items += "<td align='center'><input type='text' name='item[acc_credit][]' id='item[acc_credit][]' class='detail_nilai form-control auto'  data-d-group='3' value='"+ acc_credit +"' width=''></td>";
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
	