<?php

class CekLangganan extends Controller
{
   public function __construct()
   {
      $this->session_cek();
      $this->data();
      $this->table = 'penjualan';
   }

   public function index()
   {
      $data = $this->model('M_DB_1')->get_where_row("mdl_langganan", "trx_status = 1 AND id_cabang = " . $this->id_cabang . " LIMIT 1");
      if (isset($data)) {
         $bank = $data['bank'];
         $jumlah = $data['jumlah'] + $data['id_trx'];
         $cek = $this->model('CekMutasi')->cek($bank, $jumlah);
         if ($cek == 1) {
            $set = "trx_status = 3";
            $where = $this->wCabang . " AND id_trx = " . $data['id_trx'];
            print_r($this->model('M_DB_1')->update('mdl_langganan', $set, $where));
         }
      }
   }
}
