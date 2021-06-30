<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {
	private $userlog;
    private $data;
    private $maintenance;


	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		$this->userlog = $this->session->userdata('account_id');
		if( $this->session->userdata('account_id') != ""){
			switch ($this->session->userdata('role')) {
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

                case 7:
                redirect('Head');
                break;
                
                default:
                  show_404();
                break;
            }
		}
	}
	public function index(){
		$this->load->view('Pages/login.php', $this->data);
	}

	public function loginUser($action){
		if($action=="submit"){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
        	$result = $this->LoginModel->loginUser($username);
        	if($result != ""){
        		if(password_verify($password,$result['password']) && $result['account_status'] == 1){
                    $listSession = array(
                            'account_id' => $result['account_id'],
                            'role' => $result['role'],
                        );
                    $this->session->set_userdata($listSession);
        			switch ($result['role']) {
        				case 0: redirect('Developer'); break;
    					case 1: redirect('Accounting'); break;
                        case 2: redirect('Technical'); break;
                        case 3: redirect('Purchasing'); break;
                        case 4: redirect('EA'); break;
                        case 5: redirect('Warehouse'); break;
                        case 6: redirect('HR'); break;
                        case 7: redirect('Head'); break;
        				default: redirect('login'); break;
        			}
        		} else {
					$this->session->set_flashdata('error','<i class="fa fa-exclamation"></i> Username and Password not match');
        		}
        	}else{
				$this->session->set_flashdata('error','Invalid Account');
        	}
            // redirect('login','refresh');

        }
        $this->load->view('Pages/login.php', $this->data);
	}
}
