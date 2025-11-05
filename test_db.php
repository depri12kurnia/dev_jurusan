<?php
// Simple database connection test
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dev_jurusan';

echo "<h2>Database Connection Test</h2>";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p style='color: green;'>✓ Database connection successful!</p>";

    // Test menu_categories table
    echo "<h3>Menu Categories</h3>";
    $stmt = $pdo->query("SELECT * FROM menu_categories ORDER BY order_position");
    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($categories) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Name</th><th>Slug</th><th>Active</th></tr>";
        foreach ($categories as $cat) {
            echo "<tr>";
            echo "<td>{$cat->id}</td>";
            echo "<td>{$cat->name}</td>";
            echo "<td>{$cat->slug}</td>";
            echo "<td>" . ($cat->is_active ? 'Yes' : 'No') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: red;'>No categories found!</p>";
    }

    // Test menu_items table
    echo "<h3>Menu Items</h3>";
    $stmt = $pdo->query("SELECT mi.*, mc.name as category_name FROM menu_items mi LEFT JOIN menu_categories mc ON mi.category_id = mc.id ORDER BY mi.order_position");
    $items = $stmt->fetchAll(PDO::FETCH_OBJ);

    if ($items) {
        echo "<table border='1' style='border-collapse: collapse;'>";
        echo "<tr><th>ID</th><th>Title</th><th>Category</th><th>Slug</th><th>Active</th></tr>";
        foreach ($items as $item) {
            echo "<tr>";
            echo "<td>{$item->id}</td>";
            echo "<td>{$item->title}</td>";
            echo "<td>{$item->category_name}</td>";
            echo "<td>{$item->slug}</td>";
            echo "<td>" . ($item->is_active ? 'Yes' : 'No') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: orange;'>No menu items found! You may need to import the sample data.</p>";
        echo "<p><strong>To import sample data:</strong></p>";
        echo "<ol>";
        echo "<li>Open phpMyAdmin or MySQL command line</li>";
        echo "<li>Select the 'dev_jurusan' database</li>";
        echo "<li>Import the 'database_menu_system.sql' file</li>";
        echo "</ol>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<p><strong>Common solutions:</strong></p>";
    echo "<ul>";
    echo "<li>Make sure XAMPP MySQL is running</li>";
    echo "<li>Check if 'dev_jurusan' database exists</li>";
    echo "<li>Verify database credentials in application/config/database.php</li>";
    echo "</ul>";
}
