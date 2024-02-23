
<?php
class DatabaseConn{
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db_name = "ratingsystem"; 
    public $conn;
    
    public function __construct(){
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
    }
}

class Register extends DatabaseConn{
    //this function checks if there is a username with the same email and password already, if there is, return 0
    public function sign_up($username, $password, $type, $email, $confirm_password){
        
        if ($password != $confirm_password)
        {
            return 10;
        }

        $stmt = $this->conn->prepare("SELECT s_username, s_password FROM users, WHERE s_username = ? and s_password = ?");
        
        $stmt->bind_param("ss",$username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($data)
        {
            return 11; // meaning meron nang same email and password dun sa database 
        }
        else
        {
            $stmt2 = $this->conn->prepare("INSERT INTO (s_username, s_password, s_type, s_email) VALUES(?,?,?,?");
            $stmt2-> bind_param("ssss", $username, $password, $type, $email);
            $stmt2->execute();

            return 100;
        }
    }
}
class Login extends DatabaseConn{
    public function sign_in($username, $password){
        $stmt = $this->conn->prepare("SELECT s_username, s_password FROM users, WHERE s_username = ? and s_password = ?");
        
        $stmt->bind_param("ss",$username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if ($data)
        {
            return 100; // meaning meron nang same email and password dun sa database
        }
        return 0; // walang match so no login
    }
    
}

?>