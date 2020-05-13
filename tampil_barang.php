<?php
  include('koneksi2.php'); 
  require_once('cart.php');//agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <link href="assets/css/style.css" rel="stylesheet"> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>
  
  <label>Search</label>
  <form method="GET" action="search_produk.php">
        <div class="row mb-3">
		    <div class="col-sm-3">
		        <div class="form-group">
		            <select name="s_jurusan" id="s_jurusan" class="form-control">
		                <option value="">Filter Harga</option>
		                <option value="Sistem Informasi" <?php if ($s_jurusan=="Sistem Informasi"){ echo "selected"; } ?>> Rp.0 - Rp.100000</option>
		                <option value="Teknik Informatika" <?php if ($s_jurusan=="Teknik Informatika"){ echo "selected"; } ?>>>Rp.100000</option>
		            </select>
                
		        </div>
		    </div>
		    <div class="col-sm-4">
            <input type="text" placeholder="Type the name here" name="search">&nbsp;
		   
		        <button type="submit" value="Search" name="btn" class="btn btn-sm btn-warning">Cari</button>
		    </div>
		</div>
	</form>
  <br>
    <center><a href="tambah_produk.php">+ &nbsp; Tambah Produk</a><center>
    <br/>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Gambar</th>
          <th>Jumlah</th>
          <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM produk ORDER BY idbarang ASC";
      $result = mysqli_query($koneksi, $query);
      //mengecek apakah ada error ketika menjalankan query
      if(!$result){
        die ("Query Error: ".mysqli_errno($koneksi).
           " - ".mysqli_error($koneksi));
      }
      
      //buat perulangan untuk element tabel dari data mahasiswa
      $no = 1; //variabel untuk membuat nomor urut
      // hasil query akan disimpan dalam variabel $data dalam bentuk array
      // kemudian dicetak dengan perulangan while
      while($row = mysqli_fetch_assoc($result))
      {
      ?>
  
       <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama']; ?></td>
          <td>Rp <?php echo number_format($row['harga'],0,',','.'); ?></td>
          <td style="text-align: center;"><img src="image/<?php echo $row['foto']; ?>" style="width: 120px;"></td>
          <td><?php echo $row['quantity']; ?></td>
          <td>
              <a href="edit_barang.php?idbarang=<?php echo $row['idbarang']; ?>">Edit</a> |
              <a href="proses_hapus.php?idbarang=<?php echo $row['idbarang']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a> |
              <a href="tampil_barang.php?add=<?php echo $row['idbarang']; ?> ">Beli</a>
              
  
          </td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
   
		<div id="sidebar">
			<div class="title">&raquo; Keranjang Belanja</div>
			<div class="body">
				<?php cart(); ?>
			</div>

	
		</div>

    </tbody>
    </table>
  </body>
</html>