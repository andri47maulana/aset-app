<?php
namespace App\Controllers;
use App\Models\Map_aiModel;
use Config\Database;




class Map_ai extends BaseController
{

    protected $db;

    public function __construct()
    {
       
        $this->db = Database::connect();

    }


    public function index()
    {

        if (!isset($_GET['token']) || $_GET['token'] !== "234kjjlksflk8y98ksafdklj23") {
            header("Location: " . base_url());
            exit; 
        }

        //var_dump($this->getOAuthToken());
        // $infoModel = new Map_aiModel();
        // $info = $infoModel->getCuaca();
        $info = '';
        return view('Map_ai_vw', ["info" => $info]);
        //return view('aigri_vw', ["info" => $info]);
    }


    public function getData()
    {
        $model = new Map_aiModel();
        $data = $model->findAll(); // Ambil semua data dari database

        return $this->response->setJSON($data); // Kembalikan data dalam format JSON
    }


    public function getWilayah(){
        $results=array();
        
        if(isset($_GET['search'])){
            $search = $this->request->getGet('search');
            $results = $this->searchWilayah($search);
            
            return $this->response->setJSON([
                'items' => array_map(function($item) {
                    return [
                        'id' => $item->kode_wilayah,
                        'text' => $item->wilayah // Ganti dengan nama kolom yang sesuai
                    ];
                }, $results)
            ]);
        }
    }

    // private function searchWilayah($search){

    //         $keywords = explode(" ", $search);
    //         $query = $this->db->table('master_wilayah')->select("kode_wilayah,wilayah");

    //         // Buat kondisi LIKE untuk setiap kata dan hitung kecocokan
    //         $caseStatements = [];
    //         foreach ($keywords as $word) {
    //             $query->like('wilayah', $word);
    //             $caseStatements[] = "wilayah LIKE '%$word%'";
    //         }

    //         // Tambahkan ORDER BY berdasarkan jumlah kecocokan kata
    //         $caseSQL = implode(" + ", $caseStatements);
    //         $query->orderBy("($caseSQL) DESC")->limit(10);

    //         $result = $query->get(); // Execute query first
    //         //return 
    //         $result->getResult(); // Fetch results

    //         var_dump($this->db->getLastQuery()->getQuery());
    // }

    private function searchWilayah($search) {
        $keywords = array_filter(array_map('trim', explode(" ", $search)));
        $query = $this->db->table('master_wilayah')->select("kode_wilayah, wilayah");

        $caseStatements = [];

        foreach ($keywords as $word) {
            $query->like('wilayah', $word); // Adds WHERE wilayah LIKE '%word%'
            $escapedWord = $this->db->escapeLikeString($word);
            $caseStatements[] = "CASE WHEN wilayah LIKE '%$escapedWord%' THEN 1 ELSE 0 END";
        }

        $caseSQL = implode(" + ", $caseStatements);
        $query->orderBy("($caseSQL)", 'DESC')->limit(10);

        $result = $query->get();
        $rows = $result->getResult();

        return $rows;
    }



    public function getCuaca(){
        #GET data cuaca bmkg berdasarkan wilayah
        $reg=$this->request->getPost("regional");
        $wilayah= $this->request->getPost("wilayah");
        $model = new Map_aiModel();
        $cuaca_bmkg = $model->getCuacaBMKG($reg,$wilayah);

        #GET waktu yang mendekati berdasarkan pertanyaan dan sample cuaca bmkg
        $tanya = $this->request->getPost("tanya");
        $sample_waktu = $this->sampleWaktuCuaca($wilayah);

        $waktu = $this->ai_waktu_cuaca($tanya,$sample_waktu);


        $data['cuaca']= $cuaca_bmkg;
        $data['waktu']= $waktu;
        $data['sampleWaktu']= $sample_waktu;

        echo json_encode($data);
    }



    public function sampleWaktuCuaca($wilayah){
        //$reg=$this->request->getPost("regional");
        //$wilayah= $this->request->getPost("wilayah");

        $reg ='';
        $sampleWaktu = array();
        $model = new Map_aiModel();
        $info = $model->getCuacaBMKG($reg,$wilayah);
        $cuaca = json_decode($info,1);
        $cuaca = $cuaca['data'];
        //echo "<pre>";
        //var_dump($cuaca);
        //echo "</pre>";
        foreach($cuaca as $c=>$v){
            foreach($cuaca as $v=>$d){
                foreach($d['cuaca'] as $t){
                    foreach($t as $dt){
                        $waktu[$dt['local_datetime']]=1;
                    }
                }
            }
        }

        foreach($waktu as $w=>$v){
            $sampleWaktu[]=$w;
        }

        return $sampleWaktu;
        
    }


