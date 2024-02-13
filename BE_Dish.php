<?php
class Dish extends DatabaseConn{
    
    public function add_dish($dish_name, $dish_price, $category, $dish_restaurant)
    {
        $stmt = $this->conn->prepare("INSERT INTO dish (dish_name, dish_price, dish_category, dish_restaurant) VALUES(?,?,?,?)");
        $stmt->bind_param('siss', $dish_name, $dish_price, $category, $dish_restaurant);
        $stmt->execute();

        return 100;
    }
    public function remove_dish($dish_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM dish_review WHERE dish_id = ?");
        $stmt->bind_param("s", $dish_id);
        $stmt->execute();


        $stmt2 = $this->conn->prepare("DELETE FROM dish WHERE dish_id = ?"); 
        $stmt2->bind_param("s", $dish_id);
        $stmt2->execute();

        return 100;

    }
    public function update_dish($dish_id, $dish_price, $dish_name){
        $stmt = $this->conn->prepare("UPDATE dish SET dish_name = ?, dish_category = ? WHERE dish_id = ?");
        $stmt->bind_param("isi", $dish_name, $dish_category, $dish_id);
        $stmt->execute();

        return 100;
    }
    public function get_dish_list()
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish");
        $stmt->execute();
        $result = $stmt->get_result();
        $all_data = array();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }

        return $all_data;

    }

    public function get_dish_list_given_id($dish_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish WHERE dish_id = ?");
        $stmt->execute();
        $stmt->bind_param("i", $dish_id);
        $result = $stmt->get_result();
        $single_data = array();

        if($result->num_rows > 0)
        {
            $single_data = $result->fetch_assoc();
        }
        return $single_data;        
    }
    public function get_dish_list_given_dish_category($dish_category)
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish WHERE dish-category = ?");
        $stmt->bind_param("i", $dish_category);
        $stmt->execute();
        $result = $stmt->get_result();
        $all_data = array();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }

        return $all_data;      
    }

}








?>