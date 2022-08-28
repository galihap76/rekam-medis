<?php
include_once '../config/koneksi.php';
$obat = mysqli_query($db, "SELECT * FROM obat");
?>                  
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Obat</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                           
                            <div class="d-flex justify-content-between mb-4">

                                <div>
                                <button type="button" class="btn btn-success mr-3"  data-bs-toggle="modal" data-bs-target="#tambahObat"><i class="bi bi-plus-circle"></i> Tambah Obat </button>
                                </div>

                                <div>
                                <a href='../print/printObat.php' target="_blank"><button type="button" class="btn btn-success"><i class="bi bi-printer"></i> Cetak Obat </button></a>
                                </div>

                            </div>

                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th style="display:none;">No</th>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Stok</th>
                                            <th>Satuan</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    while($data = mysqli_fetch_assoc($obat)){
                                        $link_delete = "<a class='btn btn-danger mb-1 hapusData' href='deleteDataObat.php?no=" . $data['no'] . "'>Delete</a>";
                                        $link_update = "<a class='btn btn-warning mb-1 updateData' data-bs-toggle='modal' data-bs-target='#editObat' href='updateData.php?no=" . $data['no'] . "'>Update</a>";
                                        ?>
                                        <tr>
                                        <td style="display:none;"><?php echo $data['no']; ?></td>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $data['nama_obat']; ?></td>
                                            <td><?php echo $data['stok']; ?></td>
                                            <td><?php echo $data['satuan']; ?></td>
                                            <td><?php echo $data['tanggal_masuk']; ?></td>
                                            <td><?php echo "<center>$link_delete $link_update</center>"; ?></td>
                                           
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