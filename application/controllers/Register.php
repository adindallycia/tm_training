<?php
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
        $this->load->library('session'); 
    }

    public function index()
    {

        if ($this->session->userdata('id')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register_form');
        } else {
            $data = array(
                'fullname' => $this->input->post('fullname'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'is_active' => 0
            );

            $this->user_model->register_user($data);

            redirect('login');
        }
    }
}
