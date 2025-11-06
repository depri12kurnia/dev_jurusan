<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $action == 'add' ? 'Tambah' : 'Edit'; ?> Dosen</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dosen'); ?>">Dosen</a></li>
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
                <h3 class="card-title"><?php echo $action == 'add' ? 'Tambah' : 'Edit'; ?> Data Dosen</h3>
            </div>
            <form id="form-dosen" method="post" action="<?php echo base_url('admin/dosen/' . $action . ($action == 'edit' ? '/' . $dosen->id : '')); ?>" enctype="multipart/form-data">
                <input type="hidden" name="<?php echo $csrf_token; ?>" value="<?php echo $csrf_hash; ?>">
                <?php if ($action == 'edit'): ?>
                    <input type="hidden" name="id" value="<?php echo $dosen->id; ?>">
                <?php endif; ?>

                <div class="card-body">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nidn">NIDN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nidn" name="nidn" value="<?php echo $dosen->nidn; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="<?php echo $dosen->nip; ?>">
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?php echo $dosen->nama_lengkap; ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gelar_depan">Gelar Depan</label>
                                        <input type="text" class="form-control" id="gelar_depan" name="gelar_depan" value="<?php echo $dosen->gelar_depan; ?>" placeholder="Dr.">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="gelar_belakang">Gelar Belakang</label>
                                        <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang" value="<?php echo $dosen->gelar_belakang; ?>" placeholder="M.T., M.Kom., S.T.">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $dosen->tempat_lahir; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $dosen->tanggal_lahir; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="L" <?php echo $dosen->jenis_kelamin == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="P" <?php echo $dosen->jenis_kelamin == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select class="form-control" id="agama" name="agama">
                                            <option value="">-- Pilih Agama --</option>
                                            <option value="Islam" <?php echo $dosen->agama == 'Islam' ? 'selected' : ''; ?>>Islam</option>
                                            <option value="Kristen" <?php echo $dosen->agama == 'Kristen' ? 'selected' : ''; ?>>Kristen</option>
                                            <option value="Katholik" <?php echo $dosen->agama == 'Katholik' ? 'selected' : ''; ?>>Katholik</option>
                                            <option value="Hindu" <?php echo $dosen->agama == 'Hindu' ? 'selected' : ''; ?>>Hindu</option>
                                            <option value="Buddha" <?php echo $dosen->agama == 'Buddha' ? 'selected' : ''; ?>>Buddha</option>
                                            <option value="Konghucu" <?php echo $dosen->agama == 'Konghucu' ? 'selected' : ''; ?>>Konghucu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"><?php echo $dosen->alamat; ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telepon">Telepon</label>
                                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $dosen->telepon; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $dosen->email; ?>">
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
                                <?php if (!empty($dosen->foto)): ?>
                                    <div class="mt-2">
                                        <img src="<?php echo base_url('uploads/foto/' . $dosen->foto); ?>" alt="Foto Profil" class="img-thumbnail" style="max-width: 150px;">
                                        <br>
                                        <small class="text-muted">Foto saat ini: <?php echo $dosen->foto; ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="program_studi">Program Studi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?php echo $dosen->program_studi; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="bidang_keahlian">Bidang Keahlian</label>
                                <input type="text" class="form-control" id="bidang_keahlian" name="bidang_keahlian" value="<?php echo $dosen->bidang_keahlian; ?>">
                            </div>

                            <div class="form-group">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <select class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="S1" <?php echo $dosen->pendidikan_terakhir == 'S1' ? 'selected' : ''; ?>>S1</option>
                                    <option value="S2" <?php echo $dosen->pendidikan_terakhir == 'S2' ? 'selected' : ''; ?>>S2</option>
                                    <option value="S3" <?php echo $dosen->pendidikan_terakhir == 'S3' ? 'selected' : ''; ?>>S3</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jabatan_akademik">Jabatan Akademik</label>
                                <select class="form-control" id="jabatan_akademik" name="jabatan_akademik">
                                    <option value="">-- Pilih Jabatan Akademik --</option>
                                    <option value="Tenaga Pengajar" <?php echo $dosen->jabatan_akademik == 'Tenaga Pengajar' ? 'selected' : ''; ?>>Tenaga Pengajar</option>
                                    <option value="Asisten Ahli" <?php echo $dosen->jabatan_akademik == 'Asisten Ahli' ? 'selected' : ''; ?>>Asisten Ahli</option>
                                    <option value="Lektor" <?php echo $dosen->jabatan_akademik == 'Lektor' ? 'selected' : ''; ?>>Lektor</option>
                                    <option value="Lektor Kepala" <?php echo $dosen->jabatan_akademik == 'Lektor Kepala' ? 'selected' : ''; ?>>Lektor Kepala</option>
                                    <option value="Guru Besar" <?php echo $dosen->jabatan_akademik == 'Guru Besar' ? 'selected' : ''; ?>>Guru Besar</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jabatan_struktural">Jabatan Struktural</label>
                                <input type="text" class="form-control" id="jabatan_struktural" name="jabatan_struktural" value="<?php echo $dosen->jabatan_struktural; ?>" placeholder="Ketua Jurusan, Dekan, dll">
                            </div>

                            <div class="form-group">
                                <label for="status_kepegawaian">Status Kepegawaian <span class="text-danger">*</span></label>
                                <select class="form-control" id="status_kepegawaian" name="status_kepegawaian" required>
                                    <option value="Tetap" <?php echo $dosen->status_kepegawaian == 'Tetap' ? 'selected' : ''; ?>>Tetap</option>
                                    <option value="Kontrak" <?php echo $dosen->status_kepegawaian == 'Kontrak' ? 'selected' : ''; ?>>Kontrak</option>
                                    <option value="Honorer" <?php echo $dosen->status_kepegawaian == 'Honorer' ? 'selected' : ''; ?>>Honorer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status_aktif">Status Aktif <span class="text-danger">*</span></label>
                                <select class="form-control" id="status_aktif" name="status_aktif" required>
                                    <option value="Aktif" <?php echo $dosen->status_aktif == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="Tidak Aktif" <?php echo $dosen->status_aktif == 'Tidak Aktif' ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    <option value="Pensiun" <?php echo $dosen->status_aktif == 'Pensiun' ? 'selected' : ''; ?>>Pensiun</option>
                                    <option value="Pindah" <?php echo $dosen->status_aktif == 'Pindah' ? 'selected' : ''; ?>>Pindah</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk</label>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $dosen->tanggal_masuk; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="<?php echo base_url('admin/dosen'); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#form-dosen').on('submit', function(e) {
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
                            window.location.href = '<?php echo base_url('admin/dosen'); ?>';
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