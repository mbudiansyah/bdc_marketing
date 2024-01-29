<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        $this->session->userdata('users') ?: redirect(base_url('auth'));

        // $this->load->library('form_validation');
        $this->load->model('manajemen_model');
    }

    public function index()
    {
        $data = array(
            'title' => "Manajemen User | Bank Data Centre (BDC)"
        );
        $this->load->view('components/header', $data);
        $this->load->view('components/navbar');
        $this->load->view('manajemen/user');
        $this->load->view('components/footer');
    }
    public function get_users()
    {
        $this->manajemen_model->get_data_users();
    }
}
