<?php
  include('arrays.php');
  include('functions.php');
  include('updatebooking.php');
  include('authorization/authcheck.php');
    $bookedDates = [];
    $stmt = $conn->prepare("SELECT dining_date FROM booking WHERE table_no = ?");
    $stmt->bind_param('i', $table['tableNum']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $bookedDates[] = date('Y-m-d', strtotime($row['dining_date']));
    }
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo TITLE; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand">Welcome!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">  
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
              foreach ($navBar as $items) {
                echo "<li class ='nav-item'><a class='nav-link' href = $items[link]>$items[title]</a></li><br>";
              }
            ?>
        </ul>
        <?php if($role === 'admin') {
          echo "<div class='d-flex align-items-center gap-3'><a href='signupadmin.php'>Create an account</a>";
        }
        ?>
          <a class="btn btn-danger" href="logout.php">Log Out</a>
        </div>
      </div>
    </div>
  </nav><br><br>
