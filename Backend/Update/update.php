<?php
include '../connection.php';
$title = $_POST['title'];
$description = $_POST['description'];
$id = $_POST['id'];
$email = $_POST['email'];
$query = "update post set title = '".$title."', description = '".$description."' where id = '".$id."' and email = '".$email."'";
$result = mysqli_query($Connection, $query);
if($result) header("Location: ../../Frontend/home.php");
?>