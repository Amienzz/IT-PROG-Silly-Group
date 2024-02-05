<?php

class mobile
{
    public $mobile;
    public $userName;
    public $got_user_id;

    public function removeMobile()
    {
        $con = null;
        $pst = null;
        $rst = null;
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("DELETE FROM mobile_number WHERE mobile_number = ?");
            $pst->bind_param("s", $this->mobile);
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

    public function getUserMobile()
    {
        $con = null;
        $pst = null;
        $rst = null;
        $mobileNumbers = [];
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT ui.user_id AS g_user_id FROM profile_info pi JOIN user_info ui ON pi.user_id = ui.user_id WHERE pi.user_name = ?");
            $pst->bind_param("s", $this->userName);
            $pst->execute();
            $rst = $pst->get_result();

            if ($rst->num_rows > 0) {
                $row = $rst->fetch_assoc();
                $this->got_user_id = $row["g_user_id"];
            }

            $pst = $con->prepare("SELECT m.mobile_number AS users_mobile FROM mobile_number m WHERE m.user_id = ?");
            $pst->bind_param("i", $this->got_user_id);
            $pst->execute();
            $rst = $pst->get_result();

            while ($row = $rst->fetch_assoc()) {
                $mobileNumbers[] = $row["users_mobile"];
            }

            return $mobileNumbers;
        } catch (Exception $e) {
            echo $e->getMessage();
            return $mobileNumbers;
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

    public function setMobile()
    {
        $con = null;
        $pst = null;
        $rst = null;
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT ui.user_id AS g_user_id FROM profile_info pi JOIN user_info ui ON pi.user_id = ui.user_id WHERE pi.user_name = ?");
            $pst->bind_param("s", $this->userName);
            $pst->execute();
            $rst = $pst->get_result();

            if ($rst->num_rows > 0) {
                $row = $rst->fetch_assoc();
                $this->got_user_id = $row["g_user_id"];
            }

            $pst = $con->prepare("INSERT INTO mobile_number (mobile_number, user_id) VALUES(?, ?)");
            $pst->bind_param("si", $this->mobile, $this->got_user_id);
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

    public function getMobile()
    {
        $con = null;
        $pst = null;
        $rst = null;
        try {
            $con = new mysqli("localhost", "root", "12345678", "Restaurant_Review");
            echo "Connection is Successful<br>";

            $pst = $con->prepare("SELECT m.mobile_number FROM mobile_number m WHERE m.mobile_number = ?");
            $pst->bind_param("s", $this->mobile);
            $rst = $pst->execute();

            if ($rst->num_rows > 0) {
                return 1; // Mobile number is taken
            } else {
                return 0; // Mobile number is not taken
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
}
