<?php
//include 'back_Database.php';
include 'BE_Restaurant.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    
    $resto = new resto();
    
    /*
    $resto->add_resto(1, "jimbaptist", "FREEgoodtaste", "jim@.com", "www.freegoodtaste.com");
    */
    /*
    $resto2 = new resto();
    $resto2->delete_resto(1);
    */
    
    // $resto->add_resto(1, "Ajimbaptist", "FREEgoodtaste", "jim@.com", "www.freegoodtaste.com");
    // $resto->add_resto(1, "Bjimbaptist", "FREEgoodtaste", "jim@.com", "www.freegoodtaste.com");
    // $resto->add_resto(1, "Cjimbaptist", "FREEgoodtaste", "jim@.com", "www.freegoodtaste.com");
    

    //$resto->modify_resto("jimbaptist2", "FREEgoodtaste2", "jim@.com2", "www.freegoodtaste.com2", "5");

    $data = $resto->get_resto_list();
    foreach($data as $row)
    {
        echo $row['resto_name'] . '<br>';
        echo $row['resto_description'] . '<br>';
        echo $row['resto_email'] . '<br>';
        echo $row['resto_websitelink'] . '<br>';
        echo $row['resto_id'] . '<br>';
    }

    $data2 = $resto->get_resto_list_given_id(5);

    echo $data2['resto_name'];
    echo $data2['resto_description'];
    echo $data2['resto_email'];
    echo $data2['resto_websitelink'];
    echo $data2['resto_id'];
?>
    
</body>
</html>