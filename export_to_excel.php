<?php
// Start by establishing a connection to the database
$conn = mysqli_connect("localhost", "root", "", "test");

// Function to fetch data from the database
function fetchData($conn) {
    $query = "SELECT * FROM registration";
    return mysqli_query($conn, $query);
}

// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=status_of_water_spray_system.xls");

// Output data
$rows = fetchData($conn);

echo "<table border='1'>";
echo "<tr>
    <td>TKno</td>
    <td>Observations</td>
    <td>WO</td>
    <td>Status</td>
    <td>Type of defects</td>
    <td>Assigned to</td>
    <td>Last month checked</td>
    <td>Next Due date</td>
    <td>Tested By</td>
    <td>ETC</td>
    <td>Type of tank</td>
    <td>Tank service</td>
    <td>Petroleum class</td>
</tr>";
$i = 1;
foreach ($rows as $row) {
    echo "<tr>
        <td>{$row['TKno']}</td>
        <td>{$row['Observations']}</td>
        <td>{$row['WO']}</td>
        <td>{$row['Status']}</td>
        <td>{$row['Typeofdefects']}</td>
        <td>{$row['Assignedto']}</td>
        <td>{$row['Lastmonthchecked']}</td>
        <td>{$row['NextDuedate']}</td>
        <td>{$row['TestedBy']}</td>
        <td>{$row['ETC']}</td>
        <td>{$row['Typeoftank']}</td>
        <td>{$row['Tankservice']}</td>
        <td>{$row['Petroleumclass']}</td>
    </tr>";
}
echo "</table>";

// Exit script to prevent rendering the rest of the page
exit;
?>
