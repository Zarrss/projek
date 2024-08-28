<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .logo-container {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-image: url('cewelogo.png');
            background-size: cover;
            background-position: center;
        }
        .icon-background {
            position: relative;
            display: inline-block;
            padding-left: 50px;
        }
        .icon-background i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-20%);
            font-size: 24px;
            opacity: 1;
            margin-left: 20px;
        }
        h2 {
            text-align: center;
            margin-right: 500px;
        }
        table {
            width: 40%;
            border-collapse: collapse;
            margin-left: 335px;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #d3d3d3;
        }
        .action-text {
            color: red;
            cursor: pointer;
        }
        .system-admin {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 800px;
            margin-top: -7%;
            font-size: 20px;
        }
        .system-admin i {
            margin-right: 15px;
            font-size: 40px;
            color: pink;
            border: 2px solid pink;
            border-radius: 10px;
            padding: 10px;
            margin-top: 4%;
        }
        .logout {
            margin-top: -15px;
            font-size: 20px;
            font-weight: bold;
            color: red;
            margin-left: 40px;
            cursor: pointer; /* Menambahkan pointer ketika hover pada logout */
        }
        h1 {
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <div class="logo"></div>
    </div>

    <h1>Accounts</h1> 

    <div class="icon-background"><br><i class="fas fa-home"></i> Dashboard</div>
    <br>
    <div class="icon-background"><br><i class="fas fa-user"></i> Accounts</div>
    <br>
    <div class="icon-background"><br><i class="fas fa-cog"></i> Setting</div>

    <h2>Account Activity</h2>
    <table>
        <tr>
            <th>User</th>
            <th>Password</th>
            <th>Activity</th>
        </tr>
        <tr>
            <td>syahdan daud</td>
            <td>12345</td>
            <td>last login 02.45 am logout 14.00 pm</td>
        </tr>
    </table>

    <div class="system-admin">
        <i class="fas fa-user"></i>
        <div>
            <h3>Project Engineer</h3>
            <div class="logout" onclick="logout()">logout</div> <!-- Panggil fungsi logout saat diklik -->
        </div>
    </div>

    <script>
        function logout() {
            // Konfirmasi logout
            if (confirm("Are you sure you want to logout?")) {
                // Mengarahkan ke halaman setmanager.php
                window.location.href = "login.php";
            }
        }
    </script>
</body>
</html>
