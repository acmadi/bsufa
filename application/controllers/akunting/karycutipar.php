<?php
	defined('BASEPATH') or die('Access Denied');
	class karycutipar extends AdminPage{
		

		
		function index(){
			$this->load->Model('karycutipar_model','karycutipar');
			parent::AdminPage();
			
			
			
			$data['cutipar'] = $this->karycutipar->selectkarycutipar();
			$this->parameters['data'] = $data;
						
			$this->loadTemplate('mis/karycutipar_view');
		
				}
			
		function ins(){
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$class = $session_id['class'];
			$pt = $session_id['id_pt'];
			$level = $session_id['level_id'];
		
		
				extract(PopulateForm());
		
				$data = array 
				(
					'saldo_cuti'=>$saldo,
					'cuti_masal'=>$masal,
					'thn'=>$thn,
					'pt_id'=>$pt
				);
				 
				 $this->db->insert('db_karycutipar',$data);
				 
				 redirect('akunting/karycutipar');
			
			
			}
		
		}
		
		
		
		
		
				
	
