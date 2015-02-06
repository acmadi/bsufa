<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=script('currency.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>
<script type="text/javascript">
$(function(){
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
	    $('#tgl_kirim').datebox({  
			required:true  
		}); 		
	
	
	$("#supp").change(function(){
		var id_pr = $("#id_pr").val();
		$.getJSON('<?=site_url('po/cekdt')?>/'+$(this).val()+'/'+id_pr,
			function(data){
				$("#pic").val(data.kontak);
				$("#alamat").val(data.alamat);
				$("#kota").val(data.kota);
				$("#tlp").val(data.tlp);
				$("#fax").val(data.fax);
				$("#kd_pos").val(data.kodepos);
				$("#idpnwr").val(data.id_pnwrven);
				$("#kd_supp").val(data.kd_supp);
				$("#nm_supp").val(data.nm_supp);
			});
			
		$.getJSON('<?=site_url('po/cekalldt')?>/'+$(this).val()+'/'+id_pr,
			function(data){
				$("table#dver tbody").empty();
				var tot_all = 0 ;
				//var subtotal = 
				for(var x=0;x<data.length;x++){
					var row="<tr><td>"+data[x].kd_brg_ver+"</td><td>"+data[x].nm_brg_ver+"</td><td align='right'>"
						    +data[x].qty_req+"</td><td>"+data[x].unit_brg+"</td><td align='right'>"
						    +numToCurr(data[x].harga_sat)+"</td><td align='right'>"+data[x].discnilai+"</td><td align='right'>"
						    +numToCurr(data[x].subtotal)+"</td></tr>";
					//alert(row);
					tot_all = parseInt(tot_all) + parseInt(data[x].subtotal);	
					$("table#dver tbody").append(row);							
				}
					var ppn  = tot_all * 0.1;
					var subtotal = tot_all - ppn;
					$("#tot_all").val(numToCurr(tot_all));
					$("#ppn").val(numToCurr(ppn));
					$("#sub_all").val(numToCurr(subtotal));
				    
								
			});
			
			
	});
		
});	
</script>


<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('po/saveall'), $attr);
?>
<div style="width:900px">
	<div class="x1">
		<input type="hidden" name="div_pr" value="<?=$data->div_pr?>"/>
		<input type="hidden" name="kd_supp" id="kd_supp"/>
		<input type="hidden" name="nm_supp" id="nm_supp"/>
		<input type="hidden" name="ket" value="<?=$data->ket_pr?>"/>
		<input type="hidden" name="id_pr" id="id_pr" value="<?=$data->id_pr?>"/>
		<label>Divisi</label><input type="text" name="divisi" id="divisi" value="<?=$data->divisi_nm?>" readonly="true"/><br/>
		<label>Reff PR</label><input type="text" name="reff" style="width:185px" readonly="true" value="<?=$data->no_pr?>"/><br/>
		<label>Tgl PO</label><input type="text" name="tgl_po" id="tgl_po" readonly="true" value="<?=gettgl();?>" style="width:90px"/><br/>
		<label>No. PO</label><input type="text" name="no_po" id="no_po" readonly="true" style="width:185px" value="<?=$no_po?>" style="width:150px"/><br/>
		<label>Kode Pos</label><input type="text" name="kd_pos" id="kd_pos" readonly="true" style="width:60px"/><br/>	
	    <label>Mata Uang</label>
			<select name="uang" id="uang">
				<option></option>
				<option>IDR</option>
				<option>USD</option>
			</select>
		<br/>
	</div>
	<div class="x1">
		<input type="hidden" name="idpnwr" id="idpnwr"/>
		<label>Supplier</label>
				<select name="supp" id="supp">
						<option></option>
					<?php foreach($ven as $row): ?>
						<option value="<?=$row->kd_supp?>"><?=$row->nm_supp?></option>
					<?php endforeach; ?>
				</select><br/>
		<label>PIC</label><input type="text" name="pic" id="pic" readonly="true" style="width:80px"/><br/>
		<label>Alamat</label><input type="text" name="alamat" id="alamat" readonly="true" style="width:150px"/><br/>
		<label>Kota</label><input type="text" name="kota" id="kota" readonly="true" style="width:80px"/><br/>
		<label>Telpon</label><input type="text" name="tlp" id="tlp" readonly="true" style="width:90px"/><br/>
		<label>Fax</label><input type="text" name="fax" id="fax" readonly="true" style="width:90px"/><br/>	
	</div>
</div>
<br/><br/>
<table width="750px" border="1" id="dver" style="padding:20px 0 0 0">
	<thead>
		<tr>
			<th width="80px">Kode</th>
			<th width="120px">Nama Barang</th>
			<th width="50px">Qty</th>
			<th width="60px">Satuan</th>
			<th width="90px">Hrg. Satuan</th>
			<th width="90px">Diskon</th>
			<th width="90px">Subtotal</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<div style="width:900px;padding:20px 0 0 0">
	<div class="x1">
		<label>Ttd 1</label>
			<select name="ttd1" id="ttd1">
				<option></option>
				<option>Totot Prihartono</option>
				<option>Hendra Iswadi</option>
			</select><br/>
		<label>Ttd 2</label>
			<select name="" id="">
				<option></option>
				<option>Darnu</option>
				<option>Bakti</option>			
			</select><br/>
		<label>Dikirim ke</label><input type="text" name="kirim" id="kirim" style="width:180px"/><br/>
		<label>Pembayaran</label><input type="text" name="bayar" id="bayar" style="width:120px"/><br/>
		<label>Tgl. Kirim</label><input type="text" name="tgl_kirim" id="tgl_kirim" style="width:90px;height:15px" readonly="true"/><br/>
	</div>
	<div>
		<label>Total All</label><input type="text" name="tot_all" class="input" id="tot_all" style="width:120px;text-align:right" readonly="true"/><br/>
		<label>PPN 10%</label><input type="text" name="ppn" class="input" id="ppn" style="width:120px;text-align:right" readonly="true"/><br/>
		<label>Subtotal</label><input type="text" name="sub_all" class="input" id="sub_all" style="width:120px;text-align:right" readonly="true"/><br/>
		<input type="submit" name="generate" value="Generate"/>
		<input type="button" name="close" value="Close"/>
	</div>
</div>
<?=form_close()?>

   

