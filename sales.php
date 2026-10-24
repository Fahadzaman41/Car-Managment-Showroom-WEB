<?php
$conn = mysqli_connect("localhost", "root", "", "car");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";

// Fetch cars for dropdown
$cars = mysqli_query($conn, "SELECT * FROM car_reg ORDER BY car_name ASC");


// ---------------- SAVE SALE ----------------
if (isset($_POST['save_sale'])) {

    $car_id        = $_POST['car_id'];
    $customer_name = $_POST['customer_name'];
    $cnic          = $_POST['cnic'];
    $phone         = $_POST['phone'];
    $payment       = $_POST['payment'];
    $sale_date     = $_POST['sale_date'];

    $sql = "INSERT INTO car_sales (car_id, customer_name, cnic, phone, payment, sale_date)
            VALUES ('$car_id', '$customer_name', '$cnic', '$phone', '$payment', '$sale_date')";

    if (mysqli_query($conn, $sql)) {
        $message = "Car Sale Recorded Successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}


$sales = mysqli_query($conn, "
    SELECT cs.*, cr.car_name, cr.model, cr.color, cr.price, cr.car_number
    FROM car_sales cs
    JOIN car_reg cr ON cs.car_id = cr.id
    ORDER BY cs.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Sales</title>

    <style>
        body {
            background: #ffffff;
            font-family: Arial;
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

        h2 { text-align:center; color:#333; }

        label { font-weight:bold; }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 7px 0 18px 0;
            border: 1px solid #aaa;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #69a9e1ff;
            color: #fff;
            border: none;
            font-size: 17px;
            border-radius: 6px;
            cursor: pointer;
        }

        .msg {
            text-align:center;
            color: green;
            font-weight: bold;
        }

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

        th { background:#f2f2f2; }
    </style>

    <script>
        function loadCarDetails() {
            let carData = document.getElementById("car_id").selectedOptions[0].dataset;

            document.getElementById("model").value  = carData.model;
            document.getElementById("color").value  = carData.color;
            document.getElementById("price").value  = carData.price;
            document.getElementById("carnumber").value = carData.carnumber;
        }
    </script>

</head>
<body>

    <div class="container">

        <h2>Car Sales Entry</h2>
        <p class="msg"><?php echo $message; ?></p>

        <form method="POST">

            <label>Select Car:</label>
            <select name="car_id" id="car_id" onchange="loadCarDetails()" required>
                <option value="">-- Select Car --</option>

                <?php while ($row = mysqli_fetch_assoc($cars)) { ?>
                    <option value="<?= $row['id']; ?>"
                        data-model="<?= $row['model']; ?>"
                        data-color="<?= $row['color']; ?>"
                        data-price="<?= $row['price']; ?>"
                        data-carnumber="<?= $row['car_number']; ?>">
                        <?= $row['car_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <!-- Auto-filled fields -->
            <label>Model:</label>
            <input type="text" id="model" readonly>

            <label>Color:</label>
            <input type="text" id="color" readonly>

            <label>Price:</label>
            <input type="text" id="price" readonly>

            <label>Car Number:</label>
            <input type="text" id="carnumber" readonly>

            <!-- Customer Info -->
            <label>Customer Name:</label>
            <input type="text" name="customer_name" required>

            <label>CNIC Number:</label>
            <input type="text" name="cnic" required>

            <label>Phone Number:</label>
            <input type="text" name="phone" required>

            <label>Payment Amount:</label>
            <input type="number" name="payment" required>

            <label>Date:</label>
            <input type="date" name="sale_date" required>

            <button type="submit" name="save_sale">Save Sale</button>

        </form>
    </div>

    <!-- SALES TABLE -->
    <div class="table-container">
        <h2>Sales Records</h2>

        <table>
            <tr>
                <th>Car Name</th>
                <th>Model</th>
                <th>Color</th>
                <th>Price</th>
                <th>Car #</th>
                <th>Customer</th>
                <th>CNIC</th>
                <th>Phone</th>
                <th>Payment</th>
                <th>Date</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($sales)) { ?>
                <tr>
                    <td><?= $row['car_name']; ?></td>
                    <td><?= $row['model']; ?></td>
                    <td><?= $row['color']; ?></td>
                    <td><?= $row['price']; ?></td>
                    <td><?= $row['car_number']; ?></td>
                    <td><?= $row['customer_name']; ?></td>
                    <td><?= $row['cnic']; ?></td>
                    <td><?= $row['phone']; ?></td>
                    <td><?= $row['payment']; ?></td>
                    <td><?= $row['sale_date']; ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>

</body>
</html>
