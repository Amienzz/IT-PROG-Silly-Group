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

            if($result === null) 
            {
                return 1;
            }
            else
            {
                return 0;
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
            $smt = $this->conn->prepare("SELECT email FROM users WHERE email = ? and password = ? ");
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
        public function register_user($s_firstn, $s_last, $mid, $gender, $birthdate, $email, $s_password)
        {
            $date = date_today();

            $smt = $this->conn->prepare("INSERT INTO user (first_name, last_name, middle_initial, gender, birthday, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $smt->bind_param("ssssssss", $s_firstn, $s_last, $mid, $gender, $birthdate, $email, $s_password, $date);
            
            $smt->execute();
 
            $smt->close();

        }
    }

?>