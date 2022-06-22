<?php

class Laundry_List extends Controller
{


   public function __construct()
   {
      $this->session_cek();
      $this->data();
   }

   public function index()
   {
      $data_operasi = ['title' => 'Data Laundry'];
      $where = $this->wUser;
      $data = $this->model('M_DB_1')->get_where('laundry', $where);
      $this->view('layout', ['data_operasi' => $data_operasi]);
      $this->view('data_list/laundry', ['data_laundry' => $data]);
   }

   function generateRandomString($length)
   {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
   }

   public function insert()
   {
      $table  = 'laundry';
      $columns = 'nama_laundry, id_user, notif_token';
      $values = "'" . $_POST["nama"] . "', '" . $this->id_user . "','" . $this->generateRandomString(25) . "'";
      $this->model('M_DB_1')->insertCols($table, $columns, $values);
      $this->dataSynchrone();
   }

   public function update()
   {
      $table  = 'laundry';
      $id = $_POST['id'];
      $nama = $_POST['nama'];

      $set = "nama_laundry = '$nama'";
      $where = $this->wUser . " AND id_laundry =" . $id;
      $this->model('M_DB_1')->update($table, $set, $where);
      $this->dataSynchrone();
   }

   public function selectLaundry()
   {
      $table  = 'user';
      $id_laundry = $_POST['id'];
      $set = "id_laundry = " . $id_laundry;
      $where = $this->wUser . " AND " . $this->wLaundry;
      $this->model('M_DB_1')->update($table, $set, $where);
      $this->dataSynchrone();
   }
}
