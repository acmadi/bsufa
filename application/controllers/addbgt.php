<?php
	class addbgt extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('addbgt_model');
			$this->set_page_title('ADD BUDGET');
			$this->default_limit = 30;
			$this->template_dir = 'project/addbgt';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->divisi = $session_id['divisi_id'];
		}
		
		protected function setup_form($data=false){
			
												
		}
		

	function get_json(){
		$this->set_custom_function('tgl_bgtproj','indo_date');
		$this->set_custom_function('nilai_bgtproj','currency');
		//~ $this->set_custom_function('mei14','currency');
		parent::get_json();
		
		
	}
		
		
		function index(){
			$this->set_grid_column('id_bgtproj_update_add','',array('width'=>50,'hidden'=>true,'align'=>'center'));
			$this->set_grid_column('flag','flag',array('width'=>50,'hidden'=>true,'align'=>'center'));
			//~ $this->set_grid_column('id_reclass','',array('width'=>50,'hidden'=>true,'align'=>'center'));
			$this->set_grid_column('tgl_bgtproj','Date',array('width'=>50,'align'=>'center','formatter' => 'cellColumn'));
			$this->set_grid_column('remark','Remark',array('width'=>200,'formatter' => 'cellColumn'));
			$this->set_grid_column('nilai_bgtproj','Amount',array('width'=>70,'formatter' => 'cellColumn','align'=>'right'));
			$this->set_grid_column('id_user','Requestor',array('width'=>50,'align'=>'left','formatter' => 'cellColumn'));
			
		
			$this->set_jqgrid_options(array('width'=>900,'height'=>200,'caption'=>'ADDITIONAL BUDGET','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		function approved($id){
		$data['sql'] = $this->db->join('db_subproject','id_subproject = subproject_id')
								->where('id_bgtproj_update_add',$id)	
								->get('db_bgtproj_update_add')->row();
								
		
			
		$this->load->view('project/addbgt-input',$data);	
		
		}
		
		
		
		function saveaddbgt(){
			
			extract(PopulateForm());
		
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$user = $this->user;
		
			#die($idaddbgt);
			
			
			
			if(@$klik == 1){
				
				
				
				
				
				
			$sql =	$this->db->query("sp_addbgt_input '".$idcostproj2."','".$coano2."','".$nmbgtproj2."','".$nilaibgtproj2."','".$tglbgtproj2."',
						         '".$inputdate2."','".$iddivisi2."','".$idpt2."','".$idsubproject2."','".$user."','".$kodebgtproj2."','".$adj2."','".$remark2."',
						         '".$idaddbgt."'");
			
			
			
						$message = "Kepada Bpk. Erick\n
				
Dengan hormat,\n
Permohonan ".$remark2." SEBESAR ".number_format($nilaibgtproj2).",\n

Telah mendapat PERSETUJUAN \n

Demikian Informasi persetujuan PENAMBAHAN BUDGET ini kami sampaikan.\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app_propbgt, $this->displayname_app_probgt);
			$listpro =  array('erick@bsu.co.id','setiono@bsu.co.id','ali@bsu.co.id');
			$this->email->to($listpro);
			$this->email->subject($this->subject_app_readdbgt);
			$this->email->message($message);	
			$this->email->send();
	
			
			#if($sql) die("sukses");
			$this->UserLogin->deleteLogin();
			redirect('user/login');
			
			}
			else if(@$batal == 1){
				#echo "<script>alert('batal');</script>";
				#$this->load->view('gl/print/print_excel_tb');
				$sql = $this->db->query("sp_addbgt_void '".$idaddbgt."'");
				
				
				$message = "Kepada Bpk. Erick\n
				
Dengan hormat,\n
Permohonan ".$remark2." SEBESAR ".number_format($nilaibgtproj2).",\n

TIDAK DAPAT DI SETUJUI \n

Demikian Informasi persetujuan PENAMBAHAN BUDGET ini kami sampaikan.\n
Terimakasih 
PT.GMI System Application";			

//die($message);
			$this->email->from($this->from_app_propbgt, $this->displayname_app_probgt);
			$listpro =  array('erick@bsu.co.id','setiono@bsu.co.id','ali@bsu.co.id');
			$this->email->to($listpro);
			$this->email->subject($this->subject_app_readdbgt);
			$this->email->message($message);	
			$this->email->send();
				
				
				
				
				
				
				
				
				#if($sql) die("sukses");
				
				$this->UserLogin->deleteLogin();
			redirect('user/login');
			}
		
		}
		
				
		
	
	}

