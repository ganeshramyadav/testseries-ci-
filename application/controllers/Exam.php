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
        // die;
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
                $Info['created_by'] = $this->vendorId;
                $institute_id = $this->common_model->getAllData('institute', 'id', "user_id = $this->vendorId", null);
                
                if(empty($institute_id)){
                    $this->session->set_flashdata('error', 'Somthing Went Wrong.');
                    redirect('exam/edit/'.$Id);
                }

                $Info['institute_id'] = $institute_id->id;
                $Info['updated_at'] = date("Y-m-d H:m:s");

                if(is_int($Info['no_of_question']) || is_int($Info['duration']) || is_int($Info['category_id']) || is_int($Info['subcategory_id']) || is_int($Info['no_of_question'])){
                    $this->session->set_flashdata('error', 'Somthing Went Wrong.');
                    redirect('exam/edit/'.$Id);
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

    public function questionList(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $examId = $this->security->xss_clean($this->input->post('examId'));
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
            $tblName = 'questions';

            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchTexts;
            $tblName = 'questions';
            $ExamRecords = $this->common_model->getAllData('exam', "All", "id=$examId");
            $data['CategoryRecords'] = $this->common_model->getAllData('exam_category', "name", "id=$ExamRecords->category_id");
            $data['SubCategoryRecords'] = $this->common_model->getAllData('exam_subcategory', "name", "id=$ExamRecords->subcategory_id");

            if(empty($ExamRecords)){
                redirect('exam');
            }
            $data['ExamRecords'] = $ExamRecords;
            
            $data['Category'] = $this->common_model->getAllData('category', null, "active=1", null);
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
                redirect('dashboard');
            }

            $count = $this->exam_model->questionListCount($searchTexts, $tblName, $quesId );
            $returns = $this->paginationCompress($data['route']."/", $count, 5);
            $data['Records'] = $this->exam_model->questionList($searchTexts, $tblName, $quesId, $returns["page"], $returns["segment"]);
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

    public function delete(){
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
            $result = $this->exam_model->delete('exam_question', $Info);
            if ($result > 0) { echo(json_encode(array('status'=>"TRUE"))); }
            else { echo(json_encode(array('status'=>"FALSE"))); }
        }
    }

}