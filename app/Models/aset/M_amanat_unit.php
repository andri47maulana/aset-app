<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_amanat_unit extends Model
{
    protected $table = 'amanat_unit';
    protected $primaryKey = 'unit_id';
    protected $allowedFields = ['unit_id', 'unit_desc', 'id_region', 'total_aset_sap', 'total_aset_teridentifikasi', 'presentase_aset'];
    
    // Fungsi untuk mengambil jumlah data berdasarkan unit_id
    public function getData($unitId)
    {
        return $this->where('unit_id', $unitId)->first(); // Menggunakan first() untuk mendapatkan satu baris data
    }

    // Fungsi untuk menyimpan atau mengupdate jumlah data berdasarkan unit_id
    public function saveDataCount($unitId, $dataCount)
    {
        $existingData = $this->getData($unitId);

        if ($existingData) {
            // Jika data dengan unit_id sudah ada, lakukan update
            $this->update(['unit_id' => $existingData['unit_id']], ['total_aset_sap' => $existingData['total_aset_sap'] + $dataCount]);
        } else {
            // Jika data dengan unit_id belum ada, lakukan insert baru
            $this->insert(['unit_id' => $unitId, 'total_aset_sap' => $dataCount]);
        }
    }          

}