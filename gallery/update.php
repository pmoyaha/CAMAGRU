<?php
session_start();
include_once("./config/database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
</head>
<body>
<body background="https://img.freepik.com/free-vector/vibrant-pink-watercolor-painting-background_53876-58930.jpg?size=626&ext=jpg">
   <form action="test.php" method="POST">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="email" placeholder="email">
        <button name="submit" type="submit">Update</button>
        </form>
   