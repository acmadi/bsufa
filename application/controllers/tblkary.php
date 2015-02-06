<?php
	class tblkary extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('tblkary_model');
			$this->set_page_title('List Of Employee');
			$this->default_limit = 10;
			$this->template_dir = 'hrd/tblkary';
		}
		
				
		protected function setup_form($data=false){
			$this->load->model('tblkary_model','divisi');
			$this->parameters['divisi'] = $this->divisi->divisi();
			$this->load->model('tblkary_model','karyjab');
			$this->parameters['karyjab'] = $this->divisi->jabatan();
			$this->load->model('tblkary_model','karylvl');
			$this->parameters['karylvl'] = $this->divisi->Level();
			$this->load->model('tblkary_model','pndd');
			$this->parameters['pndd'] = $this->divisi->strata();
			$this->load->model('tblkary_model','karystat');
			$this->parameters['karystat'] = $this->divisi->status();
			$this->parameters['karysek'] = $this->divisi->sek();
			$this->parameters['agama'] = $this->divisi->agama();
			$this->parameters['jurusan'] = $this->divisi->jurus();
			$this->parameters['karydrh'] = $this->divisi->gol_darah();
			$this->parameters['karykk'] = $this->divisi->klrg();
			$this->parameters['karyket'] = $this->divisi->karyket();
			
			$id = @$data->id_kary;
			$this->parameters['karyklrg'] = $this->divisi->klg($id);
			$this->parameters['join_all'] = $this->divisi->joinall_table($id);
			//var_dump($this->parameters['join_all']);
			
		}

		function ceknip(){
			$field = $this->input->get('fieldId');
			$value = $this->input->get('fieldValue');
			$save = $this->db->where('id_kary',$value)
						 ->get('db_kary')->num_rows();
			$call = $save > 0;
			$result = array($field,!$call);
			echo json_encode($result);
		}		
		
		function index(){
			#die("test");
			$this->set_grid_column('no_urut','ID',array('hidden'=>true));
			$this->set_grid_column('id_kary','NIP',array('width'=>60));
			$this->set_grid_column('nama','Nama',array('width'=>100));
			$this->set_grid_column('divisi_nm','Divisi',array('width'=>200));
			$this->set_grid_column('karyjab_nm','Jabatan',array('width'=>100));
			$this->set_grid_column('karylvl_nm','Level',array('width'=>100));
			//$this->set_grid_column('tgl_join','Tgl. Join',array('width'=>100));
			//$this->set_grid_column('pndd_nm','Strata',array('width'=>50));
			//$this->set_grid_column('karystat_nm','Status',array('width'=>100));
			//$this->set_grid_column('agama_nm','Agama',array('width'=>100,'align'=>'center'));
			//$this->set_grid_column('hp2','HP',array('width'=>150));
			//$this->set_grid_column('pnddjur_nm','Major',array('width'=>150));
			$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'List Of Employee','rownumbers'=>true));
			parent::index();
		
		}
		
		function del($id){
			#die($id);
			$data = array (
				'id_flag' => 10
				);
			
			$this->db->where('no_urut',$id);
			$this->db->update('db_kary',$data);
			echo"
				<script type='text/javascript'>
					alert('Sukses');
					refreshTable();
				</script>
			";
		}
		
		function save(){
			extract(PopulateForm());

			$nip 		= $this->input->post('nip');
			$karysek 	= $this->input->post('karysek');
			$nama 		= $this->input->post('nama');
			$agama 		= $this->input->post('agama');
			$divisi 	= $this->input->post('divisi');
			$tgl_lhr 	= $this->input->post('tgl_lhr');
			$karyjab 	= $this->input->post('karyjab');
			$tmpt_lhr 	= $this->input->post('tmpt_lhr');
			$karylvl 	= $this->input->post('karylvl');
			$alamat 	= $this->input->post('alamat');
			$join 		= $this->input->post('join');
			$hp 		= $this->input->post('hp');
			$karystat 	= $this->input->post('karystat');
			$mail 		= $this->input->post('mail');
			$karydrh 	= $this->input->post('karydrh');
			$karykk 	= $this->input->post('karykk');
			$karyket 	= $this->input->post('karyket');
			$pndd 		= $this->input->post('pndd');
			$pnddjur 	= $this->input->post('pnddjur');
			$bank_nm 	= $this->input->post('bank_nm');
			$bank_acc 	= $this->input->post('bank_acc');
			$no_npwp 	= $this->input->post('no_npwp');
			$no_jamso 	= $this->input->post('no_jamso'); 
			$no 		= $this->input->post('no_urut');
			
			$this->db->set('id_kary',$nip); 		
			$this->db->set('id_karysek',$karysek); 	
			$this->db->set('nama',$nama); 		
			$this->db->set('id_agama',$agama); 		
			$this->db->set('id_divisi',$divisi); 	
			$this->db->set('ttl',$tgl_lhr); 	
			$this->db->set('id_karyjab',$karyjab); 	
			$this->db->set('tmpt_ttl',$tmpt_lhr); 	
			$this->db->set('id_karylvl',$karylvl);	
			$this->db->set('alamat',$alamat); 	
			$this->db->set('tgl_join',$join); 		
			$this->db->set('hp1',$hp); 		
			$this->db->set('id_karystat',$karystat); 
			$this->db->set('email',$mail); 		
			$this->db->set('id_karydrh',$karydrh); 
			$this->db->set('id_karykk',$karykk); 
			$this->db->set('id_karyket',$karyket);
			$this->db->set('id_pndd',$pndd); 	
			$this->db->set('id_pnddjur',$pnddjur);
			$this->db->set('bank_nm',$bank_nm); 
			$this->db->set('bank_acc',$bank_acc);
			$this->db->set('no_npwp',$no_npwp); 	
			$this->db->set('no_jamso',$no_jamso);
			
					
			
			$this->db->where('no_urut',$no);
			$this->db->update('db_kary');
			
			$pas_nm 		= $this->input->post('pas_nm');
			$pas_lhr 		= $this->input->post('pas_lhr');
			$ank1 			= $this->input->post('ank1');
			$ank1_lhr 		= $this->input->post('ank1_lhr');
			$ank2 			= $this->input->post('ank2');
			$ank2_lhr 		= $this->input->post('ank2_lhr');
			$ank3 			= $this->input->post('ank3');
			$ank3_lhr 		= $this->input->post('ank3_lhr');
			$ank4 			= $this->input->post('ank4');
			$ank4_lhr	 	= $this->input->post('ank4_lhr');
			$emrg_nm 		= $this->input->post('emrg_nm');
			$emrg_addr 		= $this->input->post('emrg_addr');
			$emrg_rlt 		= $this->input->post('emrg_rlt');
			$emrg_hp1 		= $this->input->post('emrg_hp1');
			$emrg_hp2 		= $this->input->post('emrg_hp2');
			
			$this->db->set('kary_id',$nip);
			$this->db->set('pas_nm',$pas_nm);
			$this->db->set('pas_lhr',$pas_lhr);
			$this->db->set('ank1',$ank1);
			$this->db->set('ank1_lhr',$ank1_lhr);
			$this->db->set('ank2',$ank2);
			$this->db->set('ank2_lhr',$ank2_lhr);
			$this->db->set('ank3',$ank3 );
			$this->db->set('ank3_lhr',$ank3_lhr);
			$this->db->set('ank4',$ank4 );
			$this->db->set('ank4_lhr',$ank4_lhr);
			$this->db->set('emrg_nm',$emrg_nm);
			$this->db->set('emrg_addr',$emrg_addr);
			$this->db->set('emrg_rlt',$emrg_rlt );
			$this->db->set('emrg_hp1',$emrg_hp1);
			$this->db->set('emrg_hp2',$emrg_hp2);
		
			$this->db->where('kary_id',$nip);
			$this->db->update('db_karyklrg');
			echo('Tersimpan');
			//redirect('tblkary');
		}
			
			
			
			
			function input(){
				    extract(PopulateForm());
					$session_id = $this->UserLogin->isLogin();
					//$divisi = $session_id['divisi_id'];
					//$class = $session_id['class'];
					$pt = $session_id['id_pt'];
					//$level = $session_id['level_id'];
					$user = $session_id['id'];
					
					$data = array
					(
						'id_kary'=>$nip,
						'id_karysek'=>$karysek,
						'id_pt'=>$pt,
						'id_divisi'=>$divisi,
						'nama'=>$nama, 		
						'id_agama'=>$agama, 		
						'ttl'=>$tgl_lhr, 	
						'id_karyjab'=>$karyjab, 	
						'tmpt_ttl'=>$tmpt_lhr, 	
						'id_karylvl'=>$karylvl,	
						'alamat'=>$alamat, 	
						'tgl_join'=>$join, 		
						'hp1'=>$hp, 		
						'id_karystat'=>$karystat, 
						'email'=>$mail, 		
						'id_karydrh'=>$karydrh,
						'id_karykk'=>$karykk,
						'id_karyket'=>$karyket,
						'id_pndd'=>$pndd, 	
						'id_pnddjur'=>$pnddjur,
						'bank_nm'=>$bank_nm, 
						'bank_acc'=>$bank_acc,
						'no_npwp'=>$no_npwp, 	
						'no_jamso'=>$no_jamso,
						'user_id'=>$user
					);
			
					$data2 = array
					(
						'kary_id'=>$nip,
						'pas_nm'=>$pas_nm,
						'pas_lhr'=>$pas_lhr,
						'ank1'=>$ank1,
						'ank1_lhr'=>$ank1_lhr,
						'ank2'=>$ank2,
						'ank2_lhr'=>$ank2_lhr,
						'ank3'=>$ank3,
						'ank3_lhr'=>$ank3_lhr,
						'ank4'=>$ank4,
						'ank4_lhr'=>$ank4_lhr,
						'emrg_nm'=>$emrg_nm,
						'emrg_addr'=>$emrg_addr,
						'emrg_rlt'=>$emrg_rlt,
						'emrg_hp1'=>$emrg_hp1,
						'emrg_hp2'=>$emrg_hp2
					);
              
					if($no_urut){
						$this->db->where('no_urut',$no_urut);
						$this->db->update('db_kary',$data);
						$this->db->where('kary_id',$nip);
						$this->db->update('db_karyklrg',$data2);
						echo"Data berhasil terupdate";
					}else{	
						$this->db->insert('db_kary',$data);
						$this->db->insert('db_karyklrg',$data2);		
						echo"Data berhasil tersimpan";
					}
					
			}
			
			
			
			
	
	}
?>
