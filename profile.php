<?php

class profile
{
    public $username;
    public $new_username;
    public $id_profile;
    public $new_bio;
    public $bio;
    public $user_id;
    public $gender;

    public function getUsernameList()
    {
        $con = null;
        $pst = null;
        $rst = null;
        $usernames = [];

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT p.user_name AS g_user_name FROM user_info u JOIN profile_info p ON p.user_id = u.user_id WHERE u.gender = ?");
            $pst->bind_param("s", $this->gender);
            $pst->execute();

            $rst = $pst->get_result();
            while ($row = $rst->fetch_assoc()) {
                $usernames[] = $row["g_user_name"];
            }

            return $usernames;
        } catch (Exception $e) {
            echo $e->getMessage();
            return $usernames;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function getBio()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT p.user_bio AS g_bio FROM profile_info p WHERE p.user_name = ?");
            $pst->bind_param("s", $this->username);
            $pst->execute();

            $rst = $pst->get_result();
            if ($row = $rst->fetch_assoc()) {
                $this->bio = $row["g_bio"];
                return $this->bio;
            } else {
                return $this->bio;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return $this->bio;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function getProfileId()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT p.profile_id AS i_profile FROM profile_info p WHERE p.user_name = ?");
            $pst->bind_param("s", $this->username);
            $pst->execute();

            $rst = $pst->get_result();
            if ($row = $rst->fetch_assoc()) {
                $this->id_profile = $row["i_profile"];
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function setBio()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $this->getProfileId();
            $pst = $con->prepare("UPDATE profile_info SET user_bio = ? WHERE profile_id = ?");
            $pst->bind_param("si", $this->new_bio, $this->id_profile);
            $pst->execute();

            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function setUsername()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $this->getProfileId();
            $pst = $con->prepare("UPDATE profile_info SET user_name = ? WHERE profile_id = ?");
            $pst->bind_param("si", $this->new_username, $this->id_profile);
            $pst->execute();

            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function profileSetUp()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT MAX(user_id) AS reference FROM user_info");
            $rst = $pst->execute();

            while ($row = $rst->fetch_assoc()) {
                $this->user_id = $row["reference"];
            }

            $pst = $con->prepare("INSERT INTO profile_info (user_name, user_bio, user_id) VALUES(?,?,?)");
            $pst->bind_param("ssi", $this->username, $this->bio, $this->user_id);
            $pst->execute();

            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function isUsernameTaken()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT user_name FROM profile_info WHERE user_name = ?");
            $pst->bind_param("s", $this->username);
            $rst = $pst->execute();

            if ($row = $rst->fetch_assoc()) {
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function getUserId()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT u.user_id AS g_user_id FROM profile_info p JOIN user_info u ON p.user_id = u.user_id  WHERE p.user_name = ?");
            $pst->bind_param("s", $this->username);
            $rst = $pst->execute();

            if ($row = $rst->fetch_assoc()) {
                $this->user_id = $row["g_user_id"];
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    public function deleteProfile()
    {
        $con = null;
        $pst = null;
        $rst = null;

        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $this->getUserId();
            $this->getProfileId();

            $pst = $con->prepare("DELETE FROM mobile_number WHERE user_id = ?");
            $pst->bind_param("i", $this->user_id);
            $pst->execute();

            $pst = $con->prepare("DELETE FROM account_info WHERE user_id = ?");
            $pst->bind_param("i", $this->user_id);
            $pst->execute();

            $pst = $con->prepare("DELETE FROM resto_review WHERE user_name = ?");
            $pst->bind_param("s", $this->username);
            $pst->execute();

            $pst = $con->prepare("DELETE FROM dish_review WHERE profile_id = ?");
            $pst->bind_param("i", $this->id_profile);
            $pst->execute();

            $pst = $con->prepare("DELETE FROM profile_info WHERE user_name = ?");
            $pst->bind_param("s", $this->username);
            $pst->execute();

            return 1;
        } catch (Exception $e) {
            echo $e->getMessage();
            return 0;
        } finally {
            $this->closeConnections($rst, $pst, $con);
        }
    }

    private function closeConnections($rst, $pst, $con)
    {
        try {
            if ($rst != null) {
                $rst->close();
            }
            if ($pst != null) {
                $pst->close();
            }
            if ($con != null) {
                $con->close();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>