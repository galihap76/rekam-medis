<?php
include_once '../config/koneksi.php';
$pasien = mysqli_query($db, "SELECT * FROM pasien");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pasien</title>
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
          
          <h3 class="text-center">Data Pasien</h3>
          <table class="table table-bordered border-dark">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nomor Identitas</th>
                    <th scope="col">Nama Pasien</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Telepon</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    while($data = mysqli_fetch_assoc($pasien)){  
                    ?>

                    <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nomor_identitas']; ?></td>
                    <td><?php echo $data['nama_pasien']; ?></td>
                    <td><?php echo $data['jenis_kelamin']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>   
                    <td><?php echo $data['no_telepon']; ?></td>
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