<?php
include_once 'back_Database.php';
?>



<?php

class resto extends DatabaseConn{
    public function add_resto($resto_user_id, $resto_name, $resto_description, $resto_email, $resto_websitelink)
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO resto (user_id, resto_name, resto_description, resto_email, resto_websitelink) VALUES (?,?,?,?,?)");
            $stmt->bind_param("issss", $resto_user_id, $resto_name, $resto_description, $resto_email, $resto_websitelink);
            $stmt->execute();
            return 100;
        }
        catch(Exception $e)
        {
            return 0;
        }

    }
    //this should include all the dishes and the reviews as well.
    public function delete_resto($resto_id)
    {   

        try
        {
            //to delete the dish_reviews from the specific resto
            $stmt3 = $this->conn->prepare("DELETE FROM dish_review WHERE dish_id IN (SELECT dish_id FROM dish WHERE resto_id = ?)");
            $stmt3->bind_param("i", $resto_id);
            $stmt3->execute();


            //to delete the dish from the specific resto
            $stmt2 = $this->conn->prepare("DELETE FROM dish WHERE resto_id = ?");
            $stmt2->bind_param("i", $resto_id);
            $stmt2->execute();

            // to delete the resto
            $stmt = $this->conn->prepare("DELETE FROM resto WHERE resto_id = ?");
            $stmt->bind_param("i", $resto_id);
            $stmt->execute();

            return 100;            
        }catch(Exception $e)
        {
            return 0;
        }
    }

    public function modify_resto($resto_name, $resto_description, $resto_email, $resto_websitelink, $resto_id)
    {
        try
        {
            $stmt = $this->conn->prepare("UPDATE resto SET resto_name = ?, resto_description = ?, resto_email = ?, resto_websitelink = ? WHERE resto_id = ?");
            $stmt->bind_param("ssssi", $resto_name, $resto_description, $resto_email, $resto_websitelink, $resto_id);
            $stmt->execute();
            
            return 100;
        }
        catch(Exception $e)
        {
            return 0;
        }
    }

    public function get_resto_list()
    {
        try
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
        catch (Exception $e)
        {
            return 0;
        }

    }


    public function get_resto_list_given_id($resto_id)
    {

        try
        {
            $stmt = $this->conn->prepare("SELECT * FROM resto WHERE resto_id = ?");
            $stmt->bind_param("i", $resto_id);
            $stmt->execute();
            
            $result = $stmt->get_result();
            $single_data = array();
    
            if($result->num_rows > 0)
            {
                $single_data = $result->fetch_assoc();
            }
            return $single_data;  
        }
        catch (Exception $e)
        {
            return 0;
        } 
      
    }

    public function get_resto_list_given_email($email){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM resto WHERE resto_email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $result = $stmt->get_result();
            if($result->num_rows > 0)
                return $result->fetch_assoc();
            return NULL;
        } catch (Exception $e){
            return 0;
        }
    }
}



?>