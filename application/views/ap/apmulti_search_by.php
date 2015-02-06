<?php
	$session_id = $this->UserLogin->isLogin();
	$this->user = $session_id['username'];
	$this->pt = $session_id['id_pt'];
	
	/* PO area */
	if($type=="po"){
		$form_code = "A";
		$supplier  = "";
		
		if($flag == "sbc"){
			$form_code = str_replace("ForwardSlash","/",$c); 
		}
		
		if($flag == "sbs"){
			$nm_supplier = str_replace("--+--"," ",$c);
			$supplier    = " and nm_supplier like ('".$nm_supplier."%') ";
		}
		/*$Qry  = "SELECT id_trbgt,form_kode,PEMASOK.nm_supplier,db_trbgtdiv.remark  FROM DB_BARANGPOH
					INNER JOIN PEMASOK ON PEMASOK.KD_SUPP_GB=DB_BARANGPOH.KD_SUPP
					INNER JOIN KELUSAHA ON KELUSAHA.ID_KELUSAHA=PEMASOK.ID_KELUSAHA
					INNER JOIN DB_PR ON DB_PR.no_pr = db_BarangPOH.reff_pr
					LEFT JOIN db_trbgtdiv ON db_trbgtdiv.id_trbgt = db_pr.trbgt_id
					LEFT JOIN DB_APLEDGER ON DB_APLEDGER.REF_NO=DB_BARANGPOH.BRGPOH_ID
					LEFT JOIN DB_APINVOICE ON DB_APINVOICE.REF_NO=DB_BARANGPOH.BRGPOH_ID*/
		$Qry = "SELECT id_trbgt,form_kode,nm_supp as nm_supplier,db_trbgtdiv.remark from db_trbgtdiv 
					join db_pr on db_trbgtdiv.id_trbgt = db_pr.trbgt_id 
					join db_BarangPOH on db_pr.no_pr = db_BarangPOH.reff_pr
					WHERE form_kode like ('".$form_code."%') " .$supplier. " and db_trbgtdiv.id_pt = ".$this->pt." ORDER BY id_trbgt DESC"; 
		$sbc_npo = $this->db->query($Qry)->result();
		?>
		<?php foreach($sbc_npo as $sbc_rpo):?>
		<tr id="sbc_x<?php echo $sbc_rpo->id_trbgt;?>" class="listmulti po_get_row po_onsearch" sbc_get_povalue="<?php echo $sbc_rpo->id_trbgt;?>">
				<td width="140px"><?php echo $sbc_rpo->form_kode;?></td>
				<td width="160px"><?php echo $sbc_rpo->nm_supplier;?></td>
				<td width="710px">
					<?php echo $sbc_rpo->remark;?>
					<span id="checklist"><input type="checkbox" value="<?php echo $sbc_rpo->id_trbgt;?>" id="<?php echo "sbc_ch".$sbc_rpo->id_trbgt;?>" class="get_vendorname"></span>
				</td>
		</tr>
		<?php 
		endforeach;
	}
	
	
	/* OPE area */
	if($type=="ope"){
		$form_code = "";
		$code_id   = "";
		$remark	   = "";
		if($flag == "sbc"){
			$parse     = str_replace("ForwardSlash","/",$c);
			$form_code = " and SUBSTRING(form_kode,14,5) like ('%".$parse."%') ";
		}
		
		if($flag == "sbs"){ 
			$parse 	 = $c;
			$code_id = " and code_id like ('".$parse."%')";
		}
		
		if($flag == "sbr"){ 
			$parse 	 = str_replace("--+--"," ",$c);
			$remark = " and remark like ('".$parse."%')";
		}
		$Qry  = "select form_kode, code_id, remark, id_trbgt from db_trbgtdiv 
				 where id_pt = ".$this->pt." 
				 and LEFT(form_kode,1) = 'A' ".$form_code."".$code_id."".$remark.""; 
		//var_dump($Qry);
		$sbc_npo = $this->db->query($Qry)->result();
		?>
		<?php foreach($sbc_npo as $sbc_rpo):?>
		<tr id="sbc_z<?php echo $sbc_rpo->id_trbgt;?>" class="listmulti ope_get_row ope_onsearch" sbc_get_opevalue="<?php echo $sbc_rpo->id_trbgt;?>">
				<td width="140px"><?php echo $sbc_rpo->form_kode;?></td>
				<td width="160px"><?php echo $sbc_rpo->code_id;?></td>
				<td width="710px">
					<?php echo $sbc_rpo->remark;?>
					<span id="ope_checklist"><input type="checkbox" value="<?php echo $sbc_rpo->id_trbgt;?>" id="<?php echo "sbc_ope".$sbc_rpo->id_trbgt;?>" class="get_vendorname"></span>
				</td>
		</tr>
		<?php 
		endforeach;
	}
	
	/* PRO area */
	if($type=="pro"){
		$form_code  = "A";
		$supplier   = "";
		$remark	    = "";
		if($flag == "sbc"){
			$form_code = str_replace("ForwardSlash","/",$c);
		}
		
		if($flag == "sbs"){ 
			$parse 	  = str_replace("--+--"," ",$c);
			$supplier = " and code_id like ('".$parse."%')";
		}
		
		if($flag == "sbr"){ 
			$parse 	 =  str_replace("--+--"," ",$c);
			$remark  = " and remark like ('".$parse."%')";
		}
		$Qry  = "SELECT id_trbgt,form_kode,PEMASOK.nm_supplier,db_trbgtdiv.remark  FROM DB_BARANGPOH
									INNER JOIN PEMASOK ON PEMASOK.KD_SUPP_GB=DB_BARANGPOH.KD_SUPP
									INNER JOIN KELUSAHA ON KELUSAHA.ID_KELUSAHA=PEMASOK.ID_KELUSAHA
									INNER JOIN DB_PR ON DB_PR.no_pr = db_BarangPOH.reff_pr
									LEFT JOIN db_trbgtdiv ON db_trbgtdiv.id_trbgt = db_pr.trbgt_id
									LEFT JOIN DB_APLEDGER ON DB_APLEDGER.REF_NO=DB_BARANGPOH.BRGPOH_ID
									LEFT JOIN DB_APINVOICE ON DB_APINVOICE.REF_NO=DB_BARANGPOH.BRGPOH_ID
									WHERE form_kode like ('".$form_code."%') " .$supplier. " " .$remark. " and db_trbgtdiv.id_pt = ".$this->pt." ORDER BY id_trbgt DESC"; 
		$sbc_npo = $this->db->query($Qry)->result();
		?>
		<?php foreach($sbc_npo as $sbc_rpo):?>
		<tr id="sbc_y<?php echo $sbc_rpo->id_trbgt;?>" class="listmulti pro_get_row pro_onsearch" sbc_get_provalue="<?php echo $sbc_rpo->id_trbgt;?>">
				<td width="140px"><?php echo $sbc_rpo->form_kode;?></td>
				<td width="160px"><?php echo $sbc_rpo->code_id;?></td>
				<td width="710px">
					<?php echo $sbc_rpo->remark;?>
					<span id="pro_checklist"><input type="checkbox" value="<?php echo $sbc_rpo->id_trbgt;?>" id="<?php echo "sbc_pro".$sbc_rpo->id_trbgt;?>" class="get_vendorname"></span>
				</td>
		</tr>
		<?php 
		endforeach;
	}
	?>
	
