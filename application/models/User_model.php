<?php 
class User_model extends CI_Model{
    private int $User_id;
    private String $Username;
    private String $Email;
    private String $Password;
    private int $role=0 ;
    public function LoginStatus(){
        $session =$this->session->userData();
        if(empty($session['Email'])){
            return false;
        }
        return true;
    }
    public function RoleCheck(){
        $session =$this->session->userData();
        if($session['Role']==1){
            return true;
        }
        return false;
    }
    public function login(){
        $data = array(
            'Email'=>$this->Email,
        );
        $this->db->where($data);
        $password = $this->db->get('Users')->result();
        if (password_verify($this->Password,$password[0]->Password)) {
            $userData = array(
                'User_name'=>$password[0]->User_name,
                'Email'=>$password[0]->Email,
                'Role'=>$password[0]->Role,
            );
            $this->session->set_userData($userData);
            return true;
        }else{
            return false;
        }
    }
    public function setUserId(String $uid){
        $this->User_id = $uid;
    }
    public function setUsername(String $username){
        $this->Username = $username;
    }
    public function setEmail(String $email){
        $this->Email = $email;
    }
    public function setPassword(String $password){
        $this->Password = $password;
    }
    public function saveUser(){
        $data = array(
            'User_name'=>$this->Username,
            'Email'=>$this->Email,
            'Password'=>$this->Password,
            'Role'=>$this->role
        );
        if($this->db->insert('Users',$data)){
            return true;
        }else{
            return false;
        }
    }
    public function deleteUser(){
        $this->db->where('User_id',$this->User_id);
            if ($this->db->delete('Users')) {
                return true;
            }else{
                return false;
            }
    }
}
?>