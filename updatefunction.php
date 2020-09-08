<?php
include ('config.php');
$errors = array();
if(isset($_POST['update_btn'])) {

    $postid = $_POST['postid'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $tag = $_POST['tag'];
//    $userid = $_SESSION['userid'];
    if (empty($title)) {
        array_push($errors, "Please give a title");
    }
    if (empty($body)) {
        array_push($errors, "Post text required");
    }
    if (empty($tag)) {
        array_push($errors, "Post tag required");
    }
    if (count($errors) == 0) {
        $sql = "UPDATE post SET title=:title, body=:body, tag=:tag WHERE postId='$postid'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':body', $body);
        $stmt->bindValue(':tag', $tag);

        if ($stmt->execute()) {
            //echo 'inserted';
            header('location: userprofile.php');
        } else {
            echo 'Could not insert';
        }

    }
}

?>
<?php if (count($errors) > 0) : ?>
    <?php  echo '<script type="text/javascript">alert("Error: ' . implode(" , ", $errors) . '");
                       window.location.href="userprofile.php";
                        </script>'; ?>
<?php endif ?>
