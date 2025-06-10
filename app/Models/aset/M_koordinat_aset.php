<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_koordinat_aset extends Model
{

    protected $table = 'koordinat_aset';

    protected $primaryKey = 'aset_id';

    protected $allowedFields = [
        'aset_id',
        'nomor_aset',
        'deskripsi',
        'nomor_alas_hak',
        'titik_koordinat',
        'user_id',
        'sap_id',
        'unit_id',
        'kml_file',
        'kml_publish',
        'latitude',
        'longitude',
        'created_at',
        'updated_at',
    ];

    protected $returnType = 'object';

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('aset_id, nomor_aset, deskripsi, nomor_alas_hak, titik_koordinat')
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('nomor_aset', $katakunci)
                ->groupEnd();
        }

        // Get total records count
        $totalRecords = $builder->countAllResults(false);

        // Apply length and start for pagination
        if ($length > 0) {
            $builder->limit($length, $start);
        }

        // Get filtered records count
        $filteredRecords = $builder->countAllResults(false);

        // Get the data
        $data = $builder->orderBy('aset_id', 'DESC')
            ->get()
            ->getResultArray();

        // $lastQuery = $data->getLastQuery();
        //     echo $lastQuery;
        //     die();

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data,
        ];
    }

    public function deleteKoordinatData($id)
    {
        return $this->db->table('koordinat_Aset')->where('aset_id', $id)->delete();
    }

    public function getAsetData()
    {
        return $this->db->table('koordinat_Aset')->get()->getResultArray();
    }

    public function editAsetData($id)
    {
        return $this->select('*')
            ->where('aset_id', $id)
            ->get()
            ->getRow();
    }

    public function getupdate($id, $data)
    {
        return $this->where('aset_id', $id)->set($data)->update();
    }

}
