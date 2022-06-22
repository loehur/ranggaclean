<?php
if (count($data['dataTanggal']) > 0) {
  $currentMonth =   $data['dataTanggal']['bulan'];
  $currentYear =   $data['dataTanggal']['tahun'];
} else {
  $currentMonth = date('m');
  $currentYear = date('Y');
}

$r = array();
foreach ($data['data_main'] as $a) {
  $user = $a['id_user_operasi'];
  $cabang = $a['id_cabang'];
  $jenis_operasi = $a['jenis_operasi'];
  $jenis = $a['id_penjualan_jenis'];

  if (isset($r[$user][$jenis][$jenis_operasi][$cabang]) ==  TRUE) {
    $r[$user][$jenis][$jenis_operasi][$cabang] =  $r[$user][$jenis][$jenis_operasi][$cabang] + $a['qty'];
  } else {
    $r[$user][$jenis][$jenis_operasi][$cabang] = $a['qty'];
  }
}

$id_user = $data['user']['id'];
$user = "";
foreach ($this->user as $uc) {
  if ($uc['id_user'] == $data['user']['id']) {
    $user = "<small>[" . $uc['id_user'] . "]</small> - <b>" . $uc['nama_user'] . "<b>";
  }
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="content sticky-top pl-1 pr-2">
            <form action="<?= $this->BASE_URL; ?>Gaji" method="POST">
              <table class="w-100">
                <tr>
                  <td>
                    <select name="user" class="form-control form-control-sm karyawan" style="width: 100%;" required>
                      <option value="" selected disabled>Karyawan</option>
                      <?php if (count($this->userCabang) > 0) {
                        foreach ($this->user as $a) { ?>
                          <option <?php if ($data['user']['id'] == $a['id_user']) {
                                    echo "selected";
                                  } ?> id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                      <?php }
                      } ?>
                    </select>
                  </td>
                  <td>
                    <select name="m" class="form-control form-control-sm" style="width: auto;">
                      <option class="text-right" value="01" <?php if ($currentMonth == '01') {
                                                              echo 'selected';
                                                            } ?>>01</option>
                      <option class="text-right" value="02" <?php if ($currentMonth == '02') {
                                                              echo 'selected';
                                                            } ?>>02</option>
                      <option class="text-right" value="03" <?php if ($currentMonth == '03') {
                                                              echo 'selected';
                                                            } ?>>03</option>
                      <option class="text-right" value="04" <?php if ($currentMonth == '04') {
                                                              echo 'selected';
                                                            } ?>>04</option>
                      <option class="text-right" value="05" <?php if ($currentMonth == '05') {
                                                              echo 'selected';
                                                            } ?>>05</option>
                      <option class="text-right" value="06" <?php if ($currentMonth == '06') {
                                                              echo 'selected';
                                                            } ?>>06</option>
                      <option class="text-right" value="07" <?php if ($currentMonth == '07') {
                                                              echo 'selected';
                                                            } ?>>07</option>
                      <option class="text-right" value="08" <?php if ($currentMonth == '08') {
                                                              echo 'selected';
                                                            } ?>>08</option>
                      <option class="text-right" value="09" <?php if ($currentMonth == '09') {
                                                              echo 'selected';
                                                            } ?>>09</option>
                      <option class="text-right" value="10" <?php if ($currentMonth == '10') {
                                                              echo 'selected';
                                                            } ?>>10</option>
                      <option class="text-right" value="11" <?php if ($currentMonth == '11') {
                                                              echo 'selected';
                                                            } ?>>11</option>
                      <option class="text-right" value="12" <?php if ($currentMonth == '12') {
                                                              echo 'selected';
                                                            } ?>>12</option>
                    </select>
                  </td>
                  <td>
                    <select name="Y" class="form-control form-control-sm" style="width: auto;">
                      <option class="text-right" value="2021" <?php if ($currentYear == 2021) {
                                                                echo 'selected';
                                                              } ?>>2021</option>
                      <option class="text-right" value="2022" <?php if ($currentYear == 2022) {
                                                                echo 'selected';
                                                              } ?>>2022</option>
                    </select>
                  </td>
                  <td><button class="form-control form-control-sm m-1 p-1 bg-light">Cek</td>
                  <?php if ($user <> "") { ?>
                    <td>
                      <div class="btn-group ml-2">
                        <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Set Gaji
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Laundry</a>
                          <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal3">Pengali</a>
                          <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2">Khusus</a>
                        </div>
                      </div>
                    </td>
          </div>
        <?php } ?>
        </tr>
        </table>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php if ($user <> "") { ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <?php
        echo '<div class="col-auto">';
        echo '<div class="card">';

        echo '<table class="table table-sm m-0">';
        echo '<tbody>';

        echo "<tr>";
        echo "<td colspan='3'><span>" . strtoupper($user) . "</span></td>";
        echo "</tr>";
        foreach ($r as $userID => $arrJenisJual) {
          foreach ($this->user as $uc) {
            if ($uc['id_user'] == $userID) {
              $user = "<small>[" . $uc['id_user'] . "]</small> - <b>" . $uc['nama_user'] . "<b>";
              foreach ($arrJenisJual as $jenisJualID => $arrLayanan) {
                $penjualan = "";
                $satuan = "";
                foreach ($this->dPenjualan as $jp) {
                  if ($jp['id_penjualan_jenis'] == $jenisJualID) {
                    $id_penjualan = $jp['id_penjualan_jenis'];
                    $penjualan = $jp['penjualan_jenis'];
                    foreach ($this->dSatuan as $js) {
                      if ($js['id_satuan'] == $jp['id_satuan']) {
                        $satuan = $js['nama_satuan'];
                      }
                    }
                  }
                }

                echo "<tr class='table-primary'>";
                echo "<td colspan='3'>" . $penjualan . "</td>";
                echo "</tr>";

                foreach ($arrLayanan as $layananID => $arrCabang) {
                  $totalPerUser = 0;
                  foreach ($this->dLayanan as $dl) {
                    if ($dl['id_layanan'] == $layananID) {
                      $layanan = $dl['layanan'];
                      $id_layanan = $dl['id_layanan'];
                      foreach ($arrCabang as $cabangID => $c) {
                        $totalPerUser = $totalPerUser + $c;
                      }
                    }
                  }

                  $pengali = 0;
                  foreach ($this->dGajiLaundry as $gp) {
                    if ($gp['id_karyawan'] == $id_user && $gp['id_layanan'] == $id_layanan && $gp['jenis_penjualan'] == $id_penjualan)
                      $pengali = $gp['gaji_laundry'];
                  }

                  echo "<tr>";
                  echo "<td nowrap>" . $layanan . "</td>";
                  echo "<td class='text-right'><b>" . number_format($totalPerUser) . "</b></td>";
                  echo "<td class='text-right'><b>Rp" . number_format($pengali * $totalPerUser) . "</b></td>";
                  echo "</tr>";
                }
              }
              echo "<tr class='table-primary'>";
              echo "<td colspan='3'>Terima/Kembali</td>";

              $totalTerima = 0;
              foreach ($data['dTerima'] as $a) {
                if ($uc['id_user'] == $a['id_user']) {
                  $totalTerima = $totalTerima + $a['terima'];
                }
              }
              echo "<tr>";
              echo "<td nowrap>Terima Laundry</td>";
              echo "<td class='text-right'><b>" . $totalTerima . "</b></td>";
              echo "</tr>";

              $totalKembali = 0;
              foreach ($data['dKembali'] as $a) {
                if ($uc['id_user'] == $a['id_user_ambil']) {
                  $totalKembali = $totalKembali + $a['kembali'];
                }
              }
              echo "<tr>";
              echo "<td nowrap>Kembali Laundry</td>";
              echo "<td class='text-right'><b>" . $totalKembali . "</b></td>";
              echo "</tr>";
            }
          }
        }

        if ($data['user']['kasbon'] > 0) {
          echo "<tr class='table-danger'>";
          echo "<td colspan='3'>Potongan</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td nowrap>Kasbon</td>";
          echo "<td class='text-right'><b>" . number_format($data['user']['kasbon']) . "</b></td>";
          echo "</tr>";
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div></div>';
        ?>
      </div>
    </div>
  </div>
<?php } ?>


<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gaji Kinerja</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form class="jq" action="<?= $this->BASE_URL; ?>Gaji/set_gaji_laundry" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Penjualan</label>
              <select name="penjualan" class="form-control form-control-sm userChange" style="width: 100%;" required>
                <option value="" selected disabled></option>
                <?php foreach ($this->dPenjualan as $a) { ?>
                  <option id="<?= $a['id_penjualan_jenis'] ?>" value="<?= $a['id_penjualan_jenis'] ?>"><?= $a['penjualan_jenis'] ?></option>
                <?php } ?>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Layanan</label>
              <select name="layanan" class="form-control form-control-sm userChange" style="width: 100%;" required>
                <option value="" selected disabled></option>
                <?php foreach ($this->dLayanan as $a) { ?>
                  <option id="<?= $a['id_layanan'] ?>" value="<?= $a['id_layanan'] ?>"><?= $a['layanan'] ?></option>
                <?php } ?>
                </optgroup>
              </select>
            </div>
            <input name='id_user' type="hidden" value="<?= $data['user']['id'] ?>" />
            <div class="form-group">
              <label for="exampleInputEmail1">Fee Rp</label>
              <input type="number" name="fee" min="1" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-primary">Set Fee</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal10" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Gaji Terima/Kembali Kain</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form class="jq" action="<?= $this->BASE_URL; ?>Gaji/set_pengali" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Penjualan</label>
              <select name="penjualan" class="form-control form-control-sm userChange" style="width: 100%;" required>
                <option value="" selected disabled></option>
                <?php foreach ($this->dPenjualan as $a) { ?>
                  <option id="<?= $a['id_penjualan_jenis'] ?>" value="<?= $a['id_penjualan_jenis'] ?>"><?= $a['penjualan_jenis'] ?></option>
                <?php } ?>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Layanan</label>
              <select name="layanan" class="form-control form-control-sm userChange" style="width: 100%;" required>
                <option value="" selected disabled></option>
                <option value="0">Harian</option>
                <?php foreach ($this->dLayanan as $a) { ?>
                  <option id="<?= $a['id_layanan'] ?>" value="<?= $a['id_layanan'] ?>"><?= $a['layanan'] ?></option>
                <?php } ?>
                </optgroup>
              </select>
            </div>
            <input name='id_user' type="hidden" value="<?= $data['user']['id'] ?>" />
            <div class="form-group">
              <label for="exampleInputEmail1">Fee Rp</label>
              <input type="number" name="fee" min="1" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-primary">Set Fee</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap-4.6/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/select2/select2.min.js"></script>

<script>
  $("form.jq").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      data: $(this).serialize(),
      type: $(this).attr("method"),
      success: function(response) {
        //alert(response)
        location.reload(true);
      },
    });
  });
</script>