<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=link_tag(CSS_PATH.'gridtablegeneratepo.css')?>


<script type="text/javascript">
$(function(){
		var num=$("#total_record").val();
		var id_product =$("table#barang tbody tr:first").attr('id');
		$("table#barang tbody tr:first").addClass('select');
		var btn_edit=$("#edit")
		var btn_add=$("#add");
		
		// Mengambil data dari database dan menampilakannya di form
			$.getJSON('<?=site_url()?>/prverifikasi/crud/load/'+id_product, function(data) {
				$("#nm_supp").val(data.nm_supp);
				$("#satuan").val(data.harga_sat);
				$("#qty").val(data.kd_supp);
				$("#vendor").val(data.disc);
				$("table#barang tbody tr#"+data.id).addClass("select");
			})
			
		// Mengambil id_record dan meload data dari database menggunakan ajax
		$("table#barang tbody tr").click(function(){
				var id_product=$(this).attr('id');
				$("table#barang tbody tr.select").removeClass("select");
				loadForm(id_product);
				$("table#barang tbody tr#"+id_product).addClass("select");
				cancel();
		})
		
		function loadForm(id_product){
		$.getJSON('<?=site_url()?>/prverifikasi/crud/load/'+id_product, function(data) {
				empty_record();	
				$("#nm_supp").val(data.nm_supp);
				$("#satuan").val(data.harga_sat);
				$("#qty").val(data.kd_supp);
				$("#vendor").val(data.disc);
				})
		}
		

		$("#add").click(function(){
			//alert("test");
			//var data=$(".chinput").serialize();
			var nm_supp = $('#nm_supp').val();
			var satuan = $('#satuan ').val();
			var qty = $('#qty').val();
			var vendor = $('#vendor').val();
			
			var stat_add=$(this).text();
			if(stat_add=='Add'){
				btn_add.empty();
				btn_add.text('Save');
				empty_record();
				$(".chinput").removeClass('readonly');
				$(".chinput").attr('readonly',false);
				$("#cancel2").show();
			}else{
					//alert(data);
					$.getJSON('<?=site_url()?>prverifikasi/tambah/'+nm_supp+'/'+satuan+'/'+qty+'/'+vendor, function(data) {
					var row="<tr id='"+data.no_pr+"'><td>"+data.nm_supp+"</td><td>"+data.harga_sat+"</td><td>"+data.disc+"</td><td>"+data.alasan+"</td></tr>";
					
				
				$("table#barang tbody").append(row)
				$("#cancel2").hide();
				btn_add.empty();
				btn_add.text('Add');
				})	
			}
			

			return false;
		})
		
		
		$("#edit").click(function(){
				var id=$("#id_product").val();
				var stat=$(this).text();
				if(stat=='Edit'){
				$("#frm >input").removeClass('readonly');
				$("#frm >input").attr('readonly',false);
				btn_edit.empty()
				btn_edit.text('Save');
				$("#cancel").show();
				}else{
				var data=$("#frm").serialize();
				$.getJSON('<?=site_url()?>/prverifikasi/crud/'+data, function(data) {
					var row="<td>"+data.nama_produk+"</td><td>"+data.harga_produk+"</td><td>"+data.qty_produk+"</td><td>"+data.total_produk+"</td>";
				$("table#barang tbody tr#"+data.produk_id).empty()
				$("table#barang tbody tr#"+data.produk_id).append(row)
				btn_edit.empty()
				$("#cancel").hide();
				btn_edit.text('Edit');		
				cancel();
				})
				}
			
													
		})
		
		$("#cancel").click(function(){
				btn_edit.empty()
				btn_edit.append('Edit');
				$(this).hide();
				cancel();
												
		})
			$("#cancel2").click(function(){
				btn_add.empty();
				btn_add.text('Add');
				cancel();
				$("#cancel2").hide();
												
		})
	
		// 
		function empty_record(){
				$("#nm_supp").val('')
				$("#satuan").val('')
				$("#qty").val('')
				$("#vendor").val('')
		}
		

		// HAPUS DATA
		$("#del").click(function(){
				alert("test");
				var id=$("#id_product").val();
				del(id);
		})
		
	    function del(id){
		  var x=$("table#barang tbody tr#"+id).attr('id')
		  
		  $.getJSON('<?=site_url()?>/prverifikasi/crud/'+id, function(data) {		
			  $("table#barang tbody tr#"+data.produk_id).fadeOut();
				empty_record();	
				})
		  if(x!=id){
		   alert("Please, select row");
		   }
		}
	
		$("#qty, #harga_produk").keyup(function(){
			hitung();
		})

		function cancel(){
				
			$("#frm >input").addClass('readonly');
			$("#frm >input").attr('readonly',true);
		}
		
		function hitung(){
			var qty=$("#qty").val();
			var harga=$("#harga_produk").val();
			var jml=eval(qty*harga);
			$("#total").val(jml);
		}
		
	});
	
	
	
	
