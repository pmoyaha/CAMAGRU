<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['id']))
{
    header("Location: ../index.php");
}

include_once('../config/query.php');

    if (isset($_GET['comment'])  && isset($_GET['message']) && $_GET['message'] != "") {
        $imgId = $_GET['comment'];

        $message = $db->quote($_GET['message']);
        $db->exec("INSERT INTO comment (userid, galleryid, comment, date_and_time) VALUES('{$_SESSION['id']}', {$imgId}, {$message}, NOW())");
        $userId = query_db("SELECT * FROM gallery WHERE id={$imgId}", $db);
        foreach ($userId as $row) {
            $user = $row['userid'];
            $email = query_db("SELECT * FROM users WHERE id={$user}", $db);
            foreach ($email as $mail) {
                $emyl = $mail['email'];
                $username = $mail['username'];
                $subject = "CAMAGRU Comment notification";

                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'From: <no_reply>' . "\r\n";

                $message = '
                <html>
                <head>
                    <title>' . $subject . '</title>
                </head>
                <body>
                    Hi ' . htmlspecialchars($username) . ' </br>
                    someone just commented on one of your photos, please login for more. </br>     
                </body>
                </html>
                ';
                mail($emyl, $subject, $message, $headers);
            }
        }
       header("Location: gallery.php");
    }
   
    else
        header("Location: ../index.php");
?>