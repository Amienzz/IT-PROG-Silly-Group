<?php
include 'back_Database.php';
?>

<?php
class Dish_Review extends DatabaseConn{
    public function add_dish_review($dish_id, $user_id, $dish_overall_rating, $dish_quality_rating, $dish_price_rating, $dish_review_text)
    {
        $stmt = $this->conn->prepare("INSERT INTO dish_review (dish_review_id, dish_id, user_id, dish_overall_rating, dish_quality_rating, dish_price_rating, dish_review_text, dish_time_of_upload) VALUES (?,?,?,?,?,?,?,CURRENT_TIMESTAMP)");
        $stmt->bind_param("iiiiiis", $dish_review_id, $dish_id, $user_id, $dish_overall_rating, $dish_quality_rating, $dish_price_rating, $dish_review_text);
        $stmt->execute();
        return 100;
    }

    public function delete_dish_review($dish_review_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM dish_review WHERE dish_review_id = ?");
        $stmt->bind_param("i", $dish_review_id);
        $stmt->execute();
        return 100;
    }

    public function modify_dish_review($dish_review_id, $dish_overall_rating, $dish_quality_rating, $dish_price_rating, $dish_review_text)
    {
        $stmt = $this->conn->prepare("UPDATE dish_review SET dish_overall_rating = ?, dish_quality_rating = ?, dish_price_rating = ?, dish_review_text = ? WHERE dish_review_id = ?");
        $stmt->bind_param("iiisi", $dish_overall_rating, $dish_quality_rating, $dish_price_rating, $dish_review_text, $dish_review_id);
        $stmt->execute();
        return 100;
    }

    public function get_dish_review_list()
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish_review");
        $stmt->execute();
        $result = $stmt->get_result();
        $all_data = array();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }

        return $all_data;
    }

    public function get_dish_review_list_given_id($dish_review_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish_review WHERE dish_review_id = ?");
        $stmt->bind_param("i", $dish_review_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $single_data = array();

        if($result->num_rows > 0)
        {
            $single_data = $result->fetch_assoc();
        }
        return $single_data;    
    }

    public function get_dish_review_given_dish($dish_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish_review WHERE dish_id = ?");
        $stmt->bind_param("i", $dish_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $all_data = array();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }

        return $all_data;         
    }

    /*
    public function get_dish_review_given_resto($resto_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish_review WHERE resto_id = ?");
        $stmt->bind_param("i", $resto_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $all_data = array();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }
        return $all_data;
    }
    */

    public function get_dish_review_given_user($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM dish_review WHERE user_id = ?");
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