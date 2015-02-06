<? $this->load->view(ADMIN_HEADER) ?>
<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuform.css" type="text/css"/>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.4.min.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.validationEngine-en.js"></script>
<script language="javascript" src="<?=site_url()?>assets/js/jquery.form.js"></script>
<link href="<?=site_url()?>assets/css/validationEngine.jquery.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	$(function(){
		$('#formAdd').validationEngine({
				var thn1 = $('#thn').val();
				alert(thn1);
				beforeSuccess: function(){
					if(thn1 == '2011')
						alert('As Off dan tahun tidak sama');
				}

				success: function(){
					$('#formAdd').ajaxSubmit({
						success: function(data){
							alert(String(data).replace(/<\/?[^>]+>/gi, ''));
							refreshTable();
						}
					});
					return false;
				}
			});
</script>



<h2>Division Budget<hr width="90px" align="left"></h2>
<div class="printed">
<form action="<?=base_url()?>print/print_divisi" id="formAdd" method="POST" target="_blank">
	<?php
		$tgl = date('d-m-Y');
	?>
		<table border="0">
			<tr>
				<td>Budget Year</td>
				<td>:</td>
				<td>
					<select name="thn" id="thn" style="width:120px">
						<?php
							for($i=2011;$i<2026;$i++):
						?>
							<option><?=$i?></option>
						<?php
							endfor;
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>As Off</td>
				<td>:</td>
				<td>		
					<input type="text" name="tgl" id="tgl_aju" value="<?=$tgl?>"  style="width:100px" readonly="true">
					<a href="JavaScript:;" onClick="return showCalendar('tgl_aju', 'dd-mm-y');" title="Pilih Tanggal" > 
					<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
				</td>
			</tr>
			<tr>
				<td colspan="3"><input type="submit" name="kirim" value="Print"/></td>
			</tr>
		</table>		
</form>
</div>
<?$this->load->view(ADMIN_FOOTER)?>
