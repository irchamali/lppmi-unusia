<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDocumentRelationStatus extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_document_relations', [
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['submitted', 'approved', 'revised', 'rejected'],
                'default' => 'submitted',
                'null' => false,
                'after' => 'created_by',
            ],
            'validated_by' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'status',
            ],
            'validated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'validated_by',
            ],
            'validation_notes' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'validated_at',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_document_relations', ['status', 'validated_by', 'validated_at', 'validation_notes']);
    }
}
