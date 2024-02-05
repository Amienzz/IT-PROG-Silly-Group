<?php

class user
{
    public $first_name;
    public $last_name;
    public $middle_initial;
    public $birthdate;
    public $gender;

    public function registerUser()
    {
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("INSERT INTO user_info (first_name, last_name, middle_initial, gender, birthday) VALUES(?,?,?,?,?)");
            $pst->bind_param("sssss", $this->first_name, $this->last_name, $this->middle_initial, $this->gender, $this->birthdate);
            $pst->execute();

            $pst->close();
            $con->close();

            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public static function main($args)
    {
        $userObj = new User();
        $userObj->registerUser();
    }
}