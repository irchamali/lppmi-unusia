<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDocumentValidationNotes extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tbl_documents', [
            'validation_notes' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'validated_at',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tbl_documents', 'validation_notes');
    }
}