# Sistem Manajemen Fasilitas - Dokumentasi

## Overview
Sistem manajemen fasilitas yang telah dibuat terdiri dari:
1. **Dynamic Facilities Section** - Menampilkan fasilitas secara dinamis di homepage
2. **Facilities Management (Admin)** - CRUD fasilitas dengan fitur lengkap
3. **Category Management (Admin)** - Manajemen kategori fasilitas
4. **Database Structure** - Struktur database yang komprehensif

## Struktur Database

### 1. facility_categories
Tabel untuk kategori fasilitas:
```sql
- id (Primary Key)
- name (varchar 100)
- description (text, nullable)
- color (varchar 7) - warna hex untuk kategori
- icon (varchar 50) - FontAwesome icon class
- sort_order (int, default 0)
- status (enum: Active/Inactive)
- created_at, updated_at, created_by, updated_by
```

### 2. facilities
Tabel utama fasilitas:
```sql
- id (Primary Key)
- category_id (Foreign Key ke facility_categories)
- title, subtitle, slug
- description, short_description
- icon, image
- location, capacity, operational_hours
- contact_person, phone, email
- website_url, virtual_tour_url
- is_featured (boolean)
- featured_order, sort_order
- view_count (tracking views)
- meta_title, meta_description, meta_keywords (SEO)
- status (enum: Active/Inactive/Draft)
- created_at, updated_at, created_by, updated_by
```

### 3. facility_highlights
Tabel untuk highlight/keunggulan fasilitas:
```sql
- id (Primary Key)
- facility_id (Foreign Key ke facilities)
- title, description
- icon, color
- sort_order
- status (Active/Inactive)
```

### 4. facility_specifications
Tabel untuk spesifikasi detail fasilitas:
```sql
- id (Primary Key)
- facility_id (Foreign Key ke facilities)
- spec_name, spec_value
- spec_type (text/number/boolean/date)
- sort_order
- status (Active/Inactive)
```

## File Structure

### Controllers
1. **application/controllers/admin/Facilities.php**
   - CRUD facilities dengan upload gambar
   - DataTables integration
   - Highlights management
   - CSRF protection

2. **application/controllers/admin/Facility_categories.php**
   - CRUD categories
   - Color and icon management
   - Sort order handling

### Models
1. **application/models/M_facilities.php**
   - Complete facilities management
   - Category management methods
   - Highlights and specifications handling
   - DataTables support
   - Frontend methods (featured facilities, etc.)

### Views
1. **application/views/paneladmin/facilities/list.php**
   - Admin interface untuk facilities
   - Modal forms dengan file upload
   - Highlights management
   - AJAX operations

2. **application/views/paneladmin/facility_categories/list.php**
   - Admin interface untuk categories
   - Color picker dan icon selector
   - Simple CRUD operations

3. **application/views/paneluser/home.php** (Updated)
   - Dynamic facilities section
   - Featured facilities display
   - Highlights integration

### Database Setup
1. **database_facilities.sql**
   - Complete database structure
   - Sample data
   - Foreign key constraints

## Fitur Utama

### Homepage Integration
- Fasilitas ditampilkan secara dinamis
- Featured facilities dengan highlighting
- Responsive design dengan Bootstrap
- Loading fallback untuk gambar

### Admin Panel
**Facilities Management:**
- ✅ Add/Edit/Delete facilities
- ✅ Category assignment
- ✅ Image upload dengan preview
- ✅ Multiple highlights per facility
- ✅ SEO meta tags
- ✅ Status management (Active/Inactive/Draft)
- ✅ Featured facilities marking
- ✅ Sort order management
- ✅ DataTables dengan search dan filter

**Category Management:**
- ✅ Add/Edit/Delete categories
- ✅ Color coding
- ✅ Icon assignment (FontAwesome)
- ✅ Sort order
- ✅ Status management
- ✅ Facilities count tracking

