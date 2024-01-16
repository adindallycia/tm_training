<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<form action="<?php echo base_url('obat/proses_edit'); ?>" method="post" id="editForm">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="id" value="<?php echo $obat->id; ?>">

    <div class="form-group">
        <label for="id_jenis_obat">Jenis Obat:</label>
        <select class="form-control" name="id_jenis_obat" required>
            <?php if (is_array($jenis_obat_options) && !empty($jenis_obat_options)): ?>
                <?php foreach ($jenis_obat_options as $jenis): ?>
                    <option value="<?php echo $jenis->id; ?>" <?php echo ($jenis->id == $obat->id_jenis_obat) ? 'selected' : ''; ?>>
                        <?php echo $jenis->nama; ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">Tidak ada data jenis obat.</option>
            <?php endif; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="nama">Nama Obat:</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $obat->nama; ?>" required>
    </div>

    <div class="form-group">
        <label for="satuan">Satuan:</label>
        <input type="text" class="form-control" name="satuan" value="<?php echo $obat->satuan; ?>" required>
    </div>

    <div class="form-group">
        <label for="harga">Harga:</label>
        <input type="text" class="form-control" name="harga" value="<?php echo $obat->harga; ?>" required>
    </div>

    <div class="form-group">
        <label for="stok">Stok:</label>
        <input type="text" class="form-control" name="stok" value="<?php echo $obat->stok; ?>" required>
    </div>

    <div class="form-group">
        <label for="tanggal_expired">Tanggal Expired:</label>
        <input type="date" class="form-control" name="tanggal_expired" value="<?php echo $obat->tanggal_expired; ?>" required>
    </div>

    <button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $("#btnSimpan").click(function () {
            var formData = $("#editForm").serialize();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('obat/proses_edit'); ?>",
                data: formData,
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        console.log('Update successful');
                        location.reload();
                    } else {
                        console.error('Error updating obat:', response.error);
                        alert('Update failed: ' + response.error);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX request failed with status:', status, 'and error:', error);
                }
            });
        });
    });
</script>