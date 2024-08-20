<?php

// Check if all required POST data are set
if (
    isset($_POST['TKno']) &&
    isset($_POST['Observations']) &&
    isset($_POST['WO']) &&
    isset($_POST['Status']) &&
    isset($_POST['Typeofdefects']) &&
    isset($_POST['Assignedto']) &&
    isset($_POST['Lastmonthchecked']) &&
    isset($_POST['NextDuedate']) &&
    isset($_POST['TestedBy']) &&
    isset($_POST['ETC']) &&
    isset($_POST['Typeoftank']) &&
    isset($_POST['Tankservice']) &&
    isset($_POST['Petroleumclass'])
) {
    // Assign POST values to variables
    $TKno = $_POST['TKno'];
    $Observations = $_POST['Observations'];
    $WO = $_POST['WO'];
    $Status = $_POST['Status'];
    $Typeofdefects = $_POST['Typeofdefects'];
    $Assignedto = $_POST['Assignedto'];
    $Lastmonthchecked = $_POST['Lastmonthchecked'];
    $NextDuedate = $_POST['NextDuedate'];
    $TestedBy = $_POST['TestedBy'];
    $ETC = $_POST['ETC'];
    $Typeoftank = $_POST['Typeoftank'];
    $Tankservice = $_POST['Tankservice'];
    $Petroleumclass = $_POST['Petroleumclass'];
    
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO registration (TKno, Observations, WO, Status, Typeofdefects, Assignedto, Lastmonthchecked, NextDuedate, TestedBy, ETC, Typeoftank, Tankservice, Petroleumclass) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $TKno, $Observations, $WO, $Status, $Typeofdefects, $Assignedto, $Lastmonthchecked, $NextDuedate, $TestedBy, $ETC, $Typeoftank, $Tankservice, $Petroleumclass);
    
    $inserted = $stmt->execute();
    if ($inserted) {
        echo "Registration successful.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Error: Missing POST data.";
}
?>
