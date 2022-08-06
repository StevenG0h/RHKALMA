<?php 
    class Testimoni extends CI_Controller{
        private int $maxSize = 50000000; 
        private String $type = "";
        function index(){
            var_dump($_SESSION);
            $_SESSION['message'] = "";
        }
        function addTestimoni(){
            $this->load->view("HeaderFooter/header.php");
            $this->load->view("Admin/TambahTestimoni.php");
        }
        function addTestimoniProcess(){
            $file= $_FILES['gambar'];
            if($this->fileSizeValidator($file['size']) == true && $this->fileTypeValidator($file['name']) == true){
                if(move_uploaded_file($file['tmp_name'],'gambar/testimoni/'.$this->type.'/'.$file['name'].'')){
                    $_SESSION['message'] = "Upload Berhasil";
                    redirect(base_url('/testimoni/'));
                }else{
                    $this->message = "upload filed";
                    $_SESSION['message'] = "Upload Gagal Silahkan Coba lagi";
                    redirect(base_url('/home/testimoni/'));
                }
            }else{
                $_SESSION['message'] = "Upload Gagal: file anda tidak valid atau ukuran lebih dari 50MB";
            }
        }
        function fileTypeValidator($fileName){
            $ext = explode('.',$fileName);
            $ext = end($ext);
            $message['message'] = "hello"; 
            if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'webp'){
                $this->type = "Foto";
                return true;
            } elseif($ext == 'gif' || $ext == 'mp4' || $ext == 'mkv' || $ext == 'mov'){
                $this->type = "Video";
                return true;
            } else{
                $message['message'] = 'suspicious file';
                return false;
            }
            $this->session->message =$message ;
        }
        function fileSizeValidator($fileSize){
            if($fileSize < $this->maxSize){
                return true;
            }else{
                return false;
            }
        }
    }
?>