<?php
class trans_appbudget extends DBController{
	private $divisi;
	function __construct(){
		parent::__construct('trans_budget_model');
		$this->set_page_title('Proposed Budget');
		$this->template_dir = 'accounting/trans_appbudget';
		//$session_id = $this->UserLogin->isLogin();
		//$this->user = $session_id['username'];
	}


	function get_json(){
		$this->set_custom_function('tanggal','indo_date');
		$this->set_custom_function('apptanggal','indo_date');
		$this->set_custom_function('appamount','currency');
		#$this->set_custom_function('realtanggal','indo_date');
		parent::get_json();
	}

	protected function setup_form($data=false){
		#give parameter
		$session_id = $this->UserLogin->isLogin();
		$divisi = $session_id['divisi_id'];	
		$pt = $session_id['id_pt'];	
		$coa = "";
		$id = @$data->code_id;
		$this->parameters['kd'] = $this->mstmodel->getmstbudget2(@$data->code_id);
		$this->parameters['cash'] = $this->mstmodel->get_list('cashflow');
		$this->parameters['coa'] = $this->mstmodel->get_list('coa_tra');	
		$this->parameters['kodecoa'] = $this->mstmodel->get_coa($coa);
		$this->parameters['kodebgt'] = $this->mstmodel->getbudget($id,$divisi,$pt);
		
	}
	
	
	function index(){
		$this->set_grid_column('id_trbgt','ID',array('hidden'=>true));
		$this->set_grid_column('form_kode','Batch.No',array('width'=>50,'align'=>'center','formatter' => 'cellColumn'));
		$this->set_grid_column('tanggal','Date',array('width'=>30,'align'=>'center','formatter' => 'cellColumn'));
		//$this->set_grid_column('description','Budget Name',array('width'=>100,'formatter' => 'cellColumn'));
		$this->set_grid_column('code_id','Code Budget',array('width'=>35,'align'=>'center','formatter' => 'cellColumn'));
		$this->set_grid_column('remark','Remark',array('width'=>100,'formatter' => 'cellColumn'));
		$this->set_grid_column('amount','Propose Amount',array('width'=>50,'align'=>'right','formatter' => 'numberFormat'));
		$this->set_grid_column('appamount','Approval Amount',array('width'=>50,'align'=>'right','formatter' => 'cellColumn'));
		$this->set_grid_column('flag_id','Flag',array('width'=>50,'hidden'=>true,'formatter' => 'cellColumn'));
		$this->set_jqgrid_options(array('width'=>1200,'height'=>350,'caption'=>'Proposed Operation Budget','rownumbers'=>True,'sortname'=>'id_trbgt','sortorder'=>'desc'));
		parent::index();
	}
	
		function data($id){
			$data = $this->mstmodel->getbgtdetail($id);
			echo json_encode($data);			
		}
		
		function deletedata($id){
			$row = $this->db->where('id_trbgt',$id)
					       ->get('db_trbgtdiv')->row();
			$cekflag = $row->flag_id;
			//var_dump($cekflag);exit;
			if($cekflag == 0){
				parent::deletedata($id);
			}else{
				echo "Approve tidak bisa di hapus";
			}
			//var_dump($id);exit;
		}
		
		function appsatuju(){
			
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$divisi_id = $session_id['divisi_id'];
			$pt = $session_id['id_pt'];
			
			$appamount 	= $this->input->post('appamount');
			$remark		= $this->input->post('remark');
			$apptanggal	= $this->input->post('apptanggal');
			$coa		= $this->input->post('coa');
			$cf			= $this->input->post('cf');
			$id			= $this->input->post('id');
			
			$data = array
			(
				'appamount' => $appamount,
				'appremark' => $remark,
				'apptanggal' => $apptanggal,
				'coa'=> $coa,
				'cf' => $cf,
				'flag_id'=> 2
			);
			$this->db->where('id_trbgt',$id);
			$this->db->update('db_trbgtdiv',$data);
			redirect('trans_appbudget');
		}
		
		function printmon($id){
			#die($id);
			$data['data'] = $this->db->where('id_trbgt',$id)
								   ->get('db_trbgtdiv ')
								   ->row();
			$data['idno'] = $id;
			$this->load->view('accounting/print/print_budgetmon',$data);
		}
		
		
		
