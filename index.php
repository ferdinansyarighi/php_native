<?php
	include_once("config.php");
	
	$result = mysqli_query($mysqli, "SELECT * FROM calon_interview ORDER BY id ASC");
?>

<!DOCTYPE html>

<html>
<head>
	<title>Pendaftaran Interview Baru | IT Coding</title>
</head>

<body>
	<header>
		<h3>Pendaftaran Interview Baru</h3>
		
	</header>

	<nav>
		<a href="#">[+] Tambah Baru</a>
	</nav>	
	<br>	
	<table border="1">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Jenis Kelamin</th>
			<th>Agama</th>
			<th>Pekerjaan Dipilih</th>
			<th>Tindakan</th>
		</tr>
	</thead>
	<tbody>
		<?php  
			$count = 0;
			while($data = mysqli_fetch_array($result)) {     
				$count++;      
				echo "<tr>";
				echo "<td>".$count."</td>";
				echo "<td>".$data['nama']."</td>";
				echo "<td>".$data['alamat']."</td>";
				echo "<td>".$data['jenis_kelamin']."</td>";  
				echo "<td>".$data['agama']."</td>";  
				echo "<td>".$data['pekerjaandipilih']."</td>";    
				echo "<td><a href='edit.php?id=$data[id]'>Edit</a> | <a href='delete.php?id=$data[id]'>Hapus</a></td></tr>";     
			}
		?>
	</tbody>
	</table>
	
	<?php
		echo '<br> Total : ' . $count . '<br><br>';
	?>
	
	<form action="index.php" method="POST">
		
		<fieldset>
		
		<p>
			<label for="nama">Nama: </label>
			<input type="text" name="nama" id="nama" placeholder="nama lengkap" />
		</p>

		<p>
			<label for="alamat">Alamat: </label>
			<textarea name="alamat" id="alamat" placeholder="alamat"></textarea>
		</p>

		<p>
			<label for="jenis_kelamin">Jenis Kelamin: </label>
			<input type="radio" id="l" name="jenis_kelamin" value="laki-laki"> <label for="html">Laki-Laki</label>
			<input type="radio" id="p" name="jenis_kelamin" value="perempuan"> <label for="css">Perempuan</label>
		</p>

		<p>
			<label for="agama">Agama: </label>
			<select name="agama" id="agama">
				<option value="Islam">Islam</option>
				<option value="Kristen">Kristen</option>
				<option value="Hindu">Hindu</option>
				<option value="Buddha">Buddha</option>
			</select>
		</p>

		<p>
			<label for="nama">Pekerjaan Dipilih: </label>
			<input type="text" name="pekerjaandipilih" id="pekerjaandipilih" placeholder="pekerjaandipilih" />
		</p>

		<button type="submit" name="submit">Daftar</button>
		
		</fieldset>
	
	</form>
	
    <?php
 
		if(isset($_POST['submit'])) {
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$jenis_kelamin = $_POST['jenis_kelamin'];
			$agama = $_POST['agama'];
			$pekerjaandipilih = $_POST['pekerjaandipilih'];
					
			$result = mysqli_query($mysqli, "INSERT INTO calon_interview (nama,alamat,jenis_kelamin,agama,pekerjaandipilih)
			VALUES('$nama','$alamat','$jenis_kelamin','$agama','$pekerjaandipilih')");
			
			echo "Pendaftaran interview baru berhasil!";
		}
    ?>
		
		<h4>Report 1</h4>
		<table border="1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Jenis Kelamin</th>
					<th>Agama</th>
					<th>Pekerjaan Dipilih</th>
					<th>Tindakan</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$result1 = mysqli_query($mysqli, "SELECT * FROM calon_interview 
					WHERE agama != 'Kristen'
					GROUP BY jenis_kelamin, agama
					ORDER BY id ASC");

					$count = 0;
					while($data1 = mysqli_fetch_array($result1)) {     
						$count++;      
						echo "<tr>";
						echo "<td>".$count."</td>";
						echo "<td>".$data1['nama']."</td>";
						echo "<td>".$data1['alamat']."</td>";
						echo "<td>".$data1['jenis_kelamin']."</td>";  
						echo "<td>".$data1['agama']."</td>";  
						echo "<td>".$data1['pekerjaandipilih']."</td>";     
					}
				?>
			</tbody>
		</table>

		<h4>Report 2</h4>
		<table border="1">
			<thead>
				<tr>
					<th>No</th>
					<th>Pekerjaan Dipilih</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$result2 = mysqli_query($mysqli, "SELECT pekerjaandipilih, COUNT(pekerjaandipilih) FROM `calon_interview`
					GROUP BY pekerjaandipilih
					ORDER BY COUNT(pekerjaandipilih) DESC
					LIMIT 3");

					$count = 0;
					while($data2 = mysqli_fetch_array($result2)) {     
						$count++;      
						echo "<tr>";
						echo "<td>".$count."</td>"; 
						echo "<td>".$data2['pekerjaandipilih']."</td>";     
					}
				?>
			</tbody>
		</table>

		<h4>Report 3</h4>
		<table border="1">
			<thead>
				<tr>
					<th>No</th>
					<th>Pekerjaan Dipilih</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$result3 = mysqli_query($mysqli, "SELECT group_concat(pekerjaandipilih) pekerjaan
					FROM `calon_interview`
					GROUP BY agama");

					$count = 0;
					while($data3 = mysqli_fetch_array($result3)) {     
						$count++;      
						echo "<tr>";
						echo "<td>".$count."</td>"; 
						echo "<td>".$data3['pekerjaan']."</td>";     
					}
				?>
			</tbody>
		</table>

		<h4>Report 4</h4>
		<table border="1">
			<thead>
				<tr>
					<th>No</th>
					<th>Pekerjaan Dipilih</th>
				</tr>
			</thead>
			<tbody>
				<?php  
					$result4 = mysqli_query($mysqli, "SELECT group_concat(nama) nama
					FROM `calon_interview`
					GROUP BY jenis_kelamin");

					$count = 0;
					while($data4 = mysqli_fetch_array($result4)) {     
						$count++;      
						echo "<tr>";
						echo "<td>".$count."</td>"; 
						echo "<td>".$data4['nama']."</td>";     
					}
				?>
			</tbody>
		</table>
	</body>
</html>
