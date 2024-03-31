<?php
include_once 'back_Database.php';
include_once 'BE_Account.php';
?>

<?php
class RestaurantReviews extends DatabaseConn{

    public function add_resto_reviews($resto_id, $user_id, $resto_review_overall_rating, $resto_review_text)
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO resto_review (resto_id, user_id, resto_review_overall_rating, resto_review_text, resto_review_date) VALUES (?,?,?,?,CURRENT_TIMESTAMP)");
            $stmt->bind_param("iiss", $resto_id, $user_id, $resto_review_overall_rating, $resto_review_text);
            $stmt->execute();
            return 100;
        }
        catch(Exception $e)
        {
            return 0;
        }

    }
    public function delete_resto_reviews($resto_review_id)
    {
        try
        {
            $stmt = $this->conn->prepare("DELETE FROM resto_review WHERE resto_review_id = ?");
            $stmt->bind_param("s", $resto_review_id);
            $stmt->execute();
            return 100;
        }
        catch(Exception $e)
        {
            return 0;
        }

    }

    public function modify_resto_reviews($resto_review_id, $resto_review_overall_rating, $resto_review_text)
    {
        try
        {
            $stmt = $this->conn->prepare("UPDATE resto_review SET resto_review_overall_rating = ?,  resto_review_text = ?, resto_review_date = CURRENT_TIMESTAMP WHERE resto_review_id = ?");
            $stmt->bind_param("ssi",  $resto_review_overall_rating, $resto_review_text, $resto_review_id);
            $stmt->execute();
            return 100;
        }
        catch(Exception $e)
        {
            return 0;
        }

    }

    public function get_resto_review_list()
    {
        try
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
        catch (Exception $e)
        {
            return 0;
        }

    }

    public function get_resto_review_given_id($resto_review_id)
    {
        try
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
        catch (Exception $e)
        {
            return 0;
        }

  
    }
    public function get_resto_review_given_resto_id($resto_id)
    {
        try
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
        catch (Exception $e)
        {
            return 0;
        }

  
    }


    public function get_resto_review_given_user_id($user_id)
    {
        try
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
        catch (Exception $e)
        {
            return 0;
        }

    }

    public function get_resto_review_given_option($restaurant_id, $username, $rating, $startdate, $enddate){
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

            if ($username != "")
            {
                $account = new create_acc();
                $uid = $account->searchUser($username);
                
                if ($is2nd)
                {
                    $statement = $statement . " AND ";
                }
                else
                {
                    $is2nd = true;
                }
                $statement = $statement . "user_id = " . $uid['user_id'];
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

    public function get_resto_review_list_average($resto_id)
    {
        try
        {
            $stmt = $this->conn->prepare("SELECT AVG(
                CASE resto_review_overall_rating
                    WHEN 'excellent' THEN 5
                    WHEN 'good' THEN 4
                    WHEN 'average' THEN 3
                    WHEN 'fair' THEN 2
                    WHEN 'poor' THEN 1
                END
            ) AS average_rating
            FROM resto_review
            WHERE resto_id = ?;");
            $stmt->bind_param("i", $resto_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $average_rating = $result->fetch_assoc();
            return $average_rating;
        }
        catch (Exception $e)
        {
            return 0;
        }
    }
}




?>