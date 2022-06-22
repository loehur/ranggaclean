<?php $page = $data['z']['page'] ?>

<?php $sisa_item = $this->dLayananDelivery; ?>

<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-auto">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title text-success">Tarif <?= $data['z']['set'] ?></h4>

            <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
              +
            </button>

          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-sm" role="grid" aria-describedby="example2_info">
              <thead>
                <tr>
                  <th>Layanan</th>
                  <th class="text-right">Harga/<?= $data['z']['unit'] ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['data_main'] as $a) {
                  $id = $a['id_harga'];
                  $f2 = $a['list_layanan'];
                  $f3 = $a['harga'];

                  $list_layanan = "";
                  $arrList_layanan = unserialize($f2);

                  foreach ($arrList_layanan as $b) {
                    foreach ($this->dLayananDelivery as $c) {
                      if ($c['id_layanan_delivery'] == $b) {
                        $list_layanan = $list_layanan . " " . $c['layanan_delivery'];
                      }
                    }
                  }

                  echo "<tr>";
                  echo "<td>" . $list_layanan . "</td>";
                  echo "<td class='text-right'>Rp<span class='cell' data-mode='1' data-id_value='" . $id . "' data-value='" . $f3 . "'>" . $f3 . "</span></td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Set Harga <?= $data['z']['set'] ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <form action="<?= $this->BASE_URL; ?>SetDelivery/insert/<?= $page ?>" method="POST">
                  <div class="card-body">

                    <!-- ======================================================== -->
                    <div class="form-group">
                      <label>Layanan Delivery</label>
                      <select name="f1[]" class="select2 form-control form-control-sm" style="width: 100%" multiple="multiple" required>
                        <?php foreach ($sisa_item as $a) { ?>
                          <option value="<?= $a['id_layanan_delivery'] ?>"><?= $a['layanan_delivery'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Harga/<?= $data['z']['unit'] ?></label>
                      <input type="number" min="1" name="f2" class="form-control form-control-sm" placeholder="" required>
                    </div>
                    <!-- ======================================================== -->

                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT -->
<script src="<?= $this->ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>js/popper.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= $this->ASSETS_URL ?>plugins/select2/select2.min.js"></script>

<script>
  $(document).ready(function() {
    $('.select2').select2({
      theme: "classic"
    });

    $("form").on("submit", function(e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        data: $(this).serialize(),
        type: $(this).attr("method"),
        dataType: 'html',

        success: function(response) {
          location.reload(true);
        },
      });
    });

    $(".cell").on('dblclick', function() {
      var id_value = $(this).attr('data-id_value');
      var value = $(this).attr('data-value');
      var mode = $(this).attr('data-mode');
      var value_before = value;
      var span = $(this);

      var valHtml = $(this).html();
      span.html("<input type='number' min='1' class='form-control-sm text-center' id='value_' value='" + value + "'>");

      $("#value_").focus();
      $("#value_").focusout(function() {
        var value_after = $(this).val();
        if (value_after === value_before) {
          span.html(valHtml);
        } else {
          $.ajax({
            url: '<?= $this->BASE_URL ?>setHarga/updateCell',
            data: {
              'id': id_value,
              'value': value_after,
              'mode': mode
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

    $("a.removeRow").on('click', function(e) {
      e.preventDefault();
      var idNya = $(this).attr('data-id');
      $.ajax({
        url: '<?= $this->BASE_URL ?>setHarga/removeRow',
        data: {
          'id': idNya
        },
        type: 'POST',
        success: function() {
          location.reload(true);
        },
      });
    });
  });
</script>