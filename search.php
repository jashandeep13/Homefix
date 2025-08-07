<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.php");
    exit();
}

$city = $_POST['city'];
$service = $_POST['service_type'];
$area = $_POST['area'];

$sql = "SELECT * FROM service_providers WHERE city='$city' AND service_type='$service'";

if (!empty($area)) {
    $sql .= " AND area='$area'";
}
// $sql = "SELECT * FROM service_providers WHERE city LIKE '%$city%' AND service_type='$service'";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results - <?= $service ?></title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">🔍 Results for <strong><?= $service ?></strong> in <strong><?= $city ?></strong></h2>

    <?php if(mysqli_num_rows($result) > 0) { ?>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5 class="card-title mb-1"><?= $row['name'] ?></h5>
                        <p class="mb-1">📞 <strong><?= $row['phone'] ?></strong></p>
                        <p class="mb-1">📍 <?= $row['area'] ?>, <?= $row['city'] ?></p>
                        <p class="mb-0">📝 <?= $row['description'] ?></p>
                        <p class="mb-1">
                            ⭐ Rating: 
                            <?php $stars = $row['rating'];
                            for($i = 0; $i < $stars; $i++) {
                                echo '⭐';
                            }
                            if($stars == 0) echo 'No rating';
                            ?>
                        </p>

                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning text-center">
            No results found for your search. Please try a different city or service.
        </div>
    <?php } ?>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">🔙 Back to Search</a>
    </div>
</div>

</body>
</html>
