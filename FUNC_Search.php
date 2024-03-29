<?php
    include_once 'BE_Account.php';
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="taskbar"></header>
    
    
    <?php
        error_reporting(E_ERROR | E_PARSE);
        
        $Account = new create_acc();     
        
        if(isset($_GET['action'])){
            $action = $_GET['action'];

            switch($action){
                case 'search_users':
                echo "<div id='search_users'>";
                echo "<table><tr>";
                echo "<th>User ID</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Middle Initial</th>";
                echo "<th>Gender</th>";
                echo "<th>Birthday</th>";
                echo "<th>Email</th>";
                echo "<th>Username</th>";
                echo "<th>Registration Date</th>";
                echo "<th>Profile Name</th>";
                echo "<th>Description</th>";

                $data = $Account->get_account_list();
                foreach($data as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['middle_initial'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['birthday'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['registration_date'] . "</td>";
                    echo "<td>" . $row['profile_name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "</tr>";
                }
                echo "</table></div>";
                echo "<a href='MAIN_page.php'><button>Return to Main Page</button></a>";
                break;
            }
        }
    ?>

    <script src="script.js"></script>
</body>
</html>