		/*function bgt_balance($bln,$thn,$kode){
			$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10","bgt11","bgt12");
			$month = date( 'F', mktime(0, 0, 0, $bln));
			#session
			$session_id = $this->UserLogin->isLogin();
			$divisi = $session_id['divisi_id'];
			$level_id = $session_id['level_id'];
			//$divisi = $divisi_id;
			//if($level_id == 1) $divisi = $divisi;
			//else $divisi = $divisi_id;
			#get budget
			$datv = $this->mstmodel->getmstbudget($kode);
			$annu_tot = $datv->tot_mst;

			
			#Balance  Budget Annual
			$tot1 = $this->mstmodel->total_annual($kode,$thn);
			$tot2 = $this->mstmodel->act_annual($kode,$divisi,$thn);
			$totmst = $tot1['tot_mst'];
			$actmst = $tot2['jml'];
			$amount = $totmst - $actmst;//balance annual budget
			
			#Balance Budget Annual Perdivisi
			$dtdiv = $this->mstmodel->total_annualdiv($divisi,$thn);
			$dtactdiv = $this->mstmodel->act_annualdiv($divisi,$thn);
			$totdiv = $dtdiv->jml;
			$actdiv = $dtactdiv ->jml;
			$blcdiv =  $totdiv - $actdiv;
			
			#Balance Budget Annual Alldivisi
			$dtalldiv = $this->mstmodel->total_annualalldiv($thn);
			$dtactalldiv = $this->mstmodel->act_annualalldiv($thn);
			$totalldiv = $dtalldiv->jml;
			$actalldiv = $dtactalldiv ->jml;
			$blcalldiv =  $totalldiv - $actalldiv;
			


			#Balance Budget Month
			$id = str_replace("0","",$bln);
			$jbln = $arr[$id];
			$tot3 = $this->mstmodel->total_month($kode,$jbln,$thn);
			$tot4 = $this->mstmodel->act_month($kode,$month,$thn);
			$totmnth = $tot3['jml'];
			$actmnth = $tot4['jml'];
			$blcmnth = $totmnth - $actmnth;

			#Balance Budget Month perdivisi
			$tot3div = $this->mstmodel->total_monthdiv($divisi,$jbln,$thn);
			$tot4div = $this->mstmodel->act_monthdiv($divisi,$month,$thn);
			$totmnthdiv = $tot3div['jml'];
			$actmnthdiv = $tot4div['jml'];
			$blcmnthdiv = $totmnthdiv - $actmnthdiv;

			#Balance Budget Month Alldivisi
			$tot3alldiv = $this->mstmodel->total_monthalldiv($jbln,$thn);
			$tot4alldiv = $this->mstmodel->act_monthalldiv($month,$thn);
			$totmnthalldiv = $tot3alldiv['jml'];
			$actmnthalldiv = $tot4alldiv['jml'];
			$blcmnthalldiv = $totmnthalldiv - $actmnthalldiv;


			
			#Balance Budget YTD
			$totytd = 0;
			for($i=1;$i<=$bln;$i++){
				$n = $arr[$i];
				$tot5 = $this->mstmodel->total_ytd($n,$kode,$thn);
				$hsl = $tot5['jml'];
				$totytd = $totytd + $hsl;
			}			
			$tot6 = $this->mstmodel->act_ytd($kode,$thn);
			$totytd = $totytd;
			$actytd = $tot6['jml'];
			$blcytd = $totytd - $actytd;

			#Balance Budget perdivisi
			$totytddiv = 0;
			for($i=1;$i<=$bln;$i++){
				$n = $arr[$i];
				$tot5div = $this->mstmodel->total_ytddiv($n,$divisi,$thn);
				$hsldiv = $tot5div['jml'];
				$totytddiv = $totytddiv + $hsldiv;
			}			
			$tot6div = $this->mstmodel->act_ytddiv($divisi,$thn);
			$totytddiv = $totytddiv;
			$actytddiv = $tot6div['jml'];
			$blcytddiv = $totytddiv - $actytddiv;

			#Balance Budget Alldivisi
			$totytdalldiv = 0;
			for($i=1;$i<=$bln;$i++){
				$n = $arr[$i];
				$tot5alldiv = $this->mstmodel->total_ytdalldiv($n,$thn);
				$hslalldiv = $tot5alldiv['jml'];
				$totytdalldiv = $totytdalldiv + $hslalldiv;
			}			
			$tot6alldiv = $this->mstmodel->act_ytdalldiv($thn);
			$totytdalldiv = $totytdalldiv;
			$actytdalldiv = $tot6alldiv['jml'];
			$blcytdalldiv = $totytdalldiv - $actytdalldiv;
			
			#realisasi amount kode
			$realisasi = $this->mstmodel->realact_annual($kode,$bln,$thn);
			$realisasi = $realisasi['jml'];
			
			$blcdata = array
			(
				'annu_tot'=>number_format($annu_tot),
				'totdiv'=>number_format($totdiv),	
				'blcdiv'=>number_format($blcdiv),
				'totalldiv'=>number_format($totalldiv),		
				'blcalldiv'=>number_format($blcalldiv),
				'blc_ann'=> number_format($amount),
				'blc_month'=> number_format($blcmnth),
				'bgtmnth'=>number_format($totmnth),
				'totmnthdiv'=>number_format($totmnthdiv),
				'blcmnthdiv'=>number_format($blcmnthdiv),
				'totmnthalldiv'=>number_format($totmnthalldiv),
				'blcmnthalldiv'=>number_format($blcmnthalldiv),
				'blc_ytd'=> number_format($blcytd),
				'bgtytd'=>number_format($totytd),
				'totytddiv'=>number_format($totytddiv),
				'blcytddiv'=>number_format($blcytddiv),
				'totytdalldiv'=>number_format($totytdalldiv),
				'blcytdalldiv'=>number_format($blcytdalldiv),
				'actmst'=>number_format($actmst),
				'actytd'=>number_format($actytd),
				'actdivytd'=>number_format($actytddiv),
				'actalldivytd'=>number_format($actytdalldiv),
				'actmonth'=>number_format($actmnth),
				'actdivmonth'=>number_format($actmnthdiv),
				'actalldivmonth'=>number_format($actmnthalldiv),
				'actann' => number_format($actmst),
				'actdivann' => number_format($actdiv),
				'actdivallann' => number_format($actalldiv),
				'realisasi' => number_format($realisasi)
			);			
			echo json_encode($blcdata);
		}
		
		function save(){
			extract(PopulateForm());
			$session_id = $this->UserLogin->isLogin();
			$divisi_id = $session_id['divisi_id'];
			$pt = $session_id['id_pt'];
			list($d,$m,$y) = split("-",$tgl_aju);
			$tanggal = $y."-".$m."-".$d;
			$serverdate = date("d-m-Y H:i:s");
			$data = array
			(
				'code_id' => $code,
				'amount' => str_replace(',',"",$amount),
				'blc_month' => str_replace(',',"",$blc_month),
				'blc_ytd' => str_replace(',',"",$blc_ytd),
				'blc_ann' => str_replace(',',"",$blc_ann),
				'blc_divmonth' => str_replace(',',"",$blc_divmonth),
				'blc_divytd' => str_replace(',',"",$blc_divytd),
				'blc_divann' => str_replace(',',"",$blc_divann),
				'blc_divallmonth' => str_replace(',',"",$blc_divallmonth),
				'blc_divallytd' => str_replace(',',"",$blc_divallytd),
				'blc_divallann' => str_replace(',',"",$blc_divallann),
				'divisi_id' => $divisi_id,
				'remark' => $remark,
				'flag_id'=> 0,
				'id_pt' => $pt,
				'tanggal' => $tanggal,
				'coa'  => $datv->coa,
				'cf'  => $datv->cf
			);
			
			if($id=="") {
				$this->db->insert("db_trbgtdiv",$data);
			}else{
				if($approve == "Approve") {
					$data1 = array(
						'amount' => str_replace(',',"",$amount),
						'blc_month' => str_replace(',',"",$blc_month),
						'blc_ytd' => str_replace(',',"",$blc_ytd),
						'blc_ann' => str_replace(',',"",$blc_ann),
						'blc_divmonth' => str_replace(',',"",$blc_divmonth),
						'blc_divytd' => str_replace(',',"",$blc_divytd),
						'blc_divann' => str_replace(',',"",$blc_divann),
						'blc_divallmonth' => str_replace(',',"",$blc_divallmonth),
						'blc_divallytd' => str_replace(',',"",$blc_divallytd),
						'blc_divallann' => str_replace(',',"",$blc_divallann),
						'remark' => $remark,
						'flag_id'=> 1,
						'id_pt' => $pt,
						'tanggal' => $tanggal
						);
					$data2 = array('flag_id'=>1,'tanggal'=>$serverdate,'alasan'=>$alasan,'trbgt_id'=>$id);
				}else{
					$data1 = array(
						'amount' => str_replace(',',"",$amount),
						'blc_month' => str_replace(',',"",$blc_month),
						'blc_ytd' => str_replace(',',"",$blc_ytd),
						'blc_ann' => str_replace(',',"",$blc_ann),
						'blc_divmonth' => str_replace(',',"",$blc_divmonth),
						'blc_divytd' => str_replace(',',"",$blc_divytd),
						'blc_divann' => str_replace(',',"",$blc_divann),
						'blc_divallmonth' => str_replace(',',"",$blc_divallmonth),
						'blc_divallytd' => str_replace(',',"",$blc_divallytd),
						'blc_divallann' => str_replace(',',"",$blc_divallann),
						'remark' => $remark,
						'flag_id'=> 2,
						'id_pt' => $pt,
						'tanggal' => $tanggal
						);
					$data2 = array('flag_id'=>2,'tanggal'=>$serverdate,'alasan'=>$alasan,'trbgt_id'=>$id);
				 }
				$this->db->where('id_trbgt',$id)
                         ->update("db_trbgtdiv",$data1);
                         
                $this->db->insert('db_approve',$data2);
                
			    
			}
	        redirect("trans_budget");
		}*/
		
	
}
