<!--
Max Jankowski 
Bellevue University 
CSD440
Module 8 Query tble file  Modified for module 11
--> 

<!DOCTYPE html>
<html>
<head>
    <title>Max's Query Table</title>
    <style> <!-- Style formating for page and tables-->
        table {
            border-collapse: collapse;
            margin: 20px 0;
        }
        td, th {
            border: 1px solid black;
            padding: 8px 16px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Query Table: bmw_models</h1>

<hr>

<h2>Click the Link below to drop this Table</h2><br>

<nav>

    <a href="MaxDropTable.php">Drop Table</a>
	<a href="MaxPDF.php" target="_blank" rel="noopener">View PDF Report</a>
</nav>


<?php
	// standard connections like all the others. This is to query the bmw table within the DB 
    $host = "localhost";
    $user = "student1";
    $pass = "pass";
    $dbname = "baseball_01";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
    }

    
	// Function to display the results of the queries as a table in html. 	
    function displayResults($result) {
        if (mysqli_num_rows($result) === 0) {
            echo "<p>No matching records found.</p>";
            return;
        }

        echo "<table>";

        // Print the column headers from the result set as oppsed to a hard code. Should work for any query that runs 
        $firstRow = mysqli_fetch_assoc($result);
        echo "<tr>";
        foreach ($firstRow as $column => $value) {
            echo "<th>" . $column . "</th>";
        }
        echo "</tr>";

        // Print the first row we already fetched up above...
        echo "<tr>";
        foreach ($firstRow as $value) {
            echo "<td>" . $value . "</td>";
        }
        echo "</tr>";

        // ...and now loop through the rest of the result set normally.
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
?>

<h2>Query 1: All Records</h2> <!--Prints the entire table --> 
<?php
    $result1 = mysqli_query($conn, "SELECT * FROM bmw_models");
    displayResults($result1);
?>

<h2>Query 2: Only Manual-Transmission Models</h2>  <!--this should exclude only one -->
<?php
    $result2 = mysqli_query($conn, "SELECT model_name, chassis_code, model_year FROM bmw_models WHERE is_manual = 1");
    displayResults($result2);
?>

<h2>Query 3: Models Over 400 Horsepower, Newest First</h2>
<?php
    $result3 = mysqli_query($conn, "SELECT model_name, chassis_code, horsepower FROM bmw_models WHERE horsepower > 400 ORDER BY model_year DESC");
    displayResults($result3);
?>

<?php
    mysqli_close($conn);
?>

</body>
</html>