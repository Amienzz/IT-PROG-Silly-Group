<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Restaurant Reviews</title>
    <style>
        body {
            text-align: center;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: inline-block;
            margin: 5px;
            padding: 8px 15px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #32a852;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="mainpage.php" method="post">
        <?php
            include_once 'restaurant_review_mgt.php';
            $R = new RestoReview();

            $R->restaurant_review_report();
            for ($i = 0; $i < count($R->rating_typelist); $i++) {
        ?>
        <tr>
            <td><?php echo $R->rating_typelist[$i]; ?></td>
            <td><?php echo $R->count_list[$i]; ?></td>
            <td><?php echo $R->average_list[$i] . "%"; ?></td>
        </tr>
        <?php } ?>
        </tbody>
        </table>

        <input type="submit" value="Back to Main Menu">
    </form>
</body>
</html>
