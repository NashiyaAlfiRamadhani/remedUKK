<?php
$koneksi = mysqli_connect("localhost","root","","sewa_mobil");
$sql = "select * from mobil";
$result = mysqli_query($koneksi,$sql);
 ?>

 <div class="row">
   <?php foreach ($result as $hasil): ?>
     <div class="card col-sm-3" style="background:#2e9483;">
       <div class="card-body" style="background:#2e9483;">
         <img src="image_mobil/<?php echo $hasil["image"];?>" width="100%"  class="img">
       </div>
       <div class="card-footer">
         <h5 class="text-center"><?php echo $hasil["nomor_mobil"]; ?></h5>
         <h6 class="text-center"><?php echo $hasil["biaya_sewa_perhari"]; ?></h6>
         <h6 class="text-center"><?php echo $hasil["stok"]; ?></h6>
         <h6 class="text-center"><?php echo $hasil["warna"]?></h6>
         <a href="db_sewa.php?sewa=true&id_mobil=<?php echo $hasil["id_mobil"];?>">
           <button type="button" class="btn btn-block btn-sm" style="background:#1ba68f;">
             Sewa
           </button>
         </a>
       </div>
     </div>
   <?php endforeach; ?>
 </div>
