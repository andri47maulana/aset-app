<?php
namespace App\Models;

use CodeIgniter\Model;

class Map_aiModel extends Model
{
    protected $table      = 'map_dataset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'geojson', 'descriptions','hashtag', 'updated_by'];

    public function getLokasi()
    {
        return $this->findAll();
    }


    public function getCuacaBMKG($reg,$wilayah){

        $kode = $this->formatString($wilayah);
        $level = count(explode(".", $wilayah));
        $url = "https://api.bmkg.go.id/publik/prakiraan-cuaca?adm".$level."=".$kode; // API contoh
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }


    public function getHRIS($tanya){
        $db2 = \Config\Database::connect('hris');

        $query  = $db2->query("DESCRIBE dataset_pegawai");
        $result = $query->getResultArray(); 
        $struktur= json_encode($result);

        $dataset_name = 'dataset_pegawai';
        $dataset_id   = 'pegawai_id';

        $query  = $db2->query("select * from dataset_pegawai order by updated_date desc limit 1");
        $result = $query->getResultArray(); 
        $row= json_encode($result);

        $role_system = $this->role_prompt_chart($dataset_name,$struktur,$row,$dataset_id);

        $pertanyaan = 'Buatkan query mysql yang sesuai untuk menjawab pertanyaan ini: '.$tanya;

        $response =  $this->fetch_ai_mistral_json($role_system, $pertanyaan);

        if ($response !== null) {
            $query  = $db2->query($response['query']);
            $data = json_encode($query->getResultArray()); 
            $data_arr=$query->getResultArray();
            $text_query = $db2->getLastQuery()->getQuery();


            $arrayData = json_decode($data, true);

            // Cek apakah array kosong
            if (empty($arrayData)) {
                return 
                [
                    "status" => "empty",
                    "info"   => "arrayData empty",
                    "query" => $text_query,
                    "data" => [],
                    "response"=>[]
                ];
            } else {

                return 
                [
                    "status" => "success",
                    "info"   => "data exist",
                    "query" => $text_query,
                    "data" => $data,
                    "response"=>$response
                ];
            }
           
        } else {
            return [
                "status" => "failed",
                "info"   => "Not Response (LLM)",
                "query" => $response,
                "response"=>[]
            ];
        }

    }


    private function role_prompt_chart($dataset_name,$struktur,$row,$dataset_id){
        $role_system  ='anda adalah ai generator mysql query,';
        $role_system .= 'ouput hasil querynya akan digunakan untuk data chart yang membutuhkan data categories dan series,';
        $role_system .= 'saya memiliki table '.$dataset_name.' dengan struktur table mysql seperti ini '.$struktur.' dan contoh data seperti ini '.$row.',';
        $role_system .= 'tampilkan hanya dalam bentuk query,';
        $role_system .= "pilih field yang paling sesuai dengan pertanyaan saja,";
        //$role_system .= "selalu sertakan field ".$dataset_id." dengan nama dataset_id di setiap rownya,";
        $role_system .= "pilih minimal 2 field table yang paling sesuai dengan kebutuhan pertanyaan,";
        $role_system .= "pilih field yang tersedia saja, jika butuh total atau jumlah gunakan count jika isinya bukan angka atau sum jika isinya angka,";
        $role_system .= "Batasi hanya 30 data saja,";
        //$role_system .= "Group kan datanya dan concat/comma join setiap isi dari field ".$dataset_id;

        $role_system .= "gunakan like untuk kata-kata yang akan dicari,";
        $role_system .= "di mana hanya pegawai dengan status_pegawai = 'Aktif' atau status_pegawai='Active',";
        $role_system .= "Kelompokkan data berdasarkan tahun dari kolom tanggal_pensiun, dan untuk setiap tahun tampilkan tahun pensiun (YEAR(tanggal_pensiun)),";
        //$role_system .= "daftar pegawai_id dalam satu baris menggunakan GROUP_CONCAT, dan jumlah pegawai (COUNT(pegawai_id)),";
        $role_system .= "gunakan like untuk kata-kata yang akan dicari,";

        $role_system .='masukkan query ke dalam bentuk json dengan nama query';

        return $role_system;

    }


