<!--
Max Jankowski 
Bellevue University 
CSD440
Module 8 Drop Table file, Modified with link for Mod 11
--> 

<!DOCTYPE html>
<html>
<head>
    <title>Max's Drop Table</title>
</head>
<body>

<h1>Drop Table: bmw_models</h1><br>

<hr>

<h2>Click the link below to move to the next step</h2><br>

<nav>
  
    <a href="MaxPopulateTable.php">Populate Table</a> 
	<a href="MaxPDF.php" target="_blank" rel="noopener">View PDF Report</a>
	
</nav>


<?php
   
	 // connects to the baseball_01db and deletes the bmw_models table. this includes the data held within 
    $host = "localhost";
    $user = "student1";
    $pass = "pass";
    $dbname = "baseball_01";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        die("<p>Connection failed: " . mysqli_connect_error() . "</p>");
    }

    // the "IF EXISTS" prevents an error if the table was already been deleted of never existed 
    $sql = "DROP TABLE IF EXISTS bmw_models";

    if (mysqli_query($conn, $sql)) {
        echo "<p>Table 'bmw_models' dropped successfully.</p>";
    } else {
        echo "<p>Error dropping table: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
?>

</body>
</html>