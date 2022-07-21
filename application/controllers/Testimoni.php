<?php 
    class Testimoni extends CI_Controller{
        function index(){
            echo "hello world";
        }
        function addTestimoni(){
            $this->load->view("HeaderFooter/header.php");
            $this->load->view("Admin/TambahTestimoni.php");
        }
        function addTestimoniService(){
            $config['uploadPath'] = 'gambar/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp|gif';
            $config['max_size'] = '30000';
            $config['file_name'] = $_FILES['gambar']['name'];
            $this->load->library('upload',$config);
            if($this->upload->do_upload('gambar')){ 
                echo " hehe2";
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name'];
                $data['response'] = 'successfully uploaded '.$filename;
             }else{ 
    
                echo " hehe"; 
             } 
            echo $this->input->post("komentar");
            
        }
    }
?>