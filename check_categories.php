<?php
define('BASEPATH', __DIR__);
require_once 'application/config/database.php';

try {
    $mysqli = new mysqli($db['default']['hostname'], $db['default']['username'], $db['default']['password'], $db['default']['database']);

    if ($mysqli->connect_error) {
        die('Connection failed: ' . $mysqli->connect_error);
    }

    echo "=== FACILITY CATEGORIES ===\n";
    $result = $mysqli->query('SELECT id, name, slug, status FROM facility_categories ORDER BY name');
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: {$row['id']} | Name: {$row['name']} | Slug: {$row['slug']} | Status: {$row['status']}\n";
        }
    } else {
        echo "Error: " . $mysqli->error . "\n";
    }

    echo "\n=== FACILITIES COUNT BY CATEGORY ===\n";
    $result = $mysqli->query('
        SELECT fc.name, fc.slug, COUNT(f.id) as count 
        FROM facility_categories fc 
        LEFT JOIN facilities f ON fc.id = f.category_id AND f.status = "Active"
        WHERE fc.status = "Active"
        GROUP BY fc.id, fc.name, fc.slug 
        ORDER BY fc.name
    ');
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "Category: {$row['name']} | Slug: {$row['slug']} | Facilities: {$row['count']}\n";
        }
    } else {
        echo "Error: " . $mysqli->error . "\n";
    }

    $mysqli->close();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
