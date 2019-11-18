<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Picklist_model extends CI_Model
{
    function ListingCount($searchText = '', $tblName, $joinTblName = ''){
        $type = "";
        if(strtolower($searchText) === "inactive"){
            $searchTexts = '0';
            $type = 'active';
        }
        if(strtolower($searchText) === "active"){
            $searchTexts = '1';
            $type = 'inactive';
        }
        if(!empty($joinTblName)){
            $this->db->select("BaseTbl.id, BaseTbl.name,Category.name as catName, BaseTbl.category_id, BaseTbl.active, BaseTbl.created_at");
            $this->db->from($tblName.' as BaseTbl');
            $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
            if(!empty($searchText) && empty($type)) {
                $likeCriteria = "(
                                    BaseTbl.name LIKE '%".$searchText."%'
                                    OR Category.name LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            } else if(!empty($type)){
                $this->db->where("BaseTbl.active",$searchTexts);
            }
        }else{
            $this->db->select("BaseTbl.id, BaseTbl.name, BaseTbl.active, BaseTbl.created_at");
            $this->db->from($tblName.' as BaseTbl');
            if(!empty($searchText) && empty($type)) {
                $likeCriteria = "(
                                    BaseTbl.name LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            }else if(!empty($type)){
                $this->db->where("BaseTbl.active",$searchTexts);
            }
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    function Listing($searchText = '', $tblName, $joinTblName = '', $page, $segment){
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

        if(!empty($joinTblName)){
            $this->db->select("BaseTbl.id, BaseTbl.name,Category.name as catName, BaseTbl.category_id, BaseTbl.active, BaseTbl.created_at");
            $this->db->from($tblName.' as BaseTbl');
            $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
            if(!empty($searchText) && empty($type)) {
                $likeCriteria = "(
                                    BaseTbl.name LIKE '%".$searchText."%'
                                    OR Category.name LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            } else if(!empty($type)){
                $this->db->where("BaseTbl.active",$searchTexts);
            }
        }else{
            $this->db->select("BaseTbl.id, BaseTbl.name, BaseTbl.active, BaseTbl.created_at");
            $this->db->from($tblName.' as BaseTbl');
            if(!empty($searchText) && empty($type)) {
                $likeCriteria = "(
                                    BaseTbl.name LIKE '%".$searchText."%'
                                )";
                $this->db->where($likeCriteria);
            }else if(!empty($type)){
                $this->db->where("BaseTbl.active",$searchTexts);
            }
        }
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
}