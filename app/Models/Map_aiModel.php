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
