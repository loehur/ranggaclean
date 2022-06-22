<?php

class Rekap extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'penjualan';
   }

   public function i($mode)
   {
      $dataTanggal = array();
      $data_main = array();

      switch ($mode) {
         case 1:
            $data_operasi = ['title' => 'Harian - Rekap'];
            $viewData = 'rekap/rekap_harian';

            if (isset($_POST['Y'])) {
               $today = $_POST['Y'] . "-" . $_POST['m'] . "-" . $_POST['d'];
               $dataTanggal = array('tanggal' => $_POST['d'], 'bulan' => $_POST['m'], 'tahun' => $_POST['Y']);
            } else {
               $today = date('Y-m-d');
            }
            break;
         case 2:
            $data_operasi = ['title' => 'Bulanan - Rekap'];
            $viewData = 'rekap/rekap_bulanan';

            if (isset($_POST['Y'])) {
               $today = $_POST['Y'] . "-" . $_POST['m'];
               $dataTanggal = array('bulan' => $_POST['m'], 'tahun' => $_POST['Y']);
            } else {
               $today = date('Y-m');
            }
            break;
      }

      //PENDAPATAN
      $where = $this->wCabang . " AND bin = 0 AND insertTime LIKE '%" . $today . "%'";
      $data_main = $this->model('M_DB_1')->get_where($this->table, $where);
      $this->view('layout', ['data_operasi' => $data_operasi]);

      $cols = "sum(jumlah) as total";
      $where = $this->wCabang . " AND jenis_transaksi = 1 AND status_mutasi = 3 AND insertTime LIKE '%" . $today . "%'";
      $kas_laundry = 0;
      $kas_laundry = $this->model('M_DB_1')->get_cols_where("kas", $cols, $where, 0)['total'];

      $where = $this->wCabang . " AND jenis_transaksi = 3 AND status_mutasi = 3 AND insertTime LIKE '%" . $today . "%'";
      $kas_member = 0;
      $kas_member = $this->model('M_DB_1')->get_cols_where("kas", $cols, $where, 0)['total'];

      //PENGELUARAN
      $cols = "note_primary, sum(jumlah) as total";
      $where = $this->wCabang . " AND jenis_transaksi = 4 AND status_mutasi = 3 AND insertTime LIKE '%" . $today . "%' GROUP BY note_primary";
      $kas_keluar = $this->model('M_DB_1')->get_cols_where("kas", $cols, $where, 1);

      $this->view($viewData, ['data_main' => $data_main, 'dataTanggal' => $dataTanggal, 'kasLaundry' => $kas_laundry, 'kasMember' => $kas_member, 'kas_keluar' => $kas_keluar]);
   }
}