</script>


<label>Pilih Vendor</label><select name="pilihvend" id="pilihvend" class="rounded-corners validate[required]">
			<option value="">--pilih--</option>
			<option value="">1</option>
			<option value="">2</option>
			</select>
			
<br />

<div id="x-input">
 <form action="" method="post">
    <div id="content">
    
    <fieldset>
	   <div class="x1">
		    <label>Divisi</label><input type="text" name="divisi" value="" width="150px" id="divisi" class='chinput' readonly='true'/><br />
			<label>Reff.PR#</label><input type="text" name="reffpr" value="" width="150px" id="reffpr" class='chinput' readonly='true'/><br />
			<label>Tgl. PO</label><input type="text" name="tglpo" value="" width="150px" id="tglpo" class='chinput' readonly='true'/><br />
			<label>No. PO</label><input type="text" name="nopo" value="" width="150px" id="nopo" class='chinput' readonly='true'/><br />

       </div>
       <div class="x1">
			<label>Supplier</label><input type="text" name="" class='chinput rounded-corners readonly'/><br />
			<label>alamat</label><textarea name="remark" id="remark" class="rounded-corners validate[required] " style="width:180px;height:70px" readonly="true"></textarea><br />
			<label>Kota</label><input type="text" name="" class='chinput rounded-corners readonly'/><br/>
			<label>Mata Uang</label><input type="text" name="" class='chinput rounded-corners readonly' value='1'/>
			
		</div>
       <div class="x1">
			<label>PIC</label><input type="text" name="" class='chinput rounded-corners readonly' value='1'/>
			<label>Kode Pos</label><input type="text" name="" class='chinput rounded-corners readonly'/><br/>
			<label>Tlp</label><input type="text" name="" class='chinput rounded-corners readonly'/><br/>
			<label>Fax</label><input type="text" name="" class='chinput rounded-corners readonly'/><br/>
			<label>Kurs</label><input type="text" name="" class='chinput rounded-corners readonly'/><br/>
			
		</div>
       <div class="x2">
			<label>Uraian</label><textarea name="remark" id="remark" class="rounded-corners validate[required] " style="width:900px;height:70px" readonly="true"></textarea><br/>
		</div>
        </fieldset>
    
    </div>
 </div>   
 
 <!-- Grid Form  -->
<div id="content">
	
	<!-- Cek Barang -->
	<!--div class="terms">
	<table>
		<thead>
			<th>Kode</th>
			<th>Type</th>
			<th>Nama Barang</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Hrg. Satuan</th>
			<th>Disc (%)</th>
			<th>Discount</th>
			<th>PPN</th>
		</thead>
		<tbody>
			<tr>
				<td width="150px"><input type="text" name="nm_supp" value="" width="150px" id="nm_supp" class='chinput' readonly='true'/></td>
				<td width="80px"><input type="text" name="satuan" value="" id="satuan" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="qty" value="" id="qty" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="vendor" value="" id="vendor" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="vendor" value="" id="vendor" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="vendor" value="" id="vendor" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="vendor" value="" id="vendor" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="vendor" value="" id="vendor" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="vendor" value="" id="vendor" class='chinput rounded-corners readonly' readonly='true'/></td>
			</tr>
		</tbody>
	</table>
</div>
	<button type='button' class='button rounded-corners' id='edit'>Edit</button>
	<button type='button' class='button rounded-corners' id='cancel' style='display:none;'>Cancel</button>
	<div class='right'>
		<button type='button' class='button rounded-corners' id='add'>Add</button>
		<button type='button' class='button rounded-corners' id='cancel2' style='display:none;'>Cancel</button>
		<button type='button' class='button rounded-corners' id='del'>Hapus</button>		
	</div><input type='hidden' size='15' name='total_record' id='total_record' -->
	<hr/>
	<div class="terms">
		<table id="barang">
			<thead>
				<th style="width:500px">Kode</th>
				<th style="width:300px">Type</th>
				<th style="width:500px">Nama Barang</th>
				<th style="width:500px">Qty</th>
				<th style="width:500px">Satuan</th>
				<th style="width:500px">Hrg. Satuan</th>
				<th style="width:100px">Disc (%)</th>
				<th style="width:100px">Discount</th>
				<th style="width:100px">PPN</th>
			</thead>
			<tbody>
				
					<tr >
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						<td style="width:100px">tes</td>
						
					</tr>
			
			</tbody>
		</table>
		
	</div>
</div>



   

