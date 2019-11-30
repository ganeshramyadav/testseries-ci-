<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model
{
    function ListingCount($searchText = '', $institute=null, $year=null, $category=null, $subcategory=null, $productType)
    {
        $this->db->select(
            'BaseTbl.name, BaseTbl.url, BaseTbl.isPublic, BaseTbl.price, 
             BaseTbl.active, BaseTbl.year, BaseTbl.created_at, BaseTbl.id, BaseTbl.url, Favorite.id as favId,
             Category.name As CatName, Subcategory.name As SubcatName, Institute.name As InstName');

        $this->db->from('product as BaseTbl');
        $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        $this->db->join('favorite as Favorite','Favorite.product_id = BaseTbl.id','left');
        
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
        $this->db->where("BaseTbl.$productType",1);
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

    function Listing($searchText = '', $institute=null, $year=null, $category=null, $subcategory=null, $productType, $page, $segment)
    {
        $this->db->select(
            "BaseTbl.name, BaseTbl.url, BaseTbl.isPublic, BaseTbl.price, BaseTbl.url, BaseTbl.image_url, BaseTbl.description,
             BaseTbl.active, BaseTbl.year, BaseTbl.created_at, BaseTbl.id, Favorite.id as favId,
             Category.name As CatName, Subcategory.name As SubcatName, Institute.name As InstName");
        
        $this->db->from('product as BaseTbl');
        $this->db->join('category as Category', 'Category.id = BaseTbl.category_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = BaseTbl.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        $this->db->join('favorite as Favorite','Favorite.product_id = BaseTbl.id','left');
        $this->db->order_by('BaseTbl.created_at', 'DESC');
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

        $this->db->where("BaseTbl.$productType",1);

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
        $this->db->limit($page, $segment);

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function cartListingCountCustom($searchText = '', $tblName, $userId)
    {
        $this->db->select(
            'BaseTbl.created_at, BaseTbl.id, Product.name as Pname, Product.price, Product.url,
            Category.name as CatName, Subcategory.name as SubcatName, Institute.name as InstName, Product.year');

        // $this->db->from('shopping_cart as BaseTbl');
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('user as User', 'User.id = BaseTbl.User_id','left');
        $this->db->join('product as Product', 'Product.id = BaseTbl.product_id','left');
        $this->db->join('category as Category', 'Category.id = Product.category_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = Product.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = Product.institute_id','left');
        
        if(!empty($searchText)) {
            $likeCriteria = "(
                            Product.name LIKE '%".$searchText."%'
                            OR Product.year LIKE '%".$searchText."%'
                            OR Product.price LIKE '%".$searchText."%'
                            OR Product.active LIKE '%".$searchText."%'
                            OR Subcategory.name LIKE '%".$searchText."%'
                            OR Category.name LIKE '%".$searchText."%'
                            OR Institute.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        // if($userId != 1){
            $this->db->where("BaseTbl.user_id",$userId);
        // }
        
        $this->db->where("Product.active",1);
        $this->db->where("User.active",1);

        // $this->db->where('Category.active', 1);
        // $this->db->where('Subcategory.active', 1);
        // $this->db->where('Institute.status', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function cartListingCustom($searchText = '', $tblName, $userId, $page, $segment)
    {
        $this->db->select(
            'BaseTbl.name, BaseTbl.created_at, BaseTbl.id, Product.name as Pname, Product.price, Product.url, Product.image_url,
             Product.study_material, Product.video, Product.current_affairs, Product.isPublic, BaseTbl.product_id, Favorite.id as FavId,
             Category.name as CatName, Subcategory.name as SubcatName, Institute.name as InstName, Product.year');

        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('user as User', 'User.id = BaseTbl.User_id','left');
        $this->db->join('product as Product', 'Product.id = BaseTbl.product_id','left');
        $this->db->join('category as Category', 'Category.id = Product.category_id','left');
        $this->db->join('subcategory as Subcategory', 'Subcategory.id = Product.subcategory_id','left');
        $this->db->join('institute as Institute', 'Institute.id = Product.institute_id','left');
        $this->db->join('favorite as Favorite','Favorite.product_id = BaseTbl.id','left');
        $this->db->order_by('BaseTbl.created_at', 'DESC');
        if(!empty($searchText)) {
            $likeCriteria = "(
                            Product.name LIKE '%".$searchText."%'
                            OR Product.year LIKE '%".$searchText."%'
                            OR Product.price LIKE '%".$searchText."%'
                            OR Product.active LIKE '%".$searchText."%'
                            OR Subcategory.name LIKE '%".$searchText."%'
                            OR Category.name LIKE '%".$searchText."%'
                            OR Institute.name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        // if($userId != 1){
            $this->db->where("BaseTbl.user_id",$userId);
        // }
        
        $this->db->where("Product.active",1);
        $this->db->where("User.active",1);
        
        $this->db->limit($page, $segment);

        $query = $this->db->get();

        $result = $query->result();
        return $result;

    }

    function cartPrice($userId){
        $this->db->select("SUM(Product.`price`) AS total_amount");
        $this->db->from('shopping_cart as BaseTbl');
        $this->db->join('product as Product', 'Product.id = BaseTbl.product_id','left');
        $this->db->where("BaseTbl.user_id",$userId);

        $this->db->where("Product.active",1);
        $query = $this->db->get();
        return $query->row();
    }

    function cartItems($userId){
        $this->db->select("Product.id as product_id, Product.institute_id, Product.price");
        $this->db->from('shopping_cart as BaseTbl');
        $this->db->join('product as Product', 'Product.id = BaseTbl.product_id','left');
        $this->db->where("BaseTbl.user_id",$userId);
        $this->db->where("Product.active",1);
        $query = $this->db->get();
        return $query->result();
    }

    function getItemsByOrderId($orderId){
        $this->db->select("BaseTbl.id as orderItems_id, BaseTbl.price as orderItems_price, Institute.name as instituteName, Product.*");
        $this->db->from('order_items as BaseTbl');
        $this->db->join('product as Product', 'Product.id = BaseTbl.product_id','left');
        $this->db->join('institute as Institute', 'Institute.id = BaseTbl.institute_id','left');
        $this->db->where("BaseTbl.order_id",$orderId);
        // $this->db->where("Product.active",1);
        $query = $this->db->get();
        return $query->result();
    }






    function getAllData($tblName, $select = null, $where = null, $count = null){
        if($select == 'All'){
            $this->db->select('*');
        } else if($select == ''){
            $this->db->select('id, name');
        } else if($select){
            $this->db->select("$select");
        }
        $this->db->from($tblName);
        if($where){
            $whereResult = explode( ",", $where );
            foreach($whereResult as $whereKey){
                $this->db->where($whereKey);
            }
        }
        $query = $this->db->get();
        if($count){
            return $query->num_rows();
        }
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return $query->result();
        }
    }

    function deleteDataFromTbl($tblName, $where){
        if($where){
            $whereResult = explode( ",", $where );
            foreach($whereResult as $whereKey){
                $this->db->where($whereKey);
            }
        }
        $this->db->delete($tblName);
        return $this->db->affected_rows();
    }

    function editInfo($tblName, $infoId, $Info){
        $this->db->where('id', $infoId);
        $this->db->update($tblName, $Info);

        return $this->db->affected_rows();
        // return TRUE;
    }

    function addInfo($tblName, $Info)
    {
        try {
            $this->db->trans_start(FALSE);
            $this->db->insert($tblName, $Info);
            $insert_id = $this->db->insert_id();
            $this->db->trans_complete();

            // return $db_error = $this->db->error();

            /* $db_error = $this->db->error();
            if (!empty($db_error)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false; // unreachable retrun statement !!!
            } */
            return $insert_id;
        } catch (Exception $e){
            // this will not catch DB related errors. But it will include them, because this is more general. 
            log_message('error: ',$e->getMessage());
            return (['error_msg'=>$e->getMessage(),'error_code'=>$e->getCode()]);
        }
    }

    function delete($tblName, $Id){
        $this->db->where('id', $Id);
        $this->db->delete($tblName);
        return $this->db->affected_rows();
    }

    function getYearFromProduct($where = NULL){
        $this->db->distinct('year');
        $this->db->select('year');
        $this->db->from('product');
        if($where){
            $whereResult = explode( ",", $where );
            foreach($whereResult as $whereKey){
                $this->db->where($whereKey);
            }
        }
        // $this->db->where('active', 1);
        $query = $this->db->get();
        return $query->result();
    }

    function checkRecordFromTable($tblName, $where=null){

        try {
            $this->db->select('id');
            $this->db->from($tblName);
            if($where){
                $whereResult = explode( ",", $where );
                foreach($whereResult as $whereKey){
                    $this->db->where($whereKey);
                }
            }

            /* $db_error = $this->db->error();
            // $db_code = $this->db->_error_number();
            if (!empty($db_error)) {
                throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
                return false; // unreachable retrun statement !!!
            } */
            $query = $this->db->get();
            return $query->num_rows();
        } catch (Exception $e){
            // this will not catch DB related errors. But it will include them, because this is more general. 
            // log_message('error: ',$e->getMessage());
            return (['error_msg'=>$e->getMessage(),'error_code'=>$e->getCode()]);
        }


        /* $this->db->select('id');
        $this->db->from($tblName);
        if($where){
            $whereResult = explode( ",", $where );
            foreach($whereResult as $whereKey){
                $this->db->where($whereKey);
            }
        }
        $query = $this->db->get();
        return $query->num_rows(); */
    }
}