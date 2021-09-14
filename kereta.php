<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//-apabila tombol submit di set atau ditekan
//-maka akan malakukan aksi didalam isset tersebut.
if(isset($_POST['submit'])){
	//- deklarasi variable POST
	$idKA = $_POST['idKA'];
	$namaKA = $_POST['namaKA'];
	$tanggalBerangkat = $_POST['tanggalBerangkat'];
	$tanggalTiba = $_POST['tanggalTiba'];
	$jamBerangkat = $_POST['jamBerangkat'];
	$jamTiba = $_POST['jamTiba'];
	$dari = $_POST['dari'];
	$ke = $_POST['ke'];
	$idKelas = $_POST['idKelas'];
	//mengecek berapa jumlah data yang dipilih dalam query
	$cek = mysqli_num_rows(mysqli_query($db,"SELECT * FROM kereta WHERE idKA = '$idKA'"));
	//untuk mengecek apakah jumlah banyaknya data yang dipilih(SELECT) = 0
	//jika jumlahnya = 0 maka akan melakukan INSERT data,
	if($cek==0){
		//membuat variable table, field, dan where yang akan digunakan untuk fungsi
		//query database antara insert data atau update data,
		//sehingga tidak perlu melakukan penulisan berulang ulang
		$table = "INSERT INTO kereta SET";   //tabel yang akan diinsertkan
		$field= "namaKA = '$namaKA',
				 tanggalBerangkat = '$tanggalBerangkat',
				 tanggalTiba = '$tanggalTiba',
				 jamBerangkat = '$jamBerangkat',
				 jamTiba = '$jamTiba',
				 dari = '$dari',
				 ke = '$ke',
				 idKelas = '$idKelas'
				 ";	// field yang akan diinsertkan dengan nilai POST
		$where = "";	// variable WHERE diisi nilai kosong
	}else{	//jika tidak maka akan melakukan UPDATE data
		$table = "UPDATE kereta SET";	//table yang dipilih untuk update data
		$field= "namaKA = '$namaKA',
				 tanggalBerangkat = '$tanggalBerangkat',
				 tanggalTiba = '$tanggalTiba',
				 jamBerangkat = '$jamBerangkat',
				 jamTiba = '$jamTiba',
				 dari = '$dari',
				 ke = '$ke',
				 idKelas = '$idKelas'
				 ";	//beberapa data yang akan diupdate dari field 
				 //tersebut dengan mengambil nilai dari method post
		$where = "WHERE idKA = '$idKA'"; //where atau dimana idKA = nilai dari variable post idKA
	}
	//Query yang akan dijalankan dengan memanggil variale (table, field, where)
	mysqli_query($db,"$table $field $where")or die ('Error!!'.mysqli_error());
	//halaman yang akan dituju setelah aksi query diatas
	echo "<script>window.location.href='?page=kereta';</script>";
	exit;
}
//jika variable get di set atau sedang berjalan maka akan melakukan aksi...
//fungsi isset($_GET[delidKA]) yaitu untuk menghapus data
if(isset($_GET['delidKA'])){
	//Query yang dijalankan yaitu menghapus dari table kereta dimana idKA = nilai dari GET[idKA]
	mysqli_query($db,"DELETE FROM kereta WHERE idKA = '$_GET[delidKA]'");
	//kemudian setelah dilakukan fungsi diatas halaman akan ditujukan pada halaman kereta "page=kereta"
	echo"<script>
		alert('Data terhapus');
		window.location.href='?page=kereta';
		</script>";
}
//untuk menyimpan nilai query database kedalam array
//untuk menampilkan data dengan memilih satu data dimana idKA = nilai GET dari idKA
//fungsi ini akan ditampilkan pada textfield didalam form
$tampil = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM kereta WHERE idKA = '$_GET[idKA]'"));
?>
<form method="POST">
<!--
value langsung diset kedalam textfield
dengan mengambil nilai dari array $tampil
-->
<table align="center">
	<tr>
		<td><input type="hidden" name="idKA" class="form-control" value="<?=$tampil['idKA']?>" readonly /></td>
	</tr>
	<tr>
		<td>Nama Kereta</td>
		<td>:</td>
		<td><input type="text" name="namaKA" class="form-control" size="100" value="<?=$tampil['namaKA']?>" required/></td>
	</tr>
	<tr>
		<td>Tanggal Berangkat</td>
		<td>:</td>
		<td><input type="date" name="tanggalBerangkat" id="tgl" class="form-control" value="<?=$tampil['tanggalBerangkat']?>" required/></td>
	</tr>
    <tr>
		<td>Tanggal Tiba</td>
		<td>:</td>
		<td><input type="date" name="tanggalTiba" id="tgl2" class="form-control" value="<?=$tampil['tanggalTiba']?>" required/></td>
	</tr>
    <tr>
		<td>Jam Berangkat</td>
		<td>:</td>
		<td><input type="time" name="jamBerangkat" class="form-control" value="<?=$tampil['jamBerangkat']?>" required/></td>
	</tr>
    <tr>
		<td>Jam Tiba</td>
		<td>:</td>
		<td><input type="time" name="jamTiba" class="form-control" value="<?=$tampil['jamTiba']?>" required/></td>
	</tr>
    <tr>
		<td>Dari</td>
		<td>:</td>
		<td><input type="text" name="dari" class="form-control" value="<?=$tampil['dari']?>" required/></td>
	</tr>
    <tr>
		<td>Ke</td>
		<td>:</td>
		<td><input type="text" name="ke" class="form-control" value="<?=$tampil['ke']?>" required/></td>
	</tr>
    <tr>
		<td>Kelas</td>
		<td>:</td>
		<td><select name="idKelas" class="form-control"> 
				<option value=""></option>
					<?php
					$kls=mysqli_query($db,"select * from kelas");
					while($isikls=mysqli_fetch_array($kls)){
						if($isikls['idKelas']==$tampil['idKelas'])
						    echo "<option value='".$isikls['idKelas']."' selected>".$isikls['namaKelas']." - ".number_format($isikls['harga'],0,',','.')."</option>";
						else
							echo "<option value='".$isikls['idKelas']."'>".$isikls['namaKelas']." - ".number_format($isikls['harga'],0,',','.')."</option>";
					}
					?>
			</select></td>
	</tr>
	<tr>
		<td colspan=3 align='center'><br><input class="btn btn-primary btn-sm" type="submit" name="submit" value="Simpan"/>
        <a href="?page=kereta"><input type="button" class="btn btn-warning btn-sm" name="batal" value="Batal"/></a></td>
	</tr>
