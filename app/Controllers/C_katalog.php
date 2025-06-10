<?php

namespace App\Controllers;

use App\Models\M_master_katalog;

class C_katalog extends BaseController
{

    public function index()
    {
        $this->masterkatalogModel = new M_master_katalog();

        $data = array(
            'katalog' => $this->masterkatalogModel->getAllBerandaWithoutLogin(4),
        );

        return view('suppco/main_katalog', $data);
    }

    public function get()
    {
        $role_id = session()->get('role_id');
        $region_id = session()->get('region_id');

        $regional = $this->request->getGet('regional_search');
        $jenis = $this->request->getGet('jenis_aset_search');
        $provinsi = $this->request->getGet('nama_provinsi_search');
        $kota = $this->request->getGet('nama_kabupaten_kota_search');
        $kecamatan = $this->request->getGet('nama_kecamatan_search');
        $luas_aset = $this->request->getGet('luas_wilayah');

        $search = [];

        if ($regional && $regional !== 'all') {
            $search['master_region_nama'] = $regional;
        }

        if ($jenis && $jenis !== 'all') {
            $search['master_jenis_aset_nama'] = $jenis;
        }

        if ($provinsi && $provinsi !== 'all') {
            $search['master_aset_nama_provinsi'] = $provinsi;
        }

        if ($kota && $kota !== 'all') {
            $search['master_aset_nama_kab_kota'] = $kota;
        }

        if ($kecamatan && $kecamatan !== 'all') {
            $search['master_aset_nama_kecamatan'] = $kecamatan;
        }

        if ($role_id == 10) {
            $search['master_aset.master_region_id'] = $region_id;
        }

        $limit = $this->request->getGet('limit') ? (int) $this->request->getGet('limit') : 4;
        $offset = (int) $this->request->getGet('page') * $limit;

        try {
            $table = $this->db->table('beranda_katalog')
                ->join('master_aset', 'master_aset.master_aset_id = beranda_katalog.master_aset_id', 'left')
                ->join('master_region', 'master_region.id_region = master_aset.master_region_id', 'left')
                ->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id', 'left')
                ->join('aset_potensial', 'aset_potensial.aset_potensial_aset_id = master_aset.master_aset_id')

                ->join('paket_kerjasama', 'paket_kerjasama.paket_kerjasama_aset_id = master_aset.master_aset_id', 'left')
                ->select('master_aset.*,  GROUP_CONCAT(`aset_potensial`.aset_potensial_status SEPARATOR ".") as aset_potensial_status, master_region.*, master_jenis_aset.*,COUNT(IF(paket_kerjasama.paket_kerjasama_nama IS NOT NULL AND paket_kerjasama.paket_kerjasama_nama != "", 1, NULL)) as pk,GROUP_CONCAT(paket_kerjasama.paket_kerjasama_nama SEPARATOR "##") as paket_kerjasama_nama')
                ->groupBy('beranda_katalog.master_aset_id')

                ->where('master_aset_active` != 2');

            if (count($search) > 0) {
                $table->where($search);
            }

            $data = $table->limit($limit, $offset)
                ->get()
                ->getResult();

            // var_dump($this->db->getLastQuery()->getQuery());
            // exit;

            $result = [];
            $asset_ids = array_column($data, 'master_aset_id');

            foreach ($data as $d) {
                if (!isset($d->sap_numbers)) {
                    $d->sap_numbers = [];
                }
                $file_path = FCPATH . 'assets/assets/koordinat/' . $d->master_aset_koordinat;
                $d->hasFile = $d->master_aset_koordinat_jenis && file_exists($file_path);

                if ($d->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                    $d->placemarks = json_encode($this->extract_placemarks_from_kml($file_path));
                }
                array_push($result, $d);
            }

            if (count($data) > 0) {

                $sap_numbers = $this->db->table('maia_masterlist')
                    ->join('detail_aset_sap', 'maia_masterlist.id = detail_aset_sap.sap_id', 'left')
                    ->select('maia_masterlist.nomor_aset, detail_aset_sap.master_aset_id, maia_masterlist.unit_id')
                    ->whereIn('detail_aset_sap.master_aset_id', $asset_ids)
                    ->get()
                    ->getResultArray();

                foreach ($sap_numbers as $numbers) {
                    $index = array_search($numbers['master_aset_id'], $asset_ids);
                    if ($index !== false) {
                        array_push($data[$index]->sap_numbers, $numbers);
                    }
                }
            }

            return $this->response->setContentType('application/json')
                ->setStatusCode(200)
                ->setJSON(['data' => $result]);
        } catch (Exception $e) {
            return $this->response->setContentType('application/json')
                ->setStatusCode(500)
                ->setJSON(['error' => $e->getMessage(), 'data' => []]);
        }
    }

