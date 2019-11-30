<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Exam extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('exam_model');
        $this->load->model('common_model');
        $this->load->model('picklist_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper("file");
        $this->isLoggedIn();
    }

    public function List(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $currentURL = current_url();
            if (strpos($currentURL, "exam")==true){
                $data['title'] = 'Exam';
                $this->global['pageTitle'] = 'AOA : Exam';
                $data['routeName'] = 'exam/new';
                $productType = 'exam';
                $data['route'] = 'selectedquestion';
                $data['editRoute'] = 'exam/edit/';
                $data['defaultImg'] = base_url().'assets/images/pdf.jpg';
                $data['roleId'] = $this->role;
            }else{
                $this->loadThis();
            }
            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchTexts;
            $this->load->library('pagination');
            $count = $this->exam_model->ListingCount($searchTexts, $productType);
            $returns = $this->paginationCompress($productType."/", $count, 10 );
            $data['Records'] = $this->exam_model->Listing($searchTexts, $productType, $returns["page"], $returns["segment"]);
            $this->loadViews("exam/exam", $this->global, $data, NULL);
        }
    }

    public function edit($Id = null){
        // echo $Id;
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'AOA : Edit Examination';
            $data['title'] = 'Edit Examination';
            $data['routeName'] = 'exam/edit';
            $data['redirect'] = 'exam';
            $tblName = "exam";
            if($Id == null){
                redirect($data['redirect']);
            }
            $data['Info'] = $this->common_model->getAllData($tblName,'All',"active=1, id=$Id");
            $CatId = $data['Info']->category_id;
            $data['Category'] = $this->common_model->getAllData('exam_category','All',"active=1", null);
            $data['SubCategory'] = $this->common_model->getAllData('exam_subcategory','All',"active=1, category_id=$CatId");
          /*   pre($data['SubCategory']);
            die; */
            if(empty($data['Info'])){
                redirect($data['redirect']);
            }
            $this->loadViews("exam/editOld", $this->global, $data, NULL);
        }
    }

    public function update(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $Id = $this->security->xss_clean($this->input->post('Id'));
            $this->form_validation->set_rules('title','Title','trim|required|max_length[128]');
            $this->form_validation->set_rules('noq','Number Of Question','trim|required|numeric');
            $this->form_validation->set_rules('duration','Exam Duration','trim|required|numeric');
            $this->form_validation->set_rules('catname','Category','trim|required|numeric');
            $this->form_validation->set_rules('subcat','Sub Category','trim|required|numeric');
            $this->form_validation->set_rules('year','Year','trim|required|numeric|max_length[4]|min_length[4]');
            
            if( empty($Id) || $Id == NULL ){
                redirect('exam');
            }

            if($this->form_validation->run() == FALSE){
                $this->edit($Id);
            }else{
                $Info['title'] = strtolower($this->security->xss_clean($this->input->post('title')));
                $Info['no_of_question'] = $this->security->xss_clean($this->input->post('noq'));
                $Info['duration'] = $this->input->post('duration');
                $Info['category_id'] = $this->input->post('catname');
                $Info['subcategory_id'] = $this->security->xss_clean($this->input->post('subcat'));
                $Info['active'] = $this->security->xss_clean($this->input->post('status'));
                $Info['year'] = $this->security->xss_clean($this->input->post('year'));
                $this->instId = 1;
                $Info['created_by'] = $this->vendorId;

                $instituteIdByUserId = $this->common_model->getAllData('exam', 'institute_id', "id = $Id", null);

                if(!isset($this->instId)){
                    $this->session->set_flashdata('error', 'Illegal Process.');
                    redirect('exam/edit/'.$Id);
                }else{
                    $institute_id = $this->instId;
                }

                // $institute_id= 1;
                if(empty($institute_id)){
                    $this->session->set_flashdata('error', 'You Have Not Permitted to Perform This Action!');
                    redirect('exam/edit/'.$Id);
                }

                if($institute_id != $instituteIdByUserId->institute_id){
                    $this->session->set_flashdata('error', 'Illegal Process.');
                    redirect('exam/edit/'.$Id);
                }

                $Info['institute_id'] = $institute_id->id;
                // $Info['institute_id'] = 1;
                $Info['updated_at'] = date("Y-m-d H:m:s");

                if(is_int($Info['no_of_question']) || is_int($Info['duration']) || is_int($Info['category_id']) || is_int($Info['subcategory_id']) || is_int($Info['no_of_question'])){
                    $this->session->set_flashdata('error', 'Somthing Went Wrong.');
                    redirect('exam/edit/'.$Id);
                }

                /* For Image File Upload */
                if($_FILES['thumb']['name']){
                    $imgPath = 'assets/content/examination_image/'.$Id;
                    $path = base_url().$imgPath;
                    if (!is_dir($imgPath)){
                        mkdir($imgPath, 0700, TRUE);
                    }
                    $config['upload_path'] = './'.$imgPath.'/';
                    
                    $config['allowed_types']        = 'jpge|jpg|png';
                    $config['max_size']             = '0';
                    $config['min_width']            = 235;
                    $config['min_height']           = 200;

                    $config['encrypt_name']         = TRUE;
                    
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('thumb')) {
                        $error =$this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('exam/edit/'.$Id);
                    } else {
                        $uploadData =  $this->upload->data();
                        /* if(is_file($imgFullPath)) {
                            unlink($imgFullPath);
                        } */
                        $Info['image_url'] = $imgPath."/".$uploadData['file_name'];
                        $Info['updated_at'] = date('Y-m-d H:i:s');
                    }
                }

                $result = $this->common_model->editInfo('exam', $Id, $Info);
                if($result == true){
                    $this->session->set_flashdata('success', 'Updated successfully');
                }else{
                    $this->session->set_flashdata('error', 'Updation failed');
                }
                redirect('exam/edit/'.$Id);
            }
        }
    }

    public function new(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'AOA : Add New Examination';
            $data['title'] = 'Add New Examination';
            $data['routeName'] = 'exam/new/addNew';
            $data['redirect'] = 'exam';
            $tblName = "exam";
            
            $data['Info'] = $this->common_model->getAllData($tblName,'All',null);
            $data['Category'] = $this->common_model->getAllData('exam_category','All',"active=1", null);
            $this->loadViews("exam/add", $this->global, $data, NULL);
        }
    }

    public function addNew(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $this->form_validation->set_rules('title','Title','trim|required|max_length[128]');
            $this->form_validation->set_rules('noq','Number Of Question','trim|required|numeric');
            $this->form_validation->set_rules('duration','Exam Duration','trim|required|numeric');
            $this->form_validation->set_rules('catname','Category','trim|required|numeric');
            $this->form_validation->set_rules('subcat','Sub Category','trim|required|numeric');
            $this->form_validation->set_rules('year','Year','trim|required|numeric|max_length[4]|min_length[4]');
            
            
            if($this->form_validation->run() == FALSE){
                redirect('exam/new');
            }else{
                $Info['title'] = strtolower($this->security->xss_clean($this->input->post('title')));
                $Info['no_of_question'] = $this->security->xss_clean($this->input->post('noq'));
                $Info['duration'] = $this->input->post('duration');
                $Info['category_id'] = $this->input->post('catname');
                $Info['subcategory_id'] = $this->security->xss_clean($this->input->post('subcat'));
                $Info['active'] = $this->security->xss_clean($this->input->post('status'));
                $Info['year'] = $this->security->xss_clean($this->input->post('year'));
                $Info['created_by'] = $this->vendorId;

                $tblName = 'exam';
                
                $institute = $this->common_model->getAllData('institute', 'id', "user_id = $this->vendorId", null);

                // $institute = 1;
                if(empty($institute)){
                    $this->session->set_flashdata('error', 'You Have Not Permitted to Perform This Action!');
                    redirect('exam/new');
                }

                $Info['institute_id'] = $institute->id;
                // $Info['institute_id'] = 1;
                $Info['created_at'] = date("Y-m-d H:m:s");

                if(is_int($Info['no_of_question']) || is_int($Info['duration']) || is_int($Info['category_id']) || is_int($Info['subcategory_id']) || is_int($Info['no_of_question'])){
                    $this->session->set_flashdata('error', 'Somthing Went Wrong.');
                    redirect('exam/new');
                }

                // $result = $this->common_model->addInfo('exam', $Info);

                $insertedData = 0;
                $insertedData = $this->common_model->addInfo($tblName, $Info);

                /* For Image File Upload */
                if($_FILES['thumb']['name']){

                    $imgPath = 'assets/content/examination_image/'.$insertedData;
                    $path = base_url().$imgPath;
                    if (!is_dir($imgPath)){
                        mkdir($imgPath, 0700, TRUE);
                    }
                    $config['upload_path'] = './'.$imgPath.'/';
                    $config['allowed_types']        = 'jpge|jpg|png';
                    $config['max_size']             = '0';
                    $config['min_width']            = 235;
                    $config['min_height']           = 200;

                    $config['encrypt_name']         = TRUE;

                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('thumb')) {
                        $deleted = $this->common_model->deleteDataFromTbl($tblName, "id=$insertedData");
                        rmdir($imgPath);
                        /* if(rmdir($imgPath)){
                            // echo ("$insertedData successfully removed");
                            $this->session->set_flashdata('error', "$insertedData successfully removed");
                        } else {
                            // echo ("$insertedData couldn't be removed"); 
                            $this->session->set_flashdata('error', "$insertedData successfully removed");
                        } */
                        $error =$this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('exam/new');
                    } else {
                        $uploadData =  $this->upload->data();
                        $smEditInfo['image_url'] = $imgPath."/".$uploadData['file_name'];
                    }
                }
                $result = $this->common_model->editInfo($tblName, $insertedData, $smEditInfo);

                if($result == true){
                    $this->session->set_flashdata('success', 'Updated successfully');
                }else{
                    $this->session->set_flashdata('error', 'Updation failed');
                }
                redirect('exam/new');
            }
        }
    }

    public function questionList(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $examId = $this->security->xss_clean($this->input->post('examId'));

            if(is_int($examId+0) == FALSE){
                redirect('exam');
            }

            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchTexts;

            $ExamRecords = $this->common_model->getAllData('exam', "All", "id=$examId");
            $data['CategoryRecords'] = $this->common_model->getAllData('exam_category', "name", "id=$ExamRecords->category_id");
            $data['SubCategoryRecords'] = $this->common_model->getAllData('exam_subcategory', "name", "id=$ExamRecords->subcategory_id");

            if(empty($ExamRecords)){
                redirect('exam');
            }
            $data['ExamRecords'] = $ExamRecords;

            $this->load->library('pagination');
            $data['route'] = "selectedquestion";

            $data['title'] = 'Selected Question List';
            $this->global['pageTitle'] = 'AOA : Question List';
            $data['routeName'] = "addquestion";
            
            $data['delete'] = 'exam_question';
            $data['editRoute'] = 'exam/edit/';
            $data['editId'] = 0;

            $tblName = 'exam_question';
            $count = $this->exam_model->examquestionListingCount($searchTexts, $tblName, "exam_id=$examId");
            $data['count'] = $count;
            $returns = $this->paginationCompress($data['route']."/", $count, 10 );
            $data['Records'] = $this->exam_model->examquestionListing($searchTexts, $tblName, "exam_id=$examId", $returns["page"], $returns["segment"]);
            
            $this->loadViews("exam/selected_question", $this->global, $data, NULL);
        }
    }

    public function addquestions(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $examId = $this->security->xss_clean($this->input->post('examId'));
            $this->load->library('pagination');
            
            $data['title'] = 'Selected Question List';
            $this->global['pageTitle'] = 'AOA : Question List';
            $data['route'] = "addquestion";

            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchTexts;
            $tblName = 'questions';
            $ExamRecords = $this->common_model->getAllData('exam', "All", "id=$examId");

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

            $data['CategoryRecords'] = $this->common_model->getAllData('exam_category', "name", "id=$ExamRecords->category_id");
            $data['SubCategoryRecords'] = $this->common_model->getAllData('exam_subcategory', "name", "id=$ExamRecords->subcategory_id");

            if(empty($ExamRecords)){
                redirect('exam');
            }
            $data['ExamRecords'] = $ExamRecords;
            
            $data['count'] = $this->common_model->getAllData('exam_question', 'question_id', "exam_id=$examId", 'yes');
            $__questionId = $this->common_model->getAllData('exam_question', 'question_id', "exam_id=$examId", null);
            
            if(sizeof((array)$__questionId)>1){
                $quesId = [];
                $i = 1;
                foreach($__questionId as $val){
                    $quesId[$i] = $val->question_id;
                    $i++;
                }
            }else{
                $quesId = (array)$__questionId;
            }

            if(empty($quesId)){
                redirect('exam');
            }
            
            $count = $this->exam_model->questionListCount($searchTexts, $tblName, $category, $subcategory, $quesId );
            $returns = $this->paginationCompress($data['route']."/", $count, 10);
            $data['Records'] = $this->exam_model->questionList($searchTexts, $tblName, $category, $subcategory, $quesId, $returns["page"], $returns["segment"]);
            $this->loadViews("exam/question", $this->global, $data, NULL);
        }
    }

    public function addExamQuestion(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $Info['exam_id'] = $this->security->xss_clean($this->input->post('examId'));
            $Info['question_id'] = $this->security->xss_clean($this->input->post('questionId'));
            $type = $this->security->xss_clean($this->input->post('ajax'));
            if($type != "ajax"){
                redirect('dashboard');
            }
            if(!is_numeric($Info['exam_id']) || !is_numeric($Info['question_id']) || $Info['exam_id']==0 || $Info['question_id']==0){
                echo(json_encode(array('status'=>"FALSE")));
            }
            $Info['active'] = 1;
            $Info['created_at'] = date('Y-m-d H:i:s');
            $result = $this->common_model->addInfo('exam_question', $Info);
            if ($result > 0) { echo(json_encode(array('status'=>"TRUE"))); }
            else { echo(json_encode(array('status'=>"FALSE"))); }
        }
    }

    public function deleteExamQuestion(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $Info['exam_id'] = $this->security->xss_clean($this->input->post('examId'));
            $Info['question_id'] = $this->security->xss_clean($this->input->post('questionId'));
            $type = $this->security->xss_clean($this->input->post('ajax'));
            if(isset($this->instId)){
                $Info['institute_id'] = $this->instId;
            }else{
                $Info['institute_id'] = 1;
            }
            if($Info['institute_id'] <=1){
                echo(json_encode(array('status'=>"Denied")));
                die;
            }
            // empty($Info['institute_id']
            if($type != "ajax" ){
                echo(json_encode(array('status'=>"Denied")));
                die;
                // redirect('dashboard');
            }
            if(!is_numeric($Info['exam_id']) || !is_numeric($Info['question_id']) || $Info['exam_id']==0 || $Info['question_id']==0){
                echo(json_encode(array('status'=>"FALSE")));
            }
            $result = $this->exam_model->delete('exam_question', $Info);
            if ($result > 0) { echo(json_encode(array('status'=>"TRUE"))); }
            else { echo(json_encode(array('status'=>"FALSE"))); }
            die;
        }
    }

    public function seriesList(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $data['title'] = 'Test Series';
            $this->global['pageTitle'] = 'AOA : TestSeries';
            $data['routeName'] = 'testseries/new';
            $tblName = 'testseries';
            $route = 'testseries';
            $data['route'] = 'testseries';
            $data['exam'] = 'selectedexam';
            $data['editRoute'] = 'testseries/edit/';

            $data['roleId'] = $this->role;

            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchTexts;
            $this->load->library('pagination');
            $count = $this->exam_model->testseriesListingCount($searchTexts, $tblName);
            $returns = $this->paginationCompress($route."/", $count, 10 );
            $data['Records'] = $this->exam_model->testseriesListing($searchTexts, $tblName, $returns["page"], $returns["segment"]);
            $this->loadViews("testseries/testSeries", $this->global, $data, NULL);
        }
    }

    public function seriesEdit($Id = null){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'AOA : Edit TestSeries';
            $data['title'] = 'Edit TestSeries';
            $data['routeName'] = 'testseries/edit';
            $data['redirect'] = 'testseries';
            $tblName = "testseries";
            if($Id == null){
                redirect($data['redirect']);
            }
            $data['Info'] = $this->common_model->getAllData($tblName,'All',"id=$Id");
            $data['Info']->testing = true ;
            /* $InstituteId = $data['Info']->institute_id;
            $data['Institute'] = $this->common_model->getAllData('institute','name',"id=$InstituteId");
            $data['Info']->institute_name = $data['Institute']->name; */
            if(empty($data['Info'])){
                redirect($data['redirect']);
            }
            $this->loadViews("testseries/editOld", $this->global, $data, NULL);
        }
    }

    public function seriesUpdate(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $Id = $this->security->xss_clean($this->input->post('Id'));
            $isPublic = $this->security->xss_clean($this->input->post('isPublic'));

            $this->load->library('upload');
            $this->load->helper("file");

            $this->form_validation->set_rules('title','Test Series Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('noe','Number Of Examination','trim|required|numeric');
            $this->form_validation->set_rules('isPublic','Public Access','trim|required|numeric');

            if($isPublic == FALSE){
                $this->form_validation->set_rules('currency-field','Price(In Rs.)','trim|required|numeric');
                $currency = $this->security->xss_clean($this->input->post('currency-field'));
            }else{
                $currency = 0;
            }

            if($this->form_validation->run() == FALSE){
                $this->seriesEdit($Id);
            }else{

                $this->global['pageTitle'] = 'AOA : Edit TestSeries';
                $data['title'] = 'Edit TestSeries';
                $data['routeName'] = 'testseries/edit/';
                $data['redirect'] = 'testseries';
                $tblName = "testseries";

                if($Id == null){
                    redirect($data['redirect']);
                }

                $name = strtolower($this->security->xss_clean($this->input->post('title')));
                $noe = $this->security->xss_clean($this->input->post('noe'));

                $Info['Name'] = $name;
                $Info['no_of_exam'] = $noe;
                $Info['isPublic'] = $isPublic;
                $Info['price'] = $currency;
                $Info['created_by'] = $this->vendorId;

                if(isset($this->instId)){
                    $Info['institute_id'] = $this->instId;
                }else{
                    $Info['institute_id'] = 1;
                }

                $filepath = 'testseries';

                /* For Image File Upload */
                if($_FILES['thumb']['name']){
                    if($isPublic == TRUE){
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

                    $config['encrypt_name']         = TRUE;
                    
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

                $result = $this->common_model->editInfo($tblName, $Id, $Info);
                if($result == true){
                    $this->session->set_flashdata('success', 'Updated successfully');
                }else{
                    $this->session->set_flashdata('error', 'Updation failed');
                }
                redirect($data['routeName'].$Id);
            }
        }
    }

    public function seriesNew(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $this->global['pageTitle'] = 'AOA : Add TestSeries';
            $data['title'] = 'Add TestSeries';
            $data['routeName'] = 'testseries/new/addNew';
            $tblName = "testseries";
            $this->loadViews("testseries/add", $this->global, $data, NULL);
        }
    }

    public function seriesAddNew(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $isPublic = $this->security->xss_clean($this->input->post('isPublic'));

            $this->load->library('upload');
            $this->load->helper("file");

            $this->form_validation->set_rules('title','Test Series Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('noe','Number Of Examination','trim|required|numeric');
            $this->form_validation->set_rules('isPublic','Public Access','trim|required|numeric');

            if($isPublic == FALSE){
                $value = $this->security->xss_clean($this->input->post('currency-field'));
                if($value == 0){
                    $this->form_validation->set_rules('currency-field','Price(In Rs.)','trim|required|decimal');
                }
                $currency = str_replace(",", "", $value);
            }else{
                $currency = 0;
            }

            if($this->form_validation->run() == FALSE){
                $this->seriesNew();
            }else{
                $tblName = "testseries";
                $filepath = 'testseries';

                $data['routeName'] = 'testseries/new';

                $name = strtolower($this->security->xss_clean($this->input->post('title')));
                $noe = $this->security->xss_clean($this->input->post('noe'));

                if($this->role == 2){
                    $instituteId = $this->instId;
                    
                }else{
                    $instituteId = 1;
                }
                $Info['institute_id'] = $instituteId;

                $Info['Name'] = $name;
                $Info['no_of_exam'] = $noe;
                $Info['isPublic'] = $isPublic;
                $Info['price'] = $currency;
                $Info['created_by'] = $this->vendorId;
                $Info['created_at'] = date("Y-m-d H:i:s");

                $insertedData = 0;
                $insertedData = $this->common_model->addInfo($tblName, $Info);

                /* For Image File Upload */
                if($_FILES['thumb']['name']){
                    if($isPublic == TRUE){
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

                    $config['encrypt_name']         = TRUE;

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

    public function examList(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $seriesId = $this->security->xss_clean($this->input->post('seriesId'));
            if(is_int($seriesId+0) == true){
                $data['title'] = 'Selected Examination List';
                $this->global['pageTitle'] = 'AOA : Examination List';
                $data['routeName'] = "addexam";
                $data['delete'] = 'exam_question';
                $data['editRoute'] = 'exam/edit/';
                $data['editId'] = 0;
                $data['route'] = "selectedexam/";
                $data['roleId'] = $this->role;
                $data['defaultImg'] = base_url().'assets/images/pdf.jpg';
                $data['type'] = 'selected';

                $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
                $data['searchText'] = $searchTexts;

                $data['SeriesRecord'] = $this->common_model->getAllData('testseries', "All", "id=$seriesId");

                $tblName = 'test_exam';
                $count = $this->exam_model->testexamListingCount($searchTexts, $tblName, "test_series_id=$seriesId");
                $data['count'] = $count;

                $returns = $this->paginationCompress($data['route'], $count, 10 );
                $data['Records'] = $this->exam_model->testexamListing($searchTexts, $tblName, "test_series_id=$seriesId", $returns["page"], $returns["segment"]);

                // $this->loadViews("testseries/selected_exam", $this->global, $data, NULL);
                $this->loadViews("testseries/exam_new", $this->global, $data, NULL);
            }else{
                redirect('testseries');
            }
        }
    }

    public function addexam(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $seriesId = $this->security->xss_clean($this->input->post('seriesId'));

            if(is_int($seriesId+0) == FALSE){
                redirect('testseries');
            }
            $data['title'] = 'Selected Examination List';
            $this->global['pageTitle'] = 'AOA : Examination List';
            $data['routeName'] = "addexam";
            $data['delete'] = 'exam_question';
            $data['editRoute'] = 'exam/edit/';
            $data['route'] = "selectedexam/";
            $data['defaultImg'] = base_url().'assets/images/pdf.jpg';
            $data['roleId'] = $this->role;

            $data['type'] = 'select';

            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchTexts;

            $SeriesRecord = $this->common_model->getAllData('testseries', "All", "id=$seriesId");
            if(empty($SeriesRecord)){
                redirect('testseries');
            }
            $data['SeriesRecord'] = $SeriesRecord;

            $data['count'] = $this->common_model->getAllData('test_exam', 'exam_id', "test_series_id=$seriesId", 'yes');
            $__examId = $this->common_model->getAllData('test_exam', 'exam_id', "test_series_id=$seriesId", null);
            
            if(sizeof((array)$__examId) > 1){
                $examId = [];
                $i = 1;
                foreach($__examId as $val){
                    $examId[$i] = $val->exam_id;
                    $i++;
                }
            }else{
                $examId = (array)$__examId;
            }

            if(empty($examId)){
                // pre($examId);
                // die;
                redirect('testseries');
            }

            $category = $this->security->xss_clean($this->input->post('category'));
            $data['category'] = $category;

            $subcategory = $this->security->xss_clean($this->input->post('subcategory'));
            $data['subcategory'] = $subcategory;

            $data['Category'] = $this->common_model->getAllData('exam_category', null, 'active=1');

            if(!empty($category)){
                $data['SubCategory'] = $this->common_model->getAllData('exam_subcategory', null, "active=1,category_id=$category");
            }else{
                $data['SubCategory'] = 0;
            }

            $tblName = 'exam';
            $count = $this->exam_model->questionListCount($searchTexts, $tblName, $category, $subcategory, $examId );
            $returns = $this->paginationCompress($data['route']."/", $count, 10);
            $data['Records'] = $this->exam_model->questionList($searchTexts, $tblName, $category, $subcategory, $examId, $returns["page"], $returns["segment"]);

            $this->loadViews("testseries/exam_new", $this->global, $data, NULL);
            // $this->loadViews("testseries/exam", $this->global, $data, NULL);
        }
    }

    public function deleteSeriesExam(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $Info['exam_id'] = $this->security->xss_clean($this->input->post('examId'));
            $Info['test_series_id'] = $this->security->xss_clean($this->input->post('seriesId'));
            $type = $this->security->xss_clean($this->input->post('ajax'));
            // $Info['institute_id'] = $this->instId;
            $Info['institute_id'] = 1;
            if(empty($Info['institute_id'])){
                redirect("dashboard");
            }
            if($type != "ajax"){
                redirect('dashboard');
            }
            if(!is_numeric($Info['exam_id']) || !is_numeric($Info['test_series_id']) || $Info['exam_id']==0 || $Info['test_series_id']==0){
                echo(json_encode(array('status'=>"FALSE")));
            }
            $result = $this->exam_model->delete('test_exam', $Info);
            if ($result > 0) { echo(json_encode(array('status'=>"TRUE"))); }
            else { echo(json_encode(array('status'=>"FALSE"))); }
        }
    }

    public function addSeriesExam(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $Info['exam_id'] = $this->security->xss_clean($this->input->post('examId'));
            $Info['test_series_id'] = $this->security->xss_clean($this->input->post('seriesId'));
            $type = $this->security->xss_clean($this->input->post('ajax'));
            if($type != "ajax"){
                redirect('dashboard');
            }
            if(!is_numeric($Info['exam_id']) || !is_numeric($Info['test_series_id']) || $Info['exam_id']==0 || $Info['test_series_id']==0){
                echo(json_encode(array('status'=>"FALSE")));
            }
            // $Info['institute_id'] = $this->instId;
            $Info['institute_id'] = 1;
            if(empty($Info['institute_id'])){
                redirect("dashboard");
            }
            $Info['created_at'] = date('Y-m-d H:i:s');
            $result = $this->common_model->addInfo('test_exam', $Info);
            if ($result > 0) { echo(json_encode(array('status'=>"TRUE"))); }
            else { echo(json_encode(array('status'=>"FALSE"))); }
        }
    }

}