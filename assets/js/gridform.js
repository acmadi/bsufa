$(function(){
		var num=$("#total_record").val();
		var id_product=$("table#barang tbody tr:first").attr('id');
		$("table#barang tbody tr:first").addClass('select');
		var btn_edit=$("#edit")
		var btn_add=$("#add");
		
		// Mengambil data dari database dan menampilakannya di form
			$.getJSON('crud.php?oper=load&id='+id_product, function(data) {
				$("#nama_produk").val(data.nama_produk)
				$("#harga_produk").val(data.harga_produk)
				$("#qty").val(data.qty_produk)
				$("#total").val(data.total_produk)
				$("#id_product").val(data.produk_id)
				$("#total_record").val(data.total_record)
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
					$.getJSON('crud.php?oper=add&'+data, function(data) {
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
				$.getJSON('crud.php?oper=edit&'+data, function(data) {
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
		
		function loadForm(id_product){
		$.getJSON('crud.php?oper=load&id='+id_product, function(data) {
				empty_record();	
				$("#nama_produk").val(data.nama_produk)
				$("#harga_produk").val(data.harga_produk)
				$("#qty").val(data.qty_produk)
				$("#total").val(data.total_produk)
				$("#id_product").val(data.produk_id)
				$("#total_record").val(data.total_record)
				})
		}
		
		// HAPUS DATA
		$("#del").click(function(){
				alert("test");
				var id=$("#id_product").val();
				del(id);
		})
		
	    function del(id){
		  var x=$("table#barang tbody tr#"+id).attr('id')
		  
		  $.getJSON('crud.php?oper=del&id_product='+id, function(data) {		
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
		
	})