    public function ai_waktu_cuaca($tanya,$sample_waktu){
        
        if($tanya=='')$tanya="tampilkan data sekarang atau yang mendekati pertanyaan dari data yang tersedia";

        $sekarang = date('Y-m-d H:00:00');
        $data_sample = implode(',',$sample_waktu);
        $role_system ='sekarang adalah tanggal '.$sekarang.',';
        
        $role_system.='Tampilkan data dalam dalam bentuk json dengan attribut yaitu waktu harus dengan format yyyy-mm-dd H:00:00,';
        
        $role_system.='waktu jam dalam satu hari hanya tersedia '.$data_sample." tampilkan yang paling mendekati salah satunya dengan format yyyy:mm:dd H:00:00,";

        $role_system.='pilih data yang sesuai atau yang mendekati dengan pertanyaan, dan tampilkan dalam bentuk json dengan attribut yaitu waktu harus dengan format yyyy-mm-dd H:00:00,';
        $role_system.='jika ada kata lusa pilih tanggal 2 hari yang akan datang,';

          //role_system+='Jika menunjukkan rentang tanggal buat lebih dari 1 json';
        $role_system.='tidak ada kalimat lain selain json';

        $pertanyaan = 'Pahami pertanyaan ini '.$tanya;

        //var_dump($role_system);
        $response =  $this->getResponseAi($role_system, $pertanyaan);

        if ($response !== null) {
            return json_encode($response);
        } else {
            return json_encode(["error" => "Tidak ada respons dari AI"]);
        }


    }


    public function ai_query(){
        $tanya = $this->request->getPost('tanya');
        //$tanya = "tampilkan aset di kota langsa";

        $query  = $this->db->query("DESCRIBE dataset_monika");
        $result = $query->getResultArray(); 
        $struktur= json_encode($result);

        $dataset_name = 'dataset_monika';
        $dataset_id   = 'paket_kerjasama_id';

        $query  = $this->db->query("select * from dataset_monika limit 1");
        $result = $query->getResultArray(); 
        $row= json_encode($result);

        $role_system  ='anda adalah ai generator mysql query,';
        $role_system  .='saya memiliki table '.$dataset_name.' dengan struktur table mysql seperti ini '.$struktur.' dan contoh data seperti ini '.$row.',';
        $role_system .='tampilkan hanya dalam bentuk query,';
        $role_system .= "pilih field yang paling sesuai dengan pertanyaan saja,";
        $role_system .= "selalu sertakan field ".$dataset_id." dengan nama dataset_id di setiap rownya,";
        $role_system .= "pilih minimal 2 field table yang paling sesuai dengan kebutuhan pertanyaan,";
        $role_system .= "pilih field yang tersedia saja, jika butuh total atau jumlah gunakan count jika isinya bukan angka atau sum jika isinya angka";

        $role_system .= "gunakan like untuk kata-kata yang akan dicari";
        $role_system .='masukkan query ke dalam bentuk json dengan nama query';

        //role khusus monika
        //$role_system .='abaikan row yang hal_yang_dikerjasamakan kosong atau null';

        $pertanyaan = 'Buatkan query mysql yang sesuai untuk menjawab pertanyaan ini: '.$tanya;

        $response =  $this->getResponseAi2($role_system, $pertanyaan);
        //echo json_encode($response['query']);

        if ($response !== null) {
            $query  = $this->db->query($response['query']);
            $data = json_encode($query->getResultArray()); 
            $data_arr=$query->getResultArray();
            $text_query = $this->db->getLastQuery()->getQuery();


            $arrayData = json_decode($data, true);

            // Cek apakah array kosong
            if (empty($arrayData)) {
                echo json_encode(
                [
                    "status" => "success",
                    "response"  => "Maaf, data tidak ditemukan dalam database, Harap ubah pertanyaan anda menjadi lebih spesifik",
                    "query" => $text_query,
                    "data" => $data,
                ]);
            } else {
                $this->ai_jelaskan($data,$tanya,$text_query);
            }
           
        } else {
            echo json_encode([
                "error" => "Tidak ada respons dari AI Query",

            ]);
        }

    }




    public function ai_aset_tanah(){
        $tanya = $this->request->getPost('tanya');
        //$tanya = "tampilkan aset di kota langsa";

        $query  = $this->db->query("DESCRIBE map_aset_tanah");
        $result = $query->getResultArray(); 
        $struktur= json_encode($result);

        $dataset_name = 'map_aset_tanah';
        $dataset_id   = 'id';

        $query  = $this->db->query("select * from map_aset_tanah limit 1");
        $result = $query->getResultArray(); 
        $row= json_encode($result);

        $role_system = "Anda adalah AI yang bertugas membuat query MySQL.";
        $role_system .= " Buatlah query untuk mendapatkan informasi profil suatu areal beserta legalitasnya.";
        $role_system .= " Saya memiliki tabel '$dataset_name' dengan struktur sebagai berikut: $struktur.";
        $role_system .= " Contoh data dalam tabel adalah: $row.";
        $role_system .= " Berikan output hanya dalam bentuk query JSON dengan key 'query'.";

        $role_system .= " Syarat dalam pembuatan query:";
        $role_system .= " 1. Sertakan field '$dataset_id' sebagai 'dataset_id' di setiap hasil query.";
        $role_system .= " 2. Cari data di semua field.";
        $role_system .= " 3. Sertakan semua field yang berisi informasi luas dan tanggal.";
        $role_system .= " 4. Gunakan hanya field yang tersedia dalam tabel.";
        $role_system .= " 5. Jika perlu menghitung total atau jumlah, gunakan COUNT() jika isinya bukan angka, dan SUM() jika isinya angka.";
        $role_system .= " 6. Gunakan LIKE untuk pencarian kata-kata dalam teks.";

        $role_system .= " Buatkan query MySQL untuk menjawab pertanyaan berikut: '$tanya'.";


        $pertanyaan = 'Buatkan query mysql yang sesuai untuk menjawab pertanyaan ini: '.$tanya;

        $response =  $this->getResponseAi2($role_system, $pertanyaan);

        if ($response !== null) {
            $query  = $this->db->query($response['query']);
            $data = json_encode($query->getResultArray()); 
            $data_arr=$query->getResultArray();
            $text_query = $this->db->getLastQuery()->getQuery();


            $arrayData = json_decode($data, true);

            // Cek apakah array kosong
            if (empty($arrayData)) {
                echo json_encode(
                [
                    "status" => "success",
                    "response"  => "Maaf, data tidak ditemukan dalam database, Harap ubah pertanyaan anda menjadi lebih spesifik",
                    "query" => $text_query,
                    "data" => $data,
                ]);
            } else {
                $this->ai_jelaskan_aset_tanah($data,$tanya,$text_query);

            }
           
        } else {
            echo json_encode([
                "error" => "Tidak ada respons dari AI Query Aset Tanah",
                "query" => $response

            ]);
        }

    }


