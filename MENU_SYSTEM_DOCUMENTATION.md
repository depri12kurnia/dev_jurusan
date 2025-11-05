# 📋 Menu System Documentation

## 📊 Database Schema

### 1. Tabel `menu_categories` (Kategori Menu)
```sql
CREATE TABLE `menu_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `order_position` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
);
```

### 2. Tabel `menu_items` (Item Menu)
```sql
CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `content` longtext,
  `icon` varchar(50) DEFAULT NULL,
  `order_position` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`id`) ON DELETE CASCADE
);
```

## 🔧 Installation

### 1. Import Database
```bash
# Import ke MySQL
mysql -u root -p your_database < database_menu_system.sql
```

### 2. Files Structure
```
application/
├── controllers/
│   ├── Pages.php                          # Frontend controller
│   └── admin/
│       ├── Menu_categories.php            # Admin CRUD categories
│       └── Menu_items.php                 # Admin CRUD items
├── models/
│   ├── M_menu_categories.php              # Model categories
│   └── M_menu_items.php                   # Model items
└── views/
    ├── frontend/
    │   ├── page.php                       # Single page view
    │   ├── category.php                   # Category listing
    │   └── search.php                     # Search results
    └── paneladmin/menu/
        ├── categories/
        │   ├── list.php
        │   ├── create.php
        │   └── edit.php
        └── items/
            ├── list.php
            ├── create.php
            └── edit.php
```

## 🎯 Usage Examples

### Frontend URLs
```
# Single Page
http://localhost/dev_jurusan/page/profil
http://localhost/dev_jurusan/page/visi-misi

# Category Listing
http://localhost/dev_jurusan/category/tentang-kami
http://localhost/dev_jurusan/category/akademik

# Search
http://localhost/dev_jurusan/search?q=keyword
```

### Admin URLs
```
# Menu Categories Management
http://localhost/dev_jurusan/admin/menu_categories
http://localhost/dev_jurusan/admin/menu_categories/create
http://localhost/dev_jurusan/admin/menu_categories/edit/1

# Menu Items Management
http://localhost/dev_jurusan/admin/menu_items
http://localhost/dev_jurusan/admin/menu_items/create
http://localhost/dev_jurusan/admin/menu_items/edit/1
```

## 🔍 Model Methods

### M_menu_categories
```php
// Get active categories for navbar
$categories = $this->M_menu_categories->get_active_categories();

// Get category with item count
$categories = $this->M_menu_categories->get_categories_with_count();

// Check slug exists
$exists = $this->M_menu_categories->slug_exists('tentang-kami');
```

### M_menu_items
```php
// Get navbar structure
$navbar = $this->M_menu_items->get_navbar_structure();

// Get items by category
$items = $this->M_menu_items->get_by_category($category_id);

// Get single page by slug
$page = $this->M_menu_items->get_by_slug('profil');

// Search pages
$results = $this->M_menu_items->search('keyword');
```

## 🎨 Frontend Integration

### Update Navbar (parts_user/navbar.php)
```php
<?php
// Get menu structure
$CI = &get_instance();
$CI->load->model('M_menu_items');
$navbar_menu = $CI->M_menu_items->get_navbar_structure();
?>

<!-- Dynamic Menu -->
<?php foreach ($navbar_menu as $category): ?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <i class="<?= $category->category_icon ?: 'fas fa-folder' ?> me-1"></i>
        <?= $category->category_name ?>
    </a>
    <ul class="dropdown-menu">
        <?php foreach ($category->items as $item): ?>
            <li>
                <a class="dropdown-item" href="<?= site_url('page/' . $item->slug) ?>">
                    <i class="<?= $item->icon ?: 'fas fa-file' ?> me-2"></i>
                    <?= $item->title ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</li>
<?php endforeach; ?>
```

## 🛠 Admin Features

### Menu Categories Management
- ✅ CRUD Operations (Create, Read, Update, Delete)
- ✅ Slug auto-generation
- ✅ Icon selection (FontAwesome)
- ✅ Order positioning
- ✅ Active/Inactive status
- ✅ DataTables integration

### Menu Items Management  
- ✅ CRUD Operations with rich content editor
- ✅ Category selection
- ✅ SEO meta tags (title, description)
- ✅ Content management (HTML support)
- ✅ Icon selection (FontAwesome)
- ✅ Order positioning
- ✅ Active/Inactive status
- ✅ DataTables integration

## 📝 Content Management

### Sample Content Structure
```
Tentang Kami/
├── Profil (HTML content with images)
├── Visi Misi (Formatted list content)
└── Sejarah (Timeline content)

Akademik/
├── Kalender Akademik (Table/Schedule content)
├── Kurikulum (Structured curriculum info)
├── Beasiswa (Program details with criteria)
└── Uji Kompetensi (Requirements and procedures)
```

## 🔐 Security Features

- ✅ Admin authentication required
- ✅ SQL injection prevention
- ✅ XSS protection
- ✅ CSRF tokens
- ✅ Input validation
- ✅ Slug uniqueness validation

## 📊 Sample Data

Database sudah include sample data untuk:

### Categories:
1. **Tentang Kami** (tentang-kami)
   - Icon: fas fa-info-circle
   - Items: Profil, Visi Misi, Sejarah

2. **Akademik** (akademik)  
   - Icon: fas fa-university
   - Items: Kalender Akademik, Kurikulum, Beasiswa, Uji Kompetensi

### Menu Items:
- Semua item sudah ada content lengkap
- SEO meta tags sudah diset
- Icons FontAwesome sudah dipilih
- Order positioning sudah diatur

## 🚀 Deployment Checklist

- [ ] Import database_menu_system.sql
- [ ] Upload semua files controller, model, views
- [ ] Update routes.php
- [ ] Test admin access (login sebagai admin)
- [ ] Test frontend pages
- [ ] Test navbar integration
- [ ] Verify all CRUD operations

## 📞 Support

Sistem ini siap digunakan dan fully functional dengan:
- Complete CRUD operations
- SEO-friendly URLs
- Responsive design support  
- Rich content management
- Search functionality
- Dynamic navbar integration

**Ready untuk production! 🎉**