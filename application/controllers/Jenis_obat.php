<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_obat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['jenis_obat'] = $this->Jenis_obat_model->get_jenis_obat();
        $data['content'] = $this->load->view('module/jenis_obat/index', $data, true);

        $this->load->view('layouts/main', $data);
    }

    public function proses_tambah()
    {
        if ($_POST) {
            $data = array(
                'nama' => $this->input->post('nama')
            );

            $this->Jenis_obat_model->tambah_jenis_obat($data);
            echo json_encode(array('status' => true));
        } else {
            show_404();
        }
    }

    public function edit($id)
    {
        if ($_POST) {
            $data = array(
                'nama' => $this->input->post('nama')
            );

            $this->Jenis_obat_model->update_jenis_obat($id, $data);
            echo json_encode(array('status' => true));
        } else {
            $data['jenis_obat'] = $this->Jenis_obat_model->get_jenis_obat_by_id($id);
            $this->load->view('module/jenis_obat/edit', $data);
        }
    }

    public function proses_edit()
    {
        if ($_POST) {
            $id = $this->input->post('id');
            $data = array(
                'nama' => $this->input->post('nama')
            );

            $this->Jenis_obat_model->update_jenis_obat($id, $data);
            redirect('jenis_obat');
        } else {
            show_404();
        }
    }


    public function hapus($id)
    {
        $this->Jenis_obat_model->hapus_jenis_obat($id);
        redirect('jenis_obat');
    }
}
