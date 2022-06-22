<?php

class SetDurasi extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'durasi_client';
   }

   public function i($page)
   {
      $data_main = array();
      $z = array();
      $view = 'setHarga/durasi';
      foreach ($this->dPenjualan as $a) {
         if ($a['id_penjualan_jenis'] == $page) {
            $data_operasi = ['title' => 'Durasi ' . $a['penjualan_jenis']];
            $z = array('set' => 'Durasi ' . $a['penjualan_jenis'], 'page' => $page);
         }
      }
      $where = $this->table . "." . $this->wLaundry . " AND id_penjualan_jenis = " . $page;
      $data_main = $this->model('M_DB_1')->get_where($this->table, $where);
      $setOne = 'id_penjualan_jenis = ' . $page;
      $where = $this->wLaundry . " AND " . $setOne;
      $d2 = $this->model('M_DB_1')->get_where('item_group', $where);
      $this->view('layout', ['data_operasi' => $data_operasi]);
      $this->view($view, ['data_main' => $data_main, 'd2' => $d2, 'z' => $z]);
   }

   public function insert($page)
   {
      $cols = 'id_laundry, id_item_group, id_penjualan_jenis, id_durasi, hari, jam';
      $vals = $this->id_laundry . "," . $_POST['f0'] . "," . $page . "," . $_POST['f1'] . "," . $_POST['f2'] . "," . $_POST['f3'];
      $setOne = 'id_durasi = ' . $_POST['f1'] . ' AND id_penjualan_jenis =' . $page . ' AND id_item_group =' . $_POST['f0'];
      $where = $this->wLaundry . " AND " . $setOne;
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
         $col = "hari";
      } elseif ($mode == 2) {
         $col = "jam";
      }

      $set = $col . " = '" . $value . "'";
      $where = $this->wLaundry . " AND id_durasi_client  = " . $id;
      $this->model('M_DB_1')->update($this->table, $set, $where);
   }
}
