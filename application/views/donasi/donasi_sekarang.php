  <div class="container">
    <div class="text-center">
      <h1 class="h4 text-gray-900 mb-4">YUK DONASI</h1>
    </div>
<form class="donasi" action="<?= base_url('donasi/donasi_sekarang'); ?>" method="post">
  <div class="form-row">
    <div class="form-group col-md-6 ">
      <label for="donatur" >Nama</label>
      <input type="text" class="form-control" id="donatur" name="donatur" placeholder="Full Name" value="<?= set_value('donatur') ?>">
<?= form_error('donatur', '<small class = "text-danger pl-3">','</small>'); ?>
    </div>
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="text" class="form-control " id="email" name="email" placeholder="Email Address"value="<?= set_value('email') ?>">
      <?= form_error('email', '<small class = "text-danger pl-3">','</small>'); ?></div>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <input type="text" class="form-control " id="alamat" name="alamat" placeholder="alamat" value="<?= set_value('alamat') ?>">
    <?= form_error('alamat', '<small class = "text-danger pl-3">','</small>'); ?></div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="program">Program Donasi</label>
      <select id="program" class="form-control" id="program" name="program" >
        <option selected>Pilih program ..</option>
        <option>Bencana Alam</option>
        <option>Kesehatan</option>
        <option>Tempat Ibadah</option>
        <option>Pendidikan</option>
  <?= form_error('program', '<small class = "text-danger pl-3">','</small>'); ?>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="jumlah_donasi">Masukan jumlah donasi (Rp)</label>
      <input type="text" class="form-control " id="jumlah_donasi" name="jumlah_donasi" placeholder="jumlah donasi" value="<?= set_value('jumlah_donasi') ?>">
        <?= form_error('jumlah_donasi', '<small class = "text-danger pl-3">','</small>'); ?>
      </div>
  </div>
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="Mpembayaran">Pilih Metode Pembayaran</label>
    <select id="Mpembayaran" class="form-control" id="Mpembayaran" name="Mpembayaran">
        <?= form_error('Mpembayaran', '<small class = "text-danger pl-3">','</small>'); ?>
      <option selected>Pilih metode pembayaran..</option>
      <option>BCA Virtual Account</option>
    </select>
  </div>
  </div>
  <hr>
  <div class="form-group">
  </div>
<a href="<?= base_url('donasi/pembayaran'); ?>" class="btn btn-primary btn-user btn-block">Lanjut</a>
</form>
