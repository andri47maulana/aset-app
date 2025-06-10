<?php 
namespace App\Models\aset;
use CodeIgniter\Model;
 
class M_afdeling extends Model
{
     
    protected $table = 'afdeling';

    protected $primaryKey = 'afdeling_id';

    protected $allowedFields = ['afdeling_desc', 'unit_id', 'unit_desc'];

    protected $returnType = 'object';

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('afdeling.afdeling_id,afdeling.afdeling_desc, afdeling.unit_id, amanat_unit.unit_desc' )
            ->join('amanat_unit', 'amanat_unit.unit_id = afdeling.unit_id', 'left')
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('afdeling_desc', $katakunci)
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
        $data = $builder->orderBy('afdeling_id', 'DESC')
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

    public function getUnitData()
    {
        return $this->db->table('amanat_unit')->get()->getResultArray();
    }

    public function deleteAfdelingData($id)
    {
        return $this->db->table('afdeling')->where('afdeling_id', $id)->delete();
    }

    public function editAfdelingData($id)
    {
        return $this->select('*')
            ->where('afdeling_id', $id)
            ->get()
            ->getRow();
    }


    public function getupdate($id, $data)
    {
        return $this->where('afdeling_id', $id)->set($data)->update();
    }
    
 
}