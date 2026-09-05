<!--
Max Jankowski 
CSD-440 Bellevue University 
Module 6 assignment 
 -->


<!DOCTYPE html>
<html>
<head>
    <title>Max's MyInteger Class</title>
    <style><!-- Simple in file styles. figure this is more streamlined then sending a file with a seperate css folder-->
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

<h1>MyInteger Class Test</h1>

<?php
  
	 // nameing the class as specified by the assignment.
	 // the class holds an integer and has methods to test if its even, odd or prime. 
    class MaxMyInteger {
        // The integer value held by this instance
        private $value;
		
        
		 // the constructor that sets the value by way of parameter
        public function __construct($value) {
            $this->value = $value;
        }

        
		 //getter that returns the stored value
        public function getValue() {
            return $this->value;
        }

        
		 // updating stored value with this setter, generally very similar to java 
        public function setValue($value) {
            $this->value = $value;
        }

     
		// basic calculation to check if the number is even. stored in a bool and returns true is the number devides by 2 and has no remainder
        public function isEven($num) {
            return $num % 2 === 0;
        }

       
		 // calculation to check for odd number and remainer of not 0 means true, the number is odd
        public function isOdd($num) {
            return $num % 2 !== 0;
        }

      
		 // I used a geek for geek resource here. not sure why, need to face palm once I realized that his was easy. 
		 // It was a long night last night. https://www.geeksforgeeks.org/php/php-check-number-prime/
        public function isPrime() {
            $num = $this->value;

            // Numbers less than 1 are never prime
            if ($num < 1) {
                return false;
            }

            // Check for any divisor between 2 and the square root of the number.
            // If one divides evenly, it's not prime.
            for ($i = 2; $i <= sqrt($num); $i++) {
                if ($num % $i === 0) {
                    return false;
                }
            }

            return true;
        }
    }

    // Helper to turn a boolean result into a readable string
    function boolToText($value) {
        return $value ? "True" : "False";
    }

    // Create two instances with different starting values
    $intA = new MaxMyInteger(17);
    $intB = new MaxMyInteger(24);
?>

<h2>Instance A (starting value: 17)</h2>
<table> <!--building tables with stored results. this is done using html  
			Though this was not a requirment directly, seeign the pattern of the last 
			several weeks, I assume is the case. --> 
    <tr><th>Method</th><th>Result</th></tr>
    <tr><td>getValue()</td><td><?php echo $intA->getValue(); ?></td></tr>
    <tr><td>isEven(17)</td><td><?php echo boolToText($intA->isEven(17)); ?></td></tr>
    <tr><td>isOdd(17)</td><td><?php echo boolToText($intA->isOdd(17)); ?></td></tr>
    <tr><td>isPrime()</td><td><?php echo boolToText($intA->isPrime()); ?></td></tr>
</table>

<h2>Instance B (starting value: 24)</h2>
<table>
    <tr><th>Method</th><th>Result</th></tr>
    <tr><td>getValue()</td><td><?php echo $intB->getValue(); ?></td></tr>
    <tr><td>isEven(24)</td><td><?php echo boolToText($intB->isEven(24)); ?></td></tr>
    <tr><td>isOdd(24)</td><td><?php echo boolToText($intB->isOdd(24)); ?></td></tr>
    <tr><td>isPrime()</td><td><?php echo boolToText($intB->isPrime()); ?></td></tr>
</table>

<h2>Testing the Setter</h2>
<?php
    // Change instance B's value and re-test to confirm setValue() works
    $intB->setValue(13);
?>
<table>
    <tr><th>Method</th><th>Result</th></tr>
    <tr><td>setValue(13) then getValue()</td><td><?php echo $intB->getValue(); ?></td></tr>
    <tr><td>isPrime() after change</td><td><?php echo boolToText($intB->isPrime()); ?></td></tr>
</table>

</body>
</html>