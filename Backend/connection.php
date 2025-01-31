<?php
$Connection = mysqli_connect("localhost", "root", "", "ids");
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>