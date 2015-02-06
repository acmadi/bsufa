<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=link_tag(CSS_PATH.'gridtable.css')?>


<script type="text/javascript">
$(function(){
		var num=$("#total_record").val();
		var id_product =$("table#barang tbody tr:first").attr('id');
		$("table#barang tbody tr:first").addClass('select');
		var btn_edit=$("#edit")
		var btn_add=$("#add");
		
		// Mengambil data dari database dan menampilakannya di form
			$.getJSON('<?=site_url()?>/purchase_req/crud/load/'+id_product, function(data) {
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
		$.getJSON('<?=site_url()?>/purchase_req/crud/load/'+id_product, function(data) {
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
					$.getJSON('<?=site_url()?>/purchase_req/add/'+nm_supp+'/'+satuan+'/'+qty+'/'+vendor, function(data) {
						alert(data);
					var row="<tr id='"+data.no_pr+"'><td>"+data.nm_supp+"</td><td>"+data.satuan+"</td><td>"+data.qty+"</td><td>"+data.vendor+"</td></tr>";
					
				
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
				$.getJSON('<?=site_url()?>/purchase_req/crud/'+data, function(data) {
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
		  
		  $.getJSON('<?=site_url()?>/purchase_req/crud/'+id, function(data) {		
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




<h2>Input Purchase Request</h2>
<div id="x-input">
 <form action="" method="post">
    <fieldset>
	   <div class="x1">
			<label>Budget Name</label><select name=""></select>
			<label>Tgl. PR</label><input type="text" name=""/>
			<label>No. PR</label><input type="text" name=""/>
       </div>
       <div class="x1">
			<label>Amount</label><input type="text" name=""/>
			<label>Divisi</label><input type="text" name=""/>
			<label>User Requestor</label><input type="text" name=""/><br/>
			<label>Budget</label><input type="radio" name=""/>Budgeted&nbsp;<input type="radio" name=""/>Non Budgeted
       </div>
    </fieldset>
 </div>   
 
 <!-- Grid Form  -->
<div id="content">
	<h2>Purchasing Request</h2>
	<!-- Cek Barang -->
	<table>
		<thead>
			<th><b>Nama Barang / Inventaris</b></th>
			<th><b>Satuan Unit</b></th>
			<th><b>Qty</b></th>
			<th><b>Vendor Recomended</b></th>
		</thead>
		<tbody>
			<tr>
				<td width="150px"><input type="text" name="nm_supp" value="" width="150px" id="nm_supp" class='chinput' readonly='true'/></td>
				<td width="80px"><input type="text" name="satuan" value="" id="satuan" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="qty" value="" id="qty" class='chinput rounded-corners readonly' readonly='true'/></td>
				<td width="80px"><input type="text" name="vendor" value="" id="vendor" class='chinput rounded-corners readonly' readonly='true'/></td>
			</tr>
		</tbody>
	</table>

	<button type='button' class='button rounded-corners' id='edit'>Edit</button>
	<button type='button' class='button rounded-corners' id='cancel' style='display:none;'>Cancel</button>
	<div class='right'>
		<button type='button' class='button rounded-corners' id='add'>Add</button>
		<button type='button' class='button rounded-corners' id='cancel2' style='display:none;'>Cancel</button>
		<button type='button' class='button rounded-corners' id='del'>Hapus</button>		
	</div><input type='hidden' size='15' name='total_record' id='total_record' >
	<hr/>
	<div class="terms">
		<table id="barang">
			<!--thead>
			
				<th>Nama Barang / Inventaris</th>
				<th>Satuan Unit</th>
				<th>Qty</th>
				<th>Vendor Recomended</th>
			</thead-->
			<tbody>
				<?php foreach($pr as $row):?>
					<tr id="XD<?=$row->id_pnwrven?>">
						<td width="150px"><?=$row->nm_supp?></td>
						<td width="80px"><?=$row->harga_sat?></td>
						<td width="80px"><?=$row->kd_supp?></td>
						<td width="80px"><?=$row->disc?></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
   

