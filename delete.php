<?php
session_start();

include_once('config/connection.php');


if (isset($_GET['delete'])) {

    $db = connection_database();
    $imgId = $_GET['delete'];

    $query = $db->prepare("SELECT userid FROM camagru.gallery WHERE id=$imgId");
    $query->execute();
    $res = $query->fetchAll();

    if (!empty($res) && $res[0]['userid'] == $_SESSION['id'])
    {
        $db->exec("DELETE FROM camagru.gallery WHERE id={$imgId}");
        $db->exec("DELETE FROM camagru.likes WHERE galleryid={$imgId}");
        $db->exec("DELETE FROM camagru.comment WHERE galleryid={$imgId}");
    }
    header("Location: gallery/gallery.php");
}
?>