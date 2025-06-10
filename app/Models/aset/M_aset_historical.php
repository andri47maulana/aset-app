<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_aset_historical extends Model
{
    protected $table = 'amanat_historical';
    protected $primaryKey = 'histori_id';
    protected $allowedFields = ['histori_sap','histori_nama','histori_file','histori_deskripsi','histori_user','histori_publish','histori_unit'];

    public function tampilData($katakunci = null, $start = 0, $length = 10, $sapDesc = null)
    {
        $builder = $this->select('histori_id, histori_sap, histori_user,unit_desc, histori_nama, histori_deskripsi, histori_file, histori_unit, username,histori_publish,sub_unit_id')
            ->join('amanat_users', 'amanat_users.user_id = amanat_historical.histori_user', 'left')
            ->join('amanat_unit', 'amanat_unit.unit_id = amanat_historical.histori_unit', 'left')
            ->orderBy('histori_id', 'desc')
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->like('histori_sap', $katakunci)
                ->orLike('histori_nama', $katakunci)
                ->orLike('username', $katakunci)
                ->orLike('histori_deskripsi', $katakunci);
        }
        $hak_akses = session()->get("hak_akses_id");
        $unit_id = session()->get("unit_id");
        $sub_unit_id = session()->get("sub_unit_id");

        // Apply filter by sap_desc if provided
        if (!empty($sapDesc)) {
            $builder->where('histori_sap', $sapDesc);
        }
        // Check if userHakId is 10 and histori_publish is 1
        if ( $hak_akses == 11 ||$hak_akses == 10) {
            $builder->where('histori_publish', 1);
        }else{
            if ($unit_id) {
                if ($sub_unit_id == 1) {
                    $builder->where('amanat_users.sub_unit_id', $sub_unit_id);
                } elseif ($sub_unit_id == 2) {
                    $builder->where('amanat_users.sub_unit_id', $sub_unit_id);
                } elseif ($sub_unit_id == 3) {
                    $builder->where('amanat_users.sub_unit_id', $sub_unit_id);
                }
            }
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
        $data = $builder->get()->getResult();

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data
        ];
    }


    public function getIdMasterlist($id){
        return $this->select('maia_masterlist.id')
        ->join('maia_masterlist', 'maia_masterlist.nomor_aset = amanat_historical.histori_sap', 'left')
        ->where('histori_id', $id)
        ->get()
        ->getRow();
    }

    public function deleteAmanatHistori($id)
    {
        // Delete the historical data based on histori_id
        return $this->where('histori_id', $id)->delete();
    }

    public function editHistorical($id)
    {
        return $this->select('histori_id, histori_sap, histori_nama, histori_file, histori_deskripsi, histori_user, histori_unit')
        ->where('histori_id', $id)
        ->get()
        ->getRow();
    }

    public function updatehistorical($id, $data)
    {
        return $this->where('histori_id', $id)->set($data)->update();
    }
}
