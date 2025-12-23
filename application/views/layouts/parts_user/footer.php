<!-- Footer -->
<footer class="footer py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <h5>Jurusan <?= htmlspecialchars($website->name) ?></h5>
                <p>Membangun generasi tenaga kesehatan profesional dengan dedikasi tinggi untuk melayani masyarakat.</p>
                <div class="d-flex gap-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Program Studi</h5>
                <ul class="list-unstyled">
                    <?php if (!empty($program_studi_all)): ?>
                        <?php foreach ($program_studi_all as $prodi): ?>
                            <li>
                                <a href="<?= site_url('program-studi/' . $prodi->slug) ?>">
                                    <?= $prodi->jenjang ?> <?= $prodi->nama_prodi ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <?php if (count($program_studi_all) > 4): ?>
                            <li><a href="<?= site_url('program-studi') ?>">Lihat Semua...</a></li>
                        <?php endif; ?>
                    <?php else: ?>
                        <li><a href="#">Kosong</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Layanan</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Pendaftaran Online</a></li>
                    <li><a href="#">Portal Akademik</a></li>
                    <li><a href="#">E-Learning</a></li>
                    <li><a href="#">Klinik Pratama</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5>Kontak</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt me-2"></i>Jl. Arteri JORR Jatiwarna Pondok Melati Kota Bekasi Jawa Barat 17415</li>
                    <li><i class="fas fa-phone me-2"></i>(021) 84978693</li>
                    <li><i class="fas fa-envelope me-2"></i>sekretariat@poltekkesjakarta3.ac.id</li>
                    <li><i class="fas fa-clock me-2"></i>Sen-Jum: 07:30-16:00</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center pt-4 mt-4">
        <p class="mb-0">&copy; <?php echo date('Y') ?>. Designer By <a href="https://poltekkesjakarta3.ac.id/">PolkesJati</a>. All Rights Reserved. &mdash; Page rendered in <strong>{elapsed_time}</strong> seconds.</p>
    </div>
    </div>
</footer>
</div>
</div>