<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_aset_masterlist extends Model
{
    protected $table = 'maia_masterlist';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_perusahaan', 'nomor_aset', 'kode_aset_rehab', 'anakan_ke',
        'class_aset', 'grup_aset', 'deskripsi_aset', 'kelompok_aset',
        'unit_id', 'id_region', 'kabupaten_kota', 'provinsi', 'tgl_oleh',
        'umur_ekonomis', 'nilai_residu', 'areal_statement_luas', 'areal_statement_satuan',
        'quantity_luas', 'quantity_satuan', 'titik_koordinat', 'jenis_alas_hak', 
        'nomor_alas_hak', 'luas_alas_hak', 'status_alas_hak', 'tahapan_perpanjangan',
        'tgl_akhir_sertifikat', 'izin_pengalihan', 'nomor_izin_pengalihan', 'kkpr',
        'status_jaminan', 'no_perjanjian_pinjaman', 'no_sertif_hak_tanggung', 'nomor_nop',
        'njop_luas', 'njop_nilai', 'njop_total', 'nilai_oleh_tahun_lalu', 'nilai_penyusutan_tahun_lalu',
        'nilai_buku_tahun_lalu', 'nilai_oleh_berjalan', 'nilai_penyusutan_berjalan', 'nilai_buku_berjalan',
        'ket_kondisi_aset', 'kso', 'komoditi_kso', 'nama_mitra_kso', 'keterangan'
    ];

    public function cekDataMasterlist($nomor_aset, $unit_id)
    {

        $query = $this->select('*')
                    ->where('nomor_aset', $nomor_aset)
                    ->where('unit_id', $unit_id)
                    ->where('kode_aset_rehab', "");

        $data = $query->orderBy('tgl_oleh', 'DESC')
            ->get()
            ->getResultArray();

        return [
            'result' => $data,
        ];
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

    public function getAsetClass()
    {
        return $this->db->table('aset_kode')->get()->getResultArray();
    }

    public function getAsetGroup()
    {
        return $this->db->table('aset_kode')->select("aset_group")->groupBy('aset_group')->where("aset_group IS NOT NULL AND TRIM(aset_group) != ''")
            ->get()->getResultArray();
    }

    public function cekAnakan($nomor_aset, $unit_id)
    {
        $query = $this->selectMax('anakan_ke')
                    ->where('nomor_aset', $nomor_aset)
                    ->where('unit_id', $unit_id)
                    ->where('kode_aset_rehab', "")
                    ->get()
                    ->getRow();

        $max_anakan_ke = $query->anakan_ke;
        return (isset($max_anakan_ke) || $max_anakan_ke === 0) ? $max_anakan_ke + 1 : 0;
    }

    public function cekKodeAset($nomor_aset, $unit_id, $kode_aset)
    {
        $query = $this->db->table('maia_masterlist')
                    ->where('nomor_aset', $nomor_aset)
                    ->where('unit_id', $unit_id)
                    ->where('kode_aset_rehab', $kode_aset)
                    ->get()
                    ->getRow();

        return $query !== null;
    }
    
    public function editData($id)
    {
        return $this->select('*')
                    ->where('id', $id)
                    ->get()
                    ->getRow();
    }

    public function getArea($id) 
    {
        $query = $this->select('au.unit_desc')
                    ->from('maia_masterlist as am')
                    ->join('amanat_unit as au', 'au.unit_id = am.unit_id')
                    ->where('am.id', $id)
                    ->get()
                    ->getRow();

        return $query->unit_desc;   
    }

    public function updateData($id, $data)
    {
        return $this->where('id', $id)->set($data)->update();
    }
    
    public function deleteData($id)
    {
        return $this->db->table('maia_masterlist')->where('id', $id)->delete();
    }

    public function getTableData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('am.*, au.unit_desc')
                        ->from('maia_masterlist as am')
                        ->join('amanat_unit as au', 'au.unit_id = am.unit_id');

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('nomor_aset', $katakunci)
                ->orLike('deskripsi_aset', $katakunci)
                ->orLike('au.unit_desc', $katakunci)
                ->groupEnd();
        }

        $hak_akses = session()->get("hak_akses_id");
        $unit_id = session()->get("unit_id");
        $id_region = session()->get("id_region");

        if ($hak_akses == 1 || ($hak_akses >= 3 && $hak_akses <= 7)) {
            $builder->where("am.unit_id", $unit_id);
        }

        if ($hak_akses == 11) {
            $builder->where("am.id_region", $id_region);
        }

        // Get total records count
        $totalRecords = $builder->countAllResults(false);

        /// Apply length and start for pagination
        if ($length > 0) {
            $builder->limit($length, $start);
        }

        // Get filtered records count
        $filteredRecords = $builder->countAllResults(false);

        // Get the data
        $data = $builder->orderBy('am.tgl_oleh', 'DESC')
            ->distinct()
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
            $data[$i]["encrypt_nomor_aset"] = openssl_encrypt($data[$i]["nomor_aset"], $ciphering,
                $encryption_key, $options, $encryption_iv);
            $data[$i]["encrypt_sap_id"] = openssl_encrypt($data[$i]["id"], $ciphering,
                $encryption_key, $options, $encryption_iv);
        }

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data,
        ];
    }
}
