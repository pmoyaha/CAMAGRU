<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
<header>
    <link rel="stylesheet" type="text/css" href="upload.css">
    <link rel="stylesheet" type="text/css" href="gallery.css">
    <link rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPLOAD</title>
</header>
<body background="https://img.freepik.com/free-vector/vibrant-pink-watercolor-painting-background_53876-58930.jpg?size=626&ext=jpg">
<div id="header">
    <p class="user"><?php if(isset($_SESSION['username']))print_r(htmlspecialchars($_SESSION['username']));
                            else{ echo" <a href='http://localhost:8080/camagru/'>LOGIN</a>"; } ?></p>
</div>
<?php   ?>
    <div class="cam">
        <div class="container">
            <hr>
            <a href="../index.php">Home</a>
            <div class="text">Image Gallery</div>
            <hr>
            <?php
            include_once '../config/database.php';
            include_once('../config/query.php');
            try {
                $db = new PDO($DB_DSN_NAME, $DB_USER, $DB_PASSWORD);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->query("SELECT COUNT(*) FROM gallery")->fetch()[0];
                $images = query_db("SELECT * FROM gallery ORDER BY date_created DESC", $db);
                if (empty($images)) {
                    ?> <div class="noImg"> <?php
                        echo "no images to display";
                        ?> </div> <?php
                }
                ?>
                <?php foreach($images as $row) { ?>
                    <div>
                <div class='pic' id='frm'>
                    <img class="one" src="images/<?php echo $row['img']; ?>" />
                </div>

                <?php if(isset($_SESSION['id'])) :?>
                     <form action = "../delete.php" method = "GET">
                        <button name = "delete" type = "submit" value="<?php echo $row['id']; ?>"><img class='close' src='../images/delete.png' alt='delete' /></button>
                        </form>
                        <div class="txt">
                        <form action="../likes.php" method = "GET">
                            <button class="lykbtn"  name = "like" type = "submit" value="<?php echo $row['id']; ?>"><img class="lyk" src="../images/like.png"/></button>
                        </form>
                            <?php
                            $nb_likes = query_db("SELECT COUNT(*) FROM likes WHERE galleryid='{$row['id']}'", $db);
                            echo $nb_likes[0][0];
                            ?>
                             </div>
                           
                        <form action = "comment.php" method = "GET">
                            <textarea  class="combox" maxlength="500" name="message" placeholder="Comment..."></textarea><br />
                            <button name = "comment" class="combtn" type = "submit" value="<?php echo $row['id']; ?>">Comment</button>
                        </form>
                <?php endif;?>

                        <h4>Comments</h4>
                        <?php
                        if (!isset($_SESSION['username']) && !isset($_SESSION['id']))
                        {
                            echo "<h6>Please login to comment</h6>";
                        }
                        else{
                            $query = "SELECT users.username AS log_in_user, comment.comment AS comment, DATE_FORMAT(comment.date_and_time, '%b %e %Y, %H:%i') AS date_message FROM comment INNER JOIN users ON comment.userid = users.id WHERE comment.galleryid ='{$row['id']}' ORDER BY comment.date_and_time DESC";
                            $comments = query_db($query, $db);
                            if (!empty($comments)) {
                                foreach ($comments as $comment) {
                                    echo "<div class='com'>";
                                    echo "<p>";
                                    echo "[{$comment['date_message']}]"."</br>";
                                    echo "{$comment['log_in_user']}: ";
                                    echo $comment['comment'];
                                    echo "</p>";
                                    echo "</div>";
                                }
                        }
                       
                        } ?>
                    </div> <?php
                    ?> <hr> 
                <?php
                }
            } catch (PDOException $e) {
                return ($e->getMessage());
            } ?>
        </div>
    </div>
    <div id="gallery_container">
            
    </div>
<div id="footer">
    <?php include('footer.php') ?>
</div>
</body>
</HTML>