    private function role_prompt_chart2($dataset_name,$struktur,$row,$dataset_id){
        $role_system  ='anda adalah ai generator mysql query yang menggenerate 2 query, query1 dan query2';
        $role_system .= 'ouput hasil querynya akan digunakan untuk data chart yang membutuhkan data categories dan series,';
        $role_system .= 'saya memiliki table '.$dataset_name.' dengan struktur table mysql seperti ini '.$struktur.' dan contoh data seperti ini '.$row.',';
        $role_system .= 'tampilkan hanya dalam bentuk query,';
        $role_system .= "pilih field yang paling sesuai dengan pertanyaan saja,";
        $role_system .= "selalu sertakan field ".$dataset_id." dengan nama dataset_id di setiap rownya,";
        $role_system .= "pilih minimal 2 field table yang paling sesuai dengan kebutuhan pertanyaan,";
        $role_system .= "pilih field yang tersedia saja, jika butuh total atau jumlah gunakan count jika isinya bukan angka atau sum jika isinya angka,";
        $role_system .= "Batasi hanya 30 data saja,";
        $role_system .= "Group kan datanya dan concat/comma join setiap isi dari field ".$dataset_id;

        $role_system .= "gunakan like untuk kata-kata yang akan dicari,";
        $role_system .= "di mana hanya pegawai dengan status_pegawai = 'Aktif',";
        $role_system .= "Kelompokkan data berdasarkan tahun dari kolom tanggal_pensiun, dan untuk setiap tahun tampilkan tahun pensiun (YEAR(tanggal_pensiun)),";
        $role_system .= "khusus query2 buat isi field pegawai_id dalam satu baris menggunakan GROUP_CONCAT, dan jumlah pegawai (COUNT(pegawai_id)),";
        $role_system .= "gunakan like untuk kata-kata yang akan dicari,";

        $role_system .='masukkan query1 ke dalam bentuk json dengan nama query';
        $role_system .='masukkan query2 ke dalam bentuk json dengan nama query2';

        return $role_system;

    }


    private function role_prompt_data($dataset_name,$struktur,$row,$dataset_id){
        $role_system  ='anda adalah ai generator mysql query,';
        $role_system  .='saya memiliki table '.$dataset_name.' dengan struktur table mysql seperti ini '.$struktur.' dan contoh data seperti ini '.$row.',';
        $role_system .='tampilkan hanya dalam bentuk query,';
        $role_system .= "pilih field yang paling sesuai dengan pertanyaan saja,";
        $role_system .= "selalu sertakan field ".$dataset_id." dengan nama dataset_id di setiap rownya,";
        $role_system .= "pilih minimal 2 field table yang paling sesuai dengan kebutuhan pertanyaan,";
        $role_system .= "pilih field yang tersedia saja, jika butuh total atau jumlah gunakan count jika isinya bukan angka atau sum jika isinya angka,";
        $role_system .= "Batasi hanya 10 data saja,";

        $role_system .= "gunakan like untuk kata-kata yang akan dicari";
        $role_system .='masukkan query ke dalam bentuk json dengan nama query';
        return $role_system;

    }


