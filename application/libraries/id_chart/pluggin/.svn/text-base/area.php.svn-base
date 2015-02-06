<?php

class area_chart extends ID_Base_Chart 
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
				
		
		$d = new hollow_dot();
		$d->size(2)->halo_size(1)->colour("#000000");
		//$d->set_fill_colour('#000000'); 
		
		$area = new area();

		$area->set_default_dot_style($d);
		$area->set_key($this->yLabels, 11);
		$area->set_width(2);
		$area->set_colour($color);
		
		$area->set_colour( '#838A96' );
		$area->set_fill_colour( '#C1E4ED' );
		$area->set_fill_alpha( 0.4 );
			
		$yValues = $this->yValues;
		$areaValues = array();
		$i=0;
		foreach($this->xLabels as $label) 
		{
			$value = $this->yValues[$i];
			$areaValue = new hollow_dot($value);
				
			
			$areaValue->tooltip("$label <br> $value ");
			
			$areaValues[] = $areaValue;
			$i++;
		}
		if ($this->vertical)
			$this->x_labels->set_vertical();
		$area->set_values( $areaValues );
		$this->chart->add_element($area);
		
		
	
		
	}
}
