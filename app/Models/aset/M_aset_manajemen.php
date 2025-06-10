<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_aset_manajemen extends Model
{
    protected $table = 'amanat_sap';
    protected $primaryKey = 'sap_id';
    protected $allowedFields = [
        'sap_id',
        'kode_perusahaan',
        'nomor_aset',
        'class_aset',
        'grup_aset',
        'kode_aset_rehab',
        'sap_deskripsi',
        'nama_aset',
        'area',
        'kabupaten_kota',
        'provinsi',
        'unit_id',
        'tgl_oleh',
        'masa_susut',
        'quantity_luas_jumlah_ha',
        'quantity_satuan_sap',
        'nomor_perjanjian_pinjaman',
        'nomor_sertifikat_hak_tanggungan',
        'nilai_oleh_tahun_lalu',
        'nilai_penyusutan_tahun_lalu',
        'nilai_buku_tahun_lalu',
        'nilai_oleh_berjalan',
        'nilai_penyusutan_berjalan',
        'nilai_buku_berjalan',
        'keterangan_kondisi_aset',
        'kso',
        'komoditi_kso',
        'nama_mitra_kso',
        'nilai_residu',
        'keterangan',
        'unit_desc',
        'nilai_oleh',
        'nilai_penyusutan'
    ];

    // kml
    public function getAsetKml($id)
    {
        return $this->select('sap_id, nomor_aset, sap_deskripsi,amanat_sap.unit_id, unit_desc, nilai_oleh, nilai_residu, tgl_oleh, masa_susut, class_aset, grup_aset, nama_aset, nilai_penyusutan, keterangan')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->where('amanat_sap.nomor_aset', $id) // Ubah kondisi WHERE untuk mencocokkan 'sap_desc'
            ->get()
            ->getRow();
    }

    public function editAmanatData($id)
    {
        return $this->select('amanat_sap.sap_id, kode_perusahaan, nomor_aset, sap_deskripsi, unit_desc, nilai_oleh, amanat_sap.quantity_luas_jumlah_ha, nilai_residu, tgl_oleh, masa_susut, class_aset, grup_aset, nama_aset, nilai_penyusutan, keterangan, amanat_unit.unit_id,
                            nomor_perjanjian_pinjaman, nomor_sertifikat_hak_tanggungan, nilai_oleh_tahun_lalu, nilai_oleh_berjalan, nilai_penyusutan_tahun_lalu,
                            nilai_penyusutan_berjalan, nilai_buku_tahun_lalu, nilai_buku_berjalan, keterangan_kondisi_aset, kso, komoditi_kso, kode_aset_rehab, area, kabupaten_kota, provinsi,
                            nama_mitra_kso')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->where('amanat_sap.sap_id', $id)
            ->get()
            ->getRow();
    }

    public function editAmanathistorical($id)
    {
        return $this->select('sap_id, nomor_aset, sap_deskripsi,amanat_sap.unit_id, unit_desc, nilai_oleh, nilai_residu, tgl_oleh, masa_susut, class_aset, grup_aset, nama_aset, nilai_penyusutan, keterangan')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->where('amanat_sap.nomor_aset', $id) // Ubah kondisi WHERE untuk mencocokkan 'sap_desc'
            ->get()
            ->getRow();
    }



    public function updateJumlahAset()
    {
        $query = $this->query('UPDATE amanat_unit AS au
            LEFT JOIN (
              SELECT unit_id, COUNT(unit_id) AS total_aset_sap
              FROM amanat_sap
              GROUP BY unit_id
            ) AS asap ON au.unit_id = asap.unit_id
            SET au.total_aset_sap = COALESCE(asap.total_aset_sap, 0);');

        return $query;
    }

    public function getSAPdata()
    {
        return $this->select("nomor_aset")->get()->getResultArray();
    }
    public function getUnitData()
    {
        return $this->db->table('amanat_unit')->get()->getResultArray();
    }

    public function getRegionData()
    {

        return $this->db->table('master_region')->get()->getResultArray();
    }

    public function getPerusahaanData()
    {
        $query = $this->db->table('master_perusahaan');
        return $query->get()->getResultArray();
    }

    public function getPerusahaanSession()
    {
        // Kode ini digunakan untuk mengambil data perusahaan yang sesuai dengan session perusahaan yang ada
        // Jika session perusahaan tidak ada maka akan mengambil semua data perusahaan
        $kode = session()->get('perusahaan_kode');

        $query = $this->db->table('master_perusahaan');
        if ($kode == 'PTPN1' || $kode == 'PTPN4' || $kode == 'SGN') {
            $query->where('master_perusahaan_kode', $kode);
        } elseif ($kode == 'PTPN3' || $kode == 'SU') {
            return $query->get()->getResultArray();
        }

        return $query->get()->getResultArray();
    }

    public function getSelectOptionRegion($companycode = '')
    {
        $query = $this->db->table('master_region');
        $query->select('id_region, master_region_nama, master_region_perusahaan_kode');
        $query->orderBy('master_region_nama', 'ASC');

        if ($companycode == 'SU' || $companycode == 'HOLDING') {
            return $query->get()->getResultArray();
        }

        return $query->where('master_region_perusahaan_kode', $companycode)
            ->get()
            ->getResultArray();
    }

    public function getMasterRegionNama($id_region = '')
    {
        $query = $this->db->table('master_region');
        $query->select('id_region, master_region_nama');
        $query->where('id_region', $id_region);
        $query->orderBy('master_region_nama', 'ASC');

        return $query->get()->getResultArray();
    }


    public function getRegionSession($kode = '')
    {
        $query = $this->db->table('master_region');
        if ($kode != '') {
            $query->where('master_region_perusahaan_kode', $kode);
        }

        return $query->get()->getResultArray();
    }

    public function getAsetClass()
    {
        return $this->db->table('aset_kode')->get()->getResultArray();
    }

    public function getClassAsset()
    {
        return $this->db->table('aset_kode')
            ->select('aset_class, aset_desc')
            ->groupBy('aset_class, aset_desc')
            ->get()
            ->getResultArray();
    }

    public function getAsetDesc()
    {
        return $this->db->table('aset_kode')->select("aset_desc")->groupBy('aset_desc')->where("aset_desc IS NOT NULL AND TRIM(aset_desc) != ''")
            ->get()->getResultArray();
    }

    public function getAsetGroup()
    {
        return $this->db->table('aset_kode')->select("aset_group")->groupBy('aset_group')->where("aset_group IS NOT NULL AND TRIM(aset_group) != ''")
            ->get()->getResultArray();
    }

    public function deleteAmanatData($id)
    {
        return $this->db->table('amanat_sap')->where('sap_id', $id)->delete();
    }

    public function getupdate($id, $data)
    {
        return $this->where('sap_id', $id)->set($data)->update();
    }

    public function getOneSap($id)
    {

        return $this->select('sap_id, nomor_aset, amanat_sap.unit_id, amanat_sap.sap_deskripsi, unit_desc,id_region, nilai_oleh, nilai_residu, tgl_oleh, masa_susut, class_aset, grup_aset, nama_aset, nilai_penyusutan, keterangan')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->where("sap_id", $id)
            ->first();
    }

    public function cekDataSap($nomor_aset)
    {
        $builder = $this->select('amanat_sap.sap_id, amanat_kml.nomor_aset,amanat_kml.class_aset, amanat_kml.grup_aset,amanat_sap.sap_deskripsi, amanat_sap.area, kabupaten_kota,
                                      provinsi, areal_statement_satuan_ha, areal_statement_luas, jenis_alas_hak, luas_alas_hak, status_alas_hak, nilai_oleh_berjalan, nilai_buku_berjalan
                                      nilai_oleh, nilai_residu, tgl_oleh, masa_susut,  nama_aset, 
                                      nilai_penyusutan_berjalan, keterangan, kml_id')
            ->join('amanat_kml', 'amanat_sap.nomor_aset = amanat_kml.nomor_aset', 'right')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left') // Added left join to master_region
            ->where('amanat_kml.nomor_aset', $nomor_aset)
            ->distinct();

        // Get the data
        $data = $builder->orderBy('amanat_sap.tgl_oleh', 'DESC')
            ->get()
            ->getResultArray();

        return [
            'result' => $data,
        ];
    }

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('amanat_sap.sap_id, amanat_kml.nomor_aset, amanat_sap.sap_deskripsi, amanat_sap.area, master_region_nama, 
                                    nilai_oleh, nilai_residu, tgl_oleh, masa_susut, amanat_sap.class_aset, amanat_sap.grup_aset, nama_aset, 
                                    nilai_penyusutan_berjalan, keterangan, amanat_kml.kml_id')
            ->join('amanat_kml', 'amanat_sap.nomor_aset = amanat_kml.nomor_aset', 'right')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->join('master_region', 'amanat_unit.id_region = master_region.id_region', 'left') // Added left join to master_region
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('amanat_sap.nomor_aset', $katakunci)
                ->orLike('amanat_sap.sap_deskripsi', $katakunci)
                ->orLike('amanat_unit.unit_desc', $katakunci)
                ->groupEnd();
        }

        $hak_akses = session()->get("hak_akses_id");
        $unit_id = session()->get("unit_id");
        $id_region = session()->get("id_region");

        $builder->where("amanat_sap.unit_id", 105);
        $builder->where("amanat_kml.id_region", 4);
        // if ($hak_akses == 1 || ($hak_akses >= 3 && $hak_akses <= 7)) {
        //     $builder->where("amanat_sap.unit_id", $unit_id);
        // }

        // if ($hak_akses == 11) {
        //     $builder->where("amanat_unit.id_region", $id_region);
        // }

        // Get total records count
        $totalRecords = $builder->countAllResults(false);

        /// Apply length and start for pagination
        if ($length > 0) {
            $builder->limit($length, $start);
        }

        // Get filtered records count
        $filteredRecords = $builder->countAllResults(false);

        // Get the data
        $data = $builder->orderBy('amanat_sap.tgl_oleh', 'DESC')
            ->get()
            ->getResultArray();

        // Encrypt sap_id
        // $encrypter = \Config\Services::encrypter();

        // Store the cipher method
        $ciphering = "AES-128-CTR";

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';

        // Store the encryption key
        $encryption_key = "perdanamain";

        for ($i = 0; $i < count($data); $i++) {
            // $data[$i]["encrypt_nomor_aset"] = password_hash($data[$i]["nomor_aset"], PASSWORD_BCRYPT);
            $data[$i]["encrypt_nomor_aset"] = openssl_encrypt(
                $data[$i]["nomor_aset"],
                $ciphering,
                $encryption_key,
                $options,
                $encryption_iv
            );
            $data[$i]["encrypt_sap_id"] = openssl_encrypt(
                $data[$i]["sap_id"],
                $ciphering,
                $encryption_key,
                $options,
                $encryption_iv
            );

            // hapus karakter "/"
            // $data[$i]["encrypt_nomor_aset"] = strtr($data[$i]["encrypt_nomor_aset"], array("/"=>"=="));
        }

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data,
        ];
    }

    public function insertData($data)
    {
        $this->insert($data);
    }

    public function checkDuplicate($sap_desc)
    {
        return $this->where('sap_desc', $sap_desc)->countAllResults() > 0;
    }

    public function getRegionNameById($id_region)
    {
        return $this->db->table('master_region')
            ->select('master_region_nama')
            ->where('id_region', $id_region)
            ->get()
            ->getRow();
    }
}
