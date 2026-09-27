<!--
Max Jankowski 
Bellevue University 
CSD440
Module 8 Populate file 
--> 

<!DOCTYPE html>
<html>
<head>
    <title>Max's Populate Table</title>
</head>
<body>

<h1>Populate Table: bmw_models</h1><br>

<hr>

<h2>Click the link below to move to the next step</h2><br>

<nav>
  
    <a href="MaxQueryTable.php">Query Table</a> 
	
</nav>

<?php
    
	// connecting to the database and adding / inserting multiple rows of bmw car data in the bmw_models table. 
    $host = "localhost";
    $user = "student1";
    $pass = "pass";
    $dbname = "baseball_01";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
    }

    //This is the bmw M cars that will be inserted to the table. includes model, chassis code, year, engine code and if its a manual 
    $models = array(
        array("M3", "E30", 1988, "S14", 192, 1),
        array("M3", "E36", 1995, "S50", 240, 1),
        array("M3", "E46", 2001, "S54", 333, 1),
        array("M3", "E92", 2008, "S65", 414, 1),
        array("M3", "F80", 2015, "S55", 425, 1),
        array("M3", "G80", 2021, "S58", 473, 1),
        array("M5", "E39", 1999, "S62", 394, 1),
        array("M5", "F90", 2018, "S63", 600, 0)
    );

	// preparing insert statement, outside the loop. the question marks  serving as placeholders, need to remember to count them. 
	//this is what allows me to build it without raw string every time 
    $stmt = mysqli_prepare($conn, "INSERT INTO bmw_models
        (model_name, chassis_code, model_year, engine_code, horsepower, is_manual)
        VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("<p>Prepare failed: " . mysqli_error($conn) . "</p>");
    }

    $insertCount = 0;

    foreach ($models as $model) {        
		// first argument describes the placeholders type in order. s for string, i for int 
        mysqli_stmt_bind_param(
            $stmt,
            "ssisii",
            $model[0], $model[1], $model[2], $model[3], $model[4], $model[5]
        );

        if (mysqli_stmt_execute($stmt)) {
            $insertCount++;
        } else {
            echo "<p>Error inserting row: " . mysqli_stmt_error($stmt) . "</p>";
        }
    }

    echo "<p>$insertCount row(s) inserted successfully.</p>";

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>

</body>
</html>