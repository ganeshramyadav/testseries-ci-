<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Currentaffairs extends BaseController
{
    /**
     * This is default constructor of the class
     */ 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('currentaffairs_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    function caListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->currentaffairs_model->caListingCount($searchText);

			$returns = $this->paginationCompress ( "caListing/", $count, 10 );
            
            $data['Records'] = $this->currentaffairs_model->caListing($searchText, $returns["page"], $returns["segment"]);
           
            $this->global['pageTitle'] = 'Current Affairs';
            
            $this->loadViews("ca/currentAffairs", $this->global, $data, NULL);
        }
    }

    function editOlds(){
        echo "testing";
        die;
    }

    function editOldCA($smId = NULL){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            if($smId == null)
            {
                redirect('caListing');
            }
            
            $data['Users'] = $this->currentaffairs_model->getAllInstUsers();
            $data['Info'] = $this->currentaffairs_model->getSmInfoById($smId);
            
            $this->global['pageTitle'] = ' Edit Current Affairs';

            $this->loadViews("ca/editOldCa", $this->global, $data, NULL);
        }
    }

    function editCa(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $caId = $this->input->post('smId');

            $this->load->library('upload');

            $this->form_validation->set_rules('fname','File Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('subname','Subject\'s Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('catname','Category Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('ubu','Upload By User','trim|required|numeric');
            // $this->form_validation->set_rules('role','Role','trim|required|numeric');
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldCA($caId);
            }else{
                $name = strtolower($this->security->xss_clean($this->input->post('fname')));
                $subname = strtolower($this->security->xss_clean($this->input->post('subname')));
                $catname = strtolower($this->security->xss_clean($this->input->post('catname')));
                $ubu = strtolower($this->security->xss_clean($this->input->post('ubu')));
                // $ins_name = strtolower($this->security->xss_clean($this->input->post('ins_name')));
                $status = $this->input->post('status');

                $smInfo = array(
                    'user_id'=> $ubu,
                    // 'institut_id' => $ins_name,
                    'name'=>$name,
                    'category'=>$catname,
                    'subject'=>$subname,
                    'status'=>$status,
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                if($_FILES['smFile']['name']){
                    if($ubu == 1){
                        $path = base_url().'assets/content/currentaffairs/public/'.$smId.'/';
                        $config['upload_path'] = './assets/content/currentaffairs/public/'.$smId.'/';
                    }else{
                        $path = base_url().'assets/content/currentaffairs/institute/'.$smId.'/';
                        $config['upload_path'] = './assets/content/currentaffairs/institute/'.$smId.'/';
                    }
    
                    $config['allowed_types']        = 'pdf';
                    $config['max_size'] = '1000000';
                    // $config['encrypt_name']         = TRUE;
                   
                    $config['file_name'] = $caId;
                    // $config['file_name'] = $_FILES['smFile']['name'];
    
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('smFile')) {
                        $error =$this->upload->display_errors();
                        // $this->editOldSM($smId);
                        $this->load->view('ca/editOldCA/'.$caId, $error);
                    } else {
                        $uploadData =  $this->upload->data();
                        $smInfo['url'] = $path.$uploadData['file_name'];
                    }
                }

                $tblName = 'current_affairs';
                $result = $this->currentaffairs_model->editInfo($tblName, $caId, $smInfo);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Updation failed');
                }
                redirect('editOldCA/'.$caId);
            }
        }
    }

    function addCa(){
        // echo "testing";
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {

            // $data['Users'] = $this->user_model->getAllUsers();
            $data['Users'] = $this->currentaffairs_model->getAllInstUsers();
            // $data['Info'] = $this->studymaterial_model->getSmInfoById($smId);
            
            $this->global['pageTitle'] = 'Add current Affairs';

            $this->loadViews("ca/addCA", $this->global, $data, NULL);
        }
    }

    function addNewCa(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $smId = $this->input->post('smId');

            $this->load->library('upload');

            $this->form_validation->set_rules('fname','File Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('subname','Subject\'s Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('catname','Category Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('ubu','Upload By User','trim|required|numeric');
            // $this->form_validation->set_rules('role','Role','trim|required|numeric');
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldCA($smId);
            }else{
                $name = strtolower($this->security->xss_clean($this->input->post('fname')));
                $subname = strtolower($this->security->xss_clean($this->input->post('subname')));
                $catname = strtolower($this->security->xss_clean($this->input->post('catname')));
                $ubu = strtolower($this->security->xss_clean($this->input->post('ubu')));
                // $ins_name = strtolower($this->security->xss_clean($this->input->post('ins_name')));
                $status = $this->input->post('status');

                $smInfo = array(
                    'user_id'=> $ubu,
                    // 'institut_id' => $ins_name,
                    'name'=>$name,
                    'category'=>$catname,
                    'subject'=>$subname,
                    'status'=>$status
                );
                $tblName = 'current_affairs';
                $insertedData = 0;
                $insertedData = $this->currentaffairs_model->addInfo($tblName, $smInfo);

                if($insertedData == 0){
                    $this->session->set_flashdata('error', 'Process failed');
                }

                if($_FILES['smFile']['name']){
                    if($ubu == 1){
                        mkdir("./assets/content/currentaffairs/public/".$insertedData, 0700);
                        $config['upload_path'] = './assets/content/currentaffairs/public/'.$insertedData.'/';
                        $path = base_url().'assets/content/currentaffairs/public/'.$insertedData.'/';
                    }else{
                        mkdir("./assets/content/currentaffairs/institute/".$insertedData, 0700);
                        $config['upload_path'] = './assets/content/currentaffairs/institute/'.$insertedData.'/';
                        $path = base_url().'assets/content/currentaffairs/institute/'.$insertedData.'/';
                    }
    
                    $config['allowed_types']        = 'pdf';
                    $config['max_size'] = '1000000';
                    // $config['encrypt_name']         = TRUE;
                   
                    $config['file_name'] = $insertedData;
                    // $config['file_name'] = $_FILES['smFile']['name'];
    
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('smFile')) {
                        $error =$this->upload->display_errors();
                        // $this->editOldSM($smId);
                        $this->load->view('ca/addCa/', $error);
                    } else {
                        $uploadData =  $this->upload->data();
                        $smInfo['url'] = $path.$uploadData['file_name'];
                        $smInfo['updated_at'] = date('Y-m-d H:i:s');
                    }
                }

                $result = $this->currentaffairs_model->editInfo($tblName, $insertedData, $smInfo);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Inserted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Process failed');
                }
                redirect('addCa');
            }
        }
    }

    public function editSm_555() {
        $this->load->library('upload');

        $config['upload_path'] = './assets/content/';
        
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '1000000';
        // $config['max_width'] = 1500;
        // $config['max_height'] = 1500;
        $config['file_name'] = $_FILES['smFile']['name'];
        
        // die;
        $this->upload->initialize($config);
        // $this->load->library('upload', $config);
        // $this->load->library('upload', $config);

        if (!$this->upload->do_upload('smFile')) {
            $error = array('error' => $this->upload->display_errors());
            echo "<pre>";
            print_r($error);
            echo "ddddddddddd";
            $this->load->view('sm/editOldSM/15', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());

            echo "55555555555555";
            $this->load->view('sm/editOldSM/15', $data);
            // $this->load->view('files/upload_result', $data);
        }
        die;
    }
}