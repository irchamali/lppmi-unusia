<?php

namespace App\Models;

use CodeIgniter\Model;

class AkreditasiModel extends Model
{
    protected $table         = 'tbl_akreditasi';
    protected $primaryKey    = 'aps_id';
    protected $allowedFields = ['prodi_id', 'no_sk', 'thn_sk', 'peringkat', 'tgl_kadaluarsa', 'aps_link'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getAllAps(): array
    {
        $rows = $this->db->table('tbl_akreditasi')
            ->select('tbl_akreditasi.*, tbl_prodi.prodi_nama, tbl_prodi.prodi_slug, tbl_prodi.prodi_kode, tbl_prodi.prodi_strata, tbl_prodi.prodi_link')
            ->join('tbl_prodi', 'tbl_akreditasi.prodi_id = tbl_prodi.prodi_id', 'left')
            ->orderBy('tbl_akreditasi.thn_sk', 'DESC')
            ->orderBy('tbl_akreditasi.tgl_kadaluarsa', 'DESC')
            ->orderBy('tbl_akreditasi.created_at', 'DESC')
            ->get()
            ->getResultArray();

        return $this->getLatestApsPerProdi($rows);
    }

    public function getLatestApsPerProdi(?array $rows = null): array
    {
        if ($rows === null) {
            $rows = $this->db->table('tbl_akreditasi')
                ->select('tbl_akreditasi.*, tbl_prodi.prodi_nama, tbl_prodi.prodi_slug, tbl_prodi.prodi_kode, tbl_prodi.prodi_strata, tbl_prodi.prodi_link')
                ->join('tbl_prodi', 'tbl_akreditasi.prodi_id = tbl_prodi.prodi_id', 'left')
                ->orderBy('tbl_akreditasi.thn_sk', 'DESC')
                ->orderBy('tbl_akreditasi.tgl_kadaluarsa', 'DESC')
                ->orderBy('tbl_akreditasi.created_at', 'DESC')
                ->get()
                ->getResultArray();
        }

        $latestByProdi = [];

        foreach ($rows as $row) {
            $prodiId = (int) ($row['prodi_id'] ?? 0);

            if ($prodiId <= 0) {
                continue;
            }

            if (!isset($latestByProdi[$prodiId])) {
                $latestByProdi[$prodiId] = $row;
                continue;
            }

            $current = $latestByProdi[$prodiId];
            $currentRank = (int) ($current['thn_sk'] ?? 0);
            $candidateRank = (int) ($row['thn_sk'] ?? 0);

            if ($candidateRank > $currentRank) {
                $latestByProdi[$prodiId] = $row;
                continue;
            }

            if ($candidateRank === $currentRank) {
                $currentDate = (string) ($current['tgl_kadaluarsa'] ?? '0000-00-00');
                $candidateDate = (string) ($row['tgl_kadaluarsa'] ?? '0000-00-00');

                if ($candidateDate > $currentDate) {
                    $latestByProdi[$prodiId] = $row;
                    continue;
                }

                if ($candidateDate === $currentDate && (string) ($row['created_at'] ?? '') > (string) ($current['created_at'] ?? '')) {
                    $latestByProdi[$prodiId] = $row;
                }
            }
        }

        $latestList = array_values($latestByProdi);

        usort($latestList, static function (array $a, array $b): int {
            $yearA = (int) ($a['thn_sk'] ?? 0);
            $yearB = (int) ($b['thn_sk'] ?? 0);

            if ($yearA !== $yearB) {
                return $yearB <=> $yearA;
            }

            $kadaluarsaA = (string) ($a['tgl_kadaluarsa'] ?? '0000-00-00');
            $kadaluarsaB = (string) ($b['tgl_kadaluarsa'] ?? '0000-00-00');

            if ($kadaluarsaA !== $kadaluarsaB) {
                return $kadaluarsaB <=> $kadaluarsaA;
            }

            return (string) ($b['created_at'] ?? '') <=> (string) ($a['created_at'] ?? '');
        });

        return $latestList;
    }

    public function getGroupedHistoryByProdi(string $slug): ?array
    {
        $slug = trim((string) $slug);

        if ($slug === '') {
            return null;
        }

        $program = $this->db->table('tbl_prodi')
            ->where('prodi_slug', $slug)
            ->get()
            ->getRowArray();

        if ($program === null) {
            return null;
        }

        $history = $this->db->table('tbl_akreditasi')
            ->select('tbl_akreditasi.*, tbl_prodi.prodi_nama, tbl_prodi.prodi_slug, tbl_prodi.prodi_kode, tbl_prodi.prodi_strata, tbl_prodi.prodi_link')
            ->join('tbl_prodi', 'tbl_prodi.prodi_id = tbl_akreditasi.prodi_id', 'left')
            ->where('tbl_akreditasi.prodi_id', $program['prodi_id'])
            ->orderBy('tbl_akreditasi.thn_sk', 'DESC')
            ->orderBy('tbl_akreditasi.tgl_kadaluarsa', 'DESC')
            ->orderBy('tbl_akreditasi.created_at', 'DESC')
            ->get()
            ->getResultArray();

        $program['history'] = $history;
        $program['latest'] = $history[0] ?? null;
        $program['previous_history'] = array_slice($history, 1);

        return $program;
    }
}
