<!--
Max Jankowski 
Bellevue University
CSD-440 Module 9
-->

<!DOCTYPE html>
<html>
<head>
    <title>Max's Search Page</title>
    <style><!-- As always a simple in page style to cut down on files needed -->
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
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        td, th {
            border: 1px solid black;
            padding: 8px 16px;
            text-align: left;
        }
        select, input[type="text"] {
            padding: 5px;
            width: 200px;
        }
    </style>
</head>
<body>

<h1>Search BMW Records</h1>

<!-- the form that user can use to pick which column to look into and what value to search for. this used the get method, unlike the add record form. the search page results are safe to show in the url due to this method  -->
<form method="get" action="MaxSearch.php">
    <label for="column">Search by:</label>
    <select id="column" name="column">
        <option value="model_name">Model Name</option>
        <option value="chassis_code">Chassis Code</option>
        <option value="model_year">Model Year</option>
        <option value="engine_code">Engine Code</option>
        <option value="horsepower">Horsepower</option>
    </select>

    <label for="value">Value contains:</label>
    <input type="text" id="value" name="value">

    <input type="submit" value="Search">
</form>

<?php
    $host = "localhost";
    $user = "student1";
    $pass = "pass";
    $dbname = "baseball_01";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
    }

    // Only run a search if the form has actually been submitted. the isset() will check the field, since that specfic field always will have a value from a dropdown.  
    if (isset($_GET["column"]) && isset($_GET["value"])) {
        
		// a list of column names the user can look through. this s a safety approuch as to not insert $_GET data into the column directly. rather the check is made on the submitted column against the fixed list. 
		// this deters the injection of arbitrary sql through a dropdown value 
        $allowedColumns = array("model_name", "chassis_code", "model_year", "engine_code", "horsepower");
        $column = $_GET["column"];
        $searchValue = trim($_GET["value"]);

        if (!in_array($column, $allowedColumns)) {
            echo "<p>Invalid search field selected.</p>";
        } else {
			
            // The column name is safe so it's fine to build it into the SQL string directly. In theory only the actual searched value goes through the ? placeholder below.
            $sql = "SELECT * FROM bmw_models WHERE $column LIKE ?";
            $stmt = mysqli_prepare($conn, $sql);

            if (!$stmt) {
                die("<p>Prepare failed: " . mysqli_error($conn) . "</p>");
            }

            // Wrapping the value in % allows partial matches, so searching "M3" will match "M3", but something like just he number "3".
            $likeValue = "%" . $searchValue . "%";
            mysqli_stmt_bind_param($stmt, "s", $likeValue);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            echo "<h2>Results for $column containing \"$searchValue\"</h2>";

            if (mysqli_num_rows($result) === 0) {
                echo "<p>No matching records found.</p>";
            } else {
                echo "<table>";
                echo "<tr><th>ID</th><th>Model</th><th>Chassis</th><th>Year</th><th>Engine</th><th>HP</th><th>Manual</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["model_name"] . "</td>";
                    echo "<td>" . $row["chassis_code"] . "</td>";
                    echo "<td>" . $row["model_year"] . "</td>";
                    echo "<td>" . $row["engine_code"] . "</td>";
                    echo "<td>" . $row["horsepower"] . "</td>";
                    echo "<td>" . ($row["is_manual"] ? "Yes" : "No") . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
?>

 <p> List of links to rest of the pages for the assignment </p>
<nav>
    <a href="MaxIndex.php">Home</a> |
    <a href="MaxCreateTable.php">Create Table</a> |    
    <a href="MaxQueryTable.php">Test Queries</a> |
    <a href="MaxSearch.php">Search Records</a> |
    <a href="MaxForms.php">Add a Record</a> |
    <a href="MaxDropTable.php">Drop Table</a>
</nav>


</body>
</html>