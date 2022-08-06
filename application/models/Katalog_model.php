<?php
class Katalog_model extends CI_Model
{
        private String $Id_produk;
        private String $Nama_produk;
        private String $Desc_produk;
        private String $media = "";
        public function setIdProduk($id){
            $this->Id_produk= $id;            
        }
        public function setNamaProduk($komentar){
            $this->Nama_produk = $komentar;            
        }
        public function setDescProduk($komentar){
            $this->Desc_produk = $komentar;            
        }
        public function setMedia($media){
            $this->media = $media;            
        }
        public function getMedia(){
            return $this->media;
        }
        public function updateKatalog(){
            $data= array(
                'Id_produk' => $this->Id_produk,
                'Nama_produk' =>$this->Nama_produk,
                'Desc_produk' =>$this->Desc_produk
            );
            if ($this->media != "") {
                $data= array(
                    'Id_produk' => $this->Id_produk,
                    'Nama_produk' =>$this->Nama_produk,
                    'Desc_produk' =>$this->Desc_produk,
                    'Media' => $this->media,
                );
            }
            $this->db->where('Id_produk',$this->Id_produk);
            
            if ($this->db->update('Katalog',$data)) {
                return true;
            }else{
                return false;
            }
        }
        public function saveKatalog(){
            $data= array(
                'Nama_produk' =>$this->Nama_produk,
                'Desc_produk' =>$this->Desc_produk,
                'Media' => $this->media,
            );
            if($this->db->insert('Katalog',$data)){
                return true;
            }else{
                return false;
            }
            
        }
        public function deleteKatalog(){
            $this->db->where('Id_produk',$this->Id_produk);
            if ($this->db->delete('Katalog')) {
                return true;
            }else{
                return false;
            }
        }
}