    public function ai_mrc($tanya=null){
        //$tanya = $this->request->getPost('tanya');
        if($tanya==null)$tanya ="Berapa pendapatan teh regional 5";
        $r='Query';
        // if (strpos(strtolower($tanya), 'regional 1') !== false)$r='R1';
        // else if(strpos(strtolower($tanya), 'regional 2') !== false)$r='R2';
        // else if(strpos(strtolower($tanya), 'regional 3') !== false)$r='R3';
        // else if(strpos(strtolower($tanya), 'regional 4') !== false)$r='R4';
        // else if(strpos(strtolower($tanya), 'regional 5') !== false)$r='R5';
        // else if(strpos(strtolower($tanya), 'regional 6') !== false)$r='R6';
        // else if(strpos(strtolower($tanya), 'regional 7') !== false)$r='R7';
        // else if(strpos(strtolower($tanya), 'regional 8') !== false)$r='R8';


        $data = $this->get_data_mrc($r,$tanya);
        //var_dump($data);
        $text_query="";   

        $role_system ='Ini adalah data MRC,';

        $role_system .='jawaban sesuai dengan pertanyaan dan abaikan data yang tidak terkait dengan pertanyaan,';
        $role_system .='selalu tampilkan lokasi dan periodenya,';
        $role_system .='tampilkan data dalam bentuk yang mudah di baca,';

        $pertanyaan = "berdasarkan pertanyaan ini ".$tanya.", jelaskan data ini ".$data." dengan jelas";

        //var_dump($pertanyaan);

        $response = $this->getResponseAiMistral($role_system, $pertanyaan);

        if ($response != null) {
            echo json_encode(
                [
                    "status" => "success",
                    "response"  => $response,
                    "counter"=>strlen($data),
                    "query" => $text_query,
                    "data" => $data,
                    "tanya"=>$tanya
                ]);
        } else {
            //echo json_encode($data);
            //ai_jelaskan($data,$tanya,$text_query);
            echo json_encode(
                [
                    "status" => "failed",
                    "response"  => $response,
                    "counter"=>strlen($data),
                    "query" => $text_query,
                    "data" => $data,
                    "tanya"=>$tanya
                ]);
        }
    }


    public function ai_agraria($tanya=null){
        //$tanya = $this->request->getPost('tanya');
        if($tanya==null)$tanya ="Tampilkan HGU yang akan habis di bawah 1 tahun";
       

        $data = $this->get_data_agraria($tanya);
        //var_dump($data);
        $text_query="";   

        $role_system ='Ini adalah data Agraria,';

        $role_system .='jawaban sesuai dengan pertanyaan dan abaikan data yang tidak terkait dengan pertanyaan,';
        $role_system .='selalu tampilkan lokasi dan periodenya,';
        $role_system .='tampilkan data dalam bentuk yang mudah di baca,';

        $pertanyaan = "berdasarkan pertanyaan ini ".$tanya.", jelaskan data ini ".$data." dengan jelas";

        //var_dump($pertanyaan);

        $response = $this->getResponseAiMistral($role_system, $pertanyaan);

        if ($response != null) {
            echo json_encode(
                [
                    "status" => "success",
                    "response"  => $response,
                    "counter"=>strlen($data),
                    "query" => $text_query,
                    "data" => $data,
                    "tanya"=>$tanya
                ]);
        } else {
            //echo json_encode($data);
            //ai_jelaskan($data,$tanya,$text_query);
            echo json_encode(
                [
                    "status" => "failed",
                    "response"  => $response,
                    "counter"=>strlen($data),
                    "query" => $text_query,
                    "data" => $data,
                    "tanya"=>$tanya
                ]);
        }
    }

    public function talking(){

        $imageUrl = "../assets/img/abd_s.png";//$request->image_url;
        $text = "Halo selamat Pagi";

        $url = "https://api.d-id.com/talks";
        $apiKey = "YWJkdWxsYWhyYWhpbTQ3OTNAZ21haWwuY29t:isAtguXdIlBxPuRBFRU9f"; // Ganti dengan API Key Anda
        
        $data = [
            'source_url' => $imageUrl,
            'script' => [
                'type' => 'text',
                'input' => $text,
                'provider' => [
                    'type' => 'microsoft',
                    'voice_id' => 'id-ID-ArdiNeural'
                ]
            ]
        ];
        
        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer $apiKey"
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Maksimum waktu tunggu respons 30 detik
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // Maksimum waktu koneksi 10 detik
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        var_dump($response);
        
        // if ($response && $httpCode === 200) {
        //     $responseData = json_decode($response, true);
            
        //     return $responseData;
        // }
        
        // return null; // Pastikan null dikembalikan jika gagal

        // $client = \Config\Services::curlrequest();
        // $response = $client->post('https://api.d-id.com/talks', [
        //     'headers' => [
        //         'Authorization' => 'Bearer ' . $this->apiKey,
        //         'Content-Type'  => 'application/json'
        //     ],
        //     'json' => $body
        // ]);

        // $result = json_decode($response->getBody());

        // if (!isset($result->id)) {
        //     return $this->response->setStatusCode(500)->setJSON([
        //         'status' => 'error',
        //         'message' => 'Gagal membuat video.'
        //     ]);
        // }

        // return $this->response->setJSON([
        //     'status' => 'success',
        //     'video_id' => $result->id,
        //     'video_url' => 'https://studio.d-id.com/talks/' . $result->id
        // ]);
    }


