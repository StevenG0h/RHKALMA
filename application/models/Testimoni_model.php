<?php
class Testimoni_model extends CI_Model
{
        private String $testimoni_id;
        private String $komentar;
        private String $media = "";
        public function setTestimoniId($id){
            $this->testimoni_id = $id;            
        }
        public function setKomentar($komentar){
            $this->komentar = $komentar;            
        }
        public function setMedia($media){
            $this->media = $media;            
        }
        public function getMedia(){
            return $this->media;
        }
        public function updateTestimoni(){
            $data= array(
                'Testimoni_id' => $this->testimoni_id,
                'Komentar' =>$this->komentar,
            );
            if ($this->media != "") {
                $data= array(
                    'Testimoni_id' => $this->testimoni_id,
                    'Komentar' =>$this->komentar,
                    'Media' => $this->media,
                );
            }
            $this->db->where('Testimoni_id',$this->testimoni_id);
            
            if ($this->db->update('Testimoni',$data)) {
                return true;
            }else{
                return false;
            }
        }
        public function saveTestimoni(){
            $data= array(
                'Komentar' =>$this->komentar,
                'Media' => $this->media
            );
            if($this->db->insert('Testimoni',$data)){
                return true;
            }else{
                return false;
            }
            
        }
        public function deleteTestimoni(){
            $this->db->where('Testimoni_id',$this->testimoni_id);
            if ($this->db->delete('Testimoni')) {
                return true;
            }else{
                return false;
            }
        }
}
