<html>
<head>
	<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
	<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.2.min.js"></script-->
	<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.edatagrid.js"></script>
	<?=script('jquery.formx.js')?>
	<?=script('currency.js')?>
</head>
<body>

<form id="formAdd" action="<?php echo base_url();?>pettycashnew/simpandata" method="post">
	<br>
	<table>
		<tr>
			<h2>FORM ADD</h2>
		</tr>
		<tr>
			<td>Date</td>
			<td> : </td>
			<td><input type="text" id="tgl" name="tgl" style="width:205px;padding:3px;border:1px solid #cbcbcb"/></td>
		</tr>
		<tr>
			<td>Project</td>
			<td> : </td>
			<?php $pro= $this->db->query("select * from db_subproject where pt_id = 11")->result(); ?>
			<td><select name="project" style="width:205px;padding:3px;border:1px solid #cbcbcb">
					<option>-- Choose --</option>
				<?php foreach ($pro as $row) { ?>
					<option value="<?php echo $row->subproject_id;?>"><?php echo $row->nm_subproject;?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Account</td>
			<td> : </td>
			<td><input type="text" name="kode" style="width:205px;padding:3px;border:1px solid #cbcbcb" class="get_coaacno" required/></td>
			<td>Amount</td>
			<td> : </td>
			<td><input type="text" name="amt" id="amt" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb" class="calculate" required/></td>
		</tr>
		<tr>
			<td>Saldo</td>
			<td> : </td>
			<?php $cekptc= $this->db->query("select top(1) * from master_pettycash where status = 1")->row(); ?>
			<td><input type="text" id="saldo" style="text-align:right;width:205px;padding:3px;border:1px solid #cbcbcb" value="<?php echo number_format($cekptc->saldo_mptcash); ?>" readonly/></td>
		</tr>
		<tr>
			<td>Description</td>
			<td> : </td>
			<td><textarea name="desc" style="width:205px;padding:3px;border:1px solid #cbcbcb" required></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="SAVE"/></td>
			<td><input type="reset" value="RESET"/></td>
		</tr>
	</table>
</form>

</body>
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$( ".get_coaacno" ).autocomplete({
		source: function(request, response) {
				$.ajax({ url: "<?php echo site_url();?>autocompleted/get_coa_ptcash",
				data: { term: $(".get_coaacno").val()},
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
</script>

<script type="text/javascript">
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

<script type="text/javascript">
$(document).ready(function() {
	$.fn.datebox.defaults.formatter = function(date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        var d = date.getDate();
        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
    };
	$('#tgl').datebox({  
        required:true  
    });  

    $('.calculate').bind('keyup keypress',function(){
		var rep_coma = new RegExp(",", "g");
		$(this).val(numToCurr($(this).val()));	
		check();
	});
});
</script>

<script type="text/javascript">
function check(){
	var amt = parseInt($("#amt").val().replace(/,/g,''));
	var saldo = parseInt($("#saldo").val().replace(/,/g,''));
	if (amt > saldo) {
		alert('Tidak Boleh Melebihi Saldo');
		document.getElementById('amt').value = 0;
	};
}
</script>

</html>