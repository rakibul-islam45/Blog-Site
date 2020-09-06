<?php
include ('config.php');

$postid= $_GET['postId'];

$query = "DELETE FROM post WHERE postId = :postid";

if($statement = $pdo->prepare($query)){

    $statement->bindValue(":postid", $postid);





    if($statement->execute()){

        header("location: userprofile.php");
        exit();
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }



unset($stmt);


unset($pdo);
} else{

    if(empty($postid)){

        header("location: userprofile.php");
        exit();
    }
}