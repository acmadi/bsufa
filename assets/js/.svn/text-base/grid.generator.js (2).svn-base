function generateGrid(gridData,moduleURL,width,height){
	return $('#mytable').jqGrid(gridData)
		.navGrid('#pager',{edit:false,add:false,del:false,search:false})
		/*.navButtonAdd('#pager',{
		   caption:"Tambah", 
		   buttonicon:"ui-icon-plus", 
		   onClickButton: function(){ 
			 popupForm(moduleURL + '/add/?width='+width+'&height='+height);
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
		   caption:"Edit", 
		   buttonicon:"ui-icon-pencil", 
		   onClickButton: function(){ 
			 var id = getSelectedID();
			 if(id){
				 popupForm(moduleURL + '/update/' + id + '/?width='+width+'&height='+height);
			 }else{
				 alert('Pilih baris yang ingin diedit');
			 }
		   }, 
		   position:"last"
		})
		.navButtonAdd('#pager',{
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
					 alert('Pilih baris yang ingin diedit');
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
