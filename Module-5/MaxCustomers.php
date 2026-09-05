<!DOCTYPE html>
<html>
<head>
    <title>Max's Customer Array</title>
    <style> <!-- Simple in file styles. figure this is more streamlined then sending a file with a seperate css folder-->
        table {
            border-collapse: collapse;
            margin: 20px;
        }
        td, th {
            border: 1px solid black;
            padding: 8px 16px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Customer Records</h1>

<?php
    /**
      Array of customer records included 10 plus myself. every customer entry has the required info 
	  Added spacing to code to make it more managable when typing the code in. Also it looks nicer
     */
    $customers = array(
        array("firstName" => "Max",     "lastName" => "Jankowksi",    "age" => 42, "phone" => "606-9595"),
        array("firstName" => "Susan",   "lastName" => "Johnson", 	  "age" => 28, "phone" => "555-1035"),
        array("firstName" => "Larry",   "lastName" => "Williams", 	  "age" => 45, "phone" => "555-1924"),
        array("firstName" => "Jerry",   "lastName" => "Garcia",       "age" => 31, "phone" => "555-1788"),
        array("firstName" => "James",   "lastName" => "Brown",        "age" => 52, "phone" => "555-3235"),
        array("firstName" => "Linda",   "lastName" => "Davis",        "age" => 39, "phone" => "555-1614"),
        array("firstName" => "Dennis",  "lastName" => "Miller",       "age" => 27, "phone" => "555-8953"),
        array("firstName" => "Patrick", "lastName" => "Wilson",       "age" => 61, "phone" => "555-1023"),
        array("firstName" => "Mike",    "lastName" => "Moore",        "age" => 22, "phone" => "555-5689"),
        array("firstName" => "Barb",    "lastName" => "Taylor",       "age" => 44, "phone" => "555-1555"),
        array("firstName" => "David",   "lastName" => "Anderson",     "age" => 36, "phone" => "555-1233")
    );

    
	 // to display a set of customer results in the html table.
	 // keeping logic in a single section as opposed to repeatin the table markup for every result 
    function displayCustomers($results) {
        echo "<table>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Age</th><th>Phone</th></tr>";
        foreach ($results as $customer) {
            echo "<tr>";
            echo "<td>" . $customer["firstName"] . "</td>";
            echo "<td>" . $customer["lastName"] . "</td>";
            echo "<td>" . $customer["age"] . "</td>";
            echo "<td>" . $customer["phone"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>

<h2>All Customers</h2>
<?php displayCustomers($customers); ?>

<h2>Search: Customers Age 40 or Older</h2>
<?php
	// There are only 4 fields to search from. The obvious first one would be Age. 
	// So here the test checks the customers' age and compares against '40'
    $olderCustomers = array_filter($customers, function ($customer) {
        return $customer["age"] >= 40;
    });
    displayCustomers($olderCustomers);
?>

<h2>Search: Customer by Last Name ("Wilson")</h2>
<?php
	// using array_filter again, though this time Im looking at text instaed of a number 
	// array_values reindexes so it starts at 0, filter perserves the og array keys 
    $byLastName = array_values(array_filter($customers, function ($customer) {
        return $customer["lastName"] === "Wilson";
    }));
    displayCustomers($byLastName);
?>

<h2>Customers Sorted by Age (Youngest to Oldest)</h2>
<?php
	// Going back to ages here and using usort as opposed to standard compare function: https://www.php.net/manual/en/function.usort.php
	//returns negative, positive and zero to tell usort which of the values comes first 
    $sortedByAge = $customers;
    usort($sortedByAge, function ($a, $b) {
        return $a["age"] - $b["age"];
    });
    displayCustomers($sortedByAge);
?>

</body>
</html>