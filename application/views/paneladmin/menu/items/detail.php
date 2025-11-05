<!-- Item Detail Modal Content -->
<div class="row">
    <div class="col-md-8">
        <h5><i class="fas fa-info-circle text-primary mr-2"></i>Informasi Item Menu</h5>
        <table class="table table-sm">
            <tr>
                <td width="25%"><strong>ID</strong></td>
                <td>: <?= $item->id ?></td>
            </tr>
            <tr>
                <td><strong>Judul</strong></td>
                <td>: <?= $item->title ?></td>
            </tr>
            <tr>
                <td><strong>Slug</strong></td>
                <td>: <code><?= $item->slug ?></code></td>
            </tr>
            <tr>
                <td><strong>Kategori</strong></td>
                <td>: <span class="badge badge-info"><?= $item->category_name ?></span></td>
            </tr>
            <tr>
                <td><strong>Icon</strong></td>
                <td>: <i class="<?= $item->icon ?: 'fas fa-file' ?> mr-2"></i> <code><?= $item->icon ?: 'fas fa-file' ?></code></td>
            </tr>
            <tr>
                <td><strong>Urutan</strong></td>
                <td>: <?= $item->order_position ?></td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>:
                    <?php if ($item->is_active): ?>
                        <span class="badge badge-success">Aktif</span>
                    <?php else: ?>
                        <span class="badge badge-secondary">Nonaktif</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><strong>Dibuat</strong></td>
                <td>: <?= date('d/m/Y H:i', strtotime($item->created_at)) ?></td>
            </tr>
            <tr>
                <td><strong>Diperbarui</strong></td>
                <td>: <?= date('d/m/Y H:i', strtotime($item->updated_at)) ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <h5><i class="fas fa-search text-primary mr-2"></i>Meta SEO</h5>
        <div class="card card-outline card-info">
            <div class="card-body p-2">
                <small class="text-muted d-block"><strong>Meta Title:</strong></small>
                <p class="mb-2"><?= $item->meta_title ?: $item->title ?></p>

                <?php if ($item->meta_description): ?>
                    <small class="text-muted d-block"><strong>Meta Description:</strong></small>
                    <p class="mb-2"><?= $item->meta_description ?></p>
                <?php endif; ?>

                <?php if ($item->meta_keywords): ?>
                    <small class="text-muted d-block"><strong>Meta Keywords:</strong></small>
                    <p class="mb-0"><?= $item->meta_keywords ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <h5><i class="fas fa-link text-primary mr-2"></i>URL Item</h5>
        <div class="card">
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" value="<?= base_url($item->slug) ?>" readonly>
                    <div class="input-group-append">
                        <a href="<?= base_url($item->slug) ?>" target="_blank" class="btn btn-info">
                            <i class="fas fa-external-link-alt mr-1"></i> Lihat
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <h5><i class="fas fa-file-alt text-primary mr-2"></i>Preview Konten</h5>
        <div class="card">
            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                <?= $item->content ?>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="btn-group" role="group">
            <a href="<?= base_url('admin/menu_items/edit/' . $item->id) ?>" class="btn btn-warning">
                <i class="fas fa-edit mr-1"></i> Edit Item
            </a>
            <a href="<?= base_url($item->slug) ?>" target="_blank" class="btn btn-info">
                <i class="fas fa-eye mr-1"></i> Lihat Halaman
            </a>
            <a href="<?= base_url('admin/menu_items?category=' . $item->category_id) ?>" class="btn btn-secondary">
                <i class="fas fa-list mr-1"></i> Lihat Kategori
            </a>
        </div>
    </div>
</div>