    public function ai_jelaskan($data="",$tanya="",$text_query=""){

        
        $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';

        $role_system .='jawaban hanya mengacu pada data yang diberikan,';
        $role_system .='jangan tampilkan dataset id pada jawaban,';

        $pertanyaan = "berdasarkan pertanyaan ini ".$tanya.", jelaskan data ini ".$data." dengan jelas";

        $response = $this->getResponseAiMistral($role_system, $pertanyaan);
        $data_map = $this->get_gjson($data);

        if ($response != null) {
            echo json_encode(
                [
                    "status" => "success",
                    "response"  => $response,
                    "data"=>$data,
                    "query" => $text_query,
                    "data_map_query"=>$data_map['query'],
                    "data_map"=>$data_map['data']
                ]);
        } else {
            echo json_encode($data);
            //ai_jelaskan($data,$tanya,$text_query);
        }
    }

    public function ai_jelaskan_aset_tanah($data="",$tanya="",$text_query=""){

        
        $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';

        $role_system .='jawaban hanya mengacu pada data yang diberikan,';
        $role_system .='jangan tampilkan dataset id pada jawaban,';
        $role_system .='jangan tampilkan jika kosong atau tidak ada,';
        $role_system .='Jika ada link buat dalam bentuk tag <a href target _blank/> agar bisa diklik,';
        $role_system .='Penjelasan ringkas dan padat tetapi bermakna,';

        $pertanyaan = "berdasarkan pertanyaan ini ".$tanya.", jelaskan data ini ".$data." dengan jelas";

        $response = $this->getResponseAiMistral($role_system, $pertanyaan);
        $data_map = $this->get_gjson($data);

        if ($response != null) {
            echo json_encode(
                [
                    "status" => "success",
                    "response"  => $response,
                    "data"=>$data,
                    "query" => $text_query,
                    "data_map_query"=>$data_map['query'],
                    "data_map"=>$data_map['data']
                ]);
        } else {
            echo json_encode($data);
            //ai_jelaskan($data,$tanya,$text_query);
        }
    }

     private function get_gjson($data) {
        $data = json_decode($data, true);

        if (!is_array($data)) {
            return '';
        }

        $d = [];
        foreach ($data as $r) {
            if (isset($r['dataset_id'])) {
                $d[] = $r['dataset_id'];
            }
        }

        $id= implode(",", $d);

        //$sql= "select geojson from dataset_monika_ba_ukur where paket_kerjasama_id in (".$id.")";
        $sql= "select label,geojson from dataset_monika_ba_ukur where paket_kerjasama_id in (".$id.") and geojson is not null";
        $query  = $this->db->query($sql);
        $row['data'] = $query->getResultArray(); 
        $row['query'] = $this->db->getLastQuery()->getQuery();
        return $row;

    }



    public function ai_jawab(){
        $tanya = $this->request->getPost('tanya');

        
        $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';

        $pertanyaan = $tanya;

        $data = $this->getResponseAiOpen($role_system, $pertanyaan);
        $response = $data->data[0]->content[0]->text->value;
       
        if ($response != null) {
            echo json_encode(
                [
                    "status" => "success",
                    "response"  => $response,
                    "data"=>$data,
                ]);
        } else {
            
        }
    }


    public function ai_response(){
        $tanya = $this->request->getPost('tanya');

        if ($tanya) {
            $tanya = $_POST['tanya'];
        }else{
            $tanya ="Berapa pendapatan teh regional 5 dari mrc";
        }

            

            if (strpos(strtolower($tanya), 'mrc') !== false){
                $this->ai_mrc($tanya);
            }elseif (strpos(strtolower($tanya), 'agraria') !== false){
                $this->ai_agraria($tanya);
            }else{
                $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';
                $pertanyaan = $tanya;

                $data = $this->getResponseAiOpen($role_system, $pertanyaan);
                $response = $data->data[0]->content[0]->text->value;
                if ($response != null) {
                echo json_encode(
                    [
                        "status" => "success",
                        "response"  => $response,
                        "data"=>$data,
                    ]);
                }
            };


            
        
    }


