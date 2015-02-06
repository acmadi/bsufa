<? //var_dump($data);?>
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
<script type="text/javascript">
function myFunction() {
	return confirm("Apakah anda Yakin?");
}
	
$(function() {
	$(".get_vendorname").hide();
	$(".save_btn").hide();
	$(".reset_btn").hide();
	
	
	$(".opt-get_row").click(function(){
		var c = this.getAttribute('opt_get_povalue');
		var is_check = $("#opt"+c).is(":checked");
		if(is_check){
			$("#z"+c).css("background-color","#ffffff");
			$("#opt"+c).attr("checked",false);
		}else{
			$("#z"+c).css("background-color","#ff8379");
			$("#opt"+c).attr("checked","checked");
		}
		
	});
	
	
});
</script>
</head>

<body>
<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.easyui.min.js"></script>


<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.css" />
<script src="<?=base_url()?>assets/js/jquery-ui-1.8.2.min.js"></script>


<?=script('jquery.formx.js')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('currency.js')?>


<script type="text/javascript">	
$(document).ready(function(){
	$("#inputpph").hide();
	$("#pph").change(function(){
		$("#inputpph").show();
	});
});

	$(function(){
		/* Choise customer and get value */
		$(".id-ap_project").change(function(){
			var v = $(".id-ap_project").val();
			$(".id-project").val(v);
		});
		$(".auto-complete-cus").bind("keyup click blur focus",function(){
			var idp = $(".id-project").val();
			var idc = $(".id-complete-cus").val();
			$.post("<?php echo base_url(); ?>/ap/apinvoice/get_unitcus/"+idp+"/"+idc,{},function(obj){
				$('#pilih_unit').html(obj);
			});
		});
		$("#pilih_unit").change(function(){
			var c = $("#pilih_unit").val();
			$.post("<?php echo base_url(); ?>/ap/apinvoice/get_billingcus/"+c,{},function(obj){
				$('#billing_cus').html(obj);
			});
		});
		
		$('#billing_cus').change(function(){
			var c = $('#billing_cus').val();
			$.ajax({
				url		: '<?=site_url();?>/ap/apinvoice/get_bankname',
				type	: 'post',
				data	: {'c':c},
				success	: function(data){
					$("#bank_nama").val(data)
					
				}
			});
		});
						
		<!-- start autocomplete parsing data -->
		<!-- PO -->
         $( ".auto-complete-po" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_po",
					data: { term: $(".auto-complete-po").val().replace(/ /g,'')},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			select: function (event, ui) {
				var id = ui.item.id;
				$(".id-complete-po").val(id);
				//alert(id);return false;
				$.getJSON('<?=site_url()?>/ap/apinvoice/getdetBUDPO/' + id,
				function(getdata){				
					$('#vendor').val(getdata.NM_SUPP);	
					$('#npwppo').val(getdata.NPWP);
					$('#alamat').val(getdata.ALAMAT);	
					$('#category').val(getdata.KEL_USAHA);
					$('#total_billing').val(numToCurr(getdata.HARGA_TOT));
					$('#paid_billing').val(numToCurr(getdata.PAID));
					$('#balance').val(numToCurr(getdata.BALANCE));
					$('#total_invoice').val(numToCurr(getdata.TRX_AMT));
				});
			},
			minLength: 1
		});
		
		<!-- CJC -->
		$( ".auto-complete-cjc" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_cjc",
					data: { term: $(".auto-complete-cjc").val().replace(/ /g,'')},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			select: function (event, ui) {
				var id = ui.item.id;
				$(".id-complete-cjc").val(id);
				
				$.getJSON('<?=site_url()?>/apinvoice/getcjc/' + id,
				function(getcjc){				
					$('#vendor-cjc').val(getcjc.nm_supplier);	
					$('#total_billing').val(numToCurr(getcjc.contract_amount));
				});

			},
			minLength: 1
		});
		
		<!-- Project -->
		$( ".auto-complete-pro" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_pro",
					data: { term: $(".auto-complete-pro").val().replace(/ /g,'')},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			select: function (event, ui) {
				var id = ui.item.id;
				$(".id-complete-pro").val(id);
				$.getJSON('<?=site_url()?>/apinvoice/nonkontrak/' + id,
				function(nonkontrak){				
					$('#remark').val(nonkontrak.mainjob_desc);	
					$('#total_billing').val(numToCurr(nonkontrak.mainjob_total));	
				});
			},
			minLength: 1
		});
		
		<!-- Operasional -->
		$( ".auto-complete-ope" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_ope",
					data: { term: $(".auto-complete-ope").val().replace(/ /g,'')},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			select: function (event, ui) {
				var id = ui.item.id;
				$(".id-complete-ope").val(id);
				$.getJSON('<?=site_url()?>/apinvoice/operational/' + id,
				function(operational){				
					$('#remark').val(operational.remark);	
					$('#total_billing').val(numToCurr(operational.amount));
				});
			},
			minLength: 1
		});
		
		<!-- Customer -->
		$( ".auto-complete-cus" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_cus",
					data: { 
						term: $(".auto-complete-cus").val().replace(/ /g,''),
						idprojek: $(".id-project").val()
					},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			select: function (event, ui) {
				var id = ui.item.id;
				$(".id-complete-cus").val(id);
			},
			minLength: 1
		});
		
		<!-- end autocomplete parsing data -->
		
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			var d = date.getDate();
			return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
		};	
		
		$('#inv_date2').datebox({  
			required:true  
		});
		$('#receipt_date2').datebox({  
			required:true  
		});
		$('#inv_date').datebox({  
			required:true  
		});
		$('#receipt_date').datebox({  
			required:true  
		});
		$('#inv_date3').datebox({  
			required:true  
		});
		$('#receipt_date3').datebox({  
			required:true  
		});
								
	
	
	var rep_coma = new RegExp(",", "g");
		$("#po").change(function(){
	//alert('tes');
			$.getJSON('<?=site_url()?>/apinvoice/getdata/' + $(this).val(),
			function(getdata){				
				$('#vendor').val(getdata.NM_SUPP);	
				$('#category').val(getdata.KEL_USAHA);
				$('#total_billing').val(numToCurr(getdata.HARGA_TOT));
				$('#paid_billing').val(numToCurr(getdata.PAID));
				$('#balance').val(numToCurr(getdata.BALANCE));
				$('#total_invoice').val(numToCurr(getdata.TRX_AMT));
			});
		});	
						
		$('.calculate').bind('keyup keypress',function(){
			
			$(this).val(numToCurr($(this).val()));
			
			var amount = parseInt($('#amount').val().replace(rep_coma,""));
			var total = parseInt($('#total_billing').val().replace(rep_coma,""));
			var total_invoice = parseInt($('#total_invoice').val().replace(rep_coma,""));
			var grand_total = amount+total_invoice;
					
			if (grand_total > total) {

				alert('Nilai Invoice lebih besar daripada Nilai Invoice PO');
				$('#amount').val(0);
			}
			else if (grand_total3 > total3) {
			
				alert('Nilai Invoice lebih besar daripada Nilai Invoice CJC');
				$('#amount3').val(0);
			}
			else {

				var amount2 = parseInt($('#amount2').val().replace(rep_coma,""));
				//var amount3= parseInt($('#amount3').val().replace(rep_coma,""));

				var nett = amount/1.1
				var ppn = nett * 0.1;

				$('#ppn').val(numToCurr(ppn));
			}
		});		
		
		$('.calculate').bind('keyup keypress',function(){
			
			$(this).val(numToCurr($(this).val()));
			
			var budget = parseInt($('#jobs2').val().replace(rep_coma,""));
			var amount = parseInt($('#amount2').val().replace(rep_coma,""));
			
					if (amount > budget) {
					
                              alert('Nilai Invoice lebih besar daripada Nilai Budget');
							  $('#amount2').val(0);
							}
							});	
		

		
		$('#dd').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kode_bgtproj',  
        textField:'kode_bgtproj',  
        url:'apinvoice/budget',  
        columns:[[  
            {field:'kode_bgtproj',title:'Kode Budget',width:100},  
            {field:'nm_bgtproj',title:'Name',width:200},  
        ]]  
    });  
	
	$('#ff').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'mainjob_id',  
        textField:'no_trbgtproj',  
        url:'apinvoice/nonkontrak',  
        columns:[[  
			{field:'no_trbgtproj',title:'Nomor',width:100},  
            {field:'mainjob_desc',title:'Description',width:200},  
        ]]  
    });  
	
	$('#cc').combogrid({  
        panelWidth:450,  
        value:'006',  
       
        idField:'kd_supplier',  
        textField:'nm_supplier',  
        url:'apinvoice/supplier',  
        columns:[[  
            {field:'kd_supplier',title:'Kode Supplier',width:100},  
            {field:'nm_supplier',title:'Nama Supplier',width:200},  
        ]]  
    });  

});	

