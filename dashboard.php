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
    include 'db_connect.php'; // Connecting to database

    $sql = "SELECT * FROM tsf_data";
    $result = $conn->query($sql);
    ?>

    <!-- Navbar -->
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link disabled" href="#">PM</a>
        </li>
        <li class="nav-item navbar-right">
            <a href="setmanager.php">
                <img src="cewelogo.png" alt="User Logo" class="user-logo">
            </a>
        </li>
    </ul>

    <!-- Table Container -->
    <div class="table-container">
        <!-- Project Manager Title -->
       
        <!-- Table -->
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
                    <th>Actions</th>
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
                } else {
                    echo "<tr><td colspan='11'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <table class="custom-table">
    <tr>
        <th class="system-admin"><a href="#system-admin">system admin</a></th>
        <th class="project-manager"><a href="#project-manager">project manager</a></th>
        <th class="project-engineer"><a href="#project-engineer">project engineer</a></th>
    </tr>
</table>





        <!-- Rectangle Box -->
        <div class="rectangle-box"></div>
    </div>


    

    <!-- Sidebar -->
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

    <!-- Navbar Kanan -->
    <div class="colored-box">
        <div class="notification-container">
            <button class="notification-button">
                <span class="notification-icon">🔔</span>
                <span class="badge">3</span>
            </button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const table = document.querySelector('#dataTable');
        const rectangleBox = document.querySelector('.rectangle-box');

        // Function to create a table row
        function createTableRow(data) {
            const row = document.createElement('tr');
            for (const cell of data) {
                const td = document.createElement('td');
                td.textContent = cell;
                row.appendChild(td);
            }
            return row;
        }

        // Function to update rectangle box with selected rows
        function updateRectangleBox() {
            // Clear existing content
            rectangleBox.innerHTML = '';

            // Create table element
            const newTable = document.createElement('table');
            newTable.classList.add('table');
            const headerRow = document.createElement('tr');

            // Add table headers
            ['No TSF', 'Date', 'Target Date', 'Work Category', 'Divisi', 'Customer', 'End Customer', 'Judul', 'Status'].forEach(headerText => {
                const th = document.createElement('th');
                th.textContent = headerText;
                headerRow.appendChild(th);
            });

            newTable.appendChild(headerRow);

            // Add selected rows
            const rows = table.querySelectorAll('tbody tr');
            let rowAdded = false;
            rows.forEach(row => {
                const checkbox = row.querySelector('.row-checkbox');
                if (checkbox.checked) {
                    const cells = Array.from(row.children).map(cell => cell.textContent);
                    if (cells[0] !== 'No TS') { // Ensure the "No TS" row is excluded
                        rowAdded = true;
                        newTable.appendChild(createTableRow(cells));
                    }
                }
            });

            // Append new table to rectangle box
            if (rowAdded) {
                rectangleBox.appendChild(newTable);
            }
        }

        // Add event listeners
        selectAllCheckbox.addEventListener('change', function() {
            const checkboxes = table.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateRectangleBox();
        });

        table.addEventListener('change', function(event) {
            if (event.target.classList.contains('row-checkbox')) {
                updateRectangleBox();
            }
        });
    });
    </script>

    <div class="side-nav">
        <a href="#" class="nav-item active">
            <img src="userlogo.png" alt="Manager 1 Icon" class="active-icon">
            manager 1
        </a>
        <a href="#" class="nav-item">
            <img src="userlogo.png" alt="Manager 2 Icon">
            manager 2
        </a>
        <a href="#" class="nav-item">
            <img src="userlogo.png" alt="Manager 3 Icon">
            manager 3
        </a>
        <a href="#" class="nav-item">
            <img src="userlogo.png" alt="Manager 4 Icon">
            manager 4
        </a>
    </div>

    <script>
        // Adding event listener for each nav item
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove 'active' class from all items
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));

                // Add 'active' class to clicked item
                this.classList.add('active');
            });
        });
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>
