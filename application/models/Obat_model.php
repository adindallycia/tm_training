<?php
class Obat_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_obat_count()
    {
        return $this->db->count_all('tb_obat');
    }

    public function get_expired_obat_count()
    {
        $this->db->where('tanggal_expired <', date('Y-m-d'));
        return $this->db->count_all_results('tb_obat');
    }

    public function get_not_expired_obat_count()
    {
        $this->db->where('tanggal_expired >=', date('Y-m-d'));
        return $this->db->count_all_results('tb_obat');
    }

    public function get_obat_sorted_by_expired()
    {
        $this->db->order_by('tanggal_expired', 'ASC');
        $query = $this->db->get('tb_obat');
        return $query->result();
    }

    public function get_obat()
    {
        $this->db->select('tb_obat.*, tb_jenis_obat.nama as nama_jenis_obat');
        $this->db->from('tb_obat');
        $this->db->join('tb_jenis_obat', 'tb_obat.id_jenis_obat = tb_jenis_obat.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getJenisObatOptions()
    {
        $query = $this->db->select('id, nama')->from('tb_jenis_obat')->get();
        return $query->result();
    }

    public function tambah_obat($data)
    {
        if (!isset($data['id'])) {
            $data['id'] = null;
        }

        $this->db->insert('tb_obat', $data);
        return $this->db->insert_id();
    }

    public function get_obat_by_id($id)
    {
        return $this->db->get_where('tb_obat', array('id' => $id))->row();
    }

    public function update_obat($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_obat', $data);
    }

    public function get_jenis_obat_count()
    {
        return $this->db->count_all('tb_jenis_obat');
    }

    public function hapus_obat($id)
    {
        $this->db->delete('tb_obat', array('id' => $id));
    }
}
