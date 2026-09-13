<!-- 
Max Jankowski 
Bellevue University
CSD440 Module 7 Response file
-->

<!DOCTYPE html>
<html>
<head>
    <title>Max's Form Response</title>
    <style> <!-- Again, just a simple page styling -->
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
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
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
    
	 // this aray collects any validation problems found. Should it be empty after all the checks, then the data was good and a succes table will print.  	 
    $errors = array();

    // $_POST is PHP's built-in superglobal array that holds all
    // the form data sent via method="post". Each field's "name"
    // attribute becomes a key in this array.
    
	// first check to make sure every field has an input. The trim() removes whitespaces so space bar is not a valid inpt
    $requiredFields = array("fullName", "email", "age", "birthdate", "phone", "gender", "comments");

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === "") {
            $errors[] = "The field '$field' was left empty.";
        }
    }
    
	// This check only runs for the email field to make sure that it has something valid in it. 
    if (isset($_POST["email"]) && trim($_POST["email"]) !== "") {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) { //the filter of FILTER_VALIDATE_EMAIL is a great built in that ensures that the input is in a valid format. Makes it easy 
            $errors[] = "The email address entered is not valid.";
        }
    }

    // The third check ensures that age is a whole number, so 42 and a half doesnt work. your an adult
    if (isset($_POST["age"]) && trim($_POST["age"]) !== "") {
        if (!is_numeric($_POST["age"]) || $_POST["age"] < 0 || $_POST["age"] > 120) { //is_numeric makes sure is a number not something like a letter. the range check makes sure its believable
            $errors[] = "Age must be a number between 0 and 120.";
        }
    }
   
	// the last offical check here makes sure that the phone number has digits dashes and so forth. Not an exhaustive check, 
	// so user can input number based on local custom rather then a hard and fact 10 digit rule 
    if (isset($_POST["phone"]) && trim($_POST["phone"]) !== "") {
        if (!preg_match("/^[0-9\-\s\(\)]+$/", $_POST["phone"])) {
            $errors[] = "Phone number contains invalid characters.";
        }
    }

    // Now we decide which page to show based on whether $errors has anything in it.
    if (count($errors) > 0) {
?>

    <h1 class="error">There was a problem with your submission</h1>
    <p>Please go back and correct the following:</p>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li class="error"><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="MaxForm.html">Return to the form</a></p> <!--Pulling info from the form html -->

<?php
    } else {
?>

    <h1>Thank You! Here's What You Submitted:</h1> <!--Simple HTML table to display output  -->
    <table>
        <tr><th>Field</th><th>Value</th></tr>
        <tr><td>Full Name</td><td><?php echo htmlspecialchars($_POST["fullName"]); ?></td></tr>
        <tr><td>Email</td><td><?php echo htmlspecialchars($_POST["email"]); ?></td></tr>
        <tr><td>Age</td><td><?php echo htmlspecialchars($_POST["age"]); ?></td></tr>
        <tr><td>Birth Date</td><td><?php echo htmlspecialchars($_POST["birthdate"]); ?></td></tr>
        <tr><td>Phone</td><td><?php echo htmlspecialchars($_POST["phone"]); ?></td></tr>
        <tr><td>Gender</td><td><?php echo htmlspecialchars($_POST["gender"]); ?></td></tr>
        <tr><td>Comments</td><td><?php echo htmlspecialchars($_POST["comments"]); ?></td></tr>
    </table>

<?php
    }
?>

</body>
</html>