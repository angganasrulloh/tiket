<?php
// untuk memulai session pada fungsi login
if(isset($_POST['submit'])){ //jika tombol submit di set atau dijalankan maka melakukan aksi
//deklarasi variable POST
	$namaPemesan = $_POST['namaPemesan'];
	$alamat = $_POST['alamat'];
	$noTelp = $_POST['noTelp'];
	$dewasa = $_POST['dewasa'];
	$anak = $_POST['anak'];

//deklarasi variable $table, $field yang akan digunakan untuk fungsi insert data	
	$table = "INSERT into pesan (namaPemesan,alamat,noTelp,dewasa,anak,idKA)
	values ('$namaPemesan','$alamat','$noTelp','$dewasa','$anak','$_GET[getidKA]')";
	mysqli_query($db, $table);		 
//memilih id Maximal atau id yang terbesar dari idPesan yang terdapat pada table pesan
//fungsi ini untuk mengambil data yang terakhir di inputkan/dipilih
	$max = mysqli_fetch_array(mysqli_query($db,"SELECT max(idPesan) as idPesan FROM pesan"));
	//kemudian halaman akan diarahkan pada detail Pemesanan
	echo "<script>window.location.href='detailPesan.php?getidKA=$_GET[getidKA]&getidPesan=$max[idPesan]';</script>";
	exit;
}

//jika POST dengan value pilih di set maka halam akan diarahkan pada halaman itu sendiri dengan membawa nilai GET idKA yang bernilai pada POST[pilih]
if(isset($_REQUEST['pilih'])){
	echo"<script>
		window.location.href='?getidKA=$_POST[pilih]';
		</script>";
}

if(isset($_REQUEST['getidKA'])){ //jika variable getidKA diset pada GET maka akan tampil detail dari pesanan kereta yang dipilih
//untuk menampilkan detailKereta yang dipilih
$tampil = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM kereta WHERE idKA = '$_GET[getidKA]'"));

?>
<center><h4>&raquo; Form Registrasi &laquo;</h4>
Silahkan Masukkan biodata diri anda dengan benar!</center>
<form method="POST" action="">
<table border="0" align="center" width="70%" style="border : 1px solid black;border-spacing : 1px;">
  <tr>
    <th align="right">Nama Kereta</th>
    <th>:</th>
    <td><?php echo $tampil['namaKA']?></td>
    <th align="right">Dari</th>
    <th>:</th>
    <td><?php echo $tampil['dari']?></th>
  </tr>
  <tr>
    <th align="right">Jadwal Berangkat</th>
    <th>:</th>
    <td><?php echo $tampil['tanggalBerangkat']." ".$tampil['jamBerangkat']?></td>
    <th align="right">Ke</th>
    <th>:</th>
    <td><?php echo $tampil['ke']?></td>
  </tr>
  <tr>
    <th align="right">Jadwal Tiba</th>
    <th>:</th>
    <td><?php echo $tampil['tanggalTiba']." ".$tampil['jamTiba']?></td>
    <th align="right">Harga (Kelas)</th>
    <th>:</th>
    <td><?php
    $isikls=mysqli_fetch_array(mysqli_query($db,"select * from kelas where idKelas='$tampil[idKelas]'"));
	echo $isikls['namaKelas']." - ".number_format($isikls['harga'],0,',','.');
	?></td>
  </tr>
</table>
<br>
<!--Membuat tampilan form registrasi pemesanan -->
<table align="center">
<tr>
		<td>Nama Pemesan &nbsp;</td>
		<td>:&nbsp;</td>
		<td><input type="text" name="namaPemesan" placeholder="Nama Pemesan" class="form-control" required/></td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td><input type="text" name="alamat" size="40" placeholder="Alamat Lengkap" class="form-control" required/></td>
	</tr>
    <tr>
		<td>No Telp</td>
		<td>:</td>
		<td><input type="text" name="noTelp" placeholder="Nomor telp valid yang bisa dihubungi" class="form-control" required/></td>
	</tr>
    <tr>
		<td>Dewasa</td>
		<td>:</td>
		<td><input type="number" name="dewasa" class="form-control" style="width:50px;" required/></td>
	</tr>
    <tr>
		<td>Anak</td>
		<td>:</td>
		<td><input type="number" name="anak" class="form-control" style="width:50px;" required/></td>
	</tr>
    <tr>
		<td colspan=3 align='center'><br><input type="submit" name="submit" value="Simpan" class='btn btn-primary btn-sm'/>
        <a href="?"><input type="button" name="batal" value="Batal" class='btn btn-warning btn-sm'/></a></td>
	</tr>
</table>
</form>

<?php 
//jika tidak di set variable getidKA atau belum dipilih maka akan tampil beberapa data kereta dengan pemilihan meggunakan radio button
}else{
echo"*) Silahkan pilih Jadwal dan Tujuan Kereta anda !";
echo"<form method='post' action=''>";
$result = mysqli_query($db,"SELECT * FROM kereta ORDER BY idKA ASC");
if(mysqli_num_rows($result)==0){
	echo"<center>Data tidak tersedia!</center>";
}else{
echo "<center><table class='table table-striped table-bordered table-condensed bootstrap-datatable datatable' cellspacing='0' cellpadding='0' width='80%' align ='center' border ='1'>
<tr>
	<th bgcolor='silver'></th>
	<th bgcolor='silver'>Nama Kereta</th>
	<th bgcolor='silver'>Jadwal Berangkat</th>
	<th bgcolor='silver'>Jadwal Tiba</th>
	<th bgcolor='silver'>Dari</th>
	<th bgcolor='silver'>Ke</th>
	<th bgcolor='silver'>Harga (Kelas)</th>
</tr>";
$no=0;
while($row = mysqli_fetch_array($result)){
extract($row);
$lihat=mysqli_fetch_array(mysqli_query($db,"SELECT * FROM kelas WHERE idKelas = '$idKelas'"));
echo "<tr align='center'>
	<td><input name='pilih' onChange='this.form.submit()' type='radio' value='".$idKA."'><sub></sub></td>
	<td>".$namaKA."</td>
	<td>".$tanggalBerangkat." - ".$jamBerangkat."</td>
	<td>".$tanggalTiba." - ".$jamTiba."</td>
	<td>".$dari."</td>
	<td>".$ke."</td>
	<td>".$lihat['namaKelas']." - ".number_format($lihat['harga'],0,',','.')."</td>
</tr>";
}
echo"</table></center>";
}
echo"</form>
";
}