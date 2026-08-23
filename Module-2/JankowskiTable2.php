<!--
Max Jankowski
Bellevue University
CSD-440 Module 2
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
                        // php function to generate a random number inside of a html table 
                        $randomNum = rand(1, 100);
                        echo $randomNum;
                    ?>
                </td>
            <?php endfor; ?> <!-- Ending the for loop -->
        </tr>
    <?php endfor; ?> 
</table>

</body>
</html>