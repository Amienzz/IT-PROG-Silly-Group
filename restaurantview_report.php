<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Restaurant Reviews</title>
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
