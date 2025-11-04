<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Facilities Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Facilities</li>
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
                        <h3 class="card-title">Facilities List</h3>
                        <div class="card-tools">
                            <button class="btn btn-primary" onclick="add_facility()">
                                <i class="fa fa-plus"></i> Add New Facility
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Filter by Category:</label>
                                <select id="categoryFilter" class="form-control">
                                    <option value="">All Categories</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->name; ?>"><?= $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Filter by Status:</label>
                                <select id="statusFilter" class="form-control">
                                    <option value="">All Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                    <option value="Draft">Draft</option>
                                </select>
                            </div>
                        </div>

                        <table id="facilitiesTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Featured</th>
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

<!-- Modal for Add/Edit Facility -->
<div class="modal fade" id="facilityModal" tabindex="-1" role="dialog" aria-labelledby="facilityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="facilityModalLabel">Add Facility</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="facilityForm" enctype="multipart/form-data">
                <input type="hidden" name="id" id="facility_id">
                <div class="modal-body">
                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Basic Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="help-block text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter facility title">
                                        <span class="help-block text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitle">Subtitle</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Enter facility subtitle">
                                        <span class="help-block text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea class="form-control" id="short_description" name="short_description" rows="3" placeholder="Enter short description"></textarea>
                                        <span class="help-block text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter detailed description"></textarea>
                                        <span class="help-block text-danger"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Visual & Contact Information -->
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Visual & Contact Information</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="icon">Icon (FontAwesome class)</label>
                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="e.g., fas fa-building">
                                        <small class="text-muted">Use FontAwesome icon classes (e.g., fas fa-building)</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                                        <small class="text-muted">Max size: 2MB. Formats: JPG, PNG, GIF</small>
                                        <div id="imagePreview" class="mt-2"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter facility location">
                                    </div>

                                    <div class="form-group">
                                        <label for="capacity">Capacity</label>
                                        <input type="text" class="form-control" id="capacity" name="capacity" placeholder="e.g., 200 people">
                                    </div>

                                    <div class="form-group">
                                        <label for="operational_hours">Operational Hours</label>
                                        <input type="text" class="form-control" id="operational_hours" name="operational_hours" placeholder="e.g., Mon-Fri 08:00-17:00">
                                    </div>

                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter contact person name">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="website_url">Website URL</label>
                                        <input type="url" class="form-control" id="website_url" name="website_url" placeholder="https://example.com">
                                    </div>

                                    <div class="form-group">
                                        <label for="virtual_tour_url">Virtual Tour URL</label>
                                        <input type="url" class="form-control" id="virtual_tour_url" name="virtual_tour_url" placeholder="https://virtualtour.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Highlights Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Facility Highlights</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-sm btn-success" onclick="addHighlight()">
                                            <i class="fa fa-plus"></i> Add Highlight
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="highlightsContainer">
                                        <!-- Dynamic highlights will be added here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings & SEO -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Settings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured">
                                            <label class="custom-control-label" for="is_featured">Featured Facility</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="featured_order">Featured Order</label>
                                                <input type="number" class="form-control" id="featured_order" name="featured_order" value="0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="sort_order">Sort Order</label>
                                                <input type="number" class="form-control" id="sort_order" name="sort_order" value="0">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">SEO Settings</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter meta description"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter keywords separated by commas">
                                    </div>
                                </div>
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

<!-- View Facility Modal -->
<div class="modal fade" id="viewFacilityModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Facility Details</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="facilityViewContent">
                <!-- Dynamic content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- CSRF Token -->
<input type="hidden" id="csrf_token" name="csrf_token_jkt3" value="<?= $this->security->get_csrf_hash(); ?>">

