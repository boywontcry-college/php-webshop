<?php
session_start();
// unset($_SESSION['Sadmin_id']);
// unset($_SESSION['Sadmin_email']);
session_destroy();
header("location:index.php");
?>