    public function ai_dataset(){
        $tanya = $this->request->getPost('tanya');
        //$tanya = "tampilkan aset di kota langsa";

        $query  = $this->db->query("DESCRIBE map_dataset");
        $result = $query->getResultArray(); 
        $struktur= json_encode($result);

        $dataset_name = 'map_dataset';
        $dataset_id   = 'id';

        $query  = $this->db->query("select * from map_dataset limit 1");
        $result = $query->getResultArray(); 
        $row= json_encode($result);


        $role_system  ='anda adalah ai generator mysql query,';
        $role_system  .='saya memiliki table '.$dataset_name.' dengan struktur table mysql seperti ini '.$struktur.' dan contoh data seperti ini '.$row.',';
        $role_system .='tampilkan hanya dalam bentuk query,';
        //$role_system .= "pilih semua field yang ada,";
        $role_system .= "selalu sertakan field ".$dataset_id." dengan nama dataset_id,title dan descriptions di setiap rownya,";
        $role_system .= "jangan cari berdasarkan date_created atau update_created nya,";
        $role_system .='cari data berdasarkan title dan descriptions nya,';
        //$role_system .='jika ada keterangan waktu di descriptions pahami dan cari yang makna yang mendekati atau ubah kedalam format date,';
        $role_system .= "pilih minimal 2 field table yang paling sesuai dengan kebutuhan pertanyaan,";
        $role_system .= "pilih field yang tersedia saja, jika butuh total atau jumlah gunakan count jika isinya bukan angka atau sum jika isinya angka";

        $role_system .= "gunakan like untuk kata-kata yang akan dicari";
        $role_system .='masukkan query ke dalam bentuk json dengan nama query';

        $pertanyaan = 'Buatkan query mysql yang sesuai untuk menjawab pertanyaan ini: '.$tanya;

        $response =  $this->getResponseAi2($role_system, $pertanyaan);
        //echo json_encode($response['query']);

        if ($response !== null) {
            $query  = $this->db->query($response['query']);
            $data = json_encode($query->getResultArray()); 
            $data_arr=$query->getResultArray();
            $text_query = $this->db->getLastQuery()->getQuery();


            $arrayData = json_decode($data, true);

            // Cek apakah array kosong
            if (empty($arrayData)) {
                echo json_encode(
                [
                    "status" => "success",
                    "response"  => "...",//"Maaf, data tidak ditemukan dalam database, Harap ubah pertanyaan anda menjadi lebih spesifik",
                    "query" => $text_query,
                    "data" => $data,
                ]);
            } else {
                $this->ai_jelaskan_dataset($data,$tanya,$text_query);
            }
           
        } else {
            echo json_encode([
                "error" => "Tidak ada respons dari AI Query",
                "response"=>$response

            ]);
        }

    }

    public function ai_jelaskan_dataset($data="",$tanya="",$text_query=""){

        
        $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';

        $role_system .='jawaban hanya mengacu pada data yang diberikan,';
        $role_system .='jangan tampilkan dataset id pada jawaban';

        $pertanyaan = "berdasarkan pertanyaan ini ".$tanya.", jelaskan data ini ".$data." dengan jelas";

        $response = $this->getResponseAiMistral($role_system, $pertanyaan);
        $data_map = $this->get_gjson_dataset($data);

        if ($response != null) {
            echo json_encode(
                [
                    "status" => "success",
                    "response"  => $response,
                    "data"=>$data,
                    "query" => $text_query,
                    "data_map_query"=>$data_map['query'],
                    "data_map"=>$data_map['data']
                ]);
        } else {
            //ai_jelaskan_dataset($data,$tanya,$text_query);
            echo json_encode($data);

        }
    }


    private function get_gjson_dataset($data) {
        $data = json_decode($data, true);

        if (!is_array($data)) {
            return '';
        }

        $d = [];
        foreach ($data as $r) {
            if (isset($r['dataset_id'])) {
                $d[] = $r['dataset_id'];
            }
        }

        $id= implode(",", $d);

        $sql= "select title as label,geojson from map_dataset where id in (".$id.") and geojson is not null";
        $query  = $this->db->query($sql);
        $row['data'] = $query->getResultArray(); 
        $row['query'] = $this->db->getLastQuery()->getQuery();
        return $row;

    }
    


    public function getResponseAi($role_system, $pertanyaan){
        $model = new Map_aiModel();
        $info = $model->fetchAIResponse($role_system, $pertanyaan);        
        return $info;
    }


    public function getResponseAi2($role_system, $pertanyaan){
        $model = new Map_aiModel();
        $info = $model->fetch_ai_mistral_json($role_system, $pertanyaan);  
        //$info = $model->fetch_ai_chatGPT_json($role_system, $pertanyaan);      
        return $info;
    }

    public function getResponseAiMistral($role_system, $pertanyaan){
        $model = new Map_aiModel();
        $info = $model->fetch_ai_mistral($role_system, $pertanyaan);
        //$info = $model->fetch_ai_chatGPT($role_system, $pertanyaan);        
        return $info;
    }

    public function getResponseAiOpen($role_system, $pertanyaan){
        $model = new Map_aiModel();
        $info = $model->ai_jawab_chatGpt($pertanyaan);        
        return $info;
    }

    public function get_ndvi(){
            // Konfigurasi Google Earth Engine API
            $gee_project = "ee-andri4793maulana"; // Ganti dengan ID proyek Google Cloud Anda
            $gee_token = $this->getOAuthToken(); // Token OAuth untuk akses GEE

            // URL endpoint untuk Earth Engine API
            $gee_url = "https://earthengine.googleapis.com/v1/projects/$gee_project:exportImage";

            // JSON request untuk NDVI
            $request_data = [
                "expression" => [
                    "function" => "normalizedDifference",
                    "args" => [
                        "inputImage" => [
                            "function" => "Image",
                            "args" => [
                                "id" => "LANDSAT/LC08/C02/T1_TOA"
                            ]
                        ],
                        "bandNames" => ["B5", "B4"]
                    ]
                ],
                "fileFormat" => "GeoTIFF",
                "scale" => 30,
                "region" => [
                    "type" => "Polygon",
                    "coordinates" => [[[110.36, -7.8], [110.5, -7.8], [110.5, -7.9], [110.36, -7.9], [110.36, -7.8]]]
                ]
            ];

            // Kirim request ke Google Earth Engine API
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $gee_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $gee_token",
                "Content-Type: application/json"
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            // Ambil URL download
            $response_data = json_decode($response, true);
            $download_url = $response_data['name'] ?? "Error mendapatkan URL";

            // Kirimkan sebagai JSON response
            header('Content-Type: application/json');
            echo json_encode(["url" => $download_url]);
    }



