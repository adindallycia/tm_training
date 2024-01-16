<form action="<?php echo base_url('users/proses_edit'); ?>" method="post" id="editUserForm">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="id" value="<?php echo $users->id; ?>">

    <div class="form-group">
        <label for="fullname">Full Name:</label>
        <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $users->fullname; ?>"
            required>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $users->username; ?>"
            required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?php echo ($users->is_active == 1) ? 'checked' : ''; ?>>
        <label class="form-check-label" for="is_active">Active</label>
    </div>

    <button type="submit" class="btn btn-primary" id="btnEditUser">Simpan</button>
</form>