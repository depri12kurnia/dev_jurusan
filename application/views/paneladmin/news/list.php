<!-- summernote -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@19d5f7d70f5a32386894c2573713049dc9e2e5f0/plugins/summernote/summernote-bs4.min.css">

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-newspaper text-primary mr-2"></i>
                    Manajemen Berita
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Berita</li>
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

        <!-- Statistics Row -->
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="totalNews">-</h3>
                        <p>Total Berita</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="publishedNews">-</h3>
                        <p>Berita Terbit</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="draftNews">-</h3>
                        <p>Draft</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="todayNews">-</h3>
                        <p>Berita Hari Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header bg-gradient-primary">
                        <h3 class="card-title text-white">
                            <i class="fas fa-list mr-2"></i>
                            Daftar Berita
                        </h3>
                        <div class="card-tools">
                            <button class="btn btn-success btn-sm" onclick="add_news()">
                                <i class="fas fa-plus mr-1"></i> Tambah Berita
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Filter Controls -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="filterCategory">Filter Kategori:</label>
                                <select class="form-control form-control-sm" id="filterCategory">
                                    <option value="">Semua Kategori</option>
                                    <?php foreach ($category as $cat): ?>
                                        <option value="<?= $cat->name ?>"><?= $cat->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterStatus">Filter Status:</label>
                                <select class="form-control form-control-sm" id="filterStatus">
                                    <option value="">Semua Status</option>
                                    <option value="published">Terbit</option>
                                    <option value="draft">Draft</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="filterAuthor">Filter Penulis:</label>
                                <select class="form-control form-control-sm" id="filterAuthor">
                                    <option value="">Semua Penulis</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label>
                                <div>
                                    <button class="btn btn-info btn-sm" onclick="applyFilters()">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <button class="btn btn-secondary btn-sm" onclick="clearFilters()">
                                        <i class="fas fa-times"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="table" class="table table-bordered table-striped table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Thumbnail</th>
                                        <th width="15%">Kategori</th>
                                        <th width="25%">Judul</th>
                                        <th width="12%">Penulis</th>
                                        <th width="10%">Status</th>
                                        <th width="13%">Tanggal</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datatables -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">News Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" />
                    <div class="form-body">
                        <div class="form-group">
                            <label>Category *</label>
                            <select name="category_id" class="form-control">
                                <?php foreach ($category as $c): ?>
                                    <option value="<?php echo $c->id; ?>"><?php echo $c->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Title *</label>
                            <input name="title" placeholder="Title" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label>Content *</label>
                            <textarea id="content" name="content" placeholder="Content" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <input id="thumbnail" name="thumbnail" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <img id="thumbnail-preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; display: none;">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnSave">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="csrf_token" name="csrf_token_jkt3" value="<?= $this->security->get_csrf_hash(); ?>">

<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/gh/depri12kurnia/assetsadminlte3.2.0@19d5f7d70f5a32386894c2573713049dc9e2e5f0/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(function() {
        $('#content').summernote({
            height: 100, // Ubah tinggi sesuai kebutuhan (dalam pixel)
            minHeight: 200, // Minimum height
            maxHeight: 500, // Maximum height
            focus: true // Fokus ke editor saat dibuka
        });
    })
