<script type="text/javascript">
        function Tambah(){
            //set action insert
            document.getElementById("action").value="insert";
            //mengosongkan inputan
            document.getElementById("id_pelanggan").value="";
          document.getElementById("nama_pelanggan").value="";
          document.getElementById("alamat_pelanggan").value="";
          document.getElementById("kontak").value="";


        }
        function Edit(index){
    //set action update
    document.getElementById("action").value="update";

    //ambil ata ari tabel
    var table= document.getElementById("pelanggan");

   var id_pelanggan = table.rows[index].cells[0].innerHTML;
          var nama_pelanggan = table.rows[index].cells[1].innerHTML;
          var alamat_pelanggan = table.rows[index].cells[2].innerHTML;
          var kontak = table.rows[index].cells[3].innerHTML;

     //set inputan berdasarkan data-nya
     document.getElementById('id_pelanggan').value=id_pelanggan;
          document.getElementById('nama_pelanggan').value=nama_pelanggan;
          document.getElementById('alamat_pelanggan').value=alamat_pelanggan;
          document.getElementById('kontak').value=kontak;
    }

    </script>
        <div class="card-col-sm-12">
        <div class="card-header text-white" style="background:#00818a;">
                <h4>Pelanggan</h4>
            </div>
            <?php

            $koneksi =mysqli_connect("localhost", "root", "","sewa_mobil");
            if(mysqli_connect_errno()){
                //untuk mengecek kalau terjadi kesalahan saat koneksi
                echo mysqli_connect_error();
                //menampilkan pesan errornya
            }
            $sql ="select * from pelanggan";
                $result = mysqli_query($koneksi, $sql);
                $count =mysqli_num_rows($result);
                ?>
                 <?php if($count == 0):?>
                <div class="alert alert-info">
                    Data is Empty
                </div>
                <?php else:?>
                <!-- jika ada ditampilkan di tabel -->
                <table class="table" id="pelanggan">
                    <thead>
                        <tr>
                        <th>id pelanggan</th>
                   <th>nama_pelanggan</th>
                   <th>alamat_pelanggan</th>
                   <th>kontak</th>
                   <th>image</th>
                   <th>opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $hasil):?>
                        <tr>
                        <td><?php echo $hasil["id_pelanggan"]; ?></td>
                     <td><?php echo $hasil["nama_pelanggan"]; ?></td>
                     <td><?php echo $hasil["alamat_pelanggan"]; ?></td>
                     <td><?php echo $hasil["kontak"]; ?></td>
                            <td>
                             <img src="<?php echo "image_pelanggan/".$hasil["image"];?>"id="<?php echo $hasil["id_pelanggan"];?>" class="img" width="200">
                          </td>
                            <td>
                                <button type="button" class="btn btn-primary"
                                data-toggle="modal" data-target="#modal"
                                onclick="Edit(this.parentElement.parentElement.rowIndex)">
                                    Edit
                                </button>
                                <a href="db_pelanggan.php?hapus=pelanggan&id_pelanggan=<?php echo $hasil["id_pelanggan"];?>"
                                onclick="return confirm('Apakah Anda Yakin ingin menghapus data ini?')">
                                <button type="button" class="btn btn-danger">
                                    Hapus
                                </button>
        </td>
        </tr>
        </tbody>
        <?php endforeach;?>
                </table>
                <?php endif;?>
            </div>
            <div class="card-footer">

                <button type="button" class="btn btn-danger"
                data-toggle="modal" data-target="#modal" onclick="Tambah()">
                    Tambah Pelanggan
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action ="db_pelanggan.php" method="post" enctype="multipart/form-data">
                <div class="container">
                <div class="card col-sm-12">

                    <div class="modal-header">
                <h4>Data Pelanggan</h4>
                <span class="close" data-dismiss="modal">&times;</span>
            </div>
            <div clas="modal-body">
                <input type="hidden" name="action" id="action" />
                <!-- ini membuat status edit/insert -->
                Id Pelanggan
              <input type="text" name="id_pelanggan" id="id_pelanggan" class="form-control">
              nama Pelanggan
              <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control">
              alamat Pelanggan
              <input type="text" name="alamat_pelanggan" id="alamat_pelanggan" class="form-control">
              kontak
              <input type="text" name="kontak" id="kontak" class="form-control">
              image
              <input type="file" name="image" id="image" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="text" class="btn btn-success">
                    Simpan
               </button>
               </div>
               </form>
               </div>
               </div>
               </div>
