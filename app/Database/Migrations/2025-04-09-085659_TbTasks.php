<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTasks extends Migration
{
    public function up()
    {
        // Tabel Tasks
        $this->db->query("
        CREATE TABLE tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )
    ");
    }
    

    public function down()
    {
        $this->forge->dropTable('tasks');
    }
}
