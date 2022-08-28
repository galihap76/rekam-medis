<?php
include_once '../config/koneksi.php';
$obat = mysqli_query($db, "SELECT * FROM obat");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        @page { size: auto;  margin: 0mm; }
        img{
            width:200px;
            height:200px;        
        }

        th{
            text-align: center;
        }
    </style>
  </head>
  
  <body>
      <div class="container">
          <div class="row text-center">
              <div class="col mb-3">
              <img src="rsia.png"> 
              </div>         
          </div>  
          
          <h3 class="text-center">Data Obat</h3>
          <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Tanggal Masuk</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    while($data = mysqli_fetch_assoc($obat)){  
                    ?>

                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nama_obat']; ?></td>
                    <td><?php echo $data['stok']; ?></td>
                    <td><?php echo $data['satuan']; ?></td>
                    <td><?php echo $data['tanggal_masuk']; ?></td>   
                    </tr>
                   <?php } ?>
                </tbody>
                </table>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
  </body>
</html>