<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_obat_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_jenis_obat_count()
    {
        return $this->db->count_all('tb_jenis_obat');
    }

    public function get_jenis_obat()
    {
        $query = $this->db->get('tb_jenis_obat');
        return $query->result();
    }

    public function tambah_jenis_obat($data)
    {
        $this->db->insert('tb_jenis_obat', $data);
        return $this->db->insert_id();
    }

    public function get_jenis_obat_by_id($id)
    {
        return $this->db->get_where('tb_jenis_obat', array('id' => $id))->row();
    }

    public function update_jenis_obat($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_jenis_obat', $data);
    }

    public function hapus_jenis_obat($id)
    {
        $this->db->delete('tb_jenis_obat', array('id' => $id));
    }
}
