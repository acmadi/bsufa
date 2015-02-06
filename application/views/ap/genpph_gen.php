<?php $this->load->library('session');?>
<style>
	.mytextbox{
		border:1px solid #cbcbcb;
		padding:2px;
	}
	
	.btn-small {
		background-color:#cdcdcd;
		color: #666666;
		text-align: center;
		text-decoration: none;
		width:60px;
		height:20px;
	}

	.btn-small:hover {
		cursor: pointer;
		background-color:#bcbcbc;
		color:#555555;
		border:1px solid #cbcbcb;
	}
	
	.btn-normal {
		padding:4px 4px;
		margin-top:10px;
		background-color:#cdcdcd;
		color: #666666;
		text-align: center;
		text-decoration: none;
		width:100px;
		height:30px;
	}

	.btn-normal:hover {
		cursor: pointer;
		background-color:#bcbcbc;
		color:#555555;
		border:1px solid #cbcbcb;
	}
</style>

</head>

<body>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>


<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>


<?=script('jquery.formx.js')?>
<?=script('currency.js')?>


<script type="text/javascript">	
		
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#gendate').datebox({  
			required:true  
		});
								

</script>
	<h2 style="margin-top:10px">Generate PPh</h2>
<form method="post" action="<?php echo site_url();?>ap/genpph/gen">
<table>
<tr>
	<td>Ass Off</td>
	<td><input type="text" name="assoff" id="gendate"></td>
</tr>
<tr>
	<td colspan=2><input type="submit" value="Gennerate"></td>
</tr>
</table>
</form>