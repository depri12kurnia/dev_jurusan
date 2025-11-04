<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Facility Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Facility Categories</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories List</h3>
                        <div class="card-tools">
                            <button class="btn btn-primary" onclick="add_category()">
                                <i class="fa fa-plus"></i> Add New Category
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="categoriesTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Facilities</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal for Add/Edit Category -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="categoryModalLabel">Add Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="categoryForm">
                <input type="hidden" name="id" id="category_id">
                <input type="hidden" id="csrf_token" name="csrf_token_jkt3" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
                                <span class="help-block text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter category description"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="color" class="form-control" id="color" name="color" value="#007bff">
                                <small class="text-muted">Choose a color for this category</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon" placeholder="fas fa-building">
                                <small class="text-muted">FontAwesome icon class</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sort_order">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="0" min="0">
                                <small class="text-muted">Display order (0 = first)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="csrf_token" name="csrf_token_jkt3" value="<?= $this->security->get_csrf_hash(); ?>">

<script>
    let table;
    let save_method;

    function getCsrfToken() {
        let token = document.cookie.split('; ')
            .find(row => row.startsWith('csrf_cookie_jkt3='))
            ?.split('=')[1] || '';
        return token;
    }

    $(document).ready(function() {
        // Initialize DataTable
        table = $('#categoriesTable').DataTable({
            "processing": true,
            "serverSide": false,
            "order": [
                [0, 'asc']
            ],
            "ajax": {
                "url": "<?= base_url('admin/facility_categories/ajax_list'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.csrf_token_jkt3 = getCsrfToken(); // Send CSRF token as POST data
                },
                "beforeSend": function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', getCsrfToken());
                },
                "dataSrc": function(json) {
                    // Update CSRF token if returned from server
                    if (json.csrf_token) {
                        document.cookie = "csrf_cookie_jkt3=" + json.csrf_token + "; path=/";
                    }
                    return json.data;
                },
                "error": function(xhr, error, thrown) {
                    console.log('DataTables error:', xhr.responseText);
                    alert('Error loading data: ' + xhr.responseText);
                }
            },
            "columnDefs": [{
                "targets": [0, 3, 4, 5],
                "orderable": false,
            }, ],
            "responsive": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "pageLength": 25
        });

        // Form submission
        $('#categoryForm').submit(function(e) {
            e.preventDefault();
            save_category();
        });
    });

    function add_category() {
        save_method = 'add';
        $('#categoryForm')[0].reset();
        $('#categoryModal .modal-title').text('Add New Category');
        $('#categoryModal').modal('show');
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#color').val('#007bff'); // Reset to default color
    }

    function edit_category(id) {
        save_method = 'update';
        $('#categoryForm')[0].reset();
        $('#categoryModal .modal-title').text('Edit Category');
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?= base_url('admin/facility_categories/ajax_edit/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="name"]').val(data.name);
                $('[name="description"]').val(data.description);
                $('[name="color"]').val(data.color);
                $('[name="icon"]').val(data.icon);
                $('[name="sort_order"]').val(data.sort_order);
                $('[name="status"]').val(data.status);
                $('#categoryModal').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error loading category data');
            }
        });
    }

    function delete_category(id) {
        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                url: "<?= base_url('admin/facility_categories/ajax_delete/'); ?>" + id,
                type: "POST",
                data: {
                    csrf_token_jkt3: getCsrfToken()
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', getCsrfToken());
                },
                dataType: "JSON",
                success: function(data) {
                    if (data.status) {
                        // Update CSRF token if returned from server
                        if (data.csrf_token) {
                            document.cookie = "csrf_cookie_jkt3=" + data.csrf_token + "; path=/";
                        }
                        table.ajax.reload();
                        toastr.success('Category deleted successfully');
                    } else {
                        toastr.error(data.message || 'Failed to delete category');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('Error deleting category');
                }
            });
        }
    }

    function save_category() {
        $('#btnSave').text('Saving...').prop('disabled', true);

        const url = save_method === 'add' ? "<?= base_url('admin/facility_categories/ajax_add'); ?>" : "<?= base_url('admin/facility_categories/ajax_update'); ?>";

        $.ajax({
            url: url,
            type: "POST",
            data: $('#categoryForm').serialize() + '&csrf_token_jkt3=' + getCsrfToken(),
            dataType: "JSON",
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-Token', getCsrfToken());
            },
            success: function(data) {
                if (data.status) {
                    // Update CSRF token if returned from server
                    if (data.csrf_token) {
                        document.cookie = "csrf_cookie_jkt3=" + data.csrf_token + "; path=/";
                    }
                    $('#categoryModal').modal('hide');
                    table.ajax.reload();
                    toastr.success('Category saved successfully');
                } else {
                    if (data.inputerror) {
                        $('.form-group').removeClass('has-error');
                        $('.help-block').empty();

                        data.inputerror.forEach(function(field, index) {
                            $('[name="' + field + '"]').closest('.form-group').addClass('has-error');
                            $('[name="' + field + '"]').siblings('.help-block').text(data.error_string[index]);
                        });
                    }
                    toastr.error(data.message || 'Failed to save category');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Error saving category');
            },
            complete: function() {
                $('#btnSave').text('Save').prop('disabled', false);
            }
        });
    }
</script>