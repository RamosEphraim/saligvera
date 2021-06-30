<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HRController extends CI_Controller {
    private $data;
    private $userlog;
    private $role;


    public function __construct(){
        parent::__construct();
        $this->load->model('SessionModel');
        $this->load->model('LoginModel');
        $this->load->model('AccountModel');
        $this->load->model('ProjectModel');
        $this->load->model('WorkerModel');
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

                case 7:
                redirect('Head');
                break;
            }
        } else { 
            redirect('login');
        }
        if($this->data['userdetails']['role'] != 6){
            $this->userlog = $this->session->unset_userdata('account_id');
            redirect('login');
        }
    }

    public function logout(){
        $this->userlog = $this->session->unset_userdata('account_id');
        redirect('login');
    }


    public function index(){
        $this->data['title'] = "Workers Lists - Human Resource";
        $this->data['nav'] = "Workers Lists";
        $this->data['breadcrumbs']= array("1" => "Workers Lists");
        $this->data['show'] = $this->WorkerModel->show(); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/index');
        $this->load->view('Pages/HR/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Workeradd($action){
        if ($action=="add"){
            if(!isset($_POST['btn-addWorker'])){
                redirect('HR');
            }
            $path = './assets/uploads';
            $filename = date('ymdhis');
            $config = array(
                array (
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'position',
                    'label' => 'Position',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'address',
                    'label' => 'Address',    
                    'rules' => 'trim|required|alpha_numeric_spaces',
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
                    $this->imageUpload($path,$filename);
                    if (!$this->upload->do_upload('worker_img')){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                        redirect('HR' , 'refresh');
                    }else{
                        $image = $this->upload->data();
                        $realname = $filename.$image['file_ext'];
                        $name = $this->input->post('name');
                        $position = $this->input->post('position');
                        $contact = $this->input->post('contact');
                        $address = $this->input->post('address');
                        $check = $this->WorkerModel->check($name,$contact);
                        if($check == true){
                            $this->session->set_flashdata('error', 'Data is already exist.');
                        }else{
                        $result = $this->WorkerModel->add($name,$position,$contact,$address,$realname);
                            if ($result){
                                $this->session->set_flashdata('success', 'Successfully added.');
                            }else{
                                $this->session->set_flashdata('error','Error Inserting');
                            }redirect('HR','refresh');
                        }
                        redirect('HR','refresh');
                    }
                }
            $this->data['title'] = "Workers Lists - Human Resource";
            $this->data['nav'] = "Workers Lists";
            $this->data['breadcrumbs']= array("1" => "Workers Lists");
            $this->data['show'] = $this->WorkerModel->show(); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/HR/Navigation/Left');
            $this->load->view('Pages/HR/index');
            $this->load->view('Pages/HR/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function imageUpload($path,$filename){
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 10000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;
        $config['file_name']            = $filename;
        $this->load->library('upload');
        return $this->upload->initialize($config);
    }

    public function EditWorker($worker_id=null){
        $this->data['title'] = "Edit Worker - Human Resource";
        $this->data['nav'] = "Edit Worker";
        $this->data['breadcrumbs']= array("1" => "Workers Lists", "2" => "Edit Worker");
        $this->data['show'] = $this->WorkerModel->show(); 
        $this->data['edit'] = $this->WorkerModel->edit($worker_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/Edit');
        $this->load->view('Pages/HR/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function UpdateWorker($action=null, $worker_id=null){
        if ($action=="update"){
            if(!isset($_POST['btn-updateWorker'])){
                redirect('HR/Worker/Edit/'.$worker_id);
            }
            $config = array(
                array (
                    'field' => 'name',
                    'label' => 'Name',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'position',
                    'label' => 'Position',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'address',
                    'label' => 'Address',    
                    'rules' => 'trim|required|alpha_numeric_spaces',
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
                    $get = $this->WorkerModel->edit($worker_id);
                    $name = $this->input->post('name');
                    $position = $this->input->post('position');
                    $contact = $this->input->post('contact');
                    $address = $this->input->post('address');
                    $worker_status = $this->input->post('worker_status');
                    $check = $this->WorkerModel->checkexist($name,$contact,$worker_id);
                    if ($check == false){
                        $this->session->set_flashdata('error', 'Data is already exist.');
                    }else{
                        if($worker_status == 1){
                            $project_id = 0;
                        } elseif($worker_status == 2){
                            $project_id = 0;
                        } else {
                            $project_id = $get['project_id'];
                        }
                    $result = $this->WorkerModel->update($name,$position,$contact,$address,$worker_status,$worker_id,$project_id);
                        if ($result){
                            $this->session->set_flashdata('success', 'Successfully Changed.');
                        }else{
                            $this->session->set_flashdata('error','Error Inserting');
                        }redirect('HR/Worker/Edit/'.$worker_id,'refresh');
                    }
                    redirect('HR/Worker/Edit/'.$worker_id,'refresh');
                }
            $this->data['title'] = "Edit Worker - Human Resource";
            $this->data['nav'] = "Edit Worker";
            $this->data['breadcrumbs']= array("1" => "Workers Lists", "2" => "Edit Worker");
            $this->data['show'] = $this->WorkerModel->show(); 
            $this->data['edit'] = $this->WorkerModel->edit($worker_id);
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/HR/Navigation/Left');
            $this->load->view('Pages/HR/Edit');
            $this->load->view('Pages/HR/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function Accounts(){
        $this->data['title'] = "Accounts Lists - Human Resource";
        $this->data['nav'] = "Accounts";
        $this->data['breadcrumbs']= array("1" => "Accounts Lists");
        $this->data['show'] = $this->AccountModel->showUser(); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/Account');
        $this->load->view('Pages/HR/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Add($action){
        if ($action=="add"){
            if(!isset($_POST['btn-addUser'])){
                redirect('HR/Accounts');
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
                array (
                    'field' => 'role',
                    'label' => 'User Type',
                    'rules' => 'trim|required|max_length[1]|min_length[1]|numeric',
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
                    $role = $this->input->post('role');
                    $type = $this->input->post('type');
                    if ($role == 4 && $type == ""){
                        $this->session->set_flashdata('error', 'Error Inserting');
                    }
                    else {
                        $check = $this->AccountModel->check($surname,$firstname,$middlename,$email);
                        if($check == true){
                            $this->session->set_flashdata('error', 'Data is already exist.');
                        }else{
                        $result = $this->AccountModel->add($username,$surname,$firstname,$middlename,$email,$contact,$role,$type);
                            if ($result){
                                $this->session->set_flashdata('success', 'Successfully added.');
                            }else{
                                $this->session->set_flashdata('error','Error Inserting');
                            }redirect('HR/Accounts','refresh');
                        }
                        redirect('HR/Accounts','refresh');
                    }
                }
            $this->data['title'] = "Accounts Lists - Human Resource";
            $this->data['nav'] = "Accounts";
            $this->data['breadcrumbs']= array("1" => "Accounts Lists");
            $this->data['show'] = $this->AccountModel->showUser(); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/HR/Navigation/Left');
            $this->load->view('Pages/HR/Account');
            $this->load->view('Pages/HR/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function Editacc($account_id=null){
        $this->data['title'] = "Edit Account - Human Resource";
        $this->data['nav'] = "Edit Account";
        $this->data['breadcrumbs']= array("1" => "Accounts Lists", "2" => "Edit Account");
        $this->data['show'] = $this->AccountModel->showUser(); 
        $this->data['edit'] = $this->AccountModel->edit($account_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/Editacc');
        $this->load->view('Pages/HR/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Status($action=null,$account_id=null){
        if ($action=="update"){
            $getresult = $this->AccountModel->edit($account_id);
            $account_status = $this->input->post('account_status');
            if($account_status == ""){
                $this->session->set_flashdata('error','This field is required');
                redirect('HR/Edit/'.$account_id,'refresh');
            }
            if ($account_id == $this->userlog){
                $this->session->set_flashdata('error','Invalid to change');
                redirect('HR/Edit/'.$account_id,'refresh');
            }
            if ($account_status == $getresult['account_status']){
                $this->session->set_flashdata('success', 'Account status has been changed');
                redirect('HR/Edit/'.$account_id,'refresh');
            } else {
            $result = $this->AccountModel->update($account_id,$account_status);
                if ($result){
                    $this->session->set_flashdata('success', 'Account status has been changed');
                }else{
                    $this->session->set_flashdata('error','Error Inserting');
                } 
                redirect('HR/Edit/'.$account_id,'refresh');
            }
            redirect('HR/Edit/'.$account_id,'refresh');
        }
    }

    public function Project(){
        $this->data['title'] = "Projects Lists - Human Resource";
        $this->data['nav'] = "Projects Lists";
        $this->data['breadcrumbs']= array("1" => "Projects Lists");
        $this->data['show'] = $this->ProjectModel->show();
        $this->data['engr'] = $this->ProjectModel->engr();
        $this->data['arch'] = $this->ProjectModel->arch();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/Projects');
        $this->load->view('Components/Footer');
    }

    public function Apply($project_id=null){
        if(isset($_POST['btn-apply'])){
            $worker_id = $this->input->post('worker_id[]');
            if($worker_id == ""){
                 $this->session->set_flashdata('error', 'Please select worker');
                 redirect('HR/Project/Apply/'.$project_id);
            }else {
                for($i=0 ; $i < count($_POST['worker_id']) ; $i++){
                    $worker_id = $_POST['worker_id'][$i];
                    $result = $this->WorkerModel->apply($worker_id,$project_id);
                    if($result){
                        $this->session->set_flashdata('success', 'Project Applied.');
                    }else{
                        $this->session->set_flashdata('error', 'Error Applying.');
                    }
                }
                $get = $this->WorkerModel->hw($project_id); 
                $update = $this->ProjectModel->workerStatus($project_id,$get);
            } 
                

        }
        $this->data['title'] = "Apply Worker - Technical Department";
        $this->data['nav'] = "Apply Worker";
        $this->data['breadcrumbs']= array("1" => "Projects Lists", "2" => "Apply Worker");
        $this->data['show'] = $this->WorkerModel->show_(); 
        $this->data['edit'] = $this->ProjectModel->edit($project_id);
        $this->data['first'] = $this->AccountModel->edit($this->data['edit']['first_ea']);
        $this->data['second'] = $this->AccountModel->edit($this->data['edit']['second_ea']);
        $this->data['third'] = $this->AccountModel->edit($this->data['edit']['third_ea']);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/Apply');
        $this->load->view('Components/Footer');
    }

    public function AccountSettings(){
        $this->data['title'] = "Accounts Settings - Human Resource";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/Settings');
        $this->load->view('Components/Footer');
    }

    public function General($action){
        if ($action=="update"){
            if(!isset($_POST['btn-update'])){
                redirect('HR/AccountSettings');
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
                        }redirect('HR/AccountSettings','refresh');
                    }
                    redirect('HR/AccountSettings','refresh');
                }
            $this->data['title'] = "Accounts Settings - Human Resource";
            $this->data['nav'] = "Accounts Settings";
            $this->data['breadcrumbs']= array("1" => "Accounts Settings");
            $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/HR/Navigation/Left');
            $this->load->view('Pages/HR/Settings');
            $this->load->view('Components/Footer');
        }
    }    

    public function Password($action=null){
        if ($action=="update"){
                if(!isset($_POST['btn-update'])){
                redirect('HR/AccountSettings','refresh');
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
                        redirect('HR/AccountSettings' , 'refresh');
                    } else {
                        $this->session->set_flashdata('error','Wrong Old Password');
                        redirect('HR/AccountSettings' , 'refresh');
                    }
                }
            }
        $this->data['title'] = "Accounts Settings - Human Resource";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/HR/Navigation/Left');
        $this->load->view('Pages/HR/Settings');
        $this->load->view('Components/Footer');
    }


}
