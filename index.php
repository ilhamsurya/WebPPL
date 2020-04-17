<?php
  // defenisikan koneksi
  require('koneksi.php');
 ?>
<!DOCTYPE html>
<html lang="id" dir="ltr">
  
  <head>
  <link rel="stylesheet" type="text/css"
href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
    <title>PR Detail Page</title>
  </head>
  <body>
  <table >
    <h3>Tabel Biodata</h3>


<form action="input.php" method="GET">

<input type="submit" value="Tambah" name="btn" class="btn btn-sm btn-primary">
</form>
  
  
    <?php
      if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        echo "<b>Hasil pencarian : ".$cari."</b>";
      }
      

      // Tampil Data 
      
      $sql = "SELECT * FROM mahasiswa ORDER BY Nim DESC";
      // Nampung data dari sql ke variable baru
      $biodata = mysqli_query($conn, $sql);
      // variable untuk membuat tabel HTML
      $strTbl = "";
      $strTbl .= "<table class='table table-striped table-responsive' border='1' >";

      $strTbl .= "<th>Nim</th>";
      $strTbl .= "<th>Nama</th>";
      $strTbl .= "<th>Umur</th>";
      $strTbl .= "<th>Email</th>";
      $strTbl .= "<th>Hp</th>";
      $strTbl .= "<th>Gender</th>";
      $strTbl .= "<th>Edit</th>";
      $strTbl .= "</tr>";
      // variable nomor urut
      $nomor = 1;
      

      if (mysqli_num_rows($biodata) > 0) {
    
        while ($data = mysqli_fetch_assoc($biodata)) {
        
          $strTbl .= "<tr>";
      
          $strTbl .= "<td>". $data['Nim'] ."</td>";
          $strTbl .= "<td>". $data['Nama'] ."</td>";
          $strTbl .= "<td>". $data['Umur'] ."</td>";
          $strTbl .= "<td>". $data['email'] ."</td>";
          $strTbl .= "<td>". $data['hp'] ."</td>";
          $strTbl .= "<td>". $data['gender'] ."</td>";
          $strTbl .= "<td><a href='detail.php?Nim=".$data['Nim']."'>Lihat Detail</a>  <a href='update.php?Nim=".$data['Nim']."'>Edit</a>  <a href='javascript:hapusData(".$data['Nim'].")'>Hapus Data</a></td> " ;
          $strTbl .= "</tr>";
          $nomor++;
        }
      } else {

        $strTbl .="<tr><td colspan='4'>ERROR LOADING BRO</td></tr>";
      }
      $strTbl .= "</table>";

      print($strTbl);
      
     ?>
     <p>11/03/20</p>
      
     <script language="JavaScript" type="text/javascript">
      function hapusData(nim){
        if (confirm("Apakah anda yakin akan menghapus data ini?")){
          window.location.href = 'hapus.php?Nim=' + nim;
        }
      }
    </script>
  </body>
</html>