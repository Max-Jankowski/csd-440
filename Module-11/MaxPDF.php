<?php
/*
Max Jankowski
Bellevue University
CSD440
Module 11 PDF file  
*/


// This is a raw php file that prints a pdf. So there is nothing to view. Rather I will attach a link to the other pages for loading and seeing the pdf 
// on another tab as was presented in the module videos 

// pulling the FPDF library from the fpdf folder inside htdocs folder. its in the fpdf folder not an app folder 
require('fpdf/fpdf.php');

// Extending FPDF so I can customize the page header and footer. this is pulled from the tutorial pages in the fpsf folder itself. pretty useful. 
// FPDF calls header automatically at the top of every page, and footer at the bottom, so I never have to call them myself.
class MaxPDF extends FPDF {

    //  the page header report title and my name
    function Header() {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'BMW M Models Report', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 6, 'Max Jankowski - CSD440', 0, 1, 'C');
        $this->Ln(6); // blank space under the header
    }
	
	// simple page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Used the baseball01 DB and the created in mod 8 bmw models table.', 0, 0, 'C');
    }
}

// getting data from the Module 8 table 
$host = "localhost";
$user = "student1";
$pass = "pass";
$dbname = "baseball_01";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM bmw_models ORDER BY model_year");

// If the table doesn't exist yet this fails, so I check before trying to make the pdf. so it runs my create and populate first 
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Pulling rows into an array so I can close the connection right away, as well as I can count rows and average the horsepower later.
$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
mysqli_close($conn);

//next i need to build the actual pdf
$pdf = new MaxPDF();
$pdf->AddPage();

// General info, more of a filler for the pdf so its not just table  
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'About the Topic: BMW M Cars', 0, 1);

$pdf->SetFont('Arial', '', 11);
$pdf->MultiCell(0, 6,
    "BMW M is the high-performance division of BMW. This report lists " .
    "M3 and M5 models from the bmw_models table. Each car has a chassis " .
    "code and an engine code.");
$pdf->Ln(8);

// Column widths. These add up to 190mm and is a usable width of an A4 page with bleed on both sides 
$w = array(15, 30, 30, 25, 30, 30, 30);

// Table header row has a gray background. the fill is on from the 'true'
$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(200, 200, 200);
$heads = array('ID', 'Model', 'Chassis', 'Year', 'Engine', 'HP', 'Manual');
for ($i = 0; $i < count($heads); $i++) {
    $pdf->Cell($w[$i], 8, $heads[$i], 1, 0, 'C', true);
}
$pdf->Ln();

// Table data rows. $fill flips each row so the shading alternates, which makes the rows easier to follow across the page.
// needed some help to solve this problem, the in folder guides didn't provide help. serached stackoverflow. below is the link. 
// https://stackoverflow.com/questions/41639105/adding-colours-to-table-rows-in-a-pdf-generated-bt-fpdf-php
$pdf->SetFont('Arial', '', 11);
$pdf->SetFillColor(240, 240, 240);
$fill = false;
$totalHP = 0;

foreach ($rows as $r) {
    $pdf->Cell($w[0], 8, $r['id'], 1, 0, 'C', $fill);
    $pdf->Cell($w[1], 8, $r['model_name'], 1, 0, 'C', $fill);
    $pdf->Cell($w[2], 8, $r['chassis_code'], 1, 0, 'C', $fill);
    $pdf->Cell($w[3], 8, $r['model_year'], 1, 0, 'C', $fill);
    $pdf->Cell($w[4], 8, $r['engine_code'], 1, 0, 'C', $fill);
    $pdf->Cell($w[5], 8, $r['horsepower'], 1, 0, 'C', $fill);
    $pdf->Cell($w[6], 8, ($r['is_manual'] ? 'Yes' : 'No'), 1, 0, 'C', $fill); // if the car is manual is stored as 1 or 0 for true false. so I made it readable
    $pdf->Ln();

    $totalHP += $r['horsepower'];
    $fill = !$fill;
}

// Table footer row is total record count and average horsepower. I just felt like I needed something down here. 
$count = count($rows);
$avgHP = ($count > 0) ? round($totalHP / $count) : 0;

$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(100, 8, 'Total records: ' . $count, 1, 0, 'L', true);
$pdf->Cell(90, 8, 'Average horsepower: ' . $avgHP, 1, 1, 'R', true);

// the 'I' shows the PDF inline with the browser instead of downloading
$pdf->Output('I', 'MaxPDF.pdf');