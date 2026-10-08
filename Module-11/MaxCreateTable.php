<!--
Max Jankowski 
Bellevue University 
CSD440
Module 8 Create Table file Modified for module 11
--> 

<!DOCTYPE html>
<html>
<head>
    <title>Max's Create Table</title>
</head>
<body>

<h1>Create Table: bmw_models</h1><br>

<hr>

<h2>Click the link below to move to the next step</h2><br>

<nav>
    
    <a href="MaxPopulateTable.php">Populate Table</a>  
	<a href="MaxPDF.php" target="_blank" rel="noopener">View PDF Report</a>
  
</nav>
<?php
	// Yes its called baseball_01 as the assignments instructs, but the general interest topic its about BMWs. So I brought my day job into this . 
	//Im assuming this is because you want it to load into an already created database and just have the program load the table. 
	

    // Connection details same database used across all the scripts in this assignment 
    $host = "localhost";
    $user = "student1";
    $pass = "pass";
    $dbname = "baseball_01"; // Named it this due to instructions. it would make sense to call it bmw_01 but Im worried about weather this is a hard and fast order. 

	// using mysqli_connect to open connection, returns false if failed rather then having an error so its something to check for 
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
    }

	// sql will create this table if it doesent exist. used this like in all projects to prevent a script from running twice. 
    $sql = "CREATE TABLE IF NOT EXISTS bmw_models (
        id INT AUTO_INCREMENT PRIMARY KEY,
        model_name VARCHAR(50) NOT NULL,
        chassis_code VARCHAR(10) NOT NULL,
        model_year INT NOT NULL,
        engine_code VARCHAR(10) NOT NULL,
        horsepower INT NOT NULL,
        is_manual TINYINT(1) NOT NULL
    )";

   
	// mysql query() will run the db and return true or false for the statments 
    if (mysqli_query($conn, $sql)) {
        echo "<p>Table 'bmw_models' created successfully.</p>";
    } else {
        echo "<p>Error creating table: " . mysqli_error($conn) . "</p>";
    }

    // as a best practice closing the connection when the script is done
    mysqli_close($conn);
?>


</body>
</html>