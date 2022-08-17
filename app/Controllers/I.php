<?php

class I extends Controller
{
   public function __construct()
   {
      $this->table = 'penjualan';
   }

   public function i($idLaundry, $pelanggan)
   {
      $this->public_data($idLaundry, $pelanggan);
      $operasi = array();
      $kas = array();
      $data_main = array();
      $data_terima = array();
      $data_kembali = array();
      $surcas = array();

      $data_tanggal = array();
      if (isset($_POST['Y'])) {
         $data_tanggal = array('bulan' => $_POST['m'], 'tahun' => $_POST['Y']);
      }

      if (count($data_tanggal) > 0) {
         $bulannya = $data_tanggal['tahun'] . "-" . $data_tanggal['bulan'];
         $where = $this->wLaundry . " AND id_pelanggan = " . $pelanggan . " AND insertTime LIKE '" . $bulannya . "%' AND bin = 0 AND tuntas = 0 ORDER BY id_penjualan DESC";
      } else {
         $where = $this->wLaundry . " AND id_pelanggan = " . $pelanggan . " AND bin = 0 AND tuntas = 0 ORDER BY id_penjualan DESC";
      }

      $data_main = $this->model('M_DB_1')->get_where($this->table, $where);
      $where2 = "id_pelanggan = " . $pelanggan . " AND bin = 0 GROUP BY id_harga";
      $list_paket = $this->model('M_DB_1')->get_where("member", $where2);

      $viewData = 'invoice/invoice_main';
      $numbers = array_column($data_main, 'id_penjualan');
      $refs = array_column($data_main, 'no_ref');

      if (count($numbers) > 0) {
         $min = min($numbers);
         $max = max($numbers);
         $where = $this->wLaundry . " AND id_penjualan BETWEEN " . $min . " AND " . $max;
         $operasi = $this->model('M_DB_1')->get_where('operasi', $where);
      }
      if (count($refs) > 0) {
         $min_ref = min($refs);
         $max_ref = max($refs);
         $where = "jenis_transaksi = 1 AND (ref_transaksi BETWEEN " . $min_ref . " AND " . $max_ref . ")";
         $kas = $this->model('M_DB_1')->get_where('kas', $where);

         //SURCAS
         $where = "no_ref BETWEEN " . $min_ref . " AND " . $max_ref;
         $surcas = $this->model('M_DB_1')->get_where('surcas', $where);
      }

      $data_member = array();
      $where = "bin = 0 AND id_pelanggan = " . $pelanggan;
      $order = "id_member DESC";
      $data_member = $this->model('M_DB_1')->get_where_order('member', $where, $order);

      $numbersMember = array();
      $kasM = array();
      if (count($data_member) > 0) {
         $numbersMember = array_column($data_member, 'id_member');
         $min = min($numbersMember);
         $max = max($numbersMember);
         $where = "jenis_transaksi = 3 AND (ref_transaksi BETWEEN " . $min . " AND " . $max . ")";
         $kasM = $this->model('M_DB_1')->get_where('kas', $where);

         foreach ($data_member as $key => $value) {
            $lunasNya = false;
            $totalNya = $value['harga'];
            $akumBayar = 0;
            foreach ($kasM as $ck) {
               if ($value['id_member'] == $ck['ref_transaksi']) {
                  $akumBayar += $ck['jumlah'];
                  break;
               }
            }
            if ($akumBayar >= $totalNya) {
               $lunasNya = true;
            }
            if ($lunasNya == true) {
               unset($data_member[$key]);
            }
         }
      }

      $this->view($viewData, [
         'pelanggan' => $pelanggan,
         'dataTanggal' => $data_tanggal,
         'data_main' => $data_main,
         'operasi' => $operasi,
         'kas' => $kas,
         'kasM' => $kasM,
         'dTerima' => $data_terima,
         'dKembali' => $data_kembali,
         'listPaket' => $list_paket,
         'laundry' => $idLaundry,
         'data_member' => $data_member,
         'surcas' => $surcas
      ]);
   }

   public function m($idLaundry, $pelanggan, $id_harga)
   {
      $this->public_data($idLaundry, $pelanggan);
      $data_main = array();

      $where = $this->wLaundry . " AND id_pelanggan = " . $pelanggan . " AND id_harga = $id_harga AND bin = 0 AND member = 1 ORDER BY insertTime ASC";
      $data_main = $this->model('M_DB_1')->get_where($this->table, $where);

      $where2 = "id_pelanggan = " . $pelanggan . " AND id_harga = $id_harga AND bin = 0 ORDER BY insertTime ASC";
      $data_main2 = $this->model('M_DB_1')->get_where("member", $where2);
      $viewData = 'member/member_history';

      $this->view($viewData, [
         'pelanggan' => $pelanggan,
         'data_main' => $data_main,
         'data_main2' => $data_main2,
         'id_harga' => $id_harga,
         'laundry' => $idLaundry
      ]);
   }

   public function Download($path)
   {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . basename($path) . '"');
      header('Content-Length: ' . filesize($path));
      header('Pragma: public');
      //Clear system output buffer
      flush();

      //Read the size of the file
      readfile($path, true);

      //Terminate from the script
      die();
   }
}
