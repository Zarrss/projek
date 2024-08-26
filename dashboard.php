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

              <!-- table -->
              <div class="table-container">
                <table id="dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll"></th>
                            <th>No TSF</th>
                            <th>Date</th>
                            <th>Target Date</th>
                            <th>Work Category</th>
                            <th>Divisi</th>
                            <th>Customer</th>
                            <th>End Customer</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Actions</th> <!-- Add this column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr data-row-id='{$row['id']}'>
                                    <td><input type='checkbox' class='row-checkbox'></td>
                                    <td>{$row['no_tsrf']}</td>
                                    <td>{$row['date']}</td>
                                    <td>{$row['target_date']}</td>
                                    <td>{$row['work_category']}</td>
                                    <td>{$row['divisi']}</td>
                                    <td>{$row['costumer']}</td>
                                    <td>{$row['end_costumer']}</td>
                                    <td>{$row['judul']}</td>
                                    <td>{$row['status']}</td>
                                    <td>
                                        <button class='actions-btn' data-id='{$row['id']}'>
                                            <img src='elipses.png' alt='Actions'>
                                        </button>
                                        <div class='actions-menu' data-id='{$row['id']}'>
                                            <button class='add-btn' data-id='{$row['id']}'>Insert</button>
                                        
                                        </div>
                                        
                                    </td>
                                </tr>";
                            }
                            // <button class='edit-btn'>Edit</button>
                            // <button class='deactivate-btn'>Deactivate</button>
                        } else {
                            echo "<tr><td colspan='11'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>


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

             <!-- navbar kanan -->
             <div class="colored-box">
                <div class="notification-container">
                    <button class="notification-button">
                        <span class="notification-icon">🔔</span>
                        <span class="badge">3</span>
                    </button>
                </div>
            </div>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
</body>
</html>