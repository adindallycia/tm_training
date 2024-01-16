<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3>Data Obat</h3>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
          Tambah Obat
        </button>
        <p>Total Obat           : <?php echo $total_obat; ?></p>  
        <p>Total Obat Expired    : <?php echo $expired_obat; ?></p>   
        <p>Total Obat Belum Expired  : <?php echo $not_expired_obat; ?></p>  
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Jenis Obat</th>
              <th>Nama Obat</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Tanggal Expired</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($obat as $row): ?>
              <tr>
                <td>
                  <?php echo $row->nama_jenis_obat; ?>
                </td>
                <td>
                  <?php echo $row->nama; ?>
                </td>
                <td>
                  <?php echo $row->satuan; ?>
                </td>
                <td>Rp.
                  <?php echo $row->harga; ?>
                </td>
                <td>
                  <?php echo $row->stok; ?>
                </td>
                <td>
                  <?php echo $row->tanggal_expired; ?>
                </td>
                <td>
                  <?php
                  $status = (strtotime($row->tanggal_expired) < strtotime(date('Y-m-d'))) ? 'Expired' : 'Belum Expired';
                  $label_color = (strtotime($row->tanggal_expired) < strtotime(date('Y-m-d'))) ? 'background-color: #d9534f; color: #fff;' : 'background-color: #5bc0de; color: #fff;';
                  ?>
                  <span
                    style="padding: 5px 10px; border-radius: 3px; font-size: 12px; font-weight: bold; <?php echo $label_color; ?>">
                    <?php echo $status; ?>
                  </span>
                </td>

                <td>
                  <button type="button" class="btn btn-warning btn-edit" data-toggle="modal"
                    data-target="#modal-edit-<?php echo $row->id; ?>">Edit</button>
                  <a href="<?php echo base_url('obat/hapus/' . $row->id); ?>" class="btn btn-danger"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<form method="post" action="<?php echo base_url('obat/proses_tambah'); ?>" onsubmit="prosesTambah()">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
    value="<?php echo $this->security->get_csrf_hash(); ?>">
  <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modalLabelTambah"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabelTambah">Tambah Obat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="id_jenis_obat">Jenis Obat:</label>
            <select class="form-control" id="id_jenis_obat" name="id_jenis_obat" required>
              <?php if (is_array($jenis_obat_options) && !empty($jenis_obat_options)): ?>
                <?php foreach ($jenis_obat_options as $jenis): ?>
                  <option value="<?php echo $jenis->id; ?>">
                    <?php echo $jenis->nama; ?>
                  </option>
                <?php endforeach; ?>
              <?php else: ?>
                <p>Tidak ada data jenis obat.</p>
              <?php endif; ?>
            </select>

          </div>
          <div class="form-group">
            <label for="nama">Nama Obat:</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan:</label>
            <input type="text" class="form-control" id="satuan" name="satuan" required>
          </div>
          <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="text" class="form-control" id="harga" name="harga" required>
          </div>
          <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="text" class="form-control" id="stok" name="stok" required>
          </div>
          <div class="form-group">
            <label for="tanggal_expired">Tanggal Expired:</label>
            <input type="date" class="form-control" id="tanggal_expired" name="tanggal_expired"
              value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
          </div>

          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </div>
    </div>
  </div>
</form>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabelEdit" aria-hidden="true"
  id="modal-edit-<?php echo $row->id; ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelEdit">Edit Obat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $this->load->view('module/obat/edit', array('obat' => $row)); ?>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    $('#modal-tambah').on('show.bs.modal', function (e) {
      $('#form-tambah').trigger('reset');
    });

    $('#form-tambah').submit(function (e) {
      e.preventDefault();
      $.ajax({
        url: '<?php echo base_url('obat/proses_tambah'); ?>',
        type: 'post',
        data: $(this).serialize(),
        success: function (data) {
          var result = $.parseJSON(data);
          if (result.status) {
            $('#modal-tambah').modal('hide');

            var obat = result.obat;

            var newRow = '<tr>' +
              '<td>' + obat.id + '</td>' +
              '<td>' + obat.nama + '</td>' +
              '<td>' +
              '<button type="button" class="btn btn-warning btn-edit" data-id="' + obat.id + '">Edit</button>' +
              '<a href="<?php echo base_url('obat/hapus/'); ?>' + obat.id + '" class="btn btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus jenis obat ini?\')">Hapus</a>' +
              '</td>' +
              '</tr>';

            $('tbody').append(newRow);
          } else {
            alert('Gagal menambah jenis obat.');
          }
        }
      });
    });

    $('.btn-edit').click(function () {
      var id = $(this).data('id');
      $.ajax({
        url: 'obat/edit/' + id,
        type: 'get',
        success: function (data) {
          $('#modal-edit-' + id + ' .modal-body').html(data);
          $('#modal-edit-' + id).modal('show');
        }
      });
    });

    $('[id^="modal-edit"]').on('submit', 'form', function (e) {
      e.preventDefault();
      var id = $(this).find('input[name="id"]').val();
      $.ajax({
        url: "<?php echo base_url('obat/proses_edit'); ?>",
        type: 'post',
        data: $(this).serialize(),
        success: function (data) {
          var result = $.parseJSON(data);
          if (result.status) {
            $('#modal-edit-' + id).modal('hide');
            location.reload();
          } else {
            alert('Gagal mengedit obat.');
          }
        }
      });
    });
  });
</script>