<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Videos extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('video_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    function videoListing(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->video_model->smListingCount($searchText);

			$returns = $this->paginationCompress ( "videoListing/", $count, 10 );
            
            $data['Records'] = $this->video_model->smListing($searchText, $returns["page"], $returns["segment"]);
           
            $this->global['pageTitle'] = 'Study Material';
            
            $this->loadViews("videos/videos", $this->global, $data, NULL);
        }
    }

    function editOldVideo($smId = NULL){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            if($smId == null)
            {
                redirect('videoListing');
            }
            
            $data['Users'] = $this->studymaterial_model->getAllInstUsers();
            $data['Info'] = $this->studymaterial_model->getSmInfoById($smId);
            
            $this->global['pageTitle'] = ' Edit Videos Tutorials';

            $this->loadViews("videos/editOldVideo", $this->global, $data, NULL);
        }
    }

    function editVideo(){
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
                $this->editOldVideo($smId);
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
                        $path = base_url().'assets/content/studymaterial/public/'.$smId.'/';
                        $config['upload_path'] = './assets/content/studymaterial/public/'.$smId.'/';
                    }else{
                        $path = base_url().'assets/content/studymaterial/institute/'.$smId.'/';
                        $config['upload_path'] = './assets/content/studymaterial/institute/'.$smId.'/';
                    }
    
                    $config['allowed_types']        = 'pdf';
                    $config['max_size'] = '1000000';
                    // $config['encrypt_name']         = TRUE;
                   
                    $config['file_name'] = $smId;
                    // $config['file_name'] = $_FILES['smFile']['name'];
    
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('smFile')) {
                        $error =$this->upload->display_errors();
                        // $this->editOldSM($smId);
                        $this->load->view('videos/editOldVideo/'.$smId, $error);
                    } else {
                        $uploadData =  $this->upload->data();
                        $smInfo['url'] = $path.$uploadData['file_name'];
                    }
                }

                $tblName = 'study_material';
                $result = $this->studymaterial_model->editInfo($tblName, $smId, $smInfo);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Updation failed');
                }
                redirect('editOldVideo/'.$smId);
            }
        }
    }

    function addVideo(){
        // echo "testing";
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {

            // $data['Users'] = $this->user_model->getAllUsers();
            $data['Users'] = $this->studymaterial_model->getAllInstUsers();
            // $data['Info'] = $this->studymaterial_model->getSmInfoById($smId);
            
            $this->global['pageTitle'] = 'Add Videos Tutorials';

            $this->loadViews("videos/addVideo", $this->global, $data, NULL);
        }
    }

    function addNewVideo(){
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
                $this->editOldVideo($smId);
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
                $tblName = 'study_material';
                $insertedData = 0;
                $insertedData = $this->studymaterial_model->addInfo($tblName, $smInfo);

                if($insertedData == 0){
                    $this->session->set_flashdata('error', 'Process failed');
                }

                if($_FILES['smFile']['name']){
                    if($ubu == 1){
                        mkdir("./assets/content/studymaterial/public/".$insertedData, 0700);
                        $config['upload_path'] = './assets/content/studymaterial/public/'.$insertedData.'/';
                        $path = base_url().'assets/content/studymaterial/public/'.$insertedData.'/';
                    }else{
                        mkdir("./assets/content/studymaterial/institute/".$insertedData, 0700);
                        $config['upload_path'] = './assets/content/studymaterial/institute/'.$insertedData.'/';
                        $path = base_url().'assets/content/studymaterial/institute/'.$insertedData.'/';
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
                        $this->load->view('videos/addVideo/', $error);
                    } else {
                        $uploadData =  $this->upload->data();
                        $smInfo['url'] = $path.$uploadData['file_name'];
                        $smInfo['updated_at'] = date('Y-m-d H:i:s');
                    }
                }

                $tblName = 'study_material';
                $result = $this->studymaterial_model->editInfo($tblName, $insertedData, $smInfo);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Inserted successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Process failed');
                }
                redirect('addVideo');
            }
        }
    }
}