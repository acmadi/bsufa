<?php
$tglva = date('m/y');
$M = date('m');
$Y = date('y');
$rcek = $this->db->where('substring(kwitansi_no,4,2)',$M)
				 ->where('substring(kwitansi_no,7,2)',$Y)
				 ->order_by('kwitansi_id','DESC')
				 ->get('db_kwitansi')->row();
$nil = substr(@$rcek->kwitansi_no,-5) + 1;
#var_dump($nil);exit;

if($nil > 9999) $code = 'RE/'.$tglva.'/'.$nil;
elseif($nil > 999) $code = 'RE/'.$tglva.'/0'.$nil;
elseif($nil > 99) $code = 'RE/'.$tglva.'/00'.$nil;
elseif($nil > 9) $code = 'RE/'.$tglva.'/000'.$nil;
else $code = 'RE/'.$tglva.'/0000'.$nil;

?>

<script language="javascript" src="<?=base_url()?>assets/js/calendar.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/calendar2.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/currency.js"></script>
<link rel="stylesheet" href="<?=base_url()?>assets/css/calendar.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/menuformx.css" type="text/css" />
<script type="text/javascript">
$(function(){

		$('#formAdd').validationEngine({
				beforeSuccess: function(){
					setTimeout("location.reload(true);",1500);
					return false;		
				},
			
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
	
	
	$('.calculate').bind('keyup keypress',function(){
			$(this).val(numToCurr($(this).val()));
		  }).numeric();
		  
	$('#ttd').change(function(){
		$.post('<?=site_url('kwitansi/cekjab')?>',
			{id:$(this).val()},
			function(response){
				$('#jabatan').val(response);
			}
		);
	});
	
	$('#pemutk').change(function(){
		$('#untuk').val($(this).val())
	});

});
</script>
<form  method="post" action="<?=site_url('kwitansi/kwitansi_view')?>" id="formAdd" target="_blank"> 
  <table width="746" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
	  <td colspan="2"><span><u><span><img src="<?=base_url()?>/assets/images/bakrie.JPG" width="74" height="78"></span></u></span></td>
	  <td colspan="5"><span>
	    </span><h1 align="left"><font size="6" face="verdana">Kwitansi</font></h1> 
        <div align="left"><font size="2" face="verdana">Official Receipt</font></div></td>
    </tr>
	<tr>
	  <td width="114"><input type="hidden" name="hidesell" id="hidesell"/></td>
	  <td>&nbsp;</td>
	  <td colspan="2">&nbsp;</td>
	  <td width="84" cellspacing=0 >&nbsp;</td>
	  <td>&nbsp;</td>
	  <td cellspacing=0 >&nbsp;</td>
    </tr>
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td colspan="5">
			<?php $tgl=date('Y-m-d');?>
			<!--<input type="text" name="" id="" class="xinput" value="<?=indo_date($tgl)?>" readonly="true"/>-->
			<input type="text" name="tgl" id="tgl" class="xinput" value="" readonly="true"/>
			<a href="JavaScript:;" onClick="return showCalendar('tgl', 'dd-mm-y');" title="Pilih Tanggal" >
			<img src="<?=base_url()?>assets/js/ico_calendar.gif" alt="s"/></a>
		</td>

	</tr>
	<tr>
	    <td>Nomor</td>
		<td>:</td>
		<td colspan="5"><input type="text" name="nomor" value="<?=$code?>" readonly/></td>
	</tr>
	<tr>
	  <td>Sudah Terima Dari</td>
	  <td>:</td>
	  <td colspan="2"><input type="text" id="tdari" name="tdari" class="validate[required]"/></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>Jumlah Uang</td>
	  <td>:</td>
	  <td width="158"><input type="text" maxlength="16" name="jumlah" id="jumlah" class="calculate validate[required]"/></td>
	  <td width="78" ><div align="right">
      <input type="radio" name="curr" value="Rp" checked/>
      Rupiah  </div></td>
	  <td><input type="radio" name="curr" value="USD" />
USDollar</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>Untuk Pembayaran</td>
	  <td>:</td>
	  <td>
		<select name="pemutk" id="pemutk" class="xinput">
			<option>Deposit</option>
			<option>Apartemen</option>
			<option>Rental</option>
		</select>
	  </td>
	  <td colspan="6"><input type="text" name="untuk" id="untuk" maxlength="200" class="validate[required]"/></td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>Keterangan</td>
	  <td>:</td>
	  <td colspan="7">
	    <input type="text" name="ket1" id="ket1" class="validate[required]" style="width:300px"/>		
	  </td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td></td>
	  <td>:</td>
	  <td colspan="7">
	    <input type="text" name="ket2" id="ket2" style="width:300px"/>
	  </td>
	  <td>&nbsp;</td>
    </tr> 
	<tr>
	  <td></td>
	  <td>:</td>
	  <td colspan="7">
	    <input type="text" name="ket3" id="ket3" style="width:300px"/>
	  </td>
	  <td>&nbsp;</td>
    </tr>        
	<tr>
		<td>Penandatangan</td>
		<td>:</td>
		<td colspan="4"><select  name="ttd" id="ttd" class="xinput">
		  <option selected>-Pilih-</option>
          <?php foreach($kary as $row):?>
          <option value="<?=$row->id_kary?>">
          <?=$row->nama?>
          </option>
          <?php endforeach;?>
        </select></td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>:</td>
		<td colspan="4"><input type="text" name="jabatan" id="jabatan" readonly/></td>
	  <td width="47">&nbsp;
	  </td>
	  <td>&nbsp;</td>
	  <td width="35">&nbsp;</td>
    </tr>
	<tr>
	    <td colspan="7">
			<!--<input type="submit" value="Preview" name="Print" />-->
			<input type="submit" value="Print" name="Print" />
		</td>
	</tr>
</table>
</form>


