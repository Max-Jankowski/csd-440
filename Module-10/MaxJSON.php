<!--
Max Jankowski 
Bellevue University 
CSD440 Module 10
Json Assignment 

-->


<!DOCTYPE html>
<html>
<head>
    <title>Max's JSON Response</title>
    <style<!-- Even more in page styling, can't get enough of it. Also super simple -->
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
        pre {
            background-color: #f4f4f4;
            border: 1px solid #999;
            padding: 15px;
            display: inline-block;
            min-width: 350px;
        }
    </style>
</head>
<body>

<?php
  
	// receiving the 8 required fields from the MaxFormat file, validates them here. If all checks out 
	// converts data to JSON using the required json_encode() and also displays results. 
	// triggers error if any fied requires it. 

    // Collects every problem found so we can show them all at once
    $errors = array();

    // The name of the attributes from the form.php, used a loop in the checks
    $requiredFields = array("firstName", "lastName", "email", "age",
                            "birthdate", "phone", "experience", "comments");
   
    // checking to see if every field is filled out, which can be annoying for the comment field. 
	// but for ease using trim() to remove whitespace so a field with only spaces still counts as empty.
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === "") {
            $errors[] = "The field '$field' was left empty.";
        }
    }
    
    // Checking the email format, pretty basic only checked if the field wasn't already flagged as empty.
    if (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "The email address is not in a valid format.";
    }
	
	// FILTER_VALIDATE_INT is used here, returns false if the value isn't a clean integer. Options array allows me to set the min/max range in one step.
    if (!empty($_POST["age"])) {
        $ageCheck = filter_var($_POST["age"], FILTER_VALIDATE_INT,
                    array("options" => array("min_range" => 0, "max_range" => 120)));
        if ($ageCheck === false) {
            $errors[] = "Age must be a whole number between 0 and 120.";
        }
    }

	// simple characters check here, can only have digits, dashes, spaces, parentheses.  
    if (!empty($_POST["phone"]) && !preg_match("/^[0-9\-\s\(\)]+$/", $_POST["phone"])) {
        $errors[] = "Phone number contains invalid characters.";
    }

    // Decides which page to show, errors or the JSON output
    if (count($errors) > 0) {
?>

    <h1 class="error">There was a problem with your submission</h1>
    <p>Please go back and fix the following:</p>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li class="error"><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
    <p><a href="MaxJSONForm.php">Return to the form</a></p>

<?php
    } else {
        // Building an 'associative' array of the cleaned-up data. Array keys become the JSON keys. I'm setting age as an integer with (int) so it shows up in the JSON as a number
        // so 42 and not as a string ("42"), since i found out $_POST values are always strings by default.
        $data = array(
            "firstName"  => trim($_POST["firstName"]),
            "lastName"   => trim($_POST["lastName"]),
            "email"      => trim($_POST["email"]),
            "age"        => (int) $_POST["age"],
            "birthdate"  => $_POST["birthdate"],
            "phone"      => trim($_POST["phone"]),
            "experience" => $_POST["experience"],
            "comments"   => trim($_POST["comments"])
        );

        // json_encode() is used to convert the php array into a JSON string. JSON_PRETTY_PRINT adds line breaks and indentation so it's formated to be more readable on the page instead of one long line.
        $json = json_encode($data, JSON_PRETTY_PRINT);

        // json_encode will returns false if something goes wrong,so we check before trying to display it.
        if ($json === false) {
?>
            <h1 class="error">JSON encoding failed</h1>
            <p class="error"><?php echo htmlspecialchars(json_last_error_msg()); ?></p>
            <p><a href="MaxJSONForm.php">Return to the form</a></p>
<?php
        } else {
?>
            <h1>Your Data in JSON Format</h1>
            <!--keeps the line breaks and spacing from JSON_PRETTY_PRINT. htmlspecialchars() makes sure anythingin the form displays as plain text.   -->
            <pre><?php echo htmlspecialchars($json); ?></pre>
            <p><a href="MaxJSONForm.php">Submit another entry</a></p>
<?php
        }
    }
?>

</body>
</html>