<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WarehouseController extends CI_Controller {
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
        if($this->data['userdetails']['role'] != 5){
            $this->userlog = $this->session->unset_userdata('account_id');
            redirect('login');
        }
    }

    public function logout(){
        $this->userlog = $this->session->unset_userdata('account_id');
        redirect('login');
    }


    public function index(){
        $this->data['title'] = "Supply Lists - Warehouse";
        $this->data['nav'] = "Supply Lists";
        $this->data['breadcrumbs']= array("1" => "Supply Lists");
        $this->data['show'] = $this->SupplyModel->show();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Warehouse/Navigation/Left');
        $this->load->view('Pages/Warehouse/index');
        $this->load->view('Pages/Warehouse/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Add($action){
        if ($action=="add"){
            if(!isset($_POST['btn-addSupply'])){
                redirect('Warehouse');
            }
            $config = array(
                array (
                    'field' => 'item',
                    'label' => 'Item',
                    'rules' => 'trim|required',
                ),
                array (
                    'field' => 'description',
                    'label' => 'Descriptionr',
                    'rules' => 'trim|required',
                ),
                array (
                    'field' => 'unit',
                    'label' => 'Unit',
                    'rules' => 'trim|required',
                ),
                array (
                    'field' => 'quantity',
                    'label' => 'Quantity',
                    'rules' => 'trim|required|regex_match[/^[0-9]*$/]',
                ),
                array (
                    'field' => 'supplier',
                    'label' => 'Supplier',
                    'rules' => 'trim|required|alpha_numeric_spaces',
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', 'All fields are required');
                } else {
                    $item = $this->input->post('item');
                    $description = $this->input->post('description');
                    $unit = $this->input->post('unit');
                    $quantity = $this->input->post('quantity');
                    $supplier = $this->input->post('supplier');
                    $check = $this->SupplyModel->check($item,$description,$unit);
                        if($check == true){
                            $this->session->set_flashdata('error', 'Data is already exist.');
                        }else{
                            if ($quantity <= 5){
                                $supply_status = 2;
                            } elseif ($quantity > 5){
                                $supply_status = 1;
                            } elseif ($quantity == 0){
                                $supply_status = 3;
                            }
                        $result = $this->SupplyModel->add($item,$description,$unit,$quantity,$supplier,$supply_status);
                            if ($result){
                                $this->session->set_flashdata('success','Successfully Added');
                            }else{
                                $this->session->set_flashdata('error','Error Inserting');
                            }redirect('Warehouse');
                        }redirect('Warehouse');
                }
            $this->data['title'] = "Supply Lists - Warehouse";
            $this->data['nav'] = "Supply Lists";
            $this->data['breadcrumbs']= array("1" => "Supply Lists");
            $this->data['show'] = $this->SupplyModel->show();
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Warehouse/Navigation/Left');
            $this->load->view('Pages/Warehouse/index');
            $this->load->view('Pages/Warehouse/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function Edit($supply_id=null){
        $this->data['title'] = "Edit Supply - Warehouse";
        $this->data['nav'] = "Edit Supply";
        $this->data['breadcrumbs']= array("1" => "Supply Lists", "2" => "Edit Supply");
        $this->data['show'] = $this->SupplyModel->show();
        $this->data['edit'] = $this->SupplyModel->edit($supply_id);
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Warehouse/Navigation/Left');
        $this->load->view('Pages/Warehouse/Edit');
        $this->load->view('Pages/Warehouse/Navigation/Right');
        $this->load->view('Components/Footer');
    }

    public function Update($action=null, $supply_id=null){
        if ($action=="update"){
            if(!isset($_POST['btn-editSupply'])){
                redirect('Warehouse');
            }
            $config = array(
                array (
                    'field' => 'item',
                    'label' => 'Item',
                    'rules' => 'trim|required'
                     
                ),
                array (
                    'field' => 'description',
                    'label' => 'Description',
                    'rules' => 'trim|required'
             
                ),
                array (
                    'field' => 'unit',
                    'label' => 'Unit',
                    'rules' => 'trim|required',
                ),
                array (
                    'field' => 'quantity',
                    'label' => 'Quantity',
                    'rules' => 'trim|required|regex_match[/^[0-9]*$/]',
                ),
                array (
                    'field' => 'supplier',
                    'label' => 'Supplier',
                    'rules' => 'trim|required|alpha_numeric_spaces',
                ),
            );
            $this->form_validation->set_rules($config);
                if($this->form_validation->run() == FALSE){
                    $this->session->set_flashdata('error', 'All fields are required');
                } else {
                    $item = $this->input->post('item');
                    $description = $this->input->post('description');
                    $unit = $this->input->post('unit');
                    $quantity = $this->input->post('quantity');
                    $supplier = $this->input->post('supplier');
                    $check = $this->SupplyModel->checkexist($item,$description,$unit,$supply_id);
                        if($check == false){
                            $this->session->set_flashdata('error', 'Data is already exist.');
                        }else{
                            if ($quantity <= 5){
                                $supply_status = 2;
                            } elseif ($quantity > 5){
                                $supply_status = 1;
                            } elseif ($quantity == 0){
                                $supply_status = 3;
                            }
                        
                        $result = $this->SupplyModel->update($supply_id,$item,$description,$unit,$quantity,$supplier,$supply_status);
                            if ($result){
                                $this->session->set_flashdata('success','Successfully Changed');
                            }else{
                                $this->session->set_flashdata('error','Error Inserting');
                            }redirect('Warehouse','refresh');
                        }redirect('Warehouse','refresh');
                }
            $this->data['title'] = "Edit Supply - Warehouse";
            $this->data['nav'] = "Edit Supply";
            $this->data['breadcrumbs']= array("1" => "Supply Lists", "2" => "Edit Supply");
            $this->data['show'] = $this->SupplyModel->show();
            $this->data['edit'] = $this->SupplyModel->edit($supply_id);
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Warehouse/Navigation/Left');
            $this->load->view('Pages/Warehouse/Edit');
            $this->load->view('Pages/Warehouse/Navigation/Right');
            $this->load->view('Components/Footer');
        }
    }

    public function Order(){
        $this->data['title'] = "Order Lists - Warehouse";
        $this->data['nav'] = "Order";
        $this->data['breadcrumbs']= array("1" => "Order Lists");
        $this->data['show'] = $this->RequestModel->showWarehouse();
        $this->data['today'] = $this->OrderModel->today_();
        $this->data['denied'] = $this->OrderModel->denied_();
        $this->data['verified'] = $this->OrderModel->verified_();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Warehouse/Navigation/Left');
        $this->load->view('Pages/Warehouse/Order');
        $this->load->view('Pages/Warehouse/Navigation/Right');
        $this->load->view('Components/Footer');
    }

     public function Verify($request_id=null){
        $pincode = $this->input->post('pincode');
        if ($pincode == $this->data['userdetails']['pincode']){
            $request_status = 5;
            $get = $this->RequestModel->get($request_id);
            $select = $this->SupplyModel->edit($get['supply_id']);
            $solution = $select['stocks'] - $get['quantity'];
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $order_status = 3;
                $stocks = $this->SupplyModel->updateStocks($get['supply_id'], $solution);
                $result = $this->OrderModel->add($request_id,$order_status);
                $this->session->set_flashdata('success2', 'Request has been Confirmed');
            }else{
                $this->session->set_flashdata('error2','Error Inserting');
            } 
            redirect('Warehouse/Order','refresh');
        } else {
            $this->session->set_flashdata('error2','Invalid Pincode');
        }redirect('Warehouse/Order','refresh');
    }

    public function Deny($request_id=null){
        $pincode = $this->input->post('pincode');
        if ($pincode == $this->data['userdetails']['pincode']){
            $request_status = 9;
            $result = $this->RequestModel->updateStatus($request_id,$request_status);
            if ($result){
                $order_status = 4;
                $result = $this->OrderModel->add($request_id,$order_status);
                $this->session->set_flashdata('success2', 'Request has been Denied');
            }else{
                $this->session->set_flashdata('error2','Error Inserting');
            } 
            redirect('Warehouse/Order','refresh');
        } else {
            $this->session->set_flashdata('error2','Invalid Pincode');
        }redirect('Warehouse/Order','refresh');
    }

    public function Report(){
        $this->data['title'] = "Report - Warehouse Department";
        $this->data['nav'] = "Report";
        $this->data['breadcrumbs']= array("1" => "Report");
        $this->data['show'] = $this->OrderModel->show_();
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Warehouse/Navigation/Left');
        $this->load->view('Pages/Warehouse/Report');
        $this->load->view('Components/Footer');
    }

    public function Print_data(){
        $this->data['show'] = $this->OrderModel->show_();
        $this->load->view('Pages/Print/OrderedReport',$this->data);
    }

    public function AccountSettings(){
        $this->data['title'] = "Accounts Settings - Developer";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Warehouse/Navigation/Left');
        $this->load->view('Pages/Warehouse/Settings');
        $this->load->view('Components/Footer');
    }

    public function General($action){
        if ($action=="update"){
            if(!isset($_POST['btn-update'])){
                redirect('Warehouse/AccountSettings');
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
                        }redirect('Warehouse/AccountSettings','refresh');
                    }
                    redirect('Warehouse/AccountSettings','refresh');
                }
            $this->data['title'] = "Accounts Settings - Warehouse";
            $this->data['nav'] = "Accounts Settings";
            $this->data['breadcrumbs']= array("1" => "Accounts Settings");
            $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
            $this->load->view('Components/Header',$this->data);
            $this->load->view('Pages/Warehouse/Navigation/Left');
            $this->load->view('Pages/Warehouse/Settings');
            $this->load->view('Components/Footer');
        }
    }    

    public function Password($action=null){
        if ($action=="update"){
                if(!isset($_POST['btn-update'])){
                redirect('Warehouse/AccountSettings','refresh');
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
                        redirect('Warehouse/AccountSettings' , 'refresh');
                    } else {
                        $this->session->set_flashdata('error','Wrong Old Password');
                        redirect('Warehouse/AccountSettings' , 'refresh');
                    }
                }
            }
        $this->data['title'] = "Accounts Settings - Warehouse";
        $this->data['nav'] = "Accounts Settings";
        $this->data['breadcrumbs']= array("1" => "Accounts Settings");
        $this->data['edit'] = $this->AccountModel->edit($this->userlog); 
        $this->load->view('Components/Header',$this->data);
        $this->load->view('Pages/Warehouse/Navigation/Left');
        $this->load->view('Pages/Warehouse/Settings');
        $this->load->view('Components/Footer');
    }



}
