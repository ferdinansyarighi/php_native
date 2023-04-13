<?php
    include_once("config.php");

    if(isset($_POST['update']))
    {	
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $agama = $_POST['agama'];
        $pekerjaandipilih = $_POST['pekerjaandipilih'];

        $result = mysqli_query($mysqli, "UPDATE calon_interview 
        SET nama='$nama', alamat='$alamat',jenis_kelamin='$jenis_kelamin',agama='$agama',pekerjaandipilih='$pekerjaandipilih'
        WHERE id=$id");
        
        header("Location: index.php");
    }
?>
<html>
<head>	
    <title>Edit Interview Baru</title>
</head>
 
<body>
    <a href="index.php">Home</a>
    <br/><br/>
    
	<form action="edit.php" method="POST">
		
		<fieldset>
		
		<p>
			<label for="nama">Nama: </label>
			<input type="text" name="nama" id="nama" placeholder="nama lengkap"/>
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

        <p>
            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
</p>

		<button type="submit" name="update">Daftar</button>
		
		</fieldset>
	
	</form>
</body>
</html>
