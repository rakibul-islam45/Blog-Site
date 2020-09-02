<?php
session_start();
include ('config.php');
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
//var_dump($username);
if($userid) {
    if(isset($_POST['comment_btn'])) {
        $comment = $_POST['comment'];
        $postid = $_POST['postid'];


        $query = "INSERT INTO  comments (postid, userName, comment) values (:postid, :username, :comment)";

        $statement = $pdo->prepare($query);

        $statement->bindValue(':postid', $postid);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':comment', $comment);

        if ($statement->execute()) {
//    header("location: adminLogin.php");
            echo 'Inserted';
        } else {
            echo 'Could not insert';
        }

    }

} else{
    echo "<script type='text/javascript'>alert('Please register to comment!');</script>";
    header('location : register.php');
    }