    public function search()
    {
        // Get hasil search

        $role_id = session()->get('role_id');
        $region_id = session()->get('region_id');

        $regional = $this->request->getGet('regional_search');
        $jenis = $this->request->getGet('jenis_aset_search');
        $provinsi = $this->request->getGet('nama_provinsi_search');
        $kota = $this->request->getGet('nama_kabupaten_kota_search');
        $kecamatan = $this->request->getGet('nama_kecamatan_search');
        $luas_aset = $this->request->getGet('luas_aset_search');
        $katalog = $this->request->getGet('katalog_search');

        $search = [];

        if ($regional && $regional !== 'all') {
            $search['master_region_nama'] = $regional;
        }

        if ($jenis && $jenis !== 'all') {
            $search['master_jenis_aset_nama'] = $jenis;
        }

        if ($provinsi && $provinsi !== 'all') {
            $search['master_aset_nama_provinsi'] = $provinsi;
        }

        if ($kota && $kota !== 'all') {
            $search['master_aset_nama_kab_kota'] = $kota;
        }

        if ($kecamatan && $kecamatan !== 'all') {
            $search['master_aset_nama_kecamatan'] = $kecamatan;
        }

        if ($role_id == 10) {
            $search['master_aset.master_region_id'] = $region_id;
        }

        if ($luas_aset && $luas_aset !== 'all') {
            if ($luas_aset === 'lt5000') {
                $search['master_aset_luas_aset <'] = 5000;
            } elseif ($luas_aset === '5000-500000') {
                $search['master_aset_luas_aset >='] = 5000;
                $search['master_aset_luas_aset <='] = 500000;
            } elseif ($luas_aset === '500000-5000000') {
                $search['master_aset_luas_aset >='] = 500000;
                $search['master_aset_luas_aset <='] = 5000000;
            } elseif ($luas_aset === '5000000-10000000') {
                $search['master_aset_luas_aset >='] = 5000000;
                $search['master_aset_luas_aset <='] = 10000000;
            } elseif ($luas_aset === '5000000-10000000') {
                $search['master_aset_luas_aset >='] = 5000000;
                $search['master_aset_luas_aset <='] = 10000000;
            } elseif ($luas_aset === 'gt10000000') {
                $search['master_aset_luas_aset >'] = 10000000;
            }
        }

        $limit = $this->request->getGet('limit') ? (int) $this->request->getGet('limit') : 4;
        $offset = (int) $this->request->getGet('page') * $limit;

        try {
            $table = $this->db->table('beranda_katalog')
                ->join('master_aset', 'master_aset.master_aset_id = beranda_katalog.master_aset_id', 'left')
                ->join('master_region', 'master_region.id_region = master_aset.master_region_id', 'left')
                ->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id', 'left')
                ->join('aset_potensial', 'aset_potensial.aset_potensial_aset_id = master_aset.master_aset_id', 'left');

            if (count($search) > 0) {
                $table->where($search);
            }

            if ($katalog) {
                $table->like('master_aset.master_aset_nama', $katalog);
            }

            $data = $table->limit($limit, $offset)
                ->get()
                ->getResult();

            $result = [];
            $asset_ids = array_column($data, 'master_aset_id');

            foreach ($data as $d) {
                if (!isset($d->sap_numbers)) {
                    $d->sap_numbers = [];
                }
                $file_path = FCPATH . 'assets/assets/koordinat/' . $d->master_aset_koordinat;
                $d->hasFile = $d->master_aset_koordinat_jenis && file_exists($file_path);

                if ($d->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                    $d->placemarks = json_encode($this->extract_placemarks_from_kml($file_path));
                }
                array_push($result, $d);
            }

            if (count($data) > 0) {

                $sap_numbers = $this->db->table('maia_masterlist')
                    ->join('detail_aset_sap', 'maia_masterlist.id = detail_aset_sap.sap_id', 'left')
                    ->select('maia_masterlist.nomor_aset, detail_aset_sap.master_aset_id, maia_masterlist.unit_id')
                    ->whereIn('detail_aset_sap.master_aset_id', $asset_ids)
                    ->get()
                    ->getResultArray();

                foreach ($sap_numbers as $numbers) {
                    $index = array_search($numbers['master_aset_id'], $asset_ids);
                    if ($index !== false) {
                        array_push($data[$index]->sap_numbers, $numbers);
                    }
                }
            }

            return $this->response->setContentType('application/json')
                ->setStatusCode(200)
                ->setJSON(['data' => $result]);
        } catch (Exception $e) {
            return $this->response->setContentType('application/json')
                ->setStatusCode(500)
                ->setJSON(['error' => $e->getMessage(), 'data' => []]);
        }
    }

