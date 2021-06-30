<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TechnicalController extends CI_Controller {
    private $data;
    private $userlog;
    private $role;


    public function __construct(){
        parent::__construct();
        $this->load->model('SessionModel');
        $this->load->model('LoginModel');
        $this->load->model('ProjectModel');
        $this->load->model('AccountModel');
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

                case 7:
                redirect('Head');
                break;
            }
        } else { 
            redirect('login');
        }
        if($this->data['userdetails']['role'] != 2){
            $this->userlog = $this->session->unset_userdata('account_id');
            redirect('login');
        }
    }

    public function logout(){
        $this->userlog = $this->session->unset_userdata('account_id');
        redirect('login');
    }


    public function index(){
        $this->data['title'] = "Projects Lists - Technical Department";
        $this->data['nav'] = "Projects Lists";
        $this->data['breadcrumbs']= array("1" => "Projects Lists");
        $this->data['show'] = $this->ProjectModel->show();
        $this->data['engr'] = $this->ProjectModel->engr();
        $this->data['arch'] = $this->ProjectModel->arch();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Technical/Navigation/Left');
        $this->load->view('Pages/Technical/index');
        $this->load->view('Pages/Technical/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Add($action){
        if ($action=="add"){
            if(!isset($_POST['btn-addProject'])){
                redirect('Technical');
            }
            $config = array(
                array (
                    'field' => 'project_name',
                    'label' => 'Project Name',
                    'rules' => 'trim|required',
                ),
                array (
                    'field' => 'first_ea',
                    'label' => 'First Engineer',
                    'rules' => 'trim|regex_match[/^[0-9 a]*$/]',
                ),
                array (
                    'field' => 'second_ea',
                    'label' => 'Second Engineer',
                    'rules' => 'trim|regex_match[/^[0-9 b]*$/]',
                ),
                array (
                    'field' => 'third_ea',
                    'label' => 'Third Engineer',
                    'rules' => 'trim|regex_match[/^[0-9 c]*$/]',
                ),
                array (
                    'field' => 'budget',
                    'label' => 'Budget',
                    'rules' => 'trim|required|numeric',
                ),
                array (
                    'field' => 'start_date',
                    'label' => 'Start Date',    
                    'rules' => 'trim|required|date',
                ),
                array (
                    'field' => 'end_date',
                    'label' => 'End Date',    
                    'rules' => 'trim|required|date',
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', 'All fields are required');
                } else {
                    $type = $this->input->post('type');
                    $project_name = $this->input->post('project_name');
                    $budget = $this->input->post('budget');
                    $s = $this->input->post('start_date');
                    $e = $this->input->post('end_date');
                    $start_date = date('F d, Y' , strtotime($s));
                    $end_date = date('F d, Y' , strtotime($e));
                    $first_ea = $this->input->post('first_ea');
                    $second_ea = $this->input->post('second_ea');
                    $third_ea = $this->input->post('third_ea');
                    $date = date('Y-m-d');
                    if ($s < $date){
                        $this->session->set_flashdata('error', 'Invalid Start Date.');
                    } else {
                        if ($first_ea == "" && $second_ea == "" && $third_ea == ""){
                            $this->session->set_flashdata('error', 'Engineer are required at least one.');
                        }
                        elseif ($first_ea == $second_ea || $first_ea == $third_ea || $second_ea == $third_ea){
                            $this->session->set_flashdata('error', 'Engineer is already selected.');
                        }
                        else {
                        $check = $this->ProjectModel->check($project_name);
                            if($check == true){
                                $this->session->set_flashdata('error', 'Data is already exist.');
                            }else{
                            $result = $this->ProjectModel->add($first_ea,$second_ea,$third_ea,$project_name,$budget,$start_date,$end_date);
                            $get = $this->ProjectModel->getNew($project_name);
                                if ($result){
                                    $this->session->set_flashdata('success','New Project has been added');
                                }else{
                                    $this->session->set_flashdata('error','Error Inserting');
                                }redirect('Technical','refresh');
                            }redirect('Technical','refresh');
                        }redirect('Technical','refresh');
                    }
                }
            $this->data['title'] = "Projects Lists - Technical Department";
            $this->data['nav'] = "Projects Lists";
            $this->data['breadcrumbs']= array("1" => "Projects Lists");
            $this->data['show'] = $this->ProjectModel->show();
            $this->data['engr'] = $this->ProjectModel->engr();
            $this->data['arch'] = $this->ProjectModel->arch();
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Technical/Navigation/Left');
            $this->load->view('Pages/Technical/index');
            $this->load->view('Pages/Technical/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function Add_($action){
        if ($action=="add"){
            if(!isset($_POST['btn-addproject'])){
                redirect('Technical');
            }
            $config = array(
                array (
                    'field' => 'xproject_name',
                    'label' => 'Project Name',
                    'rules' => 'trim|required',
                ),
                array (
                    'field' => 'xfirst_ea',
                    'label' => 'First Engineer',
                    'rules' => 'trim|regex_match[/^[0-9 a]*$/]',
                ),
                array (
                    'field' => 'xsecond_ea',
                    'label' => 'Second Engineer',
                    'rules' => 'trim|regex_match[/^[0-9 b]*$/]',
                ),
                array (
                    'field' => 'xthird_ea',
                    'label' => 'Third Engineer',
                    'rules' => 'trim|regex_match[/^[0-9 c]*$/]',
                ),
                array (
                    'field' => 'xbudget',
                    'label' => 'Budget',
                    'rules' => 'trim|required|numeric',
                ),
                array (
                    'field' => 'xstart_date',
                    'label' => 'Start Date',    
                    'rules' => 'trim|required|date',
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', 'All fields are required');
                } else {
                    $type = $this->input->post('xtype');
                    $project_name = $this->input->post('xproject_name');
                    $budget = $this->input->post('xbudget');
                    $s = $this->input->post('xstart_date');
                    $start_date = date('F d, Y' , strtotime($s));
                    $end_date = '';
                    $first_ea = $this->input->post('xfirst_ea');
                    $second_ea = $this->input->post('xsecond_ea');
                    $third_ea = $this->input->post('xthird_ea');
                    $date = date('Y-m-d');
                    if ($s < $date){
                        $this->session->set_flashdata('error', 'Invalid Start Date.');
                    } else {
                        if ($first_ea == "" && $second_ea == "" && $third_ea == ""){
                            $this->session->set_flashdata('error', 'Architect are required at least one.');
                        }
                        elseif ($first_ea == $second_ea || $first_ea == $third_ea || $second_ea == $third_ea){
                            $this->session->set_flashdata('error', 'Architect is already selected.');
                        }
                        else {
                        $check = $this->ProjectModel->check($project_name);
                            if($check == true){
                                $this->session->set_flashdata('error', 'Data is already exist.');
                            }else{
                            $result = $this->ProjectModel->add($first_ea,$second_ea,$third_ea,$project_name,$budget,$start_date,$end_date);
                            $get = $this->ProjectModel->getNew($project_name);
                                if ($result){
                                    $this->session->set_flashdata('success','New Project has been added');
                                }else{
                                    $this->session->set_flashdata('error','Error Inserting');
                                }redirect('Technical','refresh');
                            }redirect('Technical','refresh');
                        }redirect('Technical','refresh');
                    }
                }
            $this->data['title'] = "Projects Lists - Technical Department";
            $this->data['nav'] = "Projects Lists";
            $this->data['breadcrumbs']= array("1" => "Projects Lists");
            $this->data['show'] = $this->ProjectModel->show();
            $this->data['engr'] = $this->ProjectModel->engr();
            $this->data['arch'] = $this->ProjectModel->arch();
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Technical/Navigation/Left');
            $this->load->view('Pages/Technical/index');
            $this->load->view('Pages/Technical/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function Edit($project_id){
        $this->data['title'] = "Edit Project - Technical Department";
        $this->data['nav'] = "Edit Public Project";
        $this->data['breadcrumbs']= array("1" => "Projects Lists", "2" => "Edit Project");
        $this->data['show'] = $this->ProjectModel->show();
        $this->data['engr'] = $this->ProjectModel->engr_();
        $this->data['edit'] = $this->ProjectModel->edit($project_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Technical/Navigation/Left');
        $this->load->view('Pages/Technical/Edit');
        $this->load->view('Pages/Technical/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function UpdateProjects() {
        $config = array(
            array (
                'field' => 'project_name',
                'label' => 'Project Name',
                'rules' => 'trim|required',
                'errors' => array(
                    'regex_match' => '*Letters Only.',
                ),
            ),

            // array (
            //     'field' => 'first_ea',
            //     'label' => 'First Engineer',
            //     'rules' => 'trim|regex_match[/^[0-9 a]*$/]',
            // ),
            // array (
            //     'field' => 'second_ea',
            //     'label' => 'Second Engineer',
            //     'rules' => 'trim|regex_match[/^[0-9 b]*$/]',
            // ),
            // array (
            //     'field' => 'third_ea',
            //     'label' => 'Third Engineer',
            //     'rules' => 'trim|regex_match[/^[0-9 c]*$/]',
            // ),
            array (
                'field' => 'project_budget',
                'label' => 'Budget',
                'rules' => 'trim|required|numeric',
            ),
            array (
                'field' => 'start_date',
                'label' => 'Start Date',    
                'rules' => 'trim|required|date',
            ),
            array (
                'field' => 'end_date',
                'label' => 'End Date',    
                'rules' => 'trim|required|date',
            ),
        );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('error', 'All fields are required');
                redirect('Technical', 'refresh');
            } else {
                $project_id = $this->input->post('project_id');
                $type = $this->input->post('type');
                $project_name = $this->input->post('project_name');
                $budget = $this->input->post('project_budget');
                $s = $this->input->post('start_date');
                $e = $this->input->post('end_date');
                $start_date = date('F d, Y', strtotime($s));
                $end_date = date('F d, Y', strtotime($e));
                $first_ea = $this->input->post('first_ea');
                $second_ea = $this->input->post('second_ea');
                $third_ea = $this->input->post('third_ea');
                $date = date('Y-m-d');
                $result = $this->ProjectModel->updateProject($project_id, $first_ea, $second_ea, $third_ea, $project_name, $budget, $start_date, $end_date);
                if ($result) {
                    $this->session->set_flashdata('success', 'Project has been Updated');
                } else {
                    $this->session->set_flashdata('error', 'Error Inserting');
                }
                redirect('Technical', 'refresh');
            }
    }

    public function Edit_($project_id){
        $this->data['title'] = "Edit Project - Technical Department";
        $this->data['nav'] = "Edit Private Project";
        $this->data['breadcrumbs']= array("1" => "Projects Lists", "2" => "Edit Project");
        $this->data['show'] = $this->ProjectModel->show();
        $this->data['arch'] = $this->ProjectModel->arch_();
        $this->data['edit'] = $this->ProjectModel->edit($project_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Technical/Navigation/Left');
        $this->load->view('Pages/Technical/Edit');
        $this->load->view('Pages/Technical/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function UpdateStatus($action=null,$project_id=null){
        if ($action=="update"){
            $get = $this->ProjectModel->edit($project_id);
            $pincode = $this->input->post('pincode');
            if ($pincode == $this->data['userdetails']['pincode']){
                $result = $this->ProjectModel->update($project_id);
                if ($result){
                    $this->session->set_flashdata('success', 'Project Successfully Done');
                }else{
                    $this->session->set_flashdata('error','Error Inserting');
                } 
                redirect('Technical','refresh');
            } else {
                $this->session->set_flashdata('error','Error Inserting');
            }
            redirect('Technical','refresh');
        }
    }

    public function UpdateChecklist($action=null,$check_id=null){
        if ($action=="update"){
            $pincode = $this->input->post('pincode');
            $project_id = $this->input->post('project_id');
            $start = $this->input->post('start');
            $data = array(
                'check_id' => $check_id,
                'start' => $start
            );
            if ($pincode == $this->data['userdetails']['pincode']){
                $result = $this->ProjectModel->UpdateCheckList($data);
                if ($result){
                    $this->session->set_flashdata('success', 'Task has been updated');
                }else{
                    $this->session->set_flashdata('error','Error Inserting');
                } 
                redirect('Technical/Project/Checklist/'.$project_id,'refresh');
            } else {
                $this->session->set_flashdata('error','Error Inserting');
            }
            redirect('Technical/Project/Checklist/'.$project_id,'refresh');
        }
    }

    public function Checklist($project_id){
        $this->data['title'] = "Project Checklist - Technical Department";
        $this->data['nav'] = "Checklist";
        $this->data['breadcrumbs']= array("1" => "Project Checklist");
        $this->data['show'] = $this->ProjectModel->show();
        $this->data['engr'] = $this->ProjectModel->engr_();
        $this->data['edit'] = $this->ProjectModel->edit($project_id);
        $this->data['show'] = $this->ProjectModel->showCheck($project_id);
        $this->data['progress'] = $this->ProjectModel->checkListProgress($project_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Technical/Navigation/Left');
        $this->load->view('Pages/Technical/Checklist');
        $this->load->view('Pages/Technical/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function addCheck($action=null,$project_id=null){
        if ($action=="add"){
            if(!isset($_POST['btn-addCheck'])){
                redirect('Technical/Project/Checklist/'.$project_id);
            }
            $config = array(
                array (
                    'field' => 'task',
                    'label' => 'Tash',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z ñ_]*$/]',
                    'errors' => array(
                                    'regex_match' => '*Letters Only.',
                                ),
                ),
                array (
                    'field' => 'percentage',
                    'label' => 'Task Percentage',
                    'rules' => 'trim|required|regex_match[/^[0-9]*$/]',
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', 'All fields are required');
                } else {
                    $task = $this->input->post('task');
                    $percentage = $this->input->post('percentage');
                    
                    $check = $this->ProjectModel->checkList($project_id,$task);
                        if($check == true){
                            $this->session->set_flashdata('error', 'Data is already exist.');
                        }else{
                        $result = $this->ProjectModel->addCheck($project_id,$task,$percentage,2);
                            if ($result){
                                $this->session->set_flashdata('success','Successfully Added');
                            }else{
                                $this->session->set_flashdata('error','Error Inserting');
                            }redirect('Technical/Project/Checklist/'.$project_id,'refresh');
                        }redirect('Technical/Project/Checklist/'.$project_id,'refresh');
                }
            $this->data['title'] = "Project Checklist - Technical Department";
            $this->data['nav'] = "Checklist";
            $this->data['breadcrumbs']= array("1" => "Project Checklist");
            $this->data['show'] = $this->ProjectModel->show();
            $this->data['engr'] = $this->ProjectModel->engr_();
            $this->data['edit'] = $this->ProjectModel->edit($project_id);
            $this->data['show'] = $this->ProjectModel->showCheck($project_id);
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Technical/Navigation/Left');
            $this->load->view('Pages/Technical/Checklist');
            $this->load->view('Pages/Technical/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function AccountSettings(){
        $this->data['title'] = "Accounts Settings - Technical Department";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Technical/Navigation/Left');
        $this->load->view('Pages/Technical/Settings');
        $this->load->view('Components/Footer');
    }

    public function General($action){
        if ($action=="update"){
            if(!isset($_POST['btn-update'])){
                redirect('Technical/AccountSettings');
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
                        }redirect('Technical/AccountSettings','refresh');
                    }
                    redirect('Technical/AccountSettings','refresh');
                }
            $this->data['title'] = "Accounts Settings - Technical Department";
            $this->data['nav'] = "Accounts Settings";
            $this->data['breadcrumbs']= array("1" => "Accounts Settings");
            $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Technical/Navigation/Left');
            $this->load->view('Pages/Technical/Settings');
            $this->load->view('Components/Footer');
        }
    }    

    public function Password($action=null){
        if ($action=="update"){
                if(!isset($_POST['btn-update'])){
                redirect('Technical/AccountSettings','refresh');
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
                        redirect('Technical/AccountSettings' , 'refresh');
                    } else {
                        $this->session->set_flashdata('error','Wrong Old Password');
                        redirect('Technical/AccountSettings' , 'refresh');
                    }
                }
            }
        $this->data['title'] = "Accounts Settings - Technical Department";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Technical/Navigation/Left');
        $this->load->view('Pages/Technical/Settings');
        $this->load->view('Components/Footer');
    }



}
