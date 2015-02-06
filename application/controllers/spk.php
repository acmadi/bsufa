<?php
	class spk extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('spk_model');
			$this->set_page_title('Working Instruction');
			$this->default_limit = 40;
			$this->template_dir = 'project/spk';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->userid = $session_id['id'];
			$this->divisi = $session_id['divisi_id'];
			$this->pt = $session_id['id_pt'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['tender'] = $this->db->select('a.id_tendeva,a.no_tendeva')
												   #->join('db_kontrak b','a.id_tendeva = b.id_tendeva')
													   #->where('isnull(b.id_flag,0) !=','2')
													   ->where('a.id_flag','2')
													   ->get('db_tendeva a')->result();
			$this->parameters['pph'] = $this->db->select('pph')
											    ->where('tax_cd','pph')
											    ->get('db_tax')->result();
										   


			$no = 1;
			$proj = 14101;	
			$div = $this->divisi;
			$pt = $this->pt;													   
			$sql = $this->db->query("sp_cekspkno ".$div.",".$pt.",".$no."")->row();
			//var_dump($sql->no_spk);exit;
			$this->parameters['nospk'] = $sql->no_spk;										   
										
		}	
		
		
		function get_json(){
			$this->set_custom_function('contract_amount','currency');
			$this->set_custom_function('adendum','currency');
			$this->set_custom_function('deduction','currency');
			$this->set_custom_function('start_date','indo_date');
			$this->set_custom_function('end_date','indo_date');
			parent::get_json();
		}						
		
		function index(){
			$this->set_grid_column('id_kontrak','id',array('hidden'=>true,'width'=>20,'align'=>'center'));
			$this->set_grid_column('no_tendeva','Reff Tender.',array('hidden'=>true,'width'=>60,'formatter' => 'cellColumn'));
			$this->set_grid_column('no_spk','SPK No.',array('width'=>35,'formatter' => 'cellColumn'));
			//$this->set_grid_column('no_kontrak','Contract.No',array('width'=>40,'formatter' => 'cellColumn'));
			//$this->set_grid_column('nm_subproject','Project',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('job','Job',array('width'=>70,'formatter' => 'cellColumn'));
			$this->set_grid_column('nm_supplier','Contractor',array('width'=>40,'formatter' => 'cellColumn'));
			
			$this->set_grid_column('start_date','Start Date',array('hidden'=>true,'width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('end_date','End Date',array('hidden'=>true,'width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('contract_amount','Contract Amount',array('width'=>30,'align'=>'right','formatter' => 'cellColumn'));
			//$this->set_grid_column('adendum','Addendum',array('width'=>30,'formatter' => 'cellColumn'));
			//$this->set_grid_column('deduction','Deduction',array('width'=>30,'formatter' => 'cellColumn'));
			$this->set_grid_column('id_flag','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));						
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Surat Perintah Kerja','rownumbers'=>true,'sortname'=>'id_kontrak','sortorder'=>'ASC'));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}		
		
		
		function getdata($id){
			$sql = $this->db->query("SP_Tampilspkrow ".$id."")->row(); 
			die(json_encode($sql));
		}
		
		
		function save(){
			extract(PopulateForm());
			
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->userid = $session_id['id'];
			$this->divisi = $session_id['divisi_id'];
			$this->pt = $session_id['id_pt'];
			
			
			#$ppn_amount = replace_numeric($ppn);
			#$pph_amount = replace_numeric($pph);
			#$dp_amount = replace_numeric($dp) ;
			#$pph	 = replace_numeric($pphpersen);
			#$bfcontr = replace_numeric($kontraknett);
			$pt = $this->pt;
			
			#$ramount = replace_numeric($retension);
			$amount =  replace_numeric($amount);
			$tgl_awal = inggris_date($tgl_awal);
			$tgl_akhir = inggris_date($tgl_akhir);
			#$project = "41011";
			$user = $this->userid;
			$ppn = 10;
			//Insert SPK Project
			$sql = $this->db->query("sp_InsSpkproj ".$reftender.",'".$spk."','".$tgl_awal."'
			,'".$tgl_akhir."',".$amount.",'".$currency."',
			'".$nm1."','".$nm2."','".$position1."','".$position2."','".inggris_date($tgl)."',
			'".$user."','".$project."','".$pt."','".$job."','".$lingkup."','".$jadwal."','".$pph."'");
			
			#redirect("spk");
			die("sukses");
			
			#redirect("spk");
			//$this->load->view('project/print/print_spk');	
			
			
		}
		

		function save_app(){
			extract(PopulateForm());
			$data = array 
			(
				'id_flag' => 1
			);
			$this->db->where('id_kontrak',$id_kontrak);
			$this->db->update('db_kontrak',$data);
			redirect("spk");

		}		
		
		function saveprop(){
			$data['id'] = $this->input->post('id_kontrak');
			$data['no_contr'] = $this->input->post('no_contr');
			$this->load->view('project/print/print_spk',$data);	
		}
		
	function approve($id){
		$cek_status = $this->db->select('isnull(id_flag,0) as id')
							   ->where('id_kontrak',$id)
							   ->get('db_kontrak')->row();
							   
		if($cek_status->id != 0 ){
			echo"
				<script type='text/javascript'>
					alert('Sudah di approve');
					refreshTable();
				</script>
			";
		}else{
			parent::approve($id);
		}
	}
	
		function print_spk($id){
			$data['id_kontrak'] = $id;
			$this->load->view('project/print/print_spk',$data);	
		}	
		
	
		function show_payform($no,$pt,$desc,$bln,$thn,$nilai){
			$index = $_GET['index'];
			$data['nospk'] = $no."/".$pt."/".$desc."/".$bln."/".$thn;
			$data['kontrak'] = $nilai;
			$this->load->view("project/show_payform",$data);
		}
		
		function save_payspk(){
		#$no_bgt = $_REQUEST['no_bgt'];
			$nospk = $_REQUEST['nospk'];
			$top = $_REQUEST['top'];
			$persen = $_REQUEST['persen'];
			$ket = $_REQUEST['keterangan'];
			$kontrak = $_REQUEST['kontrak'];
			
			#var_dump($noprop);
			$nil_kontrak = $kontrak * ($persen/100);
			
			$payspk = array 
				(
					'nospk' => $nospk,
					 'tipe_payspk' => $top,
					 'persen' => $persen,
					 'ket_spk' => $ket,
					 'amount' => $nil_kontrak
					 
				);
			$this->db->insert('db_payspk',$payspk);			
			
			if($top == 1){ $top = 'DP';}
			elseif ($top == 2){ $top = 'Progress';}
			elseif($top == 3){ $top = 'Retensi';}
			
			
			$xtampil = array 
				(
					'nospk' => $nospk,
					 'top' => $top,
					 'persen' => $persen,
					 'keterangan' => $ket
					 
				);
			die(json_encode($xtampil));
			
		
		
		}
			
	
	}

