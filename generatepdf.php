<?php
require('./fpdf/fpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform SQL query
$sql = "SELECT `TKno`, `Observations`, `WO`, `Status`, `Typeofdefects`, `Assignedto`, `Lastmonthchecked`, `Nextduedate`, `TestedBy`, `ETC`, `Typeoftank`, `Tankservice`, `Petroleumclass` FROM registration";
$result = $conn->query($sql);

// Check query execution
if ($result === false) {
    die('Error executing the query: ' . $conn->error);
}

$data = []; // Initialize an empty array

// Fetch data into array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // Collect each row into $data array
    }
} else {
    echo "0 results";
}

// Close MySQL connection
$conn->close();

class PDF extends FPDF {
    function Header(){
        // Implement custom header
        $this->Image('image.png',10,5,20);
        $this->SetFont('Arial','B',17);
        $this->Cell(65);
        $this->Cell(90,10,' Report of Water Spray System',1,0,'C');
        $this->Ln(20); // Adjust as needed
    }

    function Footer(){
        // Implement custom footer
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function FieldPair($label1, $value1, $label2 = '', $value2 = '') {
        // Display two fields side by side
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(50, 10, $label1, 1, 0, 'L');
        $this->SetFont('Arial', '', 12);
        $this->Cell(50, 10, $value1, 1, 0, 'L');
        if (!empty($label2)) {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(35, 10, $label2, 1, 0, 'L');
            $this->SetFont('Arial', '', 12);
            $this->Cell(0, 10, $value2, 1, 1, 'L');
        } else {
            $this->Ln(10); // Add extra line after single field pair
        }
    }
}

// Create PDF object
$pdf = new PDF();
$pdf->AliasNbPages();

// Output data
foreach ($data as $row) {
    $pdf->AddPage(); // Add a new page for each row
    
    // Set font
    $pdf->SetFont('Arial','',10);
    
    // Output fields
    $pdf->Ln(5);
    $pdf->FieldPair('TKno:', $row['TKno'], 'Observations:', $row['Observations']);
    $pdf->Ln(5);
    $pdf->FieldPair('WO:', $row['WO'], 'Status:', $row['Status']);
    $pdf->Ln(5);
    $pdf->FieldPair('Type of defects:', $row['Typeofdefects'], 'Assigned to:', $row['Assignedto']);
    $pdf->Ln(5);
    $pdf->FieldPair('Last month checked:', $row['Lastmonthchecked'], 'Next due date:', $row['Nextduedate']);
    $pdf->Ln(5);
    $pdf->FieldPair('Tested By:', $row['TestedBy'], 'ETC:', $row['ETC']);
    $pdf->Ln(5);
    $pdf->FieldPair('Type of tank:', $row['Typeoftank'], 'Tank service:', $row['Tankservice']);
    $pdf->Ln(5);
    $pdf->FieldPair('Petroleum class:', $row['Petroleumclass']);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output();
?>