    public function getPlacemarks($id)
    {
        try {
            $data = $this->db->table('beranda_katalog')
                ->join('master_aset', 'master_aset.master_aset_id = beranda_katalog.master_aset_id', 'left')
                ->join('master_region', 'master_region.id_region = master_aset.master_region_id', 'left')
                ->join('master_jenis_aset', 'master_jenis_aset.master_jenis_aset_id = master_aset.master_jenis_aset_id', 'left')
                ->where('master_aset.master_aset_id', $id)
                ->where('master_aset_active` != 2')

                ->join('paket_kerjasama', 'paket_kerjasama.paket_kerjasama_aset_id = master_aset.master_aset_id', 'left')
                ->select('master_aset.*,  GROUP_CONCAT(`aset_potensial`.aset_potensial_status SEPARATOR ".") as aset_potensial_status, master_region.*, master_jenis_aset.*,COUNT(IF(paket_kerjasama.paket_kerjasama_nama IS NOT NULL AND paket_kerjasama.paket_kerjasama_nama != "", 1, NULL)) as pk,GROUP_CONCAT(paket_kerjasama.paket_kerjasama_nama SEPARATOR "##") as paket_kerjasama_nama')
                ->groupBy('beranda_katalog.master_aset_id')

                ->select('master_aset_koordinat, master_aset_koordinat_jenis')
                ->get()->getRow();

            $file_path = FCPATH . 'assets/assets/koordinat/' . $data->master_aset_koordinat;
            $result = [];

            if ($data->master_aset_koordinat_jenis === 'Upload KML/GPX' && file_exists($file_path)) {
                array_push($result, json_encode($this->extract_placemarks_from_kml($file_path)));
            } else {
                $coordinates = explode(",", str_replace(" ", "", $data->master_aset_koordinat));
                $obj = new \stdClass();
                $obj->type = 'Point';
                $obj->name = $data->master_aset_nama;
                $obj->latitude = $coordinates[0];
                $obj->longitude = $coordinates[1];
                array_push($result, json_encode([$obj]));
            }

            $result = file_exists($file_path) ? json_encode($this->extract_placemarks_from_kml($file_path)) : null;

            return $this->response->setContentType('application/json')
                ->setStatusCode(200)
                ->setJSON(['data' => $result]);
        } catch (Exception $e) {
            return $this->response->setContentType('application/json')
                ->setStatusCode(500)
                ->setJSON(['error' => $e->getMessage(), 'data' => []]);
        }
    }

    private function extract_placemarks_from_kml($file_path)
    {
        $xml = new \DOMDocument();
        $xml->load($file_path);
        $placemarks = [];

        $placemarkNodes = $xml->getElementsByTagName('Placemark');
        foreach ($placemarkNodes as $placemarkNode) {
            $name = $placemarkNode->getElementsByTagName('name')->item(0)->nodeValue;

            $pointNode = $placemarkNode->getElementsByTagName('Point')->item(0);
            $lineStringNode = $placemarkNode->getElementsByTagName('LineString')->item(0);
            $polygonNode = $placemarkNode->getElementsByTagName('Polygon')->item(0);

            if ($pointNode) {
                $coordinatesStr = $pointNode->getElementsByTagName('coordinates')->item(0)->nodeValue;
                $coordinatesArr = explode(',', $coordinatesStr);

                if (count($coordinatesArr) >= 2) {
                    $latitude = trim($coordinatesArr[1]);
                    $longitude = trim($coordinatesArr[0]);
                    $placemarks[] = [
                        'type' => 'Point',
                        'name' => $name,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                    ];
                }
            } elseif ($lineStringNode) {
                $coordinatesStr = $lineStringNode->getElementsByTagName('coordinates')->item(0)->nodeValue;
                $coordinatesArr = explode(' ', trim($coordinatesStr));

                if (!empty($coordinatesArr)) {
                    $lineCoordinates = [];
                    foreach ($coordinatesArr as $coordinate) {
                        $coordinateArr = explode(',', $coordinate);
                        if (count($coordinateArr) >= 2) {
                            $latitude = trim($coordinateArr[1]);
                            $longitude = trim($coordinateArr[0]);
                            $lineCoordinates[] = [
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                            ];
                        }
                    }
                    $placemarks[] = [
                        'type' => 'LineString',
                        'name' => $name,
                        'coordinates' => $lineCoordinates,
                    ];
                }
            } elseif ($polygonNode) {
                $coordinatesStr = $polygonNode->getElementsByTagName('coordinates')->item(0)->nodeValue;
                $coordinatesArr = explode(' ', trim($coordinatesStr));

                if (!empty($coordinatesArr)) {
                    $polygonCoordinates = [];
                    foreach ($coordinatesArr as $coordinate) {
                        $coordinateArr = explode(',', $coordinate);
                        if (count($coordinateArr) >= 2) {
                            $latitude = trim($coordinateArr[1]);
                            $longitude = trim($coordinateArr[0]);
                            $polygonCoordinates[] = [
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                            ];
                        }
                    }
                    $placemarks[] = [
                        'type' => 'Polygon',
                        'name' => $name,
                        'coordinates' => $polygonCoordinates,
                    ];
                }
            }
        }

        return $placemarks;
    }
}
