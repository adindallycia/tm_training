<?php
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Jenis_obat_model');
        $this->load->model('Obat_model');
    }

    public function index()
    {
        if ($this->session->userdata('id')) {
            $id = $this->session->userdata('id');
            $is_active = $this->db->get_where('users', array('id' => $id))->row()->is_active;
            if (!$this->session->userdata('id')) {
                redirect('login');
            }
            $total_users = $this->user_model->get_total_users();
            $active_users = $this->user_model->get_active_users();
            $inactive_users = $this->user_model->get_inactive_users();
            $data = array(
                'total_users' => $total_users,
                'active_users' => $active_users,
                'inactive_users' => $inactive_users
            );
            $data['total_jenis_obat'] = $this->Jenis_obat_model->get_jenis_obat_count();
            $data['total_obat'] = $this->Obat_model->get_obat_count();
            $data['expired_obat'] = $this->Obat_model->get_expired_obat_count();
            $data['not_expired_obat'] = $this->Obat_model->get_not_expired_obat_count();
            $data['obat_data'] = $this->Obat_model->get_obat_sorted_by_expired();
            if ($is_active == 1) {
                $fullname = $this->session->userdata('fullname');
                $data['fullname'] = $fullname;

                $data['content'] = $this->load->view('dashboard', $data, true);
                $this->load->view('layouts/main', $data);
            } else {
                redirect('login');
            }
        } else {
            redirect('login');
        }
    }

}
