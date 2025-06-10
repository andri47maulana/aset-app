<?php

namespace App\Models\aset;

use CodeIgniter\Model;

//Commit Ulang

class M_master_unit extends Model
{

    protected $table = 'amanat_unit';

    protected $primaryKey = 'unit_id';

    protected $allowedFields = [
        'unit_id',
        'unit_desc',
        'unit_kode',
        'unit_tipe',
        'id_region'
    ];

    protected $returnType = 'object';

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.unit_kode, amanat_unit.unit_tipe, amanat_unit.id_region, master_region.master_region_nama, sub_unit.sub_unit_desc')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->join('sub_unit', 'sub_unit.sub_unit_id = amanat_unit.unit_tipe', 'left')
            ->distinct();


        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('unit_desc', $katakunci)
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
        $data = $builder->orderBy('unit_id', 'DESC')
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

    public function deleteUnitData($id)
    {
        return $this->db->table('amanat_unit')->where('unit_id', $id)->delete();
    }

    public function editUnitData($id)
    {
        return $this->select('*')
            ->where('unit_id', $id)
            ->get()
            ->getRow();
    }


    public function getupdate($id, $data)
    {
        return $this->where('unit_id', $id)->set($data)->update();
    }
}
