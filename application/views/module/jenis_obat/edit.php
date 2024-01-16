<form action="<?php echo base_url('jenis_obat/proses_edit'); ?>" method="post" id="editJenisForm">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
        value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="id" value="<?php echo $jenis_obat->id; ?>">
    <div class="form-group">
        <label for="nama">Nama Jenis Obat:</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $jenis_obat->nama; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" id="btnEditJenis">Simpan</button>
</form>