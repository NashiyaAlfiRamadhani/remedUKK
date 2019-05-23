<script type="text/javascript">

  function Tambah(){
    document.getElementById('action').value="insert";
    document.getElementById('id_karyawan').value="";
    document.getElementById('nama_karyawan').value="";
    document.getElementById('alamat_karyawan').value="";
    document.getElementById('kontak').value="";
    document.getElementById('username').value="";
    document.getElementById('password').value="";
  }
  function Edit(index){
    // set input menjadi update
    document.getElementById("action").value="update";
    var table = document.getElementById("tabel_karyawan");
    // menampung data dar tabel
    var id_karyawan = table.rows[index].cells[0].innerHTML;
    var nama_karyawan = table.rows[index].cells[1].innerHTML;
    var alamat_karyawan = table.rows[index].cells[2].innerHTML;
    var kontak = table.rows[index].cells[3].innerHTML;
    var username = table.rows[index].cells[4].innerHTML;
    var password = table.rows[index].cells[5].innerHTML;
    // mengeluarkan ke form
    document.getElementById("id_karyawan").value= id_karyawan.trim();
    document.getElementById('nama_karyawan').value=nama_karyawan.trim();
    document.getElementById('alamat_karyawan').value=alamat_karyawan.trim();
    document.getElementById('kontak').value=kontak.trim();
    document.getElementById('username').value=username.trim();
    document.getElementById('password').value=password.trim();
  }
</script>

<div class="card col-sm-12">
  <div class="card-header text-white" style="background:#00818a;">
    <h4>Karyawan</h4>
  </div>
  <div class="card-body">
    <?php if (isset($_SESSION["message"])): ?>
      <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
        <?php echo $_SESSION["message"]["message"]; ?>
        <?php unset ($_SESSION["message"]); ?>
      </div>
    <?php endif; ?>
    <?php
    $koneksi= mysqli_connect("localhost", "root", "", "rent_car");
    $sql = "select * from karyawan";
    $result = mysqli_query($koneksi,$sql);
    $count = mysqli_num_rows($result);
     ?>
     <?php if ($count == 0): ?>
       <div class="alert alert-info">
         Data Belum Tersedia
       </div>
     <?php else: ?>



       <!-- jika datanya ada maka ditampilkan pada tabel -->
       <table class="table" id="tabel_karyawan">
         <thead>
           <tr>
             <th>Id Karyawan</th>
             <th>Nama</th>
             <th>Alamat</th>
             <th>Kontak</th>
             <th>Username</th>
             <th>Password</th>

             <th>Opsi</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($result as $hasil): ?>
             <tr>
               <td><?php echo $hasil["id_karyawan"]; ?></td>
               <td><?php echo $hasil["nama_karyawan"]; ?></td>
               <td><?php echo $hasil["alamat_karyawan"]; ?></td>
               <td><?php echo $hasil["kontak"]; ?></td>
               <td><?php echo $hasil["username"]; ?></td>
               <td><?php echo $hasil["password"]; ?></td>
                  <td>
                 <button type="button" class="btn btn-primary"
                 data-toggle="modal" data-target="#modal"
                 onclick="Edit(this.parentElement.parentElement.rowIndex);">
                 Edit
               </button>

               <a href="db_karyawan.php?hapus=karyawan&id_karyawan=<?php echo $hasil["id_karyawan"] ?>"
                 onclick="return confirm('Apakah Anda yakin akan menghapus data ini?????')">
                 <button type="button" class="btn btn-danger">
                   Hapus
                 </button>
               </a>

               </td>
             </tr>
                <?php endforeach; ?>
         </tbody>
       </table>
     <?php endif; ?>
  </div>
<div class="card-footer">
  <button type="button" class="btn btn-success"
  data-toggle="modal" data-target="#modal" onclick="Tambah()">Tambah</button>
</div>
</div>

<div class="modal fade" id="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="db_karyawan.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4>Form Karyawan</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" id="action">

          id_karyawan
          <input type="text" name="id_karyawan" id="id_karyawan" class="form-control">
          Nama
          <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control">
          alamat
          <input type="text" name="alamat_karyawan" id="alamat_karyawan" class="form-control">
          kontak
          <input type="text" name="kontak" id="kontak" class="form-control">
          username
          <input type="text" name="username" id="username" class="form-control">
          password
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">
            simpan
          </button>
        </div>
      </form>
  </div>
</div>
