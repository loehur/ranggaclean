<?php

class Cabang_List extends Controller
{

   public function __construct()
   {
      $this->session_cek();
      $this->data();
   }
   public function index()
   {
      $data_operasi = ['title' => 'Data Cabang'];

      $table = 'cabang';
      $where = "cabang." . $this->wLaundry;
      $data_cabang = $this->model('M_DB_1')->get_where($table, $where);

      $this->view('layout', ['data_operasi' => $data_operasi]);
      $this->view('data_list/cabang', ['data_cabang' => $data_cabang]);
   }

   public function insert()
   {
      $table  = 'cabang';
      $columns = 'id_laundry, id_kota, alamat, kode_cabang';
      $values = $this->id_laundry . ",'" . $_POST["kota"] . "','" . $_POST["alamat"] . "','" . $_POST["kode_cabang"] . "'";
      $this->model('M_DB_1')->insertCols($table, $columns, $values);
      $this->dataSynchrone();
   }

   public function selectCabang()
   {
      $id_cabang = $_POST['id'];
      $table  = 'user';
      $set = "id_cabang = " . $id_cabang;
      $where = $this->wUser . " AND " . $this->wLaundry;
      $this->model('M_DB_1')->update($table, $set, $where);
      $this->dataSynchrone();
   }

   public function update()
   {
      $table  = 'cabang';
      $id = $_POST['id'];
      $value = $_POST['value'];
      $mode = $_POST['mode'];

      if ($mode == 1) {
         $kolom = "kode_cabang";
      } elseif ($mode == 2) {
         $kolom = "alamat";
      } else {
         $kolom = "id_kota";
      }
      $set = "$kolom = '$value'";
      $where = $this->wLaundry . " AND id_cabang = $id";
      $this->model('M_DB_1')->update($table, $set, $where);
      $this->dataSynchrone();
   }
}
