<?php $nama = $_SESSION['master']; ?>
<div class="col">
   <div class="card">
      <div class="card-title card-flex">
         <div class="card-col">
            <h2>Order Dry Clean (Cuci Kering)</h2>	
         </div>
      </div>

      <div class="card-body">
         <div class="tabel-kontainer">
            <table class="tabel-transaksi">
               <thead>
                  <tr>
                     <th class="sticky">No</th>
                     <th class="sticky">No.Order</th>
                     <th class="sticky">Tgl Order</th>
                     <th class="sticky">Nama Pelanggan</th>
                     <th class="sticky">Jenis Paket</th>
                     <th class="sticky">Waktu Kerja</th>
                     <th class="sticky">Berat (Kg)</th>
                     <th class="sticky">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  if($nama == 'admin'){$dry_clean = query("SELECT * FROM tb_order_dc ORDER BY id_order_dc DESC");}
                  else{$dry_clean = query("SELECT * FROM tb_order_dc WHERE user = '$nama' ORDER BY id_order_dc DESC"); }
                     if (!empty($dry_clean)) : ?>
                     <?php
                        $no_dc = 1;
                        foreach($dry_clean as $dc) : ?>
                           <tr>
                              <td><?= $no_dc ?></td>
                              <td><?= $dc['or_dc_number'] ?></td>
                              <td><?= $dc['tgl_masuk_dc'] ?></td>
                              <td><?= $dc['nama_pel_dc'] ?></td>
                              <td><?= $dc['jenis_paket_dc'] ?></td>
                              <td><?= $dc['wkt_krj_dc'] ?></td>
                              <td><?= $dc['berat_qty_dc'] . ' Kg' ?></td>
                              <td>
                                 <?php if($nama == 'admin'):?>
                                 <a href="<?=url('daftar_order/hapus_ck.php?or_ck_number=')?><?=$ck['or_ck_number']?>" onclick="return confirm('Yakin akan menghapus?');" class="btn btn-hapus">Hapus</a>
                                 <?php endif; ?>
                                 <a href="<?=url('detail_order/detail_ck/detail_order_ck.php?or_ck_number=')?><?=$ck['or_ck_number']?>" class="btn btn-detail">Detail</a>  
                              </td>
                           </tr>
                        <?php $no_dc++ ?>
                     <?php endforeach ?>
                  <?php endif ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>