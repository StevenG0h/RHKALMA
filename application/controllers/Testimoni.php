<?php
class Testimoni extends CI_Controller
{
    function index()
    {
        echo "hello world";
    }
    function addTestimoni()
    {
        $this->load->view("HeaderFooter/header.php");
        $this->load->view("Admin/TambahTestimoni.php");
    }
    function addTestimoniService()
    {
        $filename = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        if(move_uploaded_file($tmp, 'Gambar/' . $filename)){
            
        }
    }
}
