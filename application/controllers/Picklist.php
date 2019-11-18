
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Picklist extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('picklist_model');
        $this->load->model('common_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    function List(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE) {
            $this->loadThis();
        } else {
            $uri_path = parse_url(current_url(), PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $i = sizeof($uri_segments)-1;
            $word = $uri_segments[$i];
            
            if($word == "examsubcategory"){
                $this->global['pageTitle'] = 'AOA : Exam SubCategory';
                $data['title'] = 'SubCategory';
                $data['routeName'] = 'examsubcategory/new';
                $productType = 'exam_subcategory';
                $data['route'] = 'examsubcategory';
                $data['editRoute'] = 'examsubcategory/edit/';
                $joinTblName = "exam_category";
            }
            if($word == "examcategory"){
                $this->global['pageTitle'] = 'AOA : Exam Category';
                $data['title'] = 'Category';
                $data['routeName'] = 'examcategory/new';
                $productType = 'exam_category';
                $data['route'] = 'exam_category';
                $data['editRoute'] = 'examcategory/edit/';
                $joinTblName = "";
            }

            if($word == "category"){
                $this->global['pageTitle'] = 'AOA : Category';
                $data['title'] = 'Category';
                $data['routeName'] = 'category/new';
                $productType = 'category';
                $data['route'] = 'category';
                $data['editRoute'] = 'category/edit/';
                $joinTblName = "";
            }
            if($word == "subcategory"){
                $this->global['pageTitle'] = 'AOA : SubCategory';
                $data['title'] = 'SubCategory';
                $data['routeName'] = 'subcategory/new';
                $productType = 'subcategory';
                $data['route'] = 'subcategory';
                $data['editRoute'] = 'subcategory/edit/';
                $joinTblName = "category";
            }

            $searchTexts = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchTexts;
            $this->load->library('pagination');
            $count = $this->picklist_model->ListingCount($searchTexts, $productType, $joinTblName);
            $returns = $this->paginationCompress($productType."/", $count, 10 );
            $data['Records'] = $this->picklist_model->Listing($searchTexts, $productType, $joinTblName, $returns["page"], $returns["segment"]);
            
            $this->loadViews("category/category", $this->global, $data, NULL);
        }
    }

    function edit($Id = NULL){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $uri_path = parse_url(current_url(), PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $i = sizeof($uri_segments) - 3;
            if($uri_segments[$i] == "category"){
                $this->global['pageTitle'] = 'AOA : Edit Category';
                $data['routeName'] = 'category/edit';
                $data['redirect'] = 'category';
                $tblName = 'category';
            }
            if($uri_segments[4] == "subcategory"){
                $this->global['pageTitle'] = 'AOA : Edit Sub Category';
                $data['routeName'] = 'subcategory/edit';
                $data['redirect'] = 'subcategory';
                $tblName = 'subcategory';
                $data['Category'] = $this->common_model->getAllData("category",'All',null);
            }
            if($uri_segments[4] == "examcategory"){
                $this->global['pageTitle'] = 'AOA : Edit Exam Category';
                $data['routeName'] = 'examcategory/edit';
                $data['redirect'] = 'examcategory';
                $tblName = 'exam_category';
            }
            if($uri_segments[4] == "examsubcategory"){
                $this->global['pageTitle'] = 'AOA : Edit SubCategory';
                $data['routeName'] = 'examsubcategory/edit';
                $data['redirect'] = 'examsubcategory';
                $tblName = 'exam_subcategory';
                $data['Category'] = $this->common_model->getAllData("exam_category",'All',null);
            }

            if($Id == null){
                redirect($data['redirect']);
            }

            $data['Info'] = $this->common_model->getAllData($tblName,'All',"active=1, id=$Id");

            if(empty($data['Info'])){
                redirect($data['redirect']);
            }
            $this->loadViews("category/editOld", $this->global, $data, NULL);
        }
    }

    function update(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $Id = $this->security->xss_clean($this->input->post('Id'));
            $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
            $uri_path = parse_url(current_url(), PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $i = sizeof($uri_segments)-2;

            if ($uri_segments[$i] == 'category'){
                $data['routeName'] = 'category/edit/';
                $redirect = 'category';
                $tblName = 'category';
            } 
            if ($uri_segments[$i] == 'subcategory'){
                $data['routeName'] = 'subcategory/edit/';
                $redirect = 'subcategory';
                $tblName = 'subcategory';
                $this->form_validation->set_rules('catname','Category Name','trim|required|numeric');
            }
            if ($uri_segments[$i] == 'examcategory'){
                $data['routeName'] = 'examcategory/edit/';
                $redirect = 'examcategory';
                $tblName = 'exam_category';
            } 
            if ($uri_segments[$i] == 'examsubcategory'){
                $data['routeName'] = 'examsubcategory/edit/';
                $redirect = 'examsubcategory';
                $tblName = 'exam_subcategory';
                $this->form_validation->set_rules('catname','Category Name','trim|required|numeric');
            }

            if( empty($Id) || $Id == NULL ){
                redirect($redirect);
            }

            if($this->form_validation->run() == FALSE){
                $this->edit($Id);
            }else{
                
                $name = strtolower($this->security->xss_clean($this->input->post('name')));
                $catnameId = $this->security->xss_clean($this->input->post('catname'));
                $status = $this->security->xss_clean($this->input->post('status'));

                $Info = array(
                    'created_by'=> $this->vendorId,
                    'name'=>$name,
                    'active'=>$status,
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                if($redirect == "subcategory" || $redirect == "examsubcategory"){
                    $Info['category_id'] = $catnameId;
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

    function new(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            $uri_path = parse_url(current_url(), PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $i = sizeof($uri_segments)-2;
            
            if ($uri_segments[$i]=="category"){
                $this->global['pageTitle'] = 'AOA : Add Category';
                $data['routeName'] = 'category/new/addNew';
                $data['redirect'] = 'category';
            }
            if ($uri_segments[$i]=="subcategory"){
                $this->global['pageTitle'] = 'AOA : Add Sub Category';
                $data['routeName'] = 'subcategory/new/addNew';
                $data['redirect'] = 'subcategory';
                $data['Category'] = $this->common_model->getAllData("category",'All',null);
            }
            if ($uri_segments[$i]=="examcategory"){
                $this->global['pageTitle'] = 'AOA : Add Exam Category';
                $data['routeName'] = 'examcategory/new/addNew';
                $data['redirect'] = 'examcategory';
            }
            if ($uri_segments[$i]=="examsubcategory"){
                $this->global['pageTitle'] = 'AOA : Add Exam SubCategory';
                $data['routeName'] = 'examsubcategory/new/addNew';
                $data['redirect'] = 'examsubcategory';
                $data['Category'] = $this->common_model->getAllData("exam_category",'All',null);
            }
            $this->loadViews("category/add", $this->global, $data, NULL);
        }
    }

    function addNew(){
        if($this->isAdmin() == TRUE && $this->isInstitute() == TRUE){
            $this->loadThis();
        } else {
            
            $this->form_validation->set_rules('name','Name','trim|required|max_length[128]');
            $uri_path = parse_url(current_url(), PHP_URL_PATH);
            $uri_segments = explode('/', $uri_path);
            $i = sizeof($uri_segments)-3;
            
            if ($uri_segments[$i]=="category"){
                $data['routeName'] = 'category/new';
                $redirect = 'category';
                $tblName = 'category';
            } 
            if ($uri_segments[$i]=="subcategory"){
                $data['routeName'] = 'subcategory/new';
                $redirect = 'subcategory';
                $tblName = 'subcategory';
                $this->form_validation->set_rules('catname','Category Name','trim|required|numeric');
            }
            if ($uri_segments[$i]=="examcategory"){
                $data['routeName'] = 'examcategory/new';
                $redirect = 'examcategory';
                $tblName = 'exam_category';
            } 
            if ($uri_segments[$i]=="examsubcategory"){
                $data['routeName'] = 'examsubcategory/new';
                $redirect = 'examsubcategory';
                $tblName = 'exam_subcategory';
                $this->form_validation->set_rules('catname','Category Name','trim|required|numeric');
            }

            if($this->form_validation->run() == FALSE){
                $this->new();
            }else{
                $name = strtolower($this->security->xss_clean($this->input->post('name')));
                $catnameId = $this->security->xss_clean($this->input->post('catname'));
                $status = $this->security->xss_clean($this->input->post('status'));

                $Info = array(
                    'created_by'=> $this->vendorId,
                    'name'=>$name,
                    'active'=>$status,
                    'created_at'=>date('Y-m-d H:i:s')
                );

                if($redirect == "subcategory" || $redirect == "examsubcategory"){
                    $Info['category_id'] = $catnameId;
                }

                $result = $this->common_model->addInfo($tblName,$Info);
                if($result == true){
                    $this->session->set_flashdata('success', "Record Created successfully");
                }else{
                    $this->session->set_flashdata('error', 'Creation failed');
                }
                redirect($data['routeName']);
            }
        }
    }

    function getSubCatById($subCatId){
        $result =$this->common_model->getAllData('exam_subcategory', null, "category_id=$subCatId");
        echo json_encode($result);
    }

}