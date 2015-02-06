<html>
<head>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.8.2.min.js"></script>

</head>

<script type="text/javascript">
$(document).ready(function() {
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));			
	});
});
</script>

<style>
	.ui-autocomplete {
		max-height: 150px;
		overflow-y: auto;
		overflow-x: hidden;
	}
	* html .ui-autocomplete {
		height: 150px;
	}
	.customBg{
		display:block;
		margin-height:-2px;
		margin-left:-2px;
		height: 14px;
		padding: 4px;
	}
	.customBg2{
		display:block;
		margin-height:-2px;
		margin-left:-2px;
		height: 14px;
		padding: 4px;
	}

	.mytextbox {
		font: 12px Arial, Helvetica, sans-serif;
	    border: 1px solid #008B8B;
	    padding: 5px;
	   
	}
	.mytextboxx {
		font: 14px Arial, Helvetica, sans-serif;
		width: 90px;
		height: 42px;
		border: 1px solid #EFFC94;
		background: #B9B9B9;
		color: #5D781D;  
	}

	td {
		padding: 6px 5px 2px 5px;
		border: 0px solid #DEDEDE;
		text-transform: uppercase;
		font: normal 11px Arial, Helvetica, sans-serif;
		color: #5D781D;1px solid #D6DDE6;	   
	}
</style>

<body>
<?php
$session_id = $this->UserLogin->isLogin();
$proj = $this->db->query("select * from db_subproject where id_pt = ".$session_id['id_pt']." ")->result();
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#pt').change(function() {
			$.post("<?php echo base_url(); ?>cb/begincash/get_project/" + $('#pt').val(), {}, function(obj) {
                $('#project').html(obj);
            });
		});
		$('#project').change(function() {
			$.post("<?php echo base_url(); ?>cb/begincash/get_bank/" + $('#project').val(), {}, function(obj) {
                $('#bank').html(obj);
            });
		});
	});
</script>

<form method="post" action="<?php echo  base_url();?>cb/begincash/updateheader/<?php echo $data->id_dailycash;?>">
	<!--input type="hidden" name="project" id="project" value="<?=$data->id_project?>"/-->
	<table>
		<tr>
			<h3>FORM EDIT NILAI BEGINNING</h3>
		</tr>
		<!--tr>
			<td>NAMA PT</td>
			<td> : </td>
			<td>
				<select name="pt" id="pt" class="mytextbox">
					<option value="<?=$data->id_pt?>"> <?=$data->nm_pt?> </option>
					<option> PILIH PT </option>
					<?php foreach ($pt as $row) {
						echo "<option value=".$row->id_pt."> ".$row->nm_pt." </option>";
					}?>
				</select>
			</td>
		</tr-->
		<tr>
			<td>PROYEK</td>
			<td> : </td>
			<td>
				<select name="project" id="project" class="mytextbox" style="width:300px;">
					<option value="<?=$data->id_project?>"> <?=$data->nm_subproject?> </option>
					<option> PILIH PROYEK </option>
					<?php foreach ($proj as $row) { ?>
						<option value="<?=@$row->subproject_id; ?>"><?=@$row->nm_subproject; ?></option>
					<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>BANK</td>
			<td> : </td>
			<td>
				<select name="bank" id="bank" class="mytextbox" style="width:300px;">
					<option value="<?=$data->bank_id?>"> <?=$data->namabank?> - <?=$data->nomorrek?> </option>
					<option> PILIH BANK </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>NILAI BEGINNING</td>
			<td> : </td>
			<td><input type="text" name="begin" class="mytextbox calculate" style="text-align:right;" value="<?=number_format($data->begin_amount);?>"/></td>
		</tr>
		<tr>
			<td><input type="submit" class="mytextboxx" name="submit" value="SIMPAN"/></td>
		</tr>
	</table>
</form>
</body>

<script type="text/javascript">
$(document).ready(function() {
	$( ".my-auto-complete" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocompleted/get_project_pt",
				data: { term: $(".my-auto-complete").val().replace(/ /g,''),idpt: $("#pt").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		select: function (event, ui) {
			var id = ui.item.id;
			$("#project").val(id);
		},
		minLength: 1
	});

	$(".my-auto-complete").bind("keyup click blur focus",function(){
			var idpro = $("#project").val();
			$.post("<?php echo base_url(); ?>cb/begincash/get_bank/"+idpro,{},function(obj){
				$('#bank').html(obj);
			});
		});
});
</script>

</html>