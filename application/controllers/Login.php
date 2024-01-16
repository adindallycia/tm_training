<?php
class Login extends CI_Controller
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

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_form');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->user_model->login_user($username, $password);

            if ($user) {
                $this->session->set_userdata('id', $user->id);
                $this->session->set_userdata('username', $user->username);
                $user_info = $this->user_model->get_user_info($user->id);

                if ($user_info) {
                    $this->session->set_userdata('fullname', $user_info->fullname);
                }
                redirect('dashboard');
            } else {
                $data['error'] = 'Invalid username or password.';
                $this->load->view('login_form', $data);
            }
        }
    }
}
