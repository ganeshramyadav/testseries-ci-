<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('common_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->load->view('home/home');
    }

    public function login(){
        $this->load->view('home/login');
    }

    public function register(){
        $this->load->view('home/register');
    }

    public function registration(){
        $this->load->view('home/registration');
        
    }

    public function registerMe(){

        $this->load->library('form_validation');
        $regType = $this->security->xss_clean($this->input->post('regType'));
        // $this->form_validation->set_rules('name', 'User Name', 'trim|required|max_length[128]');
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('pword', 'Password', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('phone','Mobile Number','trim|required|numeric|min_length[10]');

        if($regType == 1){
            $this->form_validation->set_rules('fName', 'Full Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|numeric');
        }
        
        if($regType == 2){
            $this->form_validation->set_rules('insName', 'Institute Name', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('insAdd', 'Institute Address', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('insGstn', 'Institute GSTN', 'trim|required|max_length[128]');
            $this->form_validation->set_rules('insEmail', 'Institute Email', 'trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('insContact','Institute Contact Number','required|numeric|min_length[10]');
        }
       
        if($this->form_validation->run() == FALSE){
            $this->register();
        }else{
            $insResult = 0;
            $userResult = 0;

            $userData = array();
            $insData = array();
            
            $userData['email'] = $this->security->xss_clean($this->input->post('email'));
            
            $checkEmail = $this->login_model->emailExist($userData['email']);
            if($checkEmail == 1){
                $this->session->set_flashdata('error', 'Email Already Exists');
                redirect('register');
            }

            $userData['mobile_phone']= $this->security->xss_clean($this->input->post('phone'));
            $password = $this->input->post('pword');
            $userData['password'] = getHashedPassword($password);
            
            
            if($regType == 1){
                $userData['roleId'] = 3;
                $userData['first_name'] = $this->security->xss_clean($this->input->post('fName'));
                $userData['gender'] = $this->security->xss_clean($this->input->post('gender'));
            }
            if($regType == 2){
                $userData['roleId'] = 2;
                $insData['name'] = $this->security->xss_clean($this->input->post('insName'));
                $insData['address_line_1'] = $this->security->xss_clean($this->input->post('insAdd'));
                $insData['gstn'] = $this->security->xss_clean($this->input->post('insGstn'));
                $insData['mobile'] = $this->security->xss_clean($this->input->post('insContact'));

                $insData['email'] = $this->security->xss_clean($this->input->post('insEmail'));
                $checkinsEmail = $this->login_model->insEmailExist($insData['email']);
                if($checkinsEmail == 1){
                    $this->session->set_flashdata('error', 'Institute Email Already Exists');
                    redirect('register');
                }
            }

            $userResult = $this->login_model->insert('user', $userData);
            $editData['createdBy'] = $userResult;
            $userEditResult = $this->common_model->editInfo('user', $userResult, $editData);
            if($regType == 2){
                $insData['user_id'] = $userResult;
                $insResult = $this->login_model->insert('institute', $insData);
            }

            if($userResult > 0){
                $result = $this->login_model->getUserById($userResult);
                $lastLogin = $this->login_model->lastLoginInfo($result->id);

                $sessionArray = array(
                                        'userId'=>$userResult,
                                        'role'=>$result->roleId,
                                        'roleText'=>$result->role,
                                        'name'=>$result->first_name." ".$result->last_name,
                                        'lastLogin'=> $lastLogin->createdDtm,
                                        'isLoggedIn' => TRUE
                                );
                if($result->roleId == 2){
                    $instResult = $this->common_model->getAllData('institute', 'id, name, gstn, mobile, email', "user_id=$result->id, status=1");
                    $sessionArray['instId'] = $instResult->id;
                    $sessionArray['gstn'] = $instResult->gstn;
                    $sessionArray['instEmail'] = $instResult->email;
                }

                $this->session->set_userdata($sessionArray);
                unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);
                $loginInfo = array("userId"=>$result->id, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());
                $this->login_model->lastLogin($loginInfo);
                redirect('/dashboard');
            }
        }
    }

    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $data['gender'] = $this->login_model->getGender();
            $this->load->view('login', $data);
        }
        else
        {
            redirect('/dashboard');
        }
    }

    function testing(){
        $this->load->view('login_testing');
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            
            $result = $this->login_model->loginMe($email, $password);

            if(!empty($result))
            {
                $lastLogin = $this->login_model->lastLoginInfo($result->id);

                $sessionArray = array(
                                        // 'userId'=>$result->userId,
                                        'userId'=>$result->id,
                                        'role'=>$result->roleId,
                                        'roleText'=>$result->role,
                                        'name'=>$result->first_name." ".$result->last_name,
                                        'lastLogin'=> $lastLogin->created_at,
                                        'isLoggedIn' => TRUE
                                );

                if($result->roleId == 2){
                    $instResult = $this->common_model->getAllData('institute', 'id, name, gstn, mobile, email', "user_id=$result->id, status=1");
                    $sessionArray['instId'] = $instResult->id;
                    $sessionArray['gstn'] = $instResult->gstn;
                    $sessionArray['instEmail'] = $instResult->email;
                }

                $this->session->set_userdata($sessionArray);

                unset($sessionArray['userId'], $sessionArray['isLoggedIn'], $sessionArray['lastLogin']);

                $loginInfo = array("userId"=>$result->id, "sessionData" => json_encode($sessionArray), "machineIp"=>$_SERVER['REMOTE_ADDR'], "userAgent"=>getBrowserAgent(), "agentString"=>$this->agent->agent_string(), "platform"=>$this->agent->platform());

                $this->login_model->lastLogin($loginInfo);
                
                redirect('/dashboard');
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                
                $this->index();
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('forgotPassword');
        }
        else
        {
            redirect('/dashboard');
        }
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = strtolower($this->security->xss_clean($this->input->post('login_email')));
            
            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo->name;
                        $data1["email"] = $userInfo->email;
                        $data1["message"] = "Reset Your Password";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "Reset password link sent successfully, please check mails.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email has been failed, try again.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "It seems an error while sending your details, try again.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "This email is not registered with us.");
            }
            redirect('/forgotPassword');
        }
    }

    /**
     * This function used to reset the password 
     * @param string $activation_id : This is unique id
     * @param string $email : This is user email
     */
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('/login');
        }
    }
    
    /**
     * This function used to create new password for user
     */
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = strtolower($this->input->post("email"));
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Password reset successfully';
            }
            else
            {
                $status = 'error';
                $message = 'Password reset failed';
            }
            
            setFlashData($status, $message);

            redirect("/login");
        }
    }
}

?>