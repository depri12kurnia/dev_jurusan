<div class="row">
    <div class="col-md-12">
        <!-- Program Studi Header -->
        <div class="d-flex align-items-center mb-4">
            <div class="program-icon mr-3" style="background-color: <?= $prodi->warna ?>; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                <i class="<?= $prodi->icon ?? 'fas fa-graduation-cap' ?>"></i>
            </div>
            <div>
                <h4 class="mb-1"><?= $prodi->nama_prodi ?></h4>
                <p class="text-muted mb-0">
                    <span class="badge" style="background-color: <?= $prodi->warna ?>;"><?= $prodi->jenjang ?></span>
                    <span class="badge badge-secondary ml-1"><?= $prodi->kode_prodi ?></span>
                    <?php if ($prodi->akreditasi): ?>
                        <span class="badge badge-success ml-1">Akreditasi <?= $prodi->akreditasi ?></span>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Tabs Navigation -->
<ul class="nav nav-tabs" id="prodiDetailTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab" aria-controls="basic" aria-selected="true">
            <i class="fas fa-info-circle mr-1"></i> Info Dasar
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="academic-tab" data-toggle="tab" href="#academic" role="tab" aria-controls="academic" aria-selected="false">
            <i class="fas fa-graduation-cap mr-1"></i> Akademik
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
            <i class="fas fa-address-book mr-1"></i> Kontak
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="stats-tab" data-toggle="tab" href="#stats" role="tab" aria-controls="stats" aria-selected="false">
            <i class="fas fa-chart-bar mr-1"></i> Statistik
        </a>
    </li>
</ul>

