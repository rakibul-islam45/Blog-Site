<?php
include ('config.php');
if(isset($_POST['update_btn'])) {

    $postid = $_POST['postid'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $tag = $_POST['tag'];
//    $userid = $_SESSION['userid'];

    $sql = "UPDATE post SET title=:title, body=:body, tag=:tag WHERE postId='$postid'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':body', $body);
    $stmt->bindValue(':tag', $tag);

    if($stmt->execute()){
        //echo 'inserted';
        header('location: userprofile.php');
    }else{
        echo 'Could not insert';
    }
}
