<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        // $this->load->library('form_validation');
        $this->load->model('auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('users')) {
            redirect(base_url());
        } else {
            $data = array(
                'title' => "Login | Bank Data Centre (BDC)"
            );
            $this->load->view('components/header', $data);
            $this->load->view('auth');
            $this->load->view('components/footer');
        }
    }

    public function login()
    {
        $username = get_post('username', true);
        $password = get_post('password', true);
        $response = login_cb($username, $password);
        if ($response['status'] === 'success') {
            $userdata = (array) $response['data'];
            /* hapus beberapa data */
            unset($userdata['level']);
            unset($userdata['jabatan']);
            unset($userdata['email']);
            unset($userdata['no_telp']);
            // DAPATKAN HAK AKSES LEVEL DI TABEL USERS
            $userdata['level'] = $this->auth_model->get_akses($userdata['nik']);
            $this->session->set_userdata('users', $userdata);

            $listdata = array();
            $listdata['redirect_url'] = base_url('dashboard');

            result_json('berhasil', 200, 'login berhasil', $listdata);
        } else {
            result_json(400, 'Gagal', 'Username / Password Salah');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('users');
        redirect(base_url('auth'));
    }
}
