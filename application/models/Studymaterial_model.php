<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Studymaterial_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

    function ListingCount($searchText = '', $institute=null, $year=null, $category=null, $subcategory=null)
    {
        $this->db->select(
            'BaseTbl.name, BaseTbl.url, BaseTbl.isPublic, BaseTbl.price, 
             BaseTbl.active, BaseTbl.year, BaseTbl.created_at, BaseTbl.id,
             Category.name As CatName, Subcategory.name As SubcatName, Institute.name As InstName');

        $this->db->from('product as BaseTbl');
        $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        
        if(!empty($searchText)) {
            $likeCriteria = "(
                            BaseTbl.name LIKE '%".$searchText."%'
                            OR BaseTbl.year LIKE '%".$searchText."%'
                            OR BaseTbl.price LIKE '%".$searchText."%'
                            OR BaseTbl.active LIKE '%".$searchText."%'
                            OR BaseTbl.isPublic LIKE '%".$searchText."%'
                            OR Subcategory.name LIKE '%".$searchText."%'
                            OR Category.name  LIKE '%".$searchText."%'
                            OR Institute.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        if(!empty($institute)){
            $this->db->where('BaseTbl.institute_id', $institute);
        }
        if(!empty($year)){
            $this->db->where('BaseTbl.year', $year);
        }
        if(!empty($category)){
            $this->db->where('BaseTbl.category_id', $category);
        }
        if(!empty($subcategory)){
            $this->db->where('BaseTbl.subcategory_id', $subcategory);
        }
        // $this->db->where('Category.active', 1);
        // $this->db->where('Subcategory.active', 1);
        // $this->db->where('Institute.status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function Listing($searchText = '', $institute=null, $year=null, $category=null, $subcategory=null, $page, $segment)
    {
        $this->db->select(
            'BaseTbl.name, BaseTbl.url, BaseTbl.isPublic, BaseTbl.price, 
             BaseTbl.active, BaseTbl.year, BaseTbl.created_at, BaseTbl.id,
             Category.name As CatName, Subcategory.name As SubcatName, Institute.name As InstName');
        
        $this->db->from('product as BaseTbl');
        $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(
                            BaseTbl.name LIKE '%".$searchText."%'
                            OR BaseTbl.year LIKE '%".$searchText."%'
                            OR BaseTbl.price LIKE '%".$searchText."%'
                            OR BaseTbl.active LIKE '%".$searchText."%'
                            OR BaseTbl.isPublic LIKE '%".$searchText."%'
                            OR Subcategory.name LIKE '%".$searchText."%'
                            OR Category.name  LIKE '%".$searchText."%'
                            OR Institute.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }

        if(!empty($institute)){
            $this->db->where('BaseTbl.institute_id', $institute);
        }
        if(!empty($year)){
            $this->db->where('BaseTbl.year', $year);
        }
        if(!empty($category)){
            $this->db->where('BaseTbl.category_id', $category);
        }
        if(!empty($subcategory)){
            $this->db->where('BaseTbl.subcategory_id', $subcategory);
        }

        /* $this->db->where('Category.active', 1);
        $this->db->where('Subcategory.active', 1);
        $this->db->where('Institute.status', 1); */
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    
    function smListingCount($searchText = '')
    {
        $this->db->select(
            'BaseTbl.*, Category.name As CatName, Subcategory.name As SubcatName, Institute.name As InstName');
        
        $this->db->from('product as BaseTbl');
        $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(
                            BaseTbl.name LIKE '%".$searchText."%'
                            BaseTbl.year LIKE '%".$searchText."%'
                            BaseTbl.price LIKE '%".$searchText."%'
                            BaseTbl.active LIKE '%".$searchText."%'
                            BaseTbl.isPublic LIKE '%".$searchText."%'
                            OR  SubcatName LIKE '%".$searchText."%'
                            OR  CatName LIKE '%".$searchText."%'
                            OR  InstName LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        $this->db->where('Category.active', 1);
        $this->db->where('Subcategory.active', 1);
        $this->db->where('Institute.active', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function smListing($searchText = '')
    {
        $this->db->select('BaseTbl.id, BaseTbl.user_id, BaseTbl.institut_id, BaseTbl.name, User.name as UserName, Institute.inst_name as InstituteName, BaseTbl.category, BaseTbl.subject, BaseTbl.url, BaseTbl.status, BaseTbl.created_at, BaseTbl.updated_at');
        $this->db->from('study_material as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.user_id','left');
        $this->db->join('tbl_institute as Institute', 'Institute.id = BaseTbl.institut_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(
                            BaseTbl.subject  LIKE '%".$searchText."%'
                            BaseTbl.category  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  User.name  LIKE '%".$searchText."%'
                            OR  Institute.inst_name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function addInfo($tblName, $Info)
    {
        $this->db->trans_start();
        $this->db->insert($tblName, $Info);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function editInfo($tblName, $infoId, $Info)
    {
        $this->db->where('id', $infoId);
        $this->db->update($tblName, $Info);

        return $this->db->affected_rows();
        // return TRUE;
    }

    function getSmInfoById($Id){
        $this->db->select('BaseTbl.*, User.name as Uname, Institute.inst_name');
        $this->db->from('study_material as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.user_id','left');
        $this->db->join('tbl_institute as Institute', 'Institute.id = BaseTbl.institut_id','left');
        $this->db->where('BaseTbl.id', $Id);
        $query = $this->db->get();
        return $query->row();
    }

    function getAllInstUsers(){
        $this->db->select('userId, name');
        $this->db->from('tbl_users');
        $this->db->where('roleId !=', 3);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getAllInstitutes(){
        $this->db->select('id, inst_name');
        $this->db->from('tbl_institute');
        // $this->db->where('status', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
}