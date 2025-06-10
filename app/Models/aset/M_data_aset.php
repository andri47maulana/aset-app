<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_data_aset extends Model
{
    protected $table = 'data_aset';
    protected $allowedFields = ['nomor_sap', 'unit_id', 'status_posisi', 'aset_name', 'aset_tipe', 'aset_jenis', 'aset_kondisi', 'aset_sub_unit', 'aset_kode'];

    public function getOneAset($id)
    {
        return $this->select('aset_id,nomor_sap, sp_desc, unit_desc, aset_name,nilai_residu, aset_tipe_desc, aset_jenis_desc, aset_kondisi_desc, sub_unit_desc, foto_aset1, foto_aset2, foto_aset3, foto_aset4, foto_aset5, data_aset.aset_desc, geo_tag1, aset_luas, afdeling_desc, nilai_oleh, masa_susut, keterangan, persen_kondisi, hgu, satuan_luas, jumlah_pohon')
            ->join('amanat_unit', 'data_aset.unit_id = amanat_unit.unit_id', 'left')
            ->join('sub_unit', 'data_aset.aset_sub_unit = sub_unit.sub_unit_id', 'left')
            ->join('aset_kondisi', 'data_aset.aset_kondisi = aset_kondisi.aset_kondisi_id', 'left')
            ->join('aset_tipe', 'data_aset.aset_tipe = aset_tipe.aset_tipe_id', 'left')
            ->join('aset_jenis', 'data_aset.aset_jenis = aset_jenis.aset_jenis_id', 'left')
            ->join('status_posisi', 'data_aset.status_posisi = status_posisi.sp_id', 'left')
            ->join('aset_kode', 'data_aset.aset_kode = aset_kode.aset_kode_id', 'left')
            ->join('afdeling', 'data_aset.afdeling_id = afdeling.afdeling_id', 'left')
            ->where("aset_id", $id)
            ->first();
    }
    public function getAmanatDataWithUnitDesc()
    {
        return $this->select('amanat_sap.sap_id, amanat_sap.sap_desc, amanat_sap.sap_name, amanat_unit.unit_desc, amanat_sap.nilai_oleh, amanat_sap.nilai_residu, amanat_sap.tgl_oleh, amanat_sap.masa_susut, amanat_sap.kode_aset, amanat_sap.nilai_penyusutan')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->distinct()
            ->orderBy('amanat_sap.tgl_oleh', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function editAmanatData($id)
    {
        return $this->select('aset_id,nomor_sap, sp_desc, unit_desc, aset_name,nilai_residu, aset_tipe_desc, aset_jenis_desc, aset_kondisi_desc, sub_unit_desc,data_aset.unit_id, aset_tipe, aset_jenis, aset_kondisi, aset_sub_unit')
            ->join('amanat_unit', 'data_aset.unit_id = amanat_unit.unit_id', 'left')
            ->join('sub_unit', 'data_aset.aset_sub_unit = sub_unit.sub_unit_id', 'left')
            ->join('aset_kondisi', 'data_aset.aset_kondisi = aset_kondisi.aset_kondisi_id', 'left')
            ->join('aset_tipe', 'data_aset.aset_tipe = aset_tipe.aset_tipe_id', 'left')
            ->join('aset_jenis', 'data_aset.aset_jenis = aset_jenis.aset_jenis_id', 'left')
            ->join('status_posisi', 'data_aset.status_posisi = status_posisi.sp_id', 'left')
            ->where('aset_id', $id)
            ->get()
            ->getRow();
    }

    public function getUnitData()
    {
        return $this->db->table('amanat_unit')->get()->getResultArray();
    }

    public function getTipeAset()
    {
        return $this->db->table('aset_tipe')->get()->getResultArray();
    }

    public function getJenisAset()
    {
        return $this->db->table('aset_jenis')->get()->getResultArray();
    }
    public function getKondisiAset()
    {
        return $this->db->table('aset_kondisi')->get()->getResultArray();
    }
    public function getSubUnit()
    {
        return $this->db->table('sub_unit')->get()->getResultArray();
    }

    public function deleteAmanatData($id)
    {
        return $this->db->table('data_aset')
            ->where('aset_id', $id)
            ->set(
                [
                    'is_deleted' => 1,
                ]
            )
            ->update();
    }

    public function getupdate($id, $data)
    {
        return $this->where('aset_id', $id)->set($data)->update();
    }

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('aset_id,nomor_sap, sp_desc, unit_desc, aset_name,nilai_residu, aset_tipe_desc, aset_jenis_desc, aset_kondisi_desc, sub_unit_desc, foto_aset1, foto_aset2, foto_aset3, foto_aset4, foto_aset5, data_aset.aset_desc, geo_tag1, aset_luas, satuan_luas, id_region')
            ->join('amanat_unit', 'data_aset.unit_id = amanat_unit.unit_id', 'left')
            ->join('sub_unit', 'data_aset.aset_sub_unit = sub_unit.sub_unit_id', 'left')
            ->join('aset_kondisi', 'data_aset.aset_kondisi = aset_kondisi.aset_kondisi_id', 'left')
            ->join('aset_tipe', 'data_aset.aset_tipe = aset_tipe.aset_tipe_id', 'left')
            ->join('aset_jenis', 'data_aset.aset_jenis = aset_jenis.aset_jenis_id', 'left')
            ->join('status_posisi', 'data_aset.status_posisi = status_posisi.sp_id', 'left')
            ->join('aset_kode', 'data_aset.aset_kode = aset_kode.aset_kode_id', 'left')
            ->where('is_deleted', 0)
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('data_aset.nomor_sap', $katakunci)
                ->orLike('data_aset.status_posisi', $katakunci)
                ->orLike('amanat_unit.unit_desc', $katakunci)
                ->groupEnd();
        }

        // Filtering Data Aset
        $hak_akses = session()->get("hak_akses_id");
        $unit_id = session()->get("unit_id");
        $afdeling_id = session()->get("afdeling_id");
        $id_region = session()->get("id_region");

        if ($hak_akses == 7 || $hak_akses == 6) {
            $builder->where("afdeling_id", $afdeling_id);
        }
        if ($hak_akses == 3 || $hak_akses == 4 || $hak_akses == 5) {
            $builder->where("data_aset.unit_id", $unit_id);
        }
        if ($hak_akses == 11) {
            $builder->where("amanat_unit.id_region", $id_region);

        }
        //LAST QUERY YANG BERHASIL
         //$sql = $builder->getCompiledSelect();
         //echo $sql;
         //die();

        // Get total records count
        $totalRecords = $builder->countAllResults(false);

        // Apply length and start for pagination
        if ($length > 0) {
            $builder->limit($length, $start);
        }

        // Get filtered records count
        $filteredRecords = $builder->countAllResults(false);

        // Get the data
        $data = $builder->orderBy('data_aset.nomor_sap', 'DESC')
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

    public function insertData($data)
    {
        $this->insert($data);
    }

    public function checkDuplicate($sap_desc)
    {
        return $this->where('sap_desc', $sap_desc)->countAllResults() > 0;
    }
}
