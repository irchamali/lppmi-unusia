<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddMissingSettingFields extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('home_bg_testimonial3', 'tbl_home')) {
            $this->forge->addColumn('tbl_home', [
                'home_bg_testimonial3' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                    'after' => 'home_bg_testimonial2',
                ],
            ]);
        }

        if (! $this->db->fieldExists('about_strategi', 'tbl_about')) {
            $this->forge->addColumn('tbl_about', [
                'about_strategi' => [
                    'type' => 'TEXT',
                    'null' => true,
                    'after' => 'about_misi',
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('home_bg_testimonial3', 'tbl_home')) {
            $this->forge->dropColumn('tbl_home', 'home_bg_testimonial3');
        }

        if ($this->db->fieldExists('about_strategi', 'tbl_about')) {
            $this->forge->dropColumn('tbl_about', 'about_strategi');
        }
    }
}