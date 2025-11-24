<!-- Welcome Message -->
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-info">
            <h4><i class="fas fa-user-tie"></i> Selamat Datang, <?php echo $this->session->userdata('email'); ?>!</h4>
            <p class="mb-0">Dashboard Admin Politeknik Kesehatan Jakarta III - <?php echo date('d F Y'); ?></p>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <!-- Total Berita -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo number_format($dashboard_stats['total_berita']); ?></h3>
                <p>Total Berita</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="<?php echo site_url('admin/news'); ?>" class="small-box-footer">
                Kelola Berita <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <!-- Total Program Studi -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo number_format($dashboard_stats['total_prodi']); ?></h3>
                <p>Program Studi</p>
            </div>
            <div class="icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <a href="<?php echo site_url('admin/prodi'); ?>" class="small-box-footer">
                Kelola Prodi <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <!-- Total Jurusan -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo number_format($dashboard_stats['total_jurusan']); ?></h3>
                <p>Total Jurusan</p>
            </div>
            <div class="icon">
                <i class="fas fa-building"></i>
            </div>
            <a href="<?php echo site_url('admin/department'); ?>" class="small-box-footer">
                Kelola Jurusan <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <!-- Pengunjung Hari Ini -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo number_format($dashboard_stats['pengunjung_hari_ini']); ?></h3>
                <p>Pengunjung Hari Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="<?php echo site_url('admin/analytics'); ?>" class="small-box-footer">
                Lihat Analytics <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Content Sections -->
<div class="row">
    <!-- Berita Hari Ini -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-newspaper mr-2"></i>
                    Berita Hari Ini
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php if (!empty($berita_hari_ini)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($berita_hari_ini as $berita): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo character_limiter(htmlspecialchars($berita->title), 50); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary"><?php echo htmlspecialchars($berita->category_name ?? 'Umum'); ?></span>
                                        </td>
                                        <td>
                                            <?php if ($berita->status == 'published'): ?>
                                                <span class="badge badge-success">Published</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Draft</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?php echo date('H:i', strtotime($berita->published_at ?? $berita->created_at)); ?>
                                            </small>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url('admin/news/edit/' . $berita->id); ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="<?php echo site_url('admin/news'); ?>" class="btn btn-primary">
                            <i class="fas fa-newspaper mr-2"></i>Lihat Semua Berita
                        </a>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada berita hari ini</p>
                        <a href="<?php echo site_url('admin/news/'); ?>" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i>Tambah Berita Baru
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Stats & Actions -->
    <div class="col-lg-4">
        <!-- Program Studi Terpopuler -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Program Studi
                </h3>
            </div>
            <div class="card-body">
                <?php if (!empty($prodi_list)): ?>
                    <?php foreach ($prodi_list as $prodi): ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <strong><?php echo htmlspecialchars($prodi->nama_prodi ?? 'Program Studi'); ?></strong>
                                <br>
                                <small class="text-muted"><?php echo htmlspecialchars($prodi->jenjang ?? 'D3/D4'); ?></small>
                            </div>
                            <div class="text-right">
                                <span class="badge badge-info"><?php echo $prodi->total_mahasiswa ?? '0'; ?> mhs</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted text-center">Belum ada data program studi</p>
                <?php endif; ?>
                <div class="text-center mt-3">
                    <a href="<?php echo site_url('admin/prodi'); ?>" class="btn btn-success btn-sm">
                        <i class="fas fa-graduation-cap mr-1"></i>Kelola Program Studi
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bolt mr-2"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <a href="<?php echo site_url('admin/news/'); ?>" class="btn btn-primary btn-block mb-2">
                            <i class="fas fa-plus mb-1"></i><br>
                            <small>Tambah Berita</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo site_url('admin/prodi/'); ?>" class="btn btn-success btn-block mb-2">
                            <i class="fas fa-graduation-cap mb-1"></i><br>
                            <small>Tambah Prodi</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo site_url('admin/facilities/'); ?>" class="btn btn-info btn-block mb-2">
                            <i class="fas fa-building mb-1"></i><br>
                            <small>Tambah Fasilitas</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo site_url('admin/sdm/'); ?>" class="btn btn-warning btn-block mb-2">
                            <i class="fas fa-user-tie mb-1"></i><br>
                            <small>Tambah SDM</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Stats Row -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-gradient-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <i class="fas fa-calendar-day fa-2x text-white"></i>
                    </div>
                    <div class="col-8 text-right">
                        <h4 class="text-white"><?php echo date('d'); ?></h4>
                        <p class="text-white mb-0"><?php echo strftime('%B %Y'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-gradient-success">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <i class="fas fa-clock fa-2x text-white"></i>
                    </div>
                    <div class="col-8 text-right">
                        <h4 class="text-white" id="current-time"></h4>
                        <p class="text-white mb-0">Waktu Saat Ini</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-gradient-info">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <i class="fas fa-server fa-2x text-white"></i>
                    </div>
                    <div class="col-8 text-right">
                        <h4 class="text-white">Online</h4>
                        <p class="text-white mb-0">Server Status</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update waktu real-time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        document.getElementById('current-time').textContent = timeString;
    }

    // Update setiap detik
    setInterval(updateTime, 1000);
    updateTime(); // Initial call
</script>