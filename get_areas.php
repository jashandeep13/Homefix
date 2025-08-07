<?php
include 'includes/db.php';

$city = $_GET['city'];

$sql = "SELECT DISTINCT area FROM service_providers WHERE city = '$city'";
$result = mysqli_query($conn, $sql);

$areas = [];

while($row = mysqli_fetch_assoc($result)) {
    $areas[] = $row['area'];
}

echo json_encode($areas);
?>