<!-- Tabs Content -->
<div class="tab-content mt-3" id="prodiDetailTabsContent">

    <!-- Basic Info Tab -->
    <div class="tab-pane fade show active" id="basic" role="tabpanel">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="font-weight-bold" width="40%">Nama Program Studi:</td>
                        <td><?= $prodi->nama_prodi ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Kode Prodi:</td>
                        <td><code><?= $prodi->kode_prodi ?></code></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Jenjang:</td>
                        <td><span class="badge" style="background-color: <?= $prodi->warna ?>;"><?= $prodi->jenjang ?></span></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Gelar:</td>
                        <td><code><?= $prodi->gelar ?></code></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Status:</td>
                        <td>
                            <span class="badge <?= $prodi->status == 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                <?= ucfirst($prodi->status) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Featured:</td>
                        <td>
                            <?php if ($prodi->is_featured): ?>
                                <i class="fas fa-star text-warning mr-1"></i> Ya
                            <?php else: ?>
                                <i class="far fa-star text-muted mr-1"></i> Tidak
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="font-weight-bold" width="40%">Publikasi:</td>
                        <td>
                            <?php if ($prodi->is_published): ?>
                                <i class="fas fa-check-circle text-success mr-1"></i> Ya
                            <?php else: ?>
                                <i class="fas fa-times-circle text-danger mr-1"></i> Tidak
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Urutan Tampil:</td>
                        <td><span class="badge badge-info"><?= $prodi->urutan ?? 0 ?></span></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Warna Tema:</td>
                        <td>
                            <span class="d-inline-block rounded mr-2" style="width: 20px; height: 20px; background-color: <?= $prodi->warna ?>;"></span>
                            <code><?= $prodi->warna ?></code>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Icon:</td>
                        <td><i class="<?= $prodi->icon ?? 'fas fa-graduation-cap' ?> mr-2"></i> <code><?= $prodi->icon ?? 'fas fa-graduation-cap' ?></code></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Dibuat:</td>
                        <td><?= date('d/m/Y H:i', strtotime($prodi->created_at)) ?></td>
                    </tr>
                    <?php if ($prodi->updated_at && $prodi->updated_at != $prodi->created_at): ?>
                        <tr>
                            <td class="font-weight-bold">Diperbarui:</td>
                            <td><?= date('d/m/Y H:i', strtotime($prodi->updated_at)) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>

        <?php if ($prodi->deskripsi): ?>
            <div class="mt-3">
                <h6 class="font-weight-bold">Deskripsi:</h6>
                <p class="text-muted"><?= nl2br($prodi->deskripsi) ?></p>
            </div>
        <?php endif; ?>

        <?php if ($prodi->featured_description && $prodi->featured_description != $prodi->deskripsi): ?>
            <div class="mt-3">
                <h6 class="font-weight-bold">Deskripsi Featured:</h6>
                <p class="text-muted"><?= nl2br($prodi->featured_description) ?></p>
            </div>
        <?php endif; ?>

        <?php if ($prodi->visi || $prodi->misi || $prodi->tujuan): ?>
            <div class="row mt-4">
                <?php if ($prodi->visi): ?>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold text-primary">Visi</h6>
                        <p class="small text-muted"><?= nl2br($prodi->visi) ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($prodi->misi): ?>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold text-success">Misi</h6>
                        <p class="small text-muted"><?= nl2br($prodi->misi) ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($prodi->tujuan): ?>
                    <div class="col-md-4">
                        <h6 class="font-weight-bold text-warning">Tujuan</h6>
                        <p class="small text-muted"><?= nl2br($prodi->tujuan) ?></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Academic Info Tab -->
    <div class="tab-pane fade" id="academic" role="tabpanel">
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold mb-3">Informasi Akademik</h6>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="font-weight-bold" width="50%">Durasi Studi:</td>
                        <td><?= $prodi->durasi_studi ?> Semester</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Total SKS:</td>
                        <td><?= $prodi->sks_total ?> SKS</td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold">Kuota Mahasiswa/Tahun:</td>
                        <td><?= $prodi->kuota_mahasiswa ?: 'Tidak ditentukan' ?></td>
                    </tr>
                    <?php if ($prodi->biaya_pendidikan): ?>
                        <tr>
                            <td class="font-weight-bold">Biaya Pendidikan:</td>
                            <td>Rp <?= number_format($prodi->biaya_pendidikan, 0, ',', '.') ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="font-weight-bold mb-3">Akreditasi</h6>
                <table class="table table-sm table-borderless">
                    <?php if ($prodi->akreditasi): ?>
                        <tr>
                            <td class="font-weight-bold" width="50%">Status Akreditasi:</td>
                            <td>
                                <?php
                                $badge_class = 'bg-secondary';
                                if (in_array($prodi->akreditasi, ['A', 'Unggul'])) {
                                    $badge_class = 'bg-success';
                                } elseif (in_array($prodi->akreditasi, ['B', 'Baik Sekali'])) {
                                    $badge_class = 'bg-primary';
                                } elseif (in_array($prodi->akreditasi, ['C', 'Baik'])) {
                                    $badge_class = 'bg-warning';
                                }
                                ?>
                                <span class="badge <?= $badge_class ?>"><?= $prodi->akreditasi ?></span>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->no_sk_akreditasi): ?>
                        <tr>
                            <td class="font-weight-bold">No. SK Akreditasi:</td>
                            <td><code><?= $prodi->no_sk_akreditasi ?></code></td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->tanggal_akreditasi): ?>
                        <tr>
                            <td class="font-weight-bold">Tanggal Akreditasi:</td>
                            <td><?= date('d/m/Y', strtotime($prodi->tanggal_akreditasi)) ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->masa_berlaku_akreditasi): ?>
                        <tr>
                            <td class="font-weight-bold">Masa Berlaku:</td>
                            <td><?= date('d/m/Y', strtotime($prodi->masa_berlaku_akreditasi)) ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>

        <?php if ($prodi->prospek_karir): ?>
            <div class="mt-4">
                <h6 class="font-weight-bold">Prospek Karir</h6>
                <p class="text-muted"><?= nl2br($prodi->prospek_karir) ?></p>
            </div>
        <?php endif; ?>

        <?php if ($prodi->syarat_masuk): ?>
            <div class="mt-4">
                <h6 class="font-weight-bold">Syarat Masuk</h6>
                <p class="text-muted"><?= nl2br($prodi->syarat_masuk) ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Contact Info Tab -->
    <div class="tab-pane fade" id="contact" role="tabpanel">
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold mb-3">Kontak Program Studi</h6>
                <table class="table table-sm table-borderless">
                    <?php if ($prodi->kontak_person): ?>
                        <tr>
                            <td class="font-weight-bold" width="40%">Contact Person:</td>
                            <td><?= $prodi->kontak_person ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->email): ?>
                        <tr>
                            <td class="font-weight-bold">Email:</td>
                            <td><a href="mailto:<?= $prodi->email ?>"><?= $prodi->email ?></a></td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->telepon): ?>
                        <tr>
                            <td class="font-weight-bold">Telepon:</td>
                            <td><a href="tel:<?= $prodi->telepon ?>"><?= $prodi->telepon ?></a></td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->website): ?>
                        <tr>
                            <td class="font-weight-bold">Website:</td>
                            <td><a href="<?= $prodi->website ?>" target="_blank"><?= $prodi->website ?></a></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="font-weight-bold mb-3">Pimpinan Program Studi</h6>
                <table class="table table-sm table-borderless">
                    <?php if ($prodi->kepala_prodi): ?>
                        <tr>
                            <td class="font-weight-bold" width="50%">Kepala Prodi:</td>
                            <td><?= $prodi->kepala_prodi ?></td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->sekretaris_prodi): ?>
                        <tr>
                            <td class="font-weight-bold">Sekretaris Prodi:</td>
                            <td><?= $prodi->sekretaris_prodi ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>

        <?php if ($prodi->alamat): ?>
            <div class="mt-4">
                <h6 class="font-weight-bold">Alamat</h6>
                <p class="text-muted"><?= nl2br($prodi->alamat) ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Statistics Tab -->
    <div class="tab-pane fade" id="stats" role="tabpanel">
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold mb-3">Statistik Akademik</h6>
                <div class="row">
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center p-3">
                                <h4 class="text-primary mb-1"><?= $prodi->jumlah_dosen ?: '0' ?></h4>
                                <small class="text-muted">Jumlah Dosen</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center p-3">
                                <h4 class="text-success mb-1"><?= $prodi->jumlah_mahasiswa_aktif ?: '0' ?></h4>
                                <small class="text-muted">Mahasiswa Aktif</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center p-3">
                                <h4 class="text-info mb-1"><?= $prodi->jumlah_alumni ?: '0' ?></h4>
                                <small class="text-muted">Jumlah Alumni</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-light">
                            <div class="card-body text-center p-3">
                                <h4 class="text-warning mb-1"><?= $prodi->kuota_mahasiswa ?: '0' ?></h4>
                                <small class="text-muted">Kuota/Tahun</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h6 class="font-weight-bold mb-3">Indikator Kinerja</h6>
                <table class="table table-sm table-borderless">
                    <?php if ($prodi->tingkat_kepuasan_mahasiswa): ?>
                        <tr>
                            <td class="font-weight-bold" width="60%">Tingkat Kepuasan Mahasiswa:</td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $prodi->tingkat_kepuasan_mahasiswa ?>%">
                                        <?= $prodi->tingkat_kepuasan_mahasiswa ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->tingkat_kelulusan): ?>
                        <tr>
                            <td class="font-weight-bold">Tingkat Kelulusan:</td>
                            <td>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $prodi->tingkat_kelulusan ?>%">
                                        <?= $prodi->tingkat_kelulusan ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php if ($prodi->lama_tunggu_kerja): ?>
                        <tr>
                            <td class="font-weight-bold">Lama Tunggu Kerja:</td>
                            <td><span class="badge badge-info"><?= $prodi->lama_tunggu_kerja ?> bulan</span></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="d-flex justify-content-between mt-4">
    <div>
        <?php if ($prodi->slug): ?>
            <a href="<?= site_url('program-studi/' . $prodi->slug) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-external-link-alt mr-1"></i> Lihat di Website
            </a>
        <?php endif; ?>
    </div>
    <div>
        <a href="<?= site_url('admin/prodi/edit/' . $prodi->id) ?>" class="btn btn-warning btn-sm">
            <i class="fas fa-edit mr-1"></i> Edit
        </a>
        <button type="button" class="btn btn-danger btn-sm" onclick="deleteProdi(<?= $prodi->id ?>, '<?= $prodi->nama_prodi ?>')">
            <i class="fas fa-trash mr-1"></i> Hapus
        </button>
    </div>
</div>

<!-- Script untuk AdminLTE 3 Tabs -->
<script>
    $(document).ready(function() {
        // Initialize tabs manually for AdminLTE 3 compatibility
        $('#prodiDetailTabs a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // Activate first tab by default
        $('#basic-tab').tab('show');
    });
</script>