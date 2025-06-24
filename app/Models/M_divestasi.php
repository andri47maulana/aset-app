<?php 
	namespace App\Models;

	use CodeIgniter\Model;

	class M_Divestasi extends Model
	{
	    protected $table = 'divestasi_log_tahapan';
	    protected $primaryKey = 'id_log_tahapan';
	    protected $allowedFields = ['id_divestasi','file_name', 'kategori','tahapan','status','created_at','start_log','target_log','keterangan','approval_status','approval_date','nominal'];


		//tabel divestasi_data
	    protected $dataTable = 'divestasi_data'; 
	    protected $dataAllowedFields = ['id_divestasi', 'objek_divestasi','luas_objek_divestasi','nilai_objek_divestasi','jenis_rkap','lokasi_objek_divestasi','id_maia_masterlists','nilai_buku','nilai_buku_aset','nilai_njop','nilai_kjpp','satuan_aset','tgl_nilai_buku','tgl_njop','tgl_kjpp','jenis_aset','jumlah_aset','metode','start_date','target_date', 'created_at','current_start_log','current_target_log','current_status','unit_id_user','except_tahapan','periode_rkap','estimasi_nilai','estimasi_keterangan','kode_divestasi','keterangan_pembayaran']; 


	    public function insert_divestasi_data2($data)
	    {
	        $db = \Config\Database::connect();
	        $builder = $db->table($this->dataTable);
	        return $builder->insert($data);
	    }


	    public function insert_divestasi_data($data,$log=0)
	    {

	    	// $tempDives = $this->getDivestasi($id_divestasi);
	    	// var_dump($tempDives);

	        $db = \Config\Database::connect();
	        $builder = $db->table($this->dataTable);

	        $post = $data['post'];
	        unset($data['post']);
	        if($log==0){
	        	$updateFields = [
		            'kode_divestasi'     => $data['kode_divestasi'],
		            'objek_divestasi'    => $data['objek_divestasi'],
		            'id_maia_masterlists'=> $data['id_maia_masterlists'],
		            'metode'             => $data['metode'],
		            'start_date'         => $data['start_date'],
		            'target_date'        => $data['target_date'],
		            'nilai_buku'		 => $data['nilai_buku'],
		            //'luas_objek_divestasi' 	=> $data['luas_objek_divestasi'],
		            'nilai_objek_divestasi'	=> $data['nilai_objek_divestasi'],

		            'jenis_aset'		 => $data['jenis_aset'],
		            'jumlah_aset'		 => $data['jumlah_aset'],
		            'satuan_aset' 		 => $data['satuan_aset'],

		            'nilai_buku_aset' 	 => $data['nilai_buku_aset'],
		            'nilai_njop' 		 => $data['nilai_njop'],
		            'nilai_kjpp' 		 => $data['nilai_kjpp'],
		            'estimasi_nilai'	 => $data['estimasi_nilai'],
		            'estimasi_keterangan'  => $data['estimasi_keterangan'],
		            'keterangan_pembayaran'=> $data['keterangan_pembayaran'],

		            'tgl_nilai_buku' 	 => $data['tgl_nilai_buku'],
		            'tgl_njop' 			 => $data['tgl_njop'],
		            'tgl_kjpp' 			 => $data['tgl_kjpp'],
		            //'realisasi_pembayaran'	=> $data['realisasi_pembayaran'],
		            'unit_id_user'		 => $data['unit_id_user'],
		            'jenis_rkap'		 => $data['jenis_rkap'],
		            'periode_rkap'		 => $data['jenis_rkap']." ".date('Y',strtotime($data['start_date'])),

		            'lokasi_objek_divestasi'=> $data['lokasi_objek_divestasi'],
		            'luas_aset' 		=> $data['luas_aset'],
		            'nilai_objek_aset'	=> $data['nilai_objek_aset'],
		            'nilai_buku_aset' 	=> $data['nilai_buku_aset'],
		        ];

	        }else{
	        	$updateFields = [
		        	'current_start_log'  => $data['current_start_log'],
		            'current_target_log' => $data['current_target_log'],
		            'current_status'     => $data['current_status']
	       		];
	        }

	        // Query dengan ON DUPLICATE KEY
	        $sql = $builder->set($data)->getCompiledInsert() . 
	               " ON DUPLICATE KEY UPDATE " . $this->buildUpdateClause($updateFields);

	        $db->query($sql);


	        #LOGS
	        $insertId = $db->insertID();
	        if($log==0){

	       		//LOG DATA DIVESTASI
		        if($insertId!=0){//Jika ada perubahan dan data baru
		        	$logs['title'] 		 ="Update Log Data Divestasi";
		        	$logs['id_divestasi']=$insertId;
		       		$logs['activity']    ="Data Objek Divestasi : ".$data['objek_divestasi'];
		       		$logs['data_']        = json_encode($updateFields);
	        		$this->insert_logs($logs);
		        }
		    }else{
		    	//LOG TAHAPAN DIVESTASI
		    	$logs['title'] 		 ="Update Tahapan";
	        	$logs['id_divestasi']=$insertId;
	       		$logs['activity']    ="Progress : ".$post['tahapan']." [".$post['status']."]";
		       	$logs['data_']        = json_encode($updateFields).'';
	       		$this->insert_logs($logs);

	        }


	        //echo $this->db->getLastQuery()->getQuery();
	        return $insertId;
	    }


	    public function insert_logs($data){
	    	$db = \Config\Database::connect();
	        $builder = $db->table("divestasi_logs");

	    	$logs['date_created']=date('Y-m-d H:i:s');
	    	$logs['id_divestasi']=$data['id_divestasi'];
	    	$logs['title']		 =$data['title'];
	    	$logs['activity']	 =$data['activity'];
	    	$logs['data_']	 	 =$data['data_'];

	    	if (!$builder->insert($logs)) {
		        return 'error: save logs failed: ' . json_encode($builder->getError());
		    }

	    }


	    public function insert_log_action($data)
		{
		    if (!is_array($data) || empty($data)) {
		        return 'error: Invalid or empty data provided.';
		    }

		    $db = \Config\Database::connect();
		    $builder = $db->table('divestasi_log_action');

		    if (!$builder->insert($data)) {
		        log_message('error', 'Insert log action failed: ' . json_encode($builder->getError()));
		        return 'error: Insert log action failed: ' . json_encode($builder->getError());
		    }
		    //echo $this->db->getLastQuery()->getQuery();

		    $id = $db->insertID();

	    	$logs['title'] 		 ="Update Status";
        	$logs['id_divestasi']=$insertId;
       		$logs['activity']    ="Update : ".$post['tahapan']." [".$data['action']."]";

	        $this->insert_logs($logs);

		    return $id;
		}


	    public function update_divestasi($id, $data) {
		    $db = \Config\Database::connect();
		    $builder = $db->table($this->dataTable);

		    $builder->where('id_divestasi', $id);  // Assuming 'id' is your primary key
		    $builder->update($data); 

		    ##LOGS
        	$logs['title']       = "Update Data Divestasi";
        	$logs['id_divestasi']=$id;

        	$update_data="";
        	foreach($data as $k=>$d){
        		$update_data .=$k.":".$d.", ";
        	}

       		$logs['activity']    ="Update Objek Divestasi : ".$update_data;
	        $this->insert_logs($logs);

		}


	    public function getDivestasi($id_divestasi){
	        $model = new M_Divestasi();

	        $db = \Config\Database::connect();
	        $dataTable = $db->table($model->dataTable);
	        $result = $dataTable->where('id_divestasi', $id_divestasi)->get()->getRow();

	        return $result;
	    }


	    public function getDivestasiLog($id_divestasi){
	         $result = $this->db->table('divestasi_log_tahapan as d')
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


	    public function getDivestasiLogs($id_divestasi){
	         $result = $this->db->table('divestasi_logs as d')
		                       ->select('*')  
		                       ->where('id_divestasi',$id_divestasi)
		                       ->orderBy('date_created','desc')
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
		    $query = $this->db->table('v_maia_masterlist as m')
		                      ->select("*, CONCAT(m.deskripsi_aset, ' [', m.nmr_aset, ']') AS label_aset")
		                      ->like('m.deskripsi_aset', $search)
		                      ->orLike('m.nmr_aset', $search)
		                      ->limit(10);

		    // if (session()->get('role_id') != 20) {
		    //     $query->where('m.unit_id', session()->get('unit_id'));
		    // }

		    $result = $query->get(); // Execute query first
		    return $result->getResult(); // Fetch results
		}



		public function getDataAset($id_maia_masterlists=""){
			$db = \Config\Database::connect();
			$fieldOrder = "FIELD(m.nmr_aset, " . implode(',', array_map(fn($val) => $db->escape($val), $id_maia_masterlists)) . ")";

			$result = $db->table('v_maia_masterlist as m') 
		                   ->select(" *, concat(m.deskripsi_aset,' [',m.nmr_aset,']') as label_aset")                  
		                   ->whereIn('nmr_aset', $id_maia_masterlists)
		                   ->orderBy($fieldOrder, '', false)
		                   ->limit(10)
		                   ->get()
		                   ->getResult();   
        //var_dump($this->db->getLastQuery()->getQuery());

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



	    public function save_sap($data)
	    {
	    
	        $db = \Config\Database::connect();
	        $builder = $db->table('maia_masterlist2');
	        $builder->insert($data); 
	    }


	}
 ?>