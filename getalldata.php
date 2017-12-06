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
        $str = $row['description'];
        if (strpos($str, '</style>')) {
            continue;
        }
        if (strpos($str, '</script>')) {
            continue;
        }
        $str .= strip_tags($str);

        $regex = "((https?|ftp)\:\/\/)?"; // SCHEME 
        $regex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
        $regex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
        $regex .= "(\:[0-9]{2,5})?"; // Port 
        $regex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
        $regex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
        $regex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 
        if (preg_match('/[0-9]+px/', $str)) {
            continue;
        }
        if (strpos('Version:1.0', $str)) {
            continue;
        }
        $str = preg_replace("/$regex/i", ' ' ,$str);
        $str = preg_replace("/&[a-z]+;/i", ' ' ,$str);
        $data .= strip_tags($str) . "\n";
    }
    $myfile = fopen("alldata.txt", "w") or die("Unable to open file!");
    $data = strtolower($data);
    fwrite($myfile, $data);
    fclose($myfile);
} else {
    echo "0 results";
}
echo "DONE";
$conn->close();
?>

</body>
</html>