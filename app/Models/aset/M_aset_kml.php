<?php

namespace App\Models\aset;

use CodeIgniter\Model;

class M_aset_kml extends Model
{
    protected $table = 'amanat_kml';
    protected $primaryKey = 'kml_id';
    protected $allowedFields = ['user_id', 'sap_id', 'id_region', 'unit_id', 'nomor_aset', 'deskripsi',
        'nomor_alas_hak', 'kml_type','kml_file', 'kml_publish', 'latlong', 
        'jenis_alas_hak','luas_alas_hak','status_alas_hak','tahapan_perpanjangan',
        'tgl_akhir_sertifikat','izin_pengalihan','nomor_izin_pengalihan','kkpr','created_at',
        'updated_at','areal_statement_luas','areal_statement_satuan_ha','status_jaminan','nomor_nop',
        'luas_njop','nilai_njop_meter','nilai_njop_total', 'quantity_luas_jumlah_ha', 'quantity_satuan_sap',
        'class_aset', 'grup_aset', 'nama_aset','sap_deskripsi', 'kode_perusahaan', 'kode_aset_rehab'];

    public function tampilData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('kml_id, nomor_aset, deskripsi, nomor_alas_hak, latlong')
            ->where('nomor_alas_hak is NOT NULL')
            ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('nomor_aset', $katakunci)
                ->groupEnd();
        }

        // Get total records count
        $totalRecords = $builder->countAllResults(false);

        // Apply length and start for pagination
        if ($length > 0) {
            $builder->limit($length, $start);
        }

        // Get filtered records count
        $filteredRecords = $builder->countAllResults(false);

        // Get the data
        $data = $builder->orderBy('kml_id', 'DESC')
            ->get()
            ->getResultArray();

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data,
        ];
    }

    public function getTableData($katakunci = null, $start = 0, $length = 10)
    {
        $builder = $this->select('amanat_sap.sap_id, amanat_kml.nomor_aset,amanat_kml.class_aset, amanat_kml.grup_aset,amanat_sap.sap_deskripsi, amanat_sap.area, kabupaten_kota,
                                  provinsi, areal_statement_satuan_ha, areal_statement_luas, jenis_alas_hak, luas_alas_hak, status_alas_hak, nilai_oleh_berjalan, nilai_buku_berjalan
                                  nilai_oleh, nilai_residu, tgl_oleh, masa_susut,  nama_aset, 
                                  nilai_penyusutan_berjalan, keterangan, kml_id')
        ->join('amanat_sap','amanat_kml.nomor_aset = amanat_sap.nomor_aset', 'left')
        ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
        ->join('master_region', 'amanat_unit.id_region = master_region.id_region', 'left');
        // ->distinct();

        // Apply search keyword filtering
        if (!empty($katakunci)) {
            $builder->groupStart()
                ->like('amanat_kml.nomor_aset', $katakunci)
                ->orLike('sap_deskripsi', $katakunci)
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
            $data[$i]["encrypt_nomor_aset"] = openssl_encrypt($data[$i]["nomor_aset"], $ciphering,
                $encryption_key, $options, $encryption_iv);
            $data[$i]["encrypt_sap_id"] = openssl_encrypt($data[$i]["sap_id"], $ciphering,
                $encryption_key, $options, $encryption_iv);

            // hapus karakter "/"
            // $data[$i]["encrypt_nomor_aset"] = strtr($data[$i]["encrypt_nomor_aset"], array("/"=>"=="));
        }

        return [
            'total' => $totalRecords,
            'filteredTotal' => $filteredRecords,
            'result' => $data,
        ];
    }

    public function getAset($id)
    {
        return $this->select('kml_id, user_id, amanat_kml.sap_id, amanat_kml.nomor_aset,amanat_kml.unit_id, unit_desc, amanat_kml.kml_file, kml_publish, latlong, amanat_kml.sap_deskripsi')
            ->join('amanat_unit', 'amanat_kml.unit_id = amanat_unit.unit_id', 'left')
            ->join('amanat_sap', 'amanat_kml.sap_id = amanat_sap.sap_id', 'left')
            ->where('amanat_kml.sap_id', $id)
            ->get()
            ->getRow();
    }

    public function getSap($id)
    {
        return $this->select('user_id, amanat_sap.sap_id, amanat_sap.nomor_aset,amanat_sap.unit_id, unit_desc,')
            ->join('amanat_unit', 'amanat_sap.unit_id = amanat_unit.unit_id', 'left')
            ->join('amanat_sap', 'amanat_sap.sap_id = amanat_sap.sap_id', 'left')
            ->where('amanat_sap.sap_id', $id)
            ->get()
            ->getRow();
    }
    public function editAsetData($id)
    {
        return $this->select('*')
            ->where('kml_id', $id)
            ->get()
            ->getRow();
    }
    public function getupdate($id, $data)
    {
        return $this->where('kml_id', $id)->set($data)->update();
    }

    public function deleteKoordinatData($id)
    {
        return $this->where('kml_id', $id)->delete();
    }
}
