<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Finder</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background: #f8f9fa;
        }
        .main-box {
            max-width: 500px;
            margin: 80px auto;
            padding: 30px;
            background: #fff;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #343a40;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="main-box">
        <h2>🔍 Find a Service Provider</h2>
        <form action="search.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Service Type:</label>
                <select name="service_type" class="form-select" required>
                    <option value="">-- Select Service --</option>
                    <option value="AC Repair">AC Repair</option>
                    <option value="Fridge Repair">Fridge Repair</option>
                    <option value="Washing Machine Repair">Washing Machine Repair</option>
                    <option value="Software Developer">Software Developer</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">City:</label>
                <select id="city" name="city" class="form-select" required>
                    <option value="">-- Select City --</option>
                    <option value="Amritsar">Amritsar</option>
                    <option value="Barnala">Barnala</option>
                    <option value="Bathinda">Bathinda</option>
                    <option value="Faridkot">Faridkot</option>
                    <option value="Fatehgarh Sahib">Fatehgarh Sahib</option>
                    <option value="Fazilka">Fazilka</option>
                    <option value="Ferozepur">Ferozepur</option>
                    <option value="Gurdaspur">Gurdaspur</option>
                    <option value="Hoshiarpur">Hoshiarpur</option>
                    <option value="Jalandhar">Jalandhar</option>
                    <option value="Kapurthala">Kapurthala</option>
                    <option value="Ludhiana">Ludhiana</option>
                    <option value="Malerkotla">Malerkotla</option>
                    <option value="Mansa">Mansa</option>
                    <option value="Moga">Moga</option>
                    <option value="Mohali">Mohali</option>
                    <option value="Muktsar">Muktsar</option>
                    <option value="Nawanshahr">Nawanshahr</option>
                    <option value="Pathankot">Pathankot</option>
                    <option value="Patiala">Patiala</option>
                    <option value="Rupnagar">Rupnagar</option>
                    <option value="Sangrur">Sangrur</option>
                    <option value="Tarn Taran">Tarn Taran</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Area:</label>
                <select name="area" id="area" class="form-select">
                    <option value="">-- Select Area --</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Search 🔎</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#city').on('change', function() {
        var city = $(this).val();
console.log("aaaa")
        if(city !== '') {
            $.ajax({
                url: 'get_areas.php',
                type: 'GET',
                data: { city: city },
                success: function(data) {
                    var areas = JSON.parse(data);
                    var areaOptions = '<option value="">-- Select Area --</option>';

                    $.each(areas, function(index, value) {
                        areaOptions += '<option value="' + value + '">' + value + '</option>';
                    });

                    $('#area').html(areaOptions);
                },
                error: function() {
                    $('#area').html('<option value="">-- Error loading areas --</option>');
                }
            });
        } else {
            $('#area').html('<option value="">-- Select Area --</option>');
        }
    });
});
</script>

</body>
</html>
