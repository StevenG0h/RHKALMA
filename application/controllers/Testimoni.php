<?php 
    class Testimoni extends CI_Controller{
        private int $maxImageSize = 300000; 
        private int $maxVideoSize = 50000000; 
        private String $type = "";
        
        function index(){
            $showTestimoni = $this->db->get('Testimoni')->result();
            $data['testimoni'] = $showTestimoni;
            $this->load->view('HeaderFooter/header');
            $this->load->view('Admin/Testimoni',$data);
        }

        function Update(){
            
            if ($_POST['action'] == "Save") {
                echo "<pre>";
                    var_export($_POST);

                for ($i=0; $i < count($_POST['komentar']); $i++) {
                    $this->load->model('Testimoni_model');
                    $this->Testimoni_model->setTestimoniId($_POST['testimoniId'][$i]);
                    $this->Testimoni_model->setKomentar($_POST['komentar'][$i]);
                    if ($_FILES['Media']['name'][$i] != "") {
                        $file = $_FILES['Media'];
                        if($this->fileTypeValidator($file['name'][$i])){
                            if ($this->fileSizeValidator($file['size'][$i])) {
                                $location = 'media/testimoni/'.$this->type.'/'.$file['name'].'';
                                $this->db->select('Media');
                                $data = $this->db->get_where('testimoni',array('Testimoni_id',$_POST['testimoniId'][$i]));
                                var_dump($data);
                                if (move_uploaded_file($file['tmp_name'],$location)) {
                                    # code...
                                }
                                # code...
                            }
                        }else{
                            echo "hehe";
                        }
                        
                    }
                    if ($this->Testimoni_model->UpdateData()) {
                        $_SESSION['message'] = "Update Berhasil";
                        $_SESSION['action_status'] = true;
                        //redirect(base_url('/testimoni/'));
                    }else{
                        $_SESSION['message'] = "Update Gagal";
                        $_SESSION['action_status'] = false;
                       // redirect(base_url('/testimoni/'));
                    }
                }
            }else if($_POST['action'] == "Delete"){
                echo "delete";  
            }
        }

        //menampilkan halaman upload testimoni
        function addTestimoni(){
            $this->load->view("HeaderFooter/header.php");
            $this->load->view("Admin/TambahTestimoni.php");
        }

        function EditTestimoni(){

        }

        //melakukan proses penerimaan data 
        function Add(){
            $file= $_FILES['Media'];
            //memanggil validator tipe file
            if($this->fileTypeValidator($file['name']) == true){
                if ($this->fileSizeValidator($file['size']) == true) {
                    $location = 'media/testimoni/'.$this->type.'/'.$file['name'].'';
                    if(move_uploaded_file($file['tmp_name'],$location)){
                        $_SESSION['message'] = "Upload Berhasil";
                        $this->load->model('Testimoni_model');
                        $this->Testimoni_model->setKomentar($_POST['komentar']);
                        $this->Testimoni_model->setMedia($location);
                        if($this->Testimoni_model->saveData()){
                            redirect(base_url('/testimoni/'));
                        }else{
                            $_SESSION['message'] = "Upload Gagal Silahkan Coba lagi";
                            redirect(base_url('/testimoni/'));
                        }
                    }else{
                        $this->message = "upload filed";
                        $_SESSION['message'] = "Upload Gagal Silahkan Coba lagi";
                        redirect(base_url('/home/testimoni/'));
                    }
                }else{
                    $_SESSION['message'] = "Upload gagal : file anda tidak boleh melebihi 50MB untuk video dan 300KB untuk gambar";
                }
            }else{
                $_SESSION['message'] = "Upload Gagal: file anda tidak valid";
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