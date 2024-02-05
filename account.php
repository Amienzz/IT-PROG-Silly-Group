<?php

class account
{
    public $password;
    public $verify_password;
    public $email;
    public $last_login;
    public $registration_date;
    public $user_id;
    public $username;

    public function setLogDate()
    {
        $con = null;
        $pst = null;
        $rst = null;
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("UPDATE account_info SET last_login = ? WHERE email = ? ");

            $date = $this->getDate();
            $entered_email = $this->email;

            $pst->bind_param("ss", $date, $entered_email);
            $pst->execute();

            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            if ($rst != null) {
                $rst->close();
            }
            if ($pst != null) {
                $pst->close();
            }
            if ($con != null) {
                $con->close();
            }
        }
    }

    public function getEmail()
    {
        $con = null;
        $pst = null;
        $rst = null;
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT a.email AS g_email FROM account_info a JOIN user_info u ON a.user_id = u.user_id JOIN profile_info p ON p.user_id = u.user_id WHERE a.email = ?");
            $entered_email = $this->email;
            $pst->bind_param("s", $entered_email);
            $pst->execute();
            $rst = $pst->get_result();

            if ($rst->num_rows > 0) {
                $row = $rst->fetch_assoc();
                $this->email = $row["g_email"];
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            if ($rst != null) {
                $rst->close();
            }
            if ($pst != null) {
                $pst->close();
            }
            if ($con != null) {
                $con->close();
            }
        }
    }

    public function isEight()
    {
        try {
            if (strlen($this->password) <= 7) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function getUsername()
    {
        $con = null;
        $pst = null;
        $rst = null;
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT p.user_name AS g_username FROM account_info a JOIN user_info u ON a.user_id = u.user_id JOIN profile_info p ON p.user_id = u.user_id WHERE a.email = ?");
            $entered_email = $this->email;
            $pst->bind_param("s", $entered_email);
            $pst->execute();
            $rst = $pst->get_result();

            if ($rst->num_rows > 0) {
                $row = $rst->fetch_assoc();
                $this->username = $row["g_username"];
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            if ($rst != null) {
                $rst->close();
            }
            if ($pst != null) {
                $pst->close();
            }
            if ($con != null) {
                $con->close();
            }
        }
    }

    public function getDate()
    {
        $currentDate = new DateTime();
        return $currentDate->format('Y-m-d');
    }

    public function loginCredentials()
    {
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT email, account_password FROM account_info WHERE email = ?");
            $entered_email = $this->email;
            $pst->bind_param("s", $entered_email);
            $pst->execute();
            $rst = $pst->get_result();

            if ($rst->num_rows > 0) {
                $row = $rst->fetch_assoc();
                $active_email = $row["email"];
                $this->verify_password = $row["account_password"];

                if ($this->password == $this->verify_password) {
                    $pst->close();
                    $con->close();
                    $rst->close();
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function passwordVerification()
    {
        try {
            $value = $this->password == $this->verify_password;
            return $value ? 1 : 0;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }

    public function accountAssignment()
    {
        try {
            $this->registration_date = $this->getDate();
            $this->last_login = $this->getDate();

            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT MAX(user_id) AS reference FROM user_info");
            $rst = $pst->execute();

            while ($row = $rst->fetch_assoc()) {
                $this->user_id = $row["reference"];
            }

            $pst = $con->prepare("INSERT INTO account_info (email, account_password, registration_date, last_login, user_id) VALUES(?,?,?,?,?)");
            $pst->bind_param("ssssi", $this->email, $this->password, $this->registration_date, $this->last_login, $this->user_id);
            $pst->execute();

            $pst->close();
            $con->close();
            $rst->close();

            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        }
    }
}
