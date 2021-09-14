<?php
// untuk memulai session pada fungsi login
error_reporting();
session_start();

include ("koneksi.php");
//jika POST username dan pass di set atau dijalankan
if(isset($_POST['username'])and(isset($_POST['pass']))){
	//maka deklarasi variable $username dan $pass
	$username=$_POST['username'];
	$pass=$_POST['pass'];
}
//dan variable $op mengambil dari get[op]
$op=$_GET['op'];
//jika nilai get[op]==in yaitu masuk pada session maka
if ($op=="in"){
	//akan melakukan query /mengecek dari table user dimana username dan pass itu ada / cocok
	$query=mysqli_query($db,"select * from user where username='$username' and pass='$pass'");
	if((mysqli_num_rows($query)==1)){ //jika jumlah data pada Query $query yaitu 1 maka
		$c=mysqli_fetch_array($query);	//menyimpan data array pada variable $c
		//nilai dari array $c dideklarasikan dalam sebuah session
		$_SESSION['username']=$c['username']; //session username
		$_SESSION['level']=$c['level'];	//session level
		
			}if($c['level']=="admin"){ //jika level = admin
				//maka akan muncul pesan alert "Selamat datang di halaman admin" dan hamalan akan diarahkan pada homeadmin.php
				echo"<script>alert('Selamat datang di halaman admin');window.location='index.php'</script>";
			}else{ // jika salah maka katasandi tidak cocok
				echo"<script>alert('kata sandi tidak cocok');window.location='index.php'</script>";
			}
}elseif($op=="out"){
	//jika $_GET[op] bernilai out
	unset($_SESSION['username']); //unset usernama/menghentikan session isset
	unset($_SESSION['level']); //unset level
	//muncul pesan alert Anda telah logout
	//halaman akan diarahkan pada index.php
	echo"<script>alert('Anda telah Logout');window.location='index.php'</script>";
}
?>