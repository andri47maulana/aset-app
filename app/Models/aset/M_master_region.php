<?php

namespace App\Models\aset;

use CodeIgniter\Model;

//Commit Ulang

class M_master_region extends Model
{

    protected $table = 'master_region';

    protected $primaryKey = 'id_region';

    protected $allowedFields = [
        'master_region_kode',
        'master_region_kota',
        'master_region_norek',
        'master_region_bank',
        'master_region_alamat_bank',
        'master_region_perusahaan_kode',
        'master_region_nama',
        'master_region_lokasi'
    ];

    protected $returnType = 'object';


    // -- Function

    // --- Company

    public function getCompanyList($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select(
            '
            id_region, 
            master_region_kode, 
            master_region_perusahaan_kode, 
            master_region_nama
            '
        );

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('master_region_kode', $katakunci, 'both')
                ->orLike('master_region_nama', $katakunci, 'both')
                ->orLike('master_region_perusahaan_kode', $katakunci, 'both')
                ->groupEnd();
        }

        // count total records
        $totalRecords = $builder->countAllResults(false);

        // pagination
        if ($length > 0) {
            $builder->limit($length, $start);
        }

        // get filtered records count
        $filteredRecords = $builder->countAllResults(false);

        // get the data
        $data = $builder->get()->getResultArray();

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data
        ];
    }

    public function editCompanyData($id)
    {
        return $this->select('*')
            ->where('id_region', $id)
            ->get()
            ->getRow();
    }

    /**
     * Update data company berdasarkan id yang diberikan
     * @param int $id id dari data company yang ingin di update
     * @param array $data data yang ingin di update
     */
    public function updateCompanyData($id, $data)
    {
        return $this->where('id_region', $id)
            ->set($data)
            ->update();
    }

    public function deleteCompanyData($id)
    {
        return $this->db->table('master_region')->where('id_region', $id)->delete();
    }


    // ----- End Company


    // ----- Region
    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select(
            '
            id_region,master_region_nama, 
            master_region_lokasi, 
            master_region_insert, 
            master_region_update
            '
        )
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('master_region_nama', $katakunci)
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
        $data = $builder->orderBy('id_region', 'DESC')
            ->get()
            ->getResultArray();

        // $lastQuery = $data->getLastQuery();
        //     echo $lastQuery;
        //     die();

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data
        ];
    }

    public function getRegionData()
    {
        return $this->db->table('master_region')->get()->getResultArray();
    }

    public function deleteRegionData($id)
    {
        return $this->db->table('master_region')->where('id_region', $id)->delete();
    }

    public function editRegionData($id)
    {
        return $this->select('*')
            ->where('id_region', $id)
            ->get()
            ->getRow();
    }


    public function getupdate($id, $data)
    {
        return $this->where('id_region', $id)->set($data)->update();
    }
}
