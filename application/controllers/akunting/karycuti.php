<?php
	defined('BASEPATH') or die('Access Denied');
	class karycuti extends AdminPage{
		

		function karycuti()
		{
			parent::AdminPage();
			
			$this->load->Model('karycuti_model','cutikary');
			$this->pageCaption = 'LEAVING';
		}
		
		
		function index(){
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$data['karycuti'] = $this->cutikary->namadiv($divisi);
			$data2['karycutijns'] = $this->cutikary->karycutijns();
			$this->parameters['data2'] = $data2;
			$this->parameters['data'] = $data;
			$this->loadTemplate('mis/karycuti_view');
		}
		
		function data($id){
			$data = $this->db->join('db_divisi','divisi_id = id_divisi')
							 ->join('db_karyjab','karyjab_id = id_karyjab')
							/*->join('db_karycuti','kary_id = id_kary')*/
							->join('db_karycutipar','pt_id = id_pt')
							->where('id_kary',$id)
							
							->get('db_kary')
							->row_array();
			
										
			echo json_encode($data);
		}
		
		function loaddata(){
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				switch($data_type){
					case 'karycutials':
						$sql = $this->db->select('karycutials_id id,karycutials_nm nama')
										->where('id_karycutijns',$parent_id)
										->order_by('karycutials_nm','asc')
										->get('db_karycutials')
										->result();
						break;
					case 'karycutijns':
					default:
					    $sql = $this->db->select('karycutijns_id id,karycutijns_nm nama')
										->get('db_karycutijns')->result();
							
				}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}
				die(json_encode($response));
			}
		}

		
		
		
		
		
		
		function balancedcuti(){
					
			extract(PopulateForm());	
							$data3 = array
								(
									'aju_cuti'=>$aju_cuti
								);
					
					echo json_encode($data3);
			}
		
		function insert_cuti(){
			$session_id = $this->UserLogin->isLogin();
			$divisi_id = $session_id['divisi_id'];
			$user_id = $session_id['id'];
			$class = $session_id['class'];
			$pt = $session_id['id_pt'];
			$level = $session_id['level_id'];
			$flow = '1';
			$modul = '1';
			
			
			
			
			extract(PopulateForm());	
							$data = array
							 (							
									'tgl_aju'=>	$tgl_aju,
									'jns_cuti'=> $jns_cuti,
									'karycutials_id'=>$cuti_kat,
									'kary_id'=>$nip,
									'aju_cuti'=>$aju_cuti,
									'startdate_cuti'=>$tgl_mulai, 
									'enddate_cuti'=>$tgl_akhir,
									'tgl_msk'=>$tgl_msk,
									'pic_delegasi'=>$delegasi,
									'ket_cuti'=>$ket, 
									'jns_cuti'=>$jns_cuti,
									
									
									'id_pt'=>$pt,
									'user_id'=>$user_id,
									'divisi_id'=>$divisi_id,
									'level_id'=>$level,
									'flow_id'=>$flow,
									'modul_id'=>$modul
									
							 );
					
					$this->db->insert('db_karycuti',$data);
					 
					
		}	
	
	
	}
