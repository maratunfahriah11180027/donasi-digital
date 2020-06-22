<div class="container">
  <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
  <?= $this->session->flashdata('message'); ?>


</div>
<div class="card">
  <div class="card-header">
  <b> <?= $title ?> </b>
  </div>
  <div class="card-body">
    <p class="card-text">

      <?php
      $n =  $this->db->get_where('tbl_transaksi', ['nominal','id_transaksi'])->row_array();

        ?>
    <h4> Anda akan mendonasikan uang sebasar Rp <?= number_format($n['nominal'], 0, ',', '.') ?><br> <br>
         Untuk Pembangunan Masjid An-Nur <hr>
         <b>Total  Rp<?= number_format($n['nominal'], 0, ',', '.') ?> </b> <hr>
</h4>
      <h5> Silakan Transfer ke : </h5> <br>
            <h3> <img src=" <?= base_url('assets/img/logo/bca.png'); ?>" width="100" height="100"> <sup>BCA Virtual Account (1180027190)</sup></h3>

      </p>

      <a href="<?= base_url('donasi'); ?>" class="btn btn-primary btn-user ">Selesai</a>

  </div>

</div>
