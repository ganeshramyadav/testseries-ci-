<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Exam_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->userId = $this->session->userdata('userId');
        $this->instId = $this->session->userdata('instId');
    }
    
    function ListingCount($searchText = '', $tblName){
        $type = "";
        if(strtolower($searchText) === "inactive"){
            $searchTexts = '0';
            $type = 'active';
        }
        if(strtolower($searchText) === "active"){
            $searchTexts = '1';
            $type = 'inactive';
        }
        $this->db->select("BaseTbl.*");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('exam_category as Category', 'Category.id = BaseTbl.category_id','left');
        $this->db->join('exam_subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        if(!empty($searchText) && empty($type)) {
            $likeCriteria = "(
                                BaseTbl.title LIKE '%".$searchText."%'
                                OR BaseTbl.year LIKE '%".$searchText."%'
                                OR Category.name LIKE '%".$searchText."%'
                                OR Subcategory.name LIKE '%".$searchText."%'
                                OR BaseTbl.duration LIKE '%".$searchText."%'
                                OR BaseTbl.no_of_question LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        } else if(!empty($type)){
            $this->db->where("BaseTbl.active",$searchTexts);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function Listing($searchText = '', $tblName, $page, $segment){
        // return $tblName.$joinTblName;
        $type = "";
        if(strtolower($searchText) === "inactive"){
            $searchTexts = '0';
            $type = 'active';
        }
        if(strtolower($searchText) === "active"){
            $searchTexts = '1';
            $type = 'inactive';
        }

        $this->db->select("Category.name as catName, Subcategory.name as subName, Institute.name, BaseTbl.*, IF(BaseTbl.active, 'Active', 'InActive') as active");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('exam_category as Category', 'Category.id = BaseTbl.category_id','left');
        $this->db->join('exam_subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        if(!empty($searchText) && empty($type)) {
            $likeCriteria = "(
                                BaseTbl.title LIKE '%".$searchText."%'
                                OR BaseTbl.year LIKE '%".$searchText."%'
                                OR Category.name LIKE '%".$searchText."%'
                                OR Subcategory.name LIKE '%".$searchText."%'
                                OR BaseTbl.duration LIKE '%".$searchText."%'
                                OR BaseTbl.no_of_question LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        } else if(!empty($type)){
            $this->db->where("BaseTbl.active",$searchTexts);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function examquestionListingCount($searchText = '', $tblName, $where=NULL){
        $type = "";
        if(strtolower($searchText) === "inactive"){
            $searchTexts = '0';
            $type = 'active';
        }
        if(strtolower($searchText) === "active"){
            $searchTexts = '1';
            $type = 'inactive';
        }
        $this->db->select("Questions.question,Category.name as CatName, Subcategory.name as SubName, BaseTbl.*");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('questions as Questions', 'Questions.id = BaseTbl.question_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = Questions.sub_category_id','left');
        $this->db->join('category as Category', 'Category.id = Questions.category_id','left');
        // $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        if(!empty($searchText) && empty($type)) {
            /* $likeCriteria = "(
                                BaseTbl.title LIKE '%".$searchText."%'
                                OR BaseTbl.year LIKE '%".$searchText."%'
                                OR Category.name LIKE '%".$searchText."%'
                                OR Subcategory.name LIKE '%".$searchText."%'
                            )"; */
            // $this->db->where($likeCriteria);
        } else if(!empty($type)){
            $this->db->where("BaseTbl.active",$searchTexts);
        }

        if(!empty($where)){
            // $whereResult = explode(",", $where );
            // return $whereResult[1];
            // foreach($whereResult as $whereKey){
                // echo $av = "BaseTbl.$whereKey";
                $this->db->where("BaseTbl.$where");
            // }
            // return $av;
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function examquestionListing($searchText = '', $tblName, $where=NULL, $page, $segment){
        $type = "";
        if(strtolower($searchText) === "inactive"){
            $searchTexts = '0';
            $type = 'active';
        }
        if(strtolower($searchText) === "active"){
            $searchTexts = '1';
            $type = 'inactive';
        }
        $this->db->select("Questions.question,Category.name as catName, Subcategory.name as subName, BaseTbl.*, IF(BaseTbl.active, 'Active', 'InActive') as active");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('questions as Questions', 'Questions.id = BaseTbl.question_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = Questions.sub_category_id','left');
        $this->db->join('category as Category', 'Category.id = Questions.category_id','left');
        if(!empty($searchText) && empty($type)) {
            /* $likeCriteria = "(
                                BaseTbl.title LIKE '%".$searchText."%'
                                OR BaseTbl.year LIKE '%".$searchText."%'
                                OR Category.name LIKE '%".$searchText."%'
                                OR Subcategory.name LIKE '%".$searchText."%'
                            )"; */
            // $this->db->where($likeCriteria);
        } else if(!empty($type)){
            $this->db->where("BaseTbl.active",$searchTexts);
        }
        
        if(!empty($where)){
            $this->db->where("BaseTbl.$where");
        }

        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function questionListCount($searchText = '', $tblName, $category = null, $subcategory = null, $where=NULL){
        $this->db->select("BaseTbl.id");
        $this->db->from($tblName.' as BaseTbl');
        if($tblName == "exam"){
            $this->db->join('exam_subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
            $this->db->join('exam_category as Category', 'Category.id = BaseTbl.category_id','left');
            if(!empty($searchText)) {
                $likeCriteria = "(
                                    BaseTbl.title LIKE '%".$searchText."%'
                                    OR Category.name LIKE '%".$searchText."%'
                                    OR Subcategory.name LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            }
            $this->db->where('BaseTbl.active', 1);
            if(isset($this->instId)){
                if(!empty($this->instId)){
                    $this->db->where('BaseTbl.institute_id', $this->instId);
                }
            }
        }else{
            $this->db->join('subcategory as Subcategory', 'Subcategory.id = BaseTbl.sub_category_id','left');
            $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
            if(!empty($searchText)) {
                $likeCriteria = "(
                                    BaseTbl.question LIKE '%".$searchText."%'
                                    OR Category.name LIKE '%".$searchText."%'
                                    OR Subcategory.name LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            }
        }
        
        if(!empty($category)){
            $this->db->where('Category.id',$category);
        }
        if(!empty($subcategory)){
            $this->db->where('Subcategory.id',$subcategory);
        }
        if(!empty($where)){
            $this->db->where_not_in('BaseTbl.id', $where);
        }
        $this->db->where('BaseTbl.created_by',$this->userId);
        $query = $this->db->get();
        return $query->num_rows();
        // $result = $query->result();
        // return $result;
    }

    public function questionList($searchText = '', $tblName, $category = null, $subcategory = null, $where=NULL, $page, $segment){
        $this->db->select("Category.name as catName, Subcategory.name as subName, BaseTbl.id, BaseTbl.*");
        $this->db->from($tblName.' as BaseTbl');
        if($tblName == "exam"){
            $this->db->join('exam_subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
            $this->db->join('exam_category as Category', 'Category.id = BaseTbl.category_id','left');
            if(!empty($searchText)) {
                $likeCriteria = "(
                                    BaseTbl.title LIKE '%".$searchText."%'
                                    OR Category.name LIKE '%".$searchText."%'
                                    OR Subcategory.name LIKE '%".$searchText."%'
                                    OR BaseTbl.year LIKE '%".$searchText."%'
                                    OR BaseTbl.no_of_question LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            }
            $this->db->where('BaseTbl.active', 1);
            if(isset($this->instId)){
                if(!empty($this->instId)){
                    $this->db->where('BaseTbl.institute_id', $this->instId);
                }
            }
        }else{
            $this->db->join('subcategory as Subcategory', 'Subcategory.id = BaseTbl.sub_category_id','left');
            $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
            if(!empty($searchText)) {
                $likeCriteria = "(
                                    BaseTbl.question LIKE '%".$searchText."%'
                                    OR Category.name LIKE '%".$searchText."%'
                                    OR Subcategory.name LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            }
        }

        
        if(!empty($category)){
            $this->db->where('Category.id',$category);
        }
        if(!empty($subcategory)){
            $this->db->where('Subcategory.id',$subcategory);
        }
        if(!empty($where)){
            $this->db->where_not_in('BaseTbl.id', $where);
        }
        $this->db->where('BaseTbl.created_by',$this->userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function delete($tblName, $where){
        foreach($where as $key=>$val){
            $this->db->where("$key", $val);
        }
        $this->db->delete($tblName);
        return $this->db->affected_rows();
    }

    function testseriesListingCount($searchText = '', $tblName){
        $type = "";
        if(strtolower($searchText) === "false"){
            $searchTexts = '0';
            $type = 'False';
        }
        if(strtolower($searchText) === "true"){
            $searchTexts = '1';
            $type = 'True';
        }
        $this->db->select("BaseTbl.*, IF(BaseTbl.isPublic, 'True', 'False') as isPublic, Institute.name");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        if(!empty($searchText) && empty($type)) {
            $likeCriteria = "(
                                BaseTbl.Name LIKE '%".$searchText."%'
                                OR BaseTbl.price LIKE '%".$searchText."%'
                                OR BaseTbl.no_of_exam LIKE '%".$searchText."%'
                                OR Institute.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        } else if(!empty($type)){
            $this->db->where("BaseTbl.isPublic",$searchTexts);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function testseriesListing($searchText = '', $tblName, $page, $segment){
        $type = "";
        if(strtolower($searchText) === "false"){
            $searchTexts = '0';
            $type = 'False';
        }
        if(strtolower($searchText) === "true"){
            $searchTexts = '1';
            $type = 'True';
        }
        $this->db->select("BaseTbl.*, IF(BaseTbl.isPublic, 'True', 'False') as isPublic, Institute.name");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        if(!empty($searchText) && empty($type)) {
            $likeCriteria = "(
                                BaseTbl.Name LIKE '%".$searchText."%'
                                OR BaseTbl.isPublic LIKE '%".$searchText."%'
                                OR BaseTbl.price LIKE '%".$searchText."%'
                                OR BaseTbl.no_of_exam LIKE '%".$searchText."%'
                                OR Institute.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        } else if(!empty($type)){
            $this->db->where("BaseTbl.isPublic",$searchTexts);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function testexamListingCount($searchText = '', $tblName, $where=null){
        $this->db->select("BaseTbl.*, Exam.*, BaseTbl.id as seriesId, Category.name as CategoryName, SubCategory.name as SubcategoryName");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('exam as Exam', 'Exam.id = BaseTbl.exam_id','left');
        $this->db->join('exam_category as Category', 'Category.id = Exam.category_id','left');
        $this->db->join('exam_subcategory as SubCategory', 'SubCategory.id = Exam.subcategory_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(
                                Exam.Name title '%".$searchText."%'
                                OR Exam.year LIKE '%".$searchText."%'
                                OR Category.name LIKE '%".$searchText."%'
                                OR SubCategory.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        } 
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function testexamListing($searchText = '', $tblName, $where=null, $page, $segment){
        $this->db->select("BaseTbl.*, Exam.*, BaseTbl.id as seriesId, Category.name as CategoryName, SubCategory.name as SubcategoryName");
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('exam as Exam', 'Exam.id = BaseTbl.exam_id','left');
        $this->db->join('exam_category as Category', 'Category.id = Exam.category_id','left');
        $this->db->join('exam_subcategory as SubCategory', 'SubCategory.id = Exam.subcategory_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(
                                Exam.Name title '%".$searchText."%'
                                OR Exam.year LIKE '%".$searchText."%'
                                OR Category.name LIKE '%".$searchText."%'
                                OR SubCategory.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

}