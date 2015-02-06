<?
	defined('BASEPATH') or die('Access Denied');
	
	function Dump($variable,$is_exit=false){
		echo '<pre>';
		var_dump($variable);
		echo '</pre>';
		if($is_exit) exit;
	}

	function replace_numeric($var){
		return str_replace(",","",$var);
	}	

	function blnbgt($bgt){ // yyyy-mm-dd
		if($bgt=='bgt1') $newbgt      = 'Januari';
		elseif($bgt=='bgt2') $newbgt  = 'Febuari';
		elseif($bgt=='bgt3') $newbgt  = 'Maret';
		elseif($bgt=='bgt4') $newbgt  = 'April';
		elseif($bgt=='bgt5') $newbgt  = 'Mei';
		elseif($bgt=='bgt6') $newbgt  = 'Juni';
		elseif($bgt=='bgt7') $newbgt  = 'Juli';
		elseif($bgt=='bgt8') $newbgt  = 'Agustus';
		elseif($bgt=='bgt9') $newbgt  = 'September';
		elseif($bgt=='bgt10') $newbgt = 'Oktober';
		elseif($bgt=='bgt11') $newbgt = 'November';
		elseif($bgt=='bgt12') $newbgt = 'Desember';		
		return $newbgt;
	}

	function gettgl(){
		$tgl = date("d-m-Y");
		echo $tgl; 
	}

	function statusadj($status){
		if($status=='rec'){ $stat = 'Reclass';}
		elseif($status=='adj') {$stat = 'Adjustment';}
		return $stat;
	}	
	
	function mutasi($mutasi){
		if($mutasi=='D'){ $newmutasi = 'Debit';}
		else {$newmutasi = 'Kredit';}
		return $newmutasi;
	}	

	function currency($amount){
		//$mount = number_format($amount);
		if($amount < 0){
			$mount = 0;
		}else{
			$mount = number_format($amount);
		} 
		return $mount;
	}	
	
	function projectcek($id){
		$CI = &get_instance();
		$row = $CI->db->where('kd_project',$id)
						->get('project')->row();
		$nama = $row->nm_project;
		return $nama;
	}

	function bankcek($id){
		$CI = &get_instance();
		$row = $CI->db->where('bank_id',$id)
						->get('bank')->row();
		$nama = $row->namabank;
		return $nama;
	}
	
	function PopulateForm(){
		$CI = &get_instance();
		$post = array();
		foreach(array_keys($_POST) as $key){
			$post[$key] = $CI->input->post($key);
		}
		return $post;
	}
	
	function now($isFull=false){
		return date($isFull?"Y-m-d H:i:s":"Y-m-d");
	}
	
	function indo_date($date){ // yyyy-mm-dd
		$exp = date('d-m-Y',strtotime($date));		
		return $exp;
	}
	

	function indo_datem($date){ // yyyy-mm-dd
		/*list($y,$m,$d) = split("-",$date);
		$mindo = array("","Januari","Febuari","Maret",
		"April","Mei","Juni","Juli","Agustus","September","
		Oktober","November","Desember");
		$bln = $mindo[$m];*/
		$exp = date('d F Y',strtotime($date));		
		return $exp;
	}
	

	function inggris_date($date){ // yyyy-mm-dd
		$exp = date('Y-m-d',strtotime($date));		
		return $exp;
	}
	
	function getPosts($var){
		$post = array();
		$CI = &get_instance();
		foreach($var as $v){
		  $post[$v] = $CI->input->post($v);
		}
		return $post;
	}
	
	function hr(){
		return "<hr size=0 color=#000066 />";
	}
	
	function script($fileName){
		return "<script language='JavaScript' type='text/javascript' src='".base_url().JS_PATH.$fileName."'></script>";
	}
	
	function segment($index){
		$CI = &get_instance();
		return $CI->uri->segment($index);
	}
	
	function setError($message,$varName='errorMessage'){	
		$CI = &get_instance();
		$CI->session->set_userdata($varName, $message);
	}
	
	function showErrors($varName='errorMessage'){
		$CI = &get_instance();
		if($varName == 'errorMessage')
		 echo validation_errors('<div class="errorMessage">','</div>');
		$err = $CI->session->userdata($varName);
		if($err)	
		 echo '<div class="errorMessage">'.$err.'</div>';
		$CI->session->unset_userdata($varName);
	}
	function createForm($formFormat,$key,$values,$value=false){		
		@list($form,$size,$height) = explode(':',$formFormat);
		$func = "form_".$form;
		//echo $form;
		if($form!='htmleditor') {
		  if(!function_exists($func)) return false;
		}
		$option = array();
		if($form == 'dropdown'){
		 if($values) return $func($key,$values,set_value($key,$value));
		 else return '--options empty--';
		}elseif($form == 'radio'){
		 if($values){
		   $radios = array();
		   foreach($values as $item){
		   	 $arr = array(
		   	 	'name' => $key,
		   	 	'id' => $key.'_'.$item,
		   	 	'value' => $item,
				'style'	=> 'border:0px',
		   	 	'checked' => (set_value($key,$value) == $item)
		   	 );
		   	 $radios[] = form_radio($arr).' '.form_label(strtoupper($item),$arr['id']);
		   }
		   return implode(' &nbsp ',$radios);
		 }else return '--options empty--';
		}elseif($form == 'htmleditor'){
		 $CI = &get_instance();
		 //if(!class_exists('FCKeditor')) {
		   $setup = array(
			 'instanceName'=>$key,
			 'BasePath'=>base_url().'application/libraries/fckeditor/',
			 'Width'=>$size,
			 'Height'=>$height,
			 'Value'=>$values
		   );
		   $CI->load->library('fckeditor',$setup);
		 //}
		 return $CI->fckeditor->CreateHtml();
		}else{		 
		 $opts = array(
		 	'name' => $key,
		 	'id' => $key,
		 	'value' => set_value($key,$values) 
		 );
		 if(!empty($size)) {
		 	if($form == 'input') $opts['size'] = $size;
		 	elseif($form == 'textarea') $opts['cols'] = $size;
		 }
		 if(!empty($height) && $form == 'textarea') {
		 	$opts['rows'] = $height;
		 }		 
		 return $func($opts);
		}
	}
	
	function mysqlToDate($date){	
		if(empty($date) || strpos($date,'0000') !== false) return '-';
		return date(strpos($date,' ')?"d/m/Y H:i":"d/m/Y",strtotime($date));
	}

	function dateToMysql($date){	
		if(substr($date,4,1) == '-') return $date;
		if(empty($date)) return NULL;
		@list($_date,$_hour) = explode(' ',$date);
		@list($d,$m,$y) = explode('/',$_date);		
		$return = $y.'-'.$m.'-'.$d;
		if(!empty($_hour)) $return .= ' '.$_hour;
		return $return;
	}
	
	function anchorAdmin($module,$id){
		$str = anchor($module.'edit/'.$id,'Edit');
		$str .= ' | ';
		$str .= anchor($module.'delete/'.$id,'Delete');
		return $str;
	}
	
	function buttonRedirect($label,$location,$center=false){
		$str = "<input type=button class=bd-button value=\"$label\" onClick=\"document.location='".site_url($location)."'\" />";
		if($center) $str = "<div align='center' style='margin-top:6px'>$str</div>";
		return $str;
	}
	
	function is_upload($formName){
		return (isset($_FILES[$formName]) && is_uploaded_file($_FILES[$formName]['tmp_name']));
	}
	
	function makeDecimal($num,$decimal=2){
		return sprintf('%.'.$decimal.'f',$num);
	}

	function loadCalendar(){
		return script('jsCalendar.js').link_tag(CSS_PATH.'calendar.css');
	}
	
	function loadThickbox(){
		return script('thickbox.js').link_tag(CSS_PATH.'thickbox.css');
	}
	
	function selectCalendar($id){
		return "<a href=\"javascript:showCalendar('$id')\"><img src='".base_url().IMAGE_PATH."calendar_icon.gif' border=0 /></a>";
	}
	
	function setInt($num){
		$num = sprintf("%d",$num);
	}
?>
