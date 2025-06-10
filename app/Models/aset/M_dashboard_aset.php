<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_dashboard_aset extends Model
{
    protected $table = 'amanat_unit';
    protected $allowedFields = 'unit_id, unit_desc, id_region, id_region, master_region_nama';

    public function getCountAfdeling($unit_id, $filter = '')
    {
        $query = $this->db->table('afdeling')
            ->select('amanat_unit.unit_id, COUNT(afdeling.afdeling_id) AS jumlah_afdeling')
            ->join('amanat_unit', 'amanat_unit.unit_id = afdeling.unit_id', 'left')
            ->where('afdeling.unit_id', $unit_id);

        $result = $query->groupBy('amanat_unit.unit_id')->get()->getRow();

        if ($result) {
            $jumlah_afdeling = $result->jumlah_afdeling;
        } else {
            $jumlah_afdeling = 0;
        }

        return $jumlah_afdeling;
    }

    public function getJumlahUnitRegional($id_regional, $filter = '')
    {
        $query = $this->db->table('amanat_unit')
            ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', $id_regional);

        $result = $query->groupBy('master_region.id_region')->get()->getRow();

        if ($result) {
            $jumlah_unit = $result->jumlah_unit;
        } else {
            $jumlah_unit = 0;
        }

        return $jumlah_unit;
    }


    public function getJumlahAsetRegional($id_regional, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->where('amanat_unit.id_region', $id_regional);

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $result = $query->groupBy('amanat_unit.id_region')->get()->getRow();
        // echo "<hr>";
        // var_dump($this->db->getLastQuery()->getQuery());

        if ($result) {
            $total_aset_sap = $result->total_aset_sap;
        } else {
            $total_aset_sap = 0;
        }

        return $total_aset_sap;
    }


    // Total Aset SAP pada Unit
    public function getTotalAsetSapUnit($unit_id, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->where('amanat_unit.unit_id', $unit_id);

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $result = $query->groupBy('amanat_unit.unit_id')->get()->getRow();
        // echo "<hr>";
        // var_dump($this->db->getLastQuery()->getQuery());

        if ($result) {
            $total_aset_sap = $result->total_aset_sap;
        } else {
            $total_aset_sap = 0;
        }

        return $total_aset_sap;
    }


    public function getTotalAsetSapRegional($id_regional, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->where('amanat_unit.id_region', $id_regional);

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $result = $query->groupBy('amanat_unit.id_region')->get()->getRow();
        // echo "<hr>";
        // var_dump($this->db->getLastQuery()->getQuery());

        if ($result) {
            $total_aset_sap = $result->total_aset_sap;
        } else {
            $total_aset_sap = 0;
        }

        return $total_aset_sap;
    }

    public function getJumlahAsetUnit($id_region, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->select('amanat_unit.unit_id as unit_id')
            ->select('amanat_unit.unit_desc as unit_desc')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->join('master_region', 'master_region.id_region= amanat_unit.id_region', 'left')
            ->where('amanat_unit.id_region', $id_region);

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $query->groupBy('amanat_unit.unit_id')
            ->orderBy('amanat_unit.unit_desc');

        $result = $query->get()->getResult();

        return $result;
    }


    public function getJumlahAsetPerusahaan($kode_perusahaan, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->select('master_region.id_region as id_region')
            ->select('master_region_nama')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->join('master_region', 'master_region.id_region= amanat_unit.id_region', 'left')
            ->where('master_region.master_region_perusahaan_kode', $kode_perusahaan);

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $query->groupBy('master_region.id_region')
            ->orderBy('master_region_nama');

        $result = $query->get()->getResult();

        return $result;
    }




    public function getJumlahAsetPtpn($filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->select('master_perusahaan.master_perusahaan_kode as id_perusahaan')
            ->select('master_perusahaan_nama as master_region_nama')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->join('master_region', 'master_region.id_region= amanat_unit.id_region', 'left')
            ->join('master_perusahaan', 'master_perusahaan.master_perusahaan_kode=master_region.master_region_perusahaan_kode');

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $query->groupBy('master_perusahaan.master_perusahaan_id')
            ->orderBy('master_perusahaan_kode');

        $result = $query->get()->getResult();

        return $result;
    }


    public function getPresentaseAsetUnit($unit_id, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(*) as total_aset_sap')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'left')
            ->where('amanat_unit.unit_id', $unit_id);

        $result = $query->get()->getRow();

        $totalAset = $this->db->table('maia_masterlist')
            ->countAll();

        $presentaseAset = 0;

        if ($totalAset > 0) {
            $presentaseAset = ($result->total_aset_sap / $totalAset) * 100;
        } else {
            $presentaseAset = 0;
        }

        return $presentaseAset;
    }

    public function getPresentaseAsetRegional($id_regional, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(*) as total_aset_sap')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'left')
            ->where('amanat_unit.id_region', $id_regional);

        $result = $query->get()->getRow();


        $totalAset = $this->db->table('maia_masterlist')
            ->countAll();

        $presentaseAset = 0;

        if ($totalAset > 0) {
            $presentaseAset = ($result->total_aset_sap / $totalAset) * 100;
        }

        return $presentaseAset;
    }



    public function getJumlahAsetTeridentifikasiRegional($id_regional, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(*) as jumlahTeridentifikasi')
            ->join('data_aset', 'data_aset.nomor_sap = maia_masterlist.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id')
            ->where('amanat_unit.id_region', $id_regional);

        $result = $query->get()->getRow();

        if ($result) {
            $jumlahTeridentifikasi = $result->jumlahTeridentifikasi;
        } else {
            $jumlahTeridentifikasi = 0;
        }

        return $jumlahTeridentifikasi;
    }




    //perusahaan

    public function getJumlahUnitPerusahaan($id_perusahaan, $filter = '')
    {
        $query = $this->db->table('amanat_unit')
            ->select('master_perusahaan_id, COUNT(amanat_unit.unit_id) AS jumlah_unit')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'inner')
            ->join('master_perusahaan', 'master_perusahaan.master_perusahaan_kode = master_region.master_region_perusahaan_kode', 'left')
            ->where('master_perusahaan.master_perusahaan_id', $id_perusahaan);

        $result = $query->groupBy('master_perusahaan.master_perusahaan_id')->get()->getRow();

        if ($result) {
            $jumlah_unit = $result->jumlah_unit;
        } else {
            $jumlah_unit = 0;
        }

        return $jumlah_unit;
    }

    public function getJumlahAsetPerusahaanAll($id_perusahaan, $filter = '')
    {

        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->select('master_region.id_region as id_region')
            ->select('master_region_nama')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->join('master_region', 'master_region.id_region= amanat_unit.id_region', 'left')
            ->where('master_region.master_region_perusahaan_id', $id_perusahaan);

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $query->groupBy('master_region.id_region')
            ->orderBy('master_region_nama');

        $result = $query->get()->getResult();

        return $result;
    }

    public function getTotalAsetSapPerusahaan($id_perusahaan, $filter = '')
    {

        $query = $this->db->table('maia_masterlist')
            ->select('master_perusahaan_id,COUNT(maia_masterlist.unit_id) AS total_aset_sap')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'inner')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'inner')
            ->join('master_perusahaan', 'master_perusahaan.master_perusahaan_kode = master_region.master_region_perusahaan_kode', 'left')
            ->where('master_perusahaan.master_perusahaan_id', $id_perusahaan);;

        if ($filter != '') {
            foreach ($filter as $field => $value) {
                if ($value == null) continue;
                if (is_array($value)) {
                    $query->groupStart();
                    foreach ($value as $v) {
                        $query->orWhere($field, $v);
                    }
                    $query->groupEnd();
                } else {
                    $query->where($field, $value);
                }
            }
        }

        $result = $query->groupBy('master_perusahaan_id')->get()->getRow();

        // var_dump($this->db->getLastQuery()->getQuery());


        if ($result) {
            $total_aset_sap = $result->total_aset_sap;
        } else {
            $total_aset_sap = 0;
        }


        return $total_aset_sap;
    }

    public function getPresentaseAsetPerusahaan($id_perusahaan, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(*) as total_aset_sap')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id', 'left')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'inner')
            ->join('master_perusahaan', 'master_perusahaan.master_perusahaan_kode = master_region.master_region_perusahaan_kode', 'left')
            ->where('master_perusahaan.master_perusahaan_id', $id_perusahaan);


        $result = $query->get()->getRow();


        $totalAset = $this->db->table('maia_masterlist')
            ->countAll();

        $presentaseAset = 0;

        if ($totalAset > 0) {
            $presentaseAset = ($result->total_aset_sap / $totalAset) * 100;
        }

        return $presentaseAset;
    }

    public function getJumlahAsetTeridentifikasiPerusahaan($id_regional, $filter = '')
    {
        $query = $this->db->table('maia_masterlist')
            ->select('COUNT(*) as jumlahTeridentifikasi')
            ->join('data_aset', 'data_aset.nomor_sap = maia_masterlist.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = maia_masterlist.unit_id')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'inner')
            ->join('master_perusahaan', 'master_perusahaan.master_perusahaan_kode = master_region.master_region_perusahaan_kode', 'left')
            ->where('master_perusahaan.master_perusahaan_id', $id_perusahaan);



        $result = $query->get()->getRow();

        if ($result) {
            $jumlahTeridentifikasi = $result->jumlahTeridentifikasi;
        } else {
            $jumlahTeridentifikasi = 0;
        }

        return $jumlahTeridentifikasi;
    }
}
