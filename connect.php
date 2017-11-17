<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "lavida_com_dev";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset('utf8');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT description FROM cs_entry LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row['description'];
    }
} else {
    echo "0 results";
}

$conn->close();