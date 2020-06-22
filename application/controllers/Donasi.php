<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
{
    public function __construct()
    {
      date_default_timezone_set("Asia/Jakarta");

        parent::__construct();
        is_logged_in();
        if ($this->session->userdata('role_id') == null) {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          this session has expired, please login again!
            </div>');
          redirect("auth");
      }

    }

    public function index()
    {

      $data['title'] = 'Donasi Sekarang';
      $data['user'] =  $this->db->get_where('user', ['email' =>
      $this->session->userdata('email')])->row_array();

      $data['donatur'] = $this->db->get('tbl_donatur')->result_array();

      $this->db->order_by("date_trx", "asc");
      $data['donasi'] = $this->db->get('tbl_transaksi')->result_array();

      $this->db->select_sum('nominal');
      $data['total_donasi'] = $this->db->get('tbl_transaksi')->row_array();

      $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('alamat', 'Alamat', 'required');
      $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
      $this->form_validation->set_rules('nominal', 'Nominal', 'required');


      if ($this->form_validation->run() == false) {
          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar', $data);
          $this->load->view('templates/topbar', $data);
          $this->load->view('donasi/index', $data);
          $this->load->view('templates/footer');
      } else {
          $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
          $kas =  $this->db->get_where('kas', ['id_transaksi' => $idtransaksi])->row_array();
          if ($kas) {
              $idtransaksi = date("dmY") . '-' . rand(0000, 9999);
          }
          $anggota =  $this->db->get_where('tbl_donatur', ['id' => $this->input->post('nama')])->row_array();
          $data_dn = [
              'nama' => $this->input->post('nama'),
              'alamat' => $this->input->post('alamat'),
          ];
          $data = [
              'id_transaksi' => $idtransaksi,
              'nama_transaksi' => 'Donasi A/n ' . $anggota['nama'],
              'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal')),
              'date_trx' =>  $this->input->post('tanggal'),
              'id_anggota' =>  $this->input->post('nama'),
              'jenis' => 'kas masuk'

          ];

          $data_kas = [
              'id_transaksi' => $idtransaksi,
              'tipe_kas' => 'masuk',
              'keterangan' => $this->input->post('keterangan'),
              'tgl_transaksi' => $this->input->post('tanggal'),
              'nominal' => preg_replace('/[^0-9]/', '', $this->input->post('nominal'))
          ];
          $this->db->insert('tbl_donatur', $data_dn);
          $this->db->insert('kas', $data_kas);
          $this->db->insert('tbl_transaksi', $data);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         Tambah Donasi A/n ' . $anggota['nama'] . '  Berhasil!
        </div>');
          redirect('donasi/pembayaran');
      }

    }

      public function pembayaran()
      {

          $data['title'] = 'Pembayaran';
          $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



              $this->load->view('templates/header', $data);
              $this->load->view('templates/sidebar', $data);
              $this->load->view('templates/topbar', $data);
              $this->load->view('donasi/pembayaran', $data);
              $this->load->view('templates/footer');



          }


    }
