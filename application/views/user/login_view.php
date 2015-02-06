<?php
 //die("testing");
 $this->load->view("user/login_header") 
?>
<?php
$attr = array('class' => 'block-content form', 'id' => 'login-form');
echo form_open(uri_string(), $attr);
?>

<? showErrors();?>
<!--<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.2.min.js"></script>-->
<script language="javascript">
   function loadData(type,parentId){
	  // berikan kondisi sedang loading data ketika proses pengambilan data
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('user/login/loaddata')?>', //request ke file load_data.php
		{data_type: type, parent_id: parentId},
		function(data){
		  if(data.error == undefined){ // jika respon error tidak terdefinisi maka pengambilan data sukses 
			 $('#combobox_'+type).empty(); // kosongkan dahulu combobox yang ingin diisi datanya
			 $('#combobox_'+type).append('<option value=\'\'></option>'); // buat pilihan awal pada combobox
			 for(var x=0;x<data.length;x++){
				// berikut adalah cara singkat untuk menambahkan element option pada tag <select>
			 	$('#combobox_'+type).append($('<option></option>').val(data[x].id).text(data[x].nama));
			 }
			 $('#loading').text(''); // hilangkan text loading
		  }else{
			 //alert(data.error); // jika ada respon error tampilkan alert
			 $('#combobox_parent_pt').text('');
	//tb_remove();
		  }
		},'json' // format respon yang diterima langsung di convert menjadi JSON 
      );      
   }
   $(function(){
	   // pertama kali halaman di-load, maka ambil seluruh data 
	   loadData('pt',0); 	
	   // fungsi yang dipanggil ketika isi dari combobox pulau dipilih 
	   $('#combobox_pt').change( 
			function(){
				// apabila nilai pilihan tidak kosong, load data propinsi
				if($('#combobox_pt option:selected').val() != '')
					loadData('parent_pt',$('#combobox_pt option:selected').val());
			}

	   ) 
   });
</script>
 
							
						<p class=inline-small-label> 
							<input type="hidden" name="log" value=""/>
							<label for=username>Username</label> 
							<input type=text name=username value="" class="required"> 
						</p> 
						<p class=inline-small-label> 
							<label for=password>Password</label> 
							<input type=password name=password value="" class="required"> 
						</p>  
						<p class=inline-small-label> 
							<label for=combobox_pt>PT</label> 
							<select name="pt" id="combobox_pt" class="required"></select>
						</p> 
						<p style="display:none"> 
							<label><input type=checkbox name=keep_logged /> Auto-login in future.</label> 
						</p> 
						<div class=clear></div> 
						<div class=block-actions> 
							<ul class=actions-left> 
								<li>
									<a class=button name=recover_password href="javascript:void(0);">Lost Password ?</a>
								</li> 
								<li class=divider-vertical></li> 
								<li style="display:none">
									<a class="button red" id=reset-login href="javascript:void(0);">Cancel</a>
								</li> 
							</ul> 
							<ul class=actions-right> 
								<li>
									<input type=submit id=login name=login class=button value=Login>
								</li> 
							</ul> 
						</div>
<?=form_close()?>

<table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
<tr>
<td width="135" align="center" valign="top"><!-- br />
<a href="http://www.symantec.com/ssl-certificates" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a --></td>
</tr>
</table>

<? $this->load->view("user/login_footer")?>