function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('apinvoice/loaddata')?>', //request ke fungsi load data di inputAP
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#'+type).append('<option></option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 alert(data.error); // jika ada respon error tampilkan alert
			 //$('#combobox_customer').text('');
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
  	
	$(function(){		
	var rep_coma = new RegExp(",", "g");
	
	//disini tambahan dari abas tentang PPH
	$("#pph").bind('keyup keypress',function(){
					var amount = parseInt($('#amount').val().replace(rep_coma,""));
					var nett = amount/1.1
					var pp = $(this).val();
					var pph = (nett * pp)/100;
					$('#pphamount').val(numToCurr(pph));
					$('#nett').val(numToCurr(nett));	
		});	
	});	
	
	$('#ppn1').click(function(){
		if(!$("#ppn1").is(":checked")){
			var rep_coma = new RegExp(",", "g");
			var  amount1 = $('#amount1').val().replace(rep_coma,"");
			$('#dpp_ppn1').val(' ');
			$('#nett1').val(amount1);
		}else{
			var rep_coma = new RegExp(",", "g");
			var  amount1 = $('#amount1').val().replace(rep_coma,"");
			var ppn_val1 = amount1*(10/110);
			
			var dpp_ppn1 = amount1/(1.1);
			$('#dpp_ppn1').val(Math.ceil(dpp_ppn1));
			$('#nett1').val(Math.ceil(dpp_ppn1));
		}
		var afj = $("#aktif_flagjurnal").val();alert(afj);
		if(afj=="po") {	$( "#view-jurnal-po" ).trigger( "click" );}
		if(afj=="cjc"){	$( "#view-jurnal-cjc" ).trigger( "click" );}
		if(afj=="ope"){	$( "#view-jurnal-ope" ).trigger( "click" );}
		if(afj=="pro"){	$( "#view-jurnal-pro" ).trigger( "click" );}
	});
	
	$('#pph1').click(function(){
	if(!$("#pph1").is(":checked")){
		$('#dpp_pph1').val(' ');
		$('#pph_type1').prop('disabled','disabled');
		$('#pph_val1').prop('disabled','disabled');
		document.getElementById('pph_type1').selectedIndex='';
		document.getElementById('pph_val1').selectedIndex='';
	}else{
	document.getElementById('pph_type1').disabled=false;
	document.getElementById('pph_val1').disabled=false;
	}
		var afj = $("#aktif_flagjurnal").val();
		if(afj=="po") {	$( "#view-jurnal-po" ).trigger( "click" );}
		if(afj=="cjc"){	$( "#view-jurnal-cjc" ).trigger( "click" );}
		if(afj=="ope"){	$( "#view-jurnal-ope" ).trigger( "click" );}
		if(afj=="pro"){	$( "#view-jurnal-pro" ).trigger( "click" );}
	});
	
	$('#pph_val1').change(function(){
	var rep_coma = new RegExp(",", "g");
		var amount1 = parseInt($('#dpp_ppn1').val().replace(rep_coma,""));
		//alert(amount1);
		var pph_val1 = parseInt($('#pph_val1').val());
		//alert(pph_val1);
		var pph_amt1 = amount1*(pph_val1/100);
		//alert(pph_amt1);
		var dpp_pph1 = amount1-pph_amt1;
		//alert(dpp_pph1);
		$('#dpp_pph1').val(dpp_pph1);
		$('#percen_pph').val(pph_val1);
		var afj = $("#aktif_flagjurnal").val();
		if(afj=="po") {	$( "#view-jurnal-po" ).trigger( "click" );}
		if(afj=="cjc"){	$( "#view-jurnal-cjc" ).trigger( "click" );}
		if(afj=="ope"){	$( "#view-jurnal-ope" ).trigger( "click" );}
		if(afj=="pro"){	$( "#view-jurnal-pro" ).trigger( "click" );}
	});
	
	/* Choise Type ArEA & Work Obj-property */
	//PO-CJC-OPerationaL-ProjecT
	$(document).ready(function(){
		$("#rdo_po").prop("checked", true);
		$(".obj-po").show();
		$(".obj-cjc").hide();
		$(".obj-ope").hide();
		$(".obj-pro").hide();

		$("#rdo_po").click(function(){
			$(".obj-po").show();
			$(".obj-cjc").hide();
			$(".obj-ope").hide();
			$(".obj-pro").hide();
			$( ".reset_btn" ).trigger( "click" );
			$("#rdo_po").prop("checked", true);
			$(".save_btn").hide();
			$(".reset_btn").hide();
			$("single_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
			$("multi_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
		});
		$("#rdo_cjc").click(function(){
			$(".obj-po").hide();
			$(".obj-cjc").show();
			$(".obj-ope").hide();
			$(".obj-pro").hide();
			$( ".reset_btn" ).trigger( "click" );
			$("#rdo_cjc").prop("checked", true);
			$(".save_btn").hide();
			$(".reset_btn").hide();
			$("single_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
			$("multi_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
		});
		$("#rdo_opt").click(function(){
			$(".obj-po").hide();
			$(".obj-cjc").hide();
			$(".obj-ope").show();
			$(".obj-pro").hide();
			$( ".reset_btn" ).trigger( "click" );
			$("#rdo_opt").prop("checked", true);
			$(".save_btn").hide();
			$(".reset_btn").hide();
			$("single_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
			$("multi_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
		});
		$("#rdo_pro").click(function(){
			$(".obj-po").hide();
			$(".obj-cjc").hide();
			$(".obj-ope").hide();
			$(".obj-pro").show();
			$( ".reset_btn" ).trigger( "click" );
			$("#rdo_pro").prop("checked", true);
			$(".save_btn").hide();
			$(".reset_btn").hide();
			$("single_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
			$("multi_jurnal").load("<?php echo site_url();?>ap/apinvoice/blank_view");
		});
	});
	$('#category').change(function(){
	$.getJSON('<?php echo base_url();?>ap/apinvoice/getapname/'+$(this).val(),
		function(getname){
		$('#ap_name').val(getname.acc_name);
		});
	});
	
	/* Ss Eshe */
		$( ".auto-complete-po" ).autocomplete({
			source: function(request, response) {
					$.ajax({ url: "<?php echo site_url();?>autocomplete/get_autocomplete_po",
					data: { term: $(".auto-complete-po").val().replace(/ /g,'')},
					dataType: "json",
					type: "POST",
					success: function(data){
						response(data);
					}
				});
			},
			select: function (event, ui) {
				var id = ui.item.id;
				$(".id-complete-po").val(id);
				//alert(id);return false;
				$.getJSON('<?=site_url()?>/ap/apinvoice/getdetBUDPO/' + id,
				function(getdata){				
					$('#vendor').val(getdata.NM_SUPP);	
					$('#npwppo').val(getdata.NPWP);
					$('#alamat').val(getdata.ALAMAT);	
					$('#category').val(getdata.KEL_USAHA);
					$('#total_billing').val(numToCurr(getdata.HARGA_TOT));
					$('#paid_billing').val(numToCurr(getdata.PAID));
					$('#balance').val(numToCurr(getdata.BALANCE));
					$('#total_invoice').val(numToCurr(getdata.TRX_AMT));
				});
			},
			minLength: 1
		});
		$("INPUT[type=radio]").attr("disabled", "disabled");
		function get_objpo(){
			$(".obj-po").show();
			$(".obj-cjc").hide();
			$(".obj-ope").hide();
			$(".obj-pro").hide();
		}
		
		function get_objcjc(){
			$(".obj-po").hide();
			$(".obj-cjc").show();
			$(".obj-ope").hide();
			$(".obj-pro").hide();
		}
		
		function get_objope(){
			$(".obj-po").hide();
			$(".obj-cjc").hide();
			$(".obj-ope").show();
			$(".obj-pro").hide();
		}
		
		function get_objpro(){
			$(".obj-po").hide();
			$(".obj-cjc").hide();
			$(".obj-ope").hide();
			$(".obj-pro").show();
		}
		<?php if(@$data->trx_type == "PO" ) { ?>  get_objpo();$("#rdo_po").prop("checked", true);<?php } ?>
		<?php if(@$data->trx_type == "CJC" ) { ?> get_objcjc();$("#rdo_cjc").prop("checked", true);	<?php } ?>
		<?php if(@$data->trx_type == "OPE" ) { ?> get_objope();$("#rdo_opt").prop("checked", true);	<?php } ?>
		<?php if(@$data->trx_type == "PRO" ) { ?> get_objpro();$("#rdo_pro").prop("checked", true);	<?php } ?>
	/* Ee Eshe */
</script>
<!-- -FOR POP MULTi -->
<link rel="stylesheet" href="<?=site_url();?>assets/css/popup_multi.css" type="text/css" />

<!-- PO -->
<script type="text/javascript">
$(document).ready(function(){
	$(".search_textbox").hide();
	$("#search_bycode").show();
	$("#ope_search_bycode").show();
	$("#pro_search_bycode").show();
	
	$("#select_search").change(function(){
		var p = $("#select_search").val();
		if(p=="sbc"){
			$(".search_textbox").hide();
			$(".search_textbox").val("");
			$("#search_bycode").show();
		}else{
			$(".search_textbox").hide();
			$(".search_textbox").val("");
			$("#search_bysupplier").show();
		}
	});
	
	$(".get_row").click(function(){
		var c = this.getAttribute('get_povalue');
		var is_check = $("#ch"+c).is(":checked");
		if(is_check){
			$("#x"+c).css("background-color","#ffffff");
			$("#ch"+c).attr("checked",false);
		}else{
			$("#x"+c).css("background-color","#ff8379");
			$("#ch"+c).attr("checked","checked");
		}
		
	});
		
	$("#btn-imulti-po").click(function(){
		var cvalue = $("tr td span#checklist input:checkbox:checked").map(function(){ return $(this).val(); }).toArray(); console.log(cvalue);
		if(cvalue==""){
			alert("Belum Terpilih");
			return false;
		}
		$("multi_jurnal").load('<?php echo site_url();?>ap/apinvoice/pojurnalmulti_view/'+cvalue+'');
	});	
});
</script>
<!-- Eof Pop -->

<form method="post" action="<?=site_url('ap/apinvoice/saveheader')?>" id="form1">
 <?php $tgl = date('d-m-Y'); ?>
<body>
	
	<!-- 
		SpM
		PO Multi 	
	-->
	<style>
	#imulti-po{
		width: 100%;
		height: 100%;
		position: fixed;
		background: rgba(0,0,0,.7);
		top: 0;
		left: 0;
		z-index: 9999;
		visibility: hidden;
	}

	#imulti-po:target {
		visibility: visible;
	}
	.iwindow-imulti-po {
		width:1000px;
		height:600px;
		background: #fff;
		border-radius: 10px;
		position: relative;
		padding: 10px;
		box-shadow: 0 0 5px rgba(0,0,0,.4);
		text-align: left;
		margin:1.5% auto;
		font-family: Arial, sans-serif;
		background: #f2f2f2;
	}
	</style>
	
	<? //var_dump($data);exit;?>
	<!-- End pO MulTi -->
	
	<!-- 
		SOm
		OPE Multi 	
	-->
	<!-- OPE -->
	<script type="text/javascript">
	$(document).ready(function(){		
		$("#ope_select_search").change(function(){
			var p = $("#ope_select_search").val();
			if(p=="sbc"){
				$(".search_textbox").hide();
				$(".search_textbox").val("");
				$("#ope_search_bycode").show();
			}else if(p=="sbs"){
				$(".search_textbox").hide();
				$(".search_textbox").val("");
				$("#ope_search_byid").show();
			}else{
				$(".search_textbox").hide();
				$(".search_textbox").val("");
				$("#ope_search_byremark").show();
			}
		});
		
		$(".ope_get_row").click(function(){
			var c = this.getAttribute('get_opevalue'); alert(c);
			var is_check = $("#ope"+c).is(":checked");
			if(is_check){
				$("#z"+c).css("background-color","#ffffff");
				$("#ope"+c).attr("checked",false);
			}else{
				$("#z"+c).css("background-color","#ff8379");
				$("#ope"+c).attr("checked","checked");
			}
			
		});
				
		$("#btn-multi-ope").click(function(){
			var cvalue = $("tr td span#ope_checklist input:checkbox:checked").map(function(){ return $(this).val(); }).toArray(); console.log(cvalue);
			if(cvalue==""){
				alert("Belum Terpilih");
				return false;
			}
			$("multi_jurnal").load('<?php echo site_url();?>ap/apinvoice/othjurnalmulti_view/'+cvalue+'');
		});	
	});
	</script>
	
	<div id="imulti-po">
		<div class="iwindow-imulti-po">			
				<table border=0 cellspacing=2 cellpadding=2>
					<tr class="listmulti-header">
						<td width="140px">Form Code</td>
						<td width="160px">Nama Supllier</td>
						<td width="710px">Remark</td>
					</tr>
					<tr class="listmulti-header">
						<td>
						<select id="select_search">
							<option value="sbc">-- Search by Form Kode --</option>
							<option value="sbs">-- Search by Supllier --</option>
						</select>
						</td>
						<td>
							<input type="text" id="search_bycode" class="search_textbox">
							<input type="text" id="search_bysupplier" class="search_textbox">
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				
				<div style="height:350px;overflow:auto">
				<table border=0 cellspacing=2 cellpadding=2>
					<?php 
						$session_id = $this->UserLogin->isLogin();
						$this->user = $session_id['username'];
						$this->pt = $session_id['id_pt'];
						//LEFT JOIN DB_APLEDGER ON DB_APLEDGER.REF_NO=DB_BARANGPOH.BRGPOH_ID
						//LEFT JOIN DB_APINVOICE ON DB_APINVOICE.REF_NO=DB_BARANGPOH.BRGPOH_ID
						$Qry  = "SELECT id_trbgt,form_kode,PEMASOK.nm_supplier,db_trbgtdiv.remark  FROM DB_BARANGPOH
									INNER JOIN PEMASOK ON PEMASOK.KD_SUPP_GB=DB_BARANGPOH.KD_SUPP
									INNER JOIN KELUSAHA ON KELUSAHA.ID_KELUSAHA=PEMASOK.ID_KELUSAHA
									INNER JOIN DB_PR ON DB_PR.no_pr = db_BarangPOH.reff_pr
									LEFT JOIN db_trbgtdiv ON db_trbgtdiv.id_trbgt = db_pr.trbgt_id
									WHERE form_kode like ('A%') and db_trbgtdiv.id_pt = ".$this->pt." ORDER BY id_trbgt DESC"; 
						$npo = $this->db->query($Qry)->result();
					?>
					
					<?php foreach($npo as $rpo):?>
					<tr id="x<?php echo $rpo->id_trbgt;?>" class="listmulti get_row hide_onsearch" get_povalue="<?php echo $rpo->id_trbgt;?>">
							<td width="140px"><?php echo $rpo->form_kode;?></td>
							<td width="160px"><?php echo $rpo->nm_supplier;?></td>
							<td width="710px">
								<?php echo $rpo->remark;?>
								<span id="checklist"><input type="checkbox" value="<?php echo $rpo->id_trbgt;?>" id="<?php echo "ch".$rpo->id_trbgt;?>" class="get_vendorname"></span>
							</td>
					</tr>
					<?php endforeach;?>
					<!-- sSot -->
					<!--  search on table -->
					<script type="text/javascript">
						$(document).ready(function(){
							// SEarch By Code <SBC>
							$("#search_bycode").keyup(function(){
								$(".hide_onsearch").hide();
								$(".show_onsearch").show();
								var c = $("#search_bycode").val().replace(/\//g, 'ForwardSlash');
								if(c){
									$("search_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/po/sbc/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".show_onsearch").hide();
								}
							});
							
							// SEarch By SuppLier <SBS>
							$("#search_bysupplier").keyup(function(){
								$(".hide_onsearch").hide();
								$(".po_onsearch").show();
								var c = $("#search_bysupplier").val().replace(/ /g, '--+--');
								if(c){
									$("search_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/po/sbs/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".po_onsearch").hide();
								}
							});
						});
					</script>
					<!-- Esot -->				
					<search_bycode></search_bycode>
				</table>
			</div>
			
			<table>
				<tr>
					<td>
						<a href="#"><input type="button" id="btn-imulti-po" value="OK" class="btn-normal"></a>
						<a href="#"><input type="button" value="Cancel" class="btn-normal"></a>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<!-- End OPE MuLti -->
	
	<!-- 
		SOm
		PRO Multi 	
	-->
	<div id="multi-ope">
		<div class="window-multi-ope">			
				<table border=0 cellspacing=2 cellpadding=2>
					<tr class="listmulti-header">
						<td width="140px">Form Code</td>
						<td width="160px">Kode</td>
						<td width="710px">Remark</td>
					</tr>
					<tr class="listmulti-header">
						<td>
						<select id="ope_select_search">
							<option value="sbc">-- Search by No. PO --</option>
							<option value="sbs">-- Search by KOde --</option>
							<option value="sbr">-- Search by Remark --</option>
						</select>
						</td>
						<td>
							<input type="text" id="ope_search_bycode" class="search_textbox">
							<input type="text" id="ope_search_byid" class="search_textbox">
							<input type="text" id="ope_search_byremark" class="search_textbox">
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				<div style="height:350px;overflow:auto">
				<table border=0 cellspacing=2 cellpadding=2>
					<?php
						$session_id = $this->UserLogin->isLogin();
						$this->user = $session_id['username'];
						$this->pt = $session_id['id_pt'];
					?>
					<?php $npo = $this->db->query("select form_kode,code_id,remark,id_trbgt from db_trbgtdiv where id_pt = ".$this->pt." and LEFT(form_kode,1) = 'A'")->result();?>
					<?php foreach($npo as $rpo):?>

					<tr id="z<?php echo $rpo->id_trbgt;?>" class="listmulti ope_get_row hide_onsearch" get_opevalue="<?php echo $rpo->id_trbgt;?>">
							<td width="140px"><?php echo $rpo->form_kode;?></td>
							<td width="160px"><?php echo $rpo->code_id;?></td>
							<td width="710px">
								<?php echo $rpo->remark;?>
								<span id="ope_checklist"><input type="checkbox" value="<?php echo $rpo->id_trbgt;?>" id="<?php echo "ope".$rpo->id_trbgt;?>" class="get_vendorname"></span>
							</td>
					</tr>
										
					<?php endforeach;?>
					<!-- sSot -->
					<!--  search on table -->
					<script type="text/javascript">
						$(document).ready(function(){
							// SEarch By Code <SBC>
							$("#ope_search_bycode").keyup(function(){
								$(".hide_onsearch").hide();
								$(".ope_onsearch").show();
								var c = $("#ope_search_bycode").val().replace(/\//g, 'ForwardSlash');
								if(c){
									$("opesearch_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/ope/sbc/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".show_onsearch").hide();
								}
							});
							
							// SEarch By code_id <SBS>
							$("#ope_search_byid").keyup(function(){
								$(".hide_onsearch").hide();
								$(".show_onsearch").show();
								var c = $("#ope_search_byid").val();
								if(c){
									$("opesearch_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/ope/sbs/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".show_onsearch").hide();
								}
							});
							
							$("#ope_search_byremark").keyup(function(){
								$(".hide_onsearch").hide();
								$(".show_onsearch").show();
								var c = $("#ope_search_byremark").val().replace(/ /g, '--+--');
								if(c){
									$("opesearch_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/ope/sbr/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".show_onsearch").hide();
								}
							});
						});
					</script>
					<!-- Esot -->				
					<opesearch_bycode></opesearch_bycode>
				</table>
			</div>
			<table>
				<tr>
					<td>
						<a href="#"><input type="button" id="btn-multi-ope" value="OK" class="btn-normal"></a>
						<a href="#"><input type="button" value="Cancel" class="btn-normal"></a>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<!-- PRO -->
	<script type="text/javascript">
	$(document).ready(function(){		
		$("#pro_select_search").change(function(){
			var p = $("#pro_select_search").val();
			if(p=="sbc"){
				$(".search_textbox").hide();
				$(".search_textbox").val("");
				$("#pro_search_bycode").show();
			}else if(p=="sbs"){
				$(".search_textbox").hide();
				$(".search_textbox").val("");
				$("#pro_search_supplier").show();
			}else{
				$(".search_textbox").hide();
				$(".search_textbox").val("");
				$("#pro_search_byremark").show();
			}
		});
		
		$(".pro_get_row").click(function(){
			var c = this.getAttribute('get_provalue');
			var is_check = $("#pro"+c).is(":checked");
			if(is_check){
				$("#y"+c).css("background-color","#ffffff");
				$("#pro"+c).attr("checked",false);
			}else{
				$("#y"+c).css("background-color","#ff8379");
				$("#pro"+c).attr("checked","checked");
			}
			
		});
				
		$("#btn-multi-pro").click(function(){
			var cvalue = $("tr td span#pro_checklist input:checkbox:checked").map(function(){ return $(this).val(); }).toArray(); console.log(cvalue);
			if(cvalue==""){
				return false;
			}
			$("multi_jurnal").load('<?php echo site_url();?>ap/apinvoice/othjurnalmulti_view/'+cvalue+'');
		});	
	});
	</script>
	<style>	
	#multi-pro{
		width: 100%;
		height: 100%;
		position: fixed;
		background: rgba(0,0,0,.7);
		top: 0;
		left: 0;
		z-index: 9999;
		visibility: hidden;
	}

	#multi-pro:target {
		visibility: visible;
	}
	.window-multi-pro {
		width:1000px;
		height:600px;
		background: #fff;
		border-radius: 10px;
		position: relative;
		padding: 10px;
		box-shadow: 0 0 5px rgba(0,0,0,.4);
		text-align: left;
		margin:1.5% auto;
		font-family: Arial, sans-serif;
		background: #f2f2f2;
	}
	</style>
	<? //var_dump($data);exit;?>
	<div id="multi-pro">
		<div class="window-multi-pro">			
				<table border=0 cellspacing=2 cellpadding=2>
					<tr class="listmulti-header">
						<td width="140px">Form Code</td>
						<td width="160px">Supplier</td>
						<td width="710px">Remark</td>
					</tr>
					<tr class="listmulti-header">
						<td>
						<select id="pro_select_search">
							<option value="sbc">-- Search by Form Code --</option>
							<option value="sbs">-- Search by Supplier --</option>
							<option value="sbr">-- Search by Remark --</option>
						</select>
						</td>
						<td>
							<input type="text" id="pro_search_bycode" class="search_textbox">
							<input type="text" id="pro_search_supplier" class="search_textbox">
							<input type="text" id="pro_search_byremark" class="search_textbox">
						</td>
						<td>&nbsp;</td>
					</tr>
				</table>
				<div style="height:350px;overflow:auto">
				<table border=0 cellspacing=2 cellpadding=2>
					<?php
						$session_id = $this->UserLogin->isLogin();
						$this->user = $session_id['username'];
						$this->pt = $session_id['id_pt'];
					?>
					<?php 
						//$npo = $this->db->query("SP_multijurnal")->result();
						//LEFT JOIN DB_APLEDGER ON DB_APLEDGER.REF_NO=DB_BARANGPOH.BRGPOH_ID
						//LEFT JOIN DB_APINVOICE ON DB_APINVOICE.REF_NO=DB_BARANGPOH.BRGPOH_ID
						$Qry  = "SELECT id_trbgt,form_kode,PEMASOK.nm_supplier,db_trbgtdiv.remark  FROM DB_BARANGPOH
									INNER JOIN PEMASOK ON PEMASOK.KD_SUPP_GB=DB_BARANGPOH.KD_SUPP
									INNER JOIN KELUSAHA ON KELUSAHA.ID_KELUSAHA=PEMASOK.ID_KELUSAHA
									INNER JOIN DB_PR ON DB_PR.no_pr = db_BarangPOH.reff_pr
									LEFT JOIN db_trbgtdiv ON db_trbgtdiv.id_trbgt = db_pr.trbgt_id
									WHERE form_kode like ('A%') and db_trbgtdiv.id_pt = ".$this->pt." ORDER BY id_trbgt DESC"; 
									$npo = $this->db->query($Qry)->result();
					?>
					<?php foreach($npo as $rpo):?>

					<tr id="y<?php echo $rpo->id_trbgt;?>" class="listmulti pro_get_row hide_onsearch" get_provalue="<?php echo $rpo->id_trbgt;?>">
							<td width="140px"><?php echo $rpo->form_kode;?></td>
							<td width="160px"><?php echo $rpo->nm_supplier;?></td>
							<td width="710px">
								<?php echo $rpo->remark;?>
								<span id="pro_checklist"><input type="checkbox" value="<?php echo $rpo->id_trbgt;?>" id="<?php echo "pro".$rpo->id_trbgt;?>" class="get_vendorname"></span>
							</td>
					</tr>
										
					<?php endforeach;?>
					<!-- sSot -->
					<!--  search on table -->
					<script type="text/javascript">
						$(document).ready(function(){
							// SEarch By Code <SBC>
							$("#pro_search_bycode").keyup(function(){
								$(".hide_onsearch").hide();
								$(".pro_onsearch").show();
								var c = $("#pro_search_bycode").val().replace(/\//g, 'ForwardSlash');
								if(c){
									$("prosearch_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/pro/sbc/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".show_onsearch").hide();
								}
							});
							
							// SEarch By code_id <SBS>
							$("#pro_search_bysupplier").keyup(function(){
								$(".hide_onsearch").hide();
								$(".show_onsearch").show();
								var c = $("#pro_search_bysupplier").val();
								if(c){
									$("prosearch_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/pro/sbs/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".show_onsearch").hide();
								}
							});
							
							$("#pro_search_byremark").keyup(function(){
								$(".hide_onsearch").hide();
								$(".show_onsearch").show();
								var c = $("#pro_search_byremark").val().replace(/ /g, '--+--');
								if(c){
									$("prosearch_bycode").load("<?=site_url()?>ap/apinvoice/search_bycode/pro/sbr/"+c+"");
								}else{
									$(".hide_onsearch").show();
									$(".show_onsearch").hide();
								}
							});
						});
					</script>
					<!-- Esot -->				
					<prosearch_bycode></prosearch_bycode>
				</table>
			</div>
			<table>
				<tr>
					<td>
						<a href="#"><input type="button" id="btn-multi-pro" value="OK" class="btn-normal"></a>
						<a href="#"><input type="button" value="Cancel" class="btn-normal"></a>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<!-- End PRO MuLti -->
	
	<table border=0  align="left">
		<tr>
			<h2>AP INVOICE</h2>
		</tr>
		<tr>
			<td>AP</td>
				<td>:</td>
				<td><?=@$data->doc_no?></td>
		</tr>

		<tr>
		<td>Type</td>
		<td>:</td>
		<td>
		<input type="radio" name="trx_type" id="rdo_po"  value="PO" 	style="margin-top:-3px">PO&nbsp;
		<input type="radio" name="trx_type" id="rdo_cjc" value="CJC" 	style="margin-top:-3px">CJC&nbsp;
		<input type="radio" name="trx_type" id="rdo_opt" value="OPE" 	style="margin-top:-3px">Operational&nbsp;
		<input type="radio" name="trx_type" id="rdo_pro" value="PRO" 	style="margin-top:-3px">Project&nbsp;  
		</td>
				
		</tr>
		<tr>
		<td>AP Date</td>
				<td>:</td>
				<td>
				<input id="receipt_date" name="receipt_date" size="30" value="<?=@$data->doc_date?>" style="width:207px"></input>
		</td>
		
		</tr>
		<tr>
			<td>Kode Budget</td>
			<td>:</td>
			<td><?php //$Budget = $this->db->query("select form_kode from db_trbgtdiv where id_trbgt = ".@$data->ref_no."")->row()->form_kode;?>
				<!-- area edit-update *)remove this mark after copy  -->
				<!-- PO AREA -->
				<input type="text" name ="po" class="auto-complete-po obj-po" size="35" />
				<a href="#imulti-po"><input type="button" id="mulpo" class="obj-po btn-small" value="Multi"></a>
				
				<!-- CJC AREA -->
				<input type="text" name ="kbcjc" class="auto-complete-cjc obj-cjc" size="35" />
				
				<!-- OPErasional Area -->
				<input type="text" name="kbope" id="operational2" value="<?=@$Budget?>" class="auto-complete-ope obj-ope" size="32" readonly />
				<a href="#multi-ope"><input type="button" id="mul-opr" class="obj-ope btn-small" value="Multi"></a>
				
				<!-- PRojeCT ArEA-->
				<input type="text" name="kbpro" id="" class="auto-complete-pro obj-pro" size="35"/>
				<a href="#multi-pro"><input type="button" id="mul-pro" class="obj-pro btn-small" value="Multi"></a>
				<!-- area area edit-update *)remove this mark after copy  -->
			</td>
		</tr>
		
		<tr>
		<td>Alocation</td>
		<td>:</td>
		<td><input type="checkbox" name="alocation1" id="alocation1"></td>
				
		</tr>
		<tr>	
		<td>Vendor Name</td>
				<td>:</td>
				<td>
					<!-- PO Area -->
					<input type="text" name="vendor" id="vendor" class="validate[required] xinput obj-po" xinput" value="<?=@$data->nm_supplier;?>"  style="width:198px;background-color:whitesmoke;border:1px solid #cbcbcb;padding:3px" readonly="true"  size="50" />
					
					<!-- CJC Area -->
					<input type="text" name="vendor3" id="vendor-cjc" class="validate[required] xinput  obj-cjc" xinput" value="<?=@$data->nm_supplier;?>"  style="width:198px;background-color:whitesmoke;border:1px solid #cbcbcb;padding:3px" readonly="true"  size="50" />
					
					<!-- OPErasional Area -->
					<select name="vendor-ope" id="vendor-ope" class="obj-ope" style="border:1px solid #cbcbcb;width:207px;padding:3px">
						<option><?=@$data->nm_supplier;?></option>
					</select>
					
					<!-- PROject Area -->
					<select name="vendor-pro" id="vendor-pro" class="obj-pro" style="border:1px solid #cbcbcb;width:207px;padding:3px">
						<option><?=@$data->nm_supplier;?></option>
					</select>
				</td>
		</tr>
		<tr>	
		<td>AP Category</td>
				<td>:</td>
				<td>
				<select name="category" id="category" style="border:1px solid #cbcbcb;width:207px;padding:3px">
					<?php $apcategory = $this->db->query("select acc_name from db_apinvoiceoth where doc_no = '".$data->doc_no."'")->row()->acc_name;?>
					<option><?=$apcategory?></option>
				</select>
				</td>
		</tr>
		<tr>
		<td>Total</td>
				<td>:</td>
				<td>
					<!-- Budget  -->
					<input type="text" name="total_billing" id="total_billing" class="calculate input validate[required]" value="<?=@$data->total?>" style="width:198px;background-color:whitesmoke;padding:3px;border:1px solid #cbcbcb" readonly="true" size="30" />
				</td>
		</tr>
		<tr>	

		</tr>
		<tr>
				
		<td>Paid</td>
				<td>:</td>
				<td><input type="text" name="paid_billing" id="paid_billing" class="calculate input validate[required]" value="<?=@$data->paid_billing?>"  style="width:198px;background-color:whitesmoke;padding:3px;border:1px solid #cbcbcb" readonly="true" size="30" /></td>			
		</tr>
		<tr>
		<td>Balance</td>
				<td>:</td>
				<td><input type="text" name="balance" id="balance" class="calculate input validate[required]" value="<?=@$data->balance?>"  style="width:198px;background-color:whitesmoke;border:1px solid #cbcbcb;padding:3px" readonly="true" size="30" /></td>
		</tr>
		<tr>			
				<td>CIP Account</td>
				<td>:</td>
				<td>
					<select name="cip3" id="cip3" style="border:1px solid #cbcbcb;width:207px;padding:3px">
						<option>-- Choose --</option>
						<option value=50>1.01.04.07.02.01 - CIP Contractor</option>
						<option value=51>1.01.04.07.02.02 - CIP Soft Cost (Consultan)</option>
						<option value=52>1.01.04.07.02.03 - CIP Infrastructure</option>
						<option value=53>1.01.04.07.02.04 - CIP Permit / Legal</option>
						<option value=54>1.01.04.07.02.05 - CIP Cost Of Loan (IDC)</option>
					</select>
				</td>		
		</tr>		
	</table>
	
	
<table>
<tr>
	<td>Invoice No</td>
	<td>:</td>
	<td><input type="text" name="inv_no" id="inv_no" class="validate[required] xinput" value="<?=@$data->inv_no?>" class="validate[required]" size="30" style="background:white;border:1px solid #cbcbcb;padding:3px;width:198px"/></td>
</tr>
<tr>
	<td>Invoice Date </td>
	<td>:</td>
	<td>
		<input id="inv_date" name="inv_date" value="<?=@$data->inv_date?>" size="30" style="width:207px"></input>
	</td>
</tr>
<tr>	
	<td>Due Date</td>
	<td>:</td>
	<td>
	<select name="cr_term" style="background:white;border:1px solid #cbcbcb;padding:3px;width:205px">
	<option><?=@$data->cr_term;?></option>
	</select>          
	</td>
</tr>
<tr>	
	<td>Invoice Amount</td>		
	<td>:</td>
	<td><input type="text" class="input calculate"  name="amount" id="amount1" class="calculate input validate[required]" value="<?=@$data->base_amt;?>" class="validate[required]" size="30" style="background:white;border:1px solid #cbcbcb;padding:3px;width:198px"  /></td>
</tr>
<tr>	
	<td>Ppn</td><!-- PO -->
	<td>:</td>
	<td>
	<?php if(@$data->ppn){ ?>
	<input type="checkbox" checked id="ppn1" class="poppn" disabled>
	<?php }else{ ?>
	<input type="checkbox" id="ppn1" class="poppn" disabled>
	<?php } ?>
	</td>
</tr>
<tr>
	<td>Dpp Ppn</td>
	<td>:</td>
	<td><input type="text" name="dpp_ppn1" id="dpp_ppn1" value="<?=@$data->ppn;?>" class="xinput calculate" style="background:whitesmoke;border:1px solid #cbcbcb;padding:3px;width:198px" disabled>
	</td>
</tr>
<tr>	
	<td>Total Nett</td>
	<td>:</td>
	<td>
	<?php 
	$fp = str_replace(",","",@$data->base_amt); 
	$tn = number_format($fp/1.1);
	?>
	<input type="text" name="nett" id="nett1" class="calculate input validate[required]" value="<?=$tn;?>" style="background:whitesmoke;border:1px solid #cbcbcb;padding:3px;width:198px" readonly="true" size="30" />
	</td>
</tr>
<tr>
	<td>Remark</td>
	<td>:</td>
	<td><textarea name="remark" id="remark" class="validate[required] xinput" xinput" class="validate[required]" style="width:400px;border:1px solid #cbcbcb;padding:3px"><?=@$data->descs?></textarea></td>
</tr>
<tr>
	<td> Pph </td> <!-- PPH PO -->
	<td>:</td>
	<td>
	<?php if(@$data->pph){ ?>
	<input type="checkbox" name = "pph1" checked id="pph1" class="popph" disabled>
	<?php }else{ ?>
	<input type="checkbox" name = "pph1" id="pph1" class="popph" disabled>
	<?php } ?>
	</td>
</tr>
<tr>	
	<td>Dpp Pph</td>
	<td>:</td>
	<td><input type="text" name="dpp_pph1" id="dpp_pph1" value="<?=@$data->pph?>" class="xinput calculate" style="background:white;border:1px solid #cbcbcb;padding:3px;width:198px" readonly="true">
</tr>
<tr>
	<td>Pph Type</td>
	<td>:</td>
	<td>  
		<select name="ppn_type" id="pph_type1" class="get_popphtype" style="background:white;border:1px solid #cbcbcb;padding:3px;width:205px" disabled>
		<?php
		if($data->pph){
		$pphtype = $this->db->query("select acc_name from db_apinvoiceoth where doc_no = '".$data->doc_no."'")->result();
		?>
		<option value=''><?=@$pphtype[3]->acc_name?></option>
		<?php }else{ ?>
		<option value=''></option>
		<?php } ?>
		</select> 
	</td>
</tr>
<tr>	
	<td>Pph Value</td> <!-- PO -->
	<td>:</td>
	<td>      
		<input type="text" name="pph1" id="pph_val1" class="get_popph" value="<?=@$data->percent_pph?>" style="background:white;border:1px solid #cbcbcb;padding:3px;width:198px">%
	</td>
</tr>
</table>
	<br>
	<div>
	<script type="text/javascript">
		$(document).ready(function(){
			var r = "<?=str_replace(array('/', ' '),array('ForwardSlash',''),$data->doc_no);?>";
			$("single_jurnal").load("<?php echo site_url();?>ap/apinvoice/editpojurnal_view/"+r);
		});
	</script>
	<single_jurnal></single_jurnal>
	<multi_jurnal></multi_jurnal>
	</div>
</body>
<br>
		<tr>
			<td colspan='3'><input type="submit" name="tombol" id="tombol" class="btn-normal save_btn" value="Saver" onclick="myFunction()"/></td>
			<td colspan='3'><input type="reset" name="cancel" class="btn-normal reset_btn" value="Cancel"/></td>
		</tr>
</form>