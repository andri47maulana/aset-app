<?php

namespace App\Controllers;

use App\Models\aset\M_aset_historical;
use App\Models\aset\M_aset_kml;
use App\Models\aset\M_aset_manajemen;
use App\Models\aset\M_aset_masterlist;
use App\Models\aset\M_koordinat_aset;
use App\Models\aset\M_master_unit;
use App\Models\M_amanat_masterlist;
use App\Models\M_maia_kml;
use App\Models\M_maia_masterlist;
use App\Models\M_divestasi;

error_reporting(~E_ALL & ~E_NOTICE);

class C_divestasi extends BaseController
{

    // public function __construct(){
    //     var_dump(session()->get('perusahaan_kode'));
    //     //if(!isset($_GET['region']))$_GET['region']='';

    // }


    public function index()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('C_login'));
        }


        if(!isset($_GET['lokasi']) || $_GET['lokasi']!='RK01' ){
            if (session()->get('username') == 'user1_divestasi'){
                //return redirect()->to(base_url('C_divestasi?lokasi=RK01'));
            }            
        }

        if(!isset($_GET['lokasi']) || $_GET['lokasi']!='RK02' ){
            if (session()->get('username') == 'user2_divestasi'){
                //return redirect()->to(base_url('C_divestasi?lokasi=RK02'));
            }            
        }
        
        $asetModel = new M_aset_manajemen();

        $asetModel->updateJumlahAset();
        // $data['unitData'] = $asetModel->getUnitData();
        // $data['perusahaan'] = $asetModel->getPerusahaanSession();
        // $data['asetclass'] = $asetModel->getAsetClass();
        // $data['asetgroup'] = $asetModel->getAsetGroup();
        $data['region'] = $asetModel->getRegionSession();
        $data['id_region'] = session()->get('id_region');
        $data['dash_progress'] = $this->countByGroupTahapan();
        $data['progress_divestasi'] = $this->progressAll();

        if ($data['id_region'] == 99) {
            $data['id_region'] = 0;
        }


        return view('divestasi/v_divestasi', $data);
    }

     public function dashboard()
    {
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('C_login'));
        }
        $asetModel = new M_aset_manajemen();

        $asetModel->updateJumlahAset();
        $data['unitData'] = $asetModel->getUnitData();
        $data['perusahaan'] = $asetModel->getPerusahaanSession();
        $data['region'] = $asetModel->getRegionSession();
        $data['asetclass'] = $asetModel->getAsetClass();
        $data['asetgroup'] = $asetModel->getAsetGroup();
        $data['id_region'] = session()->get('id_region');

        if ($data['id_region'] == 99) {
            $data['id_region'] = 0;
        }


        return view('divestasi/v_divestasi_dashboard', $data);
    }

    public function masterList(){
        header('Content-Type: application/json');
        try {
            // Pagination settings
            $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $lokasi      = isset($_GET['filter_lokasi']) ? $_GET['filter_lokasi'] : '';
            $perPage = 100; // Number of records per page
            $offset = ($currentPage - 1) * $perPage;


            if(session()->get('unit_id')==0){
                $query = $this->db->table('divestasi_data')
                                ->select('*')
                                ->where('objek_divestasi !=',"")
                                ->like('lokasi_objek_divestasi',$lokasi)
                                ->join('master_region','master_region.master_region_kode=divestasi_data.lokasi_objek_divestasi','left');

                $totalRecords = $this->db->table('divestasi_data')
                                ->select('*')
                                ->like('lokasi_objek_divestasi ',$lokasi)
                                ->where('objek_divestasi !=',"")->countAllResults();
            }else{

                $query = $this->db->table('divestasi_data')
                                 ->select('*')
                                 ->where('objek_divestasi !=',"")
                                 ->like('lokasi_objek_divestasi',$lokasi)
                                 ->join('master_region','master_region.master_region_kode=divestasi_data.lokasi_objek_divestasi','left')
                                 ->orderBy('current_target_log','asc');

                $query2 = $this->db->table('divestasi_data')
                                 ->select('*')
                                 ->where('objek_divestasi !=',"")
                                 ->like('lokasi_objek_divestasi',$lokasi)
                                 ->orderBy('current_target_log','asc');
                $totalRecords = $query2->countAllResults();
            }


            $builder = $query->limit($perPage, $offset);

            $data = $builder->get()->getResultArray();

            $progress = $this->countProgressAll();
            $all_tahapan= $this->countTahapan();

            // var_dump($progress);
            
            // var_dump($totalRecords);
            $lastPage = ceil($totalRecords / $perPage);

            // Generate next page URL
            $nextPageUrl = $currentPage < $lastPage
                ? base_url()."masterList?page=" . ($currentPage + 1)
                : null;

            // Response structure
            $response = [
                'status' => 'success',
                'message' => 'Data successfully retrieved!',
                // 'region' => $_GET['region'],
                'current_page' => $currentPage,
                'next_page_url' => $nextPageUrl,
                'last_page' => $lastPage,
                'data' => $data,
                'progress'=>$progress,
                'all_tahapan'=>$all_tahapan,
                'totalRecords'=>$totalRecords
            ];
            echo json_encode($response);

        } catch (Exception $e) {
            // Handle error
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }


    public function filter_data(){
        if($_GET['searchTerm']==''){
            $this->masterList();
        }else{

            try {
                // Pagination settings
                $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $lokasi      = isset($_GET['filter_lokasi']) ? $_GET['filter_lokasi'] : '';
                $perPage = 100; // Number of records per page
                $offset = ($currentPage - 1) * $perPage;

                // Query database
                $builder = $this->db->table('divestasi_data')
                                    ->select('*')
                                    ->where('objek_divestasi LIKE "%' . $_GET['searchTerm'] . '%"')
                                    ->like('lokasi_objek_divestasi',$lokasi)
                                    ->join('master_region','master_region.master_region_kode=divestasi_data.lokasi_objek_divestasi','left')
                                    ->limit($perPage, $offset);
                $data = $builder->get()->getResultArray();

                //echo $this->db->getLastQuery()->getQuery();

                $progress = $this->countProgressAll();
                $all_tahapan= $this->countTahapan();

                // Total number of pages
                $totalRecords = $this->db->table('divestasi_data')
                                    ->select('id_divestasi')
                                    ->where('objek_divestasi LIKE "%' . $_GET['searchTerm'] . '%"')
                                    ->like('lokasi_objek_divestasi',$lokasi)
                                    ->countAllResults();
                $lastPage = ceil($totalRecords / $perPage);

                // Generate next page URL
                $nextPageUrl = $currentPage < $lastPage
                    ? base_url()."masterList?page=" . ($currentPage + 1)
                    : null;

                // Response structure
                $response = [
                    'status' => 'success',
                    'message' => 'Data successfully retrieved!',
                    // 'region' => 'Semua Region',
                    'current_page' => $currentPage,
                    'next_page_url' => $nextPageUrl,
                    'last_page' => $lastPage,
                    'data' => $data,
                    'progress'=>$progress,
                    'all_tahapan'=>$all_tahapan
                ];
                echo json_encode($response);

            } catch (Exception $e) {
                // Handle error
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    public function getRegionBy($kode_perusahaan=''){
        $asetModel = new M_aset_manajemen();
        $data= $asetModel->getRegionSession($kode_perusahaan);
        echo json_encode($data);
    }


    public function save(){
        $data['objek_divestasi']        = $this->request->getPost('objek_divestasi');
        $data['luas_objek_divestasi']   = $this->request->getPost('luas_objek_divestasi');
        $data['nilai_objek_divestasi']  = $this->request->getPost('nilai_objek_divestasi');
        $data['nilai_buku']  = $this->request->getPost('nilai_buku_divestasi');
        $data['realisasi_pembayaran']  = $this->request->getPost('nilai_realisasi_divestasi');
        $data['jenis_rkap']  = $this->request->getPost('jenis_rkap');
        $data['lokasi_objek_divestasi']  = $this->request->getPost('lokasi_objek_divestasi');


        $assets     = $this->request->getPost('assets');
        $nilai_buku = $this->request->getPost('nilai_buku_aset');
        $nilai_objek= $this->request->getPost('nilai_objek_aset');
        $luas       = $this->request->getPost('luas_aset');

        

        $data['id_maia_masterlists'] =json_encode(array_column($assets, 0));
        $data['nilai_buku_aset'] =json_encode($nilai_buku);
        $data['nilai_objek_aset'] =json_encode($nilai_objek);
        $data['luas_aset'] =json_encode($luas);

            
        $data['metode']                 = $this->request->getPost('metode');
        $data['start_date']             = $this->request->getPost('start_date');
        $data['target_date']            = $this->request->getPost('target_date');
        $data['id_divestasi']           = $this->request->getPost('id_divestasi');
        if($this->request->getPost('asets')!='')$data['id_maia_masterlists']= implode(',',$this->request->getPost('asets'));
        $data['created_at']             = date('Y-m-d H:i:s');
        $data['unit_id_user']           = session()->get('unit_id');

        $model = new M_Divestasi();
        $data['id_divestasi']           = $model->insert_divestasi_data($data);

        $dataPesan['id_divestasi']      = $data['id_divestasi'];
        $dataPesan['objek_divestasi']   = $data['objek_divestasi'];
        $dataPesan['tglTarget']         = $data['target_date'];

        $dataPesan['id_user']           = session()->get('user_id');
        $dataPesan['jenis']             = 'registrasiDivestasi';
        $dataPesan['phoneNumber']       = $this->getNoWa(session()->get('user_id'))->user_telp;
        $dataPesan['tglKirim']          = date('Y-m-d');

        // $this->create_notif_wa($dataPesan);
        echo json_encode($data);

    }


    public function upload()
    {
        $model = new M_Divestasi();
        $id_divestasi = $this->request->getPost('id_divestasi');
        $objek_divestasi = $this->request->getPost('objek_divestasi');
        $fileGroup = $this->request->getPost('file_group');
        $fileGroup .= $this->request->getPost('file_add');
        $fileStatus = $this->request->getPost('file_status');
        $uploadedFile = $this->request->getFile('file_upload');
        $tahapan = $this->request->getPost('tahapan');
        $tahapan_label = $this->request->getPost('tahapan_label');


        // Validasi input
        if (!$fileGroup || !$uploadedFile || !$uploadedFile->isValid()) {
            return redirect()->back()->with('error', 'Harap memilih group file dan file untuk diunggah.');
        }

        try {
            // Simpan file ke folder public/uploads
            $newFileName = $tahapan.'_'.time().'_'.$uploadedFile->getName();
            $uploadedFile->move('uploads/'.$id_divestasi.'/', $newFileName);

            // Simpan data ke database
            $model->insert([
                'id_divestasi' => $id_divestasi,
                'file_name' => $newFileName,
                'kategori' => $fileGroup,
                'tahapan'=>$tahapan,
                'status'=>$fileStatus,
                'created_at' => date('Y-m-d H:i:s'),
            ]);


            $dataPesan['id_divestasi']    = $id_divestasi;
            $dataPesan['objek_divestasi'] = $objek_divestasi;
            $dataPesan['tahapan']         = $tahapan_label;
            $dataPesan['kategori']      = $fileGroup;
            $dataPesan['tglUpload']       = date('Y-m-d H:i:s');

            $dataPesan['id_user']         = session()->get('user_id');
            $dataPesan['jenis']           = 'uploadDokumen';
            $dataPesan['phoneNumber']     = $this->getNoWa(session()->get('user_id'))->user_telp;
            $dataPesan['tglTarget']       = date('Y-m-d');
            $dataPesan['tglKirim']        = date('Y-m-d');

            $this->create_notif_wa($dataPesan);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', 'File berhasil diunggah.')->with('tab',$tahapan);
        } catch (\Exception $e) {
            // Handle error
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    


    public function proses($id_divestasi){
        if (session()->get('username') == '') {
            session()->setFlashdata('gagal', 'Anda belum login');
            return redirect()->to(base_url('C_login'));
        }


        $model = new M_Divestasi();
        $asetModel = new M_aset_manajemen();

        $data['divestasi_data']     = $model->getDivestasi($id_divestasi);
        $data['divestasi_log']      = $model->getDivestasiLog($id_divestasi);
        $data['region']             = $asetModel->getRegionSession();

        $data['progress_divestasi'] = $this->progressAll($id_divestasi);

        $data['files']              = $model->getDivestasiLog($id_divestasi);

       
        if($data['divestasi_data']==null){
            $data['tahapan_divestasi']  = $model->getTahapan(1);
        }else{
            $data['tahapan_divestasi']  = $model->getTahapan($data['divestasi_data']->metode);
            if($data['tahapan_divestasi']['dokumen_length']<=0){
                $data['tahapan_divestasi']  = $model->getTahapan(1);
            }
        };
        
        
        
        //Hitung semua File yang telah diupload kecuali tahapan yang non aktif
        $except_tahapan = $data['divestasi_data']->except_tahapan;
        $except_tahapan_array = explode(",", $except_tahapan);

        $dataUpload     = $this->countProgress($id_divestasi,$except_tahapan_array); 


        //Hitung file yang seharusnya di upload
        $all_document=0;
        $all_document_wajib=0;
        $document    =array();
        $document_wajib = array();

        foreach($data['tahapan_divestasi']['dokumen'] as $tahapan=>$val){
            $document[$tahapan]=count($val);

            $arr = $data['tahapan_divestasi']['optional'][$tahapan];

            $document_wajib[$tahapan] = count(array_filter($arr, function ($value) {
                return $value !== "o";
            }));

            
            foreach($val as $opt){
                if(in_array($tahapan,$except_tahapan_array))continue;
                $all_document++;
            }



            if(!in_array($tahapan,$except_tahapan_array)){             
                $all_document_wajib+= $document_wajib[$tahapan];
            }
        }



        //Hitung persentasi progress total
        $data['progress'] = 0;
        if($all_document_wajib>0) $data['progress'] = number_format($dataUpload['total']/$all_document_wajib*100,2);

     
        //Hitung persentasi progress per tahapan
        foreach($data['tahapan_divestasi']['dokumen'] as $tahapan=>$val){

            $dataUpload['jumlah'] = $dataUpload['jumlah'] ?? []; // Ensure it's initialized
            $data['progress_tahapan'][$tahapan] = $data['progress_tahapan'][$tahapan] ?? 0;

            

            if (isset($dataUpload['jumlah'][$tahapan]) && isset($document_wajib[$tahapan]) && $document_wajib[$tahapan] != 0) {

            // echo "<pre>";
            // var_dump($dataUpload['jumlah'][$tahapan]." / ".$document_wajib[$tahapan]);
            // echo "</pre>";

                $data['progress_tahapan'][$tahapan] = number_format($dataUpload['jumlah'][$tahapan] / $document_wajib[$tahapan] * 100, 2);
            } else {
                $data['progress_tahapan'][$tahapan] = 0; // Default value to avoid errors
            }
        }



        return view('divestasi/v_proses_divestasi', $data);
    }



    public function getAsetMaia(){
        $model = new M_Divestasi();
        $results=array();
        
        if(isset($_GET['search'])){
            $search = $this->request->getGet('search');
            $results = $model->searchAset($search); 
            //echo $this->db->getLastQuery()->getQuery();
            // Format respons JSON
            return $this->response->setJSON([
                'items' => array_map(function($item) {
                    return [
                        'id' => $item->id,
                        'text' => $item->label_aset // Ganti dengan nama kolom yang sesuai
                    ];
                }, $results)
            ]);
        }
    }


    public function getOptionAset(){
        $model = new M_Divestasi();
        $id_maia_masterlists = json_decode($this->request->getPost('id_maia_masterlists'));
        $results             = $model->getDataAset($id_maia_masterlists); 

        // Format respons JSON
        return $this->response->setJSON([
            'items' => array_map(function($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->label_aset
                ];
            }, $results)
        ]);
    }
        
    


    private function countProgress($id_divestasi,$except_tahapan_array=''){
        //$except_tahapan_array = explode(",", $except_tahapan);
        $except_tahapan_sql = "'" . implode("','", $except_tahapan_array) . "'";

        $sql= "select COUNT(DISTINCT kategori) as jumlah,tahapan 
                from divestasi_log log
                where log.id_divestasi='".$id_divestasi."' 
                AND log.tahapan NOT IN ($except_tahapan_sql) 
                and approval_status='approve'
                and log.kategori not like '-->%'
                group by tahapan";
        $query=$this->db->query($sql);
        $result = $query->getResultArray();
        $total=0;
        $data['total']=0;
        foreach($result as $r){
            $data['jumlah'][$r['tahapan']]=$r['jumlah'];
            $data['total']+=$r['jumlah'];
        }

        return $data;
    }


    private function countTotalKebutuhanDokumen($id_divestasi){
        $lokasi      = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

        $where='';
        if($id_divestasi!='')$where=' and id_divestasi="'.$id_divestasi.'" ';

        $sql="SELECT 
                    id_divestasi,count(id_dokumen_divestasi) as jumlah
                FROM divestasi_dokumen dok
                INNER JOIN divestasi_data dt 
                    ON dt.metode = dok.metode 
                INNER JOIN divestasi_master_tahapan m 
                    ON m.id_tahapan_divestasi = dok.id_tahapan_divestasi
                WHERE dok.optional IS NULL and id_divestasi IS NOT NULL
                AND lokasi_objek_divestasi LIKE '%".$lokasi."%'
                AND (FIND_IN_SET(dok.id_tahapan_divestasi, dt.except_tahapan) = 0 or dt.except_tahapan IS NULL)
                ".$where."
                GROUP BY id_divestasi";
        $query=$this->db->query($sql);
        $result = $query->getResultArray();
        foreach($result as $r){
            $data[$r['id_divestasi']]=$r['jumlah'];
        }

        return $data;
    }


    private function countTotalUpload($id_divestasi){
        $lokasi      = isset($_GET['lokasi']) ? $_GET['lokasi'] : '';
        $where='';
        if($id_divestasi!='')$where=' and log.id_divestasi="'.$id_divestasi.'" ';

        $sql="select log.id_divestasi, COUNT(DISTINCT kategori) as jumlah
                from divestasi_log log 
                INNER join divestasi_data dt on dt.id_divestasi=log.id_divestasi
                INNER JOIN divestasi_master_tahapan m 
                    ON m.id_tahapan_divestasi = log.tahapan
                where approval_status='approve'
                and lokasi_objek_divestasi like '%".$lokasi."%'
                and log.kategori not like '-->%'
                and (FIND_IN_SET(log.tahapan,dt.except_tahapan)=0 or dt.except_tahapan IS NULL)
                ".$where."
                group by id_divestasi";
        $query=$this->db->query($sql);
        $result = $query->getResultArray();
        foreach($result as $r){
            $data[$r['id_divestasi']]=$r['jumlah'];
        }

        return $data;
    }

    private function progressAll($id_divestasi=''){
        $totalUpload = $this->countTotalUpload($id_divestasi);
        $totalKebutuhanDokumen = $this->countTotalKebutuhanDokumen($id_divestasi);  

        $data['selesai']=0;
        foreach($totalUpload as $id => $jml){
            $data['persen'][$id]= number_format($totalUpload[$id]/$totalKebutuhanDokumen[$id]*100,2);
            if($data['persen'][$id]==100){
                $data['selesai']++;
            }
        }

        return $data;

    }


    private function countProgressAll(){

        $sql="select log.id_divestasi,COUNT(DISTINCT kategori) as jumlah,except_tahapan
                from divestasi_log log
                LEFT JOIN divestasi_data dt on log.id_divestasi = dt.id_divestasi
                where `approval_status` = 'approve'  
                and (except_tahapan is null OR FIND_IN_SET(tahapan, except_tahapan) = 0)
                GROUP BY log.id_divestasi
                ORDER BY log.id_divestasi desc";
        $query=$this->db->query($sql);
        $result = $query->getResultArray();
        $total=0;
        $data['total']=0;
        foreach($result as $r){
            $data['jumlah'][$r['id_divestasi']]=$r['jumlah'];
            $data['except'][$r['id_divestasi']]=$r['except_tahapan'];
            $data['total']+=$r['jumlah'];
        }

        return $data;
    }


    private function countByGroupTahapan(){
        //HO,REG,Pemegang Saham

        $lokasi= isset($_GET['lokasi']) ? $_GET['lokasi'] : '';

        $sql= "
        select count(group_tahapan) as jumlah, 
                sum(nilai_objek_divestasi) as total_kjpp,
                sum(nilai_buku) as total_nilai_buku,
                sum(realisasi_pembayaran) as total_nilai_realisasi,
                thp.group_tahapan
        from divestasi_data dt
        left join divestasi_master_tahapan thp on thp.tahapan_divestasi=dt.current_status
        where dt.lokasi_objek_divestasi like '%".$lokasi."%'
        GROUP BY thp.group_tahapan
        ";
        $query=$this->db->query($sql);
        $result = $query->getResultArray();
        $total=0;
        $data['group_progress_total']           =0;//$r['jumlah'];
        $data['total_nilai_objek_divestasi']    =0;//$r['total_kjpp'];
        $data['total_nilai_buku']               =0;//$r['total_nilai_buku'];
        $data['total_nilai_realisasi']          =0;//$r['total_nilai_realisasi'];
        foreach($result as $r){
            $data['group_progress'][$r['group_tahapan']]=$r['jumlah'];
            $data['group_progress_total']           +=$r['jumlah'];
            $data['total_nilai_objek_divestasi']    +=$r['total_kjpp'];
            $data['total_nilai_buku']               +=$r['total_nilai_buku'];
            $data['total_nilai_realisasi']          +=$r['total_nilai_realisasi'];
        }
        //echo $this->db->getLastQuery()->getQuery();
        return $data;

    }


    private function countTahapan(){
        $model = new M_Divestasi();
        $tahapan['1'] = $model->getTahapan('1');
        $tahapan['2'] = $model->getTahapan('2');
        $tahapan['3'] = $model->getTahapan('3');

        return $tahapan;
    }



    public function save_log(){
        // Simpan log ke database
            $post  = $this->request->getPost();
            $model = new M_Divestasi();

            if($post['status']=='Close'){
                $post['start_log']="";
                $post['target_log']="";
            }

            $model->insert([
                'id_divestasi' => $post['id_divestasi'],
                'kategori' => $post['tahapan'],
                'start_log'=>$post['start_log'],
                'status'=>$post['status'],
                'target_log'=>$post['target_log'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);


            $data['id_divestasi']= $post['id_divestasi'];
            $data['current_status']    = $post['tahapan'];
            $data['current_start_log'] = $post['start_log'];
            $data['current_target_log']= $post['target_log'];

            if($post['status']=='Close'){
                $data['id_divestasi']= $post['id_divestasi'];
                $data['current_status']    = "";
                $data['current_start_log'] = "";
                $data['current_target_log']= "";
            }

            $model->insert_divestasi_data($data,1);
            if($post['status']=='Open'){
                $dataPesan['id_divestasi']    = $post['id_divestasi'];
                $dataPesan['tahapan']         = $post['tahapan'];
                $dataPesan['tglStart']        = $post['start_log'];
                $dataPesan['tglTarget']       = $post['target_log'];
                $dataPesan['objek_divestasi'] = $post['objek_divestasi'];

                $dataPesan['id_user']         = session()->get('user_id');
                $dataPesan['jenis']           = 'openTahapan';
                $dataPesan['phoneNumber']     = $this->getNoWa(session()->get('user_id'))->user_telp;
                $dataPesan['tglKirim']        = date('Y-m-d');

                $this->create_notif_wa($dataPesan);
            }

            echo json_encode($data);

    }



    public function save_log_action(){
        // Simpan log ke database
            $post  = $this->request->getPost();
            $model = new M_Divestasi();

        }

    public function update_log(){
        // Simpan log ke database
            $post  = $this->request->getPost();
            $model = new M_Divestasi();
            $id = $post['id'];
            $data = [
                'approval_status'=>$post['status'],
                'keterangan'=>$post['keterangan'],
                'approval_date'=> date('Y-m-d H:i:s')
            ];



            //
            $model->update($id,$data);

            //echo json_encode($this->db->getLastQuery()->getQuery());
            //echo json_encode($data);
    }

    public function except_add(){
            $id_divestasi = $_POST['id_divestasi'];
            $except_tahapan = implode(",", $_POST['except_thp']);

            $model = new M_Divestasi();
            $data['except_tahapan'] = $except_tahapan;
            $data['update_at']      = date("Y-m-d H:i:s");

            $ins = $model->update_divestasi($id_divestasi, $data);
            if ($ins) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Data berhasil disimpan"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menyimpan data"
                ]);
            }
            

    }


    private function create_notif_wa($data)
    {
        $tgl_sekarang = date('Y-m-d');

        // $pesan['leadTimeOver']          = "Tahapan *".$data['tahapan']."* pada Objek divestasi *".$data['objek_divestasi']."* dengan target penyelesaian tanggal *".$data['tglTarget']."* sudah melebihi batas waktu, harap lapor kendala terhadap progres tersebut";

        $pesan['uploadDokumen']         = "*DIVESTASI ASET :* \nTelah dilakukan Upload dokumen *".$data['kategori']."* terkait Objek divestasi *".$data['objek_divestasi']."* pada tahapan *".$data['tahapan']."* tanggal *".$data['tglUpload']."*";

        $pesan['openTahapan']           = "*DIVESTASI ASET :* \nObjek divestasi *".$data['objek_divestasi']."* berada pada tahapan *".$data['tahapan']."* yang berlangsung pada tanggal ".$data['tglStart']." s/d ".$data['tglTarget']." harap dapat melengkapi dokumen terkait tahapan tersebut";

        $pesan['registrasiDivestasi']   = "*DIVESTASI ASET :* \nTelah dilakukan registrasi terhadap objek divestasi *".$data['objek_divestasi']."* dengan target penyelesaian s/d tanggal ".$data['tglTarget'];

        $this->db->query(
                "INSERT INTO divestasi_notif (id_user,nomor,pesan, tgl_kirim) VALUES (?, ?, ?, ?)",
                [$data['id_user'],$data['phoneNumber'], $pesan[$data['jenis']], $data['tglKirim']]
            );

        
        if($tgl_sekarang==$data['tglKirim']){
           //$this->sendWhatsAppMessage($pesan[$data['jenis']], $data['phoneNumber']);
        }
        
    }


    private function sendWhatsAppMessage($message, $phoneNumber)
    {

        $dataSending = Array();
        $dataSending["api_key"] = "9ZFFBRZDFJ07HGJX";
        $dataSending["number_key"] = "o1PpHWDfDWkU44FH";
        $dataSending["phone_no"] = $phoneNumber;
        $dataSending["message"] = $message;
        //$dataSending["wait_until_send"] = "1";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.watzap.id/v1/send_message',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($dataSending),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


    private function getNoWa($user_id){
        $query = $this->db->table('user')
                          ->where('user_id', $user_id)
                          ->get();

        //echo $this->db->getLastQuery(); 
        return $query->getRow(); 

    }


}
