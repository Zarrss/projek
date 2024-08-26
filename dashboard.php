<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    
</head>
<body>
            <?php
            include 'db_connect.php'; // Menghubungkan ke database

            $sql = "SELECT * FROM tsf_data";
            $result = $conn->query($sql);
            ?>

            <!-- //navbar -->
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">PM</a>
                </li>
                <li class="nav-item navbar-right">
                    <a href="setting.php">
                        <img src="userlogo.png" alt="User Logo" class="user-logo">
                    </a>
                </li>
            </ul>

            <!-- menu project -->
            <h3 style="text-align: center;"></h3>

            <div class="sBar">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fas fa-home"></i>
                            <span>Big Project</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-info-circle"></i>
                            <span>Small Project</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-cogs"></i>
                            <span>Project Engineer</span>
                        </a>
                    </li>
                </ul>
            </div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
</body>
</html>