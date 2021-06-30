<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurchasingController extends CI_Controller {
    private $data;
    private $userlog;
    private $role;


    public function __construct(){
        parent::__construct();
        $this->load->model('SessionModel');
        $this->load->model('LoginModel');
        $this->load->model('RequestModel');
        $this->load->model('AccountModel');
        $this->load->model('SupplyModel');
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
        if($this->data['userdetails']['role'] != 3){
            $this->userlog = $this->session->unset_userdata('account_id');
            redirect('login');
        }
    }

    public function logout(){
        $this->userlog = $this->session->unset_userdata('account_id');
        redirect('login');
    }

    
    public function index(){
        $this->data['title'] = "Request Lists - Purchasing Department";
        $this->data['nav'] = "Request";
        $this->data['breadcrumbs']= array("1" => "Request Lists");
        $this->data['today'] = $this->RequestModel->today();
        $this->data['order'] = $this->RequestModel->order();
        $this->data['verified'] = $this->RequestModel->verified();
        $this->data['verification'] = $this->RequestModel->verification();
        $this->data['confirm'] = $this->RequestModel->confirm();
        $this->data['confirmed'] = $this->RequestModel->confirmed();
        $this->data['denyorder'] = $this->RequestModel->denyorder();
        $this->data['rejectrequest'] = $this->RequestModel->rejectrequest();
        $this->data['deniedsupply'] = $this->RequestModel->deniedsupply();
        $this->data['declinedsupply'] = $this->RequestModel->declinedsupply();
        $this->data['show'] = $this->RequestModel->show();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Purchasing/Navigation/Left');
        $this->load->view('Pages/Purchasing/index');
        $this->load->view('Pages/Purchasing/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function SendOrder($action=null,$request_id=null){
        if ($action=="send"){
            $request_status = 2;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $this->session->set_flashdata('success', 'Request Supply Status has been Changed');
            }else{
                $this->session->set_flashdata('error','Error Inserting');
            } 
            redirect('Purchasing','refresh');
        }
    }

    public function checkStocks($action=null,$supply_id=null){
        if ($action=="Request"){
            $result = $this->db->get_where('supply_tbl',['supply_id' => $supply_id])->row();
            $stocks = $result->stocks;
            if($stocks <= 10) {
                $this->session->set_flashdata('success', 'Item '.$result->item.'\'s stocks is down to critical level. <br> Stocks Remaining: '.$result->stocks );
            } else {
                $this->session->set_flashdata('success', 'Item '.$result->item.'\'s stocks is available. <br> Stocks Remaining: '.$result->stocks );
            }
            redirect('Purchasing','refresh');
        }
    }

    public function SendSupply($action=null,$request_id=null){
        if ($action=="send"){
            $request_status = 4;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $this->session->set_flashdata('success', 'Request Supply Status has been Changed');
            }else{
                $this->session->set_flashdata('error','Error Inserting');
            } 
            redirect('Purchasing','refresh');
        }
    }

    public function ConfirmedRequest($action=null,$request_id=null){
        if ($action=="send"){
            $request_status = 6;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $this->session->set_flashdata('success', 'Request Supply Status has been Changed');
            }else{
                $this->session->set_flashdata('error','Error Inserting');
            } 
            redirect('Purchasing','refresh');
        }
    }

    public function RejectRequest($action=null,$request_id=null){
        if ($action=="send"){
            $request_status = 8;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $this->session->set_flashdata('success', 'Request Supply Status has been Changed');
            }else{
                $this->session->set_flashdata('error','Error Inserting');
            } 
            redirect('Purchasing','refresh');
        }
    }

    public function DeclineSupply($action=null,$request_id=null){
        if ($action=="send"){
            $request_status = 10;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $this->session->set_flashdata('success', 'Request Supply Status has been Changed');
            }else{
                $this->session->set_flashdata('error','Error Inserting');
            } 
            redirect('Purchasing','refresh');
        }
    }

    public function AccountSettings(){
        $this->data['title'] = "Accounts Settings - Purchasing Department";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Purchasing/Navigation/Left');
        $this->load->view('Pages/Purchasing/Settings');
        $this->load->view('Components/Footer');
    }

    public function General($action){
        if ($action=="update"){
            if(!isset($_POST['btn-update'])){
                redirect('Purchasing/AccountSettings');
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
                        }redirect('Purchasing/AccountSettings','refresh');
                    }
                    redirect('Purchasing/AccountSettings','refresh');
                }
            $this->data['title'] = "Accounts Settings - Purchasing Department";
            $this->data['nav'] = "Accounts Settings";
            $this->data['breadcrumbs']= array("1" => "Accounts Settings");
            $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Purchasing/Navigation/Left');
            $this->load->view('Pages/Purchasing/Settings');
            $this->load->view('Components/Footer');
        }
    }    

    public function Password($action=null){
        if ($action=="update"){
                if(!isset($_POST['btn-update'])){
                redirect('Purchasing/AccountSettings','refresh');
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
                        redirect('Purchasing/AccountSettings' , 'refresh');
                    } else {
                        $this->session->set_flashdata('error','Wrong Old Password');
                        redirect('Purchasing/AccountSettings' , 'refresh');
                    }
                }
            }
        $this->data['title'] = "Accounts Settings - Purchasing Department";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Purchasing/Navigation/Left');
        $this->load->view('Pages/Purchasing/Settings');
        $this->load->view('Components/Footer');
    }



}
