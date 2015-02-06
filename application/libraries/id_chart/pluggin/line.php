<?php

class line_chart extends ID_Base_Chart 
{
	protected $hidden_label=false;
	protected $vertical=false;
	public function set_rotate($d)
	{
		$this->rotate = $d;
	}
		
	function set_vertical()
	{
		$this->vertical= true;

	}
	public function set_default_properties()
	{
		parent::set_default_properties();

		if (!$this->selected_color)
			$color = $this->colors[0];
		else
			$color = $this->selected_color;
			
			
		$labelName = $this->yLabels;
	
		$d = new hollow_dot();
		$d->size(3)->halo_size(0)->colour($color); 
		
		$line = new line();

		$line->set_default_dot_style($d);
		$line->set_key($labelName, 11);
		$line->set_width( 1 );
		#$line->set_rotate( 20 );
		$line->set_colour( $color );
		
		$line->set_colour( '#838A96' );
		#$line->set_fill_colour( '#3B5AA9' );
		#$line->set_fill_alpha( 0.4 );
		$yValues = $this->yValues;
		$lineValues = array();
		$j=0;
		foreach($this->xLabels as $label) {
			$value = (float)$yValues[$j];
			$lineValue = new hollow_dot($value);
				
			//$unit = $this->yUnit;
		//	$labelName = $this->yLabels[$j];
			
			$lineValue->tooltip("$label<br>$value ");
			
			$lineValues[] = $lineValue;
			$j++;
		}
		if ($this->vertical)
			$this->x_labels->set_vertical();
	
		$line->set_values( $lineValues );
		$lines[] = $line;
		$this->chart->add_element($line);
	
		
		if($this->yUnit == '%' 
			&& $this->maxValue > 90)
		{
			$this->y->set_range( 0, 100, 50);
		}
	}
}
