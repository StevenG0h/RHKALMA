<?php
class Catalog extends CI_Controller
{
    public function index()
    {
        $this->load->view('catalog_view');
    }

    public function showCatalog()
    {
    }
    public function insertCatalog()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        $komentar = $this->input->post('komentar');
        echo $komentar;
    }
}
