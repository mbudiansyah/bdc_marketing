<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Data_prospek extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        $this->session->userdata('users') ?: redirect(base_url('auth'));
        // $this->load->library('form_validation');
        // $this->load->model('auth_model');
    }

    public function index()
    {


        $data = array(
            'title' => "Data Prospek | GG-Followup"
        );
        $this->load->view('components/header', $data);
        $this->load->view('components/navbar');
        $this->load->view('data_prospek');
        $this->load->view('components/footer');
    }
    public function store()
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();


        // Baca file excel yang diupload
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

        // Ambil sheet aktif
        $sheet = $spreadsheet->getActiveSheet();

        // Ambil data dari baris ke-2 (abaikan header)
        $highestRow = $sheet->getHighestDataRow();
        $highestColumn = $sheet->getHighestDataColumn();

        for ($row = 2; $row <= $highestRow; $row++) {
            $data[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, false);
        }
        debug($data);
    }
}
