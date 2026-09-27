<!--
Max Jankowski 
Bellevue University
CSD-440 Module 9
-->

<!DOCTYPE html>
<html>
<head>
    <title>Max's BMW Database Project</title>
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
        nav a:hover {
            text-decoration: underline;
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
    </style>
</head>
<body>

<h1>BMW Models Database Project</h1>


<p>This page links to every script in the bmw_models project, from Module 8 and Module 9 combined.</p>

<table>
    <tr><th>Page</th><th>Purpose</th></tr>
    <tr><td><a href="MaxCreateTable.php">MaxCreateTable.php</a></td><td>Creates the bmw_models table structure</td></tr>    
    <tr><td><a href="MaxQueryTable.php">MaxQueryTable.php</a></td><td>Runs a set of fixed test queries to confirm the table works</td></tr>
    <tr><td><a href="MaxSearch.php">MaxSearch.php</a></td><td>Lets a user search records based on their own form input</td></tr>
    <tr><td><a href="MaxForms.php">MaxForms.php</a></td><td>Lets a user add a new BMW record to the table</td></tr>
    <tr><td><a href="MaxDropTable.php">MaxDropTable.php</a></td><td>Drops the table entirely, for resetting during testing</td></tr>
</table>

<p> Below you have additional links that allow you to search and add items to the record  </p>

<nav>
    
    <a href="MaxSearch.php">Search Records</a> |
    <a href="MaxForms.php">Add a Record</a> |
  
</nav>

</body>
</html>