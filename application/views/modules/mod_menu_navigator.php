<?
	if(isset($menu) && $menu){
		
		function loadNavigator($menu,$parent){
			if(isset($menu[$parent])){
			   $class = $parent > 0 ? 'menuChild' : 'menuParent';
			   //$str = '<ul class="'.$class.'" parent="'.$parent.'">';
			   $str = '<ul>';
			   //Dump('sadasd',1);
			   foreach($menu[$parent] as $row){
				 //$str .= '<li>'.($row->menu_url?anchor($row->menu_url,$row->menu_title,array('open'=>$row->id_menu,'style'=>'padding:2px 10px')):'<a href="javascript:;" style="padding:2px 10px" open="'.$row->id_menu.'">'.$row->menu_title.'</a>');			 
				 $str .= '<li>'.($row->menu_url?anchor($row->menu_url,$row->menu_title):'<a href="javascript:;">'.$row->menu_title.'</a>');			 
				 $str .= loadNavigator($menu,$row->id_menu);
				 $str .= '</li>';
			   }
			   $str .= '</ul>';
			   //Dump($str,1);
			   return $str;
			}else return '';
		}
		echo '<div id="menuHome" class="jquerycssmenu_tenismeja">';
		echo loadNavigator($menu,0);
		echo '</div>';
	}
?>