### Database Features
- ✅ Complete relational structure
- ✅ Foreign key constraints
- ✅ Audit trail (created_by, updated_by)
- ✅ Soft delete capability
- ✅ SEO optimization fields
- ✅ Flexible specifications system

## Setup Instructions

### 1. Database Setup
```bash
# Import database structure (manual via phpMyAdmin or command line)
mysql -u root -p dev_jurusan < database_facilities.sql
```

### 2. File Permissions
Pastikan folder upload dapat ditulis:
```bash
chmod 755 public/uploads/facilities/
```

### 3. Navigation Update
Menu sudah ditambahkan ke admin panel:
- **Master Facilities** - `/admin/facilities`
- **Facility Categories** - `/admin/facility_categories`

### 4. Testing
1. Akses admin panel
2. Buat kategori fasilitas terlebih dahulu
3. Tambah fasilitas dengan highlights
4. Cek tampilan di homepage

## API Endpoints

### Facilities
- `GET /admin/facilities` - List facilities (admin)
- `POST /admin/facilities/ajax_list` - DataTables data
- `POST /admin/facilities/ajax_add` - Add facility
- `GET /admin/facilities/ajax_edit/{id}` - Get facility data
- `POST /admin/facilities/ajax_update` - Update facility
- `POST /admin/facilities/ajax_delete/{id}` - Delete facility

### Categories  
- `GET /admin/facility_categories` - List categories (admin)
- `POST /admin/facility_categories/ajax_list` - DataTables data
- `POST /admin/facility_categories/ajax_add` - Add category
- `GET /admin/facility_categories/ajax_edit/{id}` - Get category data
- `POST /admin/facility_categories/ajax_update` - Update category
- `POST /admin/facility_categories/ajax_delete/{id}` - Delete category

## Model Methods

### M_facilities
**Category Methods:**
- `get_categories()` - Get all categories with facilities count
- `get_category_by_id($id)` - Get single category
- `insert_category($data)` - Add new category
- `update_category($id, $data)` - Update category
- `delete_category($id)` - Delete category

**Facility Methods:**
- `get_all_facilities()` - Get all facilities
- `get_by_id($id)` - Get single facility
- `get_by_slug($slug)` - Get facility by slug
- `insert_facility($data)` - Add new facility
- `update_facility($id, $data)` - Update facility
- `delete_facility($id)` - Delete facility

**Frontend Methods:**
- `get_featured_facilities($limit)` - Get featured facilities for homepage
- `get_facility_highlights($facility_id)` - Get facility highlights

**DataTables Methods:**
- `get_datatables()` - DataTables server-side processing
- `count_filtered()` - Filtered count
- `count_all()` - Total count

## Security Features
- ✅ CSRF protection pada semua form
- ✅ File upload validation
- ✅ SQL injection protection via Active Record
- ✅ XSS protection
- ✅ Admin role checking

## Responsive Design
- ✅ Bootstrap 5 integration
- ✅ Mobile-friendly admin interface
- ✅ Responsive image handling
- ✅ Touch-friendly controls

## Next Steps (Opsional)
1. **Facility Detail Pages** - Halaman detail untuk setiap fasilitas
2. **Frontend Category Pages** - Halaman kategori di frontend
3. **Advanced Search** - Pencarian fasilitas di frontend
4. **Image Gallery** - Multiple images per facility
5. **Booking System** - Sistem reservasi fasilitas
6. **Reviews & Ratings** - Sistem review fasilitas

## Troubleshooting

### Database Issues
- Pastikan database `dev_jurusan` sudah ada
- Import file `database_facilities.sql`
- Cek foreign key constraints

### File Upload Issues
- Pastikan folder `public/uploads/facilities/` dapat ditulis
- Cek konfigurasi `upload_max_filesize` di PHP

### Menu Issues
- Clear browser cache
- Cek role admin user
- Pastikan routing CodeIgniter benar

### AJAX Issues
- Cek CSRF token di browser console
- Pastikan jQuery dan libraries sudah load
- Cek network tab untuk error details