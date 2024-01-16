
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Data Jenis Obat</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-jenis">
                    Tambah Jenis Obat
                </button>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Jenis Obat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jenis_obat as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $row->id; ?>
                                </td>
                                <td>
                                    <?php echo $row->nama; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-edit-jenis" data-id="<?= $row->id; ?>"
                                        data-toggle="modal" data-target="#modal-edit-jenis">Edit</button>
                                    <a href="<?php echo base_url('jenis_obat/hapus/' . $row->id); ?>" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus jenis obat ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tambah-jenis" tabindex="-1" role="dialog" aria-labelledby="modalLabelTambahJenis"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelTambahJenis">Tambah Jenis Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('jenis_obat/proses_tambah'); ?>" method="post" id="tambahJenisForm">
                    <div class="form-group">
                        <label for="nama">Nama Jenis Obat:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnTambahJenis">Tambah</button>
                    <div class="spinner-border text-primary mt-2" role="status" style="display:none;"
                        id="spinnerTambahJenis">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="alert alert-danger mt-2" role="alert" id="errorTambahJenis" style="display:none;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-jenis" tabindex="-1" role="dialog" aria-labelledby="modalLabelEditJenis"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelEditJenis">Edit Jenis Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $this->load->view('module/jenis_obat/edit', array('jenis_obat' => $row)); ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
        $('#modal-tambah-jenis').on('show.bs.modal', function (e) {
            $('#tambahJenisForm').trigger('reset');
            $('#errorTambahJenis').hide();
        });

        $('#tambahJenisForm').submit(function (e) {
            e.preventDefault();
            $('#btnTambahJenis').hide();
            $('#spinnerTambahJenis').show();
            $('#errorTambahJenis').hide();

            $.ajax({
                url: '<?php echo base_url('jenis_obat/proses_tambah'); ?>',
                type: 'post',
                data: $(this).serialize() + '&<?php echo $this->security->get_csrf_token_name(); ?>=' + csrf_token,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.status) {
                        $('#modal-tambah-jenis').modal('hide');
                    } else {
                        $('#errorTambahJenis').text('Gagal menambah jenis obat.');
                        $('#errorTambahJenis').show();
                    }
                },
                error: function (xhr, status, error) {
                    $('#errorTambahJenis').text('Error: ' + error);
                    $('#errorTambahJenis').show();
                },
                complete: function () {
                    $('#btnTambahJenis').show();
                    $('#spinnerTambahJenis').hide();
                }
            });
        });

        $('.btn-edit-jenis').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '<?php echo base_url('jenis_obat/edit/'); ?>' + id,
                type: 'get',
                success: function (data) {
                    $('#modal-edit-jenis .modal-body').html(data);
                    $('#modal-edit-jenis').modal('show');
                }
            });
        });

        $('#modal-edit-jenis').on('show.bs.modal', function (e) {
            $('#btnEditJenis').show();
            $('#spinnerEditJenis').hide();
            $('#errorEditJenis').hide();
        });

        $('#btnEditJenis').click(function () {
            var id = $('#id').val();

            $.ajax({
                url: '<?php echo base_url('jenis_obat/proses_edit'); ?>',
                type: 'post',
                data: $('#editJenisForm').serialize() + '&<?php echo $this->security->get_csrf_token_name(); ?>=' + csrf_token,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.status) {
                        $('#modal-edit-jenis').modal('hide');
                    } else {
                        $('#errorEditJenis').text('Gagal mengedit jenis obat.');
                        $('#errorEditJenis').show();
                    }
                },
                error: function (xhr, status, error) {
                    $('#errorEditJenis').text('Error: ' + error);
                    $('#errorEditJenis').show();
                },
                complete: function () {
                    $('#btnEditJenis').show();
                    $('#spinnerEditJenis').hide();
                }
            });
        });
    });
</script>