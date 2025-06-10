<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_amanat_report extends Model
{
    public function getAsetTipeData()
    {
        return $this->db->table('aset_tipe')->select('aset_tipe_id, aset_tipe_desc')->get()->getResultArray();
    }

    public function getAsetJenisData()
    {
        return $this->db->table('aset_jenis')->select('aset_jenis_id, aset_jenis_desc')->get()->getResultArray();
    }

    public function getAsetKondisiData()
    {
        return $this->db->table('aset_kondisi')->select('aset_kondisi_id, aset_kondisi_desc')->get()->getResultArray();
    }

    public function getAsetKodeData()
    {
        return $this->db->table('aset_kode')->select('aset_kode_id, aset_class, aset_group, aset_desc, aset_jenis')->get()->getResultArray();
    }

    public function getUnitData()
    {
        return $this->db->table('amanat_unit')->select('unit_id, unit_desc')->get()->getResultArray();
    }

    public function getRegionData()
    {
        return $this->db->table('master_region')->select('id_region, master_region_nama')
            ->get()
            ->getResultArray();
    }
    public function getAsetClassData()
    {
        return $this->db->table('aset_kode')->select('aset_kode_id, aset_class, aset_desc')
            ->get()
            ->getResultArray();
    }

    public function getAsetGrupData()
    {
        return $this->db->table('aset_kode')->select('aset_kode_id, aset_group, aset_desc')
            ->groupBy('aset_group')
            ->get()
            ->getResultArray();
    }
}
