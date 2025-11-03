<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <i class="fas fa-check-circle mr-2"></i>
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        <?php endif; ?>

        <!-- Main Card -->
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-list mr-2"></i>
                            Daftar Program Studi
                        </h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="btn-group">
                            <a href="<?= site_url('admin/prodi/create') ?>" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i> Tambah Program Studi
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-cog mr-1"></i> Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="exportData('excel')">
                                        <i class="fas fa-file-excel mr-2"></i> Export Excel
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="exportData('pdf')">
                                        <i class="fas fa-file-pdf mr-2"></i> Export PDF
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" onclick="refreshTable()">
                                        <i class="fas fa-sync mr-2"></i> Refresh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <!-- Filter dan Search -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Filter Jenjang</label>
                        <select id="filterJenjang" class="form-control form-control-sm">
                            <option value="">Semua Jenjang</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="PROFESI">Profesi</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Filter Status</label>
                        <select id="filterStatus" class="form-control form-control-sm">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Filter Akreditasi</label>
                        <select id="filterAkreditasi" class="form-control form-control-sm">
                            <option value="">Semua Akreditasi</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="Unggul">Unggul</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Cari Program Studi</label>
                        <div class="input-group input-group-sm">
                            <input type="text" id="searchBox" class="form-control" placeholder="Cari nama atau kode...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bulk Actions -->
                <form id="bulkActionForm" method="post" action="<?= site_url('admin/prodi/bulk_action') ?>">
                    <div class="row mb-3" id="bulkActions" style="display: none;">
                        <div class="col-md-8">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span id="selectedCount" class="badge badge-info">0</span> item dipilih
                                    </span>
                                </div>
                                <select name="bulk_action" class="form-control" required>
                                    <option value="">Pilih Aksi</option>
                                    <option value="activate">Aktifkan</option>
                                    <option value="deactivate">Nonaktifkan</option>
                                    <option value="featured">Set Featured</option>
                                    <option value="unfeatured">Unset Featured</option>
                                    <option value="delete">Hapus</option>
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-play mr-1"></i> Jalankan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table id="prodiTable" class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="30">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="selectAll">
                                        </div>
                                    </th>
                                    <th width="50">No</th>
                                    <th>Program Studi</th>
                                    <th width="80">Kode</th>
                                    <th width="90">Jenjang</th>
                                    <th width="100">Gelar</th>
                                    <th width="100">Akreditasi</th>
                                    <th width="90">Status</th>
                                    <th width="80">Featured</th>
                                    <th width="80">Urutan</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($prodi_list)): ?>
                                    <?php foreach ($prodi_list as $index => $prodi): ?>
                                        <tr data-jenjang="<?= $prodi->jenjang ?>" data-status="<?= $prodi->status ?>" data-akreditasi="<?= $prodi->akreditasi ?>">
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input select-item" type="checkbox" name="selected_ids[]" value="<?= $prodi->id ?>">
                                                </div>
                                            </td>
                                            <td><?= $index + 1 ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="program-icon mr-3" style="background-color: <?= $prodi->warna ?>20; color: <?= $prodi->warna ?>; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="<?= $prodi->icon ?? 'fas fa-graduation-cap' ?>"></i>
                                                    </div>
                                                    <div>
                                                        <strong class="d-block"><?= $prodi->nama_prodi ?></strong>
                                                        <?php if (!empty($prodi->deskripsi)): ?>
                                                            <small class="text-muted"><?= character_limiter($prodi->deskripsi, 50) ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary"><?= $prodi->kode_prodi ?></span>
                                            </td>
                                            <td>
                                                <span class="badge" style="background-color: <?= $prodi->warna ?>; color: white;">
                                                    <?= $prodi->jenjang ?>
                                                </span>
                                            </td>
                                            <td>
                                                <code><?= $prodi->gelar ?></code>
                                            </td>
                                            <td>
                                                <?php if ($prodi->akreditasi): ?>
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
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm <?= $prodi->status == 'aktif' ? 'btn-success' : 'btn-secondary' ?>"
                                                    onclick="toggleStatus(<?= $prodi->id ?>, '<?= $prodi->status ?>')">
                                                    <i class="fas fa-<?= $prodi->status == 'aktif' ? 'check' : 'times' ?>"></i>
                                                    <?= ucfirst($prodi->status) ?>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-link p-0" onclick="toggleFeatured(<?= $prodi->id ?>, <?= $prodi->is_featured ?? 0 ?>)">
                                                    <i class="fas fa-star <?= ($prodi->is_featured ?? 0) ? 'text-warning' : 'text-muted' ?>" title="<?= ($prodi->is_featured ?? 0) ? 'Featured' : 'Not Featured' ?>"></i>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-info"><?= $prodi->urutan ?? 0 ?></span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-info" onclick="viewDetail(<?= $prodi->id ?>)" title="Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <a href="<?= site_url('admin/prodi/edit/' . $prodi->id) ?>"
                                                        class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger" onclick="deleteProdi(<?= $prodi->id ?>, '<?= $prodi->nama_prodi ?>')" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="11" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                                                <p class="mb-2">Belum ada data program studi.</p>
                                                <a href="<?= site_url('admin/prodi/create') ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-plus me-1"></i> Tambah Program Studi Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <!-- Card Footer with Statistics -->
            <?php if (!empty($prodi_list)): ?>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= count($prodi_list) ?></h3>
                                    <p>Total Program Studi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= count(array_filter($prodi_list, function ($p) {
                                            return $p->status == 'aktif';
                                        })) ?></h3>
                                    <p>Program Aktif</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= count(array_filter($prodi_list, function ($p) {
                                            return ($p->is_featured ?? 0) == 1;
                                        })) ?></h3>
                                    <p>Program Featured</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= count(array_filter($prodi_list, function ($p) {
                                            return in_array($p->akreditasi, ['A', 'Unggul']);
                                        })) ?></h3>
                                    <p>Akreditasi A/Unggul</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Program Studi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#prodiTable').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 25,
                "order": [
                    [9, 'asc'],
                    [2, 'asc']
                ], // Sort by urutan, then nama_prodi
                "columnDefs": [{
                        "orderable": false,
                        "targets": [0, 10]
                    }, // Disable sorting for checkbox and actions
                    {
                        "searchable": false,
                        "targets": [0, 7, 8, 9, 10]
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                }
            });

            // Custom search
            $('#searchBox').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Clear search
            window.clearSearch = function() {
                $('#searchBox').val('');
                table.search('').draw();
            };

            // Filter functions
            $('#filterJenjang, #filterStatus, #filterAkreditasi').on('change', function() {
                var jenjang = $('#filterJenjang').val();
                var status = $('#filterStatus').val();
                var akreditasi = $('#filterAkreditasi').val();

                $('tbody tr').show();

                if (jenjang) {
                    $('tbody tr:not([data-jenjang="' + jenjang + '"])').hide();
                }
                if (status) {
                    $('tbody tr:not([data-status="' + status + '"])').hide();
                }
                if (akreditasi) {
                    $('tbody tr:not([data-akreditasi="' + akreditasi + '"])').hide();
                }

                updateRowNumbers();
            });

            // Select all functionality
            $('#selectAll').on('change', function() {
                $('.select-item:visible').prop('checked', this.checked);
                updateBulkActions();
            });

            $(document).on('change', '.select-item', function() {
                var totalVisible = $('.select-item:visible').length;
                var checkedVisible = $('.select-item:visible:checked').length;

                $('#selectAll').prop('checked', totalVisible === checkedVisible && totalVisible > 0);
                updateBulkActions();
            });

            function updateBulkActions() {
                var checkedCount = $('.select-item:checked').length;
                $('#selectedCount').text(checkedCount);

                if (checkedCount > 0) {
                    $('#bulkActions').show();
                } else {
                    $('#bulkActions').hide();
                }
            }

            function updateRowNumbers() {
                $('tbody tr:visible').each(function(index) {
                    $(this).find('td:nth-child(2)').text(index + 1);
                });
            }

            // Bulk action form submission
            $('#bulkActionForm').on('submit', function(e) {
                var selectedIds = $('.select-item:checked');
                var action = $('select[name="bulk_action"]').val();

                if (selectedIds.length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal satu item untuk diproses.');
                    return false;
                }

                if (!action) {
                    e.preventDefault();
                    alert('Pilih aksi yang akan dilakukan.');
                    return false;
                }

                var confirmMessage = 'Yakin ingin melakukan aksi ini untuk ' + selectedIds.length + ' item?';
                if (action === 'delete') {
                    confirmMessage = 'PERHATIAN: Data yang dihapus tidak dapat dikembalikan. Yakin ingin menghapus ' + selectedIds.length + ' item?';
                }

                return confirm(confirmMessage);
            });

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });

        // Toggle status function
        function toggleStatus(id, currentStatus) {
            var newStatus = currentStatus === 'aktif' ? 'nonaktif' : 'aktif';

            if (confirm('Yakin ingin mengubah status program studi ini menjadi ' + newStatus + '?')) {
                $.post('<?= site_url("admin/prodi/toggle_status") ?>', {
                    id: id
                }, function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Gagal mengubah status: ' + response.message);
                    }
                }, 'json').fail(function() {
                    alert('Terjadi kesalahan saat mengubah status.');
                });
            }
        }

        // Toggle featured function
        function toggleFeatured(id, currentFeatured) {
            var newFeatured = currentFeatured ? 0 : 1;

            $.post('<?= site_url("admin/prodi/toggle_featured") ?>', {
                id: id,
                featured: newFeatured
            }, function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Gagal mengubah status featured: ' + response.message);
                }
            }, 'json').fail(function() {
                alert('Terjadi kesalahan saat mengubah status featured.');
            });
        }

        // View detail function
        function viewDetail(id) {
            $.get('<?= site_url("admin/prodi/detail_ajax") ?>/' + id, function(data) {
                $('#detailContent').html(data);
                $('#detailModal').modal('show');
            }).fail(function() {
                alert('Gagal memuat detail program studi.');
            });
        }

        // Delete function
        function deleteProdi(id, nama) {
            if (confirm('Yakin ingin menghapus program studi "' + nama + '"?\n\nData yang dihapus tidak dapat dikembalikan.')) {
                $.post('<?= site_url("admin/prodi/delete") ?>', {
                    id: id
                }, function(response) {
                    if (response.success) {
                        location.reload();
                    } else {
                        alert('Gagal menghapus program studi: ' + response.message);
                    }
                }, 'json').fail(function() {
                    // Fallback to regular link if AJAX fails
                    window.location.href = '<?= site_url("admin/prodi/delete") ?>/' + id;
                });
            }
        }

        // Export functions
        function exportData(format) {
            var url = '<?= site_url("admin/prodi/export") ?>?format=' + format;
            window.open(url, '_blank');
        }

        // Refresh table
        function refreshTable() {
            location.reload();
        }
    </script>

    <!-- Custom CSS AdminLTE 3 Compatible -->
    <style>
        /* Main Card Styling */
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #007bff 0%, #6f42c1 100%);
            color: white;
            border-bottom: 0;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        .card-title {
            color: white !important;
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Table Styling */
        .table-dark th {
            background-color: #343a40;
            border-color: #454d55;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.075);
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Program Icon */
        .program-icon {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .program-icon:hover {
            transform: scale(1.05);
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Small Box Widgets */
        .small-box {
            border-radius: 0.375rem;
            position: relative;
            display: block;
            margin-bottom: 20px;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        .small-box>.inner {
            padding: 10px;
        }

        .small-box h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            white-space: nowrap;
            padding: 0;
        }

        .small-box p {
            font-size: 1rem;
            margin: 0;
        }

        .small-box .icon {
            transition: all 0.3s linear;
            position: absolute;
            top: -10px;
            right: 10px;
            z-index: 0;
            font-size: 90px;
            color: rgba(0, 0, 0, 0.15);
        }

        /* Button Styling */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        /* Badge Styling */
        .badge {
            font-size: 75%;
            font-weight: 700;
        }

        /* Alert Styling */
        .alert {
            border: 0;
            border-radius: 0.375rem;
        }

        .alert-dismissible .close {
            position: absolute;
            top: 0;
            right: 0;
            z-index: 2;
            padding: 0.75rem 1.25rem;
            color: inherit;
        }

        /* Form Controls */
        .form-control-sm {
            height: calc(1.5em + 0.5rem + 2px);
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        /* Input Group */
        .input-group-sm>.form-control,
        .input-group-sm>.input-group-prepend>.input-group-text,
        .input-group-sm>.input-group-append>.input-group-text,
        .input-group-sm>.input-group-prepend>.btn,
        .input-group-sm>.input-group-append>.btn {
            height: calc(1.5em + 0.5rem + 2px);
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        /* DataTables Integration */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #495057;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #0056b3;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
                width: 100%;
            }

            .btn-group .btn {
                width: 100%;
                margin-bottom: 0.25rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .small-box h3 {
                font-size: 1.8rem;
            }

            .small-box .icon {
                font-size: 60px;
            }

            .card-header .row>.col-md-6:last-child {
                text-align: center !important;
                margin-top: 1rem;
            }
        }

        /* Loading Animation */
        .loading {
            position: relative;
        }

        .loading:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1000;
        }

        .loading:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #007bff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
            z-index: 1001;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>