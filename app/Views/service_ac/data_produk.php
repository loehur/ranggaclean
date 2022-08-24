<?php

$list_produk = array();
$list_produk[0] = array(
	"kategori" => 1, // CUCI
	"title" => "Cuci AC split 0,5 PK - 2 PK",
	"price" => 70000,
	"img" => 1,
	"detail" => "No Detail",
);
$list_produk[1] = array(
	"kategori" => 1, // CUCI
	"title" => "Cuci AC Cassette/Ceiling 3 PK",
	"price" => 200000,
	"img" => 1,
	"detail" => "No Detail",
);
$list_produk[2] = array(
	"kategori" => 2, // CEK KERUSAKAN
	"title" => "Cek Kerusakan AC",
	"price" => 65000,
	"img" => 3,
	"detail" => "No Detail",
);
$list_produk[3] = array(
	"kategori" => 3, // TAMBAH FREON
	"title" => "Tambah Freon 0,5 PK - 1 PK R22",
	"price" => 150000,
	"img" => 2,
	"detail" => "No Detail",
);
$list_produk[4] = array(
	"kategori" => 3, // TAMBAH FREON
	"title" => "Tambah Freon 0,5 PK R32 - R410",
	"price" => 200000,
	"img" => 2,
	"detail" => "No Detail",
);
$list_produk[5] = array(
	"kategori" => 4, // ISI ULANG FREON
	"title" => "Isi Ulang Freon 1 PK R22",
	"price" => 250000,
	"img" => 2,
	"detail" => "No Detail",
);
$list_produk[6] = array(
	"kategori" => 4, // ISI ULANG FREON
	"title" => "Isi Ulang Freon 1 PK R32 - R410",
	"price" => 325000,
	"img" => 2,
	"detail" => "No Detail",
);
$list_produk[7] = array(
	"kategori" => 4, // ISI ULANG FREON
	"title" => "Isi Ulang Freon 2 PK R22",
	"price" => 275000,
	"img" => 2,
	"detail" => "No Detail",
);
$list_produk[8] = array(
	"kategori" => 4, // ISI ULANG FREON
	"title" => "Isi Ulang Freon 2 PK R32 - R410",
	"price" => 350000,
	"img" => 2,
	"detail" => "No Detail",
);
$list_produk[9] = array(
	"kategori" => 5, // BONGKAR
	"title" => "Bongkar AC 0,5 PK - 1 PK",
	"price" => 100000,
	"img" => 4,
	"detail" => "No Detail",
);
$list_produk[10] = array(
	"kategori" => 6, // PASANG
	"title" => "Pasang AC 1 PK",
	"price" => 250000,
	"img" => 4,
	"detail" => "No Detail",
);
$list_produk[11] = array(
	"kategori" => 5, // BONGKAR
	"title" => "Bongkar  AC 1.5 PK - 2PK",
	"price" => 150000,
	"img" => 4,
	"detail" => "No Detail",
);
$list_produk[12] = array(
	"kategori" => 6, // PASANG
	"title" => "Pasang AC 1,5 PK - 2 PK",
	"price" => 275000,
	"img" => 4,
	"detail" => "No Detail",
);
$list_produk[13] = array(
	"kategori" => 5, // BONGKAR
	"title" => "Bongkar Pasang 0,5 PK - 1 PK",
	"price" => 350000,
	"img" => 4,
	"detail" => "No Detail",
);
$list_produk[14] = array(
	"kategori" => 5, // BONGKAR
	"title" => "Bongkar Pasang 1,5 PK - 2 PK",
	"price" => 375000,
	"img" => 4,
	"detail" => "No Detail",
);
$list_produk[15] = array(
	"kategori" => 6, // PENGGANTIAN
	"title" => "Penggantian Capasitor 0,5 - 1 PK",
	"price" => 225000,
	"img" => 5,
	"detail" => "No Detail",
);

function array_sort($array, $on, $order = SORT_ASC)
{
	$new_array = array();
	$sortable_array = array();

	if (count($array) > 0) {
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				foreach ($v as $k2 => $v2) {
					if ($k2 == $on) {
						$sortable_array[$k] = $v2;
					}
				}
			} else {
				$sortable_array[$k] = $v;
			}
		}

		switch ($order) {
			case SORT_ASC:
				asort($sortable_array);
				break;
			case SORT_DESC:
				arsort($sortable_array);
				break;
		}

		foreach ($sortable_array as $k => $v) {
			$new_array[$k] = $array[$k];
		}
	}

	return $new_array;
}


array_sort($list_produk, "kategori", SORT_ASC);
$kategori_list = array_column($list_produk, "kategori");

$kategori_id = array();
foreach ($kategori_list as $key => $val) {
	if (isset($kategori_id[$val])) {
		unset($kategori_list[$key]);
	} else {
		$kategori_id[$val] = $key;
	}
}
