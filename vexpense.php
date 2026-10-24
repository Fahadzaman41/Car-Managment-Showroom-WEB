<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "car");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Records</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 30px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #1877f2;
            margin-bottom: 20px;
        }
        .table-container {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            max-width: 1000px;
            margin: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .search-bar {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }
        .search-bar:focus {
            border-color: #1877f2;
            box-shadow: 0 0 6px rgba(24, 119, 242, 0.3);
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

<h1>Expense Records</h1>
<div class="table-container">
    <input type="text" id="searchInput" class="search-bar" placeholder="Search by Expense For, Expense By, Amount, or Date...">

    <table id="expenseTable">
        <tr>
            <th>ID</th>
            <th>Expense For</th>
            <th>Expense By</th>
            <th>Amount</th>
            <th>Date</th>
        </tr>

        <?php
        $expenses = mysqli_query($conn, "SELECT * FROM expense ORDER BY eid DESC");

        while ($row = mysqli_fetch_assoc($expenses)) { ?>
        <tr>
            <td><?php echo $row['eid']; ?></td>
            <td><?php echo $row['efor']; ?></td>
            <td><?php echo $row['eby']; ?></td>
            <td><?php echo $row['eamount']; ?></td>
            <td><?php echo $row['edate']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("#expenseTable tr");

        rows.forEach((row, index) => {
            if (index === 0) return; // skip header row
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>

</body>
</html>
