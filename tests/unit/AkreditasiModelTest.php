<?php

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\AkreditasiModel;

final class AkreditasiModelTest extends CIUnitTestCase
{
    public function testGetLatestApsPerProdiKeepsNewestRecordOnlyPerProgram(): void
    {
        $model = new AkreditasiModel();

        $rows = [
            ['prodi_id' => 10, 'thn_sk' => 2020, 'tgl_kadaluarsa' => '2024-12-31', 'no_sk' => 'SK-2020'],
            ['prodi_id' => 10, 'thn_sk' => 2025, 'tgl_kadaluarsa' => '2030-12-31', 'no_sk' => 'SK-2025'],
            ['prodi_id' => 11, 'thn_sk' => 2021, 'tgl_kadaluarsa' => '2026-12-31', 'no_sk' => 'SK-2021'],
            ['prodi_id' => 11, 'thn_sk' => 2023, 'tgl_kadaluarsa' => '2028-12-31', 'no_sk' => 'SK-2023'],
        ];

        $result = $model->getLatestApsPerProdi($rows);

        $this->assertCount(2, $result);
        $this->assertSame('SK-2025', $result[0]['no_sk']);
        $this->assertSame('SK-2023', $result[1]['no_sk']);
    }
}
