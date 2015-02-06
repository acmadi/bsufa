<?
	defined('BASEPATH') or die('Access Denied');
	
	class reclassbgt_call extends AdminPage{

		function deduct_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'RECLASS BUSGET';
		}
		
		function index($id){
			//~ $data['view'] = $this->db->where('id_reclass',$id)
									//~ ->order_by('id_bgtproj_update')
									//~ ->get('db_bgtproj_update_tempg')->result();
									//~ 
									
			$data['view'] = $this->db->SELECT(' *,
										(select sum(nilai_bgtproj)as nil1 FROM db_bgtproj_update b WHERE kode_bgtproj = a.kode_bgtproj) as nil1,
											(select sum(nilai_approved) FROM db_trbgtproj c WHERE kd_bgtproj = a.kode_bgtproj) as nil2 ')
									->where('id_reclass',$id)
									->order_by('id_bgtproj_update')
									->get('db_bgtproj_update_temp a')->result();
 

			
			//~ $sql1 = $this->db->select('min(id_bgtproj_update) as idtrbgt')
							//~ ->where('id_reclass',$id)
							//~ ->get('db_bgtproj_update_temp')->row(); 
			//~ 
			//~ $sql11 = $this->db->where('id_bgtproj_update',$sql1->idtrbgt)
							  //~ ->get('db_bgtproj_update_temp')->row(); 
							  //~ 
			//~ $sql12 = $this->db->select("sum(nilai_bgtproj)as nil1, (select sum(nilai_approved) 
										//~ FROM  db_trbgtproj WHERE  kd_bgtproj = '".$sql11->kode_bgtproj."') as nil2 ")
							//~ ->where('kode_bgtproj',$sql11->kode_bgtproj)
							//~ ->get('db_bgtproj_updateg')->row();

			#echo $sql12;
			
			
							
			$data['sql1'] = $this->db->select('TOP 1 *')
								->where('id_reclass',$id)	
								->order_by('id_bgtproj_update','asc')
								->get('db_bgtproj_update_temp')->row();
								
		$row = 	$this->db->select('TOP 1 *')
								->where('id_reclass',$id)	
								->order_by('id_bgtproj_update','asc')
								->get('db_bgtproj_update_temp')->row();
		$row->id_subproject;
		
		
		$data['sql2'] = $this->db->select('TOP 1 *')
								->where('id_reclass',$id)	
								->order_by('id_bgtproj_update','desc')
								->get('db_bgtproj_update_temp')->row();
								
			
				
			$this->load->view('approval/project/app_reclass',$data);
		}
	}	
