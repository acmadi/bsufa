<?php
	defined('BASEPATH') or die('Access Denied');
	class graph_vs extends AdminPage{
		function __construct()
		{
			parent::AdminPage();
			$this->load->plugin('graph');
			$this->load->library('opgraph');
			$this->load->Model('mstbudgetdiv_model','master');
			$this->pageCaption = 'Graph Budget';
		}

		function index(){
			$data['graph1'] = open_flash_chart_object_str( '450', '250', site_url('graph/graph_vs/mydata1'), false, base_url());
			$data['graph2'] = open_flash_chart_object_str( '450', '250', site_url('graph/graph_vs/mydata2'), false, base_url());
			$this->parameters['data'] = $data;
			$this->loadTemplate('graph/graphvs_view');
		}


	   function mydata1(){
		$data  = $this->master->graphdivisi();
		/*$divisi = array('Opr','Commercial','Finance/MIS',
		'Legal','Marketing/PR','Proc','Acc','Project Control',
		'Business Development');*/
		foreach($data as $row){
			$divisi[] = $row->cd;
			$a = ceil($row->jumlah/1000000000);
			$nil[] = $a;
			#$jml[] = $row->jumlah;
		}
		#var_dump($divisi);
		/*$data = array();
		$val = array('IE','Firefox','Opera','Wii','Other','Tes1','Tes2','Tes3') ;
		for( $i=0; $i<8; $i++ )
		{
			$data[] = rand(5,15);
		}*/
		#var_dump($val);
		$this->opgraph->pie(60,'#505050','{font-size: 12px; color: #404040;');
		$this->opgraph->pie_values($nil, $divisi);
		$this->opgraph->pie_slice_colours(array('#d01f3c','#356aa0','#C79810') );
		$this->opgraph->set_tool_tip( '#val#%' );
		$this->opgraph->title( 'Graph Budget', '{font-size:18px; color: #d01f3c}' );
		echo $this->opgraph->render();		
	}

	
		
	function mydata2(){
		#$sql = ;
		$arr = array("","bgt1","bgt2","bgt3","bgt4","bgt5","bgt6","bgt7","bgt8","bgt9","bgt10"
		,"bgt11","bgt12");
		for($i = 1 ; $i <= 12 ; $i++)
		{
			$bln = "0".$i;
			$row1 = $this->db->select('sum(amount) as jml')
			                 ->where('datename(mm,tanggal)',$bln)
							 ->get('db_trbgtdiv')
							 ->row_array();
			$dt1 = $row1['jml'];
			$num1 = ceil($dt1 / 1000000);
			$data_1[] = (string) $num1;
			#var_dump($data_1);
			

			
			$row2 = $this->db->select('sum('.$arr[$i].') as jml')
			                 ->get('db_mstbgt')
							 ->row_array();
			$dt2 = $row2['jml'];
			$num2 = ceil ($dt2 /1000000);
			$data_2[] =  (string) $num2;
		}
		
		$this->opgraph->title('Budget VS Realization', '{font-size: 25px; color: #FFB900}');	
		
		
		$this->opgraph->set_data($data_2);	
		$this->opgraph->bar_3d( 75, '#3334AD', 'Budget', 10 );		
		
		
		$this->opgraph->set_data($data_1);	
		$this->opgraph->bar_3d(75, '#D54C78', 'Actual', 10 );		

		
		$this->opgraph->set_x_labels(array('January','February','March','April'
		,'Mei','Juni','Juli','Agustus','September','Oktober','November','December') );
		$this->opgraph->set_x_label_style( 14, '#000000', 2 );
		$this->opgraph->set_x_legend('In 000.000', 12, '#000000');

		$this->opgraph->set_y_min(1000);
		$this->opgraph->set_y_max(100000);

		$this->opgraph->y_label_steps( 2 );
		$this->opgraph->set_y_label_style( 14, '#000000' );
		$this->opgraph->set_y_legend('Totals', 12, '#000000' );

		$this->opgraph->x_axis_colour( '#D0D0D0', '#808080' );
		$this->opgraph->y_axis_colour( '#D0D0D0', '#808080' );

		echo $this->opgraph->render();		
		
	}
	
	
	
	
	}
