<!--
Max Jankowski
Bellevue University
CSD-440 Module 3
-->

<!DOCTYPE html>
<html>
<head>
    <title> Max's Random Number Table </title>
	<style> <!-- Added style directly to this code rather then a seperate styles file. I felt there was no need for another file just to format the compact table.  -->
        table {
            border-collapse: collapse;
            margin: 20px;
        }
        td {
            border: 1px solid black;
            padding: 15px 25px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Random Number Table</h1>

<?php
    // Modifing the file from module 2 to 'require' the php file in the folder that hold the function 
    require 'JankowskiFunction.php';

    // defining the dimensions of th etable 5 x 5
    $rows = 5;
    $cols = 5;
?>

<table border="1">
	<caption>
	Really simple number generater inside a table!
	</caption>
    <?php for ($i = 0; $i < $rows; $i++): ?>
        <tr>							
            <?php for ($j = 0; $j < $cols; $j++): ?>
                <td> <!-- Making the table using html -->
                    <?php
                        // Modification to mod 2 code to generate two rand numbers
                        $numA = rand(1, 100);
                        $numB = rand(1, 100);

                        // modified code used to call the function and file that holds it. This function gets the summ to the 2 random numbers 
                        $cellValue = calculateSum($numA, $numB);
                        echo $cellValue;
                    ?>
                </td>
            <?php endfor; ?> <!-- Ending the for loop -->
        </tr>
    <?php endfor; ?> 
</table>

</body>
</html>