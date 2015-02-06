<?#=script('jquery-1.6.min.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>





<form method="post" id="formAdd" action="<?=site_url('purchase_req/approvalbgt')?>">	

<div class="easyui-tabs" style="width:750px;height:350px;">
	<div title="Budget Ref" style="padding:10px;">
			<input type="hidden" name="id_divisi" value="<?=$div?>"/>
			<input type="hidden" name="id_pt" value="<?=$pt?>"/>
			<input type="hidden" name="idpr" value="<?=$data->id_pr?>"/>
		   <table>
			<tr>
				<td>Budget Name</td>
				<td colspan="3"><input type="text" name="bgtnm" style="width:200px" value="<?=$data->description?>" id="bgtnm" readonly="true"/></td>
			</tr>
			<tr>
				<td>Tgl. PR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=indo_date($data->tgl_pr) ?>" readonly="true"/></td>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" value="<?=number_format($data->amount)?>" style="text-align:right"/></td>
			</tr>
			
			<tr>
				<td>Tgl.Approval</td>
				<td><input type="text" name="tglapp" id="tglapp" value="<?=gettgl(); ?>" readonly="true"/></td>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$data->no_pr?>" style="width:200px" readonly="true"/></td>
			</tr>
			
			<tr>
				<td>Divisi</td>
				<td><input type="text" name="divisipr" value="<?=$divisi_nm?>" id="divisipr" readonly="true"/></td>
				<td>User Requestor</td>
				<td><input type="text" name="reqpr" id="reqpr" value="<?=$nama?>" readonly="true"/></td>
			</tr>
			
					
			<tr>
				<td>Keterangan</td>
				<td colspan= "3">
				<input type="text" name="ketpr" value="<?=$data->ket_pr?>" id="ketpr" readonly="true" class="xinput validate[required]" >
	 
				</td>
			</tr>
			</table>
			
	</div>
	<div title="Request PR" style="padding:10px;">
			<table width="400px">
				<tr>
					<td><b>Nama Barang</b></td>
					<td><b>Unit</b></td>
					<td><b>QTY</b></td>
					<td><b>Vendor</b></td>
				</tr>
					<?php foreach($cekord as $row):?>
						<tr>
						<td><?=$row->nm_brg?></td>
						<td><?=$row->unit_brg?></td>
						<td><?=$row->qty_brg?></td>
						<td><?=$row->recvendor?></td>
						</tr>
					<?php endforeach;?>	
			</table>
	</div>	
</div>
	<label>Alasan</label> <input type="text" name="alasan" id="alasan" size="20"/>
	<input type="submit" name="save" value="Approval"/>
	<input type="submit" name="save" value="UnApproval"/>
</form>


