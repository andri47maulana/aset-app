<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_master_user extends Model
{

    protected $table = 'amanat_users';

    protected $primaryKey = 'user_id';

    protected $allowedFields = [
        'user_id', 'username', 'user_fullname', 'user_nip', 'user_email', 'user_jabatan', 'hak_akses_id', 'unit_id', 'sub_unit_id', 'afdeling_id', 'user_pass', 'hak_akses_desc', 'unit_desc', 'sub_unit_desc', 'afdeling_desc'
    ];

    protected $returnType = 'object';

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('amanat_users.user_id, amanat_users.username, amanat_users.user_fullname, 
        amanat_users.user_nip, amanat_users.user_email, amanat_users.user_jabatan, amanat_users.hak_akses_id, 
        amanat_users.unit_id, amanat_users.sub_unit_id, amanat_users.afdeling_id, amanat_users.user_pass, 
        hak_akses.hak_akses_desc, amanat_unit.unit_desc, sub_unit.sub_unit_desc, afdeling.afdeling_desc')
        ->join('hak_akses', 'hak_akses.hak_akses_id = amanat_users.hak_akses_id', 'left')
        ->join('amanat_unit', 'amanat_unit.unit_id = amanat_users.unit_id','left')
        ->join('sub_unit', 'sub_unit.sub_unit_id = amanat_users.sub_unit_id','left')
        ->join('afdeling', 'afdeling.afdeling_id = amanat_users.afdeling_id','left')
        ->distinct();


        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('username', $katakunci)
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
        $data = $builder->orderBy('user_id', 'DESC')
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

    public function getHakAksesData()
    {
        return $this->db->table('hak_akses')->get()->getResultArray();
    }

    public function getUnitData()
    {
        return $this->db->table('amanat_unit')->get()->getResultArray();
    }

    public function getSunitData()
    {
        return $this->db->table('sub_unit')->get()->getResultArray();
    }

    public function getAfdelingData()
    {
        return $this->db->table('afdeling')->get()->getResultArray();
    }


    public function deleteUserData($id)
    {
        return $this->db->table('amanat_users')->where('user_id', $id)->delete();
    }

    public function editUserData($id)
    {
        return $this->select('*')
            ->where('user_id', $id)
            ->get()
            ->getRow();
    }

    public function getupdate($id, $data)
    {
        return $this->where('user_id', $id)->set($data)->update();
    }

}

?>