<?php
	class cjc extends DBController{	
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('cjc_model');
			$this->set_page_title('Certified Job to Complish');
			$this->default_limit = 30;
			$this->template_dir = 'project/cjc';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['kontrak'] = $this->db->select('id_kontrak,no_spk,no_kontrak')
													->where('isnull(id_flag,0)',2)
													->get('db_kontrak')->result();
													
			$this->parameters['tender'] = $this->db->select('id_detailjob,detail_job,qty,unit,price,total_price')
												   ->where('id_kontrak',@$data->id_kontrak)
												   ->get('db_detailjob')->result();
												   
			#$this->parameters['prop'] = $this->db->select('isnull(sum(proposed_progress),0) as prop_am')
			#										 ->where('id_kontrak',@$data->id_kontrak)
			#										 ->get('db_cjc')->row();
			
													
			$no = 1;
			$proj = 14101;										
			$this->parameters['cjc_no'] = $this->db->query("sp_cekcjcno ".$no.",".$proj."")->row();
			
												    

		}
		
		function get_json(){
			$this->set_custom_function('start_date','indo_date');
			$this->set_custom_function('date_cjc','indo_date');
			$this->set_custom_function('contract_amount','currency');
			$this->set_custom_function('claim_amount','currency');
			parent::get_json();			
		}
		
		function index(){
			$this->set_grid_column('id_cjc','',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('date_cjc','Date.',array('width'=>25,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_cjc','CJC No.',array('width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('job','Main Job',array('width'=>60,'formatter' => 'cellColumn'));
			
			$this->set_grid_column('claim_amount','Value',array('width'=>30,'formatter' => 'cellColumn','align'=>'right'));
			#$this->set_grid_column('proposed_progress','Progress',array('width'=>15,'formatter' => 'cellColumn','align'=>'center'));
			#$this->set_grid_column('no_kontrak','No.Contract.',array('width'=>40,'formatter' => 'cellColumn'));
			
			
			
			#$this->set_grid_column('ba','DP Paid',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('contract_amount','Total Contract',array('width'=>30,'align'=>'right','formatter' => 'cellColumn'));
			$this->set_grid_column('flag_id','Flag',array('hidden'=>true,'width'=>50,'formatter' => 'cellColumn'));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Certified Job to Complish','rownumbers'=>true,'sortname'=>'id_cjc','sortorder'=>'DESC'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
		
		function approved($id){
		$sql = $this->db->where('id_cjc',$id)
							->get('db_cjc')->row();
		
		if($sql->flag_id != 0){
		echo"
				<script type='text/javascript'>
					alert('CJC ini telah diAPPROVED');
					refreshTable();
				</script>
			";			
		}
		else{
		$data['data'] = $this->db->join('db_kontrak b','a.id_kontrak = b.id_kontrak')
								 ->where('id_cjc',$id)
								 ->get('db_cjc a')->row();


		$this->load->view('project/cjc-app',$data);}
		}
		
		
		function getdata($id){
			$qdata = $this->db->select('a.contract_amount,a.dp_amount,a.pph_amount,a.nm_kontrak,b.job,a.progress_amount,d.nm_supplier')
							   ->join('db_tendeva b','a.id_tendeva = b.id_tendeva')
							   ->join('db_participant c','b.id_participant = c.participant_id')
							   ->join('pemasokmaster d','d.kd_supp_gb = c.id_vendor')
							   ->where('a.id_kontrak',$id)
							   ->get('db_kontrak a')->row();
			
			die(json_encode($qdata));exit;				   
							   
		}
		
		function save(){
			
			#$sql = $this->db->query("sp_progress")->result();
							#$a = $sql->thismon;
			#var_dump($sql);
			
			
			
			
			extract(PopulateForm());
			#var_dump($payment);
			
			$update = $this->db->query("sp_update_fullclaim ".$idkontrak."")->row();
			$totnil =  replace_numeric($claim_value) + $update->totclaim;
			$batas  = $update->totkontrak;
		
			
			$roww = $this->db->select("ISNULL(MAX(id_cjc), '0') + 1 as id") 
								->get('db_cjc')->row();
			$id= $roww->id;
			
			
			
			if($batas == $totnil){
			
			// $data = array
			// (
				// id_lunas => 1
			// );
			
			$lunas=$this->db->query("update db_kontrak  set id_lunas='1' WHERE id_kontrak='$idkontrak'");
			
			// $this->db->update('db_kontrak',$data)
					 // ->where('id_kontrak',$idkontrak);
					 
					 
			$input_user = $this->user;
			$this->db->query("sp_inscjcproj ".$paystat.",'".inggris_date($tgl)."','".$no_cjc."',".replace_numeric($claim_value).",
				".replace_numeric($nilpph).",".replace_numeric($nilppn).",'".$input_user."','".$remark."',".$idkontrak."");
			
			
			$message = "Kepada Bpk. Rochmad Wahyudi\n
				
Dengan hormat,\n
Sehubungan dengan adanya permohonan CERTIFIED JOB TO COMPLISH sebesar ".$claim_value." \n
atas pekerjaan ".$job." \n

Mohon untuk di berikan Persetujuan bapak dengan mengakses http://mis.bsu.co.id/user/login/appcjc/".$id." \n
Demikian Informasi permohonan proposed project budget ini\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app_propbgt, $this->displayname_app_probgt);
			$listpro =  array('rochmad@bsu.co.id','ali@bsu.co.id');
			$this->email->to($listpro);
			$this->email->subject('Need Your Approval for CJC');
			$this->email->message($message);	
			$this->email->send();
			
			
			
			
			
			
			
			redirect("workinginst");
			}else{
				
			
			
			
			$input_user = $this->user;
			$this->db->query("sp_inscjcproj ".$paystat.",'".inggris_date($tgl)."','".$no_cjc."',".replace_numeric($claim_value).",
				".replace_numeric($nilpph).",".replace_numeric($nilppn).",'".$input_user."','".$remark."',".$idkontrak."");
			
			
			$message = "Kepada Bpk. Rochmad Wahyudi\n
				
Dengan hormat,\n
Sehubungan dengan adanya permohonan CERTIFIED JOB TO COMPLISH sebesar ".$claim_value." \n
atas pekerjaan ".$job." \n

Mohon untuk di berikan Persetujuan bapak dengan mengakses http://mis.bsu.co.id/user/login/appcjc/".$id." \n
Demikian Informasi permohonan proposed project budget ini\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app_propbgt, $this->displayname_app_probgt);
			$listpro =  array('rochmad@bsu.co.id','ali@bsu.co.id');
			$this->email->to($listpro);
			$this->email->subject('Need Your Approval for CJC');
			$this->email->message($message);	
			$this->email->send();
			
			
			
			redirect("workinginst");
		}	
			
			
			#}
			#elseif ($paystat == 2){ 
			#		$this->db->query("sp_inscjcproj_prog ".$id_kontrak.",'".inggris_date($tgl)."','".$no_cjc."',".$progclaim.",".replace_numeric($payprogclaim).",
			#		'".$remarks."','".$no."',".$paystat.",".replace_numeric($pphprog).",".replace_numeric($ppnprog).",".replace_numeric($paynet).",".$kurang_dp.",".$kurang_retensi."");
			#		redirect("workinginst");
			#	}
			#if ($paystat == 3){
			#	$prop_progress = 0;
				
			#		$this->db->query("sp_inscjcproj_retensi ".$id_kontrak.",'".inggris_date($tgl)."','".$no_cjc."',".$prop_progress.",".replace_numeric($retensi).",
			#		'".$remarks."','".$no."',".$paystat.",".replace_numeric($n_pphretensi).",".replace_numeric($n_ppnretensi).",".replace_numeric($n_paynet)."");
			#redirect("workinginst");}
			
			
			
		}
		
		function saveapp(){
			extract(PopulateForm());
			//~ $id		= 1;
			//~ $id2	= 10;
			#var_dump($tes);
			if(@$klik == 1){
				
				
				
			$this->db->query("sp_appcjc ".$id.",'".$klik."'");
			
						$message = "Kepada Bpk. Agusrial\n
				
Dengan hormat,\n
Permohonan CERTIFIED JOB TO COMPLISH SEBESAR ".$claim_amount.",\n
atas pekerjaan '".$job."', dengan tahap '".$remark."', \n
Telah mendapat PERSETUJUAN \n
Demikian Informasi persetujuan CERTIFIED JOB TO COMPLISH ini kami sampaikan.\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app_propbgt, $this->displayname_app_probgt);
			$listpro =  array('agusrial@bsu.co.id','rochmad@bsu.co.id','ali@bsu.co.id');
			$this->email->to($listpro);
			$this->email->subject($this->subject_app_readcjc);
			$this->email->message($message);	
			$this->email->send();
	
			

			
			
			$this->UserLogin->deleteLogin();
			redirect('user/login');
			
			#redirect("cjc");
			}
			else if(@$batal == 1){
				
	
				
				
				
			$this->db->query("sp_appcjc ".$id."");
			
			
			$message = "Kepada Bpk. Agusrial\n
				
Dengan hormat,\n
Permohonan CERTIFIED JOB TO COMPLISH SEBESAR ".$claim_amount.",\n
atas pekerjaan '".$job."', dengan tahap '".$remark."', \n
TIDAK DI SETUJUI\n
Demikian Informasi persetujuan CERTIFIED JOB TO COMPLISH ini kami sampaikan.\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app_propbgt, $this->displayname_app_probgt);
			$listpro =  array('agusrial@bsu.co.id','rochmad@bsu.co.id','ali@bsu.co.id');
			$this->email->to($listpro);
			$this->email->subject($this->subject_app_readcjc);
			$this->email->message($message);	
			$this->email->send();
			
			
			$this->UserLogin->deleteLogin();
			redirect('user/login');
			#redirect("cjc");
			}
		}
		
		
		
		function printcjc($id){
			#var_dump($id);
			
			
			$data['rows'] = $this->db->query("sp_cetak_cjc ".$id."")->row();
			$data['progress'] = $this->db->query("sp_cetak_cjc_progres ".$id."")->row();
			#$data['prevprog'] = $this->db->query("".$id.""
			$data['value'] = $this->db->query("sp_cetak_cjc_value ".$id."")->row();
			$data['id'] = $id;
			
			$this->load->view('project/print/print_cjobcomplete',$data);
		}
	
	
	function show_cjc($no,$pt,$proj,$desc,$bln,$thn,$no1,$pt1,$desc1,$bln1,$thn1,$idkontrak){
			
		    $data['no_cjc'] = $no."/".$pt."/".$proj."/".$desc."/".$bln."/".$thn;
			#$data['idcjc'] = $this->db->select('max(id_cjc) as id_cjc,id_kontrak')
			#						->group_by('id_cjc,id_kontrak')
			#						 ->get('db_cjc')->row();
			
			$data['nobgt'] = $no1."/".$pt1."/".$desc1."/".$bln1."/".$thn1;
			$data['kontrak'] = $idkontrak;
			
			#var_dump($data['idcjc']);
			
			#$data[''] = $this->db->where()
		  # die($data['idcjc']);
		   
			$this->load->view("project/show_cjc",$data);
		}	
		
		
		function get_dg($no,$pt,$des,$bln,$thn,$idkontrak){
			
			$no_bgt = $no."/".$pt."/".$des."/".$bln."/".$thn;
			
			/*$sql  = $this->db->select('a.job,b.prev,b.ytd')
							->join('db_progress b','a.id_trbgtproj = b.id_trbgtproj')
							->where('no_trbgtproj',$no_bgt)
							 ->get('db_trbgtproj a')->result();*/
			
							 
			#$sql  = $this->db->where('no_trbgtproj',$no_bgt)
			#				 ->get('db_trbgtproj')->result();
			$sql = $this->db->query("sp_prevprog ".$idkontrak."")->result();
			
			#$progres = $_REQUEST['progres'];
			#var_dump($sql);
			$data = array();
			foreach($sql as $row){
				#$prog = $row->ytd - $row->prev;
				#$blc = 100 - $row->ytd;
				#$blcnil = $row->nilai_proposed - $row->nil_prog;
				$progres = 0;
				$ytd	= $row->prog;
				$blc 	= 100 - $ytd;
				$data[] = array 
				(
					
					'jobdet' => $row->job,
					'progres' =>$progres,
					'thismon' => $row->prog,
					'prev' => $row->prev,
					'ytd' =>$ytd,
					'balance' =>$blc
				);
			}
			
			die(json_encode($data));exit;
			
			
			
			
			
			
		}
		
		
		function save_dg(){
			$id  = $_REQUEST['id'];	
			$idkontrak  = $_REQUEST['idkontrak'];	
			$jobdet = $_REQUEST['jobdet'];
			$nobgt = $_REQUEST['nobgt'];
			$progres = $_REQUEST['progres'];
			$prev = $_REQUEST['prev'];
			$ytd = $_REQUEST['ytd'];
			$balance = $_REQUEST['balance'];
			$no_cjc = $_REQUEST['no_cjc'];
			$thismon = $_REQUEST['thismon'];
			$tgl = date("Y-m-d");
			
		
			#$row = $this->db->query("sp_progress")->row();
			#echo "alert('tes')";	
			
			$x1 = array 
					
			(
				'prog' => $progres,
				'prev' =>$prev,
				'ytd' =>$ytd,
				'blc' =>$balance,
				'no_cjc' =>$no_cjc,
				'id_trbgtproj' => $id,
				'id_kontrak' => $idkontrak,
				'tgl_progress' =>$tgl,
				'no_bgt' =>$nobgt
			);
						
			$this->db->insert('db_progress',$x1);
			#$this->db->query("sp_progress ".$id."");
			
			
			$xtampil = array 
				(
					
						
					
					'jobdet' => $jobdet,
					'progres' => $progres,
					'thismon' => $thismon,
					'prev' => $prev,
					'ytd' =>$ytd,
					'balance' =>$balance
					
					
				);
			
			
			die(json_encode($xtampil));
				
		}
	
	
	
	
	}

