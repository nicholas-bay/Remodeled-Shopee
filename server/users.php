<?php
  include 'config.php';
  session_start();
  $username = $pwd = '';
  
  if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $conn = new mysqli($host, $user, $password, $db);
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    if (isset($_POST['login'])) {
      $sql = "SELECT * FROM $tableuser";
      $dataset = $conn->query($sql);
      if ($dataset->num_rows > 0) {
        while ($row = $dataset->fetch_assoc()) {
          if ($row['username'] === $username && $row['password'] === $pwd) {
            $_SESSION['username'] = $username;
            $_SESSION['login_valid'] = "";
            header('Location: ../client/home.php');
          } else {
            $_SESSION['login_valid'] = "Invalid Username or Password.";
            header('Location: ../client/home.php');
          }
        }
      }
    }
    else if (isset($_POST['signup'])) {
      $sql = 
        "INSERT INTO $tableuser
        VALUES ('$username', '$pwd', 'buyer')";
      $conn->query($sql);
      $_SESSION['username'] = $username;
      header('Location: ../client/home.php');
    }
    else if (isset($_POST['logout'])) {
      $_SESSION['username'] = 'User';
      header('Location: ../client/home.php');
    }
    else if (isset($_POST['update'])) {
      $sql = 
        "UPDATE $tableuser SET
        username = '$username',
        password = '$pwd'
        WHERE username = '" . $_SESSION['username'] . "'";
      $conn->query($sql);
      $_SESSION['username'] = $username;
      header('Location: ../client/home.php');
    }
    else if (isset($_POST['delete'])) {
      echo $_SESSION['username'];
      $sql = 
        "DELETE FROM $tableuser WHERE
        username = '" . $_SESSION['username'] . "'";
      $conn->query($sql);
      $_SESSION['username'] = 'User';
      header('Location: ../client/index.php');
    }
  }
