<?php
if (count($data['dataTanggal']) > 0) {
  $currentMonth =   $data['dataTanggal']['bulan'];
  $currentYear =   $data['dataTanggal']['tahun'];
} else {
  $currentMonth = date('m');
  $currentYear = date('Y');
}

$r = array();
$r_gl = $data['gajiLaundry'];

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

$r_pengali = array();
$r_pengali_id = array();
foreach ($this->dGajiPengali as $a) {
  $r_pengali[$a['id_karyawan']][$a['id_pengali']] = $a['gaji_pengali'];
  $r_pengali_id[$a['id_karyawan']][$a['id_pengali']] = $a['id_gaji_pengali'];
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
                          <a class="dropdown-item" href="#exampleModal" data-bs-toggle="modal">Layanan Laundry</a>
                          <a class="dropdown-item" href="#exampleModal1" data-bs-toggle="modal">Terima/Kembali & Harian</a>
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
        echo "<td colspan='4' class='pb-3'><span>" . strtoupper($user) . " [ " . $this->kode_cabang . " ]</span></td>";
        echo "</tr>";


        echo "<tr class='table-success'>";
        echo "<td colspan='4'><span>Pendapatan</span></td>";
        echo "</tr>";


        foreach ($r as $userID => $arrJenisJual) {
          $feeLaundry = 0;
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

                  $gaji_laundry = 0;
                  $bonus_target = 0;
                  foreach ($this->dGajiLaundry as $gp) {
                    if ($gp['id_karyawan'] == $id_user && $gp['id_layanan'] == $id_layanan && $gp['jenis_penjualan'] == $id_penjualan) {
                      $gaji_laundry = $gp['gaji_laundry'];
                      $target = $gp['target'];
                      $bonus_target = $gp['bonus_target'];
                      $id_gl = $gp['id_gaji_laundry'];
                    }
                  }

                  $bonus = 0;
                  $xBonus = 0;
                  if ($target > 0) {
                    if ($totalPerUser > 0) {
                      $xBonus = floor($totalPerUser / $target);
                      $bonus = $xBonus * $bonus_target;
                    }
                  }

                  echo "<tr>";
                  echo "<td nowrap><small>" . $penjualan . "</small><br>" . $layanan . "</td>";
                  echo "<td class='text-right'><small>Qty</small><br>" . number_format($totalPerUser) . "<br><small>Target</small><br>
                  
                  <span class='edit' data-table='gaji_laundry' data-col='target' data-id_edit='" . $id_gl . "'>" . $target . "</span>
                  
                  </td>";
                  echo "<td class='text-right'><small>Fee</small><br>Rp
                  
                  <span class='edit' data-table='gaji_laundry' data-col='gaji_laundry' data-id_edit='" . $id_gl . "'>" . $gaji_laundry . "</span>
                  
                  <br><small>Bonus/Target</small><br>
                  
                  <span class='edit' data-table='gaji_laundry' data-col='bonus_target' data-id_edit='" . $id_gl . "'>" . $bonus_target . "</span>

                  </td>";
                  echo "<td class='text-right'><small>Total</small><br><b>Rp" . number_format($gaji_laundry * $totalPerUser) . "</b><br><small>Bonus diterima</small><br>Rp" . number_format($bonus) . "</td>";
                  echo "</tr>";
                }
              }
              $totalTerima = 0;
              foreach ($data['dTerima'] as $a) {
                if ($uc['id_user'] == $a['id_user']) {
                  $totalTerima = $totalTerima + $a['terima'];
                }
              }

              if (isset($r_pengali[$id_user][1])) {
                $feeTerima = $r_pengali[$id_user][1];
                $id_gp = $r_pengali_id[$id_user][1];
              } else {
                $feeTerima = 0;
                $id_gp = 0;
              }

              $totalFeeTerima = $totalTerima * $feeTerima;

              echo "<tr>";
              echo "<td nowrap><small>Laundry</small><br>Terima</td>";
              echo "<td class='text-right'><small>Qty</small><br>" . $totalTerima . "</td>";
              echo "<td class='text-right'><small>Fee</small><br>Rp
              
              <span class='edit' data-table='gaji_pengali' data-col='gaji_pengali' data-id_edit='" . $id_gp . "'>" . $feeTerima . "</span>

              </td>";
              echo "<td class='text-right'><small>Total</small><br><b>Rp" . $totalFeeTerima . "</td>";
              echo "</tr>";

              $totalKembali = 0;
              foreach ($data['dKembali'] as $a) {
                if ($uc['id_user'] == $a['id_user_ambil']) {
                  $totalKembali = $totalKembali + $a['kembali'];
                }
              }

              if (isset($r_pengali[$id_user][2])) {
                $feeKembali = $r_pengali[$id_user][2];
                $id_gp = $r_pengali_id[$id_user][2];
              } else {
                $feeKembali = 0;
                $id_gp = 0;
              }

              $totalFeeKembali = $totalKembali * $feeKembali;
              echo "<tr>";
              echo "<td nowrap class='pb-3'><small>Laundry</small><br>Kembali</td>";
              echo "<td class='text-right'><small>Qty</small><br>" . $totalKembali . "</td>";
              echo "<td class='text-right'><small>Fee</small><br>Rp
              
              <span class='edit' data-table='gaji_pengali' data-col='gaji_pengali' data-id_edit='" . $id_gp . "'>" . $feeKembali . "</span>

              </td>";
              echo "<td class='text-right'><small>Total</small><br><b>RpRp" . number_format($totalFeeKembali) . "</td>";
              echo "</tr>";
            }
          }
        }

        if ($data['user']['kasbon'] > 0) {
          echo "<tr class='table-danger'>";
          echo "<td colspan='4' class='pt-2'>Potongan</td>";
          echo "</tr>";
          echo "<tr>";
          echo "<td nowrap>Kasbon</td>";
          echo "<td nowrap></td>";
          echo "<td nowrap></td>";
          echo "<td class='text-right'><b>Rp" . number_format($data['user']['kasbon']) . "</b></td>";
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
        <h5 class="modal-title" id="exampleModalLabel">Fee Kinerja</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
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
            <div class="form-group">
              <label for="exampleInputEmail1">Target <small>Berlaku Kelipatan</small></label>
              <input type="number" name="target" min="1" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Bonus Target</label>
              <input type="number" name="bonus_target" min="1" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-primary">Set</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terima/Kembali & Harian</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="jq" action="<?= $this->BASE_URL; ?>Gaji/set_gaji_pengali" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Pengali</label>
              <select name="pengali" class="form-control form-control-sm userChange" style="width: 100%;" required>
                <option value="" selected disabled></option>
                <?php foreach ($this->dListPengali as $a) { ?>
                  <option value="<?= $a['id_pengali'] ?>"><?= $a['pengali_jenis'] ?></option>
                <?php } ?>
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
        //alert(response);
        location.reload(true);
      },
    });
  });

  var click = 0;
  $("span.edit").on('dblclick', function() {
    click = click + 1;
    if (click != 1) {
      return;
    }

    var id_edit = $(this).attr('data-id_edit');
    var value = $(this).html();
    var col = $(this).attr('data-col');
    var table = $(this).attr('data-table');
    var value_before = value;
    var span = $(this);

    var valHtml = $(this).html();

    span.html("<input type='number' style='width:70px' id='value" + id_edit + "' value='" + value + "'>");

    $("#value" + id_edit).focus();
    $("#value" + id_edit).focusout(function() {
      var value_after = $(this).val();
      if (value_after === value_before) {
        span.html(value);
        click = 0;
      } else {
        $.ajax({
          url: '<?= $this->BASE_URL ?>Gaji/updateCell',
          data: {
            'id': id_edit,
            'value': value_after,
            'col': col,
            'table': table
          },
          type: 'POST',
          dataType: 'html',
          success: function(response) {
            location.reload(true);
          },
        });
      }
    });
  });
</script>