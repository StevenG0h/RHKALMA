<?php 
class User extends CI_Controller{
    public function index(){
        $this->load->view('headerFooter/header');
        $this->load->view('Auth/Login');
    }
    public function SignIn(){
        echo "hehe";
    }
    public function Regis(){
        $this->load->view('headerFooter/header');
        $this->load->view('Auth/Regis');
    }
}
?>