<?php 
    class Katalog extends CI_Controller{
        private int $maxImageSize = 300000; 
        private int $maxVideoSize = 50000000; 
        private String $type = "";
        
        function __construct()
        {
            parent::__construct();
            if(!$this->User_model->LoginStatus){
                redirect(base_url('/User/'));
            }
        }

        function index(){
            $showKatalog = $this->db->get('Katalog')->result();
            $data['Katalog'] = $showKatalog;
            $this->load->view('HeaderFooter/header');
            $this->load->view('Admin/Katalog',$data);
        }

        function Update(){
            
            if ($_POST['action'] == "Save") {
                if(!empty($_POST['Desc_produk'])){
                for ($i=0; $i < count($_POST['Desc_produk']); $i++) {
                    $this->load->model('Katalog_model');
                    $this->Katalog_model->setIdProduk($_POST['Id_produk'][$i]);
                    $this->Katalog_model->setNamaProduk($_POST['Nama_produk'][$i]);
                    $this->Katalog_model->setDescProduk($_POST['Desc_produk'][$i]);
                    if ($_FILES['Media']['name'][$i] != "") {
                        $file = $_FILES['Media'];
                        if($this->fileTypeValidator($file['name'][$i])){
                            if ($this->fileSizeValidator($file['size'][$i])) {
                                $location = 'media/Katalog/'.$this->type.'/'.$file['name'][$i].'';
                                $this->db->select('Media');
                                $data = $this->db->get_where('Katalog',array('Media'=>$location));
                                $data = $data->result();
                                if (empty($data)) {
                                    $data = $this->db->get_where('Katalog',array('Id_produk'=>$_POST['Id_produk'][$i]));
                                    $data = $data->result();
                                    // if ($data[0]->Media != $loc) {
                                    //     $data = $this->db->get('Katalog',array('Katalog_id',$_POST['KatalogId'][$i]));
                                    //     $data = $data->result();
                                        if (unlink($data[0]->Media)) {
                                            if (move_uploaded_file($file['tmp_name'][$i],$location)) {
                                                $this->Katalog_model->setMedia($location);
                                            }else{
                                                $_SESSION['message'] = "gagal mengupload file";
                                                $_SESSION['action_status'] = false;
                                            }
                                        }else{
                                            $_SESSION['message'] = "gagal menghapus file lama";
                                            $_SESSION['action_status'] = false;
                                        }
                                    // }else{
                                    //     $_SESSION['message'] =  "duplikasi file";
                                    //     $_SESSION['action_status'] = false;     
                                    // }
                                }else{
                                    $_SESSION['message'] =  "Duplikasi File pada id Katalog = ".$_POST['Id_produk'][$i];
                                    $_SESSION['action_status'] = false;
                                }
                                
                            }else{
                                $_SESSION['message'] =  "file melebihi limit pada id Katalog = ".$_POST['Id_produk'][$i];
                                $_SESSION['action_status'] = false;
                                
                            }
                        }else{
                            $_SESSION['message'] =  "file tidak valid pada id Katalog = ".$_POST['Id_produk'][$i];
                            $_SESSION['action_status'] = false;
                        }  
                    }
                    if ($this->Katalog_model->updateKatalog()) {
                        
                    }else{
                        $_SESSION['message'] = "Update Katalog gagal pada id Katalog = ".$_POST['Id_produk'][$i];
                        $_SESSION['action_status'] = false;
                    }
                }
            }else{
                return redirect(base_url('/Katalog/'));
            }
                if(empty($_SESSION['message'])){
                    $_SESSION['message'] = "Berhasil Mengedit";
                    $_SESSION['action_status'] = true;
                }
            }else if($_POST['action'] == "Delete"){
                if (!empty($_POST['Deleteid'])) {
                    $this->load->model('Katalog_model');
                    for ($i=0; $i < count($_POST['Deleteid']); $i++) { 
                        $this->Katalog_model->setIdProduk($_POST['Deleteid'][$i]);
                        $this->db->select('Media');
                        $media = $this->db->get('Katalog',array('Katalog_id',$_POST['Deleteid'][$i]));
                        $media = $media->result();
                        unlink($media[0]->Media);
                        if ($this->Katalog_model->deleteKatalog()) {
                            
                        }else{
                            $_SESSION['message'] = "Gagal Menghapus Katalog pada id Katalog  = ".$_POST['Deleteid'][$i];
                            $_SESSION['action_status'] = false;
                        }
                    }
                    if(empty($_SESSION['message'])){
                        $_SESSION['message'] = "Berhasil Menghapus";
                        $_SESSION['action_status'] = true;
                    }
                }else{
                    return redirect(base_url('/Katalog/'));
                }
                
            }
            
            return redirect(base_url('/Katalog/'));
        }

        //melakukan proses penerimaan data 
        function Add(){
            $file= $_FILES['Media'];
            //memanggil validator tipe file
            if($this->fileTypeValidator($file['name']) == true){
                if ($this->fileSizeValidator($file['size']) == true) {
                    $location = 'Media/Katalog/'.$this->type.'/'.$file['name'].'';
                    $data = $this->db->get_where('Katalog',array('Media'=>$location));
                    $data = $data->result();
                    if (empty($data)) {
                        if(move_uploaded_file($file['tmp_name'],$location)){
                            $this->load->model('Katalog_model');
                            $this->Katalog_model->setNamaProduk($_POST['Nama_produk']);
                            $this->Katalog_model->setDescProduk($_POST['Desc_produk']);
                            $this->Katalog_model->setMedia($location);
                            if($this->Katalog_model->saveKatalog()){
                                $_SESSION['message'] = "Upload Berhasil";
                                $_SESSION['action_status'] = true;
                                redirect(base_url('/Katalog/'));
                                
                                
                            }else{
                                $_SESSION['message'] = "Upload Gagal Silahkan Coba lagi";
                                $_SESSION['action_status'] = false;
                                redirect(base_url('/Katalog/'));
                                
                            }
                        }else{
                            $_SESSION['message'] = "Upload Gagal Silahkan Coba lagi";
                            $_SESSION['action_status'] = false;
                            redirect(base_url('/Katalog/'));
                        }
                    }else{
                        $_SESSION['message'] = "Duplikasi File";
                        $_SESSION['action_status'] = false;
                        redirect(base_url('/Katalog/'));
                    }
                }else{
                    $_SESSION['message'] = "Upload gagal : file anda tidak boleh melebihi 50MB untuk video dan 300KB untuk gambar";
                    $_SESSION['action_status'] = false;
                    redirect(base_url('/Katalog/'));
                }
            }else{
                $_SESSION['message'] = "Upload Gagal: file anda tidak valid";
                $_SESSION['action_status'] = false;
                redirect(base_url('/Katalog/'));
            }
        }

        //validasi tipe file video atau foto
        function fileTypeValidator($fileName){
            //memecah string dari variabel $filename
            $ext = explode('.',$fileName);

            //memilih index terakhir dari variabel $ext
            $ext = strtolower(end($ext)) ;

            //mengecek apakah file merupakan foto
            if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'webp'){
                $this->type = "Foto";
                return true;

            //mengecek apakah file merupakan video
            } elseif($ext == 'gif' || $ext == 'mp4' || $ext == 'mkv' || $ext == 'mov'){
                $this->type = "Video";
                return true;

            //file tidak meruapakan foto atau video
            } else{
                return false;
            }
        }

        //validasi size file
        function fileSizeValidator($fileSize){
            if ($this->type == "Video") {
                if($fileSize < $this->maxVideoSize){
                    return true;
                }else{
                    return false;
                }
            }else if($this->type =="Foto"){
                if($fileSize < $this->maxImageSize){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }
    }
?>