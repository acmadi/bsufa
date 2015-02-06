<?php
	class adjustment_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_glheader','gl_id');	
			//$this->set_join('db_gldetail b','b.voucher = a.voucher','left');
					
		}		
		
		function before_fetch(){
		
		$session = $this->UserLogin->isLogin();
		$pt = $session['id_pt'];
		// $kodeprojek = $this->db->query("select subproject_id from db_subproject where id_pt = ".$pt."")->result();
		// foreach($kodeprojek as $row){
				// $project[] = $row->subproject_id;
		// }
		
		// if ($pt==66){
		// $this->db->select("gl_id,voucher, trans_date,[desc],convert(varchar,CONVERT(money, debit),1) as debit, convert(varchar,CONVERT(money, credit),1) as credit, status");
		// $this->db->where('module','AJ');
		// $this->db->where('project_cd','61011');
		// $this->db->where_not_in('status','8');
		
		
		// }else{
		
		
		//$this->db->select("gl_id,voucher, convert(varchar(12), trans_date, 110) as trans_date,[desc],convert(varchar,CONVERT(money, debit),1) as debit, convert(varchar,CONVERT(money, credit),1) as credit, status");
		$this->db->select("gl_id,voucher, trans_date,[desc],convert(varchar,CONVERT(money, debit),1) as debit, convert(varchar,CONVERT(money, credit),1) as credit, status");
		$this->db->where('module','AJ');
		//$this->db->where_in('project_cd',$project);
		$this->db->where_not_in('status','8');
		//parent::before_fetch();
		//}
		
		parent::before_fetch();	
	}
	}
?>
