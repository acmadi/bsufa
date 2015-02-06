<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>

<script type="text/javascript">
$(function(){
	/* auto complete single jurnal (credit) */ 
	$( ".auto-j_coa" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_jcoa",
				data: { term: $(".auto-j_coa").val().replace(/ /g,'')},
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
	
	/* auto complete single jurnal (debet) */ 
	$( ".auto-acc_dr" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_accdr",
				data: { term: $(".auto-acc_dr").val().replace(/ /g,'')},
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
			$(".auto-acc_name").val(id);
		},
		minLength: 1
	});
});
</script>
<?php 
	$sql = "select db_kelusaha.acc_dr, db_coa.acc_name from 
				pemasok inner join db_kelusaha on pemasok.id_kelusaha = db_kelusaha.id_kelusaha 
				inner join db_coa on db_kelusaha.acc_dr = db_coa.acc_no
				where pemasok.nm_supplier = '$suppl'";//var_dump($sql);
	$row = $this->db->query($sql)->result();
?>
<br><br>
<table border="1" height="100px" width="90%">
	<tr height="25px">
		<td align="center">COA</td>
		<td align="center">Account Name</td>
		<td align="center">Debet</td>
		<td align="center">Kredit</td>
	</tr>
	<?php foreach($row as $r):?>
	<tr height="15px">
		<td align="center"><input type="text" name="j_coa" id="j_coa" class="auto-j_coa" value="<?php echo $r->acc_dr;?>"></td>
		<td align="center"><input type="text" name="j_name" id="j_name" class="auto-j_name" value="<?php echo $r->acc_name;?>"></td>
		<td align="center">-</td>
		<td align="right"><input type="text" name="j_kredit" id="j_kredit" value="<?php echo $kredit;?>"></td>
	</tr>
	<?php endforeach;?>
	<tr height="15px">
		<td align="center"><input type="text" id="acc_dr" class="auto-acc_dr"></td>
		<td align="center"><input type="text" id="acc_name" class="auto-acc_name"></td>
		<td align="right"><input type="text"  id="acc_debet" class="auto-acc_debet"></td>
		<td align="center">-</td>
	</tr>
</table>
