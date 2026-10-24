<?php
// Database Connection
$conn = mysqli_connect("localhost", "root", "", "car");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<head>
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: "Segoe UI", Roboto, Arial, sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 20px;
      color: #333;
    }

    h1 {
      text-align: center;
      color: #1877f2;
      margin-bottom: 20px;
    }

    .table-container {
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
      max-width: 1000px;
      margin: auto;
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
      overflow: hidden;
      border-radius: 8px;
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

    .icon-btn {
      cursor: pointer;
      font-size: 18px;
      margin: 0 8px;
      transition: color 0.3s ease;
    }

    .icon-btn.edit {
      color: #1877f2;
    }

    .icon-btn.edit:hover {
      color: #0d5bd7;
    }

    .icon-btn.delete {
      color: #e53935;
    }

    .icon-btn.delete:hover {
      color: #b71c1c;
    }
  </style>
</head>
<body>

  <h1>Car Details</h1>
  <div class="table-container">
      <h2 style="text-align:center; color:#333;">Registered Cars</h2>

      <!-- 🔍 Search Bar -->
      <input type="text" id="searchInput" class="search-bar" placeholder="Search by Car Name, Model, or Car Number...">

      <table id="carTable">
          <tr>
              <th>Car Name</th>
              <th>Model</th>
              <th>Color</th>
              <th>Price</th>
              <th>Car Number</th>
              <th>Actions</th>
          </tr>

          <?php
          $cars = mysqli_query($conn, "SELECT * FROM car_reg ORDER BY id DESC");

          while ($row = mysqli_fetch_assoc($cars)) { ?>
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

  <!-- 🔥 JavaScript for Live Search -->
  <script>
    document.getElementById("searchInput").addEventListener("keyup", function() {
      let filter = this.value.toLowerCase();
      let rows = document.querySelectorAll("#carTable tr");

      rows.forEach((row, index) => {
        if (index === 0) return; // skip header row
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
      });
    });
  </script>

</body>
</html>
