<?php
class Auth_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_akses($username)
    {
        $this->db->select('level');
        $this->db->from('users');
        $this->db->where('username', strtoupper(str_replace('.', '', $username)));
        $this->db->where('status', 'A');
        $query = $this->db->get();
        $row = $query->row_array();
        // jika tidak ada datanya di tabel maka beri level user
        return isset($row['level']) ? $row['level'] : 'user';
    }
}
