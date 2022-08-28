<?php
include_once '../config/koneksi.php';
$pasien = mysqli_query($db, "SELECT * FROM pasien");
?>                  
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <a href='../print/printPasien.php' target="_blank"><button type="button" class="btn btn-success mb-3"><i class="bi bi-printer"></i> Cetak Pasien </button></a>
                  
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th style="display:none;">Id</th>
                                            <th>No</th>
                                            <th>Nomor Identitas</th>
                                            <th>Nama Pasien</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Alamat</th>
                                            <th>No Telepon</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    while($data = mysqli_fetch_assoc($pasien)){
                                        $link_delete = "<a class='btn btn-danger mb-1 hapusData' href='deleteData.php?id=" . $data['id'] . "'>Delete</a>";
                                        $link_update = "<a class='btn btn-warning mb-1 updateData' data-bs-toggle='modal' data-bs-target='#editPasien' href='updateData.php?id=" . $data['id'] . "'>Update</a>";
                                        ?>
                                        <tr>
                                        <td style="display:none;"><?php echo $data['id']; ?></td>
                                            <td><?php echo $i++; ?></td>
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
                        </div>
                    </div>

  <!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
 <!-- Page level custom scripts -->
<script src="../js/demo/datatables-demo.js"></script>