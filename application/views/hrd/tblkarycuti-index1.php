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
	/*.navButtonAdd('#pager',{
		   caption:"Print", 
		   buttonicon:"ui-icon-print", 
		   onClickButton: function(){ 
			 var field = $('select[name=field] option:selected').val();
			 var oper = $('select[name=op] option:selected').val();
			 var str = $('input.vdata').val();
			 var url = '<?=site_url('print/tblkary')?>'
			 if(field)
			 //?field='+field+'&oper='+oper+'&str='+str;
			 //alert(url);
			 url+= '?field='+field+'&oper='+oper+'&str='+str;
			 window.open(url);
		   }, 
		   position:"last"
		})*/
});

function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		.navButtonAdd('#pager',{
		   caption:"Form Cuti", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm(moduleURL + '/add/?width='+700+'&height='+525);
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
 
