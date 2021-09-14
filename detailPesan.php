<?php
include ("koneksi.php");
include "atas.php";
//jika diklik tombol batal maka pesanan akan dibatalkan dan data akan dihapus sesuai dengan getidPesan
if(isset($_REQUEST['batal'])){
	mysqli_query($db,"DELETE FROM pesan WHERE idPesan = '$_GET[getidPesan]'");
	echo"<script>
		alert('Registrasi dibatalkan');
		window.location.href='index.php';
		</script>";
}

if(isset($_REQUEST['getidKA'])){ //jika GET idKA diset atau berjalan maka akan tampil detailPesanan
$tampil = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM kereta WHERE idKA = '$_GET[getidKA]'"));
?>
<center><h2>&raquo; Rincian Pemesanan Tiket! &laquo;</h2></center>
<form method="POST" action="">
<table border="0" align="center" width="70%" style="border : 1px solid black;border-spacing : 1px;">
  <tr>
    <th align="right">Nama Kereta</th>
    <th>:</th>
    <td><?=$tampil['namaKA']?></td>
    <th align="right">Dari</th>
    <th>:</th>
    <td><?=$tampil['dari']?></th>
  </tr>
  <tr>
    <th align="right">Jadwal Berangkat</th>
    <th>:</th>
    <td><?=$tampil['tanggalBerangkat']." ".$tampil['jamBerangkat']?></td>
    <th align="right">Ke</th>
    <th>:</th>
    <td><?=$tampil['ke']?></td>
  </tr>
  <tr>
    <th align="right">Jadwal Tiba</th>
    <th>:</th>
    <td><?=$tampil['tanggalTiba']." ".$tampil['jamTiba']?></td>
    <th align="right">Harga (Kelas)</th>
    <th>:</th>
    <td><?php
    $isikls=mysqli_fetch_array(mysqli_query($db,"select * from kelas where idKelas='$tampil[idKelas]'"));
	echo $isikls['namaKelas']." - ".number_format($isikls['harga'],0,',','.');
	?></td>
  </tr>
</table>

<br>
<?php $lihatPesanan = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM pesan WHERE idPesan='$_GET[getidPesan]'"));?>
<table align="center" width="50%">
	<tr>
    	<td colspan="3">&raquo; <u>Data Diri</u></td>
    </tr>
	<tr>
		<td align="right">Nama Pemesan</td>
		<td>:</td>
		<td><?=$lihatPesanan['namaPemesan']?></td>
	</tr>
	<tr>
		<td align="right">Alamat</td>
		<td>:</td>
		<td><?=$lihatPesanan['alamat']?></td>
	</tr>
    <tr>
    	<td align="right">No Telp</td>
		<td>:</td>
		<td><?=$lihatPesanan['noTelp']?></td>
    </tr>
    <tr>
    	<td align="right">Dewasa</td>
		<td>:</td>
		<td><?=$lihatPesanan['dewasa']?></td>
    </tr>
    <tr>
    	<td align="right">Anak</td>
		<td>:</td>
		<td><?=$lihatPesanan['anak']?></td>
    </tr>
    <tr>
		<td align="right">Biaya</td>
		<td>:</td>
		<td><?=($lihatPesanan['dewasa']+$lihatPesanan['anak'])." * Rp. ".number_format($isikls['harga'],0,',','.')." = <b>Rp. ".
		number_format(($lihatPesanan['dewasa']+$lihatPesanan['anak'])*$isikls['harga'],0,',','.')."<b>"?></td>
	</tr>
    <tr>
    	<td colspan="3">&raquo; <u>Info!</u></td>
    </tr>
    <tr>
    	<td colspan="3">
- Reservasi dapat dilakukan 2x24 jam sebelum kereta berangkat<br>
- Harga dan ketersediaan tempat duduk sewaktu waktu dapat berubah<br>
- Pastikan anda telah menerima konfirmasi pembayaran dari PT. Kereta Api Indonesia untuk ditukarkan dengan tiket di stasiun online</u></td>
    </tr>
    <tr>
		<td colspan=6 align='center'>
        <!--
        Tombol cetak berfungsi untuk mencetak data yang terdapat pada 
        file cetakPesan.php dengan membawa nilai get dari idKA, idPesan
        -->
        <a href="cetakPesan.php?getidKA=<?=$_GET['getidKA']?>&getidPesan=<?=$_GET['getidPesan']?>" target="_blank" class='btn btn-info btn-sm'>Cetak Data Registrasi</a>
        <a href="index.php?"><input type="button" name="tutup" value="Tutup Info Detail" class='btn btn-primary btn-sm'/></a>
        <input type="submit" name="batal" value="Batalkan Pemesanan" class='btn btn-warning btn-sm'/></td>
	</tr>
</table>
</form>
<?php }