<script>
    let table;
    let highlightIndex = 0;

    function getCsrfToken() {
        let token = document.cookie.split('; ')
            .find(row => row.startsWith('csrf_cookie_jkt3='))
            ?.split('=')[1] || '';
        return token;
    }

    $(document).ready(function() {
        // Initialize DataTable
        table = $('#facilitiesTable').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('admin/facilities/ajax_list'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.csrf_token_jkt3 = getCsrfToken();
                    d.category_filter = $('#categoryFilter').val();
                    d.status_filter = $('#statusFilter').val();
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

        // Filter handlers
        $('#categoryFilter, #statusFilter').change(function() {
            table.draw();
        });

        // Form submission
        $('#facilityForm').submit(function(e) {
            e.preventDefault();
            save_facility();
        });

        // Image preview
        $('#image').change(function() {
            previewImage(this);
        });
    });

    function add_facility() {
        save_method = 'add';
        $('#facilityForm')[0].reset();
        $('#facilityModal .modal-title').text('Add New Facility');
        $('#facilityModal').modal('show');
        $('#highlightsContainer').empty();
        highlightIndex = 0;
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
    }

    function edit_facility(id) {
        save_method = 'update';
        $('#facilityForm')[0].reset();
        $('#facilityModal .modal-title').text('Edit Facility');
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?= base_url('admin/facilities/ajax_edit/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="category_id"]').val(data.category_id);
                $('[name="title"]').val(data.title);
                $('[name="subtitle"]').val(data.subtitle);
                $('[name="short_description"]').val(data.short_description);
                $('[name="description"]').val(data.description);
                $('[name="icon"]').val(data.icon);
                $('[name="location"]').val(data.location);
                $('[name="capacity"]').val(data.capacity);
                $('[name="operational_hours"]').val(data.operational_hours);
                $('[name="contact_person"]').val(data.contact_person);
                $('[name="phone"]').val(data.phone);
                $('[name="email"]').val(data.email);
                $('[name="website_url"]').val(data.website_url);
                $('[name="virtual_tour_url"]').val(data.virtual_tour_url);
                $('[name="is_featured"]').prop('checked', data.is_featured == 1);
                $('[name="featured_order"]').val(data.featured_order);
                $('[name="sort_order"]').val(data.sort_order);
                $('[name="meta_title"]').val(data.meta_title);
                $('[name="meta_description"]').val(data.meta_description);
                $('[name="meta_keywords"]').val(data.meta_keywords);
                $('[name="status"]').val(data.status);

                // Load highlights
                $('#highlightsContainer').empty();
                highlightIndex = 0;
                if (data.highlights && data.highlights.length > 0) {
                    data.highlights.forEach(function(highlight) {
                        addHighlight(highlight);
                    });
                }

                // Show image preview if exists
                if (data.image) {
                    $('#imagePreview').html('<img src="<?= base_url("public/uploads/facilities/"); ?>' + data.image + '" class="img-thumbnail" style="max-height: 100px;">');
                }

                $('#facilityModal').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error loading facility data');
            }
        });
    }

    function delete_facility(id) {
        if (confirm('Are you sure you want to delete this facility?')) {
            $.ajax({
                url: "<?= base_url('admin/facilities/ajax_delete/'); ?>" + id,
                type: "POST",
                data: {
                    csrf_token_jkt3: getCsrfToken()
                },
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
                        table.ajax.reload();
                        toastr.success('Facility deleted successfully');
                    } else {
                        toastr.error(data.message || 'Failed to delete facility');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    toastr.error('Error deleting facility');
                }
            });
        }
    }

    function view_facility(id) {
        $.ajax({
            url: "<?= base_url('admin/facilities/ajax_edit/'); ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                let content = `
                <div class="row">
                    <div class="col-md-4">
                        ${data.image ? '<img src="<?= base_url("public/uploads/facilities/"); ?>' + data.image + '" class="img-fluid rounded mb-3">' : '<div class="bg-light p-4 text-center rounded mb-3"><i class="fas fa-image fa-3x text-muted"></i></div>'}
                    </div>
                    <div class="col-md-8">
                        <h4>${data.title}</h4>
                        ${data.subtitle ? '<p class="text-muted">' + data.subtitle + '</p>' : ''}
                        <p>${data.description}</p>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6"><strong>Category:</strong> ${data.category_name || 'N/A'}</div>
                            <div class="col-sm-6"><strong>Status:</strong> <span class="badge badge-${data.status === 'Active' ? 'success' : data.status === 'Inactive' ? 'danger' : 'warning'}">${data.status}</span></div>
                        </div>
                        ${data.location ? '<div class="mt-2"><strong>Location:</strong> ' + data.location + '</div>' : ''}
                        ${data.capacity ? '<div class="mt-2"><strong>Capacity:</strong> ' + data.capacity + '</div>' : ''}
                        ${data.operational_hours ? '<div class="mt-2"><strong>Hours:</strong> ' + data.operational_hours + '</div>' : ''}
                        ${data.contact_person ? '<div class="mt-2"><strong>Contact:</strong> ' + data.contact_person + '</div>' : ''}
                    </div>
                </div>
            `;

                if (data.highlights && data.highlights.length > 0) {
                    content += '<hr><h5>Highlights:</h5><div class="row">';
                    data.highlights.forEach(function(highlight) {
                        content += `
                        <div class="col-md-6 mb-2">
                            <div class="d-flex align-items-center">
                                <i class="${highlight.icon}" style="color: ${highlight.color}; margin-right: 10px;"></i>
                                <div>
                                    <strong>${highlight.title}</strong>
                                    ${highlight.description ? '<br><small class="text-muted">' + highlight.description + '</small>' : ''}
                                </div>
                            </div>
                        </div>
                    `;
                    });
                    content += '</div>';
                }

                $('#facilityViewContent').html(content);
                $('#viewFacilityModal').modal('show');
            },
            error: function() {
                toastr.error('Error loading facility details');
            }
        });
    }

    function save_facility() {
        $('#btnSave').text('Saving...').prop('disabled', true);

        const formData = new FormData($('#facilityForm')[0]);
        const url = save_method === 'add' ? "<?= base_url('admin/facilities/ajax_add'); ?>" : "<?= base_url('admin/facilities/ajax_update'); ?>";

        // Add CSRF token to FormData
        formData.append('csrf_token_jkt3', getCsrfToken());

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
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
                    $('#facilityModal').modal('hide');
                    table.ajax.reload();
                    toastr.success('Facility saved successfully');
                } else {
                    if (data.inputerror) {
                        $('.form-group').removeClass('has-error');
                        $('.help-block').empty();

                        data.inputerror.forEach(function(field, index) {
                            $('[name="' + field + '"]').closest('.form-group').addClass('has-error');
                            $('[name="' + field + '"]').siblings('.help-block').text(data.error_string[index]);
                        });
                    }
                    toastr.error(data.message || 'Failed to save facility');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                toastr.error('Error saving facility');
            },
            complete: function() {
                $('#btnSave').text('Save').prop('disabled', false);
            }
        });
    }

    function addHighlight(data = null) {
        const highlight = data || {
            title: '',
            description: '',
            icon: 'fas fa-check',
            color: '#28a745'
        };

        const highlightHtml = `
        <div class="highlight-item border p-3 mb-3 rounded" data-index="${highlightIndex}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="highlights[${highlightIndex}][title]" value="${highlight.title}" placeholder="Enter highlight title">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="highlights[${highlightIndex}][description]" value="${highlight.description}" placeholder="Enter description (optional)">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" class="form-control" name="highlights[${highlightIndex}][icon]" value="${highlight.icon}" placeholder="e.g., fas fa-check">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Color</label>
                        <input type="color" class="form-control" name="highlights[${highlightIndex}][color]" value="${highlight.color}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Action</label><br>
                        <button type="button" class="btn btn-danger btn-sm" onclick="removeHighlight(${highlightIndex})">
                            <i class="fa fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

        $('#highlightsContainer').append(highlightHtml);
        highlightIndex++;
    }

    function removeHighlight(index) {
        $(`.highlight-item[data-index="${index}"]`).remove();
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-height: 150px;">');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>