<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
	parent::__construct();
	$this->load->model('user_model');
	$this->load->model('select');
	$this->isLoggedIn(); 
	$this->load->database();  
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
	$this->global['pageTitle'] = 'Neethu k p : Dashboard';

	$this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    // 
    //  public function tasks123()
    // {
    //     // if($this->isAdmin() == TRUE)
    //     // {
    //     //     $this->loadThis(); 
    //     //     $this->load->view('header');
    //     //     $this->load->view('sample');
    //     // }
    //     // $this->load->view('header');
    //     $this->load->view('sample');
    // 

    // user taking exam redirection

    // function test123()
    //     {
    //         if($this->isStudent() == TRUE)
    //         {


    //         $this->load->database();
    //         $query = $this->db->query('SELECT * FROM exam_sub');
    //         foreach ($query->result() as $row) 
    //         $this->load->view('sample');

    //     $searchText = $this->security->xss_clean($this->input->post('searchText'));
    // $data['searchText'] = $searchText;

    // $this->load->library('pagination');

    // $count = $this->user_model->userListingCount($searchText);

    // $returns = $this->paginationCompress ( "userListing/", $count, 10 );

    // $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);

    // $this->global['pageTitle'] = 'Neethu k p : User Listing';

    // $this->loadViews("users", $this->global, $data, NULL); 
    //     }
    //     else
    //     {
    //         $this->loadThis();

    //     }
    // }

    //the function for taking exam by the studet
    //it can only be assed by student

    public function selectvi()  
    {  
	if($this->isStudent() == TRUE)
	{
	    //load the database  
	    $this->load->database();  
	    $this->load->library('pagination');
	    //load the model  
	    $this->load->model('select');  
	    //load the method of model  
	    $data['h']=$this->select->selectSub();  
	    $this->global['pageTitle'] = 'Neethu k p : User Listing';
	    //return the data in view  
	    $this->loadViews('select_view',$this->global, $data); 
	}
	else
	{
	    $this->loadThis();
	} 
    }
    //the end

    public function showResult($sub_id) {
	if($this->isStudent() != TRUE) 
	{
	    $this->loadThis();
	    $this->load->library('pagination');
	}

	$this->load->library('pagination');
	$result = $this->select->get_result($_SESSION['userId'], $sub_id);
	$this->loadViews('result_view', $this->global, ['result'=>$result]);

    }

    public function exammode($sub_id)
    {
	if($this->isStudent() == TRUE)
	{

	    $this->load->library('pagination');
	    $this->load->helper('url');
	    $data['h']=$this->select->selectquestion($sub_id);

	    $result = $this->select->get_result($_SESSION['userId'], $sub_id);
	    if (count($result->result()) > 0) 
	    {
		redirect('/User/selectvi');

	    }



	    if (isset($_POST['submit'])) 
	    {
		$score = 0;
		foreach ($data['h']->result() as $q) 
		{
		    if (isset($_POST["question{$q->que_id}"]) && $_POST["question{$q->que_id}"] == $q->true_ans)
		    {
			$score++;
		    }
		}
		$data = [
		    'user_id' => $_SESSION['userId'],
		    'sub_id' => $sub_id,
		    'score' => $score,
		    'name' => $_SESSION['name']
		];

		$this->select->insert_result($data);
		redirect('result/'.$sub_id);
	    }

	    $this->loadViews('exammod', $this->global, $data);
	}
	else
	{
	    $this->loadThis();
	}
    }

    //the function for taking exam by the studet
    //it can only be assed by student

    // public function resultexam()  
    //       {  
    //         if($this->isEmp() == TRUE)
    //             {
    //          //load the database  
    //          $this->load->database();  
    //          //load the model  
    //          $this->load->model('get_result');  
    //          //load the method of model  
    //          $data['g']=$this->select->select();  
    //          //return the data in view  
    //          $this->load->view('exam_result', $data); 
    //          }
    //          else
    //          {
    //             $this->loadThis();
    //          } 
    //       }
    // the end

    public function resultexam()  
    {  
	if($this->isEmp() == TRUE)
	{
	    //  nnh h 
	    // $this->load->model('getresults');
	    $this->load->database();  
	    $this->load->library('pagination');
	    $this->load->model('select');
	    //sample test
	    // $this->load->model('select') 
	    $data['h']=$this->select->getresults();
	    $data2['y']=$this->select->getemail();
	    $this->global['pageTitle'] = 'Neethu k p : User Listing';
	    $this->loadViews('exam_result',$this->global, $data, $data2);




	}
	else
	{
	    $this->loadThis();
	} 
    }

    public function taskscont()
    {
	$this->load->view('contact');
    }

    /**
     * This function is used to load the user list
     */
    function userListing()
    {
	if($this->isAdmin() == TRUE)
	{
	    $this->loadThis();
	}
	else
	{        
	    $searchText = $this->security->xss_clean($this->input->post('searchText'));
	    $data['searchText'] = $searchText;

	    $this->load->library('pagination');

	    $count = $this->user_model->userListingCount($searchText);

	    $returns = $this->paginationCompress ( "userListing/", $count, 10 );

	    $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);

	    $this->global['pageTitle'] = 'Neethu k p : User Listing';

	    $this->loadViews("users", $this->global, $data, NULL);
	}
    }



    //about college


    function aboutcollege()
    {
	// $this->load->library('pagination');
	// $this->load->library('pagination');

	//   $this->load->view('collage');
	//$this->load->view('contact');
	if($this->isStudent() == TRUE || $this->isEmp() == TRUE)
	{
	    //load the database  
	    $this->load->database();  
	    $this->load->library('pagination');
	    //load the model  
	    // $this->load->model('select');  
	    //load the method of model  
	    // $data['h']=$this->select->selectSub();  
	    $this->global['pageTitle'] = 'Neethu k p : User Listing';
	    //return the data in view  
	    $this->loadViews('collage',$this->global); 
	}
	else
	{
	    $this->loadThis();
	}
    }

    /**

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
	if($this->isAdmin() == TRUE)
	{
	    $this->loadThis();
	}
	else
	{
	    $this->load->model('user_model');
	    $data['roles'] = $this->user_model->getUserRoles();

	    $this->global['pageTitle'] = 'Neethu k p : Add New User';

	    $this->loadViews("addNew", $this->global, $data, NULL);
	}
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
	$userId = $this->input->post("userId");
	$email = $this->input->post("email");

	if(empty($userId)){
	    $result = $this->user_model->checkEmailExists($email);
	} else {
	    $result = $this->user_model->checkEmailExists($email, $userId);
	}

	if(empty($result)){ echo("true"); }
	else { echo("false"); }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
	if($this->isAdmin() == TRUE)
	{
	    $this->loadThis();
	}
	else
	{
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
	    $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
	    $this->form_validation->set_rules('password','Password','required|max_length[20]');
	    $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
	    $this->form_validation->set_rules('role','Role','trim|required|numeric');
	    $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');

	    if($this->form_validation->run() == FALSE)
	    {
		$this->addNew();
	    }
	    else
	    {
		$name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
		$email = $this->security->xss_clean($this->input->post('email'));
		$password = $this->input->post('password');
		$roleId = $this->input->post('role');
		$mobile = $this->security->xss_clean($this->input->post('mobile'));

		$userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
		    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));

		$this->load->model('user_model');
		$result = $this->user_model->addNewUser($userInfo);

		if($result > 0)
		{
		    $this->session->set_flashdata('success', 'New User created successfully');
		}
		else
		{
		    $this->session->set_flashdata('error', 'User creation failed');
		}

		redirect('addNew');
	    }
	}
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
	if($this->isAdmin() == TRUE || $userId == 1)
	{
	    $this->loadThis();
	}
	else
	{
	    if($userId == null)
	    {
		redirect('userListing');
	    }

	    $data['roles'] = $this->user_model->getUserRoles();
	    $data['userInfo'] = $this->user_model->getUserInfo($userId);

	    $this->global['pageTitle'] = 'Neethu k p : Edit User';

	    $this->loadViews("editOld", $this->global, $data, NULL);
	}
    }


    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
	if($this->isAdmin() == TRUE)
	{
	    $this->loadThis();
	}
	else
	{
	    $this->load->library('form_validation');

	    $userId = $this->input->post('userId');

	    $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
	    $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
	    $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
	    $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
	    $this->form_validation->set_rules('role','Role','trim|required|numeric');
	    $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');

	    if($this->form_validation->run() == FALSE)
	    {
		$this->editOld($userId);
	    }
	    else
	    {
		$name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
		$email = $this->security->xss_clean($this->input->post('email'));
		$password = $this->input->post('password');
		$roleId = $this->input->post('role');
		$mobile = $this->security->xss_clean($this->input->post('mobile'));

		$userInfo = array();

		if(empty($password))
		{
		    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
			'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
		}
		else
		{
		    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
			'name'=>ucwords($name), 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 
			'updatedDtm'=>date('Y-m-d H:i:s'));
		}

		$result = $this->user_model->editUser($userInfo, $userId);

		if($result == true)
		{
		    $this->session->set_flashdata('success', 'User updated successfully');
		}
		else
		{
		    $this->session->set_flashdata('error', 'User updation failed');
		}

		redirect('userListing');
	    }
	}
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
	if($this->isAdmin() == TRUE)
	{
	    echo(json_encode(array('status'=>'access')));
	}
	else
	{
	    $userId = $this->input->post('userId');
	    $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));

	    $result = $this->user_model->deleteUser($userId, $userInfo);

	    if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
	    else { echo(json_encode(array('status'=>FALSE))); }
	}
    }

    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
	$this->global['pageTitle'] = 'Neethu k p : Change Password';

	$this->loadViews("changePassword", $this->global, NULL, NULL);
    }


    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
	$this->load->library('form_validation');

	$this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
	$this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
	$this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');

	if($this->form_validation->run() == FALSE)
	{
	    $this->loadChangePass();
	}
	else
	{
	    $oldPassword = $this->input->post('oldPassword');
	    $newPassword = $this->input->post('newPassword');

	    $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

	    if(empty($resultPas))
	    {
		$this->session->set_flashdata('nomatch', 'Your old password not correct');
		redirect('loadChangePass');
	    }
	    else
	    {
		$usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
		    'updatedDtm'=>date('Y-m-d H:i:s'));

		$result = $this->user_model->changePassword($this->vendorId, $usersData);

		if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
		else { $this->session->set_flashdata('error', 'Password updation failed'); }

		redirect('loadChangePass');
	    }
	}
    }

    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
	$this->global['pageTitle'] = 'Neethu k p : 404 - Page Not Found';

	$this->loadViews("404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
	if($this->isAdmin() == TRUE)
	{
	    $this->loadThis();
	}
	else
	{
	    $userId = ($userId == NULL ? $this->session->userdata("userId") : $userId);

	    $searchText = $this->input->post('searchText');
	    $fromDate = $this->input->post('fromDate');
	    $toDate = $this->input->post('toDate');

	    $data["userInfo"] = $this->user_model->getUserInfoById($userId);

	    $data['searchText'] = $searchText;
	    $data['fromDate'] = $fromDate;
	    $data['toDate'] = $toDate;

	    $this->load->library('pagination');

	    $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

	    $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 5, 3);

	    $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);

	    $this->global['pageTitle'] = 'Neethu k p : User Login History';

	    $this->loadViews("loginHistory", $this->global, $data, NULL);
	}        
    }
}

?>
