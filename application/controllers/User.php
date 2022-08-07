<?php 
class User extends CI_Controller{

    public function index(){
        $this->load->model('User_model');
        if($this->User_model->LoginStatus()){
            redirect(base_url('/Testimoni/'));
        }
        $this->load->view('headerFooter/AuthHeader');
        return $this->load->view('Auth/Login');
    }
    public function SignIn(){
        $this->load->model('User_model');
        $this->User_model->setEmail($_POST['email']);
        $this->User_model->setPassword($_POST['password']);
        if ($this->User_model->login()) {
            
            redirect(base_url('/Testimoni/'));
        }else{
            $_SESSION['message'] = "Email atau password anda salah";
            $this->load->view('headerFooter/AuthHeader');
            return $this->load->view('Auth/Login');
        }
    }
    public function Regis(){
        $this->load->model('User_model');
        if(!$this->User_model->LoginStatus()){
            redirect(base_url('/User/'));
        }
        if(!$this->User_model->RoleCheck()){
            redirect(base_url('/Testimoni/'));
        }
        $this->load->view('headerFooter/AuthHeader');
        return $this->load->view('Auth/Regis');
    }
    public function SignUp(){
        if($this->formValidator() == false){
            $this->load->view('headerFooter/AuthHeader');
            return $this->load->view('Auth/Regis');
        }
        $this->load->model('User_model');
        $this->User_model->setUsername($_POST['username']);
        $this->User_model->setEmail($_POST['email']);
        $this->User_model->setPassword(password_hash($_POST['password'],PASSWORD_DEFAULT));
        if ($this->User_model->saveUser()) {
            redirect(base_url('/ManageUser/'));
        }else{
            $this->load->view('headerFooter/AuthHeader');
            return $this->load->view('Auth/Regis');
        }
    }
    public function formValidator(){
        $this->form_validation->set_rules('username','Username','required|is_unique[users.User_name]');
        $this->form_validation->set_rules('email','Email','required|is_unique[users.Email]');
        $this->form_validation->set_rules('password','Password','required|matches[repassword]');
        $this->form_validation->set_rules('repassword','Password','required');
        if($this->form_validation->run() == false){
            return false;
        }else{
            return true;
        }
    }
    public function logout(){
        $userData = array('Role','User_name','Email');
        $this->session->unset_userData($userData);
        redirect(base_url('/User/'));
    }
    public function DeleteUser(){
        $this->load->model('User_model');
        for ($i=0; $i < count($_POST['Deleteid']); $i++) { 
            $this->User_model->setUserId($_POST['Deleteid'][$i]);
            if ($this->User_model->DeleteUser()) {
                redirect(base_url('/ManageUser/'));
            }else{
                redirect(base_url('/ManageUser/'));
            }
        }
        
    }
}
?>