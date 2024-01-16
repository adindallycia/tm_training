<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model');
        $this->load->library('form_validation');
        $this->load->model('Jenis_obat_model');
    }

    public function index()
    {
        $data['total_obat'] = $this->Obat_model->get_obat_count();
        $data['expired_obat'] = $this->Obat_model->get_expired_obat_count();
        $data['not_expired_obat'] = $this->Obat_model->get_not_expired_obat_count();
        $data['obat'] = $this->Obat_model->get_obat();
        $data['jenis_obat_options'] = $this->Obat_model->getJenisObatOptions();
        $data['content'] = $this->load->view('module/obat/index', $data, true);

        $this->load->view('layouts/main', $data);
    }


    public function proses_tambah()
    {
        if ($_POST) {
            $data_obat = array(
                'id_jenis_obat' => $this->input->post('id_jenis_obat'),
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'tanggal_expired' => date('Y-m-d', strtotime('+1 year'))
            );
            $this->Obat_model->tambah_obat($data_obat);
            redirect('obat');
        } else {
            show_404();
        }
    }

    public function edit($id)
    {
        if ($_POST) {
            $data = array(
                'id_jenis_obat' => $this->input->post('id_jenis_obat'),
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'tanggal_expired' => $this->input->post('tanggal_expired')
            );

            $this->Obat_model->update_obat($id, $data);
            redirect('obat');
        }

        $data['obat'] = $this->Obat_model->get_obat_by_id($id);
        $this->load->view('obat/edit', $data);
    }

    public function proses_edit()
    {
        if ($this->input->is_ajax_request() && $this->input->post()) {
            $id = $this->input->post('id');
            $data = array(
                'id_jenis_obat' => $this->input->post('id_jenis_obat'),
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'tanggal_expired' => $this->input->post('tanggal_expired')
            );

            $this->Obat_model->update_obat($id, $data);
            echo json_encode(array('status' => true));
        } else {
            show_404();
        }
    }

    public function hapus($id)
    {
        $this->Obat_model->hapus_obat($id);
        redirect('obat');
    }
}
