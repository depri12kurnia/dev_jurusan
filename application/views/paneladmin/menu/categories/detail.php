<!-- Category Detail Modal Content -->
<div class="row">
    <div class="col-md-6">
        <h5><i class="fas fa-info-circle text-primary mr-2"></i>Informasi Kategori</h5>
        <table class="table table-sm">
            <tr>
                <td width="30%"><strong>ID</strong></td>
                <td>: <?= $category->id ?></td>
            </tr>
            <tr>
                <td><strong>Nama Kategori</strong></td>
                <td>: <?= $category->name ?></td>
            </tr>
            <tr>
                <td><strong>Slug</strong></td>
                <td>: <code><?= $category->slug ?></code></td>
            </tr>
            <tr>
                <td><strong>Icon</strong></td>
                <td>: <i class="<?= $category->icon ?: 'fas fa-folder' ?> mr-2"></i> <code><?= $category->icon ?: 'fas fa-folder' ?></code></td>
            </tr>
            <tr>
                <td><strong>Urutan</strong></td>
                <td>: <?= $category->order_position ?></td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>:
                    <?php if ($category->is_active): ?>
                        <span class="badge badge-success">Aktif</span>
                    <?php else: ?>
                        <span class="badge badge-secondary">Nonaktif</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <h5><i class="fas fa-chart-bar text-primary mr-2"></i>Statistik</h5>
        <table class="table table-sm">
            <tr>
                <td width="40%"><strong>Total Item</strong></td>
                <td>: <span class="badge badge-info"><?= $items_count ?></span></td>
            </tr>
            <tr>
                <td><strong>Item Aktif</strong></td>
                <td>: <span class="badge badge-success"><?= $active_items_count ?></span></td>
            </tr>
            <tr>
                <td><strong>Item Nonaktif</strong></td>
                <td>: <span class="badge badge-secondary"><?= $items_count - $active_items_count ?></span></td>
            </tr>
            <tr>
                <td><strong>Dibuat</strong></td>
                <td>: <?= date('d/m/Y H:i', strtotime($category->created_at)) ?></td>
            </tr>
            <tr>
                <td><strong>Diperbarui</strong></td>
                <td>: <?= date('d/m/Y H:i', strtotime($category->updated_at)) ?></td>
            </tr>
        </table>
    </div>
</div>

<?php if (!empty($category->description)): ?>
    <div class="row mt-3">
        <div class="col-12">
            <h5><i class="fas fa-align-left text-primary mr-2"></i>Deskripsi</h5>
            <div class="card">
                <div class="card-body">
                    <?= nl2br(html_entity_decode($category->description)) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row mt-3">
    <div class="col-12">
        <h5><i class="fas fa-link text-primary mr-2"></i>URL Kategori</h5>
        <div class="card">
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" value="<?= base_url($category->slug) ?>" readonly>
                    <div class="input-group-append">
                        <a href="<?= base_url($category->slug) ?>" target="_blank" class="btn btn-info">
                            <i class="fas fa-external-link-alt mr-1"></i> Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($items_count > 0): ?>
    <div class="row mt-3">
        <div class="col-12">
            <h5><i class="fas fa-list text-primary mr-2"></i>Item Menu dalam Kategori</h5>
            <div class="table-responsive">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <i class="<?= $item->icon ?: 'fas fa-file' ?> mr-2"></i>
                                    <?= $item->title ?>
                                </td>
                                <td><?= $item->order_position ?></td>
                                <td>
                                    <?php if ($item->is_active): ?>
                                        <span class="badge badge-success badge-sm">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary badge-sm">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d/m/Y', strtotime($item->created_at)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-3">
                <a href="<?= base_url('admin/menu_items?category=' . $category->id) ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-list mr-1"></i> Kelola Semua Item
                </a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i>
                Belum ada item menu dalam kategori ini.
                <a href="<?= base_url('admin/menu_items/create?category=' . $category->id) ?>" class="btn btn-sm btn-primary ml-2">
                    <i class="fas fa-plus mr-1"></i> Tambah Item
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>