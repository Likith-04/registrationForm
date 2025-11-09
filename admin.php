<?php
$servername = "sql.freedb.tech";
$username   = "YOUR_FREEDB_USERNAME";   // ← replace with your FreeDB username
$password   = "YOUR_FREEDB_PASSWORD";   // ← replace with your FreeDB password
$dbname     = "freedb_registrations";
$port       = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
  die("<h3 style='color:red; text-align:center;'>Database Connection Failed: " . $conn->connect_error . "</h3>");
}

if (isset($_GET['delete_id'])) {
  $id = intval($_GET['delete_id']);
  $conn->query("DELETE FROM registrations WHERE id = $id");
  header("Location: admin.php");
  exit;
}

$result = $conn->query("SELECT * FROM registrations");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: url("https://wallpapers.com/images/hd/4k-laptop-on-gloomy-desk-f7k0g3xufpxxwjk9.jpg") center/cover fixed;
  color: white; margin: 0; padding: 0;
}
.container {
  background-color: rgba(0,0,0,0.7);
  width: 90%; margin: 40px auto; padding: 25px 40px;
  border-radius: 12px;
}
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td {
  padding: 10px; border: 1px solid #ddd; text-align: center;
}
th { background-color: rgba(80,80,80,0.7); color: white; }
tr:hover { background-color: rgba(120,120,120,0.7); }
.delete-btn {
  background-color: rgba(100,100,100,0.8);
  color: white; border: none; padding: 8px 12px;
  border-radius: 6px; cursor: pointer; transition: 0.3s;
}
.delete-btn:hover { background-color: red; transform: scale(1.1); }
.back-btn {
  display: block; text-align: center;
  margin-top: 25px; background-color: #4CAF50;
  padding: 10px; color: white; text-decoration: none;
  border-radius: 6px;
}
</style>
</head>
<body>
<div class="container">
  <h2><i class="fas fa-user-shield"></i> Admin Dashboard</h2>
  <table>
    <tr>
      <th>ID</th><th>Full Name</th><th>USN</th><th>Gender</th>
      <th>Email</th><th>Phone</th><th>Address</th><th>Action</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= $row['fullname'] ?></td>
          <td><?= $row['usn'] ?></td>
          <td><?= $row['gender'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['phone'] ?></td>
          <td><?= $row['address'] ?></td>
          <td>
            <a href="admin.php?delete_id=<?= $row['id'] ?>" onclick="return confirm('Delete this record?');">
              <button class="delete-btn"><i class="fas fa-trash"></i> Delete</button>
            </a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="8">No registrations found.</td></tr>
    <?php endif; ?>
  </table>

  <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Form</a>
</div>
</body>
</html>
