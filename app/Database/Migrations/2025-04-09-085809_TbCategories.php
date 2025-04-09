<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbCategories extends Migration
{
    public function up()
    {
        // Tabel Categories
        $this->db->query("
        CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NULL,
    color VARCHAR(50) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
        ");

    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
