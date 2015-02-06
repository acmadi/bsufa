<script language="javascript">
$(function(){
	var grid = generateGrid(<?=$grid_data?>,"<?=site_url($module_url)?>",400,120);
	grid.navButtonAdd('#pager',{
		   caption:"Input", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm("<?=site_url($module_url)?>" + '/add/?width='+400+'&height='+500);
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm("<?=site_url($module_url)?>" + '/update/' + id + '/?width='+750+'&height='+400);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		/*.navButtonAdd('#pager',{
		   caption:"Delete", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 if(confirm('Hapus data ini?')){
				 var id = getSelectedID(); 
				 if(id){	
					 $.get("<?=site_url($module_url)?>" + '/delete/' + id,
						function(response){
							if(response == 'success'){
								refreshTable();
							}else{
								alert('Hapus data gagal');
							}
						}
					 );
				 }else{
					 alert('Pilih baris yang ingin diedit');
				 }
			 }
		   }, 
		   position:"last"
		})*/
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



