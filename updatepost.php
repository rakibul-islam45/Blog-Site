<?php
    $postid = $_GET['postId'];
    $userid= $_GET['userId'];

    include ('config.php');
    $errors = array();
    if($postid){

    $query = "SELECT * FROM post WHERE postId = '$postid'";
    $statement = $pdo->prepare($query);
    $statement->execute();
    $posts = $statement->fetch(PDO::FETCH_ASSOC);

    }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Update Post</title>
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
                <div class="mb-4">
                    <h3>Subscribe for newsletter</h3>
                    <form action="#" class="colorlib-subscribe-form">
                        <div class="form-group d-flex">
                            <div class="icon"><span class="icon-paper-plane"></span></div>
                            <input type="text" class="form-control" placeholder="Enter Email Address">
                        </div>
                    </form>
                </div>
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
                            <form method="post" action="updatefunction.php" class="p-3 p-md-5 bg-light">
                                <div class="form-group">
                                    <label for="title">Post Title *</label>
                                    <textarea type="text" name="title" class="form-control" id="title"><?php echo $posts['title']; ?> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" id="body" cols="30" rows="10" class="form-control"><?php echo $posts['body']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tag">Post Tag*</label>
                                    <textarea type="text" class="form-control" name="tag" id="tag"> <?php echo $posts['tag']; ?> </textarea>
                                </div>
                                <input type="hidden" name="postid" value="<?php echo $postid ?>">
                                <div class="form-group">
                                    <input type="submit" value="Update" name="update_btn" class="btn py-3 px-4 btn-primary">
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

    <?php  include ('loader.php')?>

    </body>
    </html>

