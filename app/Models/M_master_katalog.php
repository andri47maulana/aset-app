<?php

namespace App\Models;

use CodeIgniter\Model;

class M_master_katalog extends Model
{
    protected $table = 'beranda_katalog';
    protected $primaryKey = 'beranda_katalog_id';
    protected $allowedFields =
        [
        'master_aset_id',
        'beranda_katalog_tanggal_posting',
        'beranda_katalog_tanggal_awal_minat',
        'beranda_katalog_tanggal_akhir_minat',
    ];
    protected $returnType = 'object';

    public function getAllBeranda($limit = null)
    {
        $user_id = session()->get('user_id');
        $role_id = session()->get('role_id');
        $region_id = session()->get('region_id');

        if ($role_id == 9) {
            $builder = $this->db->table('beranda_katalog');
            $builder->join('master_aset', 'master_aset.master_aset_id = beranda_katalog.master_aset_id', 'left');
            $builder->join('master_region', 'master_region.id_region = master_aset.master_region_id', 'left');
            $builder->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id', 'left');
            if ($limit) {
                $builder->limit($limit);
            }
            $query = $builder->get();
            return $query->getResult();
        } else if ($role_id == 10) {
            $builder = $this->db->table('beranda_katalog');
            $builder->join('master_aset', 'master_aset.master_aset_id = beranda_katalog.master_aset_id', 'left');
            $builder->join('master_region', 'master_region.id_region = master_aset.master_region_id', 'left');
            $builder->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id', 'left');
            if ($limit) {
                $builder->limit($limit);
            }
            $builder->where('master_aset.master_region_id', $region_id);
            $query = $builder->get();
            return $query->getResult();
        } else {
            $builder = $this->db->table('beranda_katalog');
            $builder->join('master_aset', 'master_aset.master_aset_id = beranda_katalog.master_aset_id');
            $builder->join('aset_potensial', 'aset_potensial.aset_potensial_aset_id = master_aset.master_aset_id');
            $builder->join('master_region', 'master_region.id_region = master_aset.master_region_id');
            $builder->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id');
            if ($limit) {
                $builder->limit($limit);
            }
            $query = $builder->get();
            return $query->getResult();
        }

    }

    public function getAllBerandaWithoutLogin($limit) {
        $builder = $this->db->table('beranda_katalog');
        $builder->join('master_aset', 'master_aset.master_aset_id = beranda_katalog.master_aset_id');
        $builder->join('aset_potensial', 'aset_potensial.aset_potensial_aset_id = master_aset.master_aset_id');
        $builder->join('master_region', 'master_region.id_region = master_aset.master_region_id');
        $builder->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id');

        $builder->join('paket_kerjasama', 'paket_kerjasama.paket_kerjasama_aset_id = master_aset.master_aset_id','left');
        $builder->select('master_aset.*, aset_potensial_aset_id,GROUP_CONCAT(`aset_potensial`.aset_potensial_status SEPARATOR ".") as aset_potensial_status, master_region.*, master_jenis_aset.*,COUNT(IF(paket_kerjasama.paket_kerjasama_nama IS NOT NULL AND paket_kerjasama.paket_kerjasama_nama != "", 1, NULL)) as pk,GROUP_CONCAT(paket_kerjasama.paket_kerjasama_nama SEPARATOR "##") as paket_kerjasama_nama');
        $builder->groupBy('beranda_katalog.master_aset_id');

        if ($limit) {
            $builder->limit($limit);
        }
        $query = $builder->get();
        $result = $query->getResult();

        //var_dump($this->db->getLastQuery()->getQuery());   
        //var_dump($result);
        return $result;
    }



    public function getPaketKerjasamaInList($master_aset_id_list){
        $builder = $this->db->table('paket_kerjasama');
        $builder->join('master_aset','master_aset_id = paket_kerjasama_aset_id');
        $builder->whereIn('master_aset_id', $master_aset_id_list);
        $query = $builder->get();

        return $query->getResult();
    }

    public function getAllKatalog()
    {
        $builder = $this->db->table('master_aset');
        $builder->join('master_region', 'master_region.id_region = master_aset.master_region_id');
        $builder->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id');
        $query = $builder->get();
        return $query->getResult();
    }

    public function deleteByMasterAsetIdKatalog($asetId)
    {
        return $this->where('master_aset_id', $asetId)->delete();
    }
}
