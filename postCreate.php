<?php
session_start();
$userid = $_SESSION['userid'];
include ('config.php');
$errors = array();
if(!empty($userid)) {
    if (isset($_POST['post_btn'])) {

        $title = $_POST['title'];
        $body = $_POST['body'];
        $tag = $_POST['tag'];
        $userid = $_SESSION['userid'];

        if (empty($title)) {
            array_push($errors, "Please give a title");
        }
        if (empty($body)) {
            array_push($errors, "Post text required");
        }
        if (empty($tag)) {
            array_push($errors, "Post tag required");
        }
        //$time = UNIX_TIMESTAMP();
        if (count($errors) == 0) {
            $queryI = "INSERT INTO post (userId, title, body, tag)
					  VALUES(:userid, :title, :body, :tag)";


            $statement = $pdo->prepare($queryI);
            $statement->bindValue(':userid', $userid);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':body', $body);
            $statement->bindValue(':tag', $tag);

            if ($statement->execute()) {
                header("location: userprofile.php");
                // echo 'Inserted';
            } else {
                echo 'Could not insert';
            }

        }

    }

}else{
    echo '<script type="text/javascript">alert("Please login!");
                       window.location.href="login.php";
                        </script>';
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Post creation</title>
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
      <style type = "text/css">
          .message {
              width: 70%;
              margin:  auto;
              padding: 10px 0px;
              color: #3c763d;
              background: #dff0d8;
              border: 1px solid #3c763d;
              border-radius: 5px;
              text-align: center;
          }
          .error {
              color: #a94442;
              background: #f2dede;
              border: 1px solid #a94442;
              margin-bottom: 20px;
          }
          .validation_errors p {
              text-align: center;
              margin-left: 10px;
          }
          .logged_in_info {
              text-align: right;
              padding: 10px;
          }
      </style>
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
					<li><a href="contact.html">Contact</a></li>
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
						<div class="col-md-12">
                            <form method="post" action="#" class="p-3 p-md-5 bg-light">
                            <div class="form-group">
                                <label for="title">Post Title *</label>
                                <input type="text" name="title" class="form-control" id="title">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tag">Post Tag*</label>
                                <input type="text" class="form-control" name="tag" id="tag">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post" name="post_btn" class="btn py-3 px-4 btn-primary">
                            </div>
                            </form>
						</div>

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

<?php if (count($errors) > 0) : ?>
    <div class="message error validation_errors" >
        <?php foreach ($errors as $error) : ?>
            <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>