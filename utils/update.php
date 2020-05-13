<?php

  require('../koneksi.php');

  if (isset($_GET['Nim'])) {
  
    $id = $_GET['Nim'];
  } else {
    header('Location:./views/index.php');
  }
  // query sql menampilkan data berdasarkan ID Biodata
  $sql = "SELECT * FROM mahasiswa WHERE Nim='$id'";

  $biodata = mysqli_query($conn, $sql);
  if (mysqli_num_rows($biodata) > 0) {

    $data = mysqli_fetch_assoc($biodata);
  }
  // cek apakah tombol simpan ditekan
  if (isset($_POST['submit'])) {
    // jika iya maka ambil nilai masing-masing field
    $nim    = $_POST['nim'];
    $nama = $_POST['nama'];
    $umur       = $_POST['umur'];
    // query mengupdate data ke database
    $sql = "UPDATE mahasiswa SET Nim='$nim',
          Nama='$nama',
          Umur='$umur' WHERE Nim='$id'";

    if (mysqli_query($conn, $sql)) {
  
      echo "Data berhasil diupdate, refresh halaman untuk melihat perubahan";
    } else {
   
      echo "Ouppsss..., maap proses menyimpan data tidak berhasil";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="id" dir="ltr">
  <head>
    <title>PR Detail Page</title>
    <link href="../assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <h2>PR Detail Page</h2>

    <form action="" method="POST">
      <table>
        <tr>
          <td>Nim</td>
          <td><input type="text" name="nim" value="<?php echo $data['Nim']; ?>"></td>
        </tr>
        <tr>
          <td>Nama </td>
          <td><input type="text" name="nama" value="<?php echo $data['Nama']; ?>"></td>
        </tr>
        <tr>
          <td>Umur</td>
          <td><input type="text" name="umur" value="<?php echo $data['Umur']; ?>"></td>
        </tr>
        <tr>
          <td></td>
          <td><input type='submit' name='submit' value='Update Data'></td>
        </tr>
      </table>
    </form>
     <p><a href="../template.php">Kembali ke Index</a></p>

  </body>
</html>