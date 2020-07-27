<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function createData($data) {
        return $this->db->insert('tbl_user', $data);
    }

    function getAllData() {
        $query = $this->db->query('SELECT * FROM tbl_user');
        return $query->result();
    }

    function getData($id) {
        $query = $this->db->query('SELECT * FROM tbl_user WHERE `id` =' .$id);
        return $query->row();
    }

    function updateData($id) {
        $data = array (
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_user', $data);
    }

    function deleteData($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_user');
    }
}