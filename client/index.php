<?php 
  session_start();
  $_SESSION['username'] = 'User';
  $_SESSION['pointer'] = NULL;
  $_SESSION['product_count'] = 0;
  header('Location: home.php');
?>