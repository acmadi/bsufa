<?php
$session_id = $this->UserLogin->isLogin();
$level = $session_id['level_id'];
$user = $session_id['username'];
$grid_data = str_replace('"numberFormat"','numberFormat',$grid_data);
$grid_data = str_replace('"cellColumn"','cellColumn',$grid_data);
?>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.5.2.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/i18n/grid.locale-en.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.min.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.jqGrid.src.js"></script>


<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	//grid.jqGrid('inlineNav',"#pager");
	// grid.navButtonAdd('#pager',{
		   // caption:"Posting", 
		   // buttonicon:"ui-icon-plus", 
		   // onClickButton: function(){ 
			 // //popupForm("<?=site_url($module_url)?>" + '/add/?width='+800+'&height='+450);
			 // var id = getSelectedID();
			 // if(id){
				 // popupForm(moduleURL + '/approve/' + id + '/?width='+100+'&height='+100);
				// refreshTable();

	
			 // }else{
				 // alert('Pilih baris yang ingin di Approve');
			 // }
		   // }, 
		   // position:"last"
		// })

		// grid.navButtonAdd('#pager',{
		   // caption:"View", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // window.open("<?=site_url()?>" + '/unidentified/receipt_unidentified/' + id + '/?width='+750+'&height='+700);
			 // }else{
				 // alert('Pilih baris yang ingin diedit');
			 // }
		   // }, 
		   // position:"last"
		// })
		
	// grid.navButtonAdd('#pager',{
		   // caption:"Search", 
		   // buttonicon:"ui-icon-search", 
		   // onClickButton: function(){ 
			 // grid.jqGrid('searchGrid');
		   // }, 
		   // position:"last"
	// })
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
		   caption:"Closing", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/approve/' + id + '/?width='+0+'&height='+0);
				// alert('Posting Berhasil');
				refreshTable();

	
			 }else{
				 alert('Pilih Company yang akan Closing');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"UnClosing", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/unclose/' + id + '/?width='+0+'&height='+0);
				// alert('Posting Berhasil');
				refreshTable();

	
			 }else{
				 alert('Pilih Company yang akan Closing');
			 }
		   }, 
		   position:"last"
		})
		
}



</script>

<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>


