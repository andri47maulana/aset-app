<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_count_aset extends Model
{
    protected $table = 'amanat_unit';
    protected $allowedFields = ['unit_id', 'unit_desc', 'id_region', 'id_region', 'master_region_nama', 'total_aset_sap', 'total_aset_teridentifikasi'];

    // public function getUnitListByRegional($regionalId)
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', $regionalId)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', $regionalId)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();

    //         $jumlahAset = $jumlahAset ? $jumlahAset->total_aset_sap : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //             ->select('COUNT(*) as jumlah_sap')
    //             ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //             ->where('amanat_sap.unit_id', $unitId)
    //             ->get()
    //             ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;

    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
    //         ];
    //     }

    //     return $unitList;
    // }

    // public function saveUnitData($unitList)
    // {
    //     foreach ($unitList as $unit) {
    //         $data = [
    //             'total_aset_sap' => $unit['total_aset_sap'],
    //             'total_aset_teridentifikasi' => $unit['jumlah_nomor_sap']
    //         ];
    //         $this->db->table('amanat_unit')->where('unit_id', $unit['unit_id'])->update($data);
    //     }
    // }

    public function getUnitListByRegional($regionalId)
    {
        $query = $this->db->table('amanat_unit')
            ->select('amanat_unit.unit_id, amanat_unit.unit_desc, COUNT(amanat_sap.unit_id) AS total_aset_sap, COUNT(data_aset.nomor_sap) AS jumlah_nomor_sap')
            ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
            ->join('amanat_sap', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset', 'left')
            ->where('master_region.id_region', $regionalId)
            ->groupBy('amanat_unit.unit_id')
            ->get()
            ->getResultArray();

        return $query;
    }

    public function saveUnitData($unitList)
    {
        foreach ($unitList as $unit) {
            $data = [
                'total_aset_sap' => $unit['total_aset_sap'],
                'total_aset_teridentifikasi' => $unit['jumlah_nomor_sap']
            ];
            $this->db->table('amanat_unit')->where('unit_id', $unit['unit_id'])->update($data);
        }
    }

    // // Mendapatkan unit sesuai dengan regional 1
    // public function getUnitListRegional1()
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', 1)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap5')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', 1)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();


    //         $jumlahAset1 = $jumlahAset ? $jumlahAset->total_aset_sap1 : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //         ->select('COUNT(*) as jumlah_sap')
    //         ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //         ->where('amanat_sap.unit_id', $unitId)
    //         ->get()
    //         ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;


    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset1,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
                
    //         ];
    //     }

    //     return $unitList;
    // }

    // // Mendapatkan unit sesuai dengan regional 2
    // public function getUnitListRegional2()
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', 2)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap2')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', 2)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();


    //         $jumlahAset2 = $jumlahAset ? $jumlahAset->total_aset_sap2 : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //         ->select('COUNT(*) as jumlah_sap')
    //         ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //         ->where('amanat_sap.unit_id', $unitId)
    //         ->get()
    //         ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;


    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset2,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
                
    //         ];
    //     }

    //     return $unitList;
    // }

    // // Mendapatkan unit sesuai dengan regional 3
    // public function getUnitListRegional3()
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', 3)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap3')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', 3)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();


    //         $jumlahAset3 = $jumlahAset ? $jumlahAset->total_aset_sap3 : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //         ->select('COUNT(*) as jumlah_sap')
    //         ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //         ->where('amanat_sap.unit_id', $unitId)
    //         ->get()
    //         ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;


    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset3,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
                
    //         ];
    //     }

    //     return $unitList;
    // }

    // // Mendapatkan unit sesuai dengan regional 4
    // public function getUnitListRegional4()
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', 4)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap4')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', 4)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();


    //         $jumlahAset4 = $jumlahAset ? $jumlahAset->total_aset_sap4 : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //         ->select('COUNT(*) as jumlah_sap')
    //         ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //         ->where('amanat_sap.unit_id', $unitId)
    //         ->get()
    //         ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;


    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset4,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
                
    //         ];
    //     }

    //     return $unitList;
    // }

    // // Mendapatkan unit sesuai dengan regional 5
    // public function getUnitListRegional5()
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', 5)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap5')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', 5)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();


    //         $jumlahAset5 = $jumlahAset ? $jumlahAset->total_aset_sap5 : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //         ->select('COUNT(*) as jumlah_sap')
    //         ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //         ->where('amanat_sap.unit_id', $unitId)
    //         ->get()
    //         ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;


    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset5,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
                
    //         ];
    //     }

    //     return $unitList;
    // }

    // // Mendapatkan unit sesuai dengan regional 6
    // public function getUnitListRegional6()
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', 6)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap6')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', 6)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();


    //         $jumlahAset6 = $jumlahAset ? $jumlahAset->total_aset_sap6 : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //         ->select('COUNT(*) as jumlah_sap')
    //         ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //         ->where('amanat_sap.unit_id', $unitId)
    //         ->get()
    //         ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;


    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset6,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
                
    //         ];
    //     }

    //     return $unitList;
    // }

    // // Mendapatkan unit sesuai dengan regional 7
    // public function getUnitListRegional7()
    // {
    //     $query = $this->db->table('amanat_unit')
    //         ->select('amanat_unit.unit_id, amanat_unit.unit_desc, amanat_unit.total_aset_sap, amanat_unit.total_aset_teridentifikasi')
    //         ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
    //         ->where('master_region.id_region', 7)
    //         ->get()
    //         ->getResultArray();

    //     $unitList = [];

    //     foreach ($query as $row) {
    //         $unitId = $row['unit_id'];

    //         $jumlahAset = $this->db->table('amanat_sap')
    //             ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap7')
    //             ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
    //             ->where('amanat_unit.id_region', 7)
    //             ->where('amanat_unit.unit_id', $unitId)
    //             ->groupBy('amanat_unit.unit_id')
    //             ->get()
    //             ->getRow();


    //         $jumlahAset7 = $jumlahAset ? $jumlahAset->total_aset_sap7 : 0;

    //         $jumlahNomorSap = $this->db->table('data_aset')
    //         ->select('COUNT(*) as jumlah_sap')
    //         ->join('amanat_sap', 'amanat_sap.nomor_aset = data_aset.nomor_sap', 'left')
    //         ->where('amanat_sap.unit_id', $unitId)
    //         ->get()
    //         ->getRow();

    //         $jumlahNomorSap = $jumlahNomorSap ? $jumlahNomorSap->jumlah_sap : 0;


    //         $unitList[] = [
    //             'unit_id' => $unitId,
    //             'unit_desc' => $row['unit_desc'],
    //             'total_aset_sap' => $jumlahAset7,
    //             'jumlah_nomor_sap' => $jumlahNomorSap
                
    //         ];
    //     }

    //     return $unitList;
    // }



    // public function saveUnitData($unitList)
    // {
    //     // Misalnya, Anda memiliki kolom "total_aset_sap" dan "jumlah_nomor_sap" di tabel "amanat_unit"
    //     // Anda dapat melakukan perulangan untuk menyimpan setiap data ke tabel
    //     foreach ($unitList as $unit) {
    //         $data = [
    //             'total_aset_sap' => $unit['total_aset_sap'],
    //             'total_aset_teridentifikasi' => $unit['jumlah_nomor_sap']
    //         ];
            
    //         // Menyimpan data ke tabel amanat_unit
    //         $this->db->table('amanat_unit')->where('unit_id', $unit['unit_id'])->update($data);
    //     }
    // }



}