</script>
<script type="text/javascript">
    var save_method;
    var table;

    function getCsrfToken() {
        let token = document.cookie.split('; ')
            .find(row => row.startsWith('csrf_cookie_jkt3='))
            ?.split('=')[1] || '';

        // console.log("CSRF Token dari Cookie:", token); // Debug
        return token;
    }

    function getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    $(document).ajaxSend(function(e, xhr, options) {
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        if (csrfToken) {
            xhr.setRequestHeader('X-CSRF-Token', csrfToken);
        }
    });

    $(document).ready(function() {
        // Load statistics
        loadStatistics();

        // Load authors for filter
        loadAuthors();

        // Initialize DataTable
        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "autoWidth": false,
            "lengthChange": true,
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
                },
                "processing": "Memproses..."
            },
            "ajax": {
                "url": "<?php echo site_url('admin/news/ajax_list') ?>",
                "type": "POST",
                "data": function(d) {
                    d.csrf_token_jkt3 = getCsrfToken();
                    // Add filter parameters
                    d.category_filter = $('#filterCategory').val();
                    d.status_filter = $('#filterStatus').val();
                    d.author_filter = $('#filterAuthor').val();
                },
                "error": function(xhr) {
                    console.log("Error:", xhr.responseText);
                }
            },
            "columns": [{
                    "width": "5%",
                    "orderable": false
                },
                {
                    "width": "10%",
                    "orderable": false
                },
                {
                    "width": "15%"
                },
                {
                    "width": "25%"
                },
                {
                    "width": "12%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "13%"
                },
                {
                    "width": "10%",
                    "orderable": false
                }
            ]
        });
    });

    function loadStatistics() {
        $.ajax({
            url: "<?= site_url('admin/news/get_statistics') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('#totalNews').text(data.total);
                $('#publishedNews').text(data.published);
                $('#draftNews').text(data.draft);
                $('#todayNews').text(data.today);
            },
            error: function() {
                $('#totalNews, #publishedNews, #draftNews, #todayNews').text('0');
            }
        });
    }

    function loadAuthors() {
        $.ajax({
            url: "<?= site_url('admin/news/get_authors') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let options = '<option value="">Semua Penulis</option>';
                data.forEach(function(author) {
                    options += `<option value="${author.username}">${author.username}</option>`;
                });
                $('#filterAuthor').html(options);
            }
        });
    }

    function applyFilters() {
        table.draw();
    }

    function clearFilters() {
        $('#filterCategory, #filterStatus, #filterAuthor').val('');
        table.draw();
    }

    function add_news() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#content').summernote('reset');
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#thumbnail-preview').hide();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah Berita Baru');
    }

    function preview_news(id) {
        // Open news preview in new window
        window.open("<?= site_url('admin/news/preview/') ?>" + id, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
    }

    function edit_news(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#thumbnail-preview').hide();

        $.ajax({
            url: "<?= site_url('admin/news/ajax_edit/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="category_id"]').val(data.category_id);
                $('[name="title"]').val(data.title);
                $('[name="excerpt"]').val(data.excerpt);
                $('#content').summernote('code', data.content);
                $('[name="status"]').val(data.status);
                $('[name="published_at"]').val(data.published_at);

                if (data.thumbnail) {
                    $('#thumbnail-preview').attr('src', "<?= base_url('assets/uploads/news/') ?>" + data.thumbnail).show();
                }

                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Berita');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data');
            }
        });
    }

    function delete_news(id) {
        if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
            $.ajax({
                url: "<?= site_url('admin/news/ajax_delete/') ?>" + id,
                type: "POST",
                dataType: "JSON",
                data: {
                    csrf_token_jkt3: getCsrfToken()
                },
                success: function(data) {
                    if (data.status) {
                        reload_table();
                        loadStatistics(); // Refresh statistics
                    } else {
                        alert('Error deleting data');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }

    function edit_news(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $.ajax({
            url: "<?php echo site_url('admin/news/ajax_edit/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="category_id"]').val(data.category_id);
                $('[name="title"]').val(data.title);
                $('#content').summernote('code', data.content); // Fix untuk Summernote
                $('[name="status"]').val(data.status);
                $('#modal_form').modal('show');
                $('.modal-title').text('Edit News');

                // Set format untuk input date
                if (data.published_at) {
                    $('[name="published"]').val(data.published_at);
                } else {
                    $('[name="published"]').val('');
                }

                // Pratinjau gambar thumbnail lama
                if (data.thumbnail) {
                    $('#thumbnail-preview').attr('src', "<?php echo base_url('public/uploads/news/') ?>" + data.thumbnail);
                    $('#thumbnail-preview').show();
                } else {
                    $('#thumbnail-preview').hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data from ajax');
            }
        });
    }

    function delete_news(id) {
        if (confirm('Are you sure delete this data?')) {
            $.ajax({
                url: "<?php echo site_url('admin/news/ajax_delete/') ?>" + id,
                type: "POST",
                data: {
                    csrf_token_jkt3: getCsrfToken()
                }, // Kirim CSRF token

                dataType: "JSON",
                success: function(data) {
                    $('#modal_form').modal('hide');
                    reload_table();

                    // debug
                    // console.log("Token CSRF baru:", data.csrf_token);
                    // Perbarui CSRF token setelah request berhasil
                    document.cookie = "csrf_cookie_jkt3=" + data.csrf_token + "; path=/";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
        }
    }

    $('#btnSave').click(function() {
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('admin/news/ajax_add') ?>";
        } else {
            url = "<?php echo site_url('admin/news/ajax_update') ?>";
        }

        var formData = new FormData($('#form')[0]); // Gunakan FormData untuk menangani file

        // Ambil file thumbnail secara manual
        var fileInput = document.getElementById('thumbnail');
        if (fileInput.files.length > 0) {
            formData.append('thumbnail', fileInput.files[0]);
        }

        // Tambahkan CSRF token
        formData.append('csrf_token_jkt3', getCsrfToken());

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false, // Jangan ubah data agar bisa mengirim file
            contentType: false, // Jangan set content type agar browser menangani multipart/form-data
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-CSRF-Token", getCsrfToken());
            },
            success: function(data) {
                if (data.status) {
                    $('#modal_form').modal('hide');
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().addClass('has-error');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                    }
                }

                // Perbarui CSRF token setelah request berhasil
                document.cookie = "csrf_cookie_jkt3=" + data.csrf_token + "; path=/";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / updating data');
            }
        });
    });

    // Thumbnail preview functionality
    $('#thumbnail').change(function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#thumbnail-preview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#thumbnail-preview').hide();
        }
    });

    function reload_table() {
        table.ajax.reload(null, false);
        loadStatistics(); // Also refresh statistics
    }

    $('#modal_form').on('hidden.bs.modal', function() {
        table.ajax.reload(null, false); // Reload DataTables tanpa reset pagination
    });

    $('.btn-default').click(function() {
        $('#modal_form').modal('hide'); // Menutup modal
        table.ajax.reload(null, false); // Reload DataTables
    });
</script>