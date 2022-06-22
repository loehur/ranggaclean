<?php

class Gaji extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'penjualan';
   }

   public function index()
   {
      $user['id'] = 0;
      $user['kasbon'] = 0;
      $dataTanggal = array();
      //KINERJA
      if (isset($_POST['m'])) {
         $user['id'] = $_POST['user'];
         $date = $_POST['Y'] . "-" . $_POST['m'];
         $dataTanggal = array('bulan' => $_POST['m'], 'tahun' => $_POST['Y']);
      } else {
         $date = date('Y-m');
      }
      $table = "operasi";
      $tb_join = $this->table;
      $join_where = "operasi.id_penjualan = penjualan.id_penjualan";
      $where = "operasi.id_laundry = " . $this->id_laundry . " AND penjualan.bin = 0 AND operasi.id_user_operasi = " . $user['id'] . " AND operasi.insertTime LIKE '" . $date . "%'";
      $data_operasi = ['title' => 'Gaji Bulanan - Rekap'];
      $data_main = $this->model('M_DB_1')->innerJoin1_where($table, $tb_join, $join_where, $where);

      $cols = "id_user, id_cabang, COUNT(id_user) as terima";
      $where = $this->wLaundry . " AND insertTime LIKE '" . $date . "%' GROUP BY id_user, id_cabang";
      $data_terima = $this->model('M_DB_1')->get_cols_where($this->table, $cols, $where, 1);

      $cols = "id_user_ambil, id_cabang, COUNT(id_user_ambil) as kembali";
      $where = $this->wLaundry . " AND tgl_ambil LIKE '" . $date . "%' GROUP BY id_user_ambil, id_cabang";
      $data_kembali = $this->model('M_DB_1')->get_cols_where($this->table, $cols, $where, 1);
      $viewData = 'rekap/rekap_gaji_bulanan';

      //KASBON
      $cols = "sum(jumlah) as total";
      $where = $this->wCabang . " AND jenis_transaksi = 5 AND jenis_mutasi = 2 AND metode_mutasi = 1 AND status_transaksi = 0 AND id_client = " . $user['id'];
      $user['kasbon'] = $this->model('M_DB_1')->get_cols_where("kas", $cols, $where, 0)['total'];

      $this->view('layout', ['data_operasi' => $data_operasi]);
      $this->view($viewData, ['data_main' => $data_main, 'dataTanggal' => $dataTanggal, 'dTerima' => $data_terima, 'dKembali' => $data_kembali, 'user' => $user]);
   }

   public function set_gaji_laundry()
   {
      $penjualan = $_POST['penjualan'];
      $id_layanan = $_POST['layanan'];
      $id_user = $_POST['id_user'];
      $fee = $_POST['fee'];

      $cols = 'id_cabang, id_karyawan, jenis_penjualan, id_layanan, gaji_laundry';
      $vals = $this->id_cabang . "," . $id_user . "," . $penjualan . "," . $id_layanan . "," . $fee;

      $setOne = "id_karyawan = " . $id_user . " AND jenis_penjualan = " . $penjualan . " AND id_layanan = " . $id_layanan;
      $where = $this->wCabang . " AND " . $setOne;
      $data_main = $this->model('M_DB_1')->count_where('gaji_laundry', $where);

      if ($data_main < 1) {
         print_r($this->model('M_DB_1')->insertCols('gaji_laundry', $cols, $vals));
         $this->dataSynchrone();
      }
   }
}
