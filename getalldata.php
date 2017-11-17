<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
require("connect.php");

$sql = "SELECT description FROM cs_entry";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = "";
    while($row = $result->fetch_assoc()) {
        $data .= strip_tags($row['description']) . "\n";
    }
    echo $data;
    $myfile = fopen("alldata.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $data);
    fclose($myfile);
} else {
    echo "0 results";
}

$conn->close();
?>

</body>
</html>