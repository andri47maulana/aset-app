<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_master_gl extends Model
{

    protected $table = 'amanat_link_gl_regional';

    protected $primaryKey = 'link_gl_regional_id';

    protected $allowedFields = [
        'master_gl_id',
        'id_region',
        'nilai',
    ];

    protected $returnType = 'object';

    public function tes()
    {
        return $builder = $this->select('amanat_link_gl_regional.master_gl_id, amanat_link_gl_regional.id_region, nilai, master_gl_nomer, master_gl_nama, master_region_nama')
            ->join("amanat_master_gl", "amanat_master_gl.master_gl_id = amanat_link_gl_regional.master_gl_id", "left")
            ->join("master_region", "master_region.id_region = amanat_link_gl_regional.id_region", "left")
            ->orderBy('link_gl_regional_id', 'DESC')
            ->where('amanat_link_gl_regional.is_deleted', 0)
            ->get()->getResult();
    }

    public function getAllRegion()
    {
        return $this->db->table('master_region')
            ->select("id_region, master_region_nama")
            ->get()->getResult();
    }

    public function getAllMasterGL()
    {
        return $this->db->table('amanat_master_gl')
            ->select("master_gl_id, master_gl_nomer, master_gl_nama")
            ->where('is_deleted', 0)
            ->get()->getResult();
    }

    public function getMasterGL($nomer = null)
    {

        return $this->db->table('amanat_master_gl')
            ->select("master_gl_id, master_gl_nomer, master_gl_nama")
            ->where("master_gl_nomer", $nomer)
            ->where('is_deleted', 0)
            ->get()->getResult();
    }

    public function insertMasterGL($data)
    {
        $this->db->table('amanat_master_gl')
            ->insert($data);

        return $this->getMasterGL($data['master_gl_nomer']);
    }

    public function getRegion($reg_name = null)
    {
        return $this->db->table('master_region')
            ->select("id_region, master_region_nama")
            ->groupStart()
            ->like("master_region_nama", $reg_name)
            ->groupEnd()
            ->get()->getResult();
    }

    public function insertGl($master_gl_id, $id_region, $nilai)
    {
        return $this->db->table('amanat_link_gl_regional')
            ->insert(
                [
                    'master_gl_id' => $master_gl_id,
                    'id_region' => $id_region,
                    'nilai' => $nilai,
                ]
            );
    }

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('link_gl_regional_id, amanat_link_gl_regional.master_gl_id, amanat_link_gl_regional.id_region, nilai, master_gl_nomer, master_gl_nama, master_region_nama')
            ->join("amanat_master_gl", "amanat_master_gl.master_gl_id = amanat_link_gl_regional.master_gl_id", "left")
            ->join("master_region", "master_region.id_region = amanat_link_gl_regional.id_region", "left")
            ->orderBy('link_gl_regional_id', 'DESC')
            ->where('amanat_link_gl_regional.is_deleted', 0);

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('master_gl_nomer', $katakunci)
                ->orLike('master_gl_nama', $katakunci) // Ganti 'like' menjadi 'orLike'
                ->orLike('master_region_nama', $katakunci)
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
        $data = $builder->get()->getResult(); // Ganti 'getResultArray' menjadi 'getResult'

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data,
        ];
    }

    public function getLinkGLRegByID($id)
    {
        return $this
            ->select("link_gl_regional_id, amanat_link_gl_regional.master_gl_id, amanat_link_gl_regional.id_region, nilai,")
            ->where("link_gl_regional_id", $id)
            ->where('is_deleted', 0)
            ->get()->getResult();
    }

    public function deleteGl($id)
    {
        return $this->db->table('amanat_link_gl_regional')
            ->where('link_gl_regional_id', $id)
            ->update(['is_deleted' => 1]);
    }

    public function editGl($id)
    {
        return $this->select('a.link_gl_regional_id, a.master_gl_id, a.id_region, a.nilai, b.master_gl_nomer, b.master_gl_nama, c.master_region_nama')
            ->from('amanat_link_gl_regional a')
            ->join('amanat_master_gl b', 'b.master_gl_id = a.master_gl_id', 'left')
            ->join('master_region c', 'c.id_region = a.id_region', 'left')
            ->where('a.link_gl_regional_id', $id)
            ->get()
            ->getRow();
    }

    public function getupdateGl($id, $data, $masterGl)
    {
        return $this->where('link_gl_regional_id', $id)->set(
            [
                'master_gl_id' => $masterGl,
                'id_region' => $data["id_region"],
                'nilai' => $data["nilai"],
            ],
        )->update();
    }

}
