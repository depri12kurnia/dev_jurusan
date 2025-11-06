<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $action == 'add' ? 'Tambah' : 'Edit'; ?> Staf</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/staf'); ?>">Staf</a></li>
                    <li class="breadcrumb-item active"><?php echo $action == 'add' ? 'Tambah' : 'Edit'; ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $action == 'add' ? 'Tambah' : 'Edit'; ?> Data Staf</h3>
            </div>
            <form id="form-staf" method="post" action="<?php echo base_url('admin/staf/' . $action . ($action == 'edit' ? '/' . $staf->id : '')); ?>" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $csrf_token; ?>" value="<?php echo $csrf_hash; ?>">
                <?php if ($action == 'edit'): ?>
                    <input type="hidden" name="id" value="<?php echo $staf->id; ?>">
                <?php endif; ?>

                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nip">NIP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $staf->nip; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $staf->nik; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $staf->nama_lengkap; ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $staf->tempat_lahir; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $staf->tanggal_lahir; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="L" <?php echo $staf->jenis_kelamin == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="P" <?php echo $staf->jenis_kelamin == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select class="form-control" id="agama" name="agama">
                                            <option value="">-- Pilih Agama --</option>
                                            <option value="Islam" <?php echo $staf->agama == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                            <option value="Kristen" <?php echo $staf->agama == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                            <option value="Katholik" <?php echo $staf->agama == 'Katholik' ? 'selected' : ''; ?>>Katholik</option>
                                            <option value="Hindu" <?php echo $staf->agama == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                            <option value="Buddha" <?php echo $staf->agama == 'Buddha' ? 'selected' : ''; ?>>Buddha</option>
                                            <option value="Konghucu" <?php echo $staf->agama == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $staf->alamat; ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $staf->telepon; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $staf->email; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                        <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                            <option value="">-- Pilih Pendidikan --</option>
                                            <option value="SMA/SMK" <?php echo $staf->pendidikan_terakhir == 'SMA/SMK' ? 'selected' : ''; ?>>SMA/SMK</option>
                                            <option value="D1" <?php echo $staf->pendidikan_terakhir == 'D1' ? 'selected' : ''; ?>>D1</option>
                                            <option value="D2" <?php echo $staf->pendidikan_terakhir == 'D2' ? 'selected' : ''; ?>>D2</option>
                                            <option value="D3" <?php echo $staf->pendidikan_terakhir == 'D3' ? 'selected' : ''; ?>>D3</option>
                                            <option value="S1" <?php echo $staf->pendidikan_terakhir == 'S1' ? 'selected' : ''; ?>>S1</option>
                                            <option value="S2" <?php echo $staf->pendidikan_terakhir == 'S2' ? 'selected' : ''; ?>>S2</option>
                                            <option value="S3" <?php echo $staf->pendidikan_terakhir == 'S3' ? 'selected' : ''; ?>>S3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jurusan_pendidikan">Jurusan Pendidikan</label>
                                        <input type="text" class="form-control" id="jurusan_pendidikan" name="jurusan_pendidikan" value="<?php echo $staf->jurusan_pendidikan; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto Profil</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                                    <label class="custom-file-label" for="foto">Pilih foto...</label>
                                </div>
                                <small class="form-text text-muted">Format yang diizinkan: JPG, JPEG, PNG (Maksimal 2MB)</small>
                                <?php if (!empty($staf->foto)): ?>
                                    <div class="mt-2">
                                        <img src="<?php echo base_url('uploads/foto/' . $staf->foto); ?>" alt="Foto Profil" class="img-thumbnail" style="max-width: 150px;">
                                        <br>
                                        <small class="text-muted">Foto saat ini: <?php echo $staf->foto; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="divisi">Divisi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="divisi" name="divisi" value="<?php echo $staf->divisi; ?>" required placeholder="Akademik, Keuangan, IT, Umum, dll">
                            </div>

                            <div class="form-group">
                                <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $staf->jabatan; ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="golongan">Golongan</label>
                                        <input type="text" class="form-control" id="golongan" name="golongan" value="<?php echo $staf->golongan; ?>" placeholder="II/a, III/b, dll">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pangkat">Pangkat</label>
                                        <input type="text" class="form-control" id="pangkat" name="pangkat" value="<?php echo $staf->pangkat; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status_kepegawaian">Status Kepegawaian <span class="text-danger">*</span></label>
                                <select class="form-control" id="status_kepegawaian" name="status_kepegawaian" required>
                                    <option value="PNS" <?php echo $staf->status_kepegawaian == 'PNS' ? 'selected' : ''; ?>>PNS</option>
                                    <option value="Kontrak" <?php echo $staf->status_kepegawaian == 'Kontrak' ? 'selected' : ''; ?>>Kontrak</option>
                                    <option value="Honorer" <?php echo $staf->status_kepegawaian == 'Honorer' ? 'selected' : ''; ?>>Honorer</option>
                                    <option value="Outsourcing" <?php echo $staf->status_kepegawaian == 'Outsourcing' ? 'selected' : ''; ?>>Outsourcing</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status_aktif">Status Aktif <span class="text-danger">*</span></label>
                                <select class="form-control" id="status_aktif" name="status_aktif" required>
                                    <option value="Aktif" <?php echo $staf->status_aktif == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?php echo $staf->status_aktif == 'Tidak Aktif' ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    <option value="Pensiun" <?php echo $staf->status_aktif == 'Pensiun' ? 'selected' : ''; ?>>Pensiun</option>
                                    <option value="Pindah" <?php echo $staf->status_aktif == 'Pindah' ? 'selected' : ''; ?>>Pindah</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $staf->tanggal_masuk; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_keluar">Tanggal Keluar</label>
                                        <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar" value="<?php echo isset($staf->tanggal_keluar) ? $staf->tanggal_keluar : ''; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok (Rp)</label>
                                <input type="number" class="form-control" id="gaji_pokok" name="gaji_pokok" value="<?php echo $staf->gaji_pokok; ?>" step="0.01">
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?php echo $staf->keterangan; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="<?php echo base_url('admin/staf'); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#form-staf').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var url = $(this).attr('action');

            // Show loading
            Swal.fire({
                title: 'Menyimpan...',
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    Swal.close();

                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success'
                        }).then(() => {
                            window.location.href = '<?php echo base_url('admin/staf'); ?>';
                        });
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.close();
                    Swal.fire('Error!', 'Terjadi kesalahan saat menyimpan data', 'error');
                }
            });
        });

        // Auto-generate email based on nama_lengkap
        $('#nama_lengkap').on('blur', function() {
            var nama = $(this).val().toLowerCase();
            if (nama && !$('#email').val()) {
                var email = nama.replace(/\s+/g, '.') + '@univ.ac.id';
                $('#email').val(email);
            }
        });

        // Format gaji with thousand separator
        $('#gaji_pokok').on('input', function() {
            var value = $(this).val().replace(/[^\d]/g, '');
            $(this).val(value);
        });

        // Toggle tanggal_keluar visibility based on status
        $('#status_aktif').on('change', function() {
            if ($(this).val() === 'Aktif') {
                $('#tanggal_keluar').val('').prop('disabled', true);
            } else {
                $('#tanggal_keluar').prop('disabled', false);
            }
        });

        // Initial check for tanggal_keluar
        if ($('#status_aktif').val() === 'Aktif') {
            $('#tanggal_keluar').prop('disabled', true);
        }

        // Handle file input change
        $('#foto').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName);

            // Validate file
            var file = this.files[0];
            if (file) {
                var allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                if (!allowedTypes.includes(file.type)) {
                    Swal.fire('Error!', 'Format file tidak valid. Gunakan JPG, JPEG, atau PNG', 'error');
                    $(this).val('');
                    $(this).next('.custom-file-label').html('Pilih foto...');
                    return;
                }

                if (file.size > 2048000) { // 2MB
                    Swal.fire('Error!', 'Ukuran file terlalu besar. Maksimal 2MB', 'error');
                    $(this).val('');
                    $(this).next('.custom-file-label').html('Pilih foto...');
                    return;
                }
            }
        });
    });
</script>