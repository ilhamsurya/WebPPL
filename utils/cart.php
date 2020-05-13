<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
// Mulai sesi
session_start();
require 'koneksi.php';
require 'barang.php';

if(isset($_GET['idbarang']) && !isset($_POST['update']))  { 
    $sql = "SELECT * FROM produk WHERE idbarang=".$_GET['idbarang'];
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_object($result); 
    $item = new Barang();
    $item->id = $product->idbarang;
    $item->name = $product->nama;
    $item->price = $product->harga;
    $iteminstock = $product->quantity;
    $item->quantity = 1;
    //Periksa produk dalam keranjang
    $index = -1;
    $cart = unserialize(serialize($_SESSION['cart']));
    for($i=0; $i<count($cart);$i++)
        if ($cart[$i]->id == $_GET['idbarang']){
            $index = $i;
            break;
        }
        if($index == -1) 
            $_SESSION['cart'][] = $item; //$ _SESSION ['cart']: set $ cart sebagai variabel _session
        else {

            if (($cart[$index]->quantity) < $iteminstock)
                 $cart[$index]->quantity ++;
                 $_SESSION['cart'] = $cart;
        }
}
//Menghapus produk dalam keranjang
if(isset($_GET['index']) && !isset($_POST['update'])) {
    $cart = unserialize(serialize($_SESSION['cart']));
    unset($cart[$_GET['index']]);
    $cart = array_values($cart);
    $_SESSION['cart'] = $cart;
}
// Perbarui jumlah dalam keranjang
if(isset($_POST['update'])) {
  $arrQuantity = $_POST['quantity'];
  $cart = unserialize(serialize($_SESSION['cart']));
  for($i=0; $i<count($cart);$i++) {
     $cart[$i]->quantity = $arrQuantity[$i];
  }
  $_SESSION['cart'] = $cart;
}
?>
<h2> Keranjang:  </h2> 
<form method="POST">
<table id="t01">
<tr>
   
    <th>Id</th>
    <th>Nama</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Total</th>

    <th>Edit</th>
</tr>
<?php 
     $cart = unserialize(serialize($_SESSION['cart']));
     $s = 0;
     $index = 0;
    for($i=0; $i<count($cart); $i++){
        $s += $cart[$i]->price * $cart[$i]->quantity;
 ?> 
   <tr style="item-align:center">
 
        
        <td> <?php echo $cart[$i]->id; ?> </td>
        <td> <?php echo $cart[$i]->name; ?> </td>
        <td>Rp. <?php echo $cart[$i]->price; ?> </td>
        <td> <input type="number" min="1" value="<?php echo $cart[$i]->quantity; ?>" name="quantity[]"> </td>  
        <td> Rp.<?php echo $cart[$i]->price * $cart[$i]->quantity; ?> </td> 
        <td><a href="cart.php?index=<?php echo $index; ?>" onclick="return confirm('Hapus Produk')" >Delete</a> </td>
   </tr>
    <?php 
        $index++;
    } ?>
    <tr>
    

        <td colspan="5" style="text-align:right; font-weight:bold">Subtotal 
         <input type="hidden" name="update">
        
        </td>
        <td> Rp.<?php echo $s; ?> </td>
        <a>
        <input id="saveimg" type="image" src="images/save.png" name="update" alt="">Simpan
        </a>
        
    </tr>

</table>
</form>
<br>
<a href="template.php">Belanja lagi</a> | <a href="checkout.php">Checkout</a>
<?php 
if(isset($_GET["id"]) || isset($_GET["index"])){
 header('Location: cart.php');
} 
?>
</body>
 </html>