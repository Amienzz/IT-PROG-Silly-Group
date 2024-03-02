<?php
include 'back_Database.php';
?>

<?php
class Dish extends DatabaseConn{
    
    public function add_dish($dish_name, $dish_price, $category, $resto_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO dish (dish_name, dish_price, dish_category, resto_id) VALUES(?,?,?,?)");
        $stmt->bind_param('sisi', $dish_name, $dish_price, $category, $resto_id);
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
    public function modify_dish($dish_id, $dish_price, $dish_name){
        $stmt = $this->conn->prepare("UPDATE dish SET dish_name = ?, dish_price = ? WHERE dish_id = ?");
        $stmt->bind_param("sii", $dish_name, $dish_price, $dish_id);
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
        $stmt->bind_param("i", $dish_id);
        $stmt->execute();
        
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
        $stmt = $this->conn->prepare("SELECT * FROM dish WHERE dish_category = ?");
        $stmt->bind_param("s", $dish_category);
        $stmt->execute();
        $result = $stmt->get_result();
        $all_data = array();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }

        return $all_data;      
    }

    public function get_dish_list_given_user_id($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish WHERE resto_id = (SELECT resto_id FROM resto WHERE user_id = ?)");
        $stmt->bind_param("i", $user_id);
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