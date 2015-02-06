<?php
defined('BASEPATH') or die('Access Denied');	
class jurnaltransfer_model extends DBModel{		
	function __construct(){ 
		parent::__construct('db_glheader a','a.gl_id');
		//	 $this->set_join('db_gldetail b','a.voucher = b.voucher');
		$this->set_join('project b','a.project_cd = b.kd_project');
	}
	
	 function before_fetch(){
		 // $this->db->select('a.gl_id, b.trans_date,a.module,a.voucher,b.acc_no,b.line_desc,b.debit,b.credit, a.status')
							// ->where_not_in('a.module','AJ') ;
							
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
		$kodeprojek = $this->db->query("select kd_project from project where pt_project = ".$pt."")->result();
		foreach($kodeprojek as $row){
				$project[] = $row->kd_project;
		}
							
		$status = array('5','1','0');
		$this->db->select('b.nm_project as nm_subproject,a.gl_id, convert(varchar(12), trans_date, 105) as trans_date,a.module,a.voucher,a.[desc],convert(varchar,CONVERT(money, debit),1) as debit, convert(varchar,CONVERT(money, credit),1) as credit, a.status')
							->where_not_in('a.module','IV') 
							->where_in('a.status',$status) 
							->where_in('a.project_cd',$project)
							->where('a.is_show',1);
							
		 parent::before_fetch();	

	 }	

}

            

           

            
