<script language="javascript" src="<?=base_url()?>assets/js/tabcontent.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/tabcontent.css" type="text/css" />
<!--script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.7.1.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.ui.core.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.ui.widget.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.ui.datepicker.js"></script>
<!--link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" /-->
<link rel="stylesheet" href="<?=base_url()?>assets/css/demos.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.ui.all.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuku.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />


<script language="javascript">
$(function(){
	//FUNGSI LOAD DATA
	function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('spcustomer/loaddata')?>',
		{data_type: type, parent_id: parentId},
		function(data){
		 
		   if(data.error == undefined){ 
			 $('#'+type).empty();
			 $('#'+type).append($('<option></option>').val('').text(''));
			 for(var x=0;x<data.length;x++){
			 	$('#'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text('');
		  }else{
			 alert(data.error);
			 //$('#cb_karycutials').text('');
		  }
		},'json' 
      );      
   }
   	
//LOADPERTAMA
$(document).ready(function(){
		$('#corporate').attr('disabled',true);
		$('#individu').attr('disabled',true);
		$('#customernama').hide();
		$('.hide_x').hide();
		$('.hide_y').hide();
		$('.hide_z').hide();
		$('#paytipe').hide();
		$('#generate').hide();
		$('#batal').hide();
		//$('.sphide').hide();

		//$('#showhide').css('display','none');
		//$('#showfix').css('display','inline');
		

		$('#disc1').hide();
		$('#disc2').hide();
		$('#discamount').hide();
		$('#adddisc').hide();
		$('#disc1').val('0');
		$('#disc2').val('0');
		$('#discamount').val('0');
		$('#adddisc').val('0');
	
		if($('input:radio[name=idfilter]:checked').val() == '1' ){
				$('#corporate').attr('disabled',true);
				$('#corporate').text('');
				
		}else{
				$('#individu').attr('disabled',true);
				$('#individu').text('');
			}
	
	});	
	

	
	
	
	/*fungsi validasi numeric*/
	$('.calculate').bind('keyup keypress',function(){
		$(this).val(numToCurr($(this).val()));
	 }).numeric();	

	$('#mprice').bind('keyup keypress',function(){		
		var kugiri = new RegExp(",", "g");
		var tipepl = $(this).val();
		var phase = $('#phase').val();
		var unit = $('#unit').val();
		var paytipe = $('#paytipe').val();
		var bangunan = $('#bangunan').text();
		var tanah = $('#tanah').text();
		var disc1 = parseInt($('#disc1').val());
		var disc2 = parseInt($('#disc2').val());		
		var price = parseInt($('#mprice').val().replace(kugiri,""));
		
		//Perhitungan penjualan
		if($('#discount option:selected').val() == 1){
			var totdisc =(disc1+ disc2)/100;
			var discprice = price * totdisc;
			var sellprice = price - discprice;
		}else{
			var discprice = parseInt($('#discprice').val().replace(kugiri,""));
			var sellprice = price  - discprice;
		}		
		var tax = parseInt(sellprice) * 0.1;
		var pm = sellprice/parseInt(bangunan);
		//Masukan angka perhitungan
		$('#soldprice').val(numToCurr(sellprice));
		$('#taxamount').val(numToCurr(tax));	
		$('#payment').val(numToCurr(pm));		
		
		//alert("test");
	 });

	$('.intcalculate').bind('keyup keypress',function(){
		$(this).val($(this).val());
	 }).numeric();	

	
	//loadData('tipecustomer',0);
	loadData('subproject',0);
	loadData('paytipe',0);
	loadData('salessources',0);
	loadData('discount',0);
	
	$('#discount').change(function(){
			$('#paytipe').show();
			if($('#discount option:selected').val() == 1){
					$('#discprice').val(0);
					$('#disc1').show();
					$('#disc2').show();
					$('.hide_x').show();
					$('#discamount').hide();
					$('.clearall').val('');
					$('#mprice').val(0);
				}
				else {
					$('#mprice').val(0);
					$('#discprice').val(0);
					$('#disc1').hide();
					$('#disc2').hide();
					$('.hide_x').hide();
					//$('.hide_y').show();
					//$('.hide_z').show();
					$('#discamount').show();
					
				}
			})
	
	
	//dropdown select
	$('#tipecustomer').change(function(){
			//alert($('#tipecustomer option:selected').val());
			loadData('nama',$('#tipecustomer option:selected').val());
	});		
	
	$('#subproject').change(function(){
			
			loadData('unit',$('#subproject option:selected').val());
	});	
	
	$('#paytipe').change(function(){
			
				$.getJSON('<?=site_url('spcustomer/bf')?>/'+$(this).val(),
					function(data){
							$('#bfamount').val(numToCurr(data.amount_bf));
						})
				
				
				//kondisi DP
				var proj = $('#subproject').val();
					$.getJSON('<?=site_url('spcustomer/dp')?>/'+$(this).val()+'/'+proj,
					
					function(data){
							$('#paytipedp').empty();
							for(var x=0;x<data.length;x++){
							$('#paytipedp').append($('<option></option>').val(data[x].id).text(data[x].nama));
							}
						})
				
				
				//kondisi pelunasan
				var proj = $('#subproject').val();
					$.getJSON('<?=site_url('spcustomer/pl')?>/'+$(this).val()+'/'+proj,
					function(data){
							$('#paytipepl').empty();
							
							for(var x=0;x<data.length;x++){
							$('#paytipepl').append($('<option></option>').val(data[x].id).text(data[x].nama));
							}
						})
		
		
			//loadData('paytipedp',$('#paytipe option:selected').val());
			//loadData('paytipepl',$('#paytipe option:selected').val());
			$('.clearall').text('');
			$('.clearall').val('');
			$('#mprice').val(0);
			$('.hide_z').show();
	});	
	
	$('#salessources').change(function(){
			loadData('salesname',$('#salessources option:selected').val());
	});
	
	$('#paytipepl').change(function(){
		var kugiri = new RegExp(",", "g");
		var tipepl = $(this).val();
		var phase = $('#phase').val();
		var unit = $('#unit').val();
		var paytipe = $('#paytipe').val();
		var bangunan = $('#bangunan').text();
		var tanah = $('#tanah').text();
		var disc1 = parseInt($('#disc1').val());
		var disc2 = parseInt($('#disc2').val());		
		var price = parseInt($('#mprice').val().replace(kugiri,""));
		
		//Perhitungan penjualan
		if($('#discount option:selected').val() == 1){
			var totdisc =(disc1+ disc2)/100;
			var discprice = price * totdisc;
			var sellprice = price - discprice;
		}else{
			var discprice = parseInt($('#discprice').val().replace(kugiri,""));
			var sellprice = price  - discprice;
		}		
		var tax = sellprice * 0.1;
		var pm = sellprice/parseInt(bangunan);
		//Masukan angka perhitungan
		$('#soldprice').val(numToCurr(sellprice));
		$('#taxamount').val(numToCurr(tax));	
		$('#payment').val(numToCurr(pm));		
		/*$.post('<?=site_url('spcustomer/cekprice')?>',
		{'tipepl':tipepl,'phase':phase,'unit':unit,'paytipe':paytipe},
		function(response){
			$('#pricelist').text(response);			
			var pricelist = parseInt(response.replace(kugiri,""));
			if($('#discount option:selected').val() == 1){
				var totdisc =(disc1+ disc2)/100;
				var discprice = pricelist * totdisc;
				var sellprice = pricelist - discprice;
			}else{
				var discprice = parseInt($('#discprice').val().replace(kugiri,""));
				var sellprice = pricelist  - discprice;
			}
			var tax = parseInt(sellprice)/1.1;
			var pm = pricelist/parseInt(tanah);			
			
			$('#soldprice').val(numToCurr(sellprice));	
			$('#taxamount').val(numToCurr(tax));	
			$('#payment').val(numToCurr(pm));	
			
			
		});*/
	});


		$( ".datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat : 'dd-mm-yy',
			yearRange : '1940 : 2030'	
	//$( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );	
		});

//Dropdown tipe input
$('#nama').change(function(){
		$.getJSON('<?=site_url('spcustomer/data')?>/'+$(this).val(),
				function(data){
					   $('#customernama').val(data.customer_nama);
					   $('#tgl_lahir').val(data.customer_tgl_lhr);
					   $('#hp').val(data.customer_hp);
					   $('#tlp').val(data.customer_tlp);
					   $('#customerfax').val(data.customer_fax);
					   $('#email').val(data.email);
					   $('#npwp').val(data.npwp);
					   $('#id_number').val(data.id_no);
					   $('#customeralamat1').val(data.customer_alamat1);
					   $('#customeralamat2').val(data.customer_alamat2);
					   $('#kdpos').val(data.kdpos);
					   $('#kdpos1').val(data.kdpos1);
					   $('#tmplhr').val(data.customer_tmpt_lhr);
					   $('#sek').val(data.id_karysek);
					   $('#customerstatus').val(data.customer_status);
					   $('#profesi').val(data.id_profesi);
					   $('#idtipe').val(data.id_tipe);
					   $('#tipemedia').val(data.id_tipemedia);
					   $('#media').val(data.id_media);
					   $('#negara').val(data.id_negara);
					   $('#propinsi').val(data.id_propinsi);
					   $('#kota').val(data.id_kota);
					   $('#negara1').val(data.id_negara1);
					   $('#propinsi1').val(data.id_propinsi1);
					   $('#kota1').val(data.id_kota1);
					   $('#motivie').val(data.id_motivie);
					   $('#etnis').val(data.id_etnis);
					   $('#fb').val(data.fb);
					   $('#twiter').val(data.twiter);
					   $('#idfilter').val(data.id_filter);
								   
					   
					   
				});
				$('#customernama').show();
				//untuk selected
				loadData('tmplhr',$('#nama option:selected').val());
				loadData('agama',$('#nama option:selected').val());
				loadData('customerstatus',$('#nama option:selected').val());
				loadData('profesi',$('#nama option:selected').val());
				loadData('tipemedia',$('#nama option:selected').val());
				loadData('idtipe',$('#nama option:selected').val());
				loadData('media',$('#nama option:selected').val());
				loadData('negara',$('#nama option:selected').val());
				loadData('propinsi',$('#nama option:selected').val());
				loadData('kota',$('#nama option:selected').val());
				loadData('negara1',$('#nama option:selected').val());
				loadData('propinsi1',$('#nama option:selected').val());
				loadData('kota1',$('#nama option:selected').val());
				loadData('motivie',$('#nama option:selected').val());
				loadData('etnis',$('#nama option:selected').val());
		 });


//viewtabletambahan
$('#nama').change(function(){
		$.getJSON('<?=site_url('spcustomer/dataadd')?>/'+$(this).val(),
				function(data){
					 $('#custcompnm').val(data.custcomp_nm);
					 $('#bisnis').val(data.id_bisnis);
					 $('#custcompalamat').val(data.custcomp_alamat);
					 $('#tlpbis').val(data.custcomp_hp);
					 $('#faxbis').val(data.custcomp_fax);
					 $('#npwpbis').val(data.custcomp_npwp);
				})
					
					loadData('bisnis',$('#nama option:selected').val()); 
		
			
			});
			

$('#unit').change(function(){
		var proj = $('#subproject').val();
		$.getJSON('<?=site_url('spcustomer/unit')?>/'+$(this).val()+'/'+proj,
				function(data){
					 if(data.unit_no==false) var tnh = '-';
					 else tnh = data.unit_no
					 $('#view').text(data.view_unit);
					 $('#tanah').text(data.tanah);
					 $('#bangunan').text(data.bangunan);
					 $('#unitstatus').text(data.unitstatus_nm);
					 $('#unitno').text(tnh);
					 $('#spno').val(data.noakhir);
					 $('#pricehid').val(data.pricelist);
					 $('#pricelist').text(data.pricelist);
					// $('#cus').text(data.customer_nama);
					})

				});

	$('#discamount').bind('keyup keypress',function(){
		var kugiri = new RegExp(",", "g");
		var nil = parseInt($(this).val().replace(kugiri,""));
		$('#discprice').val(nil);
		
	});
	
		
			
		
	
	//FUNGSI RADIO BUTTON
		$('input[name=idfilter]').change(function(){
		
			if($('input:radio[name=idfilter]:checked').val() == '1' ){
				
					$('#corporate').attr('disabled',true);
					$('#individu').attr('disabled',false);
					loadData('individu',0)
				
				}
				else{
					$('#individu').attr('disabled',true);
					$('#corporate').attr('disabled',false);
					$('#individu').text('');
					loadData('corporate',0)
				}
		});
	
/*Validation Button*/
$('#order').click(function(){
	//alert("Cek Data");
	//$('#showhide').css('display','inline');
	if($('#tipecustomer option:selected').val()==''){
		alert("Tipe Customer Kosong");
	}else if($('#customernama').val()==''){
		alert("Nama Customer Kosong");
	}else if($('#individu').val()==''){
		alert("Customer Type Kosong");
	}else if($('#tgllhr').val()==''){
		alert("Tanggal Lahir Kosong");
	}else if($('#customerstatus').val()==''){
		alert("Marital Status Kosong");
	}else if($('#profesi').val()==''){
		alert("Profesi Kosong");
	}else if($('#hp').val()==''){
		alert("Handphone Kosong");
	}else if($('#tlp').val()==''){
		alert("Telepon Kosong");
	}else if($('#customeralamat1').val()==''){
		alert("Alamat Kosong");								
	}else if($('#customeralamat2').val()==''){
		alert("Alamat Mailing Kosong");	
	}else if($('#customeralamat2').val()==''){
		alert("Alamat Mailing Kosong");			
	}else if($('#negara').val()==''){
		alert("Alamat Negara Kosong");
	}else if($('#propinsi').val()==''){
		alert("Alamat Propinsi Kosong");
	}else if($('#kota').val()==''){
		alert("Alamat Kota Kosong");
	}else if($('#negara1').val()==''){
		alert("Alamat Negara Kosong");
	}else if($('#propinsi1').val()==''){
		alert("Alamat Mailing Propinsi Kosong");
	}else if($('#kota1').val()==''){
		alert("Alamat Mailing Kota Kosong");
	}else if($('#email').val()==''){
		alert("Email Kosong");
	}else if($('#motivie').val()==''){
		alert("Motivie Kosong");
	}else if($('#etnis').val()==''){
		alert("Etnis Kosong");
	}else if($('#tipemedia').val()==''){
		alert("Media Tipe Kosong");																			
	}else if($('#idtipe').val()==''){
		alert("Media Source Kosong");
	}else{
		$('#generate').show();
		$('#batal').show();
		$('#order').hide();
		$('#showhide').show();	
		$('.sphide').show();	
	}
});

$('#batal').click(function(){
	setTimeout("location.reload(true);",1500);
});


/*Cek Propinsi*/
$('#propinsi').change(function(){
		loadData('kota',$('#propinsi option:selected').val()); 
});

$('#propinsi1').change(function(){
		loadData('kota1',$('#propinsi1 option:selected').val()); 
});

$('#showfix').change(function(){
	alert("test");
});
/*validation form*/
	$('#formadd')
	.validationEngine()
	.ajaxForm({
	success:function(response){
		if(response == "sukses"){
			var nama = $('#nama').val();
			//var alamat = $('#custcompalamat').val();
			/*var id_number = $('#id_number').val();
			var tlp = $('#tlp').val();
			var alamat_mail = $('#customeralamat2').val();
			var tanah = $('#tanah').val();
			var bfamount = $('#bfamount').val();
			var bfdate = $('#bfdate').val();
			var paytipedp = $('#paytipedp').val();
			var spdate = $('#spdate').val();
			var pldate = $('#pldate').val();
			var mprice = $('#mprice').val(); */
			
			alert("Data Berhasil Disimpan");
			/*window.open("verify.php?your_variable="+your_variable.value, "", "width=400,height=500,top=50,left=280,
			resizable,toolbar,scrollbars,menubar,"); */
			//window.open("<?=site_url('spcustomer/surat_pesanan')?>/"+nama+"","mywindow");
			setTimeout("location.reload(true);",1500);
			/*+"/"
			+id_number+"/"+tlp+"/"+alamat_mail+"/"+tanah+"/"+bfamount+"/"
			+bfdate+"/"+paytipedp+"/"+spdate+"/"+pldate+"/"+mprice+"","mywindow");*/
			//"width=800,height=600,top=50,left=280,toolbar,scrollbars,menubar");
			refreshTable();
			/*width=400,height=500,top=50,left=280,
			resizable,toolbar,scrollbars,menubar"");*/
		}else{
			alert(response);
		}			
			}
		}
	);	
		
});
</script>

