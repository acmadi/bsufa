<?php
	defined('BASEPATH') or die('Access Denied');
	class graph_cuti extends AdminPage{
		function __construct()
		{
			parent::AdminPage();
			$this->load->plugin('graph');
			$this->load->library('opgraph');
			$this->pageCaption = 'Graph Cuti';
		}

		function index(){
			$data['graph2'] = open_flash_chart_object_str( '450', '250', site_url('graph/graph_cuti/mydata2'), false, base_url());
			$this->parameters['data'] = $data;
			$this->loadTemplate('graph/graph_cuti_view');
		}
	
		
	function mydata2(){
		#$sql = ;
		$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10"
		,"bgt11","bgt12");
		for($i = 1 ; $i <= 12 ; $i++)
		{

			$data_1[] = rand(2,10);
			$data_2[] = rand(2,11);
		}
		
		$this->opgraph->title('Cuti Istimewa dan Tahunan', '{font-size: 25px; color: #FFB900}');	
		
		
		$this->opgraph->set_data($data_2);	
		$this->opgraph->bar_3d( 75, '#3334AD', 'Istimewa', 10 );		
		
		
		$this->opgraph->set_data($data_1);	
		$this->opgraph->bar_3d(75, '#D54C78', 'Tahunan', 10 );		

		
		$this->opgraph->set_x_labels(array('January','February','March','April'
		,'Mei','Juni','Juli','Agustus','September','Oktober','November','December') );
		$this->opgraph->set_x_label_style( 14, '#000000', 2 );
		$this->opgraph->set_x_legend('In 000.000', 12, '#000000');

		$this->opgraph->set_y_min(1);
		$this->opgraph->set_y_max(12);

		$this->opgraph->y_label_steps( 2 );
		$this->opgraph->set_y_label_style( 14, '#000000' );
		$this->opgraph->set_y_legend('Totals', 12, '#000000' );

		$this->opgraph->x_axis_colour( '#D0D0D0', '#808080' );
		$this->opgraph->y_axis_colour( '#D0D0D0', '#808080' );

		echo $this->opgraph->render();		
		
	}
	
	
	
	
	}

