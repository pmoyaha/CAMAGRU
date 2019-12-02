<?php
session_start();

include_once('../config/database.php');

$db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
$id = $_SESSION['id'];
if(isset($_POST['username'])){
    if($username = trim($_POST['username'])){
        $sql=$db->prepare("update `users` set username='$username' where id='$id'");
        $sql->execute();
        $alert = "<h5 style='text-align:center;' class='text-default'>Username reset</h5>";
        header("location: camera.php");
    }
}
if(isset($_POST['email'])) {
    if ($email = trim($_POST['email'])) {
        $sql=$db->prepare("update `users` set email='$email' where id='$id'");
        $sql->execute();
        $alert = "<h5 style='text-align:center;' class='text-default'>Email reset</h5>";
        header("location: camera.php");
    }
}
var_dump($_SESSION['email']);