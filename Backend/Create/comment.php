<?php
include '../connection.php';
$id = $_POST['id'];
$email = $_POST['email'];
$text = $_POST['text'];
$query = "insert into comment values('" . $id . "', '" . $text . "', '" . $email . "')";
$query = mysqli_query($Connection, $query);
if($query) header("Location: ../comment.php");