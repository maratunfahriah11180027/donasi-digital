<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card border-left-primary shadow h-100 py-2 mb-4 col-md-4">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Donasi</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_donasi['nominal']) ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-fw fa-coins fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
          </div>') ?>
            <?= $this->session->flashdata('message') ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewDonasi"><i class="fas fa-fw fa-coins"></i> Tambah Donasi</a>
            <div style="width:100%; overflow:scroll; height:400px;">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Transaksi</th>
                            <th scope="col">Tanggal transaksi</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($donasi as $d) :
                            $date = date_create($d['date_trx']);

                        ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <?php if ($user['role_id'] == 3) { ?>
                                    <td><?= substr($d['nama_transaksi'], 0, 9) ?> ****************</td>
                                <?php } else { ?>
                                    <td><?= $d['nama_transaksi'] ?></td>

                                <?php } ?>
                                <td><?= date_format($date,"d F Y") ?></td>
                                <td> <?= number_format($d['nominal'],0,',','.') ?></td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#deleteDonasi<?= $d['id_transaksi'] ?>" class="badge badge-danger">Delete</a>
                                    <a href="<?= base_url('admin/cetak?id=') . $d['id'] ?>" rel="noopener noreferrer" target="#blank" class="badge badge-warning">Print</a>

                                </td>
                            </tr>
                            <!--delete donasi-->
                            <div class="modal fade" id="deleteDonasi<?= $d['id_transaksi'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Donasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus Donatur A/n <?= $d['nama_transaksi'] ?></p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('admin/deletedonasi?id=') ?><?= $d['id_transaksi'] ?>" class="btn btn-primary">Hapus</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php $i++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!--modal-->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="addNewDonasi" tabindex="-1" role="dialog" aria-labelledby="addNewDonasiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewDonasiLabel">Tambah donasi baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/donasi') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewDonatur">Tambah donatur</a>

                    </div>
                    <div class="form-group">
                        <select class="form-control" id="nama" name="nama">
                            <option value="">- Silahkan masukkan nama donatur -</option>
                            <?php foreach ($donatur as $a) : ?>
                                <option value="<?= $a['id'] ?>"><?= $a['nama'] ?> - <?= $a['alamat'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <input class="form-control" type="date"  id="tanggal" name="tanggal">
                    </div>

                    <div class="input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping">Rp</span>
                        </div>
                        <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal" aria-label="Nominal" aria-describedby="addon-wrapping">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Donatur -->
<div class="modal fade" id="addNewDonatur" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewDonaturLabel">Add new donatur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addDonatur') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="deleteNewDonasi" tabindex="-1" role="dialog" aria-labelledby="deleteNewDonasiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteNewDonasiLabel">Are you sure to delete ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('admin/delete') ?>">Delete</a>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.mask.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Format mata uang.
        $('.uang').mask('0.000.000.000', {
            reverse: true
        });

        // Format nomor HP.
        $('.no_hp').mask('0000−0000−0000');

        // Format tahun pelajaran.
        $('.tapel').mask('0000/0000');
    })
</script>
