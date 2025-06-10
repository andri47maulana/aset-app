<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_dash_region extends Model
{
    protected $table = 'amanat_unit';
   
    protected $allowedFields = ['unit_id', 'unit_desc', 'id_region', 'id_region', 'master_region_nama', 'total_aset_sap', 'total_aset_teridentifikasi'];

    // Mendapatkan unit sesuai dengan regional 1
    public function getUnitListRegional1()
    {
        // Menghitung jumlah total aset di region 1
        $totalAsetRegion1 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 1)
            ->get()
            ->getRowArray();

        $totalAsetRegion1 = $totalAsetRegion1['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 1)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 1 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion1 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion1) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 2
    public function getUnitListRegional2()
    {
        // Menghitung jumlah total aset di region 2
        $totalAsetRegion2 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 2)
            ->get()
            ->getRowArray();

        $totalAsetRegion2 = $totalAsetRegion2['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 2)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 2 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion2 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion2) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 3
    public function getUnitListRegional3()
    {
        // Menghitung jumlah total aset di region 3
        $totalAsetRegion3 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 3)
            ->get()
            ->getRowArray();

        $totalAsetRegion3 = $totalAsetRegion3['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 3)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 3 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion3 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion3) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 4
    public function getUnitListRegional4()
    {
        // Menghitung jumlah total aset di region 4
        $totalAsetRegion4 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 4)
            ->get()
            ->getRowArray();

        $totalAsetRegion4 = $totalAsetRegion4['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 4)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 4 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion4 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion4) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 5
    public function getUnitListRegional5()
    {
        // Menghitung jumlah total aset di region 5
        $totalAsetRegion5 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 5)
            ->get()
            ->getRowArray();

        $totalAsetRegion5 = $totalAsetRegion5['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 5)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 5 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion5 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion5) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 6
    public function getUnitListRegional6()
    {
        // Menghitung jumlah total aset di region 6
        $totalAsetRegion6 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 6)
            ->get()
            ->getRowArray();

        $totalAsetRegion6 = $totalAsetRegion6['total_aset_sap']; 

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 6)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 6 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion6 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion6) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 7
    public function getUnitListRegional7()
    {
        // Menghitung jumlah total aset di region 7
        $totalAsetRegion7 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 7)
            ->get()
            ->getRowArray();

        $totalAsetRegion7 = $totalAsetRegion7['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 7)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 7 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion7 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion7) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 8
    public function getUnitListRegional8()
    {
        // Menghitung jumlah total aset di region 8
        $totalAsetRegion8 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 8)
            ->get()
            ->getRowArray();

        $totalAsetRegion8 = $totalAsetRegion8['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 8)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 7 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion8 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion8) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    // Mendapatkan unit sesuai dengan regional 9
    public function getUnitListRegional9()
    {
        // Menghitung jumlah total aset di region 9
        $totalAsetRegion9 = $this->db->table('amanat_unit')
            ->selectSum('total_aset_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 9)
            ->get()
            ->getRowArray();

        $totalAsetRegion9 = $totalAsetRegion9['total_aset_sap'];

        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->where('master_region.id_region', 9)
            ->get()
            ->getResultArray();

        $unitList = [];

        foreach ($query as $row) {
            // Menghitung presentase aset per unit
            $jumlahAsetPerUnit = $row['total_aset_sap'];
            $presentaseAsetPerUnit = 0; // Default 0% jika terjadi pembagian oleh nol

            // Jika total aset di region 7 bukan nol, maka hitung presentase aset per unit
            if ($totalAsetRegion9 != 0) {
                $presentaseAsetPerUnit = ($jumlahAsetPerUnit / $totalAsetRegion9) * 100;
            }

            $unitId = $row['unit_id'];

            $unitList[] = [
                'unit_id' => $unitId,
                'unit_desc' => $row['unit_desc'],
                'total_aset_sap' => $jumlahAsetPerUnit,
                'total_aset_teridentifikasi' => $row['total_aset_teridentifikasi'],
                'presentase_aset' => number_format($presentaseAsetPerUnit, 2)
            ];
        }

        return $unitList;
    }

    //LIST ASET PER UNIT
    public function getAsetListByUnitId($unitId)
    {
        $query = $this->db->table('amanat_sap')
            ->select('*')
            ->where('amanat_sap.unit_id', $unitId)
            ->get()
            ->getResultArray();
        

        return $query;
    }

    public function getUnitData($unitId)
    {
        return $this->db->table('amanat_sap')
            ->select('amanat_sap.unit_id, amanat_unit.unit_id, amanat_unit.unit_desc')
            ->join('amanat_unit','amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.unit_id', $unitId)
            ->get()
            ->getRow();
    }




    // //Detail Aset
    // public function getAsetDetailBySap($nomor_sap)
    // {
    //     $query = $this->db->table('data_aset')
    //         ->select(' nomor_sap, aset_name, aset_id, unit_id, status_posisi ,aset_tipe,aset_jenis  ,aset_kondisi , aset_sub_unit , aset_kode , foto_aset1, foto_aset2, foto_aset3, foto_aset4, foto_aset5, geo_tag1, geo_tag2, geo_tag3, geo_tag4, geo_tag5, aset_luas, tgl_input, tgl_oleh, nilai_residu,  
    //         nomor_sap, aset_name,nilai_oleh, nomor_bast, masa_susut, keterangan, foto_qr, no_inv,foto_aset_qr , foto_aset_qr_2,afdeling_id, user_input_id , jumlah_pohon, persen_kondisi , berita_acara, status_reject, ket_reject , aset_foto_qr_status,aset_foto_qr2_status, hgu, pop_total_ini, pop_total_std , pop_hektar_ini,pop_hektar_std,alat_pengangkutan, satuan_luas,file_bast, sistem_tanam , tahun_tanam , pop_pohon_saat_ini, pop_standar, pop_per_ha, presentase_pop_per_ha')
    //         ->where('nomor_sap', $nomor_sap)
    //         ->get()
    //         ->getResultArray();

    //     return $query;
    // }

   
}
