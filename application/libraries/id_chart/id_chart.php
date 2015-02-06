<?php
require_once APPPATH . 'libraries/id_chart/id_base_chart.php';
require_once APPPATH . 'libraries/id_chart/php-ofc-library/open-flash-chart.php';
define('SWF_FILE','assets/open-flash-chart.swf');

class id_chart
{
	protected $chart = null;
	protected $show_label = true;
	protected $ofc_path="";
	function __construct($param=array())
	{
		if (isset($param['type']))
			$this->setChart($param['type']);
		$this->ofc_path = base_url();
	}
	
	public function set_chart($type='line')
	{
		$file = APPPATH . 'libraries/id_chart/pluggin/'.$type.'.php';
		if (file_exists($file))
		{
			require_once $file;
			$class_name = $type . '_chart';
			$this->chart = new $class_name();
		}
		else
		{
			
		}
		return $this;
	}
	
	public function set_title($title,$css="")
	{
		$this->chart->set_title($title,$css);
		return $this;
	}
	public function set_vertical()
	{
		$this->chart->set_vertical();
		return $this;
	}
	public function set_data($data)
	{
		if (!$data) return;
		foreach ($data as $value)
		{
			
			$label[] 	=$value['label'];
			$val[] 		=$value['value'];
		}
		if ($this->show_label)
		{
			$this->chart->set_axis_x_labels($label);
		}
		else
		{
			foreach($label as $valx)
				$empty_label[] =" ";
			$this->chart->hidden_label = $label;
			$this->chart->set_axis_x_labels($empty_label);
		}
		$this->chart->set_axis_y_values($val);
		return $this;
	}
	
	function render()
	{
		$this->chart->set_default_properties();
		return $this->chart->render();
	}
	
	public function chart_embed($name, $width, $height, $url, $base=false )
	{
		$base = $base ? $base : base_url();
		$out = array();
		 $use_swfobject=true;
		if (isset ($_SERVER['HTTPS']))
		{
			if (strtoupper ($_SERVER['HTTPS']) == 'ON')
			{
				$protocol = 'https';
			}
			else
			{
				$protocol = 'http';
			}
		}
		else
		{
			$protocol = 'http';
		}
		
		$obj_id = 'chart';
		$div_name = $name;
		
		
		#$base = base_url();
		if( $use_swfobject )
		{
			// Using library for auto-enabling Flash object on IE, disabled-Javascript proof  
			$out[] = '<div id="'. $div_name .'"></div>';
			$out[] = '<script type="text/javascript">';
			$out[] = 'var so = new SWFObject("'. $base . SWF_FILE . '", "'. $obj_id.'_'.$name .'", "'. $width . '", "' . $height . '", "9", "#FFFFFF");';
			
			$out[] = 'so.addVariable("data-file", "'. $url . '");';
		
			$out[] = 'so.addParam("allowScriptAccess", "always" );so.addParam("wmode", "transparent");';
			$out[] = 'so.write("'. $div_name .'");';
			$out[] = '</script>';
			$out[] = '<noscript>';
		}

		$out[] = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="' . $protocol . '://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" ';
		$out[] = 'width="' . $width . '" height="' . $height . '" id="ie_'. $obj_id .'" align="middle">';
		$out[] = '<param name="allowScriptAccess" value="sameDomain" />';
		$out[] = '<param name="movie" value="'. $base . SWF_FILE . '?data='. $url .'" />';
		$out[] = '<param name="quality" value="high" />';
		$out[] = '<param name="bgcolor" value="#FFFFFF" />';
		$out[] = '<embed src="'. $base . SWF_FILE . '?data=' . $url .'" quality="high" bgcolor="#FFFFFF" width="'. $width .'" height="'. $height .'" name="'. $obj_id .'" align="middle" allowScriptAccess="sameDomain" ';
		$out[] = 'type="application/x-shockwave-flash" pluginspage="' . $protocol . '://www.macromedia.com/go/getflashplayer" id="'. $obj_id .'"/>';
		$out[] = '</object>';

		if ( $use_swfobject ) {
			$out[] = '</noscript>';
		}
		
		return implode("\n",$out);
	}
	
}


