<?php
include_once 'back_Database.php';
?>

<?php
class RestaurantReviews extends DatabaseConn{

    public function add_resto_reviews($resto_id, $user_id, $resto_review_overall_rating, $resto_review_text)
    {
        $stmt = $this->conn->prepare("INSERT INTO resto_review (resto_id, user_id, resto_review_overall_rating, resto_review_text, resto_review_date) VALUES (?,?,?,?,CURRENT_TIMESTAMP)");
        $stmt->bind_param("iiss", $resto_id, $user_id, $resto_review_overall_rating, $resto_review_text);
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

    public function modify_resto_reviews($resto_review_id, $resto_review_overall_rating, $resto_review_text)
    {
        $stmt = $this->conn->prepare("UPDATE resto_review SET resto_review_overall_rating = ?,  resto_review_text = ?, resto_review_date = CURRENT_TIMESTAMP WHERE resto_review_id = ?");
        $stmt->bind_param("ssi",  $resto_review_overall_rating, $resto_review_text, $resto_review_id);
        $stmt->execute();
        return 100;
    }

    public function get_resto_review_list()
    {
        $stmt = $this->conn->prepare("SELECT * FROM resto_review");
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
        $stmt = $this->conn->prepare("SELECT * FROM resto_review WHERE resto_review_id = ?");
        $stmt->bind_param("i", $resto_review_id);
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
        $stmt = $this->conn->prepare("SELECT * FROM resto_review WHERE resto_id = ?");
        $stmt->bind_param("i", $resto_id);
        $stmt->execute();
        $all_data = array();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc())
        {
            $all_data[] = $row;
        }
        return $all_data;  
  
    }


    public function get_resto_review_given_user_id($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM resto_review WHERE user_id = ?");
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

    public function get_resto_review_given_option($restaurant_id, $user_id, $rating, $startdate, $enddate){
        try
        {
            $is2nd = false; // Initialize to false

            $statement = "SELECT * FROM resto_review WHERE ";
            if ($restaurant_id != -1)
            {
                $statement = $statement . "resto_id = " . $restaurant_id;
                $is2nd = true; // Update $is2nd if condition is met
            }
            if ($rating != "")
            {
                if ($is2nd)
                {
                    $statement = $statement . " AND ";
                }
                else
                {
                    $is2nd = true;
                }
                $statement = $statement . "resto_review_overall_rating = '" . $rating . "'";
            }
            if ($startdate != "")
            {
                if ($is2nd)
                {
                    $statement = $statement . " AND ";
                }
                else
                {
                    $is2nd = true;
                }
                $statement = $statement . "resto_review_date >= '" . $startdate . "'";
            }
            if ($enddate != "")
            {
                if ($is2nd)
                {
                    $statement = $statement . " AND ";
                }
                else
                {
                    $is2nd = true;
                }
                $statement = $statement . "resto_review_date <= '" . $enddate . "'";
            }

            if ($user_id != -1)
            {
                if ($is2nd)
                {
                    $statement = $statement . " AND ";
                }
                else
                {
                    $is2nd = true;
                }
                $statement = $statement . "user_id = " . $user_id;
            }

            $result = mysqli_query($this->conn, $statement);
            $all_data = array();
            while ($row = $result->fetch_assoc())
            {
                $all_data[] = $row;
            }
            return $all_data;
        }
        catch (Exception $e)
        {
            return 0;
        }
    }

}




?>