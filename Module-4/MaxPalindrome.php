<!--
Max Jankowski 
Bellevue University 
CSD440 Module 4 assignment 

-->

<!DOCTYPE html>
<html>
<head>
    <title>Max's Palindrome Checker</title>
    <style> <!-- Simple in html style for the table, tring to avoid sending any more files then needed for the assignment -->
        table {
            border-collapse: collapse;
            margin: 20px;
        }
        td, th {
            border: 1px solid black;
            padding: 10px 20px;
            text-align: left;
        }
    </style>
</head>
<body>

<h1>Palindrome Checking Table</h1>

<?php //start of the php section 
	
	
	// Function using php to check if the reverse of a given sttring is equal to the original string  
    function isPalindrome($str) {
        // reversing the strings in the array using PHP's built-in strrev() method 
        $reversed = strrev($str);

        // comparing the original to reversed version
        if ($str === $reversed) {
            return true;
        } else {
            return false;
        }
    }

    // adding an array of strings of which I know 3 are palindromes to test and display function 
    $testStrings = array("racecar", "level", "madam", "hello", "philosophy", "computer");
?> <!-- Endof the php section and restarting html to buld the tables--> 

<table>
    <tr>
        <th>Original</th>
        <th>Reversed</th>
        <th>Result</th>
    </tr>
    <?php foreach ($testStrings as $word): ?>
        <?php				// Php loop to perform the isPalindrome function on each word in the array above 
            $reversedWord = strrev($word);
            $isPalindrome = isPalindrome($word);
        ?>
        <tr>
            <td><?php echo $word; ?></td> <!--Looping each string in the array to have a cell for itself and is reverse to display for the user. -->
            <td><?php echo $reversedWord; ?></td>
            <td>
                <?php
                    if ($isPalindrome) {
                        echo "Palindrome";
                    } else {
                        echo "Not a Palindrome";
                    }
                ?>
            </td>
        </tr>
    <?php endforeach; ?> <!--Ending the php loop where it performs isPalindrome function on each word in the array-->
</table>

</body>
</html>