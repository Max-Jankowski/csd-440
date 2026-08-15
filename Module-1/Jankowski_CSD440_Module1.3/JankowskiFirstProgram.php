<!DOCTYPE html>
<!--
Max Jankowski 
Bellevue University 
CSD-450 Module 1.30
-->
<html>
<head>
    <title>Max's First PHP Program Using XAMPP</title>
</head>
<body>

<?php
    // first php snippet, Im using basic output in leu of basic html output. 
    echo "<h1>Hello, welcome to my first PHP program!</h1>";
	
	// show 2 ways to perform a display function in php 
	print "<h1>I hope to you enjoy your stay, please stay awhile!</h1>";
?>

<p>Here's a simple calculation done in PHP:</p>

<?php
    // short php snippet using php to perform a simple calculation
    $num1 = 12;
    $num2 = 8;
    $sum = $num1 + $num2;
    echo "<p>The sum of $num1 and $num2 is: $sum</p>";
?>

</body>
<!--
I didnt go overboard with the code here, just performing the tasks requried to show that I understand the 
environment that we will be working in. 

As resources are concerned I did go much beyoond the course resources and W3 schools for the basics of php
-->
</html>