<?=link_tag(CSS_PATH.'x-forminput.css')?>
<?=link_tag(CSS_PATH.'gridtable.css')?>

<?#=script('jquery-1.4.2.min.js')?>

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
			var data=$("#frm_produk").serialize();
			var stat_add=$(this).text();
			if(stat_add=='Add'){
				btn_add.empty();
				btn_add.text('Save');
				empty_record();
				$("#frm_produk >input").removeClass('readonly');
				$("#frm_produk >input").attr('readonly',false);
				$("#cancel2").show();
			}else{
					//alert("test");
					$.getJSON('<?=site_url()?>/purchase_req/crud/'+data, function(data) {
					var row="<tr id='"+data.produk_id+"'><td>"+data.nama_produk+"</td><td>"+data.harga_produk+"</td><td>"+data.qty_produk+"</td><td>"+data.total_produk+"</td></tr>";
					
				
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
				$("#frm_produk >input").removeClass('readonly');
				$("#frm_produk >input").attr('readonly',false);
				btn_edit.empty()
				btn_edit.text('Save');
				$("#cancel").show();
				}else{
				var data=$("#frm_produk").serialize();
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
				$("#nama_produk").val('')
				$("#harga_produk").val('')
				$("#qty").val('')
				$("#total").val('')
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
				
			$("#frm_produk >input").addClass('readonly');
			$("#frm_produk >input").attr('readonly',true);
		}
		
		function hitung(){
			var qty=$("#qty").val();
			var harga=$("#harga_produk").val();
			var jml=eval(qty*harga);
			$("#total").val(jml);
		}
		
	});
</script>




<h2>Aproval Request PR</h2>
<div id="x-input">
 <form action="" method="post">
    <fieldset>
	   <div class="x1">
			<label>Budget Name</label><select name="" readonly="true"></select>
			<label>Tgl. PR</label><input type="text" name="" readonly="true"/>
			<label>No. PR</label><input type="text" name="" readonly="true"/>
       </div>
       <div class="x1">
			<label>Amount</label><input type="text" name="" readonly="true"/>
			<label>Divisi</label><input type="text" name="" readonly="true"/>
			<label>User Requestor</label><input type="text" name="" readonly="true"/><br/>
			<label>Budget</label><input type="radio" name=""/>Budgeted&nbsp;<input type="radio" name=""/>Non Budgeted
       </div>
	   <div class="x1">
			
			<label>Remark</label><textarea name="reamark" ></textarea> 
			<input type="submit" value="Approve" name="approve" /> <input type="submit" value="Unapprove" name="unapprove" />
       </div>
    </fieldset>
 </div>   
 
 <!-- Grid Form  -->
	   
       