</table>
</form>
<br>
<?php
//membuat variable $select untuk memilih data yang akan ditamilkan
$resultselect= mysqli_query($db,"SELECT * FROM kereta ORDER BY idKA ASC")
//kemudian membuat variable $resultselect untuk menjalankan query yang ada pada $select
or die ('Error load data : '.mysqli_error());
if(mysqli_num_rows($resultselect)==0){ // jika data yang ada dalam query $resultselect adalah 0 maka
	echo"<center>Data tidak tersedia!</center>"; //akan tampil pesan data tidak tersedia
}else{	//jika ada maka akan ditampilkan data tersebut dalam bentuk table
//tag <th> untuk membuat tag header pada table
echo "<table class='table table-striped table-bordered table-condensed bootstrap-datatable datatable' cellspacing='0' cellpadding='0' width='80%' align ='center' border ='1'>
<tr>
	<th bgcolor='silver'>No</th>
	<th bgcolor='silver'>Nama Kereta</th>
	<th bgcolor='silver'>Jadwal Berangkat</th>
	<th bgcolor='silver'>Jadwal Tiba</th>
	<th bgcolor='silver'>Dari</th>
	<th bgcolor='silver'>Ke</th>
	<th bgcolor='silver'>Harga (Kelas)</th>
	<th bgcolor='silver'></th>
</tr>";
$no=0; //membuat variable $no dengan nilai awal = 0
while($row = mysqli_fetch_array($resultselect)){ //membuat variable $row dengan menyimpan data yang ada pada $resultselect kedalam bentuk array dan sekaligus mengulang semua data yang ada pada $resultselect
extract($row); //berfungsi untuk menyimpan data array $row menjadi variable
//variale $lihat disini berfungsi untuk melihat data yang ada pada table kelas dimana idKelas dengan nilai yang ada pada table kereta yang terdapat idKelas
$lihat=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM kelas WHERE idKelas = '$idKelas'"));
//kemudian akan ditampilkan beberapa baris data yang ada pada $resultselect
echo "<tr align='center'>
	<td align='center'>".$no=1+$no."</td>
	<td>".$namaKA."</td>
	<td>".$tanggalBerangkat." - ".$jamBerangkat."</td>
	<td>".$tanggalTiba." - ".$jamTiba."</td>
	<td>".$dari."</td>
	<td>".$ke."</td>
	<td>".$lihat['namaKelas']." - ".number_format($lihat['harga'],0,',','.')."</td>
	<td align='center'><a href='?page=kereta&idKA=$idKA' class='btn btn-info btn-sm'>Edit</a>
	<a href='?page=kereta&delidKA=$idKA' class='btn btn-danger btn-sm'>Hapus</a></td>
</tr>";
}
echo"</table>";
}
?>
