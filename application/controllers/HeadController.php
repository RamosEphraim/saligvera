<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HeadController extends CI_Controller {
    private $data;
    private $userlog;
    private $role;


    public function __construct(){
        parent::__construct();
        $this->load->model('SessionModel');
        $this->load->model('LoginModel');
        $this->load->model('AccountModel');
        $this->load->model('WorkerModel');
        $this->load->model('RequestModel');
        $this->load->model('SupplyModel');
        $this->load->model('ProjectModel');
        $this->userlog = $this->session->userdata('account_id');
        $this->role = $this->session->userdata('role');
        $this->data['userdetails'] = $this->SessionModel->userDetails($this->userlog);
        if($this->userlog != ""){
            switch ($this->role) {
                case 0:
                redirect('Developer');
                break;

                case 1:
                redirect('Accounting');
                break;

                case 2:
                redirect('Technical');
                break;

                case 3:
                redirect('Purchasing');
                break;

                case 4:
                redirect('EA');
                break;

                case 5:
                redirect('Warehouse');
                break;

                case 6:
                redirect('HR');
                break;
            }
        } else { 
            redirect('login');
        }
        if($this->data['userdetails']['role'] != 7){
            $this->userlog = $this->session->unset_userdata('account_id');
            redirect('login');
        }
    }

    public function logout(){
        $this->userlog = $this->session->unset_userdata('account_id');
        redirect('login');
    }

    
    public function index(){
        $this->data['title'] = "Project Lists - Head";
        $this->data['nav'] = "Project Lists";
        $this->data['breadcrumbs']= array("1" => "Project Lists");
        $this->data['show'] = $this->ProjectModel->show();
        $this->data['engr'] = $this->ProjectModel->engr();
        $this->data['arch'] = $this->ProjectModel->arch();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Head/Navigation/Left');
        $this->load->view('Pages/Head/index');
        $this->load->view('Components/Footer');
    }

    public function View($project_id=null){
        $this->data['title'] = "View Project - Technical Department";
        $this->data['nav'] = "View Project";
        $this->data['breadcrumbs']= array("1" => "Projects Lists", "2" => "View Project");
        $this->data['show'] = $this->ProjectModel->show();
        $this->data['engr'] = $this->ProjectModel->engr_();
        $this->data['project'] = $this->ProjectModel->edit($project_id);
        $this->data['first'] = $this->AccountModel->edit($this->data['project']['first_ea']);
        $this->data['second'] = $this->AccountModel->edit($this->data['project']['second_ea']);
        $this->data['third'] = $this->AccountModel->edit($this->data['project']['third_ea']);
        $this->data['workers'] = $this->WorkerModel->worker($project_id);
        $this->data['check'] = $this->ProjectModel->showCheck($project_id);
        $this->data['photo'] = $this->ProjectModel->showPhoto($project_id);
        $this->data['request'] = $this->RequestModel->showAll($project_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Head/Navigation/Left');
        $this->load->view('Pages/Head/View');
        $this->load->view('Pages/Head/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Accounts(){
        $this->data['title'] = "HR Accounts Lists - Head";
        $this->data['nav'] = "Accounts";
        $this->data['breadcrumbs']= array("1" => "Accounts Lists");
        $this->data['show'] = $this->AccountModel->show($role=6); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Head/Navigation/Left');
        $this->load->view('Pages/Head/Account');
        $this->load->view('Pages/Head/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Add($action){
        if ($action=="add"){
            if(!isset($_POST['btn-addHR'])){
                redirect('Head/Accounts');
            }
            $config = array(
                array (
                    'field' => 'surname',
                    'label' => 'Surname',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'firstname',
                    'label' => 'Firstname',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'middlename',
                    'label' => 'Middlename',    
                    'rules' => 'trim|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'email',
                    'label' => 'Email Address',
                    'rules' => 'trim|required|valid_email',
                    'errors' => array(
                                    'valid_email' => '*Invalid %s.',
                                ),
                ),
                array (
                    'field' => 'contact',
                    'label' => 'Contact Number',
                    'rules' => 'trim|required|max_length[11]|min_length[11]|numeric',
                    'errors' => array(
                                    'max_length' => '*Too much value.',
                                    'min_length' => '*Incomplete value.',
                                    'numeric' => '*Invalid %s.',
                                ),
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                } else {
                    $username = rand(1111,9999);
                    $surname = $this->input->post('surname');
                    $firstname = $this->input->post('firstname');
                    $middlename = $this->input->post('middlename');
                    $email = $this->input->post('email');
                    $contact = $this->input->post('contact');
                    $role = 6;
                    $check = $this->AccountModel->check($surname,$firstname,$middlename,$email);
                    if($check == true){
                        $this->session->set_flashdata('error', 'Data is already exist.');
                    }else{
                    $result = $this->AccountModel->add($username,$surname,$firstname,$middlename,$email,$contact,$role,'');
                        if ($result){
                            $this->session->set_flashdata('success', 'Successfully added.');
                        }else{
                            $this->session->set_flashdata('error','Error Inserting');
                        }redirect('Head/Accounts','refresh');
                    }
                    redirect('Head/Accounts','refresh');
                }
            $this->data['title'] = "HR Accounts Lists - Head";
            $this->data['nav'] = "Accounts";
            $this->data['breadcrumbs']= array("1" => "Accounts Lists");
            $this->data['show'] = $this->AccountModel->show($role=6); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Head/Navigation/Left');
            $this->load->view('Pages/Head/Account');
            $this->load->view('Pages/Head/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function Edit($account_id=null){
        $this->data['title'] = "Edit Account - Head";
        $this->data['nav'] = "Edit Account";
        $this->data['breadcrumbs']= array("1" => "Accounts Lists", "2" => "Edit Account");
        $this->data['show'] = $this->AccountModel->show($role=6); 
        $this->data['edit'] = $this->AccountModel->edit($account_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Head/Navigation/Left');
        $this->load->view('Pages/Head/Edit');
        $this->load->view('Pages/Head/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Status($action=null,$account_id=null){
        if ($action=="update"){
            $getresult = $this->AccountModel->edit($account_id);
            $account_status = $this->input->post('account_status');
            if($account_status == ""){
                $this->session->set_flashdata('error','This field is required');
                redirect('Head/Edit/'.$account_id,'refresh');
            }
            if ($account_id == $this->userlog){
                $this->session->set_flashdata('error','Invalid to change');
                redirect('Head/Edit/'.$account_id,'refresh');
            }
            if ($account_status == $getresult['account_status']){
                $this->session->set_flashdata('success', 'Account status has been changed');
                redirect('Head/Edit/'.$account_id,'refresh');
            } else {
            $result = $this->AccountModel->update($account_id,$account_status);
                if ($result){
                    $this->session->set_flashdata('success', 'Account status has been changed');
                }else{
                    $this->session->set_flashdata('error','Error Inserting');
                } 
                redirect('Head/Edit/'.$account_id,'refresh');
            }
            redirect('Head/Edit/'.$account_id,'refresh');
        }
    }

    public function AccountSettings(){
        $this->data['title'] = "Accounts Settings - Head";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Head/Navigation/Left');
        $this->load->view('Pages/Head/Settings');
        $this->load->view('Components/Footer');
    }

    public function General($action){
        if ($action=="update"){
            if(!isset($_POST['btn-update'])){
                redirect('Head/AccountSettings');
            }
            $config = array(
                array (
                    'field' => 'surname',
                    'label' => 'Surname',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'firstname',
                    'label' => 'Firstname',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'middlename',
                    'label' => 'Middlename',    
                    'rules' => 'trim|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'email',
                    'label' => 'Email Address',
                    'rules' => 'trim|required|valid_email',
                    'errors' => array(
                                    'valid_email' => '*Invalid %s.',
                                ),
                ),
                array (
                    'field' => 'contact',
                    'label' => 'Contact Number',
                    'rules' => 'trim|required|max_length[11]|min_length[11]|numeric',
                    'errors' => array(
                                    'max_length' => '*Too much value.',
                                    'min_length' => '*Incomplete value.',
                                    'numeric' => '*Invalid %s.',
                                ),
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                } else {
                    $surname = $this->input->post('surname');
                    $firstname = $this->input->post('firstname');
                    $middlename = $this->input->post('middlename');
                    $email = $this->input->post('email');
                    $contact = $this->input->post('contact');
                    $check = $this->AccountModel->checkexist($surname,$firstname,$middlename,$email,$this->userlog);
                    if($check == false){
                        $this->session->set_flashdata('error', 'Data is already exist.');
                    }else{
                    $result = $this->AccountModel->updateGeneral($surname,$firstname,$middlename,$email,$contact,$this->userlog);
                        if ($result){
                            $this->session->set_flashdata('success', 'Successfully changed.');
                        }else{
                            $this->session->set_flashdata('error','Error Inserting');
                        }redirect('Head/AccountSettings','refresh');
                    }
                    redirect('Head/AccountSettings','refresh');
                }
            $this->data['title'] = "Accounts Settings - Head";
            $this->data['nav'] = "Accounts Settings";
            $this->data['breadcrumbs']= array("1" => "Accounts Settings");
            $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Head/Navigation/Left');
            $this->load->view('Pages/Head/Settings');
            $this->load->view('Components/Footer');
        }
    }    

    public function Password($action=null){
        if ($action=="update"){
                if(!isset($_POST['btn-update'])){
                redirect('Head/AccountSettings','refresh');
            }
            $config = array(
                array (
                    'field' => 'current',
                    'label' => 'Old Password',
                    'rules' => 'trim|required|alpha_numeric',
                    'errors' => array(
                                    'required' => '%s Field is required.',
                                    'alpha_numeric' => 'No Spacing Allowed.',
                                ),
                ),
                array (
                    'field' => 'confirmpass',
                    'label' => 'Confirm Password',
                    'rules' => 'trim|required|alpha_numeric',
                    'errors' => array(
                                    'required' => '%s Field is required.',
                                    'alpha_numeric' => 'No Spacing Allowed.',
                                ),
                ),
                array (
                    'field' => 'newpass',
                    'label' => 'New Password',
                    'rules' => 'trim|required|alpha_numeric|matches[confirmpass]',
                    'errors' => array(
                                    'required' => '%s Field is required.',
                                    'alpha_numeric' => 'No Spacing Allowed.',
                                    'matches' => 'Password not match.',
                                ),
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', 'Invalid Password');
                } else {
                    $current = $this->input->post('current');
                    $newpass = password_hash($this->input->post('newpass'), PASSWORD_BCRYPT);
                    if (password_verify($current, $this->data['userdetails']['password'])){

                        $result = $this->AccountModel->updatePassword($this->userlog, $newpass);
                        if ($result){
                            $this->session->set_flashdata('success', 'Password has been changed.');
                        }else{
                            $this->session->set_flashdata('error','Error Inserting');
                        }
                        redirect('Head/AccountSettings' , 'refresh');
                    } else {
                        $this->session->set_flashdata('error','Wrong Old Password');
                        redirect('Head/AccountSettings' , 'refresh');
                    }
                }
            }
        $this->data['title'] = "Accounts Settings - Head";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Head/Navigation/Left');
        $this->load->view('Pages/Head/Settings');
        $this->load->view('Components/Footer');
    }



}
