<?php

namespace App\Controllers;

use App\Models\M_asetuser;
use App\Models\M_usermodel;
use CodeIgniter\Controller;

class C_login extends Controller
{

    public function index()
    {
        // helper( 'text' );
        // $randomkey = random_string( 'alnum', 8 );

        // Set random num1 and num2 for chaptcha
        session()->set('num1', rand(1, 10));
        session()->set('num2', rand(1, 10));
        session()->set('captcha', session()->get('num1') + session()->get('num2'));

        return view(
            'login'
        );

        // Outputs: This is a plain-text message!
    }

    public function login_aset()
    {
        $muser = new M_asetuser();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        // Ubah 'user_pass' menjadi 'password'

        // Get captcha input and key
        $captcha = $this->request->getVar('captcha');
        $key = session()->get('captcha');

        if ((int) $captcha !== $key) {
            //captcha tidak sesuai
            session()->setFlashdata('gagal', 'Captcha salah!');
            return redirect()->to(base_url('C_login'));
        }

        $db = \Config\Database::connect();
        $builder = $db->table('amanat_users');
        $builder->where('username', $username);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            // Menggunakan getNumRows() untuk menghitung jumlah baris
            $result = $query->getRowArray();
            $unitByUser = $db->table('amanat_unit')->where('unit_id', $result['unit_id'])->get()->getRowArray();

            //print_r($result); die();

            if (password_verify($password, $result['user_pass'])) {
                // Menggunakan $result[ 'user_pass' ] untuk mendapatkan password dari hasil query
                session()->set('username', $result['username']);
                session()->set('user_id', $result['user_id']);
                session()->set('id_region', $unitByUser['id_region']);
                session()->set('unit_id', $unitByUser['unit_id']);
                session()->set('afdeling_id', $result['afdeling_id']);
                session()->set('sub_unit_id', $result['sub_unit_id']);
                session()->set('hak_akses_id', $result['hak_akses_id']);
                session()->set('user_email', $result['user_email']);
                session()->set('perusahaan_kode', $result['perusahaan_kode']);
                session()->set('user_perusahaan', $result['perusahaan_kode']);
                session()->set('role_id', null);

                //user non admin
                if ($result['hak_akses_id'] >= '4' and $result['hak_akses_id'] <= '7') {
                    return redirect()->to(base_url('C_aset_manajemen'));
                } else {
                    //user admin/manajer/regional/head office
                    return redirect()->to(base_url('C_dashboard_aset'));
                }
            } else {
                //password tidak sesuai
                session()->setFlashdata('gagal', 'Username / Password salah');
                return redirect()->to(base_url('C_login'));
            }
        } else {
            //user tidak ditemukan di db
            session()->setFlashdata('gagal', 'Username tidak ditemukan');
            return redirect()->to(base_url('C_login'));
        }
    }

    public function login_action()
    {
        $muser = new M_usermodel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');


        $db = \Config\Database::connect();

        $builder = $db->table('user');
        $builder->where('username', $username);
        $query = $builder->get();

        // Get captcha input and key
        $captcha = $this->request->getVar('captcha');
        $key = session()->get('captcha');

        if ((int) $captcha !== $key) {
            //captcha tidak sesuai
            session()->setFlashdata('gagal', 'Captcha salah!');
            return redirect()->to(base_url('C_login'));
        }

        if ($builder->countAllResults() > 0) {
            $result = $query->getResult('array');

            // var_dump($result);
            // exit;
            if ($result == null) {
                session()->setFlashdata('gagal', 'Username / Password salah');
                return redirect()->to(base_url('C_login'));
            } else {
                if (password_verify($password, $result[0]['password'])) {
                    session()->set('username', $result[0]['username']);
                    session()->set('user_id', $result[0]['user_id']);
                    session()->set('unit_id', $result[0]['unit_id']);
                    session()->set('role_id', $result[0]['role_id']);
                    session()->set('region_id', $result[0]['region_id']);

                    // ! Session id_region untuk akses dashboard inventarisasi aset
                    session()->set('id_region', $result[0]['region_id']);

                    session()->set('user_telp', $result[0]['user_telp']);
                    session()->set('hak_akses_id', null);

                    // Logika login untuk User admin Monica
                    return redirect()->to(base_url('C_dashboard_katalog'));
                } else {
                    session()->setFlashdata('gagal', 'Password salah');
                    return redirect()->to(base_url('C_login'));
                }
            }
        }
    }


    public function login_action_divestasi()
    {

        $muser = new M_usermodel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');


        $db = \Config\Database::connect();

        $builder = $db->table('user');
        $builder->where('username', $username);
        $query = $builder->get();

        // Get captcha input and key
        $captcha = $this->request->getVar('captcha');
        $key = session()->get('captcha');




        if ((int) $captcha !== $key) {
            //captcha tidak sesuai
            session()->setFlashdata('gagal', 'Captcha salah!');
            return redirect()->to(base_url('C_login'));
        }

        if ($builder->countAllResults() > 0) {
            $result = $query->getResult('array');

            // var_dump($result);
            // exit;
            if ($result == null) {
                session()->setFlashdata('gagal', 'Username / Password salah');
                return redirect()->to(base_url('C_login'));
            } else {
                if (password_verify($password, $result[0]['password'])) {
                    session()->set('username', $result[0]['username']);
                    session()->set('user_id', $result[0]['user_id']);
                    session()->set('unit_id', $result[0]['unit_id']);
                    session()->set('role_id', $result[0]['role_id']);
                    session()->set('region_id', $result[0]['region_id']);

                    // ! Session id_region untuk akses dashboard inventarisasi aset
                    session()->set('id_region', $result[0]['region_id']);

                    session()->set('user_telp', $result[0]['user_telp']);
                    session()->set('hak_akses_id', 20);

                    // Logika login untuk User admin Monica
                    return redirect()->to(base_url('C_divestasi'));
                } else {
                    session()->setFlashdata('gagal', 'Password salah');
                    return redirect()->to(base_url('C_login'));
                }
            }
        }
    }

    public function ganti_password()
    {
        $user_id = $this->request->getVar('user_id');
        $current_url = $this->request->getVar('current_url');
        $old_password = $this->request->getVar('old_password');
        $new_password = $this->request->getVar('new_password');
        $conf_new_password = $this->request->getVar('conf_new_password');

        if ($new_password !== $conf_new_password) {
            session()->setFlashdata('change_password_fail', 'Password baru dan Konfirmasi Password tidak cocok!');
            return redirect()->to($current_url);
        }

        $db = \Config\Database::connect();
        $q = $db->table('amanat_users')
            ->where('user_id', $user_id)
            ->get()
            ->getRowArray();

        if (!password_verify($old_password, $q['user_pass'])) {
            session()->setFlashdata('change_password_fail', 'Password Lama Salah!');
            return redirect()->to($current_url);
        }

        $hash_password = password_hash($new_password, PASSWORD_BCRYPT);

        $update = $db->table('amanat_users')
            ->set('user_pass', $hash_password)
            ->update();

        session()->setFlashdata('change_password_success', 'Password Berhasil Di perbaharui!');
        return redirect()->to($current_url);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('C_login'));
    }
}
