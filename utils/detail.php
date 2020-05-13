<?php

require('../koneksi.php');

  if (isset($_GET['Nim'])) {

    $nim = $_GET['Nim'];
  } else {
 
    header('Location:./views/index.php');
  }
 ?>
<!DOCTYPE html>
<html lang="id" dir="ltr">
  <head>
  
    <title>DetailPage</title>
    <link href="../assets/css/style.css" rel="stylesheet">
  </head>
  <body>
    <h2>Biodata Detail</h2>
    <h3>detail:</h3>
    <?php
      // query SQL menampilkan data 
      $sql = "SELECT * FROM mahasiswa WHERE Nim='$nim'";

      $biodata = mysqli_query($conn, $sql);
      // variable untuk membuat tabel HTML
      $strTbl = "";
      $strTbl .= "<table>";
   
      if (mysqli_num_rows($biodata) > 0) {
     
        $data = mysqli_fetch_assoc($biodata);
        $strTbl .= "<tr>";
        $strTbl .= "<td>Nim :</td>";
        $strTbl .= "<td>". $data['Nim'] ."</td>";
        $strTbl .= "</tr>";
        $strTbl .= "<td>Nama :</td>";
        $strTbl .= "<td>". $data['Nama'] ."</td>";
        $strTbl .= "</tr>";
        $strTbl .= "<tr>";
        $strTbl .= "<td>Umur :</td>";
        $strTbl .= "<td>". $data['Umur'] ."</td>";
        $strTbl .= "</tr>";
      } else {
 
        $strTbl .="<tr><td colspan='2'>Gagal Connect</td></tr>";
      }
      $strTbl .= "</table>";
      $strTbl .= "<a href='../template.php'>Kembali ke Index</a>";
  
      print($strTbl);
     ?>

  </body>
</html>