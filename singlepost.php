<?php
session_start();
include_once ('config.php');
 $postid = $_GET['postId'];
 //var_dump($postid);
$query = "SELECT * FROM post WHERE postId = $postid";
$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetch(PDO::FETCH_ASSOC);

?>
<?php
$queryC = "SELECT * FROM comments WHERE postid = $postid";
$sth = $pdo->prepare($queryC);
$sth->execute();
$commnets = $sth->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Single post show</title>
      <?php  include ('head'); ?>
  </head>
  <body>

	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="js-fullheight">
			<nav id="colorlib-main-menu" role="navigation">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="postCreate.php">PHP</a></li>
					<li ><a href="index.php">JAVA</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
			</nav>

			<div class="colorlib-footer">
				<h1 id="colorlib-logo" class="mb-4"><a href="index.php" style="background-image: url(images/bg_1.jpg);">Blog <span>Site</span></a></h1>
                <?php  if (isset($_SESSION['username'])) : ?>
                    <p> &nbsp&nbsp<strong><a href="userprofile.php"  style="color: #6f42c1" ><?php echo $_SESSION['username']; ?></a></strong></p>
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
	    			<div class="col-lg-8 px-md-5 py-5">
	    				<div class="row pt-md-4">
	    					<h1 class="mb-3"><?php echo $posts['title'];?></h1>
                        <div style="margin: auto"> <p>
                        <?php echo $posts['body']; ?>
                    </p> </div>
                            <p>
		              <img src="images/image_1.jpg" alt="" class="img-fluid">
		            </p>

		            <div class="tag-widget post-tag-container mb-5 mt-5">
		              <div class="tagcloud">
		                <a href="#" class="tag-cloud-link"><?php echo $posts['tag']; ?></a>

		              </div>

                        <?php
                        //likes
                        $queryR =  "SELECT COUNT(*) FROM react 
  		                                 WHERE postId = $postid AND reaction='like'";
                        $stmt = $pdo->prepare($queryR);
                        $stmt->execute();
                        $likeCount = $stmt->fetch(PDO::FETCH_ASSOC);

                        //dislike
                        $queryD =  "SELECT COUNT(*) FROM react 
  		                                 WHERE postId = $postid AND reaction='dislike'";
                        $stmt = $pdo->prepare($queryD);
                        $stmt->execute();
                        $dislikeCount = $stmt->fetch(PDO::FETCH_ASSOC);


                        ?>

                        <div>

                                <?php $like = 'like';
                                        $dislike = 'dislike';
                                ?>
                                <?php foreach ($likeCount as $like){ echo $like ; }?>&nbsp;&nbsp;<a href="react.php?postId=<?php echo $posts['postId']; ?>&like=<?php echo $like; ?>" >Like &nbsp;</a> <?php foreach ($dislikeCount as $dislike){ echo $dislike ; }?>&nbsp;&nbsp;<a href="react.php?postId=<?php echo $posts['postId']; ?>&dislike=<?php echo $dislike; ?>" > &nbsp; Dislike </a>

                        </div>
		            </div>
		            
		            <div class="about-author d-flex p-4 bg-light">
		              <div class="bio mr-5">
		                <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
		              </div>
		              <div class="desc">
		                <h3>George Washington</h3>
		                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
		              </div>
		            </div>


		            <div class="pt-5 mt-5">
		              <h3 class="mb-5 font-weight-bold">Comments</h3>
                        <?php foreach ($commnets as $comment): ?>
		              <ul class="comment-list">
		                <li class="comment">
		                  <div class="vcard bio">
		                    <img src="images/person_1.jpg" alt="Image placeholder">
		                  </div>
		                  <div class="comment-body">
		                    <h3><?php echo $comment['userName']?></h3>

		                    <p><?php echo $comment['comment']?></p>

		                  </div>
		                </li>

		              </ul>
                        <?php endforeach; ?>
		              <!-- END comment-list -->
		              
		              <div class="comment-form-wrap pt-5">
		                <h3 class="mb-5">Leave a comment</h3>
		                <form method="post" action="comments.php" class="p-3 p-md-5 bg-light">


		                  <div class="form-group">
		                    <label for="comment">Comment</label>
		                    <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
		                  </div>
                            <input type="hidden" name="postid" value="<?php echo $postid ?>">
		                  <div class="form-group">
                              <button type="submit" name="comment_btn"  class="btn py-3 px-4 btn-primary"> Post Comment </button>
		                  </div>

		                </form>
		              </div>
		            </div>
			    		</div><!-- END-->
			    	</div>
	    			<div class="col-lg-4 sidebar ftco-animate bg-light pt-5">

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
                      <a href="tagSearch.php?tag=php" class="tag-cloud-link">php</a>
                      <a href="tagSearch.php?tag=java" class="tag-cloud-link">java</a>
                      <a href="tagSearch.php?tag=html" class="tag-cloud-link">html</a>
                      <a href="#" class="tag-cloud-link">c</a>
                      <a href="#" class="tag-cloud-link">c++</a>
                      <a href="#" class="tag-cloud-link">python</a>
                      <a href="#" class="tag-cloud-link">c#</a>
                      <a href="#" class="tag-cloud-link">css</a>
	            </div>

							<div class="sidebar-box subs-wrap img" style="background-image: url(images/bg_1.jpg);">
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
	              	<li><a href="#">December 2018 <span>(10)</span></a></li>
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




