<?php
// Test // //
session_start();
session_destroy();
header("Location:login.php");
?>