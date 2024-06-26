<?php
include 'Back_database.php';
?>
 
<?php
     class create_acc extends DatabaseConn
    {
        public function isUsernname_Taken($s_username)
        {
            $smt = $this->conn->prepare("SELECT username FROM users WHERE username = ? ");
            $smt->bind_param("s",$s_username);
            $smt->execute();
 
            $result = $smt->get_result();
 
            if($result === null) ///returns 1 if false
            {
                return 1;
            }
            else
            {
                return 0;   /// returns 0 if true
            }
        }
        public function isEmail_taken($s_email)////checks if the email is taken
        {
            $smt = $this->conn->prepare("SELECT email FROM users WHERE email = ? ");
            $smt->bind_param("s",$s_email);
            $smt->execute();
 
            $result = $smt->get_result();
 
            if($result === null) 
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        public function verify_password($s_password, $v_password)///made this function just in case the user wants to renew the password
        {
            if(strcmp($s_password, $v_password) == 0)
            {
                return 1;   ///password can be renewed
            }
            else
            {
                return 0; ///mismatch password
            }
        }
        public function log_in($s_email, $s_password)
        {
            $smt = $this->conn->prepare("SELECT email FROM user WHERE email = ? AND password = ? ");
            $smt->bind_param("ss",$s_email, $s_password);
            $smt->execute();
 
            $result = $smt->get_result();
            $data = $result->fetch_assoc();
 
            if($data)
            {
                return 1; ///returns 1 if password and email are the same;
            }
            else
            {
                return 0; ////mismatch in password or email.
            }
        }
        public function date_today()
        {
            $date = date('Y-m-d'); // Format: YYYY-MM-DD
            return $date;
        }
        public function register_user($s_firstn, $s_last, $mid, $gender, $birthdate, $s_userid, $s_email, $s_username, $s_user_password, $s_bio, $account_type)
        {
            $date = date_today();
 
            $smt = $this->conn->prepare("INSERT INTO user (first_name, last_name, middle_initial, gender, birthday,user_id, email, username,user_password,registration_date,bio,account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $smt->bind_param("ssssssssssss", $s_firstn, $s_last, $mid, $gender, $birthdate,$s_userid,$s_email, $s_username, $s_user_password, $date, $s_bio, $account_type);
            try
            {
                $smt->execute();
                $smt->close(); 
            }
            catch(Exception $e)
            {
                return 0;
            }
 
        }
        public function isBusines($s_username)
        {
            $smt  = $this->conn->prepare("SELECT account_type FROM users WHERE username = ?");
            $smt -> bind_param("s", $s_username);
            $smt -> execute();
 
            $result = $smt->get_result();
            if(!(strcmp($result,"business")))   //return 1 if business
            {
                return 1;
            }
            else    //return 0 if not
            {
                return 0;
            }
        }
        public function searchEmail($s_email) //getUser via email
        {
            try
            {
                $stmt = $this->conn->prepare("SELECT first_name, last_name, middle_initial, gender, birthday, user_id, email, username, registration_date, description, account_type FROM user WHERE email = ?");
                $stmt->bind_param("s",$s_email);
                $stmt->execute();
 
                $result = $stmt->get_result();
                $data = array();
 
                while( $row = $result->fetch_assoc())
                {
                    $data = $row;
                }
                return $data;
            }
            catch(Exception $e)
            {
                return 0;
            }
        }
        public function searchID($s_id) //getUser via ID
        {
            try
            {
                $stmt = $this->conn->prepare("SELECT first_name, last_name, middle_initial,gender,birthday,user_id,email,username,registration_date,description,account_type FROM user WHERE user_id = ?");
                $stmt->bind_param("s",$s_id);
                $stmt->execute();
 
                $result = $stmt->get_result();
                $data = array();
 
                while( $row = $result->fetch_assoc())
                {
                    $data = $row;
                }
                return $data;
            }
            catch(Exception $e)
            {
                return 0;
            }
        }

        public function get_account_list()
        {
            $stmt = $this->conn->prepare("SELECT * FROM user");
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
