<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto p-1">
        <div class="p-0">
          <div class="d-flex flex-row">
            <div class="mr-auto">
              <small>Saldo Kas</small><br>
              <span class="text-bold text-success">Rp. <?= number_format($data['saldo']); ?></span>
            </div>
            <div class="p-0 pr-0 pb-2 pt-2">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Menu Kas
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Pengeluaran</a>
                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal3">Penarikan</a>
                  <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal2">Kasbon</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php if (count($data['kasbon']) > 0) { ?>
          <div class="card">
            <table class="table table-sm w-100 p-0 m-0">
              <thead class="table-warning">
                <tr>
                  <th class="text-right">ID Trx</th>
                  <th>Tanggal</th>
                  <th>Karyawan</th>
                  <th>Penarik</th>
                  <th class="text-right">Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($data['kasbon'] as $a) {
                  $id = $a['id_kas'];
                  $st_trx = $a['status_mutasi'];
                  $stt = $a['status_transaksi'];

                  $karyawan = '';
                  $karyawan_tarik = '';

                  $id_kar = $a['id_client'];
                  $id_kar_tarik = $a['id_user'];

                  foreach ($this->userMerge as $c) {
                    if ($c['id_user'] == $id_kar) {
                      $karyawan = $c['nama_user'];
                    }
                    if ($c['id_user'] == $id_kar_tarik) {
                      $karyawan_tarik = $c['nama_user'];
                    }
                  }

                  $st_trx_name = "";
                  foreach ($this->dStatusTransaksi as $st) {
                    if ($st['id_status_transaksi'] == $st_trx) {
                      $st_trx_name = $st['status_transaksi'];
                    }
                  }
                ?>
                  <tr>
                    <td class="text-right">
                      <?= $id ?>
                    </td>
                    <td>
                      <?= substr($a['insertTime'], 5, 11) ?>
                    </td>
                    <td>
                      <?= strtoupper($karyawan) ?>
                    </td>
                    <td>
                      <?= strtoupper($karyawan_tarik) ?>
                    </td>
                    <td class="text-right">
                      <?= number_format($a['jumlah']) ?>
                    </td>
                  </tr>
                <?php }
                ?>
              </tbody>
            </table>
          </div>
        <?php } ?>
        <div class="card">
          <table class="table table-sm w-100 m-0">
            <tbody>
              <?php
              $no = 0;
              foreach ($data['debit_list'] as $a) {
                $id = $a['id_kas'];
                $f1 = substr($a['insertTime'], 5, 11);
                $f2 = $a['note'];
                $f2b = $a['note_primary'];
                $f3 = $a['id_user'];
                $f4 = $a['jumlah'];
                $f5 = $a['status_mutasi'];
                $f6 = $a['jenis_transaksi'];
                $st = $a['status_mutasi'];
                $cl = $a['id_client'];

                $karyawan = '';
                foreach ($this->userMerge as $c) {
                  if ($c['id_user'] == $f3) {
                    $karyawan = $c['nama_user'];
                  }
                }

                $statusNya = '';
                foreach ($this->dStatusMutasi as $c) {
                  if ($c['id_status_mutasi'] == $st) {
                    if ($st == 3) {
                      $statusNya = "<small class='text-success'>[" . $c['status_mutasi'] . "]</small>";
                    } elseif ($st == 2) {
                      $statusNya = "<small class='text-warning'>[" . $c['status_mutasi'] . "]</small>";
                    } else {
                      $statusNya = "<small class='text-danger'>[" . $c['status_mutasi'] . "]</small>";
                    }
                  }
                }

                $client = "";
                if ($f6 == 5) {
                  foreach ($this->userMerge as $c) {
                    if ($c['id_user'] == $cl) {
                      $client = "[" . $c['nama_user'] . "]";
                    }
                  }
                }

                $classTR = '';
                if ($f6 == 4) {
                  $classTR = 'table-danger';
                }
                if ($f6 == 5) {
                  $classTR = 'table-warning';
                }

                echo "<tr class='" . $classTR . "'>";
                echo "<td class='text-right'><small>#" . $id . "<br>" . $f1 . "</small></td>";
                echo "<td><span><small>Penarik: " . $karyawan . "<br></small><b>" . $f2b . "</b> <small>" . $f2 . " " . $client . "</></small></span></td>";
                echo "<td class='text-right'><b><span>" . number_format($f4) . "</span><br>" . $statusNya . "</b></td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengeluaran</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>Kas/insert_pengeluaran" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Jenis Pengeluaran</label>
              <select name="f1a" class="form-control form-control-sm pengeluaran" style="width: 100%;" required>
                <option value="" selected disabled></option>
                <?php foreach ($this->dItemPengeluaran as $a) { ?>
                  <option id="<?= $a['id_item_pengeluaran'] ?>" value="<?= $a['id_item_pengeluaran'] ?><explode><?= $a['item_pengeluaran'] ?>"><?= $a['item_pengeluaran'] ?></option>
                <?php } ?>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Rp</label>
              <input type="number" name="f2" min="1000" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Keterangan/Banyak</label>
              <input type="text" name="f1" class="form-control" id="exampleInputEmail1" placeholder="">
            </div>
            <label for="exampleInputEmail1">Penarik Kas</label>
            <select name="f3" class="keluar form-control form-control-sm userChange" style="width: 100%;" required>
              <option value="" selected disabled></option>
              <optgroup label="<?= $this->dLaundry['nama_laundry'] ?> [<?= $this->dCabang['kode_cabang'] ?>]">
                <?php foreach ($this->user as $a) { ?>
                  <option id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                <?php } ?>
              </optgroup>
              <?php if (count($this->userCabang) > 0) { ?>
                <optgroup label="----- Cabang Lain -----">
                  <?php foreach ($this->userCabang as $a) { ?>
                    <option id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                  <?php } ?>
                </optgroup>
              <?php } ?>
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-danger">Tarik Kas Pengeluaran</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penarikan Kas</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>Kas/insert" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah Rp</label>
              <input type="number" name="f2" min="1000" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Keterangan</label>
              <input type="text" name="f1" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <label for="exampleInputEmail1">Penarik Kas</label>
            <select name="f3" class="tarik form-control form-control-sm userChange" style="width: 100%;" required>
              <option value="" selected disabled></option>
              <optgroup label="<?= $this->dLaundry['nama_laundry'] ?> [<?= $this->dCabang['kode_cabang'] ?>]">
                <?php foreach ($this->user as $a) { ?>
                  <option id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                <?php } ?>
              </optgroup>
              <?php if (count($this->userCabang) > 0) { ?>
                <optgroup label="----- Cabang Lain -----">
                  <?php foreach ($this->userCabang as $a) { ?>
                    <option id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                  <?php } ?>
                </optgroup>
              <?php } ?>
            </select>
          </div>
          <div class="modal-footer">
            <small class="text-danger">Penarikan Kas Laundry harus disetor kepada Admin sebagai Kas Utama</small>
            <button type="submit" class="btn btn-sm btn-primary">Tarik Kas</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Penarikan Kasbon</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- ====================== FORM ========================= -->
        <form action="<?= $this->BASE_URL; ?>Kasbon/insert" method="POST">
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Karyawan Kasbon</label>
              <select name="f1" class="form-control form-control-sm userChange" style="width: 100%;" required>
                <option value="" selected disabled></option>
                <optgroup label="<?= $this->dLaundry['nama_laundry'] ?> [<?= $this->dCabang['kode_cabang'] ?>]">
                  <?php foreach ($this->user as $a) { ?>
                    <option id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                  <?php } ?>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Jumlah</label>
              <input type="number" name="f2" min="1000" class="form-control" id="exampleInputEmail1" placeholder="" required>
            </div>
            <label for="exampleInputEmail1">Penarik Kas</label>
            <select name="f3" class="kasbon form-control form-control-sm userChange" style="width: 100%;" required>
              <option value="" selected disabled></option>
              <optgroup label="<?= $this->dLaundry['nama_laundry'] ?> [<?= $this->dCabang['kode_cabang'] ?>]">
                <?php foreach ($this->user as $a) { ?>
                  <option id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                <?php } ?>
              </optgroup>
              <?php if (count($this->userCabang) > 0) { ?>
                <optgroup label="----- Cabang Lain -----">
                  <?php foreach ($this->userCabang as $a) { ?>
                    <option id="<?= $a['id_user'] ?>" value="<?= $a['id_user'] ?>"><?= $a['id_user'] . "-" . strtoupper($a['nama_user']) ?></option>
                  <?php } ?>
                </optgroup>
              <?php } ?>
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-warning">Buat Kasbon</button>
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
  $(document).ready(function() {
    $("form").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: $(this).attr("method"),
        success: function(response) {
          location.reload(true);
        },
      });
    });
    selectList();
  });

  $('.modal').on('hidden.bs.modal', function() {
    selectList();
  });

  function selectList() {
    $('select.tarik').val('').change();
    $('select.tarik').trigger("change");
    $('select.tarik').select2({
      dropdownParent: $("#exampleModal3"),
    });

    $('select.keluar').val('').change();
    $('select.keluar').trigger("change");
    $('select.keluar').select2({
      dropdownParent: $("#exampleModal"),
    });

    $('select.pengeluaran').val('').change();
    $('select.pengeluaran').trigger("change");
    $('select.pengeluaran').select2({
      dropdownParent: $("#exampleModal"),
    });

    $('select.kasbon').val('').change();
    $('select.kasbon').trigger("change");
    $('select.kasbon').select2({
      dropdownParent: $("#exampleModal2"),
    });
  }

  function tarik(idnya) {
    $.ajax({
      url: '<?= $this->BASE_URL ?>Kasbon/tarik_kasbon/',
      data: {
        id: idnya
      },
      type: "POST",
      success: function() {
        location.reload(true);
      },
    });
  }

  function batal(idnya) {
    $.ajax({
      url: '<?= $this->BASE_URL ?>Kasbon/batal_kasbon/',
      data: {
        id: idnya
      },
      type: "POST",
      success: function() {
        location.reload(true);
      },
    });
  }

  $(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
  });
</script>