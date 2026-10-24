<?php
$conn = mysqli_connect('localhost', 'root', '', 'car');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $name     = $_POST['name'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $sql = "INSERT INTO users (un, nm, ps, rl) 
            VALUES ('$username', '$name', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        $message = "✅ User Registered Successfully!";
    } else {
        $message = "❌ Error: " . mysqli_error($conn);
    }
}

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #1877f2;
            margin-bottom: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 30px;
        }

        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .message.success { color: green; }
        .message.error { color: red; }

        form label {
            font-weight: 600;
            display: block;
            margin-top: 15px;
        }

        form input, form select {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            transition: 0.3s;
        }

        form input:focus, form select:focus {
            border-color: #1877f2;
            box-shadow: 0 0 6px rgba(24, 119, 242, 0.3);
            outline: none;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #1877f2;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #0d5bd7;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            font-weight: 600;
            border-bottom: 2px solid #e0e0e0;
        }

        tr:nth-child(even) {
            background-color: #f6f6f6;
        }

        tr:hover {
            background-color: #eef3ff;
            transition: 0.2s;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Registration Form -->
    <div class="card">
        <h2>Register New User</h2>
        <?php if ($message != ""): ?>
            <p class="message <?php echo strpos($message, '✅') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Role:</label>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
                <option value="Manager">Manager</option>
            </select>

            <button type="submit" name="register"><i class="fa-solid fa-user-plus"></i> Register</button>
        </form>
    </div>

    <!-- Users Table -->
    <div class="card">
        <h2>Registered Users</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Role</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                <tr>
                    <td><?php echo $row['un']; ?></td>
                    <td><?php echo $row['nm']; ?></td>
                    <td><?php echo $row['rl']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>
