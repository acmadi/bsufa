<html>
<head>
	<title></title>
	<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<style type="text/css">
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#customers td, #customers th {
    font-size: 1em;
    border: 1px solid #000;
    padding: 3px 7px 2px 7px;
}

#customers th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #5c9ccc;
    color: #ffffff;
}
</style>
<h2>Pilih Barang</h2>
<div class="box-body table-responsive" style="height:300px; overflow:auto;">
<table id="customers" class="table table-bordered table-striped" align="center" border="0" style="width:100%;">
	<tr>
		<th></th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Nilai</th>
		<th>Qty</th>
	</tr>
	<form action="#" method="post">
		<?php foreach ($barangpo as $row) { ?>
			<tr>
				<td><input type="checkbox" name="id[]" value="<?php echo $row->BrgMsk_ID;?>"/></td>
				<td><?php echo $row->kd_brg;?></td>
				<td><?php echo $row->nm_brg;?></td>
				<td><?php echo $row->BrgMsk_ID;?></td>
				<td style="text-align:right;"><?php echo number_format($row->qtyMsk);?></td>
			</tr>
		<? } ?>
</table>
</div>
	<br>
		<input type="submit" class="btn btn-primary" value="Submit"/>
		<input type="reset" class="btn btn-success" value="Reset"/>
	</form>
</body>
</html>