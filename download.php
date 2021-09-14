<?php
include 'config/config.php';
include 'koneksi.php';
ob_start();
//membuat variable $select yang berisi data yang akan ditampilkan dengan memilih dari beberapa table yang dihubungkan melalui field yang sama
$select = mysqli_query($db,"SELECT a.*, concat(b.namaKA,' - ',b.dari,' &raquo; ',b.ke,' - ',c.namaKelas) as idKA
FROM pesan a, kereta b, kelas c
WHERE a.idKA = b.idKA
AND b.idKelas = c.idKelas
ORDER BY idPesan DESC");
//membuat variable $resultselect untuk menjalankan query yang ada pada variable $select
if(mysqli_num_rows($select)==0){ //mengecek apakan jumlah data dari variable $resultselect adalah 0
echo"<center>Data tidak tersedia!</center>"; 
//jika 0 maka akan muncul pesan data tidak tersedia
}else{  //jika tidak 0 atau ada data didalamnya maka akan ditampilkan isi dari query tersebut
echo"<center>DAFTAR PEMESANAN TIKET KERETA API</center><br>";
echo "<table class='table table-striped table-bordered table-condensed bootstrap-datatable datatable' cellspacing='0' cellpadding='0' width='80%' align ='center' border ='1'>
<tr>
  <th bgcolor='silver'>No</th>
  <th bgcolor='silver'>Nama Pemesan</th>
  <th bgcolor='silver'>Alamat</th>
  <th bgcolor='silver'>No. Telp</th>
  <th bgcolor='silver'>Dewasa</th>
  <th bgcolor='silver'>Anak</th>
  <th bgcolor='silver'>ID. Kereta</th>
  <th bgcolor='silver'></th>
</tr>";
$no=0;
while($row = mysqli_fetch_array($select)){
extract($row);
echo "<tr>
  <td align='center'>".$no=1+$no."</td>
  <td>".$namaPemesan."</td>
  <td>".$alamat."</td>
  <td>".$noTelp."</td>
  <td align='center'>".$dewasa."</td>
  <td align='center'>".$anak."</td>
  <td>".$idKA."</td>
  <td align='center'></td>
</tr>";
}
echo"</table>";
}
?>

<?php
$html = ob_get_clean();
$dompdf = new Dompdf\Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$pdf = $dompdf->output();
$dompdf->stream('laporan-pemesanan-tiket.pdf',array('Attachment' => 1));