<script type="text/javascript">
$(document).ready(function(){
	$(".get_vendorname").hide();
	// for click search by code <SBC> PO
	$(".po_get_row").click(function(){
		var c = this.getAttribute('sbc_get_povalue');
		var is_check = $("#sbc_ch"+c).is(":checked");
		if(is_check){
			$("#sbc_x"+c).css("background-color","#ffffff");
			$("#sbc_ch"+c).attr("checked",false);
		}else{
			$("#sbc_x"+c).css("background-color","#ff8379");
			$("#sbc_ch"+c).attr("checked","checked");
		}
		
	});
	
	// for click search by code <SBC> OPE
	$(".ope_get_row").click(function(){
		var c = this.getAttribute('sbc_get_opevalue');
		var is_check = $("#sbc_ope"+c).is(":checked");
		if(is_check){
			$("#sbc_z"+c).css("background-color","#ffffff");
			$("#sbc_ope"+c).attr("checked",false);
		}else{
			$("#sbc_z"+c).css("background-color","#ff8379");
			$("#sbc_ope"+c).attr("checked","checked");
		}
		
	});
	
	// for click search by code <SBC> OPE
	$(".pro_get_row").click(function(){
		var c = this.getAttribute('sbc_get_provalue');
		var is_check = $("#sbc_pro"+c).is(":checked");
		if(is_check){
			$("#sbc_y"+c).css("background-color","#ffffff");
			$("#sbc_pro"+c).attr("checked",false);
		}else{
			$("#sbc_y"+c).css("background-color","#ff8379");
			$("#sbc_pro"+c).attr("checked","checked");
		}
		
	});
});
</script>