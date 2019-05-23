<div class="card col-sm-12">
  <div class="card-header">
    <h3>Laporan Transaksi</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","sewa_mobil");
    $sql = "select s.*, p.nama_pelanggan
    from sewa s inner join pelanggan p
    on s.id_pelanggan = p.id_pelanggan";

    $result = mysqli_query($koneksi,$sql);
    ?>
     <table class="table">
       <thead>
         <tr>
           <th>Tanggal Sewa</th>
           <th>Id Transaksi</th>
           <th>Nama Pelanggan</th>
           <th>Option</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($result as $hasil): ?>
           <tr>
             <td><?php echo $hasil["tgl_sewa"]; ?></td>
             <td><?php echo $hasil["id_sewa"]; ?></td>
             <td><?php echo $hasil["nama_pelanggan"]; ?></td>
             <td>
               <a href="page_karyawan.php?page=nota&id_sewa=<?php echo $hasil["id_sewa"];?>">
                 <button type="button" class="btn btn-info">
                   Bukti Sewa
                 </button>
               </a>
             </td>
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
   </div>
</div>
