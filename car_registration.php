<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "car");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";
$update_id = "";
$carname = $model = $color = $price = $carnumber = "";

// ---------------- DELETE RECORD ----------------
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM car_reg WHERE id=$id");
    $message = "Car Deleted Successfully!";
}


// ---------------- FETCH DATA FOR EDIT ----------------
if (isset($_GET['edit'])) {
    $update_id = $_GET['edit'];
    $data = mysqli_query($conn, "SELECT * FROM car_reg WHERE id=$update_id");
    $row = mysqli_fetch_assoc($data);

    $carname = $row['car_name'];
    $model = $row['model'];
    $color = $row['color'];
    $price = $row['price'];
    $carnumber = $row['car_number'];
}


// ---------------- SAVE NEW RECORD ----------------
if (isset($_POST['save'])) {

    $carname    = $_POST['carname'];
    $model      = $_POST['model'];
    $color      = $_POST['color'];
    $price      = $_POST['price'];
    $carnumber  = $_POST['carnumber'];

    $sql = "INSERT INTO car_reg (car_name, model, color, price, car_number)
            VALUES ('$carname', '$model', '$color', '$price', '$carnumber')";

    if (mysqli_query($conn, $sql)) {
        $message = "Car Registered Successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}


// ---------------- UPDATE EXISTING RECORD ----------------
if (isset($_POST['update'])) {

    $id         = $_POST['update_id'];
    $carname    = $_POST['carname'];
    $model      = $_POST['model'];
    $color      = $_POST['color'];
    $price      = $_POST['price'];
    $carnumber  = $_POST['carnumber'];

    $sql = "UPDATE car_reg SET 
                car_name='$carname',
                model='$model',
                color='$color',
                price='$price',
                car_number='$carnumber'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        $message = "Car Updated Successfully!";
        $update_id = ""; // Reset form
        $carname = $model = $color = $price = $carnumber = "";
    }
}

// Fetch all cars
$cars = mysqli_query($conn, "SELECT * FROM car_reg ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .container {
            width: 45%;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #444;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 7px 0 18px 0;
            border: 1px solid #aaa;
            border-radius: 6px;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 17px;
            border-radius: 6px;
            cursor: pointer;
        }

        .update-btn {
            background: #28a745 !important;
        }

        .msg {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Table styles */
        .table-container {
            width: 80%;
            margin: 30px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        .icon-btn {
            font-size: 18px;
            cursor: pointer;
            margin: 0 5px;
        }

        .edit {
            color: #007bff;
        }

        .delete {
            color: red;
        }
    </style>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this car?")) {
                window.location = "?" + "delete=" + id;
            }
        }
    </script>

</head>
<body>

    <div class="container">

        <h2>Car Registration</h2>

        <p class="msg"><?php echo $message; ?></p>

        <form method="POST">

            <input type="hidden" name="update_id" value="<?php echo $update_id; ?>">

            <label>Car Name:</label>
            <input type="text" name="carname" required value="<?php echo $carname; ?>">

            <label>Model:</label>
            <input type="text" name="model" required value="<?php echo $model; ?>">

            <label>Color:</label>
            <input type="text" name="color" required value="<?php echo $color; ?>">

            <label>Price:</label>
            <input type="number" name="price" required value="<?php echo $price; ?>">

            <label>Car Number:</label>
            <input type="text" name="carnumber" required value="<?php echo $carnumber; ?>">

            <?php if ($update_id == "") { ?>
                <button type="submit" name="save">Register Car</button>
            <?php } else { ?>
                <button type="submit" name="update" class="update-btn">Update Car</button>
            <?php } ?>

        </form>
    </div>

    <!-- Display Registered Cars -->
    <div class="table-container">
        <h2 style="text-align:center; color:#333;">Registered Cars</h2>

        <table>
            <tr>
                <th>Car Name</th>
                <th>Model</th>
                <th>Color</th>
                <th>Price</th>
                <th>Car Number</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($cars)) { ?>
            <tr>
                <td><?php echo $row['car_name']; ?></td>
                <td><?php echo $row['model']; ?></td>
                <td><?php echo $row['color']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['car_number']; ?></td>

                <td>
                    <a href="?edit=<?php echo $row['id']; ?>">
                        <i class="fa-solid fa-pen-to-square icon-btn edit"></i>
                    </a>

                    <i class="fa-solid fa-trash icon-btn delete"
                       onclick="confirmDelete(<?php echo $row['id']; ?>)"></i>
                </td>

            </tr>
            <?php } ?>

        </table>

    </div>

</body>
</html>
