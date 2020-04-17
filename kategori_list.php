<div class="span6">
	<table class="table table-striped ">
		<thead>
			<tr>
				<td>Idbarang</td>
				<th>Nama</th>
				<th>Harga</th>
					
				<th>Foto</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
<?php
require('koneksi.php');
$query="SELECT * from produk";
$biodata = mysqli_query($conn, $query);
$no=1;
//proses menampilkan data
while($rows=mysqli_fetch_array($biodata,MYSQLI_ASSOC)){
?>  
<tr>
				<td><?=$no;?></td>
				<td><?=$rows['nama']?></td>
				<td><span class="label label-success">Rp.<?=$rows['harga']?></span></td>
                <td><a href="#" class="thumbnail"> <img src="image/<?=$rows['foto']?>" alt=""></a></td>
                <td><a href='detail.php?idbarang="<?=$rows['idbarang']?>"'>Lihat Detail</a></td> 
                <td><a href='detail.php?idbarang="<?=$rows['idbarang']?>"'>Hapus</a></td> 
                <td><a href='detail.php?idbarang="<?=$rows['idbarang']?>"'>Update</a></td> 
			
			</tr>
            
<?php
$no++;
}
?>
		</tbody>
	</table>
</div>