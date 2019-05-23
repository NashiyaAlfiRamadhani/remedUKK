<div class="card col-sm-12">
	<div class="card-header bg-dark col-sm-15">
		<h3>>Daftar Sewa</h3>
	</div>
	<div class="card-body">
		<?php
		$koneksi = mysqli_connect("localhost","root","","sewa_mobil");
		$sql= "select * from pelanggan";
		$result = mysqli_query($koneksi,$sql);
		 ?>
		 <form action="db_sewa.php?checkout=true" method="post" onsubmit="return confirm('Apakah Anda yakin pesanan ini?')">
		 Pilih pelanggan
		 <select class="form-control" name="id_pelanggan">
		 	<?php while ($hasil = mysqli_fetch_array($result)) {?>
				<option value="<?php echo $hasil['id_pelanggan'] ?>">
					<?php echo $hasil['nama_pelanggan'] ?>
				</option>
		 	<?php } ?>
		 </select>

		<table class="table">
			<thead>
				<tr>
					<th>ID Mobil</th>
					<th>Nomor Mobil</th>
					<th>Image</th>
					<th>Jumlah</th>
					<th>Lama Sewa</th>
					<th>Option</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($_SESSION["session_sewa"] as $hasil):?>
					<tr>
						<td><?php echo $hasil["id_mobil"];?></td>
						<td><?php echo $hasil["nomor_mobil"];?></td>
						<td>
							<img src="image_mobil/<?php echo $hasil["image"];?>" width="100" height="100">
						</td>
						<td>
							<input type="number" name="jumlah<?php echo $hasil["id_mobil"];?>" value="1" min="1" required>
						</td>
						<td>
							<input type="number" name="lama_sewa<?php echo $hasil["id_mobil"];?>" value="1" min="1" required>
						</td>
						<td>
							<a href="db_sewa.php?hapus=true&id_mobil=<?php echo $hasil["id_mobil"]; ?>">
								<button type="button" class="btn btn-danger">
									Hapus
								</button>
							</a>
						</td>
						</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<button type="submit" class="btn btn-block btn-dark">
			CHECKOUT
		</button>
	</form>
	</div>
</div>