    public function fetchAIResponse($role_system, $pertanyaan) {//untuk data konstan
        $url = "https://api.mistral.ai/v1/chat/completions";
        $apiKey = "qeizZBqCXZjpY4LpyXt7ZeSrzalHutvU"; // Ganti dengan API Key Anda
        
        $data = [
            "model" => "mistral-small-latest", // Bisa ganti ke model lain
            "temperature" => 0.1,
            "messages" => [
                ["role" => "system", "content" => $role_system],
                ["role" => "user", "content" => $pertanyaan]
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
        
        if ($response && $httpCode === 200) {
            $responseData = json_decode($response, true);
            
            if (isset($responseData["choices"][0]["message"]["content"])) {
                return $this->cleanJSON($responseData["choices"][0]["message"]["content"]);
            }
        }
        
        return null; // Pastikan null dikembalikan jika gagal
    }


    public function fetch_ai_mistral_json($role_system, $pertanyaan) {//untuk data output json
        $url = "https://api.mistral.ai/v1/chat/completions";
        $apiKey = "qeizZBqCXZjpY4LpyXt7ZeSrzalHutvU"; // Ganti dengan API Key Anda
        
        $data = [
            "model" => "mistral-small-latest", // Bisa ganti ke model lain
            "temperature" => 0.1,
            "messages" => [
                ["role" => "system", "content" => $role_system],
                ["role" => "user", "content" => $pertanyaan]
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
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // Maksimum waktu koneksi 10 detik
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($response && $httpCode === 200) {
            $responseData = json_decode($response, true);

            if (isset($responseData["choices"][0]["message"]["content"])) {
                return $this->cleanJSON($responseData["choices"][0]["message"]["content"]);
            }
        }
        
        return null; // Pastikan null dikembalikan jika gagal
    }


     public function fetch_ai_chatGPT_json($role_system, $pertanyaan)
        {
            // key
            $url = "https://api.openai.com/v1/chat/completions";
            $apiKey = env('OPENAI_API_KEY');

            // Endpoint OpenAI            

            // Data yang dikirim ke OpenAI
            $data = [
                "model" => "gpt-4",
                "messages" => [
                    ["role" => "system", "content" => $role_system],
                    ["role" => "user", "content" => $pertanyaan]
                ],
                "temperature" => 0.7
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
            
            if ($response && $httpCode === 200) {
                $responseData = json_decode($response, true);

                if (isset($responseData["choices"][0]["message"]["content"])) {
                    return $this->cleanJSON($responseData["choices"][0]["message"]["content"]);
                }
            }
            
            return null; // Pastikan null dikembalikan jika gagal
        }


    public function fetch_ai_mistral($role_system, $pertanyaan) {//untuk output narasi/text
        $url = "https://api.mistral.ai/v1/chat/completions";
        $apiKey = "qeizZBqCXZjpY4LpyXt7ZeSrzalHutvU"; 
        
        $data = [
            "model" => "mistral-small-latest", 
            "temperature" => 0.6,
            "messages" => [
                ["role" => "system", "content" => $role_system],
                ["role" => "user", "content" => $pertanyaan]
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
        
        if ($response && $httpCode === 200) {
            $responseData = json_decode($response, true);

            if (isset($responseData["choices"][0]["message"]["content"])) {
                return $responseData["choices"][0]["message"]["content"];
            }
        }
        
        //echo $pertanyaan;
        return null; // Pastikan null dikembalikan jika gagal
    }



    // public function fetch_ai_chatGPT($role_system, $pertanyaan) {//untuk output narasi/text
    //     // key
    //         $url = "https://api.openai.com/v1/chat/completions";
    //         $apiKey = env('OPENAI_API_KEY');

    //         // Endpoint OpenAI            

    //         // Data yang dikirim ke OpenAI
    //         $data = [
    //             "model" => "gpt-4",
    //             "messages" => [
    //                 ["role" => "system", "content" => $role_system],
    //                 ["role" => "user", "content" => $pertanyaan]
    //             ],
    //             "temperature" => 0.7
    //         ];

    //         $headers = [
    //             "Content-Type: application/json",
    //             "Authorization: Bearer $apiKey"
    //         ];
        
        
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 50); // Maksimum waktu tunggu respons 30 detik
    //     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // Maksimum waktu koneksi 10 detik
        
    //     $response = curl_exec($ch);
    //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     curl_close($ch);
        
    //     if ($response && $httpCode === 200) {
    //         $responseData = json_decode($response, true);

    //         if (isset($responseData["choices"][0]["message"]["content"])) {
    //             return $responseData["choices"][0]["message"]["content"];
    //         }
    //     }
        
    //     //echo $pertanyaan;
    //     return null; // Pastikan null dikembalikan jika gagal
    // }


    function cleanJSON($jsonString) {
        // 1. Menghapus karakter aneh seperti backticks (`) atau spasi ekstra
        $jsonString = trim(str_replace(["```json", "```"], "", $jsonString));
        
        // 2. Parsing JSON agar valid
        $jsonData = json_decode($jsonString, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            return $jsonData;
        } else {
            error_log("Error parsing JSON: " . json_last_error_msg());
            return null;
        }
    }


    private function formatString($str) {
        $parts = explode('.', $str); // Memisahkan berdasarkan titik
        $lastIndex = count($parts) - 1; // Indeks terakhir dalam array

        // Memastikan bagian terakhir memiliki 2 digit
        $parts[$lastIndex] = str_pad($parts[$lastIndex], 2, '0', STR_PAD_RIGHT);

        return implode('.', $parts); // Menggabungkan kembali menjadi string
    }


    function ai_jawab_chatGpt($pertanyaan){
        $api_key = env('OPENAI_API_KEY');
        $assistant_id = env('assistant_id');

        // 1. Membuat Thread Baru
        $thread_url = "https://api.openai.com/v1/threads";
        $thread_response = $this->curlPostRequest($thread_url, $api_key, []);

        $thread_response = json_decode($thread_response);

        $thread_id = json_decode($thread_response, true)['id'];

        if (!$thread_id) {
            return "Gagal membuat thread.";
        }

        // 2. Mengirim Pesan ke Thread
        $message_url = "https://api.openai.com/v1/threads/$thread_id/messages";
        $message_data = [
            "role" => "user",
            "content" => $pertanyaan
        ];
        $this->curlPostRequest($message_url, $api_key, $message_data);

        // 3. Menjalankan Asisten di Thread
        $run_url = "https://api.openai.com/v1/threads/$thread_id/runs";
        $run_data = [
            "assistant_id" => $assistant_id
        ];
        $this->curlPostRequest($run_url, $api_key, $run_data);

        // 4. Mendapatkan Respons Asisten
        sleep(15); // Tunggu beberapa detik agar OpenAI memproses respons
        $response_url = "https://api.openai.com/v1/threads/$thread_id/messages";
        $response = $this->curlGetRequest($response_url, $api_key);

        //echo "Respons dari asisten: \n";
        return $response;
    }


    /**
     * Fungsi untuk melakukan permintaan HTTP POST dengan cURL
     */
    function curlPostRequest($url, $api_key, $data)
        {

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",
                "Authorization: Bearer $api_key",
                "OpenAI-Beta: assistants=v2" 
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60); // Maksimum waktu tunggu respons 30 detik
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); // Maksimum waktu koneksi 10 detik
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            //var_dump($response);
            if ($response && $httpCode === 200) {
                return json_encode($response);
            }
            
            //echo $pertanyaan;
            return json_encode(["error" => "Request failed with HTTP Code " . $httpCode]);

            //return null; // Pastikan null dikembalikan jika gagal
        }

        /**
         * Fungsi untuk melakukan permintaan HTTP GET dengan cURL
         */
    function curlGetRequest($url, $api_key)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $api_key",
                "OpenAI-Beta: assistants=v2" 
            ]);



            //curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Maksimum waktu tunggu respons 30 detik
            //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // Maksimum waktu koneksi 10 detik
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($response && $httpCode === 200) {
                return json_decode($response);
            }
            
            //echo $pertanyaan;
            return json_encode(["error" => "Request failed with HTTP Code " . $httpCode]);

            //return null; // Pastikan null dikembalikan jika gagal
        }


    
}