<form method="post" action="<?=site_url()?>spcustomer/insertcustomer" id="formadd">
	<input type="hidden" name="phase" id="phase" value="<?=$phase?>"/>
	<input type="hidden" name="discprice" id="discprice"/>
	<input type="hidden" name="pricehid" id="pricehid"/>
	
	
	<ul id="countrytabs" class="shadetabs">
	<li><a href="#"  id="showfix" rel="country1" selected>Profile Customer</a></li>
	<li><a href="#" id="showhide" rel="country2">Sales Order</a></li>
	</ul>

<div style="border:1px solid gray; width:750px; margin-bottom: 1em; padding: 10px">
	<div id="country1" class="tabcontent">
	<table border="0" cellpadding="2" cellspacing="2">
    <!--Customer Profile-->
  
			<tr>
				<td>Type Customer*</td>
				<td>:</td>
				<td>
					<select name="tipecustomer" id='tipecustomer' style='width:150px'>
						<option></option>
						<?php foreach($tipecustomer as $row):?>
							<option value="<?=$row->id?>"><?=$row->nama?></option>
						<?php endforeach;?>
						<!--option></option-->
					</select>
			   </td>
			</tr>
			<tr>
				<td>Name</td>
				<td>:</td>
				<td>
					<select name="nama" id='nama' style='width:150px'></select>
				</td>
			</tr>
		<tr><td colspan="3" style="padding:20 0 0 0;border-bottom:solid"><b>Update Customer Profile</b></td></tr>
		<tr>
			<td>Name*</td>
			<td>:</td>
			<td colspan='4'>
				<input name="customernama" id="customernama" style='width:150px' class="validate[required]">
			</td>
					
		<tr>
			<td>Cst.Type</td>
			<td>:</td>
			<td>
				<input type="radio" name="idfilter"  id='idfilter' value="1" /> Individual
				<input type="radio" name="idfilter"  id='idfilter' value="2" /> Corporate
			</td>	
			<td style="padding:0 0 0 80">No.Fax</td>
			<td>:</td>
			<td><input type="text" name="customerfax" id="customerfax" class="xinput"  ></td>
		</tr>
		<tr>
			
			<td >Individual.Type*</td>
			<td>:</td>
			<td><select name="idgroup" id="individu" class="xinput " value="<?=@$cust['nm_group']?>">
					<option value="<?=@$cust['group_id'] ?>" selected><?=@$cust['nm_group']?> </option>
						<? foreach($individu as $row): ?>
							<option value="<?=@$row->group_id?>"><?=@$row->nm_group?></option> 
						<? endforeach;?>
				</select>
				</td>
			<td style="padding:0 0 0 80">Corporate.Type*</td>
			<td>:</td>
			<td>
				<select name="idgroup" id="corporate" class="xinput"></select>
			</td>
		</tr>
		<tr>
			<td colspan='6'>&nbsp;</td>
			
		</tr>
		<tr>
			<td>Date of Birth*</td>
			<td>:</td>
			<td>
				<input type="text" name="customertgllhr" id="tgllhr" class="xinput validate[required] datepicker" readonly="true">
				<!--a href="JavaScript:;" onClick="return showCalendar('tgl_lahir', 'dd-mm-y');" title="Pilih Tanggal" > <img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a-->
			
			</td>
			<td style="padding:0 0 0 80">Id.Type*</td>
			<td>:</td>
			<td><select name="idtipe" id="idtipe" class="xinput validate[required]">
								
				</select></td>
		</tr>
		<tr>
			<td>Place of Birth</td>
			<td>:</td>
			<td>
			
				<select name="customertmptlhr"  id="tmplhr" class="xinput">
					
						
				</select>
			
			</td>
			<td style="padding:0 0 0 80">Id.Number*</td>
			<td>:</td>
			<td><input type="text" name="id_number" id="id_number" class="xinput validate[required]"></td>

		</tr>
		<tr>
			<td>Religion</td>
			<td>:</td>
			<td>
				<select name="idagama" id="agama"  class="xinput validate[required]>"></select>
			</td>
			<td style="padding:0 0 0 80">NPWP*</td>
			<td>:</td>
			<td><input type="text" name="npwp" id="npwp" class="xinput validate[required]>" ></td>
		</tr>
		
		<tr>
			<td>Sex</td>
			<td>:</td>
			<td>
				<input type="radio" name="idkarysek" id='sek' value='1' checked />Male
				<input type="radio" name="idkarysek" id='sek' value='2'/>Female
			</td>
			<td style="padding:0 0 0 80">Email*</td>
			<td>:</td>
			<td><input type="text" name="email" id='email' class="validate[required,custom[email]]"></td>		
		</tr>
		</tr>
		<tr>
			<td>Marital Status*</td>
			<td>:</td>
			<td>
				<select name="customerstatus"  id="customerstatus" class="xinput validate[required]>">
					
				</select>
			</td>
			<td style="padding:0 0 0 80">Media Type*</td>
			<td>:</td>
			<td>
				<select name="tipemedia" id="tipemedia" class="xinput validate[required]>">
				</select>
			</td>
		</tr>
		<tr>
			<td >Occupation*</td>
			<td>:</td>
			<td>
				<select name="profesi"  id='profesi' class="xinput validate[required]">
				</select>
			</td>
			<td style="padding:0 0 0 80">Media Source*</td>
			<td>:</td>
			<td>
				<select name="media" id="media" class="xinput validate[required]">
				</select>
			</td>
		<tr>
			<td>Handphone*</td>
			<td>:</td>
			<td><input type="text" name="hp" id="hp" class="xinput  validate[required] intcalculate"></td>
			<td style="padding:0 0 0 80" >Motivies*</td>
			<td>:</td>
			<td>
				<select name="motivie" id="motivie" class="xinput validate[required]>">
				</select>
			</td>
			
		</tr>
		
		
		<tr>
			<td>Telephone*</td>
			<td>:</td>
			<td><input type="text" name="customertlp" id="tlp" class="xinput validate[required] intcalculate"></td>
			<td style="padding:0 0 0 80" >Etnis*</td>
			<td>:</td>
			<td>
				<select name="etnis" id="etnis" class="xinput validate[required]">
				</select>
			</td>
		</tr>

		
		<tr>
		
			<td >Address*</td>
			<td>:</td>
			<td>
				<textarea name="customeralamat1" id="customeralamat1" class="xinput validate[required]">
				</textarea>
			</td>
			
			<td style="padding:0 0 0 80"> Mailing Address*</td>
			<td>:</td>
			<td>
				<textarea name="customeralamat2" id="customeralamat2" class="xinput validate[required]">
				</textarea>
			</td>
		</tr>	
		<tr>
			<td>Country*</td>
			<td>:</td>
			<td>
				<select name="negara" class="xinput validate[required]" id='negara'>
				</select>
			</td>
			<td style="padding:0 0 0 80">Mailing Country*</td>
			<td>:</td>
			<td>
				<select name="negara1" class="xinput validate[required]" id='negara1'>
				</select>
			</td>
			
		</tr>
			
		<tr>
			<td>Province*</td>
			<td>:</td>
			<td>
				<select name="propinsi" class="xinput validate[required]" id='propinsi'>
				</select>
			</td>
			<td style="padding:0 0 0 80" >Mailing Province*</td>
			<td>:</td>
			<td>
				<select name="propinsi1" class="xinput validate[required]" id='propinsi1'>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>City*</td>
			<td>:</td>
			<td>
				<select name="kota" class="xinput validate[required]" id='kota'>
				</select>
			</td>
			<td style="padding:0 0 0 80" >Mailing City*</td>
			<td>:</td>
			<td>
				<select name="kota1" class="xinput validate[required]" id='kota1'>
				</select>
			</td>
			
		</tr>
		<tr>
			<td>PostCode</td>
			<td>:</td>
			<td>
				<input name="kdpos" id='kdpos' class="xinput">
				
			</td>
			<td style="padding:0 0 0 80" >Mailing PostCode</td>
			<td>:</td>
			<td>
				<input name="kdpos1" id='kdpos1'class="xinput" >
				
			</td>
			
		</tr>
		
		<tr>
			<td>FaceBook</td>
			<td>:</td>
			<td>
				<input name="fb" id='fb'  class="xinput validate[custom[email]]">
				
			</td>
			<td style="padding:0 0 0 80" >Twitter</td>
			<td>:</td>
			<td>
				<input name="twiter" id='twiter' class="xinput validate[custom[email]]">		
			</td>
			
		</tr>
		<!-- End-->
		
		<!--Job Description-->
		<tr><td colspan="3" style="padding:20 0 0 0;border-bottom:solid"><b>Customer Company </b></td></tr>
		
		<tr>
			<td>Company Name</td>
			<td>:</td>
			<td><input type="text" name="custcompnm" id="custcompnm"/></td>
			<td style="padding:0 0 0 80" >Telephone</td>
			<td>:</td>
			<td><input type="text" name='custcomphp' id='tlpbis' ></td>
		</tr>
		<tr>
			<td>Type Of Business</td> 
			<td>:</td>
			<td>
				<select name="idbisnis" class="xinput" id='bisnis'></select>
			</td>
			<td style="padding:0 0 0 80" >No.Fax</td>
			<td>:</td>
			<td><input type="text" name='custcompfax' id='faxbis'></td>
		</tr>
		<tr>
			<td>Address</td>
			<td>:</td>
			<td>
				<textarea name="custcompalamat" id="custcompalamat" class="xinput validate['required']">
				</textarea>
			</td>
			<td style="padding:0 0 0 80">NPWP</td>
			<td>:</td>
			<td><input type="text" name="custcompnpwp" id="npwpbis" ></td>
		</tr>	
	</table>		
	</div>

	<div id="country2" class="tabcontent">
			<table border="0" cellpadding="2" cellspacing="2" width='750px' class="sphide">
			<?php $tgl  = date("d-m-Y"); ?>
			<input type='hidden' name='hariini' id='hariini' value="<?=$tgl?>">
				
			 <tr class="sphide">
				<td width='100px'>SP Date*</td>
				<td>:</td>
				<?php $tgl = date("d-m-Y"); ?>
				<td><input style='width:100px' type="text" name="spdate" id="" value="" class="xinput validate[required] datepicker" readonly />
					<!--a href="JavaScript:;" onClick="return showCalendar('spdate', 'dd-mm-y');" title="Pilih Tanggal" > 
					<img src="<?=base_url()?>assets/js/ico_calendar.gif"/></a-->
					
						<td>Discount</td>
						<td>:</td>
						<td><select name='discount' id='discount' style='width:100px'></select></td>
						<td><span class="hide_y">Disc. Amount</span></td>
						<td><input name='discamount' id='discamount'style='width:100px' class='calculate input hide_x'></td>
						
				</tr>
				<tr class="sphide">
					<td>SP No*</td>
					<td>:</td>
					<td ><input type="text" name="spno" id="spno" class="xinput validate[required]"  style='width:50px' readonly></td>
					
						<td><span class="hide_x">Disc. %</span></td>
						<td>:</td>
						<td colspan='5'><input type="text" name="disc1" id="disc1" class="xinput input" style='width:50px' maxlength='5' ><span class="hide_x"></span><input type="hidden" name="disc2" id="disc2" class=" xinput  input" style='width:50px' maxlength='5'>
						<span class="hide_x">Add Disc</span>
						<input type="text" name="adddisc" id="adddisc" class=" xinput alculate input" style='width:50px' maxlength='5' >
						</td>
				</tr>
				<tr class="sphide">
					<td>Project*</td>
					<td>:</td>
					<td>
						<select name="subproject"  id="subproject" class="validate[required]" style="width:100px"/>
							<option value="0"></option>
						</select>
					</td>
								<td>Sales Source</td>
								<td>:</td>
								<td colspan='3'><select name="salessources"  id="salessources" class="xinput validate[required]">
									<option value="0"></option>
								</td>
				
				
				
				<tr class="sphide">
					<td>Unit</td>
					<td>:</td>
					<td>
						<select name="unit"  id="unit" class="validate[required]"  style="width:100px"  />
							<option value="0"></option>
							
						</select>
					</td>
						<td>Sales Name</td>
						<td>:</td>
						<td colspan='5'><select name="salesname"  id="salesname" class="xinput validate[required]"/>
							<option value=0></option></select>
						</td>						
				</tr>
			</tr>
				<tr class="sphide">
					<td colspan="3" style="padding:5 0 0 0;border-bottom:solid"><b>Unit Information</b></td>
					<td colspan='6'>&nbsp;</td>

					</tr>
				<tr class="sphide">
					<td>View</td>
					<td>:</td>
					<td><span id='view' ></td>
							<td>Payment Type</td>
							<td>:</td>
							<td colspan='4' class="">
									<select name="paytipe"  id="paytipe" class="xinput validate[required]">
							</td>
							
				</tr>    
				<tr class="sphide">
					<td>Land/Nett</td>
					<td>:</td>
					<td colspan='3'><span id='tanah'></td>
							
							<td class="hide_z">Amount</td>
							<td colspan='3' class="hide_z">Payment Start Date</td>
							
							
				</tr>
				<tr class="sphide">
					<td>Building/SGFA</td>
					<td>:</td>
					<td><span id='bangunan'></td>
							<td>Booking Fee</td>
							<td>:</td>
							<td>
								<input name="bfamount"  id="bfamount" readonly style='width:100px' class='calculate input clearall hide_z'>
								
							</td>
							<td colspan='3' class="hide_z">
								<input name="bfdate"  id="bfdate" class="xinput validate[required] clearall datepicker" style='width:80px' readonly>
								</a>
								<!--a href="JavaScript:;" onClick="return showCalendar('bfdate', 'dd-mm-y');" title="Pilih Tanggal" > 
							<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/-->
							</td>
							
				</tr>    
				<tr class="sphide">
					<td>Floor</td>
					<td>:</td>
					<td><span id='unitno'></span></td>
							<td>Down Payment</td>
							<td>:</td>
							<td class="hide_z">
								<select name="paytipedp"  id="paytipedp" class="xinput" style="width:50px">
								</select>X
							</td>
							<td colspan='3' class="hide_z">
								<input name="dpdate"  id="dpdate" class="xinput clearall datepicker" style='width:80px' readonly />
								</a>
								<!--a href="JavaScript:;" onClick="return showCalendar('dpdate', 'dd-mm-y');" title="Pilih Tanggal" > 
							<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/-->
							</td>
				</tr>    
				
				<tr>
					<td>Unit Status</td>
					<td>:</td>
					<td><font color='red'><span id='unitstatus'></font></td>
							<td>Pelunasan</td>
							<td>:</td>
							<td class="hide_z">
								<select name="paytipepl"  id="paytipepl" class="xinput validate[required]" style='width:50px' />
								</select>X
							</td>
							<td colspan='3' class="hide_z">
								<input name="pldate"  id="pldate" class="xinput clearall datepicker" style='width:80px' readonly />
								</a>
								<!--a href="JavaScript:;" onClick="return showCalendar('pldate', 'dd-mm-y');" title="Pilih Tanggal" > 
							<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/-->
							</td>
							
				</tr>    
			 
				<tr>
					<td>Price List</td>
					<td>:</td>
					<td><span id="pricelist"></span></td>
						<td>Selling Price</td>
					<td>:</td>
					<td colspan='3'><input name="soldprice"  id="soldprice" class="xinput clearall hide_z"  readonly /></td>	
				</tr>    	
				<tr>
					<td>Customer Name</td>
					<td>:</td>
					<td><span id="cus"></span></td>
						
				</tr>    	
				<tr>
					<td>Price Manual</td>
					<td>:</td>
					<td><input type="text" name="mprice" id="mprice" class="input validate[required] calculate  hide_z" maxlength="13" value = '0' align="right"/></td>
					<td>Amount Tax</td>
					<td>:</td>
					<td colspan='3'><input name="taxamount"  id="taxamount" class="xinput validate[required] clearall  hide_z"  readonly /></td>
				</tr>
				
				
				<tr>	
					<td colspan='3'>&nbsp;</td>
						<td>Price/m2</td>
						<td>:</td>
						<td colspan='3'><input name="payment"  id="payment" class="xinput clearall hide_z"  readonly ></td>	
				</tr>		
				</table> 
				<input type="button"  id="order" value="Generate SP"/>
				<input type="submit"  name="generate" id="generate" value="Generate SP"/>
	</div>
</div>

<!--input type="button" name="batal" id="batal" value="batal"/-->
<!--input type="submit" name="simpan" value="Simpan"/-->
</form>




<script type="text/javascript">
var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
