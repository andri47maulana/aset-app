<?php
namespace App\Controllers;
use App\Models\WeatherModel;
use Config\Database;


class Weather extends BaseController
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
        header("Location: " . "https://aset-dives-dev.ptpn1.co.id/map_ai?token=234kjjlksflk8y98ksafdklj23#");
        exit;


        //var_dump($this->getOAuthToken());
        // $infoModel = new WeatherModel();
        // $info = $infoModel->getCuaca();
        $info = '';
        return view('weather_vw', ["info" => $info]);
        //return view('aigri_vw', ["info" => $info]);
    }


    public function getData()
    {
        $model = new WeatherModel();
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
    //         return $result->getResult(); // Fetch results
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
        $reg=$this->request->getPost("regional");
        $wilayah= $this->request->getPost("wilayah");
        $model = new WeatherModel();
        $info = $model->getCuaca($reg,$wilayah);        
        return $this->response->setJSON(["info" => $info]);
    }


    public function ai_pahami(){
        $tanya = $this->request->getPost('tanya');
        if($tanya=='')$tanya="tampilkan data sekarang atau yang mendekati tetapi harus sesuai waktu yang tersedia saja";

        $sekarang = date('Y-m-d H:00:00');
        $role_system ='hari ini adalah '.$sekarang.',';
        $role_system.='jika ada lusa maka 2 hari dari sekarang,';
        $role_system.='Tampilkan data dalam dalam bentuk json dengan attribut yaitu waktu harus dengan format yyyy-mm-dd H:00:00,';
        $role_system.='waktu jam dalam satu hari hanya tersedia 00:00:00, 03:00:00, 06:00:00, 09:00:00, 12:00:00, 15:00:00, 18:00:00, 21:00:00 tampilkan yang paling mendekati salah satunya dengan format yyyy:mm:dd H:00:00,';
          //role_system+='Jika menunjukkan rentang tanggal buat lebih dari 1 json';
        $role_system.='tidak ada kalimat lain selain json';

        $pertanyaan = 'Pahami pertanyaan ini '.$tanya;


        $response =  $this->getResponseAi($role_system, $pertanyaan);

        if ($response !== null) {
            echo json_encode($response);
        } else {
            echo json_encode(["error" => "Tidak ada respons dari AI"]);
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


    public function ai_jelaskan($data="",$tanya="",$text_query=""){

        
        $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';

        $role_system .='jawaban hanya mengacu pada data yang diberikan,';
        $role_system .='jangan tampilkan dataset id pada jawaban';

        $pertanyaan = "berdasarkan pertanyaan ini ".$tanya.", jelaskan data ini ".$data." dengan jelas";

        $response = $this->getResponseAi3($role_system, $pertanyaan);
        $data_map = $this->get_gjson($data);

        if ($response != null) {
            echo json_encode(
                [
                    "status" => "success",
                    "response"  => $response,
                    "data"=>$data,
                    //"query" => $text_query,
                    //"data_map_query"=>$data_map['query'],
                    "data_map"=>$data_map['data']
                ]);
        } else {
            ai_jelaskan($data,$tanya,$text_query);
        }
    }


    public function ai_jawab(){
        $tanya = $this->request->getPost('tanya');

        
        $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';

        $pertanyaan = $tanya;

        $data = $this->getResponseAi4($role_system, $pertanyaan);
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


    // public function ai_response(){
    //     $tanya = $this->request->getPost('tanya');

    //     if ($tanya) {
    //         $tanya = $_POST['tanya'];
    //         $role_system ='Berikan informasi sesuai kebutuhan pertanyaan,';

    //         $pertanyaan = $tanya;

    //         $data = $this->getResponseAi4($role_system, $pertanyaan);
    //         $response = $data->data[0]->content[0]->text->value;
           
    //         if ($response != null) {
    //             echo json_encode(
    //                 [
    //                     "status" => "success",
    //                     "response"  => $response,
    //                     "data"=>$data,
    //                 ]);
    //         } else {
                
    //         }
    //     }
    // }

    public function ai_response(){
        $tanya = $this->request->getPost('tanya'); 

        if (!$tanya) {
            echo json_encode([
                "status" => "error",
                "message" => "Parameter 'tanya' tidak ditemukan"
            ]);
            return;
        }

        $role_system = 'Berikan informasi sesuai kebutuhan pertanyaan,';
        $pertanyaan = $tanya;

        $data = $this->getResponseAi4($role_system, $pertanyaan);

        if (!isset($data->data[0]->content[0]->text->value)) {
            echo json_encode([
                "status" => "error",
                "message" => "Gagal mendapatkan respons dari AI",
                "data" => $data
            ]);
            return;
        }

        $response = $data->data[0]->content[0]->text->value;

        echo json_encode([
            "status" => "success",
            "response"  => $response,
            "data" => $data,
        ]);
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


    public function getResponseAi($role_system, $pertanyaan){
        $model = new WeatherModel();
        $info = $model->fetchAIResponse($role_system, $pertanyaan);        
        return $info;
    }


    public function getResponseAi2($role_system, $pertanyaan){
        $model = new WeatherModel();
        $info = $model->fetch_ai_mistral_json($role_system, $pertanyaan);  
        //$info = $model->fetch_ai_chatGPT_json($role_system, $pertanyaan);      
        return $info;
    }

    public function getResponseAi3($role_system, $pertanyaan){
        $model = new WeatherModel();
        $info = $model->fetch_ai_mistral($role_system, $pertanyaan);
        //$info = $model->fetch_ai_chatGPT($role_system, $pertanyaan);        
        return $info;
    }

    public function getResponseAi4($role_system, $pertanyaan){
        $model = new WeatherModel();
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






  

}

