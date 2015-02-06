<html>
<head>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<?=script('jquery.formx.js')?>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-ui-1.8.2.min.js"></script>

</head>

<script type="text/javascript">
$(document).ready(function() {
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));			
	});
});

$('#formAdd').ajaxForm({
	success:function(response){
		if(response=="sukses"){
			alert(response);
			refreshTable();
		}else{
			alert(response);
		}
	}
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
<form method="post" action="<?php echo base_url();?>cb/begincash/saveheader">
	<table>
		<tr>
			<h3>FORM ADD SALDO AWAL</h3>
		</tr>
		<!--tr>
			<td>NAMA PT</td>
			<td> : </td>
			<td>
				<select name="pt" id="pt" class="mytextbox" style="width:300px;">
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
					<option> PILIH BANK </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>SALDO</td>
			<td> : </td>
			<td><input type="text" name="begin" class="mytextbox calculate" style="text-align:right;width:300px;"/></td>
		</tr>
		<tr>
			<td><input type="submit" class="mytextboxx" name="submit" value="SIMPAN"/></td>
		</tr>
	</table>
</form>
</body>


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


</html>