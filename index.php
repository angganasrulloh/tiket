   <?php
   error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
   session_start();
	include ("koneksi.php");
	include 'config/config.php';
	include "atas.php";
	if($_GET['page']==""){
		include "home.php";
	}elseif($_GET['page']=="login"){
		include"login.php";
	}
elseif(empty($_SESSION[username])){
?>
    <script type="text/javascript">
        alert("Page security administrator \n Anda tidak berhak masuk halaman ini");
    </script>
<?php
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
	elseif($_GET['page']=="kelas"){
		include"kelas.php";
	}elseif($_GET['page']=="kereta"){
		include"kereta.php";
	}elseif($_GET['page']=="datapesan"){
		include"dataPesan.php";
	}
	   
	   ?>
       </div>
          </div>
        </div>
      </div>
</body></html>