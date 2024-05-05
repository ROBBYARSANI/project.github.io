<?php
  //include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<form action="" method="post">
    <input type="text" name="nama_produk">
    <input type="number" name="pengurang">
    <input type="submit" name="kirim" value="pengurangan">
    <input type="submit" name="kirim" value="penjumlahan">
</form>

<?php

	// membuat variabel untuk menampung data dari form
  $nama_produk   = $_POST['nama_produk'];
$hasil = 0;
  $data = mysqli_query($koneksi,"select * FROM produk where nama_produk LIKE '%$_POST[nama_produk]%'");
  while( $d = mysqli_fetch_object($data))
  {
    $hasil = $d->stok - $_POST['pengurang'];
    echo "<tr> <th>$d->nama_produk</th> <th> $hasil </th><br>";        
  }
  while( $d = mysqli_fetch_object($data))
  {
    $hasil = $d->stok + $_POST['pengurang'];
    echo "<tr> <th>$d->nama_produk</th> <th> $hasil </th><br>";        
  }

  $data = mysqli_query($koneksi,"UPDATE produk SET nama_produk = '$nama_produk', stok = '$hasil' where nama_produk = '$nama_produk'");
  while( $d = mysqli_fetch_object($data))
  {
    echo "<tr> <th>$d->nama_produk</th> <th> $hasil </th><br>";  
  }
?>