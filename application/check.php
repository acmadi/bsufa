<?
	$field = $_GET['fieldId']; // kiriman dari plugin Validation Engine yang berisi nama form yang ingin di cek
	$value = $_GET['fieldValue']; // kiriman dari plugin Validation Engine yang berisi nilai form 
	
	require_once 'connect.php';
	$query = "SELECT * FROM mahasiswa WHERE $field = '$value'";
	$ditemukan = mysql_num_rows(mysql_query($query)) > 0;
	
	$result  = array($field,!$ditemukan);
	echo json_encode($result);
?>
