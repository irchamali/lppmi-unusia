<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserDocumentScope extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_document_scope_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'scope_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'fak_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'prodi_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'scope_status' => [
                'type' => 'TINYINT',
                'default' => 1,
            ],
        ]);
        $this->forge->addKey('user_document_scope_id', true);
        $this->forge->addKey('user_id');
        $this->forge->addKey(['scope_id', 'fak_id', 'prodi_id']);
        $this->forge->createTable('tbl_user_document_scope', true);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_user_document_scope', true);
    }
}