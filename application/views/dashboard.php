<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
        <?php if (isset($fullname)): ?>
          <p>Selamat datang
            <?php echo $fullname; ?>!
          </p>
        <?php else: ?>
          <p>Fullname tidak tersedia.</p>
        <?php endif; ?>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>
              <?php echo $total_jenis_obat; ?>
            </h3>

            <p>Jenis Obat</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="<?php echo base_url('jenis_obat'); ?>" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>
              <?php echo $total_obat; ?>
            </h3>

            <p>Total Obat</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="<?php echo base_url('obat'); ?>" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>
              <?php echo $total_users; ?>
            </h3>

            <p>User</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="<?php echo base_url('users'); ?>" class="small-box-footer">More info <i
              class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

    </div>
    <div class="row">
      <div class="col-md-12">
        <h2>Data Obat</h2>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nama Obat</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Jumlah Harga</th>
              <th>Tanggal Expired</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($obat_data as $obat): ?>
              <tr>
                <td>
                  <?php echo $obat->nama; ?>
                </td>
                <td>
                  <?php echo $obat->satuan; ?>
                </td>
                <td>Rp.
                  <?php echo $obat->harga; ?>
                </td>
                <td>
                  <?php echo $obat->stok; ?>
                </td>
                <td>Rp.
                  <?php echo $obat->harga * $obat->stok; ?>
                </td>
                <td>
                  <?php echo $obat->tanggal_expired; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.row -->
    </div>

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->