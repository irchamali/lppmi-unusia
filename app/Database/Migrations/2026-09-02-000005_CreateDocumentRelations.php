<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDocumentRelations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'relation_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'document_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'related_document_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'relation_type_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'relation_notes' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('relation_id', true);
        $this->forge->addKey('document_id');
        $this->forge->addKey('related_document_id');
        $this->forge->addUniqueKey(['document_id', 'related_document_id', 'relation_type_id']);
        $this->forge->addForeignKey('document_id', 'tbl_documents', 'document_id', '', 'CASCADE');
        $this->forge->addForeignKey('related_document_id', 'tbl_documents', 'document_id', '', 'CASCADE');
        $this->forge->addForeignKey('relation_type_id', 'tbl_document_relation_type', 'relation_type_id', '', 'CASCADE');
        $this->forge->createTable('tbl_document_relations', true);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_document_relations', true);
    }
}
