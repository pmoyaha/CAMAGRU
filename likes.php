<?php
session_start();

include_once('config/connection.php');

if (isset($_GET['like'])) {
    $db = connection_database();

    $imgId = $db->quote($_GET['like']);

    $query = $db->prepare("SELECT * FROM camagru.likes WHERE userid = '{$_SESSION['id']}' AND galleryid = {$imgId}");
    $query->execute();
    $res = $query->fetchAll();
    if (empty($res))
            $db->exec("INSERT INTO camagru.likes (userid, galleryid, date_and_time) VALUES('{$_SESSION['id']}', {$imgId}, NOW())");
        header("Location: gallery/gallery.php");
    }
?>