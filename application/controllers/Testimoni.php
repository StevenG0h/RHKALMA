<?php 
    class Testimoni extends CI_Controller{
        private int $maxImageSize = 300000; 
        private int $maxVideoSize = 50000000; 
        private String $type = "";
        
        function __construct()
        {
            parent::__construct();
            $this->load->model('User_model');
            
            if(!$this->User_model->LoginStatus()){
                redirect(base_url('/User/'));
            }
        }

        function index(){
            $showTestimoni = $this->db->get('Testimoni')->result();
            $header = array(
                'title'=>"Testimoni"
            );
            $data['testimoni'] = $showTestimoni;
            $this->load->view('HeaderFooter/header',$header);
            $this->load->view('Admin/Testimoni',$data);
        }

        function Update(){
            if ($_POST['action'] == "Save") {
                if(!empty($_POST['komentar'])){
                for ($i=0; $i < count($_POST['komentar']); $i++) {
                    $this->load->model('Testimoni_model');
                    $this->Testimoni_model->setTestimoniId($_POST['testimoniId'][$i]);
                    $this->Testimoni_model->setKomentar($_POST['komentar'][$i]);
                    if ($_FILES['Media']['name'][$i] != "") {
                        $file = $_FILES['Media'];
                        if($this->fileTypeValidator($file['name'][$i])){
                            if ($this->fileSizeValidator($file['size'][$i])) {
                                $location = 'media/testimoni/'.$this->type.'/'.$file['name'][$i].'';
                                $this->db->select('Media');
                                $data = $this->db->get_where('testimoni',array('Media'=>$location));
                                $data = $data->result();
                                if (empty($data)) {
                                    $data = $this->db->get_where('testimoni',array('Testimoni_id'=>$_POST['testimoniId'][$i]));
                                    $data = $data->result();
                                    // if ($data[0]->Media != $loc) {
                                    //     $data = $this->db->get('testimoni',array('Testimoni_id',$_POST['testimoniId'][$i]));
                                    //     $data = $data->result();
                                        if (unlink($data[0]->Media)) {
                                            if (move_uploaded_file($file['tmp_name'][$i],$location)) {
                                                $this->Testimoni_model->setMedia($location);
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
                                    $_SESSION['message'] =  "Duplikasi File pada id testimoni = ".$_POST['testimoniId'][$i];
                                    $_SESSION['action_status'] = false;
                                }
                                
                            }else{
                                $_SESSION['message'] =  "file melebihi limit pada id testimoni = ".$_POST['testimoniId'][$i];
                                $_SESSION['action_status'] = false;
                                
                            }
                        }else{
                            $_SESSION['message'] =  "file tidak valid pada id testimoni = ".$_POST['testimoniId'][$i];
                            $_SESSION['action_status'] = false;
                        }  
                    }
                    echo "hehe";
                    if ($this->Testimoni_model->updateTestimoni()) {
                        
                    }else{
                        $_SESSION['message'] = "Update testimoni gagal pada id testimoni = ".$_POST['testimoniId'][$i];
                        $_SESSION['action_status'] = false;
                    }
                }
            }else{
                return redirect(base_url('/testimoni/'));
            }
                if(empty($_SESSION['message'])){
                    $_SESSION['message'] = "Berhasil Mengedit";
                    $_SESSION['action_status'] = true;
                }
            }else if($_POST['action'] == "Delete"){
                if (!empty($_POST['Deleteid'])) {
                    $this->load->model('Testimoni_model');
                    for ($i=0; $i < count($_POST['Deleteid']); $i++) { 
                        $this->Testimoni_model->setTestimoniId($_POST['Deleteid'][$i]);
                        $this->db->select('Media');
                        $media = $this->db->get('testimoni',array('Testimoni_id',$_POST['testimoniId'][$i]));
                        $media = $media->result();
                        unlink($media[0]->Media);
                        if ($this->Testimoni_model->deleteTestimoni()) {
                            
                        }else{
                            $_SESSION['message'] = "Gagal Menghapus testimoni pada id testimoni  = ".$_POST['testimoniId'][$i];
                            $_SESSION['action_status'] = false;
                        }
                    }
                    if(empty($_SESSION['message'])){
                        $_SESSION['message'] = "Berhasil Menghapus";
                        $_SESSION['action_status'] = true;
                    }
                }else{
                    return redirect(base_url('/testimoni/'));
                }
                
            }
            
            return redirect(base_url('/testimoni/'));
        }

        //melakukan proses penerimaan data 
        function Add(){
            $file= $_FILES['Media'];
            //memanggil validator tipe file
            if($this->fileTypeValidator($file['name']) == true){
                if ($this->fileSizeValidator($file['size']) == true) {
                    $location = 'Media/testimoni/'.$this->type.'/'.$file['name'].'';
                    $data = $this->db->get_where('testimoni',array('Media'=>$location));
                    $data = $data->result();
                    if (empty($data)) {
                        if(move_uploaded_file($file['tmp_name'],$location)){
                        
                            $this->load->model('Testimoni_model');
                            $this->Testimoni_model->setKomentar($_POST['komentar']);
                            $this->Testimoni_model->setMedia($location);
                            if($this->Testimoni_model->saveTestimoni()){
                                $_SESSION['message'] = "Upload Berhasil";
                                $_SESSION['action_status'] = true;
                                
                                
                            }else{
                                $_SESSION['message'] = "Upload Gagal Silahkan Coba lagi";
                                $_SESSION['action_status'] = false;
                                
                            }
                        }else{
                            $_SESSION['message'] = "Upload Gagal Silahkan Coba lagi";
                            $_SESSION['action_status'] = false;
                        }
                    }else{
                        $_SESSION['message'] = "Duplikasi File";
                        $_SESSION['action_status'] = false;
                    }
                }else{
                    $_SESSION['message'] = "Upload gagal : file anda tidak boleh melebihi 50MB untuk video dan 300KB untuk gambar";
                    $_SESSION['action_status'] = false;
                }
            }else{
                $_SESSION['message'] = "Upload Gagal: file anda tidak valid";
                $_SESSION['action_status'] = false;
                
            }
            redirect(base_url('/testimoni/'));
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