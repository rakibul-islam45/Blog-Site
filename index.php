<?php
    session_start();
    include_once ('config.php');
    $query = "SELECT * FROM post ORDER BY postId DESC ";
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
    <title>Home page </title>
    <?php  include ('head'); ?>

  </head>
  <body>

	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="js-fullheight">
			<nav id="colorlib-main-menu" role="navigation">
				<ul>
					<li class="colorlib-active"><a href="index.php">Home</a></li>
					<li><a href="#">PHP</a></li>
					<li><a href="#">JAVA</a></li>
					<li><a href="#">About</a></li>
					<li><a href="contact.php">Contact</a></li>
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
			<section class="ftco-section ftco-no-pt ftco-no-pb">
	    	<div class="container">
	    		<div class="row d-flex">

	    			<div class="col-xl-8 py-5 px-md-5">
	    				<div class="row pt-md-4">
                            <h1>Recent Articles </h1>
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
<!--				              		<span><i class="icon-comment2 mr-2"></i>5 Comment</span>-->
				              	</p>
			              	</div>
				              <p class="mb-4"><?php echo $post['body']; ?></p>
				              <p><a href="singlepost.php?postId=<?php echo $post['postId']; ?>" class="btn-custom">Read More <span class="ion-ios-arrow-forward"></span></a></p>
				            </div>
									</div>
								</div>
                            <?php endforeach;  ?>

			    		</div><!-- END-->
			    		<div class="row">
			          <div class="col">
			            <div class="block-27">
			              <ul>
			                <li><a href="#">&lt;</a></li>
			                <li class="active"><span>1</span></li>
			                <li><a href="#">2</a></li>
			                <li><a href="#">3</a></li>
			                <li><a href="#">4</a></li>
			                <li><a href="#">5</a></li>
			                <li><a href="#">&gt;</a></li>
			              </ul>
			            </div>
			          </div>
			        </div>
			    	</div>
	    			<div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
	            <div class="sidebar-box pt-md-4">

                    <a href="register.php" class="btn btn-primary" style="color: #491217"><strong>Register</strong></a>
	            </div>
	            <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">Categories</h3>
	              <ul class="categories">
	                <li><a href="#">Fashion <span>(6)</span></a></li>
	                <li><a href="#">Technology <span>(8)</span></a></li>
	                <li><a href="#">Travel <span>(2)</span></a></li>
	                <li><a href="#">Food <span>(2)</span></a></li>
	                <li><a href="#">Photography <span>(7)</span></a></li>
	              </ul>
	            </div>

	            <div class="sidebar-box ftco-animate">
	              <h3 class="sidebar-heading">Tag Cloud</h3>
	              <ul class="tagcloud">

<!--                      href="react.php?postId=--><?php //echo $posts['postId']; ?><!--&like=--><?php ?>
	                <a href="tagSearch.php?tag=php" class="tag-cloud-link">php</a>
	                <a href="tagSearch.php?tag=java" class="tag-cloud-link">java</a>
	                <a href="tagSearch.php?tag=html" class="tag-cloud-link">html</a>
	                <a href="#" class="tag-cloud-link">c</a>
	                <a href="#" class="tag-cloud-link">c++</a>
	                <a href="#" class="tag-cloud-link">python</a>
	                <a href="#" class="tag-cloud-link">c#</a>
	                <a href="#" class="tag-cloud-link">css</a>
	              </ul>
	            </div>

							<div class="sidebar-box subs-wrap img py-4" style="background-image: url(images/bg_1.jpg);">
								<div class="overlay"></div>
								<h3 class="mb-4 sidebar-heading">Newsletter</h3>
								<p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia</p>
	              <form action="#" class="subscribe-form">
	                <div class="form-group">
	                  <input type="text" class="form-control" placeholder="Email Address">
	                  <input type="submit" value="Subscribe" class="mt-2 btn btn-white submit">
	                </div>
	              </form>
	            </div>

	            <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">Archives</h3>
	              <ul class="categories">
	              	<li><a href="#">Decob14 2018 <span>(10)</span></a></li>
	                <li><a href="#">September 2018 <span>(6)</span></a></li>
	                <li><a href="#">August 2018 <span>(8)</span></a></li>
	                <li><a href="#">July 2018 <span>(2)</span></a></li>
	                <li><a href="#">June 2018 <span>(7)</span></a></li>
	                <li><a href="#">May 2018 <span>(5)</span></a></li>
	              </ul>
	            </div>


	            <div class="sidebar-box ftco-animate">
	              <h3 class="sidebar-heading">Paragraph</h3>
	              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut.</p>
	            </div>
	          </div><!-- END COL -->
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

