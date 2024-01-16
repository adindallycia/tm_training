<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $total_users = $this->user_model->get_total_users();
        $active_users = $this->user_model->get_active_users();
        $inactive_users = $this->user_model->get_inactive_users();
        $data = array(
            'total_users' => $total_users,
            'active_users' => $active_users,
            'inactive_users' => $inactive_users
        );
        $data['users'] = $this->user_model->get_user();
        $data['content'] = $this->load->view('module/users/index', $data, true);
        $this->load->view('layouts/main', $data);
    }

    public function proses_tambah()
    {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            echo json_encode(array('status' => false, 'errors' => validation_errors()));
        } else {
            $data = array(
                'fullname' => $this->input->post('fullname'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 0
            );

            $this->user_model->tambah_user($data);
            redirect('users');
        }
    }

    public function edit($id)
    {
        if ($_POST) {
            $data = array(
                'fullname' => $this->input->post('fullname'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 0
            );

            $this->user_model->update_user($id, $data);
            echo json_encode(array('status' => true));
        } else {
            $data['users'] = $this->user_model->get_user_by_id($id);
            $this->load->view('module/users/edit', $data);
        }
    }

    public function proses_edit()
    {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            echo json_encode(array('status' => false, 'errors' => validation_errors()));
        } else {
            $id = $this->input->post('id');
            $data = array(
                'fullname' => $this->input->post('fullname'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            );

            if ($this->input->post('is_active') == 1 && $this->user_model->get_user_info($id)->is_active != 1) {
                $data['is_active'] = 1;
            } elseif ($this->input->post('is_active') != 1 && $this->user_model->get_user_info($id)->is_active == 1) {
                $data['is_active'] = 0;
            }

            $this->user_model->update_user($id, $data);
            redirect('users');
        }
    }

    public function hapus($id)
    {
        $this->user_model->hapus_user($id);
        redirect('users');
    }
}
