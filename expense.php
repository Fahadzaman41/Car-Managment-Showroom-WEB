<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "car"); 

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['save'])) {
    $efor = mysqli_real_escape_string($conn, $_POST['efor']);
    $eby = mysqli_real_escape_string($conn, $_POST['eby']);
    $eamount = mysqli_real_escape_string($conn, $_POST['eamount']);
    $edate = mysqli_real_escape_string($conn, $_POST['edate']);

    $query = "INSERT INTO expense (efor, eby, eamount, edate) 
              VALUES ('$efor', '$eby', '$eamount', '$edate')";

    if (mysqli_query($conn, $query)) {
        echo "<p style='color:green; text-align:center;'>Expense saved successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 30px;
        }
        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #1877f2;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
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
        }
        button:hover {
            background-color: #0d5bd7;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Add Expense</h2>
    <form method="POST" action="">
        <label>Expense For:</label>
        <input type="text" name="efor" required>

        <label>Expense By:</label>
        <input type="text" name="eby" required>

        <label>Expense Amount:</label>
        <input type="number" step="0.01" name="eamount" required>

        <label>Expense Date:</label>
        <input type="date" name="edate" required>

        <button type="submit" name="save">Save Expense</button>
    </form>
</div>

</body>
</html>
