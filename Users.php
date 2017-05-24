<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	   public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }



	public function userList()
	{
		 $config = array();
		$config["per_page"] = 4;
		$fromLimit = ($this->uri->segment(3) == '') ? 0 : ($this->uri->segment(3)-1);
		$endLimit = $config["per_page"];
$searchString ='';
		$searchLabel = $this->input->post('usersearch', TRUE);
		$searchData = $this->input->post('searchData', TRUE);
		
		if($searchData == 'search') {
			  $this->session->set_userdata('usersearch', $searchLabel);
            $searchString = $searchLabel;
		} elseif ($this->session->userdata('usersearch')) {
            $searchString = $this->session->userdata('usersearch');
        }
		
		$returnUserDataArray = $this->users_model->getUsersList($searchString,$fromLimit,$endLimit);
		$rowCount = $this->users_model->getUserTotalCount($searchString);
		 
		
		 $config["base_url"] = base_url() . "users/userlist";
		 $config["total_rows"] = $rowCount;
		 
		 $config['use_page_numbers'] = TRUE;
		 $config['num_links'] = $rowCount;
		 $config['cur_tag_open'] = '&nbsp;<a class="current">';
		 $config['cur_tag_close'] = '</a>';
		 $config['next_link'] = 'Next';
		 $config['prev_link'] = 'Previous';
		 $this->pagination->initialize($config);

		 $data["usersearch"] = $searchString ;
		 $data["userData"] = $returnUserDataArray ;
		 $data['page'] = $fromLimit;
		 $data["links"] = $this->pagination->create_links();

		 $this->load->view('usersList',$data);
		
	}
	
	public function addUser() {
		
		try {
			
			$this->load->view('usersAdd');

		} catch (Exception $ex) {
			 log_message('error', $ex->getMessage());
				return $ex->getMessage();
		}
	
	}
	public function saveUser() {
		
		try {
			echo "name---".$name = $this->input->post('name');
			$email = $this->input->post('email');
			$details = $this->input->post('details');
			
			$data = array(
					"name"=>$name,
					"email_id"=>$email,
					"details"=>$details
					);
			$this->users_model->addUser($data);
			redirect(base_url().'users/userlist');
		} catch (Exception $ex) {
			 log_message('error', $ex->getMessage());
				return $ex->getMessage();
		}
	
	}
	
	public function userDelete($userId) {
		
		  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		  
		$returnResult = $this->users_model->userDelete($userId);
        
        redirect(base_url() . 'users/userlist/' . $page);
	}
	
}
