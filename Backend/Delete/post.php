<?php
include "../connection.php";
$id = $_GET['id'];
$query="Delete from post where id = '".$id."'";
$result = mysqli_query($Connection, $query);
if($result) header("Location: ../../Frontend/Home.php");
?>