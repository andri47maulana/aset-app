<?php 
namespace App\Models\aset;
use CodeIgniter\Model;
 
class M_sub_unit extends Model
{
     
    protected $table = 'sub_unit';

    protected $primaryKey = 'sub_unit_id';

    protected $allowedFields = ['sub_unit_desc'];

    protected $returnType = 'object';

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('*')
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('sub_unit_desc', $katakunci)
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
        $data = $builder->orderBy('sub_unit_id', 'DESC')
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


    public function deleteSunitData($id)
    {
        return $this->db->table('sub_unit')->where('sub_unit_id', $id)->delete();
    }

    public function editSunitData($id)
    {
        return $this->select('*')
            ->where('sub_unit_id', $id)
            ->get()
            ->getRow();
    }


    public function getupdate($id, $data)
    {
        return $this->where('sub_unit_id', $id)->set($data)->update();
    }
    
 
}