<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Search for reviews</title>
    <style>
        .hidden {
            display: none;
        }

        body {
            text-align: left;
        }

        h2, h4 {
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left;
            margin: 20px;
        }

        p {
            color: #666;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #f8f9fa; 
        }

        button {
            padding: 10px 20px;
            background-color: #32a852; 
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="button"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <?php
    // Assume the $dishList object is available and contains dish details
    ?>
    <h2>Search for reviews</h2>
    <h4>Fill out at least one field. Leave any unknown fields blank.</h4>
    <form action="result_review.php" method="get">
        <label for="cb1">Username:</label>
        <input type="checkbox" id="cb1" name="cb1" onclick="toggleInput('user_name', 'cb1')" value="on">
        <input type="text" id="user_name" name="user_name" class="hidden">
        <br><br>
        
        <label for="cb2">Dish:</label>
        <input type="checkbox" id="cb2" name="cb2" onclick="toggleInput('search_dish', 'cb2')" value="on">
        <select id="search_dish" name="search_dish" class="hidden">
            <?php
            foreach ($dishList->get_dishList() as $index => $dish_name) {
                $dish_id = $dishList->get_dishIds()[$index];
                echo "<option value=\"$dish_id\">$dish_name</option>";
            }
            ?>
        </select>
        <br><br>
        
        <label for="cb4">Dish Category:</label>
        <input type="checkbox" id="cb4" name="cb4" onclick="toggleInput('search_dishCategory', 'cb4')" value="on">
        <select id="search_dishCategory" name="search_dishCategory" class="hidden">
            <?php
            foreach ($dishList->get_dishCategories() as $dish_category) {
                echo "<option value=\"$dish_category\">$dish_category</option>";
            }
            ?>
        </select>
        <br><br>
        
        <label for="cb3">Date:</label>
        <input type="checkbox" id="cb3" name="cb3" onclick="toggleInput('upload_date_range', 'cb3')" value="on">
        <div id="upload_date_range" class="hidden">
            Format: YYYY / MM / DD<br><br>
            Start Date: 
            <input type="text" id="start_year" name="start_year" pattern="\d{4}" title="YYYY" size="4"> / 
            <input type="text" id="start_month" name="start_month" pattern="\d{2}" title="MM" size="2"> / 
            <input type="text" id="start_date" name="start_date" pattern="\d{2}" title="DD" size="2"><br>
            End Date: 
            <input type="text" id="end_year" name="end_year" pattern="\d{4}" title="YYYY" size="4"> / 
            <input type="text" id="end_month" name="end_month" pattern="\d{2}" title="MM" size="2"> / 
            <input type="text" id="end_date" name="end_date" pattern="\d{2}" title="DD" size="2">
        </div>
        <br><br>

        <button type="submit">Search</button>
    </form>

    <form action="mainpage.php">
        <button type="submit">Return to main menu</button>
    </form>

    <script>
        function toggleInput(inputId, checkboxId) {
            var inputField = document.getElementById(inputId);
            var checkbox = document.getElementById(checkboxId);

            inputField.style.display = (checkbox.checked) ? 'block' : 'none';
            inputField.required = checkbox.checked;
        }
    </script>
</body>
</html>
