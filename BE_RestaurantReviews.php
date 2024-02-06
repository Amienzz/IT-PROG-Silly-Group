<?php
class RestaurantReviews extends DatabaseConn{

    public function add_resturant_reviews($review_overall_rating, $resto_review_text, $resto_review_date)
    {
        $stmt = $this->conn->prepare("INSERT INTO resto_review (review_overall_rating, resto_review_text, resto_review_date) VALUES (?,?,?)");
        $stmt->bind_param("sss", $review_overall_rating, $resto_review_text, $resto_review_date);
        $stmt->execute();
        return 100;
    }
    public function delete_resto_reviews($resto_review_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM resto_review WHERE resto_review_id = ?");
        $stmt->bind_param("s", $resto_review_id);
        $stmt->execute();
        return 100;
    }

    public function modify_resto_reviews($resto_review_id, $resto_review_overall_rating, $resto_review_text, $resto_review_date)
    {
        $stmt = $this->conn->prepare("UPDATE resto_review SET resto_review_overall_rating = ?,  resto_review_text = ?, resto_review_date = ? WHERE resto_review_id = ?");
        $stmt->bind_param("sssi", $resto_review_id, $resto_review_overall_rating, $resto_review_text, $resto_review_date);
        $stmt->execute();
        return 100;
    }

    public function get_resto_review_list()
    {
        $stmt = $this->conn->prepare("SELECT * FROM resto");
        $stmt->execute();
        $all_data = array();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }
        return $all_data;
    }

    public function get_resto_review_given_id($resto_review_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM resto WHERE resto_review_id = ?");
        $stmt->bind_param("s", $resto_review_id);
        $stmt->execute();
        $all_data = array();
        $result = $stmt->get_result();

        if ($result->num_rows > 0)
        {
            $all_data = $result->fetch_assoc();
              
        }
        return $all_data;    
  
    }
    public function get_resto_review_given_resto_id($resto_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM resto WHERE resto_id = ?");
        $stmt->bind_param("s", $resto_review_id);
        $stmt->execute();
        $all_data = array();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }
        return $all_data;  
  
    }
}




?>