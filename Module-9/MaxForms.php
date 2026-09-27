<!DOCTYPE html>
<html>
<head>
    <title>Max's Add Record Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        nav {
            margin: 15px 0;
            padding: 10px;
            background-color: #f0f0f0;
        }
        nav a {
            text-decoration: none;
            color: #0066cc;
            margin-right: 5px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            padding: 5px;
            width: 200px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Add a BMW Record</h1>

<nav>
    <a href="MaxIndex.php">Home</a> |
    <a href="MaxCreateTable.php">Create Table</a> |
    <a href="MaxQueryTable.php">Test Queries</a> |
    <a href="MaxSearch.php">Search Records</a> |
    <a href="MaxForms.php">Add a Record</a> |
    <a href="MaxDropTable.php">Drop Table</a>
</nav>

<?php

	// unlike the search page, adding a record is a chnage in the DB, not a simple lookup. SO POST is a best option when a request has an effect.
	// Only attempts to process if the form is actually submitted, desnt run on every page load. 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $errors = array();

        // Basic validation same pattern as the earlier form assignment. Required text fields just need to be non-empty.
        $requiredFields = array("model_name", "chassis_code", "model_year", "engine_code", "horsepower");
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || trim($_POST[$field]) === "") {
                $errors[] = "The field '$field' was left empty.";
            }
        }

        // Numeric fields get an extra check beyond the "not empty".
        if (isset($_POST["model_year"]) && trim($_POST["model_year"]) !== "" && !is_numeric($_POST["model_year"])) {
            $errors[] = "Model year must be a number.";
        }
        if (isset($_POST["horsepower"]) && trim($_POST["horsepower"]) !== "" && !is_numeric($_POST["horsepower"])) {
            $errors[] = "Horsepower must be a number.";
        }

        if (count($errors) === 0) {
            $host = "localhost";
            $user = "student1";
            $pass = "pass";
            $dbname = "baseball_01";

            $conn = mysqli_connect($host, $user, $pass, $dbname);

            if (!$conn) {
                die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
            }

            
			// checkbox that is not checked will not get sent to browser at all. so the isset is how I detect the not checked rather than looking for a false value
            $isManual = isset($_POST["is_manual"]) ? 1 : 0;

            $stmt = mysqli_prepare($conn, "INSERT INTO bmw_models
                (model_name, chassis_code, model_year, engine_code, horsepower, is_manual)
                VALUES (?, ?, ?, ?, ?, ?)");

            mysqli_stmt_bind_param(
                $stmt,
                "ssisii",
                $_POST["model_name"],
                $_POST["chassis_code"],
                $_POST["model_year"],
                $_POST["engine_code"],
                $_POST["horsepower"],
                $isManual
            );

            if (mysqli_stmt_execute($stmt)) {
                echo "<p class='success'>Record added successfully!</p>";
            } else {
                echo "<p class='error'>Error adding record: " . mysqli_stmt_error($stmt) . "</p>";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "<h2 class='error'>Please fix the following:</h2>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li class='error'>$error</li>";
            }
            echo "</ul>";
        }
    }
?>

<form method="post" action="MaxForms.php">

    <label for="model_name">Model Name:</label>
    <input type="text" id="model_name" name="model_name" placeholder="e.g. M3">

    <label for="chassis_code">Chassis Code:</label>
    <input type="text" id="chassis_code" name="chassis_code" placeholder="e.g. G80">

    <label for="model_year">Model Year:</label>
    <input type="number" id="model_year" name="model_year" placeholder="e.g. 2021">

    <label for="engine_code">Engine Code:</label>
    <input type="text" id="engine_code" name="engine_code" placeholder="e.g. S58">

    <label for="horsepower">Horsepower:</label>
    <input type="number" id="horsepower" name="horsepower" placeholder="e.g. 473">

    <label for="is_manual">
        <input type="checkbox" id="is_manual" name="is_manual" value="1">
        Manual transmission available
    </label>

    <br><br>
    <input type="submit" value="Add Record">

</form>

</body>
</html>