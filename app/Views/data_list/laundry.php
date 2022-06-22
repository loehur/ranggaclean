<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto">

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Data Laundry</h4>
            <button type="button" class="btn btn-sm btn-primary float-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
              +
            </button>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-sm">
              <tbody>
                <?php foreach ($data['data_laundry'] as $a) {
                  $id = $a['id_laundry'];
                  $nama = $a['nama_laundry'];
                  $notif_token = $a['notif_token'];
                  $wa_log = $a['notif_log'];
                  echo "<tr>";
                  echo "<td><small>ID</small><br>" . $id . "</td>";
                  echo "<td><small>Nama Laundry</small><br><span class='cell' id='" . $id . "' data-name='" . $nama . "'>" . $nama . "</span></td>";
                  echo "<td><small>Notif Token</small><br>" . $notif_token . "</td>";
                  echo "<td><small>Status</small><br>";
                  if ($id == $this->id_laundry) {
                    echo "<span class='text-primary text-bold'>Selected</span>";
                  } else {
                    echo "<a href='' data-id='$id' class='select btn badge badge-secondary'>Select</a>";
                  }
                  echo "</td>";
                  if ($wa_log == 0) { ?>
                    <td><small>WA Status</small><br><span onclick="beginCheck('<?= $notif_token ?>')" class='badge btn badge-success' data-bs-toggle='modal' data-bs-target='#exampleModal3'>Login</span></td>
                <?php } else {
                    echo "<td><small>WA Status</small><br><span class='text-success text-bold'>Ready</span></td>";
                  }
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
                <h5 class="modal-title" id="exampleModalLabel">Penambahan Laundry</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <div id="info"></div>
                <form action="<?= $this->BASE_URL; ?>Laundry_List/insert" method="POST">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Laundry</label>
                      <input type="text" name="nama" class="form-control form-control-sm" placeholder="" required>
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

  <div class="modal" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Whatsapp Status</h5>
        </div>
        <div class="modal-body">
          <div class="mt-2" id="wa_status"></div>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- SCRIPT -->
  <script src="<?= $ASSETS_URL ?>js/jquery-3.6.0.min.js"></script>
  <script src="<?= $ASSETS_URL ?>js/popper.min.js"></script>
  <script src="<?= $ASSETS_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $ASSETS_URL ?>plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= $ASSETS_URL ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= $ASSETS_URL ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= $ASSETS_URL ?>plugins/select2/select2.min.js"></script>

  <script>
    $(document).ready(function() {
      $("#info").hide();

      $("form").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
          url: $(this).attr('action'),
          data: $(this).serialize(),
          type: $(this).attr("method"),
          dataType: 'html',

          success: function() {
            location.reload(true);
          },
        });
      });

      $(".select").click(function() {
        var idNya = $(this).attr('data-id');
        $.ajax({
          url: "<?= $this->BASE_URL ?>Laundry_List/selectLaundry",
          data: {
            'id': idNya
          },
          type: "POST",
          dataType: 'html',
          success: function() {
            location.reload(true);
          },
        });
      });

      var click = 0;
      $(".cell").on('dblclick', function() {
        click = click + 1;
        if (click != 1) {
          return;
        }

        var value_before = $(this).attr('data-name');
        var id = $(this).attr('id');
        var td1 = $(this).find('td:eq(1)');
        var span = $(this);
        span.html("<input id='update' value='" + value_before + "'>");
        $("#update").focus();

        $("#update").focusout(function() {
          var value_after = $(this).val();
          if (value_after === value_before) {
            span.html(value_before);
            click = 0;
          } else {
            $.ajax({
              url: '<?= $this->BASE_URL ?>Laundry_List/update',
              data: {
                'id': id,
                'nama': value_after
              },
              type: 'POST',
              dataType: 'html',
              success: function() {
                location.reload(true);
              },
            });
          }
        });
      });
    });

    var runCheck = false;
    var log = 0
    var token = "abc";

    function beginCheck(tokenGet) {
      token = tokenGet;
      checkWA();
      if (runCheck == false) {
        setInterval(checkWA, 3000);
        runCheck = true;
      }

      function checkWA() {
        $("div#wa_status").load('<?= $this->BASE_URL ?>Data_List/wa_status/' + token);
        log = $("span#log").html();
        if (log == 1) {
          clearInterval(checkWA);
        }
      }
    }
  </script>