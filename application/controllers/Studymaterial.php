<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Studymaterial extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('studymaterial_model');
        $this->load->model('common_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    function smListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));

            $institute = $this->security->xss_clean($this->input->post('institute'));
            $data['institute'] = $institute;

            $year = $this->security->xss_clean($this->input->post('year'));
            $data['year'] = $year;
            
            $category = $this->security->xss_clean($this->input->post('category'));
            $data['category'] = $category;

            $subcategory = $this->security->xss_clean($this->input->post('subcategory'));
            $data['subcategory'] = $subcategory;

            if($searchTexts == 'Paid' || $searchTexts == 'paid' || $searchTexts == 'Active' || $searchTexts == 'active'){
                $searchText = 1;
            }
            if($searchTexts == 'Free' || $searchTexts == 'Free' || $searchTexts == 'InActive' || $searchTexts == 'inactive'){
                $searchText = 0;
            }

            $data['searchText'] = $searchTexts;

            $this->load->library('pagination');

            $count = $this->studymaterial_model->ListingCount($searchTexts, $institute, $year, $category, $subcategory);

			$returns = $this->paginationCompress("smListing/", $count, 10 );

            $data['Records'] = $this->studymaterial_model->Listing($searchTexts, $institute, $year, $category, $subcategory, $returns["page"], $returns["segment"]);

            $data['Institute'] = $this->common_model->getAllData('institute', null, 'status=1');
            $data['Year'] = $this->common_model->getAllData('product', 'id,year', null);
            $data['Category'] = $this->common_model->getAllData('category', null, 'active=1');
            $data['SubCategory'] = $this->common_model->getAllData('subcategory', null, 'active=1');

            $this->global['pageTitle'] = 'AOA : Study Material';
            $this->loadViews("sm/studyMaterial", $this->global, $data, NULL);
        }
    }

    function getSubCatById($subCatId){
        $result =$this->common_model->getAllData('subcategory', null, "category_id=$subCatId");
        echo json_encode($result);
    }

    function editOlds(){
        echo "testing";
        die;
    }

    function edit($smId = NULL){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            if($smId == null)
            {
                redirect('smListing');
            }
            
            $data['Users'] = $this->studymaterial_model->getAllInstUsers();
            $data['Info'] = $this->studymaterial_model->getSmInfoById($smId);
            
            $this->global['pageTitle'] = ' Edit Study Material';

            $this->loadViews("sm/editOldSm", $this->global, $data, NULL);
        }
    }

    function editSm(){
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
                $this->editOldSM($smId);
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
                        $this->load->view('sm/editOldSM/'.$smId, $error);
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
                redirect('editOldSM/'.$smId);
            }
        }
    }

    function add(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $currentURL = current_url();
            if (strpos($currentURL, "addSm")==true || strpos($currentURL, "addNewSm") == true){
                $this->global['pageTitle'] = 'Add Study Material';
                $data['routeName'] = 'addNewSm';
            } else if (strpos($currentURL, "addCa")==true || strpos($currentURL, "addNewCa") == true){
                $this->global['pageTitle'] = 'Add Current Affairs';
                $data['routeName'] = 'addNewCa';
            }

            $data['Users'] = $this->common_model->getAllData('user','id,first_name,last_name','active=1');
            $data['Institute'] = $this->common_model->getAllData('institute',null,'status=1');
            $data['Category'] = $this->common_model->getAllData('category',null,'active=1');

            $this->loadViews("sm/add", $this->global, $data, NULL);
        }
    }

    function addNew(){
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        } else {
            $study_material = 0;
            $current_affairs = 0;
            $video = 0;

            $currentURL = current_url();
            if (strpos($currentURL, "addNewSm")==true){
                $data['routeName'] = 'addSm';
                $study_material = 1;
                $filepath = 'studymaterial';

            } else if (strpos($currentURL, "addNewCa")==true){
                $data['routeName'] = 'addCa';
                $current_affairs = 1;
                $filepath = 'currentaffairs';
            }
           
            $isPublic = $this->security->xss_clean($this->input->post('isPublic'));

            $this->load->library('upload');
            $this->load->helper("file");

            $this->form_validation->set_rules('fname','File Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('subcat','Sub Category','trim|required|numeric');
            $this->form_validation->set_rules('catname','Category Name','trim|required|numeric');
            // $this->form_validation->set_rules('uploaderName','Uploader Name','trim|required|numeric');
            $this->form_validation->set_rules('year','Year','trim|required|numeric');
            $this->form_validation->set_rules('isPublic','Public Access','trim|required|numeric');
            $this->form_validation->set_rules('institute','Institute Name','trim|required|numeric');

            if($isPublic == 1){
                $this->form_validation->set_rules('currency-field','Price(In Rs.)','trim|required|numeric');
                $currency = $this->security->xss_clean($this->input->post('currency-field'));
            }else{
                $currency = 0;
            }

            if($this->form_validation->run() == FALSE)
            {
                $this->add();
            }else{
                $name = strtolower($this->security->xss_clean($this->input->post('fname')));
                $catnameId = $this->security->xss_clean($this->input->post('catname'));
                $subcatId = $this->security->xss_clean($this->input->post('subcat'));
                $year = $this->security->xss_clean($this->input->post('year'));
                $uploaderId = $this->security->xss_clean($this->input->post('uploaderName'));
                $instituteId = $this->security->xss_clean($this->input->post('institute'));
                $status = $this->input->post('status');

                $smInfo = array(
                    'createdBy'=> $this->vendorId,
                    'name'=>$name,
                    'study_material'=> $study_material,
                    'current_affairs'=> $current_affairs,
                    'video'=> $video,
                    'year'=> $year,
                    'category_id'=>$catnameId,
                    'subcategory_id'=>$subcatId,
                    'institute_id'=>$instituteId,
                    'active'=>$status,
                    'price'=> $currency,
                    'isPublic'=> $isPublic,
                );

                $tblName = 'product';
                $insertedData = 4;
                $insertedData = $this->studymaterial_model->addInfo($tblName, $smInfo);
                
                if($insertedData == 0){
                    $this->session->set_flashdata('error', 'Process failed');
                }

                if($_FILES['smFile']['name']){
                    if($isPublic == 0){
                        $path = base_url().'assets/content/'.$filepath.'/'.'public/'.$insertedData;
                        if (!is_dir("./assets/content/".$filepath."/"."public/".$insertedData)){
                            mkdir("./assets/content/".$filepath."/"."public/".$insertedData, 0700, TRUE);
                        }
                        $config['upload_path'] = './assets/content/'.$filepath.'/'.'public/'.$insertedData.'/';
                    }else{
                        $path = base_url()."assets/content/".$filepath."/"."institute/".$insertedData;
                        if (!is_dir("./assets/content/".$filepath."/"."institute/".$insertedData)){
                            mkdir("./assets/content/".$filepath."/"."institute/".$insertedData, 0700, TRUE);
                        }
                        $config['upload_path'] = "./assets/content/".$filepath."/"."institute/".$insertedData.'/';
                    }

                    $config['allowed_types']        = 'pdf';
                    $config['max_size'] = '1000000';
                    $config['encrypt_name']         = TRUE;
                   
                    $config['file_name'] = $insertedData;
    
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('smFile')) {
                        $deleted = $this->common_model->deleteDataFromTbl($tblName, "id=$insertedData");
                        /* rmdir("./assets/content/".$filepath."/"."public/".$insertedData); // Remove Directory.
                        rmdir($path); // Remove Directory.
                        delete_files($path, true); */
                        $error =$this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect($data['routeName']);
                    } else {
                        $uploadData =  $this->upload->data();
                        $smEditInfo['url'] = $path."/".$uploadData['file_name'];
                        $smEditInfo['updated_at'] = date('Y-m-d H:i:s');
                    }
                }

                $result = $this->common_model->editInfo($tblName, $insertedData, $smEditInfo);
                
                if($result == true) {
                    $this->session->set_flashdata('success', 'Inserted successfully');
                } else {
                    $this->session->set_flashdata('error', 'Process failed');
                }
                redirect($data['routeName']);
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