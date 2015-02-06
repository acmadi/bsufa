


<?php
	
	
	defined('BASEPATH') or die('Access Denied');
	#echo 'tes';
?>
	
	<form  method='post' action='update.php' >
			<table width='30%' align='center'>
			<tr>
				<td colspan='3' bgcolor='gray' align='center' >EDIT DATA MAHASISWA</td>
			</tr>
			<tr>
				<td> NIM</td>
				<td>:</td>
				<td><input type='text' name='id' id='id' value='<?=$tes[0]?>'></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td >:</td>
				<td><input type='text' name='vname' id='vname' value='<?#=$brs[1]?>'></td>
			</tr>
			<tr>
				<td >Alamat</td>
				<td >:</td>
				<td><input type='text' name='valamat' id='valamat' value='<?#=$brs[2]?>'></td>
			</tr>
			<tr>
				<td>Kota</td>
				<td>:</td>
				<td><input type='text' name='vkota' id='vkota' value='<?#=$brs[3]?>'></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td><input type='text' name='vjk'  id='vjk' value='<?#=$brs[4]?>'></td>
			</tr>
			<tr>
				<td><input type='submit' name='submit' value='Save'></td>
				<td><input type='reset' name='reset' value='Clear'></td>
				
			</tr>
		</table>
		<table width=30% align=center>
 <tr>
	<td><a  href="index.php">BACK TO HOME</a></td>
  </tr>
  </table>
	</form>
		
		

		
		
