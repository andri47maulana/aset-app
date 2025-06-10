<?php 
	namespace App\Models;

	use CodeIgniter\Model;

	class M_Divestasi extends Model
	{
	    protected $table = 'divestasi_log';
	    protected $primaryKey = 'id_log_divestasi';
	    protected $allowedFields = ['id_divestasi','file_name', 'kategori','tahapan','status','created_at','start_log','target_log','keterangan','approval_status','approval_date'];


		//tabel divestasi_data
	    protected $dataTable = 'divestasi_data'; 
	    protected $dataAllowedFields = ['id_divestasi', 'objek_divestasi','luas_objek_divestasi','nilai_objek_divestasi','jenis_rkap','lokasi_objek_divestasi','id_maia_masterlists', 'nilai_buku_aset','nilai_objek_aset','luas_aset','metode','start_date','target_date', 'created_at','current_start_log','current_target_log','current_status','unit_id_user','except_tahapan']; 


	    public function insert_divestasi_data2($data)
	    {
	        $db = \Config\Database::connect();
	        $builder = $db->table($this->dataTable);
	        return $builder->insert($data);
	    }


	    public function insert_divestasi_data($data,$log=0)
	    {
	        $db = \Config\Database::connect();
	        $builder = $db->table($this->dataTable);


	        if($log==0){
	        	$updateFields = [
		            'objek_divestasi'    => $data['objek_divestasi'],
		            'id_maia_masterlists'=> $data['id_maia_masterlists'],
		            'metode'             => $data['metode'],
		            'start_date'         => $data['start_date'],
		            'target_date'        => $data['target_date'],
		            'luas_objek_divestasi' 	=> $data['luas_objek_divestasi'],
		            'nilai_objek_divestasi'	=> $data['nilai_objek_divestasi'],
		            'nilai_buku' 			=> $data['nilai_buku'],
		            'realisasi_pembayaran'	=> $data['realisasi_pembayaran'],
		            'unit_id_user'=> $data['unit_id_user'],
		            'jenis_rkap'=> $data['jenis_rkap'],
		            'lokasi_objek_divestasi'=> $data['lokasi_objek_divestasi'],

		            'luas_aset' 		=> $data['luas_aset'],
		            'nilai_objek_aset'	=> $data['nilai_objek_aset'],
		            'nilai_buku_aset' 	=> $data['nilai_buku_aset'],
		        ];
	        }else{
	        	$updateFields = [
		        	'current_start_log' 	=> $data['current_start_log'],
		            'current_target_log'	=> $data['current_target_log'],
		            'current_status'     	=> $data['current_status']
	       		];
	        }

	        // Query dengan ON DUPLICATE KEY
	        $sql = $builder->set($data)->getCompiledInsert() . 
	               " ON DUPLICATE KEY UPDATE " . $this->buildUpdateClause($updateFields);

	        $db->query($sql);

	        //echo $this->db->getLastQuery()->getQuery();
	        return $db->insertID();
	    }


	    public function update_divestasi($id, $data) {
		    $db = \Config\Database::connect();
		    $builder = $db->table($this->dataTable);

		    // Correct update syntax: Pass data first, then WHERE condition
		    $builder->where('id_divestasi', $id);  // Assuming 'id' is your primary key
		    return $builder->update($data); 

		}


	    public function getDivestasi($id_divestasi){
	        $model = new M_Divestasi();

	        $db = \Config\Database::connect();
	        $dataTable = $db->table($model->dataTable);
	        $result = $dataTable->where('id_divestasi', $id_divestasi)->get()->getRow();

	        return $result;
	    }


	    public function getDivestasiLog($id_divestasi){
	         $result = $this->db->table('divestasi_log as d')
		                       ->select('*')  
		                       ->where('id_divestasi',$id_divestasi)
		                        ->groupStart()
							        ->where('approval_status !=', 'delete')
							        ->orWhere('approval_status', null)
							    ->groupEnd()
		                       ->orderBy('created_at')
		                       //->getCompiledSelect()
		                       ->get()
		                       ->getResultArray();
		    //echo $this->db->getLastQuery()->getQuery();
	        return $result;
	    }



	    public function getTahapan($metode) {
		    $result = $this->db->table('divestasi_dokumen as d')
		                       ->select('*')  
		                       ->join('divestasi_master_tahapan as m', 'd.id_tahapan_divestasi = m.id_tahapan_divestasi')
		                       ->where('metode',$metode)
		                       ->get()
		                       ->getResult();


		    foreach($result as $r){
		    	$data['tahapan'][$r->id_tahapan_divestasi]=$r->tahapan_divestasi;
		    	$data['dokumen'][$r->id_tahapan_divestasi][]=$r->nama_dokumen_divestasi;
		    	$data['optional'][$r->id_tahapan_divestasi][$r->nama_dokumen_divestasi]=$r->optional;
		    	$data['group_tahapan'][$r->id_tahapan_divestasi]=$r->group_tahapan;
		    }

		    //$data['sql']=$this->db->getLastQuery()->getQuery();
		    $data['dokumen_length']=count($result);


		    return $data; 
		}


		public function searchAset($search = "") {
			//var_dump(session()->get('unit_id'));
		    $query = $this->db->table('maia_masterlist as m')
		                      ->select("*, CONCAT(m.deskripsi_aset, ' [', m.nomor_aset, ']') AS label_aset")
		                      ->like('m.deskripsi_aset', $search)
		                      ->limit(10);

		    if (session()->get('role_id') != 20) {
		        $query->where('m.unit_id', session()->get('unit_id'));
		    }

		    $result = $query->get(); // Execute query first
		    return $result->getResult(); // Fetch results
		}



		public function getDataAset($id_maia_masterlists=""){
			$result = $this->db->table('maia_masterlist as m') 
		                   ->select(" *, concat(m.deskripsi_aset,' [',m.nomor_aset,']') as label_aset")                  
		                   ->whereIn('id', $id_maia_masterlists)
		                   ->limit(10)
		                   ->get()
		                   ->getResult();   

		    return $result;
		}

	    private function buildUpdateClause($fields)
	    {
	        $clauses = [];
	        foreach ($fields as $key => $value) {
	            $clauses[] = "$key = " . $this->db->escape($value);
	        }
	        return implode(', ', $clauses);
	    }



	}
 ?>