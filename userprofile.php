<?php
session_start();
$username = $_SESSION['username'];
$userId =  $_SESSION['userid'];
include_once ('config.php');
if (isset($userId )) {
    $query = "SELECT * FROM post WHERE userId = '$userId' ORDER BY postId DESC ";
    $statement = $pdo->prepare($query);
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
}else{
    echo '<script type="text/javascript">alert("Please login!");
                       window.location.href="login.php";
                        </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight">
        <nav id="colorlib-main-menu" role="navigation">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="postCreate.php">Create Post</a></li>
<!--                <li><a href="#">JAVA</a></li>-->
                <li><a href="#">About</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>

        <div class="colorlib-footer">
            <h1 id="colorlib-logo" class="mb-4"><a href="index.php" style="background-image: url(images/bg_1.jpg);">Blog <span>Site</span></a></h1>
            <?php  if (isset($_SESSION['username'])) : ?>
                <p>Welcome <strong><a href="userprofile.php"  style="color: #6f42c1" ><?php echo $_SESSION['username']; ?></a></strong></p>
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
                                            <span><a href="singlepost.php"><i class="icon-folder-o mr-2"></i><?php echo $post['tag']; ?></a></span>
                                            <span><i class="icon-comment2 mr-2"></i>5 Comment</span>
                                        </p>
                                    </div>
                                    <p class="mb-4"><?php echo $post['body']; ?></p>
                                    <p><a href="deletepost.php?postId=<?php echo $post['postId']; ?>" class="btn py-3 px-4 btn-primary">Delete </a>
                                        <a href="updatepost.php?postId=<?php echo $post['postId']; ?>&userId=<?php echo $post['userId']; ?>" class="btn py-3 px-4 btn-primary">Update </a>
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


<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>
</html>