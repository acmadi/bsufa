<center>
		<table border="0" cellspacing="2" cellpadding="2" width="300px">
			<tr>
				<td colspan="3" align="center"><img src="<?=site_url('/assets/foto/monyet1.jpg')?>" height="150" width="120"></td>
				
			</tr>		
			<tr>
			<tr>
				<td style="border-bottom:doted" colspan="3"><hr></td>
				
			</tr>		
			<tr>
				<td colspan="3"><b>Information Unit</b></td>
			
			</tr>	
			
				
			<tr>
				<td width="47" align="left">Unit</td>
				<td width="27">:</td>
				<td width="40"><span><?=$cek->unit_no?></span></td>
				<tr>
				<td align="left">View</td>
				<td>:</td>
				<td><span><?=$cek->view_unit?></span></td>
					</tr>			
			<tr>
				<td align="left">Floor</td>
				<td>:</td>
				<td><span><?=substr($cek->unit_no,2,2)?></span></td>
				</tr>
			<tr>
				<td align="left">Nett Sqm</td>
				<td>:</td>
				<td><span><?=$cek->tanah?>&nbsp;m2</span></td>				
				</tr>
			<tr>
				<td align="left">Semigross Sqm</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->bangunan?>&nbsp;m2</span></td>				
			</tr>					
			<tr>
				<td align="left">Pricelist</td>
				<td>:</td>
				<td colspan="4"><span><?=number_format($cek->pricelist_ppn)?></span></td>				
			</tr>
						
			<tr>
				<td align="left">Status</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->unitstatus_nm?>&nbsp;</span></td>				
			</tr>
			
			<tr>
				<td align="left">Customer Name</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->customer_nama?>&nbsp;</span></td>				
			</tr> 
			<tr>
				<td align="left">Reserved Date</td>
				<td>:</td>
				<td colspan="4"><span><?=indo_date($cek->reserved_tgl)?>&nbsp;</span></td>				
			</tr> 
			
			<tr>
				<td align="left">Sales Name</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->sales_nama?>&nbsp;</span></td>				
			</tr> 
			
			<tr>
				<td align="left">Booking Fee</td>
				<td>:</td>
				<td colspan="4"><span><?=$cek->reserved_amount?>&nbsp;</span></td>				
			</tr> 
			
			
			
		</table>
	</form>	
</div>
	
</center>
