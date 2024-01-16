<?php
class Logout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('session');
    }
    public function index()
    {
        if ($this->session->userdata('id')) {
            $this->session->sess_destroy();
        }
        redirect('login');
    }
}
