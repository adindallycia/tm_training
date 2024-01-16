<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Data User</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-user">
                    Tambah User
                </button>
                <p>Total User           : <?php echo $total_users; ?></p>  
                <p>Total User Active    : <?php echo $active_users; ?></p>   
                <p>Total User Inactive  : <?php echo $inactive_users; ?></p>   
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <?php echo $user->id; ?>
                                </td>
                                <td>
                                    <?php echo $user->fullname; ?>
                                </td>
                                <td>
                                    <?php echo $user->username; ?>
                                </td>
                                <td>
                                    <?php echo ($user->is_active) ? 'Active' : 'Inactive'; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-edit-user" data-id="<?= $user->id; ?>"
                                        data-toggle="modal" data-target="#modal-edit-user">Edit</button>
                                    <a href="<?php echo base_url('users/hapus/' . $user->id); ?>" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tambah-user" tabindex="-1" role="dialog" aria-labelledby="modalLabelTambahUser"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelTambahUser">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('users/proses_tambah'); ?>" method="post" id="tambahUserForm">
                    <div class="form-group">
                        <label for="fullname">Full Name:</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btnTambahUser">Tambah</button>
                    <div class="spinner-border text-primary mt-2" role="status" style="display:none;"
                        id="spinnerTambahJenis">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="alert alert-danger mt-2" role="alert" id="errorTambahUser" style="display:none;"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="modalLabelEditUser"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelEditUser">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $this->load->view('module/users/edit', array('users' => $user)); ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
        $('#modal-tambah-user').on('show.bs.modal', function (e) {
            $('#tambahUserForm').trigger('reset');
            $('#errorTambahUser').hide();
        });

        $('#tambahUserForm').submit(function (e) {
            e.preventDefault();
            $('#btnTambahUser').hide();
            $('#spinnerTambahUser').show();
            $('#errorTambahUser').hide();

            $.ajax({
                url: '<?php echo base_url('users/proses_tambah'); ?>',
                type: 'post',
                data: {
                    fullname: $('#fullname').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                    <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.status) {
                        $('#modal-tambah-user').modal('hide');
                        location.reload();
                    } else {
                        $('#errorTambahUser').text('Gagal menambah user.');
                        $('#errorTambahUser').show();
                    }
                },
                error: function (xhr, status, error) {
                    $('#errorTambahUser').text('Error: ' + error);
                    $('#errorTambahUser').show();
                },
                complete: function () {
                    $('#btnTambahUser').show();
                    $('#spinnerTambahUser').hide();
                }
            });
        });

        $('.btn-edit-user').click(function () {
            var id = $(this).data('id');
            $.ajax({
                url: '<?php echo base_url('users/edit/'); ?>' + id,
                type: 'get',
                success: function (data) {
                    $('#modal-edit-user .modal-body').html(data);
                    $('#modal-edit-user').modal('show');
                }
            });
        });


        $('#modal-edit-user').on('show.bs.modal', function (e) {
            $('#btnEditUser').show();
            $('#spinnerEditUser').hide();
            $('#errorEditUser').hide();
        });

        $('#btnEditUser').click(function () {
            var id = $('#id').val();

            $.ajax({
                url: '<?php echo base_url('users/proses_edit'); ?>',
                type: 'post',
                data: $('#editUserForm').serialize() + '&<?php echo $this->security->get_csrf_token_name(); ?>=' + csrf_token,
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.status) {
                        $('#modal-edit-user').modal('hide');
                        location.reload();
                    } else {
                        $('#errorEditUser').text('Gagal mengedit user.');
                        $('#errorEditUser').show();
                    }
                },
                error: function (xhr, status, error) {
                    $('#errorEditUser').text('Error: ' + error);
                    $('#errorEditUser').show();
                },
                complete: function () {
                    $('#btnEditUser').show();
                    $('#spinnerEditUser').hide();
                }
            });
        });
    });
</script>