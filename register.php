<?php
include_once ('config.php');
include_once ('registerfunction.php');


?>

<html>
<head>

    <style type = "text/css">
        * { margin: 0px; padding: 0px; }
        body {
            font-size: 120%;
            background: #F8F8FF;
        }
        .header {


            width: 60%;
            margin: 50px auto 0px;
            color: white;
            background: #5F9EA0;
            text-align: center;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;
        }
        form, .content {
            width: 60%;
            margin: auto;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 0px 0px 10px 10px;
        }
        .input-group {
            margin: 10px 0px 10px 0px;
        }
        .input-group label {
            display: block;
            text-align: left;
            margin: 3px;
        }
        .input-group input {
            height: 30px;
            width: 93%;
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid gray;
        }

        .btn {
            padding: 10px;
            font-size: 15px;
            color: white;
            background: #5F9EA0;
            border: none;
            border-radius: 5px;
        }


        .profile_info img {
            display: inline-block;
            width: 50px;
            height: 50px;
            margin: 5px;
            float: left;
        }
        .profile_info div {
            display: inline-block;
            margin: 5px;
        }

    </style>


    <title>Register</title>
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

                <div class="header">
                    <h2>Registration Form</h2>
                </div>
                <form method="post" action="./registerfunction.php">

                <div class="input-group">
                    <label for="name" class=" input-group label">Name: </label>
                    <input type="text" name="name" id="name"  placeholder="Name">
                </div>

                <div class="input-group">
                    <label for="username">User Name: </label>
                    <input  type="text" name="username" id="username"  placeholder="Username">
                </div>

                <div class="input-group">
                    <label for="email">Email: </label>
                    <input type="email" id="email" name="email" placeholder="Email">
                </div>

                <div class="input-group">
                    <label for="password">Password: </label>
                    <input type="password" id="password" name="password_1" placeholder="Password">
                </div>

                <div class="input-group">
                    <label for="password">Confirm: </label>
                    <input type="password" id="password" name="password_2" placeholder="Password confirmation">
                </div>
                <div>
                    <button type="submit" class="btn py-3 px-4 btn-primary" name="reg_user">Register</button>
                </div>
                </form>
            </div>

        </section>
    </div><!-- END COLORLIB-MAIN -->
</div><!-- END COLORLIB-PAGE -->

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

        <?php  include ('loader.php')?>

</body>
</html>