<?php
session_start();


?>
<!DOCTYPE html>
<html>
<head>
    <title>Fahad Car Show Room</title>

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #491461ff, #b5c269ff, #a19c9eff);
            color: white;
            height: 100vh;
        }

        /* Top Bar */
        .topbar {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            font-size: 28px;
            font-weight: bold;
            backdrop-filter: blur(6px);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .username-box {
            padding: 8px 20px;
            background: linear-gradient(45deg, #86e7b8ff, #ff5722);
            border-radius: 25px;
            box-shadow: 0px 0px 10px rgba(36, 145, 105, 0.6);
            font-size: 16px;
            font-weight: bold;
        }

        /* Dashboard Tiles */
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 30px;
            padding: 50px;
        }

        .tile {
            background: linear-gradient(135deg, #74911eff, #b7babeff);
            padding: 35px;
            text-align: center;
            border-radius: 20px;
            cursor: pointer;
            font-size: 22px;
            font-weight: bold;
            color: #000;
            transition: 0.3s;
            box-shadow: 0px 6px 15px rgba(0,0,0,0.3);
        }

        .tile:hover {
            transform: translateY(-7px);
            box-shadow: 0px 10px 20px rgba(0,0,0,0.5);
        }
    </style>
</head>

<body>

    <!-- Top Bar -->
    <div class="topbar">
        Fahad Car Show Room

        <div class="username-box">
            <?php echo "Welcome, " . $_SESSION['nam']; ?>
        </div>
    </div>

    <!-- Dashboard Tiles -->
    <div class="container">

        <div class="tile" onclick="location.href='car_registration.php'">
             Car Registration
        </div>

        <div class="tile" onclick="location.href='vexpense.php'">
             Expense Details
        </div>

        <div class="tile" onclick="location.href='car_details.php'">
             Cars Details
        </div>

        <div class="tile" onclick="location.href='sales.php'">
            Sales
        </div>

        <div class="tile" onclick="location.href='expense.php'">
             Expenses
        </div>
<div class="tile" onclick="location.href='user.php'">
             User Registration
        </div>
    </div>

</body>
</html>
