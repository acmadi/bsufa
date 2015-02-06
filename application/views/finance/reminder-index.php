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
	function cellColumn(cellVal,opts,element){
	if(element.print_reminder == 1)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.print_reminder == 2)
		var newVal = '<span class="customBg" style="background-color:#FFD5D5">'+cellVal+'</span>';		
		else if(element.print_reminder == 3)
		var newVal = '<span class="customBg" style="background-color:#808080">'+cellVal+'</span>';
		else if(element.print_reminder == 0)
		var newVal = '<span class="customBg" style="background-color:#FFFF80">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}


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
		   caption:"Generate", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			var table =  $('#mytable').jqGrid(gridData);
			 var id = table.jqGrid('getGridParam','selarrrow');
			// var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/approve/' + id + '/?width='+0+'&height='+0);
				// alert('Posting Berhasil');
				refreshTable();

	
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   position:"last"
		})
		
		.navButtonAdd('#pager',{
		   caption:"Reminder 1", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				popupForm(moduleURL + '/settingreminder1/' + id + '/?width='+400+'&height='+120);
				// window.open("<?=site_url()?>" + '/reminder/surat_reminder2/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		
		// .navButtonAdd('#pager',{
		   // caption:"Unverifikasi", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			// var table =  $('#mytable').jqGrid(gridData);
			 // var id = table.jqGrid('getGridParam','selarrrow');
			// // var id = getSelectedID();
			 // if(id){
				 // popupForm(moduleURL + '/unverifikasi/' + id + '/?width='+0+'&height='+0);
				// // alert('Posting Berhasil');
				// refreshTable();

	
			 // }else{
				 // alert('Pilih baris yang ingin di verifikasi');
			 // }
		   // }, 
		   // position:"last"
		// })
		
		.navButtonAdd('#pager',{
		   caption:"Reminder 2", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				popupForm(moduleURL + '/settingreminder2/' + id + '/?width='+400+'&height='+200);
				// window.open("<?=site_url()?>" + '/reminder/surat_reminder2/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
				.navButtonAdd('#pager',{
		   caption:"Reminder 3", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				popupForm(moduleURL + '/settingreminder3/' + id + '/?width='+400+'&height='+200);
				 //window.open("<?=site_url()?>" + '/reminder/surat_reminder3/' + id + '/?width='+900+'&height='+500);
			 }else{
				 alert('Pilih data yang akan di Print');
			 }
		   }, 
		   position:"last"
		})	
		
}





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
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
<br>
<br>
<div style="left">
<table >
		<tr>
			<td style="background-color:white;width:130px;height:25px" align="center">NOT REMINDER</td>
			<td style="background-color:#FFFF80;;width:130px;height:25px">GENERATE</td>
			<td style="background-color:#C1FFC1;;width:130px;height:25px">REMINDER 1</td>
			<td style="background-color:#FFD5D5;width:130px;height:25px" >REMINDER 2</td>
			<td style="background-color:#808080;;width:130px;height:25px">REMINDER 3</td>
			
		
			
		</tr>
</table>




</div>


