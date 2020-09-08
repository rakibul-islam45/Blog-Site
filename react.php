<?php
session_start();
include ('config.php');
$user_id = $_SESSION['userid'];
$postid = $_GET['postId'];
$like = $_GET['like'];
$dislike = $_GET['dislike'];
//var_dump($like);
//var_dump($dislike);
if(!empty($user_id)) {
    $queryC = "SELECT * FROM react WHERE userId=$user_id 
  		  AND postId=$postid";
    $stmt = $pdo->prepare($queryC);
    $stmt->execute();

    $check = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($check);

    if (!empty($check)) {
        header("location: singlepost.php?postId=$postid");
    } elseif (!empty($like)) {

        $query = "INSERT INTO react (postId, userId, reaction) VALUES (:postid, :userid, :likedis)";

        $statement = $pdo->prepare($query);
        $statement->bindValue(':postid', $postid);
        $statement->bindValue(':userid', $user_id);
        $statement->bindValue(':likedis', $like);
        $statement->execute();
    } elseif (!empty($dislike)) {

        $query = "INSERT INTO react (postId, userId, reaction) VALUES (:postid, :userid, :likedis)";

        $sth = $pdo->prepare($query);
        $sth->bindValue(':postid', $postid);
        $sth->bindValue(':userid', $user_id);
        $sth->bindValue(':likedis', $dislike);

        $sth->execute();
    }
}else{
    echo "<script type='text/javascript'>alert('Please register or login to react!');
        window.location.href='register.php';
        </script>";
}


