<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product_style.css">
    <style>
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
<?php
require "config.php";
$sql = "SELECT * FROM product WHERE fcat='ice_cream'";
$result = mysqli_query($conn, $sql) or die("Query Failed.");
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='center'><table>";
        echo "<br><img src='data:image/jpg;chatset=utf8;base64,".base64_encode($row['fimage'])."'>";
        echo "<p>".$row['fname']."</p>";
        echo "<p>$".$row['fprice']."</p>";
        echo "<p>".$row['fdis']."</p>";
        echo "</table></div>";
    }
} else{
    echo '<div class="alert alert-danger">Item is empty.</div>';
}          
?>
</body>
</html>
