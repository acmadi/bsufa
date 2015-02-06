<?
	defined('BASEPATH') or die('Access Denied');
	
	class kartuhutang_call extends AdminPage{

		function tblmstbgt_call()
		{
			parent::AdminPage();
			$this->pageCaption = 'User Page';
		}
		
		function index(){	
			
			$session_id = $this->UserLogin->isLogin();
			$this->user = $session_id['username'];
			$this->pt	= $session_id['id_pt'];
			
			$data['vendor'] = $this->db->select('kd_supp_gb,nm_supplier')
																											->join('db_subproject','kd_project = subproject_id')
																											->where('pt_id',$this->pt)
                                                                                                            ->order_by('kd_supp_gb','ASC')
                                                                                                            ->get('pemasok')
                                                                                                            ->result();	
			$data['project_detail'] = $this->db->select('subproject_id,nm_subproject')
																											->where('id_pt',11)
																											->where('pt_id !=',12)
                                                                                                            ->order_by('subproject_id','ASC')
                                                                                                            ->get('db_subproject')
                                                                                                            ->result();																										

	
			$this->parameters=$data;
			
			$this->loadTemplate('ap/kartuhutang_view',$data);
							
			}
			
		function kartuhutang(){
		
			extract(PopulateForm());
			if(@$klik){
			$this->load->view('ap/print/print_kartuhutang');	
				}else if(@$export){
			$this->load->view('ap/print/print_kartuhutang_excel');		
		}
	}}	
?>
