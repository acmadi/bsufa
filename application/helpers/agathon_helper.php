<?
	defined('BASEPATH') or die('Access Denied');
	
	function loadCatagory($data,$parent,$level,$parent_id,$fieldID='id_catagory',$fieldName='catagory_name'){
	  if(isset($data[$parent])){ // jika ada anak dari menu maka tampilkan
		$str = ''; 
		foreach($data[$parent] as $value){
		  $child = loadCatagory($data,$value->$fieldID,$level+1,$parent_id,$fieldID,$fieldName); 
		  $str .= '<option value='.$value->$fieldID;
		  if($parent_id == $value->$fieldID) $str .= ' selected';
		  $str .= '> '.str_repeat('--',$level).' '.$value->$fieldName.'</option>';
		  if($child) $str .= $child;
		}
		//$str .= '</ul>';
		return $str;
	  }else return false;
	}
	
	function previewContent($content,$defaultChar=150){
		return character_limiter(strip_tags($content),$defaultChar);
	}
	
	function minimizeTime($time){
		return date('H:i',strtotime($time));
	}
	
	function formatCurr($number){
	    return number_format($number,2,",",".");	 
	}
	
	function headerDate(){
		$arrDay = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
		$arrMonth = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		return $arrDay[date('w')] . ', ' . date('d') . ' ' . $arrMonth[date('n')] . ' ' . date('Y');
	}
	
	function loadBanner($banner,$maxWidth){
		if($banner){
			$path = 'assets/media/banner/';
			foreach($banner as $ban){
				$file = $path.$ban->banner_location;
				if(is_file($file)){
					$fullPath = base_url() . $file;
					$ext = pathinfo($file, PATHINFO_EXTENSION);					
					list($width,$height) = getimagesize($file);
					if($width > $maxWidth) $width = $maxWidth;
					echo '<div style="margin-top: 10px; text-align: center">';
					if($ext == 'swf'){
						?>
						  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="<?=$maxWidth?>" height="<?=$height?>">
							<param name="movie" value="<?=$fullPath?>">
							<param name="quality" value="high">
							<embed src="<?=$fullPath?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?=$width?>" height="<?=$height?>">
						  </object>
						<?
					}else{
						echo anchor($ban->banner_url,img(array('src'=>$fullPath,'width'=>$width,'border'=>0)));
					}
					echo '</div>';
				}
			}
		}
	}
?>
