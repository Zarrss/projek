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
            position: absolute;
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
            display: flex;
            align-items: center;
            padding-left: 20px;
        }
        .icon-background i {
            font-size: 24px;
            margin-right: 10px;
        }
        h2 {
            text-align: center;
            margin-right: 600px;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin-left: 280px;
        }
        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #d3d3d3;
        }
        .system-admin {
            position: fixed;
            right: 20px;
            top: 250px;
            display: flex;
            align-items: center;
            font-size: 20px;
            margin-right: 80px;
        }
        .system-admin i {
            margin-right: 15px;
            font-size: 40px;
            color: pink;
            border: 2px solid pink;
            border-radius: 10px;
            padding: 10px;
        }
        .logout {
            margin-top: -15px;
            font-size: 20px;
            font-weight: bold;
            color: red;
            margin-left: 40px;
            cursor: pointer;
        }
        h1 {
            margin-left: 20px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="logo-container">
        <div class="logo"></div>
    </div>

    <h1>Accounts</h1> 

    <div class="icon-background"><i class="fas fa-home"></i> Dashboard</div>
    <br>
    <div class="icon-background"><i class="fas fa-user"></i> Accounts</div>
    <br>
    <div class="icon-background"><i class="fas fa-cog"></i> Setting</div>

    <h2>Account Activity</h2>
    <table>
        <tr>
            <th>User</th>
            <th>Password</th>
            <th>Activity</th>
        </tr>
        <tr>
            <td>zyad ezzeldin</td>
            <td>12345</td>
            <td>last login 02.45 am logout 14.00 pm</td>
        </tr>
        <tr>
            <td>syahdan daud</td>
            <td>54321</td>
            <td>last login 02.45 am logout 14.00 pm</td>
        </tr>
        <tr>
            <td>bimo adi</td>
            <td>232323</td>
            <td>last login 02.45 am logout 14.00 pm</td>
        </tr>
    </table>
     
    <div class="system-admin">
        <i class="fas fa-user"></i>
        <div>
            <h3>Project Manager</h3>
            <div class="logout" onclick="logout()">logout</div> <!-- Panggil fungsi logout saat diklik -->
        </div>
    </div>

    <script>
        function logout() {
            // Konfirmasi logout
            if (confirm("Are you sure you want to logout?")) {
                // Mengarahkan ke halaman login.php
                window.location.href = "login.php";
            }
        }
    </script>
</body>
</html>
