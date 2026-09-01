<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExpandDocumentStatus extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE tbl_documents MODIFY status ENUM('submitted', 'approved', 'revised', 'rejected', 'archived') NOT NULL DEFAULT 'submitted'");
        $this->db->query("UPDATE tbl_documents SET status = 'revised' WHERE status = '' AND validation_notes IS NOT NULL AND validation_notes <> ''");
        $this->db->query("UPDATE tbl_documents SET status = 'submitted' WHERE status = ''");
    }

    public function down()
    {
        $this->db->query("UPDATE tbl_documents SET status = 'submitted' WHERE status IN ('revised', 'rejected', 'archived')");
        $this->db->query("ALTER TABLE tbl_documents MODIFY status ENUM('submitted', 'approved') NOT NULL DEFAULT 'submitted'");
    }
}