<?php
session_start();
if(isset($_SESSION['user']))
{
    include ('config.php');
    $sql = "DELETE FROM post WHERE postId='" . $_GET["postId"] . "'";

    /*use exec() because no results are returned*/
    $pdo->exec($sql);
    header('location: managePosts.php');
}
else
{
    header('location: adminLogin.php');
}

?>
