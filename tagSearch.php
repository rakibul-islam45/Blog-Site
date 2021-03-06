<?php
session_start();
include ('config.php');
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

//include_once ('config.php');
$tag = $_GET['tag'];
//var_dump($tag);
$query = "SELECT * FROM post WHERE tag LIKE '%" . $tag . "%'";
$statement = $pdo->prepare($query);

$statement->execute();

$posts = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<?php
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tag</title>
    <?php  include ('head'); ?>
</head>
<body>

<div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight">
        <nav id="colorlib-main-menu" role="navigation">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">PHP</a></li>
                <li><a href="#">JAVA</a></li>
                <li><a href="#">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>

        <div class="colorlib-footer">
            <h1 id="colorlib-logo" class="mb-4"><a href="index.php" style="background-image: url(images/bg_1.jpg);">Blog <span>Site</span></a></h1>
            <?php  if (isset($_SESSION['username'])) : ?>
                <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                <p> <a href="index.php?logout='1'" style="color: red;" class="btn py-3 px-4 btn-primary" >Logout</a> </p>
            <?php endif ?>
            <?php  if (empty($_SESSION['username'])) : ?>
                <p><strong><a href="login.php" class="btn py-3 px-4 btn-primary">Login</a></strong> </p>
            <?php endif ?>
            <p class="pfooter"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
    </aside> <!-- END COLORLIB-ASIDE -->
    <div id="colorlib-main">
        <section class="ftco-section">
            <div class="container">
                <div class="row px-md-4">
                    <?php foreach($posts as $post):  ?>
                        <div class="col-md-12">
                            <div class="blog-entry ftco-animate d-md-flex">
                                <a href="singlepost.php" class="img img-2" style="background-image: url(images/image_1.jpg);"></a>
                                <div class="text text-2 pl-md-4">
                                    <h3 class="mb-2"><a href="singlepost.php"><?php echo $post['title']; ?></a></h3>
                                    <div class="meta-wrap">
                                        <p class="meta">
                                            <span><i class="icon-calendar mr-2"></i><?php echo date("F j, Y ", strtotime($post["created"])); ?></span>
                                            <span><a href=""><i class="icon-folder-o mr-2"></i><?php echo $post['tag']; ?></a></span>

                                        </p>
                                    </div>
                                    <p class="mb-4"><?php echo $post['body']; ?></p>
                                    <p>
                                        <a href="singlepost.php?postId=<?php echo $post['postId']; ?>" class="btn-custom"> Read More <span class="ion-ios-arrow-forward"></span></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;  ?>

                </div>
            </div>

        </section>
    </div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

    <?php  include ('loader.php')?>

</body>
