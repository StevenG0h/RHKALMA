<?php 
    class ManageUser extends CI_Controller{
        function __construct()
        {
            parent::__construct();
            $this->load->model('User_model');
            if(!$this->User_model->LoginStatus()){
                redirect(base_url('/User/'));
            }
        }

        function index(){
            $header = array(
                'title'=>"Manage User"
            );
            $users = $this->db->get('users');
            $data = array('Users'=>$users->result());
            $this->load->view('HeaderFooter/header',$header);
            $this->load->view('Admin/ManageUser',$data);
        }
    }
?>