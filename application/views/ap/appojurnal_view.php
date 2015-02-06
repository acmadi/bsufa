<?php //var_dump($pph);exit;?>
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>
<?=link_tag(CSS_PATH.'styletable.css')?>
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
	
	<?php for($a = 6;$a <=100;$a++){ ?>
	$(".get_addcoaacno<?php echo $a;?>").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno<?php echo $a;?>").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name<?php echo $a;?>").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno<?php echo $a;?>").val(coa[0]);
		},
		minLength: 1
	});
	<?php } ?>
	
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
	
	$(".get_addcoaacno5").autocomplete({
		source: function(request, response) { 
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_coaacno",
				data: { term: $(".get_addcoaacno5").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id 	  = ui.item.id;
			$(".auto-add_name5").val(id);
			
			event.preventDefault();
			var value = ui.item.value.replace(/ /g,'');
			var coa = value.split('|');
			$(".get_addcoaacno5").val(coa[0]);
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
<?php 
	//left join db_pr e on e.trbgt_id = a.id_trbgt
	//left join db_BarangPOH d on d.id_pr = e.id_pr
	#$suppl = $this->db->query("SP_multijurnal_view ".$value."")->row()->NM_SUPP; 
	$ppnx = "select acc_no,acc_name from db_coa where acc_name = 'PPn Masukan' and id_pt = '11'";
	$ppni = $this->db->query($ppnx)->row();
	
	if($flag=="ope"){
		$queryit = "select a.code_id,b.code, b.acc as acc_no ,c.acc_name 
						from db_trbgtdiv a
							left join db_mstbgt b on a.code_id = b.code
							left join db_coa c on b.acc = c.acc_no
							where a.id_trbgt=$idtrbgt and c.id_pt='$pt'";
	}else{
		$queryit = "select a.code_id, c.acc_no, c.acc_name, d.harga_tot
					from db_trbgtdiv a
						left join db_mstbgt b on b.code = a.code_id 
						left join db_coa c on c.acc_no = b.acc
						left join db_pr e on e.trbgt_id = a.id_trbgt 
						left join db_BarangPOH d on d.id_pr = e.id_pr
						where a.id_trbgt =  $idtrbgt  and b.id_pt = '$pt' and b.thn = $ye ";
	}
	$row1 = $this->db->query($queryit)->row();	//var_dump($queryit);		
	$sql = "select db_kelusaha.acc_dr, db_coa.acc_name from 
				pemasok inner join db_kelusaha on pemasok.id_kelusaha = db_kelusaha.id_kelusaha 
				inner join db_coa on db_kelusaha.acc_dr = db_coa.acc_no
				where pemasok.nm_supplier = '$suppl' and db_coa.id_pt = '$pt'";//var_dump($sql);
	$row = $this->db->query($sql)->row();
	
	
	?>

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
<table class="datatable" style="width:100%">
	<tr height="25px">
		<th align="center">COA</th>
		<th align="center">Account Name</th>
		<th align="center">Debet</th>
		<th align="center">Credit</th>
	</tr>
	<?php //var_dump($ppn);exit
	$nm = 6;
	$ta = 0;
	?>
 
	<?php if($ppn!=0 or $pph!=0){
		$b = (int)replace_numeric($percen_pph);
		$c = (int)replace_numeric($kredit);//$c = $ppn*(10/100); var_dump($ppn);
		if(!empty($pphv)){
		$g = (int)replace_numeric($pphv);
		}else{
		$g = 0;
		}
		$j = $b * $g / 100;
		$d = $c- $j;	
		$e = $c-$d;
		
		/* Debet */
		$h = $c*(10/110);
		$i = $c - $h;
		
	?>
	
	<!--tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_1" id="acc_dr_1" value="<?php echo $ap_coa;?>" class="get_addcoaacno1 mytextbox" style="width:100%"></td>
		<td align="center"><input type="text"  name="name_dr_1" id="name_dr_1" value="<?php echo $ap_name;?>" class="auto-add_name1 mytextbox"  style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_1" id="acc_debet_1" class="mytextbox" value="0" style="text-align:right;width:100%"></td>
		<td align="right"><input type="text"   name="acc_credit_1" id="acc_credit_1" class="mytextbox"  value="<?=@number_format($d);?>" style="text-align:right;width:100%"></td>
	</tr-->
	<?php }else{ ?>
	<!--tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_1" id="acc_dr_1" value="<?php echo $ap_coa;?>" class="get_addcoaacno1 mytextbox"  style="width:100%"></td>
		<td align="center"><input type="text"  name="name_dr_1" id="name_dr_1" value="<?php echo $ap_name;?>" class="auto-add_name1 mytextbox" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_1" id="acc_debet_1" class="mytextbox" value="0" style="text-align:right;width:100%"></td>
		<td align="right"><input type="text"   name="acc_credit_1" id="acc_credit_1" class="mytextbox"  value="<?=@number_format(replace_numeric($kredit)); ?>" style="text-align:right;width:100%"></td>
	</tr-->
	<?php } ?>
	
	<!-- PPN uncheck and PPH checked -->
	<?php if(empty($aloc)){
	if($ppn==0 and $pph==0){?> 
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_4" id="acc_dr_4"  class="get_addcoaacno2 mytextbox"  value="<?=@$row1->acc_no;?>" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_4" id="name_dr_4"  class="auto-add_name2 mytextbox" value="<?=@$row1->acc_name;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_4" id="acc_debet_4" class="mytextbox" value="<?=@number_format(replace_numeric($kredit));?>"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_4" id="acc_credit_4" class="mytextbox" value="0"  style="text-align:right;width:100%"></td>
	</tr>
	<?php } else if($ppn==0 and $pph!=0){?> 
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_4" id="acc_dr_4"  class="get_addcoaacno2 mytextbox"  value="<?=@$row1->acc_no;?>" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_4" id="name_dr_4"  class="auto-add_name2 mytextbox" value="<?=@$row1->acc_name;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_4" id="acc_debet_4" class="mytextbox" value="<?=@number_format(replace_numeric($kredit));?>"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_4" id="acc_credit_4" class="mytextbox" value="0"  style="text-align:right;width:100%"></td>
	</tr>
	<?php } else {?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_4" id="acc_dr_4"  class="get_addcoaacno2 mytextbox"  value="<?=@$row1->acc_no;?>" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_4" id="name_dr_4"  class="auto-add_name2 mytextbox" value="<?=@$row1->acc_name;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_4" id="acc_debet_4" class="mytextbox" value="<?=@number_format($i);?>"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_4" id="acc_credit_4" class="mytextbox" value="0"  style="text-align:right;width:100%"></td>
	</tr>
	<?php } ?>
	<?php }else{ 
	$persen  = $this->db->query("select alokasi_persen from project where kd_project = '$aloc'")->row()->alokasi_persen;
	$datrow = $this->db->query("select a.remark,b.acc from db_trbgtdiv a
	join db_mstbgt b on b.code = a.code_id 
	where a.id_trbgt = $idtrbgt and b.thn = '2014' and b.id_pt = 11")->row();
	?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_5" id="acc_dr_5"  class="mytextbox get_addcoaacno5"  value="<?php echo $datrow->acc;?>" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_5" id="name_dr_5"  class="mytextbox auto-add_name5"  value="<?php echo $datrow->remark;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_5" id="acc_debet_5" class="mytextbox"    value="<?php if($ppn!=0){ $kr = replace_numeric($kredit)-(int)$h; echo $cc = number_format((int)replace_numeric($kr)*(int)$persen/100); }else{ echo $cc = number_format((int)replace_numeric($kredit)*(int)$persen/100); }?>"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_5" id="acc_credit_5" class="mytextbox"   value="0"  style="text-align:right;width:100%"></td>
	</tr>
	<?php 
	$todeb = 0;
	$toced = replace_numeric($cc);	
	foreach($all_proj as $row){
	if($ppn!=0){ 
	$kr = replace_numeric($kredit)-(int)$h; 
	$ta = $ta+((int)replace_numeric($kr)*(int)$row->alokasi_persen/100); 
	}else{
	$ta = $ta+((int)replace_numeric($kredit)*(int)$row->alokasi_persen/100);
	}
	?>
	
	<tr height="25px">
		<td align="center">
		<input type="hidden" name="krproj_all<?php echo $nm;?>" value="<?php echo $row->kd_project;?>">
		<input type="text"  name="acc_dr_<?php echo $nm;?>" id="acc_dr_<?php echo $nm;?>"  class="mytextbox get_addcoaacno<?php echo $nm;?>"  value="<?php echo $row->acc_no;?>" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_<?php echo $nm;?>" id="name_dr_<?php echo $nm;?>"  class="mytextbox auto-add_name<?php echo $nm;?>"  value="<?php echo $row->acc_name;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_<?php echo $nm;?>" id="acc_debet_<?php echo $nm;?>" class="mytextbox"    value="<?php if($ppn!=0){ $kr = replace_numeric($kredit)-$h; $tc = replace_numeric($kr)*$row->alokasi_persen/100; echo number_format((int)$tc); }else{ $tc = replace_numeric($kredit)*$row->alokasi_persen/100; echo number_format((int)$tc); }?>"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_<?php echo $nm;?>" id="acc_credit_<?php echo $nm;?>" class="mytextbox"   value="0"  style="text-align:right;width:100%"></td>
	</tr>
	 
	
	<?php 
	$toced = $toced+replace_numeric($tc);
	$todeb = 0;
	$nm++; } } ?>
	<!-- PPN Checked -->
	<?php if($ppn!=0){ ?>
	<?php if(empty($aloc)){ $nm=3; } ?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_3" id="acc_dr_3"  class="mytextbox get_addcoaacno3" value="<?=$ppni->acc_no;?>" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_3"  id="name_dr_3"  class="mytextbox auto-add_name3" value="<?=$ppni->acc_name;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_3"  id="acc_debet_3" class="mytextbox"   value="<?=@number_format($h);?>"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_3"  id="acc_credit_3" class="mytextbox"  value="0"  style="text-align:right;width:100%"></td>
	</tr>
	<?php } else { ?>
		<input type="hidden" id="acc_debet_3" class="mytextbox"   value=""  style="text-align:right">
		<input type="hidden" id="acc_credit_3" class="mytextbox"  value=""  style="text-align:right">
	<?php } ?>
	
	<!-- PPH Checked -->
	<?php //if($pph!=0){  $persen_pph = $c - $d; ?>
	<!--tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_4" id="acc_dr_4"  class="mytextbox get_addcoaacno4"  value="<?=@$pph[0]->acc_no;?>" style="width:100%"></td>
		<td align="center"><input type="text"  name="name_dr_4" id="name_dr_4"  class="mytextbox auto-add_name4"  value="<?=@$pph[0]->acc_name;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_4" id="acc_debet_4" class="mytextbox"    value="0"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_4" id="acc_credit_pph" class="mytextbox"   value="<?=@number_format($persen_pph);?>"  style="text-align:right;width:100%"></td>
	</tr>
	<?php //} else { ?>
		<input type="hidden" id="acc_debet_4" class="mytextbox"   value=""  style="text-align:right">
		<input type="hidden" id="acc_credit_pph" class="mytextbox"  value=""  style="text-align:right"-->
	<?php //} ?>
	<input type="hidden" name="nm" id="nm" value="<?php echo $nm-1;?>">
	<!-- Allocation -->
	<tbody id="itemlist"></tbody>
	<?php if($ppn!=0 or $pph!=0){
		$b = (int)replace_numeric($percen_pph);
		$c = (int)replace_numeric($kredit);//$c = $ppn*(10/100); var_dump($ppn);
		if(!empty($pphv)){
		$g = (int)replace_numeric($pphv);
		}else{
		$g = 0;
		}
		$j = $b * $g / 100;
		$d = $c- $j;	
		$e = $c-$d;
		
		/* Debet */
		$h = $c*(10/110);
		$i = $c - $h;
		
	?>
	
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_1" id="acc_dr_1" value="<?php echo $ap_coa;?>" class="get_addcoaacno1 mytextbox" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_1" id="name_dr_1" value="<?php echo $ap_name;?>" class="auto-add_name1 mytextbox"  style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_1" id="acc_debet_1" class="mytextbox" value="0" style="text-align:right;width:100%"></td>
		<td align="right"><input type="text"   name="acc_credit_1" id="acc_credit_1" class="mytextbox"  value="<?=@number_format($d);?>" style="text-align:right;width:100%"></td>
	</tr>
	<?php }else{ ?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_1" id="acc_dr_1" value="<?php echo $ap_coa;?>" class="get_addcoaacno1 mytextbox"  style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_1" id="name_dr_1" value="<?php echo $ap_name;?>" class="auto-add_name1 mytextbox" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_1" id="acc_debet_1" class="mytextbox" value="0" style="text-align:right;width:100%"></td>
		<td align="right"><input type="text"   name="acc_credit_1" id="acc_credit_1" class="mytextbox"  value="<?=@number_format(replace_numeric($kredit)); ?>" style="text-align:right;width:100%"></td>
	</tr>
	<?php } ?>
	<?php if($pph!=0){  $persen_pph = $c - $d; ?>
	<tr height="25px">
		<td align="center"><input type="text"  name="acc_dr_2" id="acc_dr_2"  class="mytextbox get_addcoaacno4"  value="<?=@$pph[0]->acc_no;?>" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" name="name_dr_2" id="name_dr_2"  class="mytextbox auto-add_name4"  value="<?=@$pph[0]->acc_name;?>" style="width:100%"></td>
		<td align="right"><input type="text"   name="acc_debet_2" id="acc_debet_2" class="mytextbox"    value="0"  style="text-align:right;width:100%"></td>
		<td align="center"><input type="text"  name="acc_credit_2" id="acc_credit_pph" class="mytextbox"   value="<?=@number_format($persen_pph);?>"  style="text-align:right;width:100%"></td>
	</tr>
	<?php } else { ?>
		<input type="hidden" id="acc_debet_2" class="mytextbox"   value=""  style="text-align:right">
		<input type="hidden" id="acc_credit_pph" class="mytextbox"  value=""  style="text-align:right">
	<?php } ?>
	<!-- update danu -->
	<tr height="25px">
		<td align="center"><input type="text" id="acc_dr" class="get_addcoaacno mytextbox" style="width:100%"></td>
		<td align="center"><input type="text" readonly="true" id="acc_name" class="auto-add_name mytextbox" style="width:100%"></td>
		<td align="right"><input type="text" id="acc_debet" style="text-align:right;width:100%" class="mytextbox calculate"></td>
		<td align="center"><input type="text" id="acc_credit" style="text-align:right;width:100%" class="mytextbox calculate"></td>
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

			if ((document.getElementById('acc_credit_4').value.replace(/,/g,'')) == '') {
				var c2 = 0;
			} else{
				var c2 = parseInt(document.getElementById('acc_credit_4').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_credit_3').value.replace(/,/g,'')) == '') {
				var c3 = 0;
			} else{
				var c3 = parseInt(document.getElementById('acc_credit_3').value.replace(/,/g,''));
			};

			if ((document.getElementById('acc_credit_pph').value.replace(/,/g,'')) == '') {
				var c4 = 0;
			} else{
				var c4 = parseInt(document.getElementById('acc_credit_pph').value.replace(/,/g,''));
			};

			var tc = c1 + c4;
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
	<?php if(empty($aloc)){?>
	<tr>
		<td colspan="2"> <b>GRAND TOTAL </b></td>
		<td><input type="text" id="total_debet" name="total_debet" style="text-align:right;background-color:#EFFC94;width:100%" class="mytextbox calculate"></td>
		<td><input type="text" id="total_credit" name="total_credit" style="text-align:right;background-color:#EFFC94;width:100%" class="mytextbox calculate"></td>
	</tr>
	<?php }else{?>
	<tr>
		<td colspan="2"> <b>GRAND TOTAL </b></td>
		<td>
		<input type="hidden" id="total_debetal" style="text-align:right;background-color:#EFFC94;width:100%" class="mytextbox calculate" value="<?php echo $toced;?>">
		<input type="text" id="total_debetac" style="text-align:right;background-color:#EFFC94;width:100%" class="mytextbox calculate" value="0">
		</td>
		<td>
		<input type="hidden" id="total_credital" style="text-align:right;background-color:#EFFC94;width:100%" class="mytextbox calculate" value="<?php echo $todeb;?>">
		<input type="text" id="total_creditac" style="text-align:right;background-color:#EFFC94;width:100%" class="mytextbox calculate" value="0">
		</td>
	</tr>
	<?php } ?>
	<!-- end update danu -->
</table>

<script type="text/javascript"> 
	function clear(){
		$("#acc_dr").val("");
		$("#acc_name").val("");
		$("#acc_debet").val("");
		$("#acc_credit").val("");
	}
	
	if($('#acc_credit_pph').val()){
	var cr4 = $('#acc_credit_pph').val().replace(/,/g,'');
	}else{
	var cr4 = 0;
	}
	if($('#acc_debet_4').val()){
	var db2 = $('#acc_debet_4').val().replace(/,/g,'');
	}else{
	var db2 = 0;
	} 
	if($('#acc_debet_3').val()){
	var db3 = $('#acc_debet_3').val().replace(/,/g,'');
	}else{
	var db3 = 0;
	}
	var tcr = parseInt($('#acc_credit_1').val().replace(/,/g,''))+parseInt(cr4);
	var tdb = parseInt(db2)+parseInt(db3);

	$('#total_debetac').val(numToCurr(parseInt($('#total_debetal').val())+tdb));
	$('#total_creditac').val(numToCurr(parseInt($('#total_credital').val())+tcr));
	
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

