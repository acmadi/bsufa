<?php
Class graphact extends Controller{
	
	function __construct()
	{
		parent::controller();
		$this->load->library('id_chart/id_chart');
		$this->load->Model('mstbudgetdiv_model','master');
	}	

	function index(){
		$data['graphdata'] = $this->id_chart->chart_embed('graphdata',900,250,site_url('graph/graph_budget/my_data'));
		$this->load->view('graph/graphbudget_view',$data);
	}
	
		function my_data(){
			$data  = $this->master->graphdivisi();
			foreach($data as $row){
				$nil = $row->jumlah;
				$dt[] = array('label'=>$row->group_name,'value'=>$nil);
			}
			echo $this->id_chart->set_chart('pie')
							->set_data($dt)
							->render();	
		}
		
}
