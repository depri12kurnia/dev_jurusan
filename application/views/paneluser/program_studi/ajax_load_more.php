<?php

/**
 * AJAX Load More untuk Program Studi
 * Memuat data tambahan secara lazy loading
 */
?>
<script>
    // Lazy loading untuk data program studi tambahan
    $(document).ready(function() {
        let offset = <?= isset($initial_count) ? $initial_count : 8 ?>;
        const limit = 8;
        let loading = false;

        $('#load-more-prodi').on('click', function() {
            if (loading) return;

            loading = true;
            $(this).html('<i class="fas fa-spinner fa-spin"></i> Memuat...');

            $.ajax({
                url: '<?= base_url("program_studi/ajax_load_more") ?>',
                type: 'POST',
                data: {
                    offset: offset,
                    limit: limit
                },
                success: function(response) {
                    const data = JSON.parse(response);

                    if (data.programs && data.programs.length > 0) {
                        // Append new programs to the container
                        data.programs.forEach(function(prodi) {
                            const card = createProdiCard(prodi);
                            $('#prodi-container').append(card);
                        });

                        offset += data.programs.length;

                        // Hide button if no more data
                        if (data.programs.length < limit) {
                            $('#load-more-prodi').hide();
                        } else {
                            $('#load-more-prodi').html('Lihat Lebih Banyak');
                        }
                    } else {
                        $('#load-more-prodi').hide();
                    }
                },
                error: function() {
                    $('#load-more-prodi').html('Error. Coba lagi');
                },
                complete: function() {
                    loading = false;
                }
            });
        });

        function createProdiCard(prodi) {
            return `
            <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up">
                <div class="card program-card h-100">
                    <div class="card-body">
                        <div class="program-badge">${prodi.jenjang}</div>
                        <h5 class="card-title">${prodi.nama_program_studi}</h5>
                        <p class="card-text text-muted">${prodi.deskripsi_singkat || 'Program studi berkualitas dengan fasilitas lengkap.'}</p>
                        <div class="program-stats">
                            <small class="text-muted">
                                <i class="fas fa-users"></i> ${prodi.jumlah_mahasiswa_aktif || 0} Mahasiswa
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="<?= base_url('program_studi/detail/') ?>${prodi.slug}" class="btn btn-primary btn-sm">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        `;
        }
    });
</script>