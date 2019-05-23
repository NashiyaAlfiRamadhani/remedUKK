<script type="text/javascript">
  function Print(){
    var printDocument = document.getElementById('card').innerHTML;
    // ini adalah bagian yang akan dicetak
    var originalDocument = document.body.innerHTML;

    document.body.innerHTML = printDocument;
    window.print();
    document.body.innerHTML = originalDocument;
  }
</script>
<div id="card" class="card col-sm-12">
  <div class="card-header">
    <h3>Nota Pembayaran</h3>
  </div>
  <div class="card-body">
    <?php
      $koneksi = mysqli_connect("localhost","root","","sewa_mobil");
      // ambil data $id_transaksi
      $id_sewa = $_GET["id_sewa"];
      $sql = "select s.*,p.nama_pelanggan
      from sewa s inner join pelanggan p
      on s.id_pelanggan = p.id_pelanggan
      where s.id_sewa = '$id_sewa'";
      $result = mysqli_query($koneksi,$sql);
      $sewa = mysqli_fetch_array($result);
      // ambil barang
      $sql2 = "select m.*,ds.jumlah,ds.lama_sewa
      from detail_sewa ds inner join mobil m
      on ds.id_mobil = m.id_mobil
      where ds.id_sewa = '$id_sewa'";
      $result2 = mysqli_query($koneksi,$sql2);
     ?>

     <h4>ID Sewa: <?php echo $sewa["id_sewa"]; ?></h4>
     <h4>Pelanggan: <?php echo $sewa["nama_pelanggan"]; ?></h4>
     <h4>Tgl. Sewa: <?php echo $sewa["tgl_sewa"]; ?></h4>

     <table class="table">
       <thead>
         <tr>
           <th>ID Mobil</th>
           <th>Nomor Mobil</th>
           <th>Biaya Sewa Perhari</th>
           <th>Jumlah</th>
           <th>Lama Sewa</th>
           <th>Total</th>
         </tr>
       </thead>
       <tbody>
         <?php $total = 0; foreach ($result2 as $hasil): ?>
           <tr>
             <td><?php echo $hasil["id_mobil"]; ?></td>
             <td><?php echo $hasil["nomor_mobil"]; ?></td>
             <td>Rp. <?php echo number_format($hasil["biaya_sewa_perhari"]); ?></td>
             <td><?php echo $hasil["jumlah"]; ?></td>
             <td><?php echo $hasil["lama_sewa"]; ?></td>
             <td>Rp <?php echo number_format($hasil["lama_sewa"]*$hasil["biaya_sewa_perhari"]); ?></td>
           </tr>
         <?php
         $total += $hasil["lama_sewa"]*$hasil["biaya_sewa_perhari"];
       endforeach; ?>
       </tbody>
     </table>
     <h2>Total: Rp. <?php echo number_format($total); ?></h2>
  </div>
  <button onclick="card()" type="submit" class="btn btn-success">
    Print
  </button>
</div>
