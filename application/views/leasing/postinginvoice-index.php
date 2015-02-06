<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$user = $session_id['username'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<!--script language="javascript" src="<?=base_url()?>assets/js/jquery-1.5.2.min.js"></script-->
<script language="javascript" src="<?=base_url()?>assets/js/i18n/grid.locale-en.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.src.js"></script>

<link rel="stylesheet" href="<?=base_url()?>assets/css/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/icon.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css" type="text/css" />

<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	
		
	grid.navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
	})
	
	$.fn.datebox.defaults.formatter = function(date) {
                        var y = date.getFullYear();
                        var m = date.getMonth() + 1;
                        var d = date.getDate();
                        return (d < 10 ? '0' + d : d) + '-' + (m < 10 ? '0' + m : m) + '-' + y;
            };
	
	$('#tgl').datebox({  
        required:true  
    });
	
	$('#tgl2').datebox({  
        required:true  
    });
					
});	

function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		// .navButtonAdd('#pager',{
		   // caption:"Tambah", 
		   // buttonicon:"ui-icon-plus", 
		   // onClickButton: function(){ 
			 // popupForm(moduleURL + '/add/?width='+700+'&height='+500);
			// // myWindow=window.open("<?=site_url()?>" + '/datagrid2/' , '_parent' , '/?width='+750+'&height='+700);
		   // }, 
		   // position:"last"
		// })
		// .navButtonAdd('#pager',{
		   // caption:"Search", 
		   // buttonicon:"ui-icon-search", 
		   // onClickButton: function(){ 
			 // grid.jqGrid('searchGrid');
		   // }, 
		   // position:"last"
	// })
// });	
		.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){
		   	var table =  $('#mytable').jqGrid(gridData);
			 var id = table.jqGrid('getGridParam','selarrrow');
			// var id = getSelectedID();
			 if(id){
				 window.open("<?=site_url($module_url)?>" + '/print_invoice/' + id + '/?width='+900+'&height='+500);
				 //popupForm(moduleURL + '/print_invoice/' + id + '/?width='+100+'&height='+100);
				refreshTable();

	
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   
		   
		   // var id = getSelectedID();
			 // if(id){
				 // window.open("<?=site_url($module_url)?>" + '/print_invoice/' + id + '/?width='+900+'&height='+500);
			 // }else{
				 // alert('Pilih data yang akan di Print');
			 // }
		   // }, 
		   position:"last"
		})
		
		// .navButtonAdd('#pager',{
		   // caption:"UnPosting", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			// var table =  $('#mytable').jqGrid(gridData);
			 // var id = table.jqGrid('getGridParam','selarrrow');
			// // var id = getSelectedID();
			 // if(id){
				 // popupForm(moduleURL + '/unapprove/' + id + '/?width='+0+'&height='+0);
				// // alert('Posting Berhasil');
				// refreshTable();

	
			 // }else{
				 // alert('Pilih baris yang ingin di Approve');
			 // }
		   // }, 
		   // position:"last"
		// })
		
		// // .navButtonAdd('#pager',{
		   // // caption:"Unverifikasi", 
		   // // buttonicon:"ui-icon-pencil", 
		   // // onClickButton: function(){ 
			// // var table =  $('#mytable').jqGrid(gridData);
			 // // var id = table.jqGrid('getGridParam','selarrrow');
			// // // var id = getSelectedID();
			 // // if(id){
				 // // popupForm(moduleURL + '/unverifikasi/' + id + '/?width='+0+'&height='+0);
				// // // alert('Posting Berhasil');
				// // refreshTable();

	
			 // // }else{
				 // // alert('Pilih baris yang ingin di verifikasi');
			 // // }
		   // // }, 
		   // // position:"last"
		// // })
		
		// .navButtonAdd('#pager',{
		   // caption:"View", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // popupForm(moduleURL + '/view/' + id + '/?width='+1000+'&height='+425);
			 // }else{
				 // alert('Pilih baris yang ingin diedit');
			 // }
		   // }, 
		   // position:"last"
		// })
				// .navButtonAdd('#pager',{
		   // caption:"Print", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // window.open("<?=site_url($module_url)?>" + '/print_slip/' + id + '/?width='+900+'&height='+500);
			 // }else{
				 // alert('Pilih data yang akan di Print');
			 // }
		   // }, 
		   // position:"last"
		// })	
		
}

function cellColumn(cellVal,opts,element){
	if(element.id_flag == 1)
		var newVal = '<span class="customBg" style="background-color:white">'+cellVal+'</span>';
		else if(element.id_flag == 2)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';		
	else var newVal = cellVal;
	return newVal;
}

function loadData(type,parentId){
	  $('#loading').text('Loading '+type.replace('_','/')+' data...');
      $.post('<?=site_url('generateinvoice/loaddata')?>',
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


	
	loadData('proj',0);


</script>
<style>
.customBg{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}
.customBg2{
	display:block;
	margin-height:-2px;
	margin-left:-2px;
	height: 14px;
	padding: 4px;
}




</style>

</head>  
<body>  
 
	<h2><font color='red' size='4'>Posting Invoice<hr width="200px" color='red' align="left"></font></h2>	 
<form action="<?php echo site_url('postinginvoice/view_invoice')?>" method="post" enctype="multipart/form-data" role="form"> 
			
			

  <table>  
  <tr>
		<td>Project : </td>
				<td>
					<select name='proj' id='proj' style='width:150'></select>
				</td>
		
			
	</tr>
	<tr>
	<td>Billing Date : </td>
			<td><input type="text" name="tgl" id="tgl"  style="width:120px"> to <input type="text" name="tgl2" id="tgl2"  style="width:120px"></td>		
	</tr>
    <tr>    
      <td><input type="submit"  value="view" name="save" /></td>  
    </tr>  
  </table>  
</form>


<!-- GRID TABLE -->
<hr width="1200px" color='red' align="left">

	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
</body>  
</html> 



