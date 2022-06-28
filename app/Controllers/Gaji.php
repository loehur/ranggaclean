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
      $viewData = 'gaji/rekap_gaji_bulanan';

      $user['id'] = 0;
      $user['kasbon'] = 0;
      $dataTanggal = array();
      $dataGajiLaundry = array();
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

      //KASBON
      $cols = "sum(jumlah) as total";
      $where = $this->wCabang . " AND jenis_transaksi = 5 AND jenis_mutasi = 2 AND metode_mutasi = 1 AND status_transaksi = 0 AND id_client = " . $user['id'];
      $user['kasbon'] = $this->model('M_DB_1')->get_cols_where("kas", $cols, $where, 0)['total'];

      $this->view('layout', ['data_operasi' => $data_operasi]);

      $this->view($viewData, [
         'data_main' => $data_main,
         'dataTanggal' => $dataTanggal,
         'dTerima' => $data_terima,
         'dKembali' => $data_kembali,
         'user' => $user,
         'gajiLaundry' => $dataGajiLaundry
      ]);
   }

   public function set_gaji_laundry()
   {
      $penjualan = $_POST['penjualan'];
      $id_layanan = $_POST['layanan'];
      $id_user = $_POST['id_user'];
      $fee = $_POST['fee'];
      $target = $_POST['target'];
      $bonus_target = $_POST['bonus_target'];

      $cols = 'id_laundry, id_karyawan, jenis_penjualan, id_layanan, gaji_laundry, target, bonus_target';
      $vals = $this->id_laundry . "," . $id_user . "," . $penjualan . "," . $id_layanan . "," . $fee . "," . $target . "," . $bonus_target;

      $setOne = "id_karyawan = " . $id_user . " AND jenis_penjualan = " . $penjualan . " AND id_layanan = " . $id_layanan;
      $where = $this->wLaundry . " AND " . $setOne;
      $data_main = $this->model('M_DB_1')->count_where('gaji_laundry', $where);

      if ($data_main < 1) {
         print_r($this->model('M_DB_1')->insertCols('gaji_laundry', $cols, $vals));
         $this->dataSynchrone();
      }
   }

   public function set_gaji_pengali()
   {
      $id_pengali = $_POST['pengali'];
      $id_user = $_POST['id_user'];
      $fee = $_POST['fee'];

      $cols = 'id_laundry, id_karyawan, id_pengali, gaji_pengali';
      $vals = $this->id_laundry . "," . $id_user . "," . $id_pengali . "," . $fee;

      $setOne = "id_karyawan = " . $id_user . " AND id_pengali = " . $id_pengali;
      $where = $this->wLaundry . " AND " . $setOne;
      $data_main = $this->model('M_DB_1')->count_where('gaji_pengali', $where);

      if ($data_main < 1) {
         print_r($this->model('M_DB_1')->insertCols('gaji_pengali', $cols, $vals));
         $this->dataSynchrone();
      }
   }

   public function updateCell()
   {
      $table  = $_POST['table'];
      $id = $_POST['id'];
      $value = $_POST['value'];
      $col = $_POST['col'];

      $where = "";
      switch ($table) {
         case 'gaji_laundry':
            $where = $this->wLaundry . " AND id_gaji_laundry = " . $id;
            break;
         case 'gaji_pengali':
            $where = $this->wLaundry . " AND id_gaji_pengali = " . $id;
            break;
      }

      $set = $col . " = '" . $value . "'";
      $this->model('M_DB_1')->update($table, $set, $where);
      $this->dataSynchrone();
   }
}
