<?php
	class updateprojbgt_model extends DBModel{
		
		function __construct(){ 
			//parent::__construct('PemasokMaster','kd_supplier');	
			parent::__construct('db_bgtproj_update a','coa_no');
		}
		
		
		function before_fetch(){
			$this->db->select('coa_no,kode_bgtproj,nm_bgtproj,
								(select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no ) as jan12')
				     ->group_by('coa_no,kode_bgtproj,nm_bgtproj');
				    # ->order_by('coa_no','asc');
			parent::before_fetch();
		}
	}



//~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 1 and year(tgl_bgtproj) = 2012) as jan12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 2 and year(tgl_bgtproj) = 2012) as feb12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 3 and year(tgl_bgtproj) = 2012) as mar12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 4 and year(tgl_bgtproj) = 2012) as apr12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 5 and year(tgl_bgtproj) = 2012) as mei12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 6 and year(tgl_bgtproj) = 2012) as jun12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 7 and year(tgl_bgtproj) = 2012) as jul12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 8 and year(tgl_bgtproj) = 2012) as agu12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 9 and year(tgl_bgtproj) = 2012) as sep12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 10 and year(tgl_bgtproj) = 2012) as okt12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 11 and year(tgl_bgtproj) = 2012) as nov12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 12 and year(tgl_bgtproj) = 2012) as des12,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 1 and year(tgl_bgtproj) = 2013) as jan13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 2 and year(tgl_bgtproj) = 2013) as feb13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 3 and year(tgl_bgtproj) = 2013) as mar13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 4 and year(tgl_bgtproj) = 2013) as apr13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 5 and year(tgl_bgtproj) = 2013) as mei13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 6 and year(tgl_bgtproj) = 2013) as jun13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 7 and year(tgl_bgtproj) = 2013) as jul13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 8 and year(tgl_bgtproj) = 2013) as agu13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 9 and year(tgl_bgtproj) = 2013) as sep13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 10 and year(tgl_bgtproj) = 2013) as oktb13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 11 and year(tgl_bgtproj) = 2013) as nov13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 12 and year(tgl_bgtproj) = 2013) as des13,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 1 and year(tgl_bgtproj) = 2014) as jan14,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 2 and year(tgl_bgtproj) = 2014) as feb14,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 3 and year(tgl_bgtproj) = 2014) as mar14,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 4 and year(tgl_bgtproj) = 2014) as apr14,
							   //~ (select isnull(sum(nilai_bgtproj),0) from db_bgtproj_update b where coa_no = a.coa_no and month(tgl_bgtproj) = 5 and year(tgl_bgtproj) = 2014) as mei14						   		   							   							   
