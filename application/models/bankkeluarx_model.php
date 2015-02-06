<?php
	class bankkeluarx_model extends DBModel{
		
		function __construct(){ 
			parent::__construct('db_cashplan a','a.id_plan');	
			//parent::__construct('db_apinvoice a','a.apinvoice_id');	
			$this->set_join('db_apinvoice b','b.apinvoice_id = a.id_ap');
			//$this->set_join('db_apledger c','c.doc_no = a.doc_no');
			$this->set_join('pemasokmaster c','c.kd_supplier = b.vendor_acct');
			//$this->set_join('db_cashplan d','d.id_ap = a.apinvoice_id');
			$this->set_join('db_cashheader e','e.apinvoice_id = b.apinvoice_id');
			//$this->set_join('db_cashheader e','e.id_cash = a.id_cash','left');
			/*$this->set_join('db_apinvoice b','b.apinvoice_id = a.id_ap','left');
			$this->set_join('db_apledger c','c.ref_no = b.apinvoice_id', 'left');
			$this->set_join('db_bank d','d.bank_id = e.bankacc','left');
			$this->set_join('db_coa f','d.bank_coa = f.acc_no','left');*/
			//$this->set_join('pemasokmaster h','h.kd_supplier = b.vendor_acct','left');
			//$this->set_join('db_cashplan e','e.id_ap = b.apinvoice_id','left');
			
					
		}	

	
		function before_fetch(){
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			$kodeprojek = $this->db->query("select subproject_id from db_subproject where id_pt = ".$pt."")->result();
			foreach($kodeprojek as $row){
				$project[] = $row->subproject_id;
			}
			$status = array('2','3');
			$this->db->select('a.id_plan as id_plan,b.descs,b.doc_no,c.nm_supplier,e.voucher,e.no_arsip,e.amount,e.amt_balance,e.slipno,e.slip_date,e.payment_date,e.status');
			$this->db->where_in('b.status',$status);
			$this->db->where_in('b.project_no',$project);
			/*$this->db->select("a.id_plan,a.id_cash,isnull(voucher,'-') as voucher, isnull(convert(varchar(12), trans_date, 105),'-') as trans_date, 
			e.status, slipno, isnull(convert(varchar(12), slip_date, 105),'-') as slip_date, isnull(convert(varchar(12), payment_date, 105),'-') as payment_date, 
			e.descs, paidby, h.nm_supplier as nm_supplier,h.npwp as npwp, b.doc_no, convert(varchar, CONVERT(money, mbase_amt), 1) as mbase_amt, 
			convert(varchar, CONVERT(money, malloc_amt), 1) as malloc_amt, convert(varchar, CONVERT(money, mbal_amt), 1) as mbal_amt, f.acc_name, 
			isnull(convert(varchar, CONVERT(money, amount), 1),'-') as amount");
			$this->db->where_in('b.status',$status);*/
			parent::before_fetch();
		}
		
		/*function before_fetch(){
			$session = $this->UserLogin->isLogin();
			$pt = $session['id_pt'];
			$kodeprojek = $this->db->query("select subproject_id from db_subproject where id_pt = ".$pt."")->result();
			foreach($kodeprojek as $row){
				$project[] = $row->subproject_id;
			}

			
			
			$status = array('2','3');
			$this->db->select("a.id_plan,a.id_cash,isnull(voucher,'-') as voucher, isnull(convert(varchar(12), trans_date, 105),'-') as trans_date, 
			e.status, slipno, isnull(convert(varchar(12), slip_date, 105),'-') as slip_date, isnull(convert(varchar(12), payment_date, 105),'-') as payment_date, 
			e.descs, paidby, b.doc_no, convert(varchar, CONVERT(money, mbase_amt), 1) as mbase_amt, 
			convert(varchar, CONVERT(money, malloc_amt), 1) as malloc_amt, convert(varchar, CONVERT(money, mbal_amt), 1) as mbal_amt, f.acc_name, 
			isnull(convert(varchar, CONVERT(money, amount), 1),'-') as amount");
			$this->db->where_in('b.status',$status);
			$this->db->where_in('b.project_no',$project);
			parent::before_fetch();
		}*/

	}
?>
