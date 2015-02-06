<?php
	class mstbgtcurrent extends DBController{
		
		function __construct(){
			// deskripsikan model yg dipakai
			parent::__construct('mstbgtcurrent_model');
			$this->set_page_title('Current Operation Budget');
			$this->default_limit = 15;
			$this->template_dir = 'accounting/mstbgt';
			$this->load->model('mstbank_model','bank');
		}
		
		protected function setup_form($data=false){
			$this->parameters['coa'] = $this->bank->list_coa();
			$this->parameters['divisi'] = $this->bank->divisi();	
			$this->parameters['cash'] = $this->mstmodel->get_list('cashflow');		
		}
		
		function index(){
			$this->set_grid_column('id_mst','ID',array('hidden'=>true));
			$this->set_grid_column('code','Code',array('hidden'=>true,'width'=>180,'align'=>'center'));
			$this->set_grid_column('descbgt','Description',array('width'=>700,'align'=>'left'));
			$this->set_grid_column('bgt1','Jan',array('width'=>350,'align'=>'right','size'=>'8','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt2','Feb',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt3','Mar',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt4','Apr',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt5','Mei',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt6','Jun',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt7','Jul',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt8','Ags',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt9','Sep',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt10','Okt',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt11','Nop',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('bgt12','Des',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_grid_column('tot_mst','Total',array('width'=>350,'align'=>'right','formatter' => 'numberFormat'));
			$this->set_jqgrid_options(array('width'=>2000,'height'=>300,'caption'=>'Current Operation Budget','rownumbers'=>true));
			parent::index();
		}
		
		function save_bgt(){
			extract(PopulateForm());
			$data = array
			(
				'code'=>$code,
				'descbgt'=>$descbgt,
				'thn'=>$thn,
				'cash'=>$cash,
				'acc'=>$coa,
				'bgt1'=>str_replace(",","",$bgt1),
				'bgt2'=>str_replace(",","",$bgt2),
				'bgt3'=>str_replace(",","",$bgt3),
				'bgt4'=>str_replace(",","",$bgt4),
				'bgt5'=>str_replace(",","",$bgt5),
				'bgt6'=>str_replace(",","",$bgt6),
				'bgt7'=>str_replace(",","",$bgt7),
				'bgt8'=>str_replace(",","",$bgt8),
				'bgt9'=>str_replace(",","",$bgt9),
				'bgt10'=>str_replace(",","",$bgt10),
				'bgt11'=>str_replace(",","",$bgt11),
				'bgt12'=>str_replace(",","",$bgt12),
				'tot_mst'=>str_replace(",","",$tot_mst)
			);
		if($id_mst=="")
			$this->db->insert('db_mstbgt',$data);	
		else
		    $this->db->where('id_mst',$id_mst);
			$this->db->update('db_mstbgt',$data);
	     redirect('mstbgt');
		}
	
	}
?>
