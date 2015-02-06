<?php
	class projbgt extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('projbgt_model');
			$this->set_page_title('ORIGINAL PROJECT BUDGET');
			$this->default_limit = 30;
			$this->template_dir = 'project/projbgt';
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt = $session_id['id_pt'];
			$this->divisi = $session_id['divisi_id'];
		}
		
		protected function setup_form($data=false){
			$this->parameters['project'] = $this->db->where('id_pt',$this->pt)
													->get('db_subproject')->result();	
													
			$this->parameters['divisi'] = $this->db->get('db_divisi')->result();
			$this->parameters['bgt'] = $this->db->select('distinct(kode_bgtproj)')
												->get('db_bgtproj_update')->result();
												
			//~ $this->parameters['bln']  = array("","Januari","Febuari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober",
						 //~ "November","Desember");
												//~ 
		}
		

	function get_json(){
		$this->set_custom_function('tgl_bgtproj','indo_date');
		$this->set_custom_function('jan12','currency');
		//~ $this->set_custom_function('feb12','currency');
		//~ $this->set_custom_function('mar12','currency');
		//~ $this->set_custom_function('apr12','currency');
		//~ $this->set_custom_function('mei12','currency');
		//~ $this->set_custom_function('jun12','currency');
		//~ $this->set_custom_function('jul12','currency');
		//~ $this->set_custom_function('agu12','currency');
		//~ $this->set_custom_function('sep12','currency');
		//~ $this->set_custom_function('okt12','currency');
		//~ $this->set_custom_function('nov12','currency');
		//~ $this->set_custom_function('des12','currency');
		//~ $this->set_custom_function('jan13','currency');
		//~ $this->set_custom_function('feb13','currency');
		//~ $this->set_custom_function('mar13','currency');
		//~ $this->set_custom_function('apr13','currency');
		//~ $this->set_custom_function('mei13','currency');
		//~ $this->set_custom_function('jun13','currency');
		//~ $this->set_custom_function('jul13','currency');
		//~ $this->set_custom_function('agu13','currency');
		//~ $this->set_custom_function('sep13','currency');
		//~ $this->set_custom_function('oct13','currency');
		//~ $this->set_custom_function('nov13','currency');
		//~ $this->set_custom_function('des13','currency');
		//~ $this->set_custom_function('jan14','currency');
		//~ $this->set_custom_function('feb14','currency');
		//~ $this->set_custom_function('mar14','currency');
		//~ $this->set_custom_function('apr14','currency');
		//~ $this->set_custom_function('mei14','currency');
		parent::get_json();
		
		
	}
		
		
		function index(){
			$this->set_grid_column('coa_no','Account BGT',array('width'=>100,'align'=>'left'));
			$this->set_grid_column('kode_bgtproj','Code BGT',array('width'=>80,'align'=>'center'));
			$this->set_grid_column('nm_bgtproj','DESCRIPTION',array('width'=>200));
			$this->set_grid_column('jan12','TOTAL BUDGET',array('width'=>100,'align'=>'right'));
			//~ $this->set_grid_column('feb12','Feb2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('mar12','Mar2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('apr12','Apr2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('mei12','Mei2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('jun12','Jun2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('jul12','Jul2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('agu12','Agu2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('sep12','Sep2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('oct12','Okt2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('nov12','Nov2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('des12','Des2012',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('jan13','Jan2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('feb13','Feb2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('mar13','Mar2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('apr13','Apr2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('mei13','Mei2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('jun13','Jun2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('jul13','Jul2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('agu13','Agu2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('sep13','Sep2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('oct13','Oct2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('nov13','Nov2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('des13','Des2013',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('jan14','Jan2014',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('feb14','Feb2014',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('mar14','Mar2014',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('apr14','Apr2014',array('width'=>40,'align'=>'right'));
			//~ $this->set_grid_column('mei14','Mei2014',array('width'=>40,'align'=>'right'));
		
			$this->set_jqgrid_options(array('width'=>800,'height'=>400,'caption'=>'ORIGINAL PROJECT BUDGET','rownumbers'=>true));
			if($this->user!="")parent::index();
			else die("The Page Not Found");
		}
		
		
		function loaddata(){
			#die($this->input->post('parent_id'));
			if($this->input->post('data_type')){
				$data_type = $this->input->post('data_type');
				$parent_id = $this->input->post('parent_id');
				
				switch($data_type){
					case 'project_id':
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$this->pt)
										->get('db_subproject')->result();
						break;

					case 'proj1':
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$this->pt)
										->get('db_subproject')->result();
						break;

					case 'proj2':
					    $sql = $this->db->select('subproject_id id,nm_subproject nama')
										->where('id_pt',$this->pt)
										->get('db_subproject')->result();
						break;

					case 'cost1' :
					    $sql = $this->db->select('c.id_scostproj id,c.nm_scost nama')
										->join('db_sbgtproj b','a.project_id = b.id_hbgbtproj')
										->join('db_costproj c','b.id_scostproj = c.id_scostproj')
										->where('project_id',$parent_id)
										->get('db_hbgtproject a')->result();	
						break;
					case 'scost1' :
						$sql = $this->db->select('id_ssubbgtproj id,nm_ssubbgtproj nama')
										->where('id_scostproj',$parent_id)
										->get('db_ssubbgtproj')->result();
					break;	
					
					case 'cost2' :
					    $sql = $this->db->select('c.id_scostproj id,c.nm_scost nama')
										->join('db_sbgtproj b','a.project_id = b.id_hbgbtproj')
										->join('db_costproj c','b.id_scostproj = c.id_scostproj')
										->where('project_id',$parent_id)
										->get('db_hbgtproject a')->result();	
						break;
					case 'scost2' :
						$sql = $this->db->select('id_ssubbgtproj id,nm_ssubbgtproj nama')
										->where('id_scostproj',$parent_id)
										->get('db_ssubbgtproj')->result();
					break;	
					
					case 'cost' :
					    $sql = $this->db->select('c.id_scostproj id,c.nm_scost nama')
										->join('db_sbgtproj b','a.project_id = b.id_hbgbtproj')
										->join('db_costproj c','b.id_scostproj = c.id_scostproj')
										->where('project_id',$parent_id)
										->get('db_hbgtproject a')->result();	
						break;
					case 'subcost' :
						$sql = $this->db->select('id_ssubbgtproj id,nm_ssubbgtproj nama')
										->where('id_scostproj',$parent_id)
										->get('db_ssubbgtproj')->result();
					break;					
					}
				$response = array();
				if($sql){
					foreach($sql as $row){
						$response[] = $row;
					}
				}else{
					$response['error'] = 'Data kosong';
				}
				die(json_encode($response));exit;
			}
		}	
		
		
		function cekdata($id,$proj){
			$data = $this->db->select('nilai_scost')
							 ->where('id_scostproj',$id)
							 ->where('id_hbgbtproj',$proj)
							 ->get('db_sbgtproj')->row();
							 
			die(json_encode($data));exit;				 
		}
		
		
		function save(){
			extract(PopulateForm());
			#var_dump(count($bln));exit;
			$a = 1;
			for($i = 0 ; $i < 12; $i++){
				if($a < 10) $a = "0".$a;
				$tgl = date("Y-".$a."-d");
				var_dump($bln[$i]);
				$amount = replace_numeric($bln[$i]);
				$sql = $this->db->query("sp_insertbgtproj ".$amount.",'".$bgtcode."'
				,'".$bgtnm."',".$this->pt.",".$project_id.",'".$tgl."',".$this->divisi."");
				$a++;
				//if($sql) die("sukses");
			}
			die("sukses");
		}
		
		
		function tampildata($month,$thn,$bgt){
			$data = $this->db->select('sum(nilai_bgtproj) as nilai')
							 ->where('kode_bgtproj',$bgt)
							 ->where('month(tgl_bgtproj)',$month)
							 ->where('year(tgl_bgtproj)',$thn)
							 ->get('db_bgtproj_update')->row();
							 
			if($data) $response = $data;
			else $response['error'] = "data kosong";
			die(json_encode($response));exit;				 
		}
		
		function saveadj(){
			extract(PopulateForm());
			$getdate = date("Y-m-d");
			$data = array
			(
				'id_bgtproj' => $bgt,
				'id_bgtproj_obj' => '',
				'tipe_adj' => 'adj',
				'mutasi' => '',
				'amount' => replace_numeric($amount),
				'tgl_bgt_adj' => inggris_date($tgl),
				'input_date' => $getdate
			);
			
			
			$updatedata = array 
			(
				'nilai_bgtproj' => replace_numeric($current)
			);
			
			$this->db->where('kode_bgtproj',$bgt);
			$this->db->where('month(tgl_bgtproj)',$bln);
			$this->db->where('year(tgl_bgtproj)',$thn);
			$this->db->update('db_bgtproj_update',$updatedata);
			$this->db->insert('db_bgtproj_adj',$data);
			
		}
		
		function reclass($id){
			
		$data['row'] = $this->db->select('coa_no,nm_bgtproj,kode_bgtproj,sum(nilai_bgtproj) as totbgt,(select sum(nilai_proposed) from db_trbgtproj where kd_bgtproj = kode_bgtproj) as realisasi')
							->where('coa_no',$id)
							->group_by('coa_no,nm_bgtproj,kode_bgtproj')
							->get('db_bgtproj_update')->row();
							
						
		
			
		$this->load->view('project/updateprojbgt-reclass',$data);
		
		
		}
		
		
		
		function bilcekdta(){
			extract(PopulateForm());
			if(@$bgt1) {$bgt = $bgt1;$proj = $proj1;}
			else {$bgt = $bgt2;$proj = $proj2;}
			$row = $this->db->query("sp_cekbgtproj '".$bgt."','".$proj."'")->row();
			
			#Budget project#
			$bgt = number_format($row->bgt);
			$desc = $row->nm_bgtproj;
			$actual = number_format($row->actual);
			$blc = number_format($row->bgt  - $row->actual);
			#End Budget Project#	
			
			$data = array(
				'totbgt'	=> $bgt,
				'actual'	=> $actual,
				'blc' 		=> $blc
			);
					

		    die(json_encode($data));exit;

			
		}
		
		
		function saverec(){
			extract(PopulateForm());
			$amountrec = replace_numeric($amountrec); 
			$amount1 = replace_numeric($amount1); 
			$amount2 = replace_numeric($amount2); 
			$sql = $this->db->query("SP_UpdateReclass '".$bgt1."','".$bgt2."',
			".$amountrec.",".$amount1.",".$amount2.",".$bln1."
			,".$bln2.",'".$thn1."','".$thn2."'");
			
			
			if($sql) die("sukses");
		}
		
				
		
	
	}

