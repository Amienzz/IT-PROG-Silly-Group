<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Search a review</title>
</head>
<body>
    <h2>Search for reviews</h2><br>
    <h4>Fill out at least one field. Leave any unknown fields blank.</h4><br>
    <form action="restaurantreview_result.php" method="post">
        <label for="cb1">Username:</label>
        <input type="checkbox" id="cb1" name="cb1" onclick="toggleInput('user_name', 'cb1')" value="on">
        <input type="text" id="user_name" name="user_name" class="hidden">
        <br><br>
        
        <label for="cb2">Rating:</label>
        <input type="checkbox" id="cb2" name="cb2" onclick="toggleInput('search_rating', 'cb2')" value="on">
        <select id="search_rating" name="search_rating" class="hidden">
                <option value="" selected disabled hidden>Select an option</option>
                <option value="Excellent">Excellent</option>
                <option value="Good">Good</option>
                <option value="Average">Average</option>
                <option value="Fair">Fair</option>
                <option value="Poor">Poor</option>
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
        <button type="submit">Back to Main Menu</button>
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