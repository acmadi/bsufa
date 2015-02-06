<?php
$session_id = $this->UserLogin->isLogin();
$username = $session_id['username']; 
$level = $session_id['level_id']; 
?>

<script language="javascript">
			

$(function(element){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid
	
	<? if($level == 5){?>
		.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(rowid){ 
		   var id = getSelectedID();
		   var myGrid = $('#mytable'),
			selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
			celValue = myGrid.jqGrid ('getCell', selRowId, 'id_print');

	 
			if(celValue==1){
			 window.open("<?=site_url()?>" + 'pelunasan/printpl/' + id + '/?width='+650+'&height='+400);
			  }  else if (id) {		
				window.open("<?=site_url()?>" + 'pelunasan/printpl/' + id + '/?width='+650+'&height='+400);
				}
			  else{
				  alert('Pilih baris yang ingin di cetak');
				  }
		   }, 
		   position:"last"
		})	
	<? } ?>	
	<? if($level != 5){?>
		.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(rowid){ 
		   var id = getSelectedID();
		   var myGrid = $('#mytable'),
			selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
			celValue = myGrid.jqGrid ('getCell', selRowId, 'id_print');

	 
			if(celValue==1){
			 popupForm("<?=site_url()?>" + 'pelunasan/printpl/' + id + '/?width='+650+'&height='+400);
			  }  else if (id) {		
				window.open("<?=site_url()?>" + 'pelunasan/printpl/' + id + '/?width='+650+'&height='+400);
				}
			  else{
				  alert('Pilih baris yang ingin di cetak');
				  }
		   }, 
		   position:"last"
		})	
	<? } ?>	
	
	// .navButtonAdd('#pager',{
		   // caption:"Print", 
		   // buttonicon:"ui-icon-plus", 
		   // onClickButton: function(rowid){ 
		   // var id = getSelectedID();
		   // var myGrid = $('#mytable'),
			// selRowId = myGrid.jqGrid ('getGridParam', 'selrow'),
			// celValue = myGrid.jqGrid ('getCell', selRowId, 'id_print');

	 
			// if(celValue==1){
			 // popupForm("<?=site_url()?>" + 'pelunasan/printpl/' + id + '/?width='+650+'&height='+400);
			  // }  else if (id) {		
				// window.open("<?=site_url()?>" + 'pelunasan/printpl/' + id + '/?width='+650+'&height='+400);
				// }
			  // else{
				  // alert('Pilih baris yang ingin di cetak');
				  // }
		   // }, 
		   // position:"last"
		// })
		
		
		// .navButtonAdd('#pager',{
		   // caption:"Reprint", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // window.open("<?=site_url($module_url)?>" + '/printkwt/' + id + '/?width='+750+'&height='+400);
			 // }else{
				 // alert('Pilih baris yang ingin diprint ulang');
			 // }
		   // }, 
		   // position:"last"
		// })
		// .navButtonAdd('#pager',{
		   // caption:"Edit", 
		   // buttonicon:"ui-icon-pencil", 
		   // onClickButton: function(){ 
			 // var id = getSelectedID();
			 // if(id){
				 // popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+750+'&height='+400);
			 // }else{
				 // alert('Pilih baris yang ingin diedit');
			 // }
		   // }, 
		   // position:"last"
		// })
    .navButtonAdd('#pager',{
		   caption:"Search", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 grid.jqGrid('searchGrid');
		   }, 
		   position:"last"
		})

});

</script>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>

