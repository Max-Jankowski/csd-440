<!--
Max Jankowski 
Bellevue University 
CSD440 Module 10
Json Assignment 
-->

<!DOCTYPE html>
<html>
<head>
    <title>Max's JSON Form</title>
    <style> <!--in file styling  -->
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input, select, textarea {
            padding: 6px;
            width: 250px;
            margin-top: 4px;
        }
        input[type="submit"] {
            margin-top: 20px;
            width: auto;
            padding: 8px 20px;
        }
    </style>
</head>
<body>

<h1>Student Profile Form</h1>

<!--
	This it s the form that will collect the 8 fields from the user. this info is then used in the MaxJSON file that looks at and verifies 
	correct field info and converts it to JSON. Here im using method=post to make the data move in the req body instead of showing in url 
-->
<form method="post" action="MaxJSON.php">

    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName">

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName">

    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email">

    <label for="age">Age:</label>
    <input type="number" id="age" name="age">

    <label for="birthdate">Birth Date:</label>
    <input type="date" id="birthdate" name="birthdate">

    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" placeholder="555-123-4567">

    <label for="experience">Programming Experience:</label>
    <select id="experience" name="experience">
        <option value="">-- Select --</option>
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
    </select>

    <label for="comments">Comments:</label>
    <textarea id="comments" name="comments" rows="4"></textarea>

    <input type="submit" value="Submit Form">

</form>

</body>
</html>