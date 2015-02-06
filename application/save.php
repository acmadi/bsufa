<?
	isset($_POST) or die('Mohon kirim post');
	
	require_once 'connect.php';
	$nim = $_POST['NIM'];
	$nama = $_POST['nama'];
	$jeniskelamin = $_POST['jeniskelamin'];
	$tgllahir = $_POST['tgllahir'];
	$alamat = $_POST['alamat'];
	$email = $_POST['email'];
	$jumlahsks = $_POST['jumlahsks'];
	$website = $_POST['website'];
	$matakuliah = implode(',',$_POST['matakuliah']);
	$password = md5($_POST['password']);
	
	$sql = "INSERT INTO mahasiswa VALUES(NULL,'$nim','$nama','$jeniskelamin','$tgllahir','$alamat',
			'$email','$jumlahsks','$website','$matakuliah','$password')";
	if(mysql_query($sql)){
		echo "Data berhasil disimpan";
	}else{
		echo "error: ".mysql_error();
	}