    function getOAuthToken() {
        $keyFilePath = base_url(). '/assets/other/ndvi-453315-0eed18d01a7c.json'; // Ubah sesuai lokasi file JSON
        $credentials = json_decode(file_get_contents($keyFilePath), true);

        $jwtHeader = base64_encode(json_encode(["alg" => "RS256", "typ" => "JWT"]));
        $iat = time();
        $exp = $iat + 3600; // Berlaku 1 jam
        $jwtPayload = base64_encode(json_encode([
            "iss" => $credentials["client_email"],
            "scope" => "https://www.googleapis.com/auth/earthengine.readonly",
            "aud" => "https://oauth2.googleapis.com/token",
            "iat" => $iat,
            "exp" => $exp
        ]));

        $privateKey = openssl_pkey_get_private($credentials["private_key"]);
        openssl_sign("$jwtHeader.$jwtPayload", $signature, $privateKey, "sha256WithRSAEncryption");
        $jwtSignature = base64_encode($signature);
        $jwt = "$jwtHeader.$jwtPayload.$jwtSignature";

        $ch = curl_init("https://oauth2.googleapis.com/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            "grant_type" => "urn:ietf:params:oauth:grant-type:jwt-bearer",
            "assertion" => $jwt
        ]));

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $response["access_token"] ?? null;
    }


    public function test_ndvi(){

        $script_url = "https://script.google.com/macros/s/AKfycbyXXu5OnNuwFjs-0MiscvqWDr2c4UkQD-V7aRMqEZuuEODRE5bHInKbEIeDotvTqDha/exec"; // Ganti dengan URL Apps Script

        // // Panggil API Google Apps Script
        // $response = file_get_contents($script_url);
        // $data = json_decode($response, true);

        // // Kirimkan URL sebagai JSON
        // header('Content-Type: application/json');
        // echo json_encode(["url" => $data['url']]);

        // Panggil API Google Apps Script untuk mendapatkan URL download NDVI
        $response = file_get_contents($script_url);
        $data = json_decode($response, true);

        if (!isset($data['url'])) {
            die(json_encode(["error" => "Gagal mendapatkan URL NDVI"]));
        }

        $download_url = $data['url']; // URL dari GEE
        $local_file = "ndvi_result.tif"; // Nama file yang akan disimpan di lokal

        // Unduh file dari URL dan simpan ke server lokal
        $file_data = file_get_contents($download_url);
        if ($file_data === false) {
            die(json_encode(["error" => "Gagal mendownload file"]));
        }

        // Simpan file ke server
        file_put_contents($local_file, $file_data);

        // Kembalikan informasi file lokal
        header('Content-Type: application/json');
        echo json_encode(["local_url" => $local_file]);
    }


    public function saveJson()
    {
        $aiModel = new map_aiModel();

        $jsonData = $this->request->getPost();
        $jsonData = $jsonData['jsonData'];

        if ($jsonData) {
            //Simpan data ke database
            $data = [
                'title'      => $jsonData['title'] ?? '',
                'geojson'    => json_encode($jsonData['data']),
                'descriptions'=>$jsonData['desc'],
                'hashtag'    => $jsonData['hashtag'] ?? '',
                'updated_by' => $jsonData['updated_by'] ?? 'system',
            ];


            if ($aiModel->insert($data)) {
               echo json_encode(
                [
                    "status" => "success"
                ]);
            } else {
                echo json_encode(
                [
                    "status" => "error"
                ]);
            }
        }
    }

    public function get_mrc($reg='Query',$pertanyaan="Berapa pendapatan teh")
    {
        // Your Google Sheet ID (from the URL)
        $sheetId = '1IjvUT21_6CUA1K2wPdA53FtVnGHlyMfcsCBefoMRrc4';
        $sheetName = $reg; // Change if needed

        // Construct the URL to fetch the sheet as JSON
        $url = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:json&sheet={$sheetName}";

        // Fetch the data
        $response = file_get_contents($url);
        // echo "<pre>";
        // var_dump($response);
        // echo "</pre>";

        // Clean the response (Google wraps it in a function call)
        $json = substr($response, strpos($response, '{'), -2);
        $data = json_decode($json, true);

        // $data = $dataSheet['table'];

        $cols = array_column($data['table']['cols'], 'label');
        $rows = $data['table']['rows'];
        $formattedData = [];


        // $narasi = "Data MRC Produksi dengan Luasan TM Tebu Periode sampai dengan 31/01/2024 direalisasikan sebesar 200 Ha dengan target RKAP sebesar 250 Ha.";


        foreach ($rows as $row) {
            $rowData = [];
            foreach ($row['c'] as $index => $cell) {
                $label = $cols[$index];
                //if($cell['v']){
                    $rowData[$label] = $cell['v'] ?? null;
                    if($label=='Posting Date'){
                        $rowData[$label] = $cell['f'] ?? null;
                    }
                    
                //}
                
            }
            $formattedData[] = $rowData;

        }

        // $narator=array();
        // foreach($formattedData as $d){
        //     $narator[]="Data MRC ".$d["Kategori"]." dengan ".$d["Parameter"]." ".$d['Komoditi']." Periode ".$d['Periode']."-".$d['Posting Date']." di regional ".$d['Regional']." direalisasikan sebesar ".$d['Nilai']." dengan target RKAP sebesar ".$d['Baseline'];
        // }

        $narator=array();
        foreach($formattedData as $d){
            $narator[]="Data MRC ".$d["Kategori"]." dengan ".$d["Parameter"]." ".$d['Komoditi']." Periode ".$d['Periode']."-".$d['Posting Date']." direalisasikan sebesar ".$d['Nilai']." dengan target RKAP sebesar ".$d['Baseline'];
        }

        // #FILTER ARRAY DATA INFORMASI agar lebih efektif berdasarkan pertanyaan yang sesuai saja
        //$informasi = $this->filter_data_similar($narator,$pertanyaan);
        return json_encode($narator);
    }



    public function get_data_mrc($reg='Query',$pertanyaan="Berapa pendapatan teh")
    {
        // Your Google Sheet ID (from the URL)
        $sheetId = '1IjvUT21_6CUA1K2wPdA53FtVnGHlyMfcsCBefoMRrc4';
        $sheetName = $reg; // Change if needed

        // Construct the URL to fetch the sheet as JSON
        $url = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:json&sheet={$sheetName}";

        // Fetch the data
        $response = file_get_contents($url);
        // echo "<pre>";
        // var_dump($response);
        // echo "</pre>";

        // Clean the response (Google wraps it in a function call)
        $json = substr($response, strpos($response, '{'), -2);
        $data = json_decode($json, true);

        // $data = $dataSheet['table'];

        $cols = array_column($data['table']['cols'], 'label');
        $rows = $data['table']['rows'];
        $formattedData = [];


        // $narasi = "Data MRC Produksi dengan Luasan TM Tebu Periode sampai dengan 31/01/2024 direalisasikan sebesar 200 Ha dengan target RKAP sebesar 250 Ha.";


        foreach ($rows as $row) {
            $rowData = [];
            foreach ($row['c'] as $index => $cell) {
                $label = $cols[$index];
                //if($cell['v']){
                    $rowData[$label] = $cell['v'] ?? null;
                    if($label=='Posting Date'){
                        $rowData[$label] = $cell['f'] ?? null;
                    }
                    
                //}
                
            }
            $formattedData[] = $rowData;

        }

        $narator=array();
        foreach($formattedData as $d){
            if($d["Kategori"]=="")continue;
            $narator[]="Data MRC ".$d["Kategori"]." dengan ".$d["Parameter"]." ".$d['Komoditi']." Periode ".$d['Periode']."-".$d['Posting Date']." di regional ".$d['Regional']." direalisasikan sebesar ".$d['Nilai']." dengan target RKAP sebesar ".$d['Baseline'];
        }

        $info=$this->filter_data_similar($narator,$pertanyaan,70);
        return json_encode($info);
    }




    public function get_data_agraria($pertanyaan="Tampilkan HGU yang akan habis di bawah 1 tahun di regional 1")
    {

        //$pertanyaan= $this->request->getPost('tanya');
        // Your Google Sheet ID (from the URL)
        $sheetId = '120L9JOJvLh_8T422ny_t26yKG3lrJu6f6VMTuCBIIo0';
        $gid = "1991333975";

        // Construct the URL to fetch the sheet as JSON
        $url = "https://docs.google.com/spreadsheets/d/{$sheetId}/gviz/tq?tqx=out:json&gid={$gid}";

        // Fetch the data
        $response = file_get_contents($url);

        // Clean the response (Google wraps it in a function call)
        $json = substr($response, strpos($response, '{'), -2);
        $data = json_decode($json, true);

        // $data = $dataSheet['table'];

        $cols = array_column($data['table']['cols'], 'label');
        $rows = $data['table']['rows'];
        $formattedData = [];


        // $narasi = "Data MRC Produksi dengan Luasan TM Tebu Periode sampai dengan 31/01/2024 direalisasikan sebesar 200 Ha dengan target RKAP sebesar 250 Ha.";


        foreach ($rows as $row) {
            $rowData = [];
            foreach ($row['c'] as $index => $cell) {
                $label = $cols[$index];
                //if($cell['v']){
                    $rowData[$label] = $cell['v'] ?? null;
                    if($label=='Posting Date'){
                        $rowData[$label] = $cell['f'] ?? null;
                    }
                    
                //}
                
            }
            $formattedData[] = $rowData;

        }


        $narator=array();
        foreach($formattedData as $d){
            if($d["Status BPHTB"]=="")continue;

            $narator[] = "Dari data yang tersedia, status BPHTB adalah ".$d["Status BPHTB"].", di bawah Subholding ".$d["Subholding"]." regional ".$d["Region"]." eks ptpn ".$d["Eks PTPN"].". Sertifikat dengan nomor ".$d["No Sertifikat"]." dan identifikasi aset ".$d["No Identifikasi Aset (SAP Legal)"]." bernama ".$d["Nama Sertifikat"]." memiliki jenis hak ".$d["Jenis Hak"].", unit ".$d["Nama Unit"]." berlokasi di Desa ".$d["Desa"].", Kecamatan ".$d["Kecamatan"].", Kabupaten ".$d["Kabupaten"].", Provinsi ".$d["Provinsi"].", di pulau ".$d["Pulau"].". Komoditas: ".$d["Komoditas"].", luas ".$d["Luas (Ha)"]." ha, sebelumnya ".$d["Luas (Ha) sebelum"]." ha. Areal planted ".$d["Areal Planted (Ha)"]." ha, areal lain-lain ".$d["Areal Lain-lain (Ha)"]." ha, cadangan ".$d["Areal Lahan Kosong, Cadangan (Ha)"]." ha, jalan-jembatan ".$d["Areal Jalan, Jembatan (Ha)"]." ha, bangunan ".$d["Bangunan, Emplasment, Fasum, Fasos, dll (Ha)"]." ha, kanal ".$d["Kanal/Parit, Sungai, Jurang, Areal Rawa (Ha)"]." ha, konservasi ".$d["Konservasi/Kawasan Hutan (Ha) "]." ha. Areal kerjasama ".$d["Areal Kerjasama (Ha)"].", okupasi ".$d["Areal Okupasi (Ha)"].", okupasi berat ".$d["Okupasi Berat (Ha)"].", sedang ".$d["Okupasi Sedang (Ha)"].", ringan ".$d["Okupasi Ringan (Ha)"].". Jumlah bidang ".$d["Jumlah Bidang"].", status alas hak ".$d["Status Alas Hak"].". Sertifikat terbit pada ".$d["Tanggal Terbit Sertifikat Hak Atas Tanah"].", berakhir pada ".$d["Tanggal Berakhir Sertifikat Hak Atas Tan"].". Nilai buku Rp".$d["Nilai Buku (Rp)"].", NJOP Rp".$d["NJOP (Rp)"].", fair value ".$d["Fair Value"].". NOP ".$d["NOP"].", kode ".$d["Kode"].". Data per ".$d["Date Today"].". Masa berlaku sertifikat ".$d["Masa Berlaku Sertifikat"].", masih berlaku ".$d["Masa Berlaku Sertifikat yang Masih Berlaku"].". Urutan alas hak ".$d["Urutan Alas Hak"].". Link polygon ".$d["Link Polygon"].". Status penyelesaian BPHTB: ".$d["Status Penyelesaian BPHTB"].".";
        }




        $info=$this->filter_data_similar($narator,$pertanyaan,70,30);
        return json_encode($info);
    }


    private function filter_array_like(array $data, string $keyword, array $fields = []): array {
        $keyword = strtolower($keyword);
        $filtered = [];

        foreach ($data as $row) {
            foreach ($row as $key => $value) {
                // Kalau field-nya ditentukan, skip jika key-nya gak termasuk
                if (!empty($fields) && !in_array($key, $fields)) {
                    continue;
                }

                // Ubah ke string untuk pengecekan
                if (is_scalar($value) && stripos((string)$value, $keyword) !== false) {
                    $filtered[] = $row;
                    break; // ketemu match, lanjut ke row berikutnya
                }
            }
        }

        return $filtered;
    }


    private function filter_data_similar($informasi,$pertanyaan,$persen_kemiripan="70",$max_row="200"){
        // Tokenize pertanyaan
           
        //var_dump($informasi);
        $question_tokens = $this->tokenize($pertanyaan);
            


        $row_data = [];

        foreach ($informasi as $data) {
            $data_tokens = $this->tokenize($data);
            $similarity = $this->calculate_token_similarity($question_tokens, $data_tokens);
            
            if ($similarity > $persen_kemiripan) { // ambil jika similarity lebih dari $persen_kemiripan%
                $row_data[] = [
                    'data' => $data,
                    'similarity' => round($similarity, 2)
                ];
            }
        }

        // Urutkan dari similarity tertinggi
        usort($row_data, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        // var_dump($max_row);
        // echo "<hr>";

        // Output hasil
        if(count($row_data)<$max_row && $persen_kemiripan>0){
            $persen_kemiripan=$persen_kemiripan-0.5;
            // var_dump($persen_kemiripan);
            // echo "<hr>";
            return $this->filter_data_similar($informasi,$pertanyaan,$persen_kemiripan,$max_row);
        }else{
            //var_dump($persen_kemiripan);
            $filtered=array();
            $i=0;
            foreach($row_data as $d){
                if($i<$max_row)$filtered[]=$d['data'];
                $i++;
            }

            // var_dump("filtered data ".count($filtered)." panjang data ".strlen(implode('', $filtered)));
            // echo "<hr>";
            return $filtered;
        }

        
    }


    private function normalize($text) {
        // Ubah ke lowercase, hapus tanda baca
        $text = strtolower($text);
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
        return $text;
    }

    private function tokenize($text) {
        $text = $this->normalize($text);
        // Gabungkan kata + angka menjadi satu token
        preg_match_all('/(?:[a-z]+ \d+|\d+ [a-z]+|[a-z]+|\d+)/u', $text, $matches);

        return array_filter($matches[0]);
    }

    private function calculate_token_similarity($question_tokens, $data_tokens) {
        $match_count = 0;
        foreach ($question_tokens as $token) {
            if (in_array($token, $data_tokens)) {
                $match_count++;
            }
        }

        if(count($question_tokens)==0){
            return;
        }
        $similarity = $match_count / count($question_tokens) * 100;
        return $similarity;
    }




}

