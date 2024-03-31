<?php
include_once 'Back_database.php';
?>
 
 
<?php
     class create_acc extends DatabaseConn
    {
        public function isUsernname_Taken($s_username)
        {
            $smt = $this->conn->prepare("SELECT username FROM user WHERE username = ? ");
            $smt->bind_param("s",$s_username);
            $smt->execute();
 
 
            $result = $smt->get_result();
 
            if($result->num_rows != 0) ///returns 1 if false
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
            $smt = $this->conn->prepare("SELECT email FROM user WHERE email = ? ");
            $smt->bind_param("s",$s_email);
            $smt->execute();
 
            $result = $smt->get_result();
 
            if($result->num_rows != 0) 
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
            $smt = $this->conn->prepare("SELECT email FROM user WHERE email = ? AND user_password = ? ");
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
        public function register_user($s_firstn, $s_last, $mid, $gender, $birthdate, $s_email, $s_username, $s_user_password, $s_bio, $account_type)
        {
            $date = $this->date_today();
            $i_userid = $this->assignUID();
 
            $smt = $this->conn->prepare("INSERT INTO user (first_name, last_name, middle_initial, gender, birthday, user_id, email, username, user_password, registration_date, bio, account_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $smt->bind_param("sssssissssss", $s_firstn, $s_last, $mid, $gender, $birthdate, $i_userid, $s_email, $s_username, $s_user_password, $date, $s_bio, $account_type);
            try
            {
                $smt->execute();
                $smt->close(); 
                return 1;
            }
            catch(Exception $e)
            {
                echo $e;
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
                $stmt = $this->conn->prepare("SELECT first_name, last_name, middle_initial, gender, birthday, user_id, email, username, registration_date, bio, account_type FROM user WHERE email = ?");
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
        public function searchID($id) //getUser via ID
        {
            try
            {
                $stmt = $this->conn->prepare("SELECT first_name, last_name, middle_initial,gender,birthday,user_id,email,username,registration_date,bio,account_type FROM user WHERE user_id = ?");
                $stmt->bind_param("i",$id);
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

        public function searchUser($s_username) //getUser via username
        {
            try
            {
                $stmt = $this->conn->prepare("SELECT first_name, last_name, middle_initial,gender,birthday,user_id,email,username,registration_date,bio,account_type FROM user WHERE username = ?");
                $stmt->bind_param("s",$s_username);
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

        public function assignUID()
        {
            $stmt = $this->conn->prepare("SELECT MAX(user_id) AS max_user_id FROM user");
            $stmt->execute();
            $result = $stmt->get_result();
        
            // Check if there are existing user_ids
            if ($result->num_rows == 1) 
            {
                $row = $result->fetch_assoc();
                $maxUserId = $row['max_user_id'];
        
                // If there are existing user_ids, increment the maximum user_id
                $nextUserId = $maxUserId + 1;
            } else 
            {
                // If there are no existing user_ids, start from 1
                $nextUserId = 1;
            }

            return $nextUserId;
        }

        public function updateUser($firstname, $lastname, $middleinitial, $gender, $birthday, $email, $username, $bio, $user_id){
            try{
                $stmt = $this->conn->prepare("UPDATE user SET first_name = ?, last_name = ?, middle_initial = ?, gender = ?, birthday = ?, email = ?, username = ?, bio = ? WHERE user_id = ?");
                $stmt->bind_param("ssssssssi", $firstname, $lastname, $middleinitial, $gender, $birthday, $email, $username, $bio, $user_id);
                $stmt->execute();

                if($stmt->affected_rows > 0)
                    return 1;
                else return 0;

            } catch (Exception $e){
                return NULL;
            }
        }

        public function updatePassword($email, $old, $new, $confirm){
            try{
                if ($this->log_in($email, $old) == 0){
                    return 1;
                }else if ($this->verify_password($new, $confirm) == 0){
                    return 2;
                } else {
                    $stmt = $this->conn->prepare("UPDATE user SET user_password = ? WHERE email = ?");
                    $stmt->bind_param("ss", $new, $email);
                    $stmt->execute();

                    if($stmt->affected_rows > 0)
                        return 0;
                    else return false;
                }
            } catch (Exception $e){
                return false;
            }
        }
    }       
?>