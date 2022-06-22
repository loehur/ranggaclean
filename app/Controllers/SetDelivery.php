<?php

class SetDelivery extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'harga';
   }

   // ---------------- INDEX -------------------- //
   public function i($page)
   {
      $z = array();
      $data_main = array();

      $view = 'setHarga/delivery';
      $data_operasi = ['title' => 'Tarif Delivery'];
      $z = array('unit' => 'km', 'set' => 'Delivery', 'page' => $page);
      $setOne = 'id_penjualan_jenis = ' . $page;

      $where = $this->wLaundry . " AND " . $setOne;
      $data_main = $this->model('M_DB_1')->get_where($this->table, $where);

      $this->view('layout', ['data_operasi' => $data_operasi]);
      $this->view($view, ['data_main' => $data_main, 'z' => $z]);
   }

   public function insert($page)
   {
      $layanan = serialize($_POST['f1']);
      $harga = $_POST['f2'];

      $cols = 'id_laundry, id_penjualan_jenis, list_layanan, harga';
      $vals = $this->id_laundry . "," . $page . ",'" . $layanan . "'," . $harga;

      $setOne = 'id_penjualan_jenis = ' . $page;
      $where = $this->wLaundry . " AND " . $setOne . " AND list_layanan = '$layanan'";
      $data_main = $this->model('M_DB_1')->count_where($this->table, $where);
      if ($data_main < 1) {
         $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
      }
   }

   public function updateCell()
   {
      $id = $_POST['id'];
      $value = $_POST['value'];
      $mode = $_POST['mode'];

      if ($mode == 1) {
         $col = "harga";
      }

      $set = "$col = '$value'";
      $where = $this->wLaundry . " AND id_harga = $id";
      $this->model('M_DB_1')->update($this->table, $set, $where);
   }
}
