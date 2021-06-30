<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountingController extends CI_Controller {
    private $data;
    private $userlog;
    private $role;


    public function __construct(){
        parent::__construct();
        $this->load->model('SessionModel');
        $this->load->model('LoginModel');
        $this->load->model('RequestModel');
        $this->load->model('AccountModel');
        $this->load->model('OrderModel');
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

                case 7:
                redirect('Head');
                break;
            }
        } else { 
            redirect('login');
        }
        if($this->data['userdetails']['role'] != 1){
            $this->userlog = $this->session->unset_userdata('account_id');
            redirect('login');
        }
    }

    public function Print_data(){
        $this->data['show'] = $this->OrderModel->show();
        $this->load->view('Pages/Print/OrderedReport',$this->data);
    }


    public function logout(){
        $this->userlog = $this->session->unset_userdata('account_id');
        redirect('login');
    }

    
    public function index(){
        $this->data['title'] = "Order Lists - Accounting Department";
        $this->data['nav'] = "Order";
        $this->data['breadcrumbs']= array("1" => "Order Lists");
        $this->data['show'] = $this->RequestModel->showAccounting();
        $this->data['today'] = $this->OrderModel->today();
        $this->data['denied'] = $this->OrderModel->denied();
        $this->data['verified'] = $this->OrderModel->verified();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Accounting/Navigation/Left');
        $this->load->view('Pages/Accounting/index');
        $this->load->view('Pages/Accounting/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Verify($request_id=null){
        $pincode = $this->input->post('pincode');
        if ($pincode == $this->data['userdetails']['pincode']){
            $request_status = 3;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $order_status = 1;
                $result = $this->OrderModel->add($request_id,$order_status);
                $this->session->set_flashdata('success', 'Order has been Confirmed');
            }else{
                $this->session->set_flashdata('error','Error Inserting');
            } 
            redirect('Accounting','refresh');
        } else {
            $this->session->set_flashdata('error','Invalid Pincode');
        }redirect('Accounting','refresh');
    }

    public function Deny($request_id=null){
        $pincode = $this->input->post('pincode');
        if ($pincode == $this->data['userdetails']['pincode']){
            $request_status = 7;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $order_status = 2;
                $result = $this->OrderModel->add($request_id,$order_status);
                $this->session->set_flashdata('success', 'Order has been Denied');
            }else{
                $this->session->set_flashdata('error','Error Inserting');
            } 
            redirect('Accounting','refresh');
        } else {
            $this->session->set_flashdata('error','Invalid Pincode');
        }redirect('Accounting','refresh');
    }

    public function Report(){
        $this->data['title'] = "Report - Accounting Department";
        $this->data['nav'] = "Report";
        $this->data['breadcrumbs']= array("1" => "Report");
        $this->data['show'] = $this->OrderModel->show();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Accounting/Navigation/Left');
        $this->load->view('Pages/Accounting/Report');
        $this->load->view('Components/Footer');
    }



    public function AccountSettings(){
        $this->data['title'] = "Accounts Settings - Accounting Department";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Accounting/Navigation/Left');
        $this->load->view('Pages/Accounting/Settings');
        $this->load->view('Components/Footer');
    }

    public function General($action){
        if ($action=="update"){
            if(!isset($_POST['btn-update'])){
                redirect('Accounting/AccountSettings');
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
                        }redirect('Accounting/AccountSettings','refresh');
                    }
                    redirect('Accounting/AccountSettings','refresh');
                }
            $this->data['title'] = "Accounts Settings - Accounting";
            $this->data['nav'] = "Accounts Settings";
            $this->data['breadcrumbs']= array("1" => "Accounts Settings");
            $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Accounting/Navigation/Left');
            $this->load->view('Pages/Accounting/Settings');
            $this->load->view('Components/Footer');
        }
    }    

    public function Password($action=null){
        if ($action=="update"){
                if(!isset($_POST['btn-update'])){
                redirect('Accounting/AccountSettings','refresh');
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
                        redirect('Accounting/AccountSettings' , 'refresh');
                    } else {
                        $this->session->set_flashdata('error','Wrong Old Password');
                        redirect('Accounting/AccountSettings' , 'refresh');
                    }
                }
            }
        $this->data['title'] = "Accounts Settings - Accounting";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Accounting/Navigation/Left');
        $this->load->view('Pages/Accounting/Settings');
        $this->load->view('Components/Footer');
    }


}
