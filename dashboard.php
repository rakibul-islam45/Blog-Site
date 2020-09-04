
<?php
session_start();
if(!$_SESSION['username'])
{
    header("location:adminLogin.php");
}

include('dashboardHeader.php');

$server = "127.0.0.1";
$dbname = "blogSite";
$user = "hasan";
$pass = "user200097";
global $pdo;
$pdo = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);

try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Throwable $t) {
    echo 'Cannot Connect to Database';
    die;
}




$postcount = $pdo->query('select count(*) from post')->fetchColumn();
$usercount = $pdo->query('select count(*) from users')->fetchColumn();



?>





<div class="container dashboard">
    <h1>Welcome</h1>
    <div class="stats">
        <a href="users.php" class="first">
            <span><?php echo $usercount?></span> <br>
            <span>Total users</span>
        </a>
        <a href="managePosts.php">
            <span><?php echo $postcount?></span> <br>
            <span>Total posts</span>
        </a>
        <a>
            <span>43</span> <br>
            <span>Published comments</span>
        </a>
    </div>
    <br><br><br>
    <div class="buttons">
        <a href="users.php">Add Users</a>
        <a href="managePosts.php">Add Posts</a>
    </div>
</div>
</body>
</html>
