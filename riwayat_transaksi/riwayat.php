<?php 
   require_once('../_header.php');
   $user = $_SESSION['master'];
   if($user != 'admin'){$query_ck = query("SELECT * FROM tb_riwayat_ck WHERE user = '$user'");
                       $query_dc = query("SELECT * FROM tb_riwayat_dc WHERE user = '$user'");
                       $query_cs = query("SELECT * FROM tb_riwayat_cs WHERE user = '$user'");}
   else{$query_ck = query("SELECT * FROM tb_riwayat_ck");
        $query_dc = query("SELECT * FROM tb_riwayat_dc");
        $query_cs = query("SELECT * FROM tb_riwayat_cs");}
   // var_dump($query_cs);
?>

   <div class="riwayat" class="main-content">
      <div class="container">
			<div class="baris">    
            <div class="selamat-datang">
					<div class="col-header">
						<h2 class="judul-md">Daftar Riwayat Transaksi</h2>
					</div>	
				</div>
         </div>

         <div class="baris">
            <div class="col">
               <?php require_once('riwayat_ck/riwayat_ck.php') ?>
            </div>
         </div>

         <div class="baris">
            <div class="col">
               <?php require_once('riwayat_dc/riwayat_dc.php') ?>
            </div>
         </div>

         <div class="baris">
            <div class="col">
               <?php require_once('riwayat_cs/riwayat_cs.php') ?>
            </div>
         </div>
      </div>
   </div>

<?php require_once('../_footer.php') ?>