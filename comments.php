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
            header("location: singlepost.php");
//            echo 'Inserted';
        } else {
            echo "<script type='text/javascript'>alert('Something is wrong!');
        window.location.href='singlepost.php';
        </script>";
        }

    }
} else{
    echo "<script type='text/javascript'>alert('Please register or login to comment!');
        window.location.href='register.php';
        </script>";
   // header('location : register.php');
    }

