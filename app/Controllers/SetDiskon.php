<?php

class SetDiskon extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'diskon_set';
   }

   // ---------------- INDEX -------------------- //
   public function i()
   {
      $view = 'setHarga/diskon';
      $where = $this->table . "." . $this->wLaundry;
      $data_main = $this->model('M_DB_1')->get_where($this->table, $where);
      $data_operasi = ['title' => 'Diskon Khusus'];
      $this->view('layout', ['data_operasi' => $data_operasi]);
      $this->view($view, ['data_main' => $data_main]);
   }

   public function insert()
   {
      $cols = 'id_laundry, id_penjualan_jenis, qty_disc, disc_qty, disc_partner';
      $vals = $this->id_laundry . "," . $_POST['f1'] . "," . $_POST['f3'] . "," . $_POST['f4'];
      $setOne = 'id_penjualan_jenis = ' . $_POST['f1'];
      $where = $this->wLaundry . " AND " . $setOne;
      $data_main = $this->model('M_DB_1')->count_where($this->table, $where);
      if ($data_main < 1) {
         $this->model('M_DB_1')->insertCols($this->table, $cols, $vals);
         $this->dataSynchrone();
      }
   }

   public function updateCell()
   {
      $id = $_POST['id'];
      $value = $_POST['value'];
      $mode = $_POST['mode'];

      if ($mode == 2) {
         $col = "qty_disc";
      } elseif ($mode == 3) {
         $col = "disc_qty";
      } elseif ($mode == 4) {
         $col = "disc_partner";
      }

      $set = $col . " = '" . $value . "'";
      $where = $this->wLaundry . " AND id_diskon = " . $id;
      $this->model('M_DB_1')->update($this->table, $set, $where);
      $this->dataSynchrone();
   }
}
