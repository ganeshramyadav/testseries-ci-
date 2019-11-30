<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Common extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('exam_model');
        $this->load->model('common_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    function Listing(){
        // if($this->isTicketter() == TRUE)
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            
            $currentURL = current_url();
            if (strpos($currentURL, "study_material")==true){
                $this->global['pageTitle'] = 'AOA : Study Material';
                $data['title'] = 'Study Material';
                $data['routeName'] = 'study_material/new';
                $productType = 'study_material';
                $data['route'] = 'study_material';
                $data['editRoute'] = 'study_material/edit/';
                $data['defaultImg'] = base_url().'assets/images/pdf.jpg';
            } else if (strpos($currentURL, "current_affairs")==true){
                $this->global['pageTitle'] = 'AOA : Current Affairs';
                $data['title'] = 'Current Affairs';
                $data['routeName'] = 'current_affairs/new';
                $productType = 'current_affairs';
                $data['route'] = 'current_affairs';
                $data['editRoute'] = 'current_affairs/edit/';
                $data['defaultImg'] = base_url().'assets/images/pdf.jpg';
            } else if (strpos($currentURL, "video")==true){
                $this->global['pageTitle'] = 'AOA : Videos';
                $data['title'] = 'Videos';
                $data['routeName'] = 'video/new';
                $productType = 'video';
                $data['route'] = 'video';
                $data['editRoute'] = 'video/edit/';
                $data['defaultImg'] = base_url().'assets/images/video.png';
            }

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

            if($this->role == 2){
                $institute = $this->instId;
                $data['Year'] = $this->common_model->getYearFromProduct("institute_id=$institute");
                $data['Institute'] = $this->common_model->getAllData('institute', null, "status=1,id=$institute");
            }else{
                $data['Year'] = $this->common_model->getYearFromProduct(null);
                $data['Institute'] = $this->common_model->getAllData('institute', null, 'status=1');
            }
            $data['roleId'] = $this->role;
            $data['Category'] = $this->common_model->getAllData('category', null, 'active=1');
            $data['SubCategory'] = $this->common_model->getAllData('subcategory', null, 'active=1');

            $data['searchText'] = $searchTexts;
            $this->load->library('pagination');
            $count = $this->common_model->ListingCount($searchTexts, $institute, $year, $category, $subcategory, $productType);
            $returns = $this->paginationCompress($productType."/", $count, 10 );
            
            $data['Records'] = $this->common_model->Listing($searchTexts, $institute, $year, $category, $subcategory, $productType, $returns["page"], $returns["segment"]);

            $this->loadViews("common/productListing", $this->global, $data, NULL);
            // $this->loadViews("sm/studyMaterial", $this->global, $data, NULL);
        }
    }

    function add(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $currentURL = current_url();
            if (strpos($currentURL, "study_material")==true){
                $this->global['pageTitle'] = 'Add Study Material';
                $data['routeName'] = 'study_material/new/addNew';
                $data['fileType'] = 'application/pdf';
            } else if (strpos($currentURL, "current_affairs")==true){
                $this->global['pageTitle'] = 'Add Current Affairs';
                $data['routeName'] = 'current_affairs/new/addNew';
                $data['fileType'] = 'application/pdf';
            } else if (strpos($currentURL, "vide")==true ){
                $this->global['pageTitle'] = 'Add Video';
                $data['routeName'] = 'video/new/addNew';
                $data['fileType'] = 'video/*';
            }

            if($this->role == 2){
                $institute = $this->instId;
                $data['Institute'] = $this->common_model->getAllData('institute', null, "status=1,id=$institute");
            }else{
                $data['Institute'] = $this->common_model->getAllData('institute', null, 'status=1');
            }
            // $data['Users'] = $this->common_model->getAllData('user','id,first_name,last_name','active=1');
            // $data['Institute'] = $this->common_model->getAllData('institute',null,'status=1');
            $data['Category'] = $this->common_model->getAllData('category',null,'active=1');

            $this->loadViews("common/add", $this->global, $data, NULL);
        }
    }

    function addNew(){
        /* if($this->isAdmin() == TRUE) */
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $study_material = 0;
            $current_affairs = 0;
            $video = 0;

            $currentURL = current_url();
            if (strpos($currentURL, "study_material")==true){
                $data['routeName'] = 'study_material/new';
                $study_material = 1;
                $filepath = 'studymaterial';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = '100000000';
            } else if (strpos($currentURL, "current_affairs")==true){
                $data['routeName'] = 'current_affairs/new';
                $current_affairs = 1;
                $filepath = 'currentaffairs';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = '100000000';
            } else if (strpos($currentURL, "video")==true){
                $data['routeName'] = 'video/new';
                $video = 1;
                $filepath = 'video';
                $config['allowed_types']        = 'wmv|mp4|avi|mov';
                $config['max_size']             = '0';
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
                $status = $this->security->xss_clean($this->input->post('status'));

                $description = $this->security->xss_clean($this->input->post('desc'));

                if($this->role == 2){
                    $instituteId = $this->instId;
                }else{
                    $instituteId = $this->security->xss_clean($this->input->post('institute'));
                }

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
                    'description'=>$description
                );

                $tblName = 'product';
                $insertedData = 0;
                $insertedData = $this->common_model->addInfo($tblName, $smInfo);
                
                if($insertedData == 0){
                    $this->session->set_flashdata('error', 'Process failed');
                }

                /* For Pdf or Video File Upload */
                if($_FILES['smFile']['name']){
                    if($isPublic == 0){
                        $uploadPath = 'assets/content/'.$filepath.'/'.'public/'.$insertedData;
                        $path = base_url().$uploadPath;
                        if (!is_dir("./assets/content/".$filepath."/"."public/".$insertedData)){
                            mkdir("./assets/content/".$filepath."/"."public/".$insertedData, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$uploadPath.'/';
                    }else{
                        $uploadPath = 'assets/content/'.$filepath.'/'.'institute/'.$insertedData;
                        $path = base_url().$uploadPath;
                        if (!is_dir("./assets/content/".$filepath."/"."institute/".$insertedData)){
                            mkdir("./assets/content/".$filepath."/"."institute/".$insertedData, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$uploadPath.'/';
                    }

                    // $config['allowed_types']        = 'pdf';
                    // $config['max_size']             = '100000000';
                    $config['encrypt_name']         = TRUE;
                   
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('smFile')) {
                        
                        $error =$this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect($data['routeName']);
                    } else {
                        $uploadData =  $this->upload->data();
                        $smEditInfo['url'] = $uploadPath."/".$uploadData['file_name'];
                        $smEditInfo['updated_at'] = date('Y-m-d H:i:s');
                    }
                }

                /* For Image File Upload */
                if($_FILES['thumb']['name']){
                    if($isPublic == 0){
                        $imgPath = 'assets/content/'.$filepath.'/'.'public/'.$insertedData;
                        $path = base_url().$imgPath;
                        if (!is_dir($imgPath)){
                            mkdir($imgPath, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$imgPath.'/';
                    }else{
                        $imgPath = "assets/content/".$filepath."/"."institute/".$insertedData;
                        $path = base_url().$imgPath;
                        if (!is_dir($imgPath)){
                            mkdir($imgPath, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$imgPath.'/';
                    }
                    
                    $config['allowed_types']        = 'jpge|jpg|png';
                    $config['max_size']             = '0';
                    $config['min_width']            = 235;
                    $config['min_height']           = 200;

                    // $config['max_width']            = 235;
                    // $config['max_height']           = 200;
                    // $config['encrypt_name']         = FALSE;
                    $config['encrypt_name']         = TRUE;
                    // $config['file_name']         = "thumb_".$insertedData;

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('thumb')) {
                        $deleted = $this->common_model->deleteDataFromTbl($tblName, "id=$insertedData");
                        $error =$this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect($data['routeName']);
                    } else {
                        $uploadData =  $this->upload->data();
                        $smEditInfo['image_url'] = $imgPath."/".$uploadData['file_name'];
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

    function edit($Id = NULL){
        // if($this->isAdmin() == TRUE)
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $currentURL = current_url();
            if (strpos($currentURL, "study_material")==true){
                $this->global['pageTitle'] = 'AOA : Edit Study Material';
                $data['routeName'] = 'study_material/edit';
                $data['fileType']   =   'application/pdf';
                $data['redirect'] = 'study_material';
                $type = "study_material=1";
            } else if (strpos($currentURL, "current_affairs")==true){
                $this->global['pageTitle'] = 'AOA : Edit Current Affairs';
                $data['routeName'] = 'current_affairs/edit';
                $data['fileType']   =   'application/pdf';
                $data['redirect'] = 'current_affairs';
                $type = "current_affairs=1";
            } else if (strpos($currentURL, "video")==true){
                $this->global['pageTitle'] = 'AOA : Edit Video';
                $data['routeName'] = 'video/edit';
                $data['fileType']   =   'video/*';
                $data['redirect'] = 'video';
                $type = "video=1";
            }
            if($Id == null){
                redirect($data['redirect']);
            }

            if($this->role == 2){
                $institute = $this->instId;
                $data['Institute'] = $this->common_model->getAllData('institute', null, "status=1,id=$institute");
            }else{
                $data['Institute'] = $this->common_model->getAllData('institute', null, 'status=1');
            }

            $data['Info'] = $this->common_model->getAllData('product','All',"$type ,active=1, id=$Id");

            if(empty($data['Info'])){
                redirect($data['redirect']);
            }
            $category_id = $data['Info']->category_id;
            
            // $data['Users'] = $this->common_model->getAllData('user','id,first_name,last_name','active=1');
            // $data['Institute'] = $this->common_model->getAllData('institute',null,'status=1');
            $data['Category'] = $this->common_model->getAllData('category',null,'active=1');
            $data['SubCategory'] = $this->common_model->getAllData('subcategory',null,"category_id=$category_id,active=1");
            
            $this->loadViews("common/editOld", $this->global, $data, NULL);
        }
    }

    function update(){
        /* if($this->isAdmin() == TRUE) */
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $Id = $this->security->xss_clean($this->input->post('Id'));
            $study_material = 0;
            $current_affairs = 0;
            $video = 0;

            $currentURL = current_url();
            if (strpos($currentURL, "study_material")==true){
                $data['routeName'] = 'study_material/edit/';
                $redirect = 'study_material';
                $study_material = 1;
                $filepath = 'studymaterial';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = '100000000';
            } else if (strpos($currentURL, "current_affairs")==true){
                $data['routeName'] = 'current_affairs/edit/';
                $redirect = 'current_affairs';
                $current_affairs = 1;
                $filepath = 'currentaffairs';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = '100000000';
            }else if (strpos($currentURL, "video")==true){
                $data['routeName'] = 'video/edit/';
                $redirect = 'video';
                $video = 1;
                $filepath = 'video';
                $config['allowed_types']        = 'wmv|mp4|avi|mov';
                $config['max_size']             = '0';
            }

            if( empty($Id) || $Id == NULL ){
                redirect($redirect);
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

            if($this->form_validation->run() == FALSE){
                $this->edit($Id);
            }else{

                $name = strtolower($this->security->xss_clean($this->input->post('fname')));
                $catnameId = $this->security->xss_clean($this->input->post('catname'));
                $subcatId = $this->security->xss_clean($this->input->post('subcat'));
                $year = $this->security->xss_clean($this->input->post('year'));
                $uploaderId = $this->security->xss_clean($this->input->post('uploaderName'));
                
                $status = $this->security->xss_clean($this->input->post('status'));

                $description = $this->security->xss_clean($this->input->post('desc'));

                if($this->role == 2){
                    $instituteId = $this->instId;
                }else{
                    $instituteId = $this->security->xss_clean($this->input->post('institute'));
                }

                $Info = array(
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
                    'description'=>$description
                );

                /* For Pdf or Video File Upload */
                if($_FILES['smFile']['name']){
                    if($isPublic == 0){
                        $uploadPath = 'assets/content/'.$filepath.'/'.'public/'.$Id;
                        $path = base_url().$uploadPath;
                        if (!is_dir("./assets/content/".$filepath."/"."public/".$Id)){
                            mkdir("./assets/content/".$filepath."/"."public/".$Id, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$uploadPath.'/';
                    }else{
                        $uploadPath = 'assets/content/'.$filepath.'/'.'institute/'.$Id;
                        $path = base_url().$uploadPath;
                        if (!is_dir("./assets/content/".$filepath."/"."institute/".$Id)){
                            mkdir("./assets/content/".$filepath."/"."institute/".$Id, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$uploadPath.'/';
                    }

                    // $config['allowed_types']        = 'pdf';
                    // $config['max_size']             = '100000000';
                    $config['encrypt_name']         = TRUE;
                
                    // $config['file_name'] = $insertedData;

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('smFile')) {
                        // $deleted = $this->common_model->deleteDataFromTbl($tblName, "id=$insertedData");
                        
                        $error =$this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect($data['routeName'].$Id);
                    } else {
                        $uploadData =  $this->upload->data();
                        $Info['url'] = $uploadPath."/".$uploadData['file_name'];
                        $Info['updated_at'] = date('Y-m-d H:i:s');
                    }
                }

                /* For Image File Upload */
                if($_FILES['thumb']['name']){
                    if($isPublic == 0){
                        $imgPath = 'assets/content/'.$filepath.'/'.'public/'.$Id;
                        $path = base_url().$imgPath;
                        if (!is_dir($imgPath)){
                            mkdir($imgPath, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$imgPath.'/';
                    }else{
                        $imgPath = "assets/content/".$filepath."/"."institute/".$Id;
                        $path = base_url().$imgPath;
                        if (!is_dir($imgPath)){
                            mkdir($imgPath, 0700, TRUE);
                        }
                        $config['upload_path'] = './'.$imgPath.'/';
                    }
                    $config['allowed_types']        = 'jpge|jpg|png';
                    $config['max_size']             = '0';
                    $config['min_width']            = 235;
                    $config['min_height']           = 200;

                    // $config['max_width']            = 235;
                    // $config['max_height']           = 200;
                    // $config['encrypt_name']         = FALSE;
                    $config['encrypt_name']         = TRUE;
                    // $config['file_name']         = "thumb_".$Id;
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('thumb')) {
                        $error =$this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect($data['routeName'].$Id);
                    } else {
                        $uploadData =  $this->upload->data();
                        $Info['image_url'] = $imgPath."/".$uploadData['file_name'];
                        $Info['updated_at'] = date('Y-m-d H:i:s');
                    }
                }

                $result = $this->common_model->editInfo('product', $Id, $Info);
                // $result = true;
                if($result == true){
                    $this->session->set_flashdata('success', 'Updated successfully');
                }else{
                    $this->session->set_flashdata('error', 'Updation failed');
                }
                redirect($data['routeName'].$Id);
            }
        }
    }

    function delete_Old(){
        if($this->isAdmin() == TRUE) {
            echo(json_encode(array('status'=>'access')));
        } else {
            $id = $this->input->post('id');
            if($id == null){
                echo(json_encode(array('status'=>"FALSE")));
                die;
            }
            $url = $this->input->post('url');
            // echo(json_encode(array('status'=>$id)));
            $result = $this->common_model->delete($url, $id);
            if ($result > 0) { echo(json_encode(array('status'=>"TRUE"))); }
            else { echo(json_encode(array('status'=>"FALSE"))); }
        }
    }

    function delete(){
        if($this->isAdmin() == TRUE) {
            echo(json_encode(array('status'=>'access')));
        } else {
            $id = $this->input->post('id');
            $url = $this->input->post('url');
            
            if(empty($id) || empty($url)){
                redirect('dashboard');
            }

            if($url == 'testseries'){
                if(!isset($this->instId)){
                    echo(json_encode(array('status'=>"Failed")));
                    die;
                }
                $where = "id=$id ,institute_id=$this->instId";
                $result = $this->common_model->deleteDataFromTbl($url, $where);
            }else{
                $where = "id=$id";
                $result = $this->common_model->deleteDataFromTbl($url, $where);
            }
            if ($result > 0) { echo(json_encode(array('status'=>"TRUE"))); }
            else { echo(json_encode(array('status'=>"FALSE"))); }
        }
    }

    function ajaxAdd(){
        if($this->isAdmin() == TRUE) {
            echo(json_encode(array('status'=>'access')));
        } else {
            $info['product_id'] = $this->input->post('id');
            $info['user_id'] = $this->vendorId;
            $url = $this->input->post('url');
            $result = $this->common_model->addInfo($url, $info);
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }

    function addToCart($Id){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $Info['name'] = $this->input->post("name");
            $Info['product_id'] = $Id;
            $Info['user_id'] = $this->vendorId;

            $checkProduct = $this->common_model->checkRecordFromTable("product", "active=1,id=$Id");

            if($checkProduct == 0){
                echo(json_encode(array('status'=>FALSE, 'msg'=>'Invalid Product')));
                die;
            }
            $checkAddToCart = $this->common_model->checkRecordFromTable("shopping_cart", "user_id=$this->vendorId,product_id=$Id");
            
            if( $checkAddToCart > 0){
                echo(json_encode(array('status'=>FALSE, 'msg'=>'This Product is already added in shopping cart.')));
                die;
            }

            $result = $this->common_model->addInfo('shopping_cart', $Info);

            if ($result > 0) { echo(json_encode(array('status'=>TRUE, 'msg'=>'This Product is added in shopping cart'))); }
            else { echo(json_encode(array('status'=>FALSE, 'msg'=>'Adding process failed in shopping cart.'))); }
        }
    }

    function CartListing(){
        // echo "myCart";
        $this->global['pageTitle'] = 'AOA : My Cart';
        $data['title'] = 'My Cart';
        $data['deleteUrl'] = 'shopping_cart';
        $data['routeName'] = 'shoppingCart';
        $searchTexts = $this->security->xss_clean($this->input->post('searchText'));

        $data['searchText'] = $searchTexts;
        $this->load->library('pagination');
        // $count = $this->common_model->ListingCount($searchTexts);
        $count = $this->common_model->cartListingCountCustom($searchText = '', 'shopping_cart', $this->vendorId);

        $returns = $this->paginationCompress("myCart/", $count, 100 );
            
        $data['Records'] = $this->common_model->cartListingCustom($searchTexts, 'shopping_cart', $this->vendorId, $returns["page"], $returns["segment"]);
        
        $this->loadViews("cart/list", $this->global, $data, NULL);
    }

    function shoppingCartListing(){
        $this->global['pageTitle'] = 'AOA : My Cart';
        $data['title'] = 'My Cart';
        $data['deleteUrl'] = 'shopping_cart';
        $data['routeName'] = 'order';
        $searchTexts = $this->security->xss_clean($this->input->post('searchText'));

        $data['searchText'] = $searchTexts;
        $this->load->library('pagination');

        $count = $this->common_model->cartListingCountCustom($searchText = '', 'shopping_cart', $this->vendorId);

        $returns = $this->paginationCompress("shoppingCart/", $count, 100 );

        $data['Records'] = $this->common_model->cartListingCustom($searchTexts, 'shopping_cart', $this->vendorId, $returns["page"], $returns["segment"]);
        $data['Tax'] = 0;
        $data['Discount'] = 0;
        $data['Total'] = $this->common_model->cartPrice($this->vendorId);
        // pre($data);die;
        $this->loadViews("cart/cart_list", $this->global, $data, NULL);
    }

    function favoriteListing(){
        $this->global['pageTitle'] = 'AOA : My Favorite';
        $data['title'] = 'My Favorite';
        $data['deleteUrl'] = 'favorite';
        $data['route'] = 'favorite';
        $data['pdf'] = 'assets/images/pdf.jpg';
        $data['video'] = 'assets/images/video.png';
        $searchTexts = $this->security->xss_clean($this->input->post('searchText'));

        $data['searchText'] = $searchTexts;
        $this->load->library('pagination');

        $count = $this->common_model->cartListingCountCustom($searchText = '', 'favorite', $this->vendorId);

        $returns = $this->paginationCompress("favorite/", $count, 10 );

        $data['Records'] = $this->common_model->cartListingCustom($searchTexts, 'favorite', $this->vendorId, $returns["page"], $returns["segment"]);
        // $data['Tax'] = 0;
        // $data['Discount'] = 0;
        // $data['Total'] = $this->common_model->cartPrice($this->vendorId);
        // pre($data);die;
        $this->loadViews("cart/favorite", $this->global, $data, NULL);
    }

    function placeOrder(){
        $Info['tax'] = 0;
        $Info['discount_amount'] = 0;

        $Info['amount'] = $this->security->xss_clean($this->input->post('amount'));
        $Info['tax'] = $this->security->xss_clean($this->input->post('tax'));
        $Info['discount_amount'] = $this->security->xss_clean($this->input->post('discount'));
        $Info['promotion_code'] = $this->security->xss_clean($this->input->post('promo'));
        $Info['user_id'] = $this->vendorId;
        $Info['status'] = '1';

        if(empty($Info['amount'])){
            redirect('shoppingCart');
        }

        $orderResult = $this->common_model->addInfo('orders', $Info);
        if($orderResult > 0){
            $results = $this->common_model->cartItems($this->vendorId);
            $res = [];
            foreach($results as $res){
                $res->order_id = $orderResult;
                $data = (array)$res;
                $orderItemsResult = $this->common_model->addInfo('order_items', $data);
                if($orderItemsResult > 0){
                    $this->common_model->deleteDataFromTbl('shopping_cart', "user_id=$this->vendorId");
                }
            }
        }
    }

    function invoice($id){
        // echo "invoice";
        $this->global['pageTitle'] = 'AOA : Invoice';
        $data['User'] = $this->common_model->getAllData('user','All',"id=$this->vendorId",NULL);
        $data['title'] = 'Invoice';
        $data['Orders'] = $this->common_model->getAllData('orders','All',"id=$id",NULL);
        $data['Items'] = $this->common_model->getItemsByOrderId($id);
        // pre($data);
        // die;
        $this->loadViews("invoice/invoice", $this->global, $data, NULL);
    }

    function testListing(){
        echo "testListing";
        $this->global['pageTitle'] = 'AOA : testListing';
        // $data['User'] = $this->common_model->getAllData('user','All',"id=$this->vendorId",NULL);
        $data['title'] = 'testListing';
        // $data['Orders'] = $this->common_model->getAllData('orders','All',"id=$id",NULL);
        // $data['Items'] = $this->common_model->getItemsByOrderId($id);
        // pre($data);
        // die;
        $this->loadViews("test/testing", $this->global, $data, NULL);
        // die;
    }

    function questions(){
        // echo "questions";
        $data['title'] = 'Questions';
        $data['routeName'] = "questions/new";
        $this->global['pageTitle'] = 'AOA : Questions';
        $data['Category'] = $this->common_model->getAllData('category',NULL,"active=1",NULL);
        $this->loadViews("question/question", $this->global, $data, NULL);
    }

    public function questionsListing(){
        $data['title'] = 'Questions';
        $data['routeName'] = "questions/new";
        $data['route'] = "questions/";
        $this->global['pageTitle'] = 'AOA : Questions';

        $tblName = 'questions';

        $pageValue = $this->security->xss_clean($this->input->post('pageValue'));
        $category = $this->security->xss_clean($this->input->post('category'));
        $data['category'] = $category;

        $subcategory = $this->security->xss_clean($this->input->post('subcategory'));
        $data['subcategory'] = $subcategory;

        $data['Category'] = $this->common_model->getAllData('category', null, 'active=1');

        if(!empty($category)){
            $data['SubCategory'] = $this->common_model->getAllData('subcategory', null, "active=1,category_id=$category");
        }else{
            $data['SubCategory'] = 0;
        }

        $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
        $data['searchText'] = $searchTexts;
        $this->load->library('pagination');

        $count = $this->exam_model->questionListCount($searchTexts, $tblName, $category, $subcategory, null );
        $returns = $this->paginationCompress($data['route'], $count, 10);
        if($pageValue == 1){
            $data['Records'] = $this->exam_model->questionList($searchTexts, $tblName, $category, $subcategory, null, $returns["page"], $returns["segment"]);
        }else{
            $data['Records'] = null;
        }
        

        $this->loadViews("question/questionList", $this->global, $data, NULL);
    }

    function questionsNew(){
        $data['title'] = 'Add Questions';
        $data['routeName'] = 'questions/new/addNew';
        $this->global['pageTitle'] = 'AOA : Add Questions';
        $data['Category'] = $this->common_model->getAllData('category',NULL,"active=1",NULL);
        $this->loadViews("question/add", $this->global, $data, NULL);
    }

    function questionAdd(){
        $this->form_validation->set_rules('subcat','Sub Category','trim|required|numeric');
        $this->form_validation->set_rules('catname','Category Name','trim|required|numeric');
        $this->form_validation->set_rules('options','Currect Answer','trim|required|numeric|max_length[1]|min_length[1]');
        $this->form_validation->set_rules('year','Year','trim|required|numeric');

        if($this->form_validation->run() == FALSE)
        {
            $this->questionsNew();
        }else{
            $catnameId = $this->security->xss_clean($this->input->post('catname'));
            $subcatId = $this->security->xss_clean($this->input->post('subcat'));
            $year = $this->security->xss_clean($this->input->post('year'));

            $uploaderId = $this->security->xss_clean($this->input->post('uploaderName'));
            $status = $this->security->xss_clean($this->input->post('status'));

            $description = $this->security->xss_clean($this->input->post('desc'));
            $question = $this->input->post('question');

            $option['option_1'] = $this->security->xss_clean($this->input->post('answer1'));
            $option['option_2'] = $this->security->xss_clean($this->input->post('answer2'));
            $option['option_3'] = $this->security->xss_clean($this->input->post('answer3'));
            $option['option_4'] = $this->security->xss_clean($this->input->post('answer4'));
            $option['correct_answer'] = 'option_'.$this->security->xss_clean($this->input->post('options'));
            $answers = json_encode($option);
            $Info = array(
                'created_by'=> $this->vendorId,
                'question'=>$question,
                'answers'=> $answers,
                'desc'=> $description,
                'category_id'=> $catnameId,
                'sub_category_id'=> $subcatId,
                'created_at'=>date('Y-m-d H:i:s')
            );

            $tblName = 'questions';
            $result = 0;
            $result = $this->common_model->addInfo($tblName, $Info);
            if($result > 0) {
                $this->session->set_flashdata('success', 'Question successfully');
            } else {
                $this->session->set_flashdata('error', 'Process failed');
            }
            redirect('questions/new');
        }
    }

    function questionsList(){
        $categoryId = $this->security->xss_clean($this->input->post('category_id'));
        $subcategoryId = $this->security->xss_clean($this->input->post('subcategory_id'));
        
        if(is_numeric($categoryId) && is_numeric($subcategoryId)){
            $result = $this->common_model->getAllData('questions',"All","category_id=$categoryId, sub_category_id=$subcategoryId",NULL);
            // $result = $this->exam_model->questionsList($exam_Id);
            // echo json_encode($result);
            if($result){
                echo json_encode($result);
                // echo json_encode(array( ['status' => 200, 'result'=> $result]));
            }else{
                echo json_encode('404');
                // echo json_encode('Result Not Found!');
                // echo json_encode(array( ['status' => 404, 'result'=> 'Result Not Found!']));
            }
            
            // return json_encode(array( ['statuscode' => 200, 'result'=> $result]));
        }else{
            echo json_encode('400');
            // echo json_encode('Bad Request Error');
            // echo json_encode(array( ['status' => 400, 'result'=> 'Bad Request Error']));
            // return json_encode(array( ['statuscode' => 404, 'result'=> 'False']));
        }
    }



}