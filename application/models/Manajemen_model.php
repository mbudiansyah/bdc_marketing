<?php
class Manajemen_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_data_users()
    {
        // Jumlah data per halaman
        $limit = isset($_POST['length']) ? $_POST['length'] : 10;

        // Halaman saat ini
        $page = isset($_POST['start']) ? $_POST['start'] / $limit + 1 : 1;

        // Kolom pengurutan
        $column_index = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;
        $column_name = $_POST['columns'][$column_index]['data'];
        $column_sort_order = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 0;
        if ($column_index == 0) {
            $column_name = "id";
            $column_sort_order = "desc";
        }

        // Pencarian
        $search_value = $_POST['search']['value'];

        // Daftar kolom yang ingin dicari
        $search_columns = array('nama', 'username', 'status', 'level', /* tambahkan kolom lainnya */);

        // Membuat string kondisi pencarian
        $search_condition = '';
        foreach ($search_columns as $column) {
            $search_condition .= " $column LIKE '%$search_value%' OR";
        }
        $search_condition = rtrim($search_condition, ' OR');



        // Query untuk mendapatkan total jumlah data
        $total_records = 0;
        $sql_total = "SELECT COUNT(id) as total FROM `users`";
        $total_records = $this->db->query($sql_total)->row_array()['total'];
        // Query untuk mendapatkan data sesuai dengan kriteria
        $sql = "SELECT * FROM `users` WHERE 1=1 AND $search_condition ORDER BY $column_name $column_sort_order LIMIT $limit OFFSET " . ($page - 1) * $limit;
        $data = $this->db->query($sql)->result_array();

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode(array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        ));
    }
}
