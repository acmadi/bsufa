<?php
defined('BASEPATH') or die('Access Denied');	
class viewjurnal_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_glheader a','a.gl_id');
		
			 $this->set_join('project b','a.project_cd = b.kd_project');
	}
	
	 function before_fetch(){
	 
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			$kodeprojek = $this->db->query("select subproject_id from db_subproject where id_pt = ".$pt."")->result();
			foreach($kodeprojek as $row){
				$project[] = $row->subproject_id;
			}
	 
	 
		 // $this->db->select('a.gl_id, b.trans_date,a.module,a.voucher,b.acc_no,b.line_desc,b.debit,b.credit, a.status')
							// ->where_not_in('a.module','AJ') ;
		$this->db->select('b.nm_project as nm_subproject,a.gl_id, convert(varchar(12), trans_date, 105) as trans_date,a.module,a.voucher,a.[desc],convert(varchar,CONVERT(money, debit),1) as debit, convert(varchar,CONVERT(money, credit),1) as credit, a.status')
							->where_not_in('a.module','AJ') 
							->where('a.status',0)
							->where('b.pt_project',$pt);
							//->or_where('a.project_cd','-');
//$this->db->select("gl_id,voucher, convert(varchar(12), trans_date, 110) as trans_date,[desc],convert(varchar,CONVERT(money, debit),1) as debit, convert(varchar,CONVERT(money, credit),1) as credit, status");
							
		 parent::before_fetch();	

	 }	

}

            

           

            
