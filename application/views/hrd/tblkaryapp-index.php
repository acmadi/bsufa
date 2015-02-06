<script language="javascript" src="<?=base_url()?>assets/js/jquery.formx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEngine-enx.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.validationEnginex.js"></script>

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
});

function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		.navButtonAdd('#pager',{
		   caption:"Approval", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/app/' + id + '/?width='+700+'&height='+525);
			 }else{
				 alert('Pilih Karyawan yang ingin diapprove');
			 }
		   }, 
		   position:"last"
		})
		
		
		.navButtonAdd('#pager',{
		   caption:"View", 
		   buttonicon:"ui-icon-search", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/view/' + id + '/?width='+750+'&height='+525);
			 }else{
				 alert('Pilih Karyawan yang ingin diview');
			 }
		   }, 
		   position:"last"
		})
		/*.navButtonAdd('#pager',{
		   caption:"Hapus", 
		   buttonicon:"ui-icon-trash", 
		   onClickButton: function(){ 
			 if(confirm('Hapus data ini?')){
				 var id = getSelectedID(); 
				 if(id){	
					 $.get(moduleURL + '/delete/' + id,
						function(response){
							if(response == 'success'){
								refreshTable();
							}else{
								alert('Hapus data gagal');
							}
						}
					 );
				 }else{
					 alert('Pilih karyawan yang ingin diedit');
				 }
			 }
		   }, 
		   position:"last"
		});*/
}
function getSelectedID(){
	var selRow = $('#mytable').getGridParam('selrow');
	if(selRow != ''){
		var id = false;
		$.each($("#mytable").getRowData(selRow),function(key,value){
			if(id == false)
				id = value;
		});		 
		return id;
	}else{
		return false;
	}
}
function popupForm(moduleURL){
	$('#popupForm').attr('href',moduleURL).click();
}
function refreshTable(){
	$('#mytable').trigger('reloadGrid');
	tb_remove();
}

</script>
<div align="center">
	<table id="mytable" class="scroll"></table>
	<div id="pager"></div>
</div>
 
