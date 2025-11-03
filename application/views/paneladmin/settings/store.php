<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengaturan Sistem</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pengaturan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-cogs mr-2"></i>
                            Daftar Pengaturan Sistem
                        </h3>
                        <div class="card-tools">
                            <a href="<?= base_url('admin/settings/create') ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus mr-1"></i> Tambah Pengaturan
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if (!empty($settings)): ?>
                            <div class="table-responsive">
                                <table id="settingsTable" class="table table-bordered table-striped">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="15%">Nama Aplikasi</th>
                                            <th width="20%">Perusahaan</th>
                                            <th width="15%">Kontak</th>
                                            <th width="10%">Logo</th>
                                            <th width="15%">Terakhir Update</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($settings as $index => $row): ?>
                                            <tr>
                                                <td class="text-center"><?= $index + 1 ?></td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <strong class="text-primary"><?= $row->name ?></strong>
                                                        <?php if (!empty($row->description)): ?>
                                                            <small class="text-muted"><?= character_limiter($row->description, 50) ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <strong><?= $row->company ?></strong>
                                                        <small class="text-muted">
                                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                                            <?= character_limiter($row->address, 30) ?>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <?php if (!empty($row->telepon)): ?>
                                                            <small>
                                                                <i class="fas fa-phone text-success mr-1"></i>
                                                                <?= $row->telepon ?>
                                                            </small>
                                                        <?php endif; ?>
                                                        <?php if (!empty($row->email)): ?>
                                                            <small>
                                                                <i class="fas fa-envelope text-info mr-1"></i>
                                                                <?= $row->email ?>
                                                            </small>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <?php if (!empty($row->logo)): ?>
                                                        <img src="<?= base_url('assets/uploads/settings/' . $row->logo) ?>"
                                                            alt="Logo"
                                                            class="img-thumbnail"
                                                            style="max-width: 50px; max-height: 50px;"
                                                            data-toggle="tooltip"
                                                            title="Klik untuk melihat ukuran penuh"
                                                            onclick="showImageModal('<?= base_url('assets/uploads/settings/' . $row->logo) ?>', '<?= $row->name ?>')">
                                                    <?php else: ?>
                                                        <span class="badge badge-secondary">
                                                            <i class="fas fa-image mr-1"></i>Tidak ada
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (isset($row->updated_at)): ?>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            <?= date('d/m/Y H:i', strtotime($row->updated_at)) ?>
                                                        </small>
                                                    <?php else: ?>
                                                        <small class="text-muted">Belum ada data</small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?= base_url('admin/settings/edit/' . $row->id) ?>"
                                                            class="btn btn-warning btn-sm"
                                                            data-toggle="tooltip"
                                                            title="Edit Pengaturan">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button"
                                                            class="btn btn-info btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#detailModal"
                                                            onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)"
                                                            title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete(<?= $row->id ?>, '<?= $row->name ?>')"
                                                            data-toggle="tooltip"
                                                            title="Hapus Pengaturan">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Belum ada pengaturan sistem</h5>
                                <p class="text-muted">Klik tombol "Tambah Pengaturan" untuk membuat pengaturan baru</p>
                                <a href="<?= base_url('admin/settings/create') ?>" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Pengaturan Pertama
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle mr-2"></i>Detail Pengaturan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalTitle">Logo</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="imageModalContent" src="" alt="Logo" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#settingsTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 10,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data yang tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Show detail function
    function showDetail(data) {
        const content = `
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-primary"><i class="fas fa-info-circle mr-2"></i>Informasi Umum</h6>
                <table class="table table-sm">
                    <tr>
                        <td width="40%"><strong>Nama Aplikasi:</strong></td>
                        <td>${data.name || '-'}</td>
                    </tr>
                    <tr>
                        <td><strong>Deskripsi:</strong></td>
                        <td>${data.description || '-'}</td>
                    </tr>
                    <tr>
                        <td><strong>Perusahaan:</strong></td>
                        <td>${data.company || '-'}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-success"><i class="fas fa-address-book mr-2"></i>Informasi Kontak</h6>
                <table class="table table-sm">
                    <tr>
                        <td width="40%"><strong>Alamat:</strong></td>
                        <td>${data.address || '-'}</td>
                    </tr>
                    <tr>
                        <td><strong>Telepon:</strong></td>
                        <td>${data.telepon || '-'}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>${data.email || '-'}</td>
                    </tr>
                </table>
            </div>
        </div>
        ${data.logo ? `
            <div class="row mt-3">
                <div class="col-12">
                    <h6 class="text-info"><i class="fas fa-image mr-2"></i>Logo</h6>
                    <div class="text-center">
                        <img src="${base_url}assets/uploads/settings/${data.logo}" 
                             alt="Logo" 
                             class="img-thumbnail"
                             style="max-width: 200px;">
                    </div>
                </div>
            </div>
        ` : ''}
        <div class="row mt-3">
            <div class="col-12">
                <h6 class="text-warning"><i class="fas fa-clock mr-2"></i>Informasi Waktu</h6>
                <small class="text-muted">
                    <strong>Terakhir Diupdate:</strong> 
                    ${data.updated_at ? new Date(data.updated_at).toLocaleString('id-ID') : 'Belum ada data'}
                </small>
            </div>
        </div>
    `;

        $('#detailContent').html(content);
    }

    // Show image modal
    function showImageModal(src, title) {
        $('#imageModalTitle').text('Logo - ' + title);
        $('#imageModalContent').attr('src', src);
        $('#imageModal').modal('show');
    }

    // Confirm delete function
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus pengaturan "${name}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `<?= base_url('admin/settings/delete/') ?>${id}`;
            }
        });
    }

    // Base URL for JavaScript
    const base_url = '<?= base_url() ?>';
</script>