<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Data Produk</title>
    <style type="text/css">
      * {
        font-family: "Trebuchet MS";
      }
      h1 {
        text-transform: uppercase;
        color: darkblue;
      }
    table {
      border: solid 1px #DDEEEE;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }
    table thead th {
        background-color: #DDEFEF;
        border: solid 1px #DDEEEE;
        color: #336B6B;
        padding: 10px;
        text-align: left;
        text-shadow: 1px 1px 1px #fff;
        text-decoration: none;
    }
    table tbody td {
        border: solid 1px #DDEEEE;
        color: #333;
        padding: 10px;
        text-shadow: 1px 1px 1px #fff;
    }
    a {
          background-color: lightseagreen;
          color: #fff;
          padding: 10px;
          text-decoration: none;
          font-size: 12px;
    }
    </style>
  </head>
  <body>
  
    <center><h1>Data Produk</h1><center><hr><br>
    <br/> 
    <form method="POST" action=""> 
      Cari <input type=text name=cari >
      <input type="submit" value=cari name=kirim>
    </form>
    
      <table>
    
    <?php
      if (isset($_POST['cari']))
      {
        echo "search : ";
        echo "$_POST[cari] <br><br>";
        include "koneksi.php";
        $data = mysqli_query($koneksi,"select * FROM produk where nama_produk LIKE '%$_POST[cari]%'");
        echo "<tr> <th>PRODUK<hr></th> <th>DESKRIPSI<hr></th> <th>STOK<hr> </th> <th>HARGA JUAL<hr> </th>";
        while( $d = mysqli_fetch_object($data))
        echo "<tr> <th>$d->nama_produk</th> <th>$d->deskripsi</th> <th> $d->stok </th> <th>Rp $d->harga_jual</tr> <br>";        
        
      }
      
      
    ?>
    </table>
    <table>
      <thead>
        <tr><br>
          <th>No</th>
          <th>Produk</th>
          <th>Dekripsi</th>
          <th>Stok</th>
          <th>Harga Jual</th>
          <th>Gambar</th>
        </tr>
    </thead>
    <tbody>
      <?php
      // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
      $query = "SELECT * FROM produk ORDER BY id ASC";
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
          <td><?php echo $row['nama_produk']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?></td>
          <td><?php echo $row['stok']; ?></td>
          <td>Rp <?php echo number_format($row['harga_jual'],0,',','.'); ?></td>
          <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 120px;"></td>
      </tr>
         
      <?php
        $no++; //untuk nomor urut terus bertambah 1
      }
      ?>
    </tbody>
    </table>
  </body>
</html>
