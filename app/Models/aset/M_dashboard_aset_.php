<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_dashboard_aset extends Model
{
    protected $table = 'amanat_unit';
    protected $allowedFields = 'unit_id, unit_desc, id_region, id_region, master_region_nama';

    //Jumlah Unit

    public function getJumlahUnitRegional1(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit1')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 1)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit1 = $result->jumlah_unit1;
        } else {
            $jumlah_unit1 = 0;
        }

        return ['jumlah_unit1' => $jumlah_unit1];
    }
    
    public function getJumlahUnitRegional2(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit2')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 2)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit2 = $result->jumlah_unit2;
        } else {
            $jumlah_unit2 = 0;
        }

        return ['jumlah_unit2' => $jumlah_unit2];
    }
    
    public function getJumlahUnitRegional3(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit3')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 3)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit3 = $result->jumlah_unit3;
        } else {
            $jumlah_unit3 = 0;
        }

        return ['jumlah_unit3' => $jumlah_unit3];
    }
    
    public function getJumlahUnitRegional4(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit4')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 4)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit4 = $result->jumlah_unit4;
        } else {
            $jumlah_unit4 = 0;
        }

        return ['jumlah_unit4' => $jumlah_unit4];
    }
    
    public function getJumlahUnitRegional5(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit5')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 5)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit5 = $result->jumlah_unit5;
        } else {
            $jumlah_unit5 = 0;
        }

        return ['jumlah_unit5' => $jumlah_unit5];
    }

    public function getJumlahUnitRegional6(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit6')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 6)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit6 = $result->jumlah_unit6;
        } else {
            $jumlah_unit6 = 0;
        }

        return ['jumlah_unit6' => $jumlah_unit6];
    }

    public function getJumlahUnitRegional7(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit7')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 7)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit7 = $result->jumlah_unit7;
        } else {
            $jumlah_unit7 = 0;
        }

        return ['jumlah_unit7' => $jumlah_unit7];
    }

    public function getJumlahUnitRegional8(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit8')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 8)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit8 = $result->jumlah_unit8;
        } else {
            $jumlah_unit8 = 0;
        }

        return ['jumlah_unit8' => $jumlah_unit8];
    }

    public function getJumlahUnitRegional9(){
        $query = $this->db->table('amanat_unit')
        ->select('master_region.id_region, COUNT(amanat_unit.unit_id) AS jumlah_unit9')
        ->join('master_region', 'master_region.id_region = amanat_unit.id_region', 'left')
        ->where('master_region.id_region', 9)
        ->groupBy('master_region.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $jumlah_unit9 = $result->jumlah_unit9;
        } else {
            $jumlah_unit9 = 0;
        }

        return ['jumlah_unit9' => $jumlah_unit9];
    }


    //Jumlah Aset

    public function getJumlahAsetRegional1(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap1')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 1)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap1 = $result->total_aset_sap1;
        } else {
            $total_aset_sap1 = 0;
        }

        return ['total_aset_sap1' => $total_aset_sap1];
    }

    public function getJumlahAsetRegional2(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap2')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 2)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap2 = $result->total_aset_sap2;
        } else {
            $total_aset_sap2 = 0;
        }

        return ['total_aset_sap2' => $total_aset_sap2];
    }

    public function getJumlahAsetRegional3(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap3')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 3)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap3 = $result->total_aset_sap3;
        } else {
            $total_aset_sap3 = 0;
        }

        return ['total_aset_sap3' => $total_aset_sap3];
    }

    public function getJumlahAsetRegional4(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap4')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 4)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap4 = $result->total_aset_sap4;
        } else {
            $total_aset_sap4 = 0;
        }

        return ['total_aset_sap4' => $total_aset_sap4];
    }

    public function getJumlahAsetRegional5(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap5')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 5)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap5 = $result->total_aset_sap5;
        } else {
            $total_aset_sap5 = 0;
        }

        return ['total_aset_sap5' => $total_aset_sap5];
    }

    public function getJumlahAsetRegional6(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap6')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 6)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap6 = $result->total_aset_sap6;
        } else {
            $total_aset_sap6 = 0;
        }

        return ['total_aset_sap6' => $total_aset_sap6];
    }

    public function getJumlahAsetRegional7(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap7')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 7)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap7 = $result->total_aset_sap7;
        } else {
            $total_aset_sap7 = 0;
        }

        return ['total_aset_sap7' => $total_aset_sap7];
    }

    public function getJumlahAsetRegional8(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap8')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 8)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap8 = $result->total_aset_sap8;
        } else {
            $total_aset_sap8 = 0;
        }

        return ['total_aset_sap8' => $total_aset_sap8];
    }

    public function getJumlahAsetRegional9(){
        $query = $this->db->table('amanat_sap')
        ->select('amanat_unit.unit_id, COUNT(amanat_sap.unit_id) AS total_aset_sap9')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
        ->where('amanat_unit.id_region', 9)
        ->groupBy('amanat_unit.id_region')
        ->get();

        $result = $query->getRow();

        if ($result) {
            $total_aset_sap9 = $result->total_aset_sap9;
        } else {
            $total_aset_sap9 = 0;
        }

        return ['total_aset_sap9' => $total_aset_sap9];
    }

    //Presentase Aset

    public function getPresentaseAsetRegional1()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap1')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 1)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset1 = 0;

        if ($totalAset > 0) {
            $presentaseAset1 = ($query->total_aset_sap1 / $totalAset) * 100;
        }

        return $presentaseAset1;
    }

    public function getPresentaseAsetRegional2()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap2')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 2)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset2 = 0;

        if ($totalAset > 0) {
            $presentaseAset2 = ($query->total_aset_sap2 / $totalAset) * 100;
        }

        return $presentaseAset2;
    }

    public function getPresentaseAsetRegional3()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap3')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 3)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset3 = 0;

        if ($totalAset > 0) {
            $presentaseAset3 = ($query->total_aset_sap3 / $totalAset) * 100;
        }

        return $presentaseAset3;
    }

    public function getPresentaseAsetRegional4()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap4')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 4)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset4 = 0;

        if ($totalAset > 0) {
            $presentaseAset4 = ($query->total_aset_sap4 / $totalAset) * 100;
        }

        return $presentaseAset4;
    }

    public function getPresentaseAsetRegional5()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap5')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 5)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset5 = 0;

        if ($totalAset > 0) {
            $presentaseAset5 = ($query->total_aset_sap5 / $totalAset) * 100;
        }

        return $presentaseAset5;
    }

    public function getPresentaseAsetRegional6()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap6')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 6)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset6 = 0;

        if ($totalAset > 0) {
            $presentaseAset6 = ($query->total_aset_sap6 / $totalAset) * 100;
        }

        return $presentaseAset6;
    }

    public function getPresentaseAsetRegional7()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap7')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 7)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset7 = 0;

        if ($totalAset > 0) {
            $presentaseAset7 = ($query->total_aset_sap7 / $totalAset) * 100;
        }

        return $presentaseAset7;
    }
    
    public function getPresentaseAsetRegional8()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap8')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 8)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset8 = 0;

        if ($totalAset > 0) {
            $presentaseAset8 = ($query->total_aset_sap8 / $totalAset) * 100;
        }

        return $presentaseAset8;
    }

    public function getPresentaseAsetRegional9()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as total_aset_sap9')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id', 'left')
            ->where('amanat_unit.id_region', 9)
            ->get()
            ->getRow();

        $totalAset = $this->db->table('amanat_sap')
            ->countAll();

        $presentaseAset9 = 0;

        if ($totalAset > 0) {
            $presentaseAset9 = ($query->total_aset_sap9 / $totalAset) * 100;
        }

        return $presentaseAset9;
    }

    public function getJumlahAsetTeridentifikasiRegional1()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi1')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 1)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi1 = $result->jumlahTeridentifikasi1;
        } else {
            $jumlahTeridentifikasi1 = 0;
        }

        return ['jumlahTeridentifikasi1' => $jumlahTeridentifikasi1];
    }
    
    public function getJumlahAsetTeridentifikasiRegional2()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi2')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 2)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi2 = $result->jumlahTeridentifikasi2;
        } else {
            $jumlahTeridentifikasi2 = 0;
        }

        return ['jumlahTeridentifikasi2' => $jumlahTeridentifikasi2];
    }

    public function getJumlahAsetTeridentifikasiRegional3()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi3')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 3)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi3 = $result->jumlahTeridentifikasi3;
        } else {
            $jumlahTeridentifikasi3 = 0;
        }

        return ['jumlahTeridentifikasi3' => $jumlahTeridentifikasi3];
    }

    public function getJumlahAsetTeridentifikasiRegional4()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi4')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 4)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi4 = $result->jumlahTeridentifikasi4;
        } else {
            $jumlahTeridentifikasi4 = 0;
        }

        return ['jumlahTeridentifikasi4' => $jumlahTeridentifikasi4];
    }

    public function getJumlahAsetTeridentifikasiRegional5()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi5')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 5)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi5 = $result->jumlahTeridentifikasi5;
        } else {
            $jumlahTeridentifikasi5 = 0;
        }

        return ['jumlahTeridentifikasi5' => $jumlahTeridentifikasi5];
    }

    public function getJumlahAsetTeridentifikasiRegional6()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi6')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 6)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi6 = $result->jumlahTeridentifikasi6;
        } else {
            $jumlahTeridentifikasi6 = 0;
        }

        return ['jumlahTeridentifikasi6' => $jumlahTeridentifikasi6];
    }

    public function getJumlahAsetTeridentifikasiRegional7()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi7')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 7)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi7 = $result->jumlahTeridentifikasi7;
        } else {
            $jumlahTeridentifikasi7 = 0;
        }

        return ['jumlahTeridentifikasi7' => $jumlahTeridentifikasi7];
    }

    public function getJumlahAsetTeridentifikasiRegional8()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi8')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 8)
            ->get();

        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi8 = $result->jumlahTeridentifikasi8;
        } else {
            $jumlahTeridentifikasi8 = 0;
        }

        return ['jumlahTeridentifikasi8' => $jumlahTeridentifikasi8];
    }

    public function getJumlahAsetTeridentifikasiRegional9()
    {
        $query = $this->db->table('amanat_sap')
            ->select('COUNT(*) as jumlahTeridentifikasi9')
            ->join('data_aset', 'data_aset.nomor_sap = amanat_sap.nomor_aset')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_sap.unit_id')
            ->where('amanat_unit.id_region', 9)
            ->get();
        
         $result = $query->getRow();

        if ($result) {
            $jumlahTeridentifikasi9 = $result->jumlahTeridentifikasi9;
        } else {
            $jumlahTeridentifikasi9 = 0;
        }

        return ['jumlahTeridentifikasi9' => $jumlahTeridentifikasi9];
    }
}