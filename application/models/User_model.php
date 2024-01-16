<?php
class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_total_users()
    {
        return $this->db->count_all('users');
    }

    public function get_user()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function get_active_users()
    {
        return $this->db->where('is_active', 1)->count_all_results('users');
    }

    public function get_inactive_users()
    {
        return $this->db->where('is_active', 0)->count_all_results('users');
    }

    public function register_user($data)
    {
        if (isset($data['username']) && isset($data['password'])) {
            return $this->db->insert('users', $data);
        } else {
            return false;
        }
    }

    public function login_user($username, $password)
    {
        $this->db->where('username', $username);
        $user = $this->db->get('users')->row();

        if ($user && password_verify($password, $user->password) && $user->is_active == 1) {
            return $user;
        } else {
            return false;
        }
    }

    public function tambah_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row();
    }


    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function get_user_info($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function hapus_user($id)
    {
        $this->db->delete('users', ['id' => $id]);
    }

}