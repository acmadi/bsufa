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
	function cellColumn(cellVal,opts,element){
		if(element.status == 1)
		var newVal = '<span class="customBg" style="background-color:none">'+cellVal+'</span>';
		else if(element.status == 7)
		var newVal = '<span class="customBg" style="background-color:#C1FFC1">'+cellVal+'</span>';
		else if(element.status == 2)
		var newVal = '<span class="customBg" style="background-color:pink">'+cellVal+'</span>';
	else var newVal = cellVal;
	return newVal;
}
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
		
	grid
    
    
    .navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
	})

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
		   caption:"Planning", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			var table =  $('#mytable').jqGrid(gridData);
			 //var id = table.jqGrid('getGridParam','selarrrow');
             var id = getSelectedID();
			 if(id){
				popupForm('<?php echo site_url();?>cashplaningx/approve/' + id + '/?width='+0+'&height='+0);
				// alert('Posting Berhasil');
				refreshTable();

	
			 }else{
				 alert('Pilih baris yang ingin di Approve');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Payment Plan", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			var table =  $('#mytable').jqGrid(gridData);
			 //var id = table.jqGrid('getGridParam','selarrrow');
				var id = getSelectedID();
				//alert(id);
			 if(id){
				 popupForm('<?php echo site_url();?>cashplaningx/planning/' + id + '/?width='+400+'&height='+200);
			//refreshTable();	
			 }else{
				 alert('Pilih baris yang ingin di Approve');
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
	<table id="mytable" class="scroll" name="mm"></table>
	<div id="pager"></div>
</div>


