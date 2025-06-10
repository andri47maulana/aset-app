<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_amanat_advanced extends Model
{
    public function getAsetTipeData()
    {
        return $this->db->table('aset_tipe')->select('aset_tipe_id, aset_tipe_desc')->get()->getResultArray();
    }

    public function getAsetKondisiData()
    {
        return $this->db->table('aset_kondisi')->select('aset_kondisi_id, aset_kondisi_desc')->get()->getResultArray();
    }

    public function getSubUnitData()
    {
        return $this->db->table('sub_unit')->select('sub_unit_id, sub_unit_desc')->get()->getResultArray();
    }

    public function getAsetGrupData()
    {
        return $this->db->table('aset_kode')->select('aset_kode_id, aset_group')
            ->groupBy('aset_group')
            ->get()->getResultArray();
    }

    public function getAsetClassData()
    {
        return $this->db->table('aset_kode')->select('aset_kode_id, aset_class')
            ->groupBy('aset_class')
            ->get()->getResultArray();
    